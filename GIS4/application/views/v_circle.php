<div id="map" style="width: 100%; height: 500px;"></div>

<script>
    var map = L.map('map').setView([-6.002038, 106.036350], 16);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var tower1 = L.icon({
        iconUrl: '<?= base_url('icon-marker/icon-tower.png') ?>',
        iconSize: [30, 40], // size of the icon
        iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
        popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    var tower1 = L.circle([-5.999881252711757, 106.04310433554112], {
        color: 'red',
        fillColor: 'red',
        fillOpacity: 0.5,
        radius: 500
    }).addTo(map);
    var icon1 = L.icon({
        iconUrl: '<?= base_url('icon-marker/icon-tower.png') ?>',
        iconSize: [30, 40], // size of the icon
        iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
        popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
    });
    var lokasi1 = L.marker([-5.999881252711757, 106.04310433554112], {
        icon: icon1
    }).addTo(map);


    var tower2 = L.circle([-6.002343, 106.013226], {
        color: 'blue',
        fillColor: 'blue',
        fillOpacity: 0.5,
        radius: 500
    }).addTo(map);

    var tower3 = L.circle([-5.982222, 106.003238], {
        color: 'green',
        fillColor: 'green',
        fillOpacity: 0.5,
        radius: 500
    }).addTo(map);
</script>