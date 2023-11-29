<div id="map" style="width: 100%; height: 100vh;"></div>

<script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-providers/1.9.0/leaflet-providers.min.js"></script>
<script>
    var map = L.map('map').setView([-6.000388796553931, 106.0452538748444], 15);

    var tileLayer = L.tileLayer.provider('OpenStreetMap.Mapnik').addTo(map);


    const baseLayers = {
        'Road': L.tileLayer.provider('OpenStreetMap.Mapnik'),
        'Terrain': L.tileLayer.provider('OpenTopoMap'),
        'Satellite': L.tileLayer.provider('Esri.WorldImagery')
    };

    L.control.layers(baseLayers, null, {
        collapsed: false
    }).addTo(map);

    //marker

    L.marker([-6.009611599778401, 106.04012202774892]).bindPopup("Alun Alun Kota").addTo(map);
    L.marker([-5.996309831737867, 106.0320081991961]).bindPopup("Fakultas Teknik UNTIRTA").addTo(map);
    L.marker([-5.995988373438921, 106.03965186447199]).bindPopup("Stadion Krakatau Steel").addTo(map);
    L.marker([-5.988479005252813, 106.03297493564064]).bindPopup("RS.Krakatau Medika").addTo(map);
    L.marker([-6.0022350637241475, 106.06611627101316]).bindPopup("RSUD Cilegon").addTo(map);
</script>