<!DOCTYPE html>
<html>
<head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 500px;
            width: 100%;
            position:relative;




        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
<input id="pac-input" class="controls" type="text" placeholder="Search Box">
<div id="map"></div>


<script>
    var customers={!! $agency !!};

    var map,infoWindow;
    function initMap() {
        var agencyIstanbay={lat:40.961398, lng:29.1136761999999862},

        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 12
        });


        var marker =new google.maps.Marker({
            title:'Istanbay',
            position:agencyIstanbay,
            map:map
        });
        customers.forEach(function(customer) {
                var location = {lat : customer['lat'], lng:customer['lng']};
                var markerX = new google.maps.Marker({
                    title : customer['title'],
                    position : location,
                    map: map
            })
        });

    infoWindow=new google.maps.InfoWindow;
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {

            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

          //  location.href = 'http://localhost:8000/location/'+pos.lat+'/'+pos.lng;

            infoWindow.setPosition(pos);
            console.log(pos)
            infoWindow.setContent('Konumunuz');
            infoWindow.open(map);
            map.setCenter(pos);
        },function () {
            handleLocationError(true, infoWindow, map.getCenter());


        });
        }
        else {

        handleLocationError(false,infoWindow,map.getCenter());
    }

    function handleLocationError (browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
    }}


</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCj3jEE8WsgNy5SCNfMTnTwzSh6P5tN81M&callback=initMap"
        async defer></script>

<script>
    // This example adds a search box to a map, using the Google Place Autocomplete
    // feature. People can enter geographical searches. The search box will return a
    // pick list containing a mix of places and predicted search terms.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -33.8688, lng: 151.2195},
            zoom: 13,
            mapTypeId: 'roadmap'
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });

        var markers = [];

    }

</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCj3jEE8WsgNy5SCNfMTnTwzSh6P5tN81M&libraries=places"></script>

</body>
</html>