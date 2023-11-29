<div id="map" style="width: 100%; height: 500px;"></div>

<script>
    var map = L.map('map').setView([-2.538237, 118.733479], 5);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    <?php foreach ($prov as $key => $value) {
        echo "var geojsonUrl$key = '" . base_url('geojson/' . $value->file_geojson) . "';";
    ?>

        $.getJSON(geojsonUrl<?php echo $key; ?>, function(data) {
            var getLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        opacity: 1.0,
                        color: '<?= $value->warna; ?>',
                        fillcolor: '<?= $value->warna; ?>',
                    };
                }
            }).addTo(map);

            getLayer.eachLayer(function(layer) {
                layer.bindPopup("<h5><b><?php echo $value->nama_provinsi; ?></b></h5>");
            });
        });

    <?php } ?>
</script>