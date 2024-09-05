<?php
$server = 'sql303.infinityfree.com'; 
$dbName = 'if0_37244445_db_adopsi_hewan'; 
$username = 'if0_37244445'; 
$password = 'adopsihewan283'; 
$conn = mysqli_connect($server, $username, $password, $dbName);

if (!$conn) {
    die(json_encode(["success" => false, "message" => "koneksi Gagal: " . mysqli_connect_error()]));
}
?>
