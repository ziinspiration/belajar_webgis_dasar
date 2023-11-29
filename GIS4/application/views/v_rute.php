<div id="map" style="width: 100%; height: 500px;"></div>

<script>
    var map = L.map('map').setView([-6.002038, 106.036350], 6);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.Routing.control({
        waypoints: [
            L.latLng(-6.008751, 106.040890), // titik start
            L.latLng(-6.0848686829995025, 105.88379871352988) // titik tujuan
        ],
        routeWhileDragging: true
    }).addTo(map);
</script>