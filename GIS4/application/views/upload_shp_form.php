<!DOCTYPE html>
<html>

<head>
    <title>Upload SHP Form</title>
</head>

<body>
    <h2>Form Upload SHP</h2>
    <?php echo form_open_multipart('home/upload_shp'); ?>
    <label for="shp_file">Pilih file SHP:</label>
    <input type="file" name="shp_file" id="shp_file">
    <br>
    <label for="nama_provinsi">Nama Provinsi:</label>
    <input type="text" name="nama_provinsi" id="nama_provinsi">
    <?php echo form_error('nama_provinsi', '<div style="color:red">', '</div>'); ?>
    <br>
    <label for="warna">Warna:</label>
    <input type="text" name="warna" id="warna">
    <?php echo form_error('warna', '<div style="color:red">', '</div>'); ?>
    <br>
    <input type="submit" value="Upload">
    <?php echo form_close(); ?>
</body>

</html>