<div id="map" style="width: 100%; height: 500px;"></div>

<script>
    //data dari database
    var data = [
        <?php foreach ($tps as $key => $value) { ?> {
                "lokasi": [<?= $value->latitude ?>, <?= $value->longitude ?>],
                "nama_tps": "<?= $value->nama_tps ?>"
            },
        <?php } ?>
    ];

    var map = new L.Map('map', {
        zoom: 12,
        center: new L.latLng(-6.91896395816983, 107.61826139262037)
    })

    map.addLayer(new L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }));


    // control search   
    var markersLayer = new L.LayerGroup(); //layer contain searched elements

    map.addLayer(markersLayer);

    var controlSearch = new L.Control.Search({
        position: 'topright',
        layer: markersLayer,
        initial: false,
        zoom: 17,
        marker: false
    });

    map.addControl(controlSearch);

    ////////////populate map with markers from sample data
    for (i in data) {
        var nama_tps = data[i].nama_tps; //value searched
        var lokasi = data[i].lokasi; //position found
        var marker = new L.Marker(new L.latLng(lokasi), {
            title: nama_tps
        }); //se property searched
        marker.bindPopup('Nama TPS : ' + nama_tps);
        markersLayer.addLayer(marker);
    }
</script>