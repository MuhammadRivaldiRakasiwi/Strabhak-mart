<?php
include 'koneksi.php';

    $id_produk = $_GET['id_produk'];
    $sql = "SELECT * FROM produk WHERE id_produk = '$id_produk'";
    $query = mysqli_query($connect,$sql);
    $pro = mysqli_fetch_assoc($query);

    if(mysqli_num_rows($query)< 1){
        die("data tidak di temukan...");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>edit produk</title>
    </head>
    <body>
        <h3>form edit produk</h3>
        <form action="edit.php" method="POST">
            <input type="hidden" name="id_produk" value="<?php echo $pro['id_produk']?>"/>
            <p><label>nama produk : <input type="text" name="nama_produk" value="<?php echo $pro['nama_produk']?>"></label></p>
            <p><label>gambar : <input type="url" name="gambar_produk" value="<?php echo $pro['gambar_produk']?>"></label></p>
            <p><label>harga : <input type="text" name="harga_produk" value="<?php echo $pro['harga_produk']?>"></label></p>
            <input type="submit" name="simpan" value="simpan">
        </form>
    </body>
</html>