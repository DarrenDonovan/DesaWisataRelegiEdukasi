<!DOCTYPE html>
<html lang="en">
<head>
    <base target="_top">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Tracking Rute</title>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        .leaflet-container {
            height: 500px;
            width: 100%;
        }
        /* Sembunyikan panel instruksi */
        .leaflet-routing-container {
            display: none !important;
        }
    </style>
</head>
<body>

<div id="map">
</div>

<script>
    const wisataLat = {{ $wisata->latitude }};
    const wisataLng = {{ $wisata->longitude }}

    const map = L.map('map');

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">Traking Maps</a>'
    }).addTo(map);

    const userMarker = L.marker([-6.200000,106.816666]).addTo(map)
        .bindPopup("Lokasi Anda");

    const destinationMarker = L.marker([wisataLat, wisataLng]).addTo(map)
        .bindPopup("Tempat Tujuan");

    const routingControl = L.Routing.control({
        waypoints: [
            L.latLng(-6.200000, 106.816666),
            L.latLng(wisataLat, wisataLng)
        ],
        createMarker: function() { return null; },
        routeWhileDragging: true,
        show: false // Menyembunyikan panel instruksi
    }).addTo(map);

    // Fokus ke rute saat peta pertama kali dimuat
    routingControl.on('routesfound', function(e) {
        const bounds = L.latLngBounds(e.routes[0].coordinates.map(coord => [coord.lat, coord.lng]));
        map.fitBounds(bounds, { padding: [20, 20] }); // Supaya pas di layar
    });

    function updateUserLocation(position) {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;
        userMarker.setLatLng([lat, lng]).update();

        routingControl.setWaypoints([
            L.latLng(lat, lng),
            L.latLng(wisataLat, wisataLng)
        ]);

        // Update tampilan peta agar tetap fokus ke rute terbaru
        routingControl.on('routesfound', function(e) {
            const bounds = L.latLngBounds(e.routes[0].coordinates.map(coord => [coord.lat, coord.lng]));
            map.fitBounds(bounds, { padding: [20, 20] });
        });
    }

    function errorHandler(error) {
        console.log("Error getting location:", error);
    }

    if (navigator.geolocation) {
        navigator.geolocation.watchPosition(updateUserLocation, errorHandler, {
            enableHighAccuracy: true
        });
    } else {
        alert("Geolocation tidak didukung oleh browser ini.");
    }
</script>

</body>
</html>
