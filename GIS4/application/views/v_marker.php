<!DOCTYPE html>
<html>

<head>
    <title>Map Example</title>
    <style>
    #map {
        width: 100%;
        height: 500px;
    }
    </style>
</head>

<body>
    <div id="map"></div>

    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-providers/1.9.0/leaflet-providers.min.js"></script>
    <script>
    var map = L.map('map').setView([-6.002038, 106.036350], 13);

    var tileLayer = L.tileLayer.provider('OpenStreetMap.Mapnik').addTo(map);

    var polylineMode = false;
    var markerMode = false;
    var polyline;
    var markers = [];

    function togglePolylineMode() {
        polylineMode = !polylineMode;

        if (polylineMode) {
            var latlngs = [
                [-5.992890, 106.029668],
                [-5.997018, 106.033351],
                [-5.998832, 106.034732],
                [-6.000581, 106.035547],
                [-6.003313, 106.037564],
                [-6.007240, 106.040525],
                [-6.009245, 106.040954]
            ];

            polyline = L.polyline(latlngs, {
                color: 'blue'
            }).bindPopup("Jalan mulus").addTo(map);

            var latlngs2 = [
                [-6.018165, 106.055975],
                [-6.013001, 106.057606],
                [-6.009049, 106.061266]
            ];

            var polyline2 = L.polyline(latlngs2, {
                color: 'blue'
            }).bindPopup("Jalan rusak").addTo(map);
        } else {
            if (polyline) {
                polyline.removeFrom(map);
                polyline = null;
            }
        }
    }

    function toggleMarkerMode() {
        markerMode = !markerMode;

        if (markerMode) {
            var icon1 = L.icon({
                iconUrl: '<?= base_url('icon-marker/icon-marker.png') ?>',
                iconSize: [40, 40], // size of the icon
                iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
                popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
            });

            var icon2 = L.icon({
                iconUrl: '<?= base_url('icon-marker/icon-hospital.png') ?>',
                iconSize: [30, 35], // size of the icon
                iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
                popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
            });

            var icon3 = L.icon({
                iconUrl: '<?= base_url('icon-marker/icon-stadion.png') ?>',
                iconSize: [30, 40], // size of the icon
                iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
                popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
            });

            var icon4 = L.icon({
                iconUrl: '<?= base_url('icon-marker/icon-universitas.png') ?>',
                iconSize: [30, 40], // size of the icon
                iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
                popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
            });

            var lokasi1 = L.marker([-6.007155684795679, 106.03988784397852], {
                icon: icon1
            }).bindPopup("Alun-Alun Kota Cilegon").addTo(map);

            var lokasi2 = L.marker([-5.987769151636269, 106.03293841584028], {
                icon: icon4
            }).bindPopup("Fakultas Teknik UNTIRTA").addTo(map);

            var lokasi3 = L.marker([-5.994993143949112, 106.03190074883734], {
                icon: icon2
            }).bindPopup("RS.Krakatau Medika").addTo(map);

            var lokasi4 = L.marker([-5.995050476841713, 106.03962560354391], {
                icon: icon3
            }).bindPopup("Stadion Krakatau Steel").addTo(map);

            var lokasi5 = L.marker([-6.001070396888025, 106.06585552015765], {
                icon: icon2
            }).bindPopup("RSUD Kota Cilegon").addTo(map);

            markers.push(lokasi1, lokasi2, lokasi3, lokasi4, lokasi5);
        } else {
            markers.forEach(function(marker) {
                marker.removeFrom(map);
            });

            markers = [];
        }
    }

    function toggleMode(mode) {
        if (mode === 'polyline') {
            togglePolylineMode();
        } else if (mode === 'marker') {
            toggleMarkerMode();
        }
    }

    function changeMapType(mapType) {
        tileLayer.removeFrom(map);
        tileLayer = L.tileLayer.provider(mapType).addTo(map);
    }
    </script>

    <button onclick="toggleMode('polyline')">Aktifkan Mode Polyline</button>
    <button onclick="toggleMode('marker')">Aktifkan Mode Marker</button>
    <br>
    <button onclick="changeMapType('OpenStreetMap.Mapnik')">Road</button>
    <button onclick="changeMapType('OpenTopoMap')">Terrain</button>
    <button onclick="changeMapType('Esri.WorldImagery')">Satellite</button>
</body>

</html>