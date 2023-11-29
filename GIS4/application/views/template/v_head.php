<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GIS Leaflet : <?= $title; ?></title>
    <!-- BOOTSTRAP STYLES-->
    <link href="<?= base_url() ?>template/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="<?= base_url() ?>template/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="<?= base_url() ?>template/assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- LEAFLET -->
    <link rel="stylesheet" href="<?= base_url() ?>leaflet/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="<?= base_url() ?>leaflet/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <!-- JQUERY SCRIPTS -->
    <script src="<?= base_url() ?>template/assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="<?= base_url() ?>template/assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="<?= base_url() ?>template/assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="<?= base_url() ?>template/assets/js/custom.js"></script>
    <!-- PLUGIN MARKER CLUSTER -->
    <link rel="stylesheet" href="<?= base_url() ?>cluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="<?= base_url() ?>cluster/dist/MarkerCluster.Default.css" />
    <script src="<?= base_url() ?>cluster/dist/leaflet.markercluster-src.js"></script>
    <!-- PLUGIN HEATMAP -->
    <script src="<?= base_url() ?>heat-map/dist/leaflet-heat.js"></script>
    <!-- PLUGIN CONTROL SEARCH -->
    <script src="<?= base_url() ?>/leaflet-search/dist/leaflet-search.src.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>leaflet-search/src/leaflet-search.css" />
</head>