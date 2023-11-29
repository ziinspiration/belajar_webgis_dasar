<?php
require 'functions.php';
$conn = connected();
$tampilTps = query("SELECT * FROM tps");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="icon" href="assets/cilegon.png">
    <title>GIS | Cilegon</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        #map {
            width: 100%;
            height: 100vh;
            z-index: 1;
        }

        .map-container {
            position: relative;
        }

        .map-overlay {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: flex-start;
            padding: 20px;
        }

        .sidebar {
            position: absolute;
            top: 0;
            right: -300px;
            width: 300px;
            height: 100vh;
            background-color: #f8f9fa;
            z-index: 2;
            transition: right 0.3s ease-in-out;
        }

        .sidebar.open {
            right: 0;
        }

        .sidebar-content {
            padding: 20px;
        }

        .bi-list {
            font-size: 30px !important;
            color: orange;
            font-weight: 700 !important;
        }

        hr {
            border: none;
            height: 2px;
            background-color: orange;
        }

        /* 
    .info {
        background: #fff;
        padding: 10px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        font-family: Arial, sans-serif;
        font-size: 12px;
        line-height: 1.5;
        color: #333;
        margin-right: 100px !important;
    }

    .info h4 {
        margin: 0 0 5px;
        font-size: 14px;
    } */

        label {
            font-size: 12px !important;
        }

        .offcanvas-title {
            color: orange;
        }

        .btn-c {
            border: none;
            background-color: transparent;
            font-size: 30px !important;
        }
    </style>
</head>

<body>

    <div class="map-container">
        <div class="map-overlay">
            <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar" style="border: none; background: none;">
                <i class="bi bi-list"></i>
            </button>
        </div>
        <div id="map"></div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarLabel">Layer Service</h5>
            <button type="button" class="btn-c" data-bs-dismiss="offcanvas" aria-label="Close"><i class="bi bi-x-circle"></i></button>
        </div>
        <div class="img-nav d-flex">
            <img src="assets/cilegon.png" style="height: 50px; width:50px;" class="ms-3 me-2">
            <p>Pemerintah Kota Cilegon <br> Badan Perencanaan Pembangunan Daerah</p>
        </div>
        <div class="offcanvas-body">
            <div class="sidebar-content">
                <ul class="list-unstyled">
                    <h5 class="mb-3">Pilih Jenis Maps</h3>
                        <li class="ms-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="satelliteCheckbox">
                                <label class="form-check-label" for="satelliteCheckbox">Satellite</label>
                            </div>
                        </li>
                        <li class="ms-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="terrainCheckbox">
                                <label class="form-check-label" for="terrainCheckbox">Terrain</label>
                            </div>
                        </li>
                        <li class="ms-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="roadCheckbox" checked>
                                <label class="form-check-label" for="roadCheckbox">Road</label>
                            </div>
                        </li>
                </ul>
                <hr>
                <ul class="list-unstyled">
                    <h5 class="mb-3">Wilayah Administrasi</h3>
                        <li class="ms-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="bandungCheckbox">
                                <label class="form-check-label" for="bandungCheckbox">Provinsi</label>
                            </div>
                        </li>
                        <li class="ms-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="kewilayahanCheckbox">
                                <label class="form-check-label" for="kewilayahanCheckbox">Kabupaten</label>
                            </div>
                        </li>
                        <li class="ms-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="kecamatanCheckbox">
                                <label class="form-check-label" for="kecamatanCheckbox">Kecamatan</label>
                            </div>
                        </li>
                        <li class="ms-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="kelurahanCheckbox">
                                <label class="form-check-label" for="kelurahanCheckbox">Kelurahan</label>
                            </div>
                        </li>
                </ul>
                <ul class="list-unstyled">
                    <h5 class="mb-3">Prasarana</h3>
                        <li class="ms-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="jalanCheckbox">
                                <label class="form-check-label" for="jalanCheckbox">
                                    Jalan
                                </label>
                            </div>
                        </li>
                </ul>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        var map = L.map('map').setView([-5.992735076420852, 106.02561279458], 12);

        var googleLayer = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: '© Google Maps'
        }).addTo(map);

        const satelliteCheckbox = document.getElementById('satelliteCheckbox');
        const terrainCheckbox = document.getElementById('terrainCheckbox');
        const roadCheckbox = document.getElementById('roadCheckbox');
        const bandungCheckbox = document.getElementById('bandungCheckbox');

        satelliteCheckbox.addEventListener('click', function() {
            if (satelliteCheckbox.checked) {
                terrainCheckbox.checked = false;
                roadCheckbox.checked = false;
                map.removeLayer(googleLayer);
                googleLayer = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                    attribution: '© Google Maps'
                }).addTo(map);
            } else {
                map.removeLayer(googleLayer);
                googleLayer = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                    attribution: '© Google Maps'
                }).addTo(map);
            }
        });

        terrainCheckbox.addEventListener('click', function() {
            if (terrainCheckbox.checked) {
                satelliteCheckbox.checked = false;
                roadCheckbox.checked = false;
                map.removeLayer(googleLayer);
                googleLayer = L.tileLayer('https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                    attribution: '© Google Maps'
                }).addTo(map);
            } else {
                map.removeLayer(googleLayer);
                googleLayer = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                    attribution: '© Google Maps'
                }).addTo(map);
            }
        });

        roadCheckbox.addEventListener('click', function() {
            if (roadCheckbox.checked) {
                satelliteCheckbox.checked = false;
                terrainCheckbox.checked = false;
                map.removeLayer(googleLayer);
                googleLayer = L.tileLayer('https://{s}.google.com/vt/lyrs=r&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                    attribution: '© Google Maps'
                }).addTo(map);
            } else {
                map.removeLayer(googleLayer);
                googleLayer = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                    attribution: '© Google Maps'
                }).addTo(map);
            }
        });

        // Administrasi
        var info = L.control();

        info.onAdd = function(map) {
            this._div = L.DomUtil.create('div', 'info');
            return this._div;
        };

        info.addTo(map);

        var geojson;
        var currentLayer; // Menyimpan layer yang sedang ditampilkan

        function highlightFeature(e) {
            var layer = e.target;

            layer.setStyle({
                weight: 1,
                color: 'white',
                dashArray: '',
                fillOpacity: 0.3
            });

            if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                layer.bringToFront();
            }
        }

        function resetHighlight(e) {
            geojson.resetStyle(e.target);
        }

        function uncheckCurrentCheckbox() {
            if (currentLayer) {
                currentLayer.checked = false;
                currentLayer.nextElementSibling.classList.remove('checked');
                currentLayer = null;
            }
        }

        function zoomToFeature(e) {
            map.fitBounds(e.target.getBounds());
        }

        function showPopup(feature, layer) {
            var popupContent = '<h3>Informasi Wilayah</h3>';
            if (feature.properties) {
                if (feature.properties.KABUPATEN) {
                    popupContent += '<p>Kabupaten : ' + feature.properties.KABUPATEN + '</p>';
                }
                if (feature.properties.KECAMATAN) {
                    popupContent += '<p>Kecamatan : ' + feature.properties.KECAMATAN + '</p>';
                }
                if (feature.properties.KELURAHAN) {
                    popupContent += '<p>Kelurahan : ' + feature.properties.KELURAHAN + '</p>';
                }
                if (feature.properties.JENIS) {
                    popupContent += '<p>Jenis Jalan : ' + feature.properties.JENIS + '</p>';
                }
                if (feature.properties.FUNGSI) {
                    popupContent += '<p>Fungsi Jalan : ' + feature.properties.FUNGSI + '</p>';
                }
            } else {
                popupContent += 'Arahkan mouse ke wilayah';
            }

            layer.bindPopup(popupContent).openPopup();
        }

        function onEachFeature(feature, layer) {
            layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: function(e) {
                    zoomToFeature(e);
                    showPopup(feature, layer);
                }
            });
        }

        function addGeoJsonLayer(url, checkbox) {
            $.getJSON(url, function(data) {
                if (currentLayer === checkbox) {
                    map.removeLayer(geojson);
                    uncheckCurrentCheckbox();
                }

                geojson = L.geoJson(data, {
                    style: function(feature) {
                        var color = feature.properties.color;
                        return {
                            fillColor: color,
                            fillOpacity: 0.5,
                            color: color,
                            weight: 2
                        };
                    },
                    onEachFeature: onEachFeature
                }).addTo(map);

                currentLayer = checkbox;
                currentLayer.checked = true;
                currentLayer.nextElementSibling.classList.add('checked');
            });
        }

        var checkboxes = document.querySelectorAll('.form-check-input');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    uncheckOtherCheckboxes(checkbox);
                    var url;
                    if (checkbox.id === 'bandungCheckbox') {
                        url = 'geojson/ADMINISTRASI_PROVINSI.geojson';
                    } else if (checkbox.id === 'kewilayahanCheckbox') {
                        url = 'geojson/ADMINISTRASI_KOTACILEGON.geojson';
                    } else if (checkbox.id === 'kecamatanCheckbox') {
                        url = 'geojson/ADMINISTRASI_KABUPATENKOTA.geojson';
                    } else if (checkbox.id === 'kelurahanCheckbox') {
                        url = 'geojson/ADMINISTRASI_KELURAHAN.geojson';
                    } else if (checkbox.id === 'jalanCheckbox') {
                        url = 'geojson/JARINGAN_JALAN.geojson';
                    }

                    addGeoJsonLayer(url, checkbox);
                } else {
                    closeCheckbox(checkbox);
                }
            });
        });

        function uncheckOtherCheckboxes(checkbox) {
            checkboxes.forEach(function(cb) {
                if (cb !== checkbox && cb.checked) {
                    cb.checked = false;
                    closeCheckbox(cb);
                }
            });
        }

        function closeCheckbox(checkbox) {
            checkbox.checked = false;
            checkbox.nextElementSibling.classList.remove('checked');
            if (currentLayer === checkbox) {
                map.removeLayer(geojson);
                uncheckCurrentCheckbox();
            }
        }

        var offCanvas = document.querySelector('.offcanvas');
        offCanvas.addEventListener('mouseleave', function() {
            checkboxes.forEach(function(checkbox) {
                if (!checkbox.checked) {
                    checkbox.checked = false;
                    checkbox.nextElementSibling.classList.remove('checked');
                }
            });
        });
    </script>
</body>

</html>