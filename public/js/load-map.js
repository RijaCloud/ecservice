
/* Polyfill  for forEach*/
// ECMA-262, Edition 5, 15.4.4.18
// Référence: http://es5.github.io/#x15.4.4.18
if (!Array.prototype.forEach) {

    Array.prototype.forEach = function(callback, thisArg) {

        var T, k;

        if (this === null) {
            throw new TypeError(' this vaut null ou n est pas défini');
        }

        // 1. Soit O le résultat de l'appel à ToObject
        //    auquel on a passé |this| en argument.
        var O = Object(this);

        // 2. Soit lenValue le résultat de l'appel de la méthode
        //    interne Get sur O avec l'argument "length".
        // 3. Soit len la valeur ToUint32(lenValue).
        var len = O.length >>> 0;

        // 4. Si IsCallable(callback) est false, on lève une TypeError.
        // Voir : http://es5.github.com/#x9.11
        if (typeof callback !== "function") {
            throw new TypeError(callback + ' n est pas une fonction');
        }

        // 5. Si thisArg a été fourni, soit T ce thisArg ;
        //    sinon soit T égal à undefined.
        if (arguments.length > 1) {
            T = thisArg;
        }

        // 6. Soit k égal à 0
        k = 0;

        // 7. On répète tant que k < len
        while (k < len) {

            var kValue;

            // a. Soit Pk égal ToString(k).
            //   (implicite pour l'opérande gauche de in)
            // b. Soit kPresent le résultat de l'appel de la
            //    méthode interne HasProperty de O avec l'argument Pk.
            //    Cette étape peut être combinée avec c
            // c. Si kPresent vaut true, alors
            if (k in O) {

                // i. Soit kValue le résultat de l'appel de la
                //    méthode interne Get de O avec l'argument Pk.
                kValue = O[k];

                // ii. On appelle la méthode interne Call de callback
                //     avec T comme valeur this et la liste des arguments
                //     qui contient kValue, k, et O.
                callback.call(T, kValue, k, O);
            }
            // d. On augmente k de 1.
            k++;
        }
        // 8. on renvoie undefined
    };
}

String.prototype.replaceAt=function(index, character) {
    return this.substr(0, index) + character + this.substr(index+character.length);
}


/*  End */


var app  = {

    map : {

        marker : [],
        carte : [],
        searchbox : [],
        popup : [],
        icon : [],
        element: "",
        marker_name: [],
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
            app.map.element = element;
            var search = {};

            app.map.carte = new google.maps.Map(element, {
                zoom: app.map.getZoom(),
                center: pos,
                mapTypeId : google.maps.MapTypeId.HYBRID,

            });

            app.addCustomControll()


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
        localize : function() {

            if(navigator.geolocation) {

                return navigator.geolocation.getCurrentPosition(function(position) {

                    var url = window.location.origin + '/localizeMe?lat='+position.coords.latitude+'&lng='+position.coords.longitude

                    window.location.href = url

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

                } 
            }
            http.send()
        
        },
        getDataMarkerAndLoadMap : function(element, param = {}){

            var coords = {lat: -18.9149, lng: 47.5316}
            app.map.element = element
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

            app.addCustomControll()

            var image = {
                url: window.location.origin+'/img/map-marker.png',
                size: new google.maps.Size(32,32),
                origin: new google.maps.Point(0,0),
                anchor: new google.maps.Point(0, 32)
            }

            var image_flag = {
                url: window.location.origin+'/img/flag-map-marker.png',
                size: new google.maps.Size(32,32),
                origin: new google.maps.Point(0,0),
                anchor: new google.maps.Point(0, 32)
            }

            var shape = {
                coords: [1, 1, 1, 20, 18, 20, 18, 1],
                type: 'poly'
            };

            app.map.marker['map'] = new google.maps.Marker({
                map : app.map.carte,
                position: coords,
                icon: image_flag,
                shape : shape
            })

            for(var e = 0 ; e < element.length ; e++) {

                var latitude = element[e].getAttribute('data-lat')
                var longitude = element[e].getAttribute('data-lng')
                var id = element[e].getAttribute('data-id')
                var marker_name = element[e].getAttribute('data-name')
                var latLng = new google.maps.LatLng(latitude,longitude)

                app.map.marker_name['map'+id] = '<div id="content">'+
                    '<span class="pan" style="color:black!important;">'+
                    marker_name
                    +
                    '</span>'+
                    '</div>';



                app.map.marker['map'+id] = new google.maps.Marker({
                    map : app.map.carte,
                    position: latLng,
                    html: app.map.marker_name['map'+id],
                    icon: image,
                    shape : shape
                })
                
                app.map.popup['map'+id] = new google.maps.InfoWindow()

                app.map.popup['map'+id].setContent(app.map.marker_name['map'+id])

                app.map.popup['map'+id].setPosition(new google.maps.LatLng(latitude,longitude))

                google.maps.event.addListener(app.map.marker['map'+id], 'mouseover', function() {

                    app.map.popup['map'+id].setContent(this.html)

                    app.map.popup['map'+id].open(this.getMap(),this)

                })

            }

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
    },
    addCustomControll : function() {

        var goLocalize = document.createElement('div')
        goLocalize.id = "goLocalize"
        goLocalize.title = "Me localisé"
        goLocalize.index = 1
        goLocalize.style.cursor = "pointer"

        var img = document.createElement('img')
        img.src = window.location.origin+"/img/user-location.png"
        img.title = "Me localisé"

        goLocalize.appendChild(img)

        goLocalize.addEventListener('click', function() {

            app.map.localize()

        })
/*
        var goDistance = document.createElement('div')
        goLocalize.id = "distance"
        goLocalize.title = "Pour étendre le perimetre de résultat"
        var input = document.createElement('input')
        input.type = "number"
        input.name = "points"
        input.min = "0"
        input.max = "50"
        input.step = "3"
        input.value = "5"
        input.style.fontSize = "16px"

        goDistance.appendChild(input)

        input.addEventListener('change', function() {

            var url = window.location.search
            var string =  url.replaceAt(-1,this.value)
            window.location.href = string

        })
 app.map.carte.controls[google.maps.ControlPosition.TOP_RIGHT].push(goDistance)

*/
        app.map.carte.controls[google.maps.ControlPosition.TOP_RIGHT].push(goLocalize)

    }

}
