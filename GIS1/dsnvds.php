<!DOCTYPE html>
<html>
<head>
  <title>Leaflet Checkbox Example</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <style>
    #map {
      height: 400px;
    }

    .checkbox {
      margin-bottom: 10px;
    }

    .checkbox input[type="checkbox"] {
      margin-right: 5px;
    }

    .checkbox span {
      position: relative;
      top: -1px;
    }

    .checkbox.checked span:before {
      content: "✓";
      position: absolute;
      left: -20px;
    }
  </style>
</head>
<body>
  <div id="map"></div>
  <div class="checkbox">
    <input type="checkbox" id="bandungCheckbox" />
    <span>Bandung</span>
  </div>
  <div class="checkbox">
    <input type="checkbox" id="kewilayahanCheckbox" />
    <span>Kewilayahan</span>
  </div>
  <div class="checkbox">
    <input type="checkbox" id="kecamatanCheckbox" />
    <span>Kecamatan</span>
  </div>
  <div class="checkbox">
    <input type="checkbox" id="kelurahanCheckbox" />
    <span>Kelurahan</span>
  </div>

  <script src="https://unpkg.com/jquery"></script>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <script>
    var map = L.map('map').setView([-6.914744, 107.609810], 10);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
      maxZoom: 18
    }).addTo(map);

    var info = L.control();

    info.onAdd = function(map) {
      this._div = L.DomUtil.create('div', 'info');
      this.update();
      return this._div;
    };

    info.update = function(props) {
      this._div.innerHTML = '<h3>Informasi Wilayah</h3>';
      if (props) {
        var content = '';
        if (props.KABUPATEN) {
          content += '<p>Kabupaten: ' + props.KABUPATEN + '</p>';
        }
        if (props.KECAMATAN) {
          content += '<p>Kecamatan: ' + props.KECAMATAN + '</p>';
        }
        if (props.KELURAHAN) {
          content += '<p>Kelurahan: ' + props.KELURAHAN + '</p>';
        }
        this._div.innerHTML += content;
      } else {
        this._div.innerHTML += 'Arahkan mouse ke wilayah';
      }
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
        fillOpacity: 0.6
      });

      if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
        layer.bringToFront();
      }

      info.update(layer.feature.properties);
    }

    function resetHighlight(e) {
      geojson.resetStyle(e.target);
      info.update();
      uncheckCurrentCheckbox();
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

    function onEachFeature(feature, layer) {
      layer.on({
        mouseover: highlightFeature,
        mouseout: resetHighlight,
        click: zoomToFeature
      });
    }

    function addGeoJsonLayer(url, checkbox) {
      $.getJSON(url, function(data) {
        if (currentLayer === checkbox) {
          map.removeLayer(geojson); // Hapus layer sebelumnya jika ada
          currentLayer.checked = false; // Tandai checkbox sebelumnya menjadi tidak tercentang
          currentLayer.nextElementSibling.classList.remove('checked');
          currentLayer = null; // Set currentLayer menjadi null
        }

        geojson = L.geoJson(data, {
          style: function(feature) {
            var color = feature.properties.color; // Ambil nilai warna dari properti "color"
            return {
              fillColor: color, // Menggunakan nilai warna jika tersedia, jika tidak, gunakan warna default (misalnya, 'blue')
              fillOpacity: 0.5,
              color: color,
              weight: 2
            };
          },
          onEachFeature: onEachFeature
        }).addTo(map);

        currentLayer = checkbox; // Perbarui nilai currentLayer
        currentLayer.checked = true; // Tandai checkbox saat ini menjadi tercentang
        currentLayer.nextElementSibling.classList.add('checked');
      });
    }

    var checkbox1 = document.getElementById('bandungCheckbox');
    checkbox1.addEventListener('change', function() {
      if (this.checked) {
        uncheckOtherCheckboxes(checkbox1);
        addGeoJsonLayer("geojson/ADMINISTRASI_PROVINSI.geojson", checkbox1);
      } else {
        closeCheckbox(checkbox1);
      }
    });

    var checkbox2 = document.getElementById('kewilayahanCheckbox');
    checkbox2.addEventListener('change', function() {
      if (this.checked) {
        uncheckOtherCheckboxes(checkbox2);
        addGeoJsonLayer("geojson/ADMINISTRASI_KOTACILEGON.geojson", checkbox2);
      } else {
        closeCheckbox(checkbox2);
      }
    });

    var checkbox3 = document.getElementById('kecamatanCheckbox');
    checkbox3.addEventListener('change', function() {
      if (this.checked) {
        uncheckOtherCheckboxes(checkbox3);
        addGeoJsonLayer("geojson/ADMINISTRASI_KABUPATENKOTA.geojson", checkbox3);
      } else {
        closeCheckbox(checkbox3);
      }
    });

    var checkbox5 = document.getElementById('kelurahanCheckbox');
    checkbox5.addEventListener('change', function() {
      if (this.checked) {
        uncheckOtherCheckboxes(checkbox5);
        addGeoJsonLayer("geojson/ADMINISTRASI_KELURAHAN.geojson", checkbox5);
      } else {
        closeCheckbox(checkbox5);
      }
    });

    function uncheckOtherCheckboxes(checkbox) {
      var checkboxes = document.querySelectorAll('.checkbox');
      checkboxes.forEach(function(cb) {
        if (cb !== checkbox && cb.checked) {
          cb.checked = false;
          closeCheckbox(cb);
        }
      });
    }

    function closeCheckbox(checkbox) {
      checkbox.checked = false;
      // Tambahkan kelas 'checked' ke elemen berikutnya jika ada
      if (checkbox.nextElementSibling) {
        checkbox.nextElementSibling.classList.remove('checked');
      }
      // Hapus layer jika checkbox ditutup
      if (currentLayer === checkbox) {
        map.removeLayer(geojson);
        currentLayer = null;
      }
    }

    function onCheckboxClicked(checkbox) {
      if (checkbox.checked) {
        switch (checkbox) {
          case checkbox1:
            addGeoJsonLayer('geojson/ADMINISTRASI_PROVINSI.geojson', checkbox1);
            break;
          case checkbox2:
            addGeoJsonLayer('geojson/ADMINISTRASI_KOTACILEGON.geojson', checkbox2);
            break;
          case checkbox3:
            addGeoJsonLayer('geojson/ADMINISTRASI_KABUPATENKOTA.geojson', checkbox3);
            break;
          case checkbox5:
            addGeoJsonLayer('geojson/ADMINISTRASI_KELURAHAN.geojson', checkbox5);
            break;
          default:
            break;
        }
        uncheckOtherCheckboxes(checkbox);
      } else {
        closeCheckbox(checkbox);
      }
    }

    checkbox1.addEventListener('click', function() {
      onCheckboxClicked(checkbox1);
    });

    checkbox2.addEventListener('click', function() {
      onCheckboxClicked(checkbox2);
    });

    checkbox3.addEventListener('click', function() {
      onCheckboxClicked(checkbox3);
    });

    checkbox5.addEventListener('click', function() {
      onCheckboxClicked(checkbox5);
    });
  </script>
</body>
</html>
