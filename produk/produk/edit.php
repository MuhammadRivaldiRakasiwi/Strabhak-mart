<?php
include 'koneksi.php';
if (isset($_POST['simpan'])) {
$id_produk = $_POST['id_produk'];
$nama_produk = $_POST['nama_produk'];
$gambar_produk = $_POST['gambar_produk'];
$harga_produk = $_POST['harga_produk'];
     

    $sql = "UPDATE produk SET nama_produk='$nama_produk', gambar_produk='$gambar_produk' , harga_produk='$harga_produk'
    WHERE id_produk='$id_produk'";
    $query =mysqli_query($connect,$sql);
    if ($query) {
    header('Location: tampilanproduk.php');
    }else{
    header('location: edit.php?status=gagal');
    }
}
?>