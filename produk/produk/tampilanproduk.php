<?php
include 'koneksi.php';
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  

  <title>Document</title>
  <style>

    #row2 {
      width: 60%;
      margin-top: -150px;
    }

    .card {
      line-height: 10px;
      margin-bottom: -130px;
      margin-left:100px;
    }

    .navbar{
      background-color: red;
    }

    .navbar a{
      text-decoration: none;
      color : white;
      font-weight: lighter;
    }
  </style>

</head>

<body>


  <nav class="navbar  mb-3">
    <a class="navbar-brand"><b>Starbhak Mart</b></a>
    <form class="form-inline">
      <button type="button" class="btn btn-transparent mr-3"><a href="produk.html">Tambah data</button></a>
      <button type="button" class="btn btn-transparent"><a href="tampilanprodukk.php">User</button></a>
    </form>
  </nav>

  <div class="container-fluid">
    <div class="row">


      <div class="col-4" style="margin-right:100px;">
      <div class="btn btn-dark text-center" style="width: 100%; height:50px; margin-bottom:10px; padding-top: 10px;"> Admin  </div>
<div class="judulist bg-dark rounded text-center text-white" style="height: 45px; margin-top: 10px; padding-top: 10px;">Payment Details</div>
            <table class="table table-dark text-center mt-1">
            <thead>
                <tr>
                    <th scope="col">Id </th>
                    <th scope="col">Discount</th>
                    <th scope="col">Tax</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $sql = "SELECT * FROM transaksi";
                $query = mysqli_query($connect, $sql);

                while ($transaksi = mysqli_fetch_array($query)) {
                    echo "<tr>";
                    echo "<td class='bg-white border border-dark pl-1 pt-1 m-1' style='color: black;'> " . $transaksi['id_transaksi'] . "</td>";
                    echo "<td class='bg-white border border-dark pl-1 pt-1 m-1' style='color: black;'> Rp. " . number_format($transaksi['discount']) . "</td>";
                    echo "<td class='bg-white border border-dark pl-1 pt-1 m-1' style='color: black;'> Rp. " . number_format($transaksi['tax']) . "</td>";
                    echo "<td class='bg-white border border-dark pl-1 pt-1 m-1' style='color: black;'> Rp. " . number_format($transaksi['total_harga']) . "</td>";
                    // echo "<a class='btn btn-success' href='formedit.php?kode_produk=" . $produk['kode_produk'] . "'>edit</a> | ";
                    echo "<td class='bg-white border border-dark'>";
                    echo '<form action="hapuss.php?transaksi=hapuss&id_transaksi=' . $transaksi['id_transaksi'] . '" method="POST">';
                    echo "<button type='submit' class='btn btn-danger'>Delete</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        
      </div>

      <div class="row" id="row2">


            <?php
    $sql = "SELECT*FROM produk";
    $query = mysqli_query($connect,$sql);
    while($pro = mysqli_fetch_array($query)){
  
        echo "<div class='card' id='card' style='width: 12rem; height: 375px; margin-left: 5px; margin-top:150px; border-radius:25px; box-shadow: 0 15px 35px;'>";
        echo "<img src='" . $pro['gambar_produk'] ."' class='card-img-top'; style='width: 100%; height: 170px; border-radius: 25px;'>";
        echo "<div class='card-body'>";
        echo "<h6 class='card-title text-center'>".$pro['nama_produk']."</h6>";
        echo "<p class='card-text text-center'>Rp. " .number_format($pro['harga_produk'])."</p>";
        echo "<a href= 'formedit.php?id_produk=".$pro ['id_produk']."' style='width:100px; border-radius: 30px;' class='btn btn-warning ml-4 mb-2'> Edit</a>";
        echo "<a href= 'hapus.php?id_produk=".$pro ['id_produk']."' style='width:100px; border-radius: 30px;'class='btn btn-danger ml-4 ' >Hapus</a>";
        echo "</div>";
        echo "</div>";
    } 
    ?>
      </div>
    </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>

