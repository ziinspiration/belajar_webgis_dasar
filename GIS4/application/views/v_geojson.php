<div id="map" style="width: 100%; height: 500px;"></div>

<script>
    var map = L.map('map').setView([-0.344462, 104.649238], 5);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // ACEH
    $.getJSON("<?= base_url('geojson/aceh.geojson') ?>", function(data) {
        getLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    opacity: 1.0,
                    color: 'red',
                    fillcolor: 'red',
                }
            },
        }).addTo(map);
    });


    $.getJSON("<?= base_url('geojson/12.geojson') ?>", function(data) {
        getLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    opacity: 1.0,
                    color: 'blue',
                    fillcolor: 'blue',
                }
            },
        }).addTo(map);
    });

    $.getJSON("<?= base_url('geojson/13.geojson') ?>", function(data) {
        getLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    opacity: 1.0,
                    color: 'orange',
                    fillcolor: 'orange',
                }
            },
        }).addTo(map);
    });

    $.getJSON("<?= base_url('geojson/14.geojson') ?>", function(data) {
        getLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    opacity: 1.0,
                    color: 'green',
                    fillcolor: 'green',
                }
            },
        }).addTo(map);
    });

    $.getJSON("<?= base_url('geojson/15.geojson') ?>", function(data) {
        getLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    opacity: 1.0,
                    color: 'grey',
                    fillcolor: 'grey',
                }
            },
        }).addTo(map);
    });

    $.getJSON("<?= base_url('geojson/16.geojson') ?>", function(data) {
        getLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    opacity: 1.0,
                    color: 'blue',
                    fillcolor: 'blue',
                }
            },
        }).addTo(map);
    });

    $.getJSON("<?= base_url('geojson/17.geojson') ?>", function(data) {
        getLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    opacity: 1.0,
                    color: 'red',
                    fillcolor: 'red',
                }
            },
        }).addTo(map);
    });

    $.getJSON("<?= base_url('geojson/18.geojson') ?>", function(data) {
        getLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    opacity: 1.0,
                    color: 'black',
                    fillcolor: 'black',
                }
            },
        }).addTo(map);
    });

    $.getJSON("<?= base_url('geojson/19.geojson') ?>", function(data) {
        getLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    opacity: 1.0,
                    color: 'green',
                    fillcolor: 'green',
                }
            },
        }).addTo(map);
    });

    $.getJSON("<?= base_url('geojson/babel.geojson') ?>", function(data) {
        getLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    opacity: 1.0,
                    color: 'blue',
                    fillcolor: 'blue',
                }
            },
        }).addTo(map);
    });
</script>