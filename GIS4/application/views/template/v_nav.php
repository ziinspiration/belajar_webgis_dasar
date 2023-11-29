<!-- /. NAV TOP  -->
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center">
                <img src="<?= base_url() ?>template/assets/img/find_user.png" class="user-image img-responsive" />
            </li>
            <li>
                <a href="<?= base_url('home') ?>"><i class="fa fa-globe"></i> View Map</a>
            </li>
            <li>
                <a href="<?= base_url('home/marker') ?>"><i class="fa fa-map-marker"></i> Marker</a>
            </li>
            <li>
                <a href="<?= base_url('home/polyline') ?>"><i class="fa fa-line-chart"></i> Polyline</a>
            </li>
            <li>
                <a href="<?= base_url('home/rute') ?>"><i class="fa fa-line-chart"></i> Rute</a>
            </li>
            <li>
                <a href="<?= base_url('home/polygone') ?>"><i class="fa fa-line-chart"></i> Polygone</a>
            </li>
            <li>
                <a href="<?= base_url('home/circle') ?>"><i class="fa fa-circle"></i> Circle</a>
            </li>
            <li>
                <a href="<?= base_url('home/getcoordinat') ?>"><i class="fa fa-map-marker"></i> Get coordinat</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-map-marker "></i> Marker, Circle, Cluster, Heatmaps, Polygone<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?= base_url('home/tps') ?>">Pemetaan lokasi TPS Marker</a>
                    </li>
                    <li>
                        <a href="<?= base_url('home/tps2') ?>">Pemetaan lokasi TPS Circle</a>
                    </li>
                    <li>
                        <a href="<?= base_url('home/cluster') ?>">Pemetaan lokasi TPS Cluster Marker</a>
                    </li>
                    <li>
                        <a href="<?= base_url('home/tps3') ?>">Pemetaan lokasi TPS Heatmaps</a>
                    </li>
                    <li>
                        <a href="<?= base_url('home/tps4') ?>">Pemetaan lokasi TPS Search control</a>
                    </li>
                    <li>
                        <a href="<?= base_url('home/geojson') ?>">GeoJSON</a>
                    </li>
                    <li>
                        <a href="<?= base_url('home/provinsi') ?>">Polygone 34 Provinsi</a>
                    </li>
                    <li>
                        <a href="<?= base_url('home/upGeojson') ?>">Upload</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<!-- /. NAV SIDE  -->
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2><?= $title; ?></h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />