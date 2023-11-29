<?php
defined('BASEPATH') or exit('No direct script access allowe');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_tps');
        $this->load->model('m_provinsi');
    }

    public function upload_shp_form()
    {
        $this->load->view('upload_shp_form');
    }


    public function index()
    {
        $data = array(
            'title' => "View Map",
            'isi' => "v_home"
        );
        $this->load->view('template/v_wrapper', $data, FALSE);
    }

    public function marker()
    {
        $data = array(
            'title' => "Marker",
            'isi' => "v_marker"
        );
        $this->load->view('template/v_wrapper', $data, FALSE);
    }

    public function polyline()
    {
        $data = array(
            'title' => "Polyline",
            'isi' => "v_polyline"
        );
        $this->load->view('template/v_wrapper', $data, FALSE);
    }

    public function rute()
    {
        $data = array(
            'title' => "Rute",
            'isi' => "v_rute"
        );
        $this->load->view('template/v_wrapper', $data, FALSE);
    }

    public function polygone()
    {
        $data = array(
            'title' => "Polygone",
            'isi' => "v_polygone"
        );
        $this->load->view('template/v_wrapper', $data, FALSE);
    }

    public function circle()
    {
        $data = array(
            'title' => "Circle",
            'isi' => "v_circle"
        );
        $this->load->view('template/v_wrapper', $data, FALSE);
    }

    public function getcoordinat()
    {
        $data = array(
            'title' => "Get coordinat",
            'isi' => "v_getcoordinat"
        );
        $this->load->view('template/v_wrapper', $data, FALSE);
    }

    public function tps()
    {
        $data = array(
            'title' => "Pemetaan lokasi TPS Marker",
            'tps' => $this->m_tps->get_all_data(),
            'isi' => "tps/v_pemetaan_tps"
        );
        $this->load->view('template/v_wrapper', $data, FALSE);
    }

    public function tps2()
    {
        $data = array(
            'title' => "Pemetaan lokasi TPS Circle",
            'tps' => $this->m_tps->get_all_data(),
            'isi' => "tps/v_pemetaan_tps2"
        );
        $this->load->view('template/v_wrapper', $data, FALSE);
    }

    public function cluster()
    {
        $data = array(
            'title' => "Pemetaan lokasi TPS Cluster Marker",
            'tps' => $this->m_tps->get_all_data(),
            'isi' => "v_cluster"
        );
        $this->load->view('template/v_wrapper', $data, FALSE);
    }

    public function tps3()
    {
        $data = array(
            'title' => "Pemetaan lokasi TPS Heat Map",
            'tps' => $this->m_tps->get_all_data(),
            'isi' => "tps/v_pemetaan_tps3"
        );
        $this->load->view('template/v_wrapper', $data, FALSE);
    }

    public function tps4()
    {
        $data = array(
            'title' => "Pemetaan lokasi TPS Control Search",
            'tps' => $this->m_tps->get_all_data(),
            'isi' => "tps/v_pemetaan_tps4"
        );
        $this->load->view('template/v_wrapper', $data, FALSE);
    }

    public function geojson()
    {
        $data = array(
            'title' => "GeoJSON(Polygon)",
            'isi' => "v_geojson"
        );
        $this->load->view('template/v_wrapper', $data, FALSE);
    }

    public function provinsi()
    {
        $data = array(
            'title' => "GeoJSON(Polygon) 34 Provinsi",
            'prov' => $this->m_provinsi->all_data(),
            'isi' => "v_provinsi"
        );
        $this->load->view('template/v_wrapper', $data, FALSE);
    }

    public function upGeojson()
    {
        $data = array(
            'title' => "Upload GeoJSON",
            'isi' => "upload_shp_form"
        );
        $this->load->view('template/v_wrapper', $data);
    }

    public function upload_shp()
    {
        // Memeriksa apakah ada file SHP yang diunggah
        if (!empty($_FILES['shp_file']['name'])) {
            // Mendapatkan file SHP yang diunggah melalui form input
            $uploadedFile = $_FILES['shp_file']['tmp_name'];

            // Tentukan lokasi dan nama file GeoJSON yang dihasilkan
            $geojsonFileName = $_FILES['shp_file']['name'];
            $geojsonFile = FCPATH . 'geojson/' . $geojsonFileName . '.geojson';

            // Konversi SHP ke GeoJSON
            $conversionStatus = $this->convertToGeoJSON($uploadedFile, $geojsonFile);

            // Jika konversi berhasil, simpan informasi file ke database
            if ($conversionStatus) {
                // Mendapatkan data dari form input
                $namaProvinsi = $this->input->post('nama_provinsi');
                $warna = $this->input->post('warna');

                // Simpan informasi file ke database
                $data = array(
                    'nama_provinsi' => $namaProvinsi,
                    'warna' => $warna,
                    'file_geojson' => $geojsonFileName
                );
                $this->db->insert('provinsi', $data);

                echo "File SHP berhasil dikonversi dan disimpan sebagai GeoJSON, dan data provinsi berhasil disimpan di database.";
            } else {
                echo "Konversi SHP ke GeoJSON gagal.";
            }
        }
    }

    public function convertToGeoJSON($uploadedFile, $geojsonFile)
    {
        // Perintah ogr2ogr untuk mengonversi SHP menjadi GeoJSON
        $command = "ogr2ogr -f GeoJSON {$geojsonFile} {$uploadedFile}";

        // Menjalankan perintah menggunakan fungsi exec() atau shell_exec()
        $output = shell_exec($command);

        // Mengembalikan status konversi
        return file_exists($geojsonFile);
    }
}
