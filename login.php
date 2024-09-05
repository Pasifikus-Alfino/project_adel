<?php
include "koneksi.php";
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validasi input
    if (empty($email) || empty($password)) {
        $response['status'] = 'invalid';
        $response['pesan'] = 'Data tidak lengkap';
        http_response_code(400);
        echo json_encode($response);
        exit;
    }

    // Menghindari SQL Injection (sederhana, tetapi tidak sepenuhnya aman)
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Query login
    $query = "SELECT * FROM tbl_pengguna WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $response['status'] = 'success';
        $response['pesan'] = 'Login berhasil';
        $response['level'] = $user['level'];
        $response['id'] = $user['id_pengguna'];
        $response['nama'] = $user['nama'];
        $response['email'] = $user['email'];
        http_response_code(200);
    } else {
        $response['status'] = 'failed';
        $response['pesan'] = 'Akun belum terdaftar';
        http_response_code(400);
    }

    mysqli_close($conn);
    echo json_encode($response);
}
?>
