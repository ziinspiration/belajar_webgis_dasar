<div id="map" style="width: 100%; height: 500px;"></div>

<script>
    var map = L.map('map').setView([-6.002038, 106.036350], 12);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
</script>