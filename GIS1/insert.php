<?php
require 'functions.php';
$conn = connected();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="icon" href="assets/cilegon.png">
    <title>GIS | Cilegon</title>

</head>

<body>
    <div class="container w-50 mt-5">
        <form action="" method="post" class="">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama wilayah</label>
                <input type="email" class="form-control" name="nama" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">File GeoJson</label>
                <input type="file" class="form-control" name="file">
            </div>
            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
    </div>
</body>

</html>