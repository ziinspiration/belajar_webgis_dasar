<div id="map" style="width: 100%; height: 500px;"></div>

<script>
    var map = L.map('map').setView([-6.020044, 106.051359], 16);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var rt1 = L.polygon([
        [-6.021651, 106.050765],
        [-6.023255, 106.049732],
        [-6.022904, 106.048726],
        [-6.022693, 106.047455],
        [-6.020411, 106.048320],
        [-6.021651, 106.050765]
    ], {
        color: 'red',
    }).bindPopup("Rt 1").addTo(map);

    var rt2 = L.polygon([
        [-6.021419, 106.054761],
        [-6.020608, 106.053398],
        [-6.020074, 106.053645],
        [-6.020573, 106.055092],
        [-6.019023, 106.051922],
        [-6.021419, 106.054761]
    ], {
        color: 'blue',
    }).bindPopup("Rt 2").addTo(map);
</script>