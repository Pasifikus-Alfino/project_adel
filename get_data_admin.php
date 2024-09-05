<?php
include 'koneksi.php';

$query = mysqli_query($conn, "
    SELECT 
        p.*, 
        GROUP_CONCAT(g.url_gambar) as gambar,
        u.nama as nama_pemilik
    FROM 
        tbl_postingan p
    LEFT JOIN 
        tbl_detail_gambar g 
    ON 
        p.id_posting = g.id_posting 
    LEFT JOIN
        tbl_pengguna u
    ON
        p.id_pemilik = u.id_pengguna
    WHERE 
        p.status = 'Menunggu' 
    GROUP BY 
        p.id_posting, u.nama
    ORDER BY 
        p.id_posting DESC
");

if (!$query) {
    die("Query gagal: " . mysqli_error($conn));
}

$result = mysqli_fetch_all($query, MYSQLI_ASSOC);

foreach ($result as &$row) {
    $row['gambar'] = explode(',', $row['gambar']);
}

echo json_encode($result);
?>
