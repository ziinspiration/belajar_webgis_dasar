<div id="map" style="width: 100%; height: 500px;"></div>

<script>
var map = L.map('map').setView([-6.002038, 106.036350], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// create a red polyline from an array of LatLng points
var latlngs = [
    [-5.992890, 106.029668],
    [-5.997018, 106.033351],
    [-5.998832, 106.034732],
    [-6.000581, 106.035547],
    [-6.003313, 106.037564],
    [-6.007240, 106.040525],
    [-6.009245, 106.040954]
];

var polyline = L.polyline(latlngs, {
    color: 'blue'
}).addTo(map);

var latlngs = [
    [
        [-5.992890, 106.029668],
        [-5.997018, 106.033351],
        [-5.998832, 106.034732],
        [-6.000581, 106.035547],
        [-6.003313, 106.037564],
        [-6.007240, 106.040525],
        [-6.009245, 106.040954]
    ],
    [
        [-6.018165, 106.055975],
        [-6.013001, 106.057606],
        [-6.009049, 106.061266]
    ]
];

var polyline = L.polyline(latlngs, {
    color: 'blue'
}).bindPopup("Jalan mulus").addTo(map);

var latlngs = [
    [-6.018927, 106.055729

    ],
    [-6.022963, 106.054376],
    [-6.024660, 106.054106],
    [-6.025778, 106.054106],
    [-6.026585, 106.054272],
    [-6.028447, 106.055098],
    [-6.031449, 106.057161]
];

var polyline = L.polyline(latlngs, {
    color: 'red'
}).bindPopup("Jalan rusak").addTo(map);

// zoom the map to the polyline
map.fitBounds(polyline.getBounds());
</script>