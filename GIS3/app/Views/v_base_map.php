<div id="map" style="width: 100%; height: 100vh;"></div>

<script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-providers/1.9.0/leaflet-providers.min.js"></script>
<script>
var map = L.map('map').setView([-5.984264235348096, 106.02788275311069], 12);

var tileLayer = L.tileLayer.provider('OpenStreetMap.Mapnik').addTo(map);


const baseLayers = {
    'Road': L.tileLayer.provider('OpenStreetMap.Mapnik'),
    'Terrain': L.tileLayer.provider('OpenTopoMap'),
    'Satellite': L.tileLayer.provider('Esri.WorldImagery')
};

L.control.layers(baseLayers, null, {
    collapsed: false
}).addTo(map);
</script>