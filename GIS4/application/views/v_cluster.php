<div id="map" style="width: 100%; height: 500px;"></div>

<script>
    var map = L.map('map').setView([-6.91896395816983, 107.61826139262037], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var markers = L.markerClusterGroup();

    <?php foreach ($tps as $key => $value) { ?>
        var lokasi = L.marker([<?= $value->latitude; ?>, <?= $value->longitude; ?>]).bindPopup(
            "<b>Nama TPS : <?= $value->nama_tps; ?></b><br>Kecamatan : <?= $value->kecamatan; ?><br>Wilayah : <?= $value->wilayah; ?>"
        );
        markers.addLayer(lokasi);

        map.addLayer(markers);
        map.fitBounds(markers.getBounds());
    <?php } ?>
</script>