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
  <link rel="stylesheet" href="style.css">

  <title>Starbhak Mart</title>

</head>

<body>

<!-- Navbar -->
  <nav class="navbar mb-3">
    <a class="navbar-brand"><b>Starbhak Mart</b></a>
    <a href="tampilanproduk.php">Admin</a>
  </nav>
<!-- nav end -->
  <div class="container-fluid">
    <div class="row">


      <div class="col-4" style="margin-right:100px;">
  
        <div class="judulist bg-dark rounded text-center text-white pt-3">Cart Items</div>
        <div class="listkeranjang" id=listkeranjang>
                  <?php
                      $sql = "SELECT keranjang.*, produk.* FROM keranjang LEFT JOIN produk ON produk.id_produk=keranjang.id_produk";
                      $query = mysqli_query($connect, $sql);
                      while ($keranjang = mysqli_fetch_array($query)) {
                          echo '<div class="invoice bg-white border border-dark pl-1 pt-1 m-1">';
                          echo '<div class="row">';
                          echo '<div class="col-5">';
                          echo '<h5>' . $keranjang['nama_produk'] . '</h5>';
                          
                          echo '<p>Price : <span class="font-fira">Rp.'  . number_format($keranjang['harga']) .  '</span></p>';
                          echo '</div>';
                          echo '<div class="col-4">';

                          echo '</div>';
                          echo '<div class="col-3">';
                          echo '<a href="hapuss.php?keranjang=hapus&id_keranjang=' . $keranjang['id_keranjang'] . '"><button class="btn btn-danger btn-sm mt-2 ">';
                          echo 'Hapus</button></a>';

                          echo '</div>';
                          echo '</div>';
                          echo '</div>';
                      }
                    ?>
                </div>

                <?php
                $discount = 0;
                $pajak = 0;
                $hargatotal = 0;
                $totalbayar = 0;
                $totalbelanja = 0;

                $sql = "SELECT harga FROM `keranjang`";
                $query = mysqli_query($connect, $sql);

                while ($keranjang = $query->fetch_assoc()) {
                    $harga = $keranjang['harga'];
                    $hargatotal = $harga + $hargatotal;
                    // $totalbayar = $hargatotal;

                    if ($hargatotal >= 100000) {
                        $discount = $hargatotal * 0.15;
                    } else {
                        $discount = 0;
                    }

                    $totalbayar = $hargatotal - $discount;
                    $pajak = $totalbayar * 0.01;

                    $totalbelanja = $totalbayar + $pajak;
                }
                ?>

          
          <table width="100%">
            <tbody>
              <tr>
                <td>Discount (15%)</td>
                <td>Rp.<span id="discount">
                  <?php
                  echo number_format($discount);
                  ?>
                </span>
                </td>
              </tr>
              <tr>
                <td>Tax (1%)</td>
                <td>Rp.<span id="tax">
                  <?php
                  echo number_format($pajak);
                 ?>
                </span>
                </td>
              </tr>
              <tr class="bg-dark text-white">
                <td>Total  </td>
                <td>Rp.<span id="totalbayar">
                   <?php
                  echo number_format($totalbelanja);
                  ?>
                </span>
                </td>
              </tr>
            </tbody>
          </table>

          <form action="simpann.php?transaksi=simpann" method="POST">
                    <input type="hidden" name="discount" value="<?php echo $discount ?>">
                    <input type="hidden" name="tax" value="<?php echo $pajak ?>">
                    <input type="hidden" name="total_harga" value="<?php echo $totalbelanja ?>">
                    <button type="submit" class="btn btn-block btn-success  p-2 mt-2" name="transaksi">
                        <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-clipboard-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                            <path fill-rule="evenodd" d="M9.5 1h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3zm4.354 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                        Payment
                    </button>
            </form>
            <div class="judulist bg-dark rounded text-center text-white pt-3 mt-5">Payment Details</div>
           
                <?php

                $sql = "SELECT * FROM transaksi";
                $query = mysqli_query($connect, $sql);

                while ($transaksi = mysqli_fetch_array($query)) {
                    echo '<div class="invoice bg-white border border-dark pl-1 pt-1 m-1">';
                    echo '<h1 class="float-right" style="margin-right: 50px; font-size: 70px;">' . $transaksi['id_transaksi'] . '</h1>';
                    echo '<p>Discount : <span class="font-fira">Rp.'  . number_format($transaksi['discount']) .  '</span></p>';
                    echo '<p>Tax : <span class="font-fira">Rp.'  . number_format($transaksi['tax']) .  '</span></p>';
                    echo '<p>Total : <span class="font-fira">Rp.'  . number_format($transaksi['total_harga']) .  '</span></p>';
                    // echo "<a class='btn btn-success' href='formedit.php?kode_produk=" . $produk['kode_produk'] . "'>edit</a> | ";
                    echo "</div>";
                }
                ?>


        
      </div>

      <div class="row" id="row2">




      <?php
        $sql = "SELECT*FROM produk";
        $query = mysqli_query($connect,$sql);
        while($pro = mysqli_fetch_array($query)){
        echo '<div class="card col-md-" id="card" style="width: 12rem; height: 350px; margin-left: 5px; margin-top:150px; border-radius:25px;">';
        echo '<img src="' . $pro['gambar_produk'] . '" style="width: 100%; height: 170px; border-radius: 25px;">';
        echo '<div class="card-body">';
        echo '<h6 class="card-title">'.$pro['nama_produk'].'</h6>';
        echo '<p class="card-text"> RP. '. number_format($pro['harga_produk']).'</p>';
        echo '<form action="simpann.php?keranjang=simpann" method="POST">';
        echo '<input class="form-control" type="hidden" id="id_produk" name="id_produk" value="'. $pro['id_produk'] .'">';
        echo '<input class="form-control" type="hidden" id="jmlh_produk" name="jmlh_produk" value="1">';
        echo '<input class="form-control" type="hidden" id="harga" name="harga" value="' . $pro['harga_produk'] . '">';
        echo '<button type="submit" name="keranjang" class="btn btn-danger" style="width: 120px; margin-left: 13px; margin-top: 10px">Order</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        
    } 
      ?>
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