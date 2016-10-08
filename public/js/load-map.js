
var app  = {

    map : {

        marker : [],
        carte : [],
        searchbox : [],
        popup : [],
        icon : [],
        getZoom : function() {

            let url = window.location.href.split('/') ;
            let regex = /([0-9])-([a-zA-Z]+)/gi
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

            app.map.carte = new google.maps.Map(element, {
                zoom: app.map.getZoom(),
                center: pos,
                mapTypeId : google.maps.MapTypeId.HYBRID,

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

                    var latitude = loaded_map.lieu.latitude ;
                    var longitude = loaded_map.lieu.longitude;

                    app.map.carte.setZoom(16)
                    app.map.carte.setCenter({lat:latitude,lng:longitude});
                    app.map.reloadMarkers([latitude,longitude]);

                } else {


                }

            }
            http.send()
        
        },
        getDataMarkerAndLoadMap : function(element, param = {}){

            var coords = {lat: -18.9149, lng: 47.5316}

            if(param) {
                coords = new google.maps.LatLng(param.center.lat,param.center.lng)
            }
            app.map.carte = new google.maps.Map(document.getElementById('canvas'), {
                zoom: 16,
                center: coords,
                mapTypeControl: true,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                    mapTypeIds: [
                        google.maps.MapTypeId.ROADMAP,
                        google.maps.MapTypeId.TERRAIN,
                        google.maps.MapTypeId.HYBRID,
                    ]
                },
                zoomControlOptions: {
                    position : google.maps.ControlPosition.LEFT_TOP
                },
                draggable: false
            })
            
            for(var e = 0 ; e < element.length ; e++) {

                var latitude = element[e].getAttribute('data-lat')
                var longitude = element[e].getAttribute('data-lng')
                var marker_name = element[e].getAttribute('data-name')
                var id = element[e].getAttribute('data-id')
                var latLng = new google.maps.LatLng(latitude,longitude)

                app.map.marker['map'+id] = new google.maps.Marker({
                    map : app.map.carte,
                    position: latLng,
                    html: marker_name
                })
                
                app.map.popup['map'+id] = new google.maps.InfoWindow()

                var popup = '<div id="content">'+
                    '<span class="pan" style="color:black!important;">'+
                    marker_name
                    +
                    '</span>'+
                    '</div>';

                app.map.popup['map'+id].setContent(popup)

                app.map.popup['map'+id].setPosition(new google.maps.LatLng(latitude,longitude))

                var i = e;

                google.maps.event.addListener(app.map.marker['map'+id], 'click', function() {

                    app.map.popup['map'+id].open(this.getMap(),this)

                })
            }
            console.log(app.map.popup);

            document.querySelectorAll('.marked').forEach(function(dx,el) {

                dx.addEventListener('mouseover', function() {
                    var lat = this.getAttribute('data-lat')
                    var lng = this.getAttribute('data-lng')
                    var id = this.getAttribute('data-id')
                    app.map.carte.setCenter(new google.maps.LatLng(lat, lng))
                    app.map.popup['map'+id].setPosition(new google.maps.LatLng(lat,lng));
                    app.map.popup['map'+id].open(app.map.carte,app.map.marker['map'+id])
                })

                dx.addEventListener('mouseout', function() {
                    var id = this.getAttribute('data-id')

                    app.map.popup['map'+id].close()
                })
            })

        }

    }

}
