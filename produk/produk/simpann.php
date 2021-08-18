<?php
include 'koneksi.php';
if (isset($_POST['keranjang'])) {
    $id_produk = $_POST['id_produk'];
    $jmlh_produk = $_POST['jmlh_produk'];
    $harga = $_POST['harga'];

    $sql = "INSERT INTO keranjang (id_produk,jmlh_produk,harga) VALUES ('$id_produk','$jmlh_produk','$harga')";

    $query = mysqli_query ($connect, $sql);

    if($query) {
        header('Location: tampilanprodukk.php');
    }else{
        header('Location : simpann.php?status=gagal');
    }
}
?>

<?php
if (!empty($_GET['transaksi'])) {
    $diskon = $_POST['discount'];
    $tax = $_POST['tax'];
    $total_harga = $_POST['total_harga'];

    $sql = "INSERT INTO transaksi (discount,tax, total_harga)
        VALUES ('$diskon','$tax', '$total_harga')";

    $query = mysqli_query($connect, $sql);

    if ($query) {
        header('Location: tampilanprodukk.php');
    } else {
        header('Location: simpann.php?status=gagal');
    }
}
?>