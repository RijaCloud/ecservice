
var app  = {

    map : {

        marker : [],
        carte : [],
        searchbox : [],
        getZoom : function() {

            let url = window.location.href.split('/') ;
            let regex = /([0-9])(-([a-zA-Z]+))?/gi
            url =  regex.test(url[url.length-1]) ? url[url.length-2] : url[url.length-1];

            switch(url) {

                case 'province':
                    return 5;
                    break;

                case 'country':
                    return 7;
                    break;

                case 'departement':
                    return 9;
                    break;

                case 'town':
                    return 11;
                    break;

                case 'fokontany':
                    return 13;
                    break;

                case 'place':
                    return 12;
                    break;

                default:
                    return 5;
                    break;
            }

        },
        initMap : function(element, param = null)  {

            var pos = (param !== null) ? {lat:param.lat,lng:param.lng} : {lat: -18.9149, lng: 47.5316};

            var search = {};

            if(document.getElementById('searchbox') !== null) {
                search = document.getElementById('searchbox');
                app.map.searchbox = new google.maps.places.SearchBox(search);

                app.map.searchbox.addListener('places_changed' , function() {

                    var place = app.map.searchbox.getPlaces();

                    if(place.length == 0)
                        return

                    app.map.marker.setMap(null)

                    var bounds = new google.maps.LatLngBounds();

                    place.forEach(function(place){
                        app.map.marker = new google.maps.Marker({
                            position: place.geometry.location ,
                            map : app.map.carte,
                            animation : google.maps.Animation.DROP,
                            draggable: true
                        })

                        if(place.geometry.viewport)
                            bounds.union(place.geometry.viewport)
                        else
                            bounds.extend(place.geometry.location)

                        app.map.carte.setCenter(place.geometry.location)
                        latitude.value = place.geometry.location.lat()
                        longitude.value = place.geometry.location.lng()
                    });

                    app.map.carte.fitBounds(bounds)
                })
            }

            app.map.carte = new google.maps.Map(element, {
                zoom: app.map.getZoom(),
                center: pos,
                mapTypeId : google.maps.MapTypeId.HYBRID
            });

            app.map.marker = new google.maps.Marker({
                position: pos ,
                map : app.map.carte,
                animation : google.maps.Animation.DROP,
                title: "Click",
                draggable: true
            });


            var longitude = document.getElementById('longitude');
            var latitude = document.getElementById('latitude');

            google.maps.event.addListener(app.map.marker,'dragend', function() {

                var latlng = this.getPosition();

                longitude.value = latlng.lng();
                latitude.value = latlng.lat();

            });

        },
        localize : function(latElement, lngElement) {

            if(navigator.geolocation) {

                return navigator.geolocation.getCurrentPosition(function(position) {
                    latElement.value = position.coords.latitude
                    lngElement.value = position.coords.longitude
                    
                    return true
                },function(error) {
                    switch(error.code) {
                        case error.PERMISSION_DENIED:
                            alert("User denied the request for Geolocation.")
                            break;
                        case error.POSITION_UNAVAILABLE:
                            alert("Location information is unavailable.")
                            break;
                        case error.TIMEOUT:
                            alert("The request to get user location timed out.")
                            break;
                        case error.UNKNOWN_ERROR:
                            alert("An unknown error occurred.")
                            break;
                    }
                    return false
                })

            } else {
                return false
            }

        },
        reloadMarkers : function(param) {

            var new_lat = param[0]
            var new_lng = param[1]

            app.map.marker.setMap(null)

            app.map.marker = new google.maps.Marker({
                position: {lat:new_lat,lng:new_lng},
                map : app.map.carte,
                animation : google.maps.Animation.DROP,
                title: "Click",
                draggable: true
            });
        },
        findMapAndReloadMarkers : function(url,url2) {

            var http = new XMLHttpRequest();

            http.open('GET',url,true);

            http.setRequestHeader('X-Requested-With','XMLHttpRequest');

            http.onreadystatechange = function() {

                if(http.readyState == 4 && http.status == 200) {

                     var loaded_map = JSON.parse(http.responseText);

                     var latitude = loaded_map.lieu.latitude ? loaded_map.lieu.latitude : loaded_map.latitude ;
                     var longitude = loaded_map.lieu.longitude ? loaded_map.lieu.longitude : loaded_map.longitude ;

                     app.map.carte.setZoom(16)
                     app.map.carte.setCenter({lat:latitude,lng:longitude});
                     app.map.reloadMarkers([latitude,longitude]);

                     var map_details = document.getElementById('info');
                    map_details.style.display = "block";
                    map_details.style.height = "auto";
                    var map_name = document.getElementById('map-name');
                    var map_description = document.getElementById('map-description');
                    var map_longitude = document.getElementById('map-longitude');
                    var map_latitude = document.getElementById('map-latitude');
                    var update_url = document.getElementById('edit');
                    var delete_url = document.getElementById('delete');
                    map_name.value = loaded_map.lieu.string_lieu ? loaded_map.lieu.string_lieu : loaded_map.nom;
                    map_description.value = loaded_map.lieu.description ? loaded_map.lieu.description : loaded_map.description;
                    map_longitude.value = longitude;
                    map_latitude.value = latitude;

                    update_url.setAttribute('href',url)
                    delete_url.setAttribute('action',url2)

                } else {


                }

                document.querySelector('.img-loader').classList.add('hidden')
            }
            http.send()
        }

    }

}
