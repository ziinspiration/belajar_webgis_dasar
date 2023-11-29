<?php
// CONNECT TO DBMS
function connected()
{
    $conn = mysqli_connect("localhost", "root", "", "bandung_gis");

    return $conn;
}

// ARRAY QUERY
function query($sql)
{
    $conn = connected();
    $result = mysqli_query($conn, "$sql");
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
