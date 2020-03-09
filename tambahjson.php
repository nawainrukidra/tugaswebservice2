<?php

error_reporting(0);
$conn = new mysqli('localhost', 'id12777865_web', 'brangsong', 'id12777865_web');
 
if(!$conn){
    echo json_encode(['status' => 0, 'msg' => 'Koneksi Error Gan!!']);
    exit();
}
 
if($_POST['show'] == 1){
    $jalan = $_POST['jalan'];
    $jumlah = $_POST['jumlah'];
    $cek_ = mysqli_query($conn, "SELECT * FROM kendaraan WHERE jalan='$jalan'");
    $cek = mysqli_num_rows($cek_);
    if(!$cek){
        $insert = mysqli_query($conn, "INSERT INTO kendaraan (jalan, jumlah) VALUES ('$jalan', '$jumlah')");
        if($insert){
            echo json_encode(['status' => 1, 'msg' => 'Data Berhasil di Masukkan.']);
            exit();
        }else{
            echo json_encode(['status' => 0, 'msg' => 'Data Tidak masuk.']);
            exit();
        }
    }else{
        echo json_encode(['status' => 0, 'msg' => 'Data Sudah Ada.']);
        exit();
    }
}else if($_POST['show'] == 2){
    $get_data = mysqli_query($conn, "SELECT * FROM kendaraan ORDER BY id");
    $datas = [];
    while($post = mysqli_fetch_array($get_data)){
        $datas[] = $post;
    }
    echo json_encode(['status' => 1, 'data' => $datas]);
        exit();
}
 
echo json_encode(['status' => 0, 'msg' => 'Error.']);
    exit();