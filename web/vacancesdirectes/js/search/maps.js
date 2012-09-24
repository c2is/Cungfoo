var geocoder;
var map;
var currentPosition;
var markers = [];

// gestion des temps de trajets
var serviceTimer;
var iteration = 0;
var dataLatLng;
var service = new google.maps.DistanceMatrixService();

function initialize(etablissements, lat, lng, temps) {

    dataLatLng = etablissements;

    var latlng = new google.maps.LatLng(lat, lng);
    var mapOptions = {
        zoom: 14 - temps,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

    currentPosition = new google.maps.Marker({
        map: map,
        draggable: true,
        icon: '/c2is/Cungfoo/web/vacancesdirectes/img/red_pin.png'
    });

    google.maps.event.addListener(currentPosition, 'mouseup', function() {
        clearInterval(serviceTimer);
        iteration = 0;
        reloadMarkers();
    });

    geocoder = new google.maps.Geocoder();
    geocoder.geocode( {'latLng' : latlng}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(latlng);
            currentPosition.setPosition(latlng);
        }
    });

    reloadMarkers();
}

function clearMap()
{
    $.each(markers, function() {
        this.setMap(null);
    });
}

function reloadMarkers()
{
    clearMap();

    serviceTimer = setInterval(intervalEachEtablissement, 2000);
}

function intervalEachEtablissement()
{
    var destinations   = [];
    var startIteration = 25 * iteration;
    var endIteration   = 25 + startIteration;

    if (endIteration > dataLatLng.length) {
        clearInterval(serviceTimer);
        console.log('TERMINÉ');
    }


    for (var i = startIteration; i < endIteration; i++) {
        if (dataLatLng[i]) {
            destinations.push(new google.maps.LatLng(dataLatLng[i].lat, dataLatLng[i].lng));
        }
    }

    service.getDistanceMatrix({
            origins: [currentPosition.getPosition()],
            destinations: destinations,
            travelMode: google.maps.TravelMode.DRIVING,
            avoidHighways: false,
            avoidTolls: false
        }, function(response, status) {
            console.log('CALL API');
            if (status == google.maps.DistanceMatrixStatus.OK) {
                $.each(response.rows[0].elements, function(iDestination) {
                    if (this.duration && this.duration.value) {
                        var trajetTime = (new Date(this.duration.value*1000).getHours() -1) + (new Date(this.duration.value*1000).getMinutes() > 20);
                        if (trajetTime <= 2) {
                            var marker = new google.maps.Marker({
                                position: destinations[iDestination],
                                map: map,
                                title: "TEST"
                            });

                            markers.push(marker);
                        }
                    }

                });
            }
            else {
                console.log('ERROR:' + status);
            }
        }
    );

    iteration++;
}
