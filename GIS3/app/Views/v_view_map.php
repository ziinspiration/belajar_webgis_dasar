<div id="map" style="width: 100%; height: 100vh;"></div>

<script>
const map = L.map('map').setView([-5.984264235348096, 106.02788275311069], 12);

const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
</script>