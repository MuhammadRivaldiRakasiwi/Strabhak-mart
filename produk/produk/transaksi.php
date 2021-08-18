<?php
include 'koneksi.php';
if (!empty($_GET['transaksi'])){
    $discount = $_POST['discount'];
    $tax = $_POST['tax'];
    $total_harga = $_POST['total_harga'];
    $my_arr = unserialize($_GET['transaksi']);

    // Insert data ke table Transaksi
    $insertTransaksi = "INSERT INTO transaksi (discount, tax, total_harga, status_transaksi) VALUES ('$discount', '$tax', '$total_harga', ".TRUE.")";
    $query = mysqli_query($connect, $insertTransaksi);
    // Mengambil ID dari table Transaksi
    $idTransaksi = mysqli_insert_id($connect); 

    foreach($my_arr as $value){
        // Me-looping data
        $id_produk = $value["id_produk"];
        $jmlh_produk = $value["jmlh_produk"];
        $harga = $value["harga"];
        
        // Insert data ke table transaksi_detail
        $insertTransaksiDetail = "INSERT INTO transaksi_detail (id_produk, id_transaksi, nama_produk, harga_produk, quantity, total_bayar) VALUES ('$id_produk', '$idTransaksi', '$nama_produk','$harga_produk', '$quantity', '$jumlah_harga')";
        $result = mysqli_query($connect, $insertTransaksiDetail);
    }
    if($query){
        header('Location: tampildata.php');
        $insertTransaksi = "TRUNCATE TABLE keranjang;";
        $query = mysqli_query($connect, $insertTransaksi);
    }else{
        header('Location: transaksi.php?status=gagal');
    }
}
?>