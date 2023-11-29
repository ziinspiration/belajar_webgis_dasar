<div id="map" style="width: 100%; height: 500px;"></div>

<script>
var map = L.map('map').setView([-6.91896395816983, 107.61826139262037], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

var heat = L.heatLayer([
    <?php foreach ($tps as $key => $value) { ?>[<?= $value->latitude ?>, <?= $value->longitude ?>, 50],
    <?php } ?>
], {
    radius: 25
}).addTo(map);
</script>