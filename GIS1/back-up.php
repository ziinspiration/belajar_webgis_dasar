var markers = [];

<?php foreach ($tampilTps as $tps) : ?>
    var marker = L.marker([<?= $tps['latitude']; ?>, <?= $tps['longitude']; ?>]);
    marker.bindPopup(
    "<b>Nama TPS: <?= $tps['nama_tps']; ?></b><br>Kecamatan: <?= $tps['kecamatan']; ?><br>Wilayah: <?= $tps['wilayah']; ?>"
    );
    markers.push(marker);
    map.removeLayer(marker); // Menghapus marker dari peta saat awalnya
<?php endforeach; ?>

tpsCheckbox.addEventListener('click', function() {
if (tpsCheckbox.checked) {
showMarkers(); // Menampilkan marker TPS
} else {
hideMarkers(); // Menyembunyikan marker TPS
}
});


function showMarkers() {
for (var i = 0; i < markers.length; i++) { map.addLayer(markers[i]); } } function hideMarkers() { for (var i=0; i < markers.length; i++) { map.removeLayer(markers[i]); } }




var info1 = L.control();

info1.onAdd = function(map) {
    this._div = L.DomUtil.create('div', 'info');
    this.update();
    return this._div;
};

info1.update = function(props2) {
    this._div.innerHTML = '<h3>Informasi Prasarana</h3>' + (props ?
        (props2.JENIS ? '<p>Jenis jalan : ' + props.JENIS + '</p>' : '') +
        (props2.FUNGSI ? '<p>Fungsi : ' + props.FUNGSI + '</p>' : '') :
        'Arahkan mouse ke wilayah');
};

info1.addTo(map);

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

    info1.update(layer.feature.properties);
}

function resetHighlight(e) {
    geojson.resetStyle(e.target);
    info1.update();
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

        geojson = L.geoJSON(data, {
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


var checkboxP1 = document.getElementById('jalanCheckbox');
checkboxP1.addEventListener('change', function() {
    if (this.checked) {
        uncheckOtherCheckboxes(checkboxP1);
        addGeoJsonLayer("geojson/JARINGAN_JALAN.geojson", checkboxP1);
    } else {
        closeCheckbox(checkboxP1);
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