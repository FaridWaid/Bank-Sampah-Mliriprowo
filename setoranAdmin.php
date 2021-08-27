<?php 
session_start();
require 'functions.php';

if ( !isset($_SESSION["login"]) ){
	echo "<script>
			alert('Anda Harus Login Terlebih Dahulu!');
      document.location.href ='login.php';
		</script>";
}

$id = $_SESSION["IdAdmin"];
$biodata = query("SELECT * FROM admins WHERE IdAdmin = '$id'")[0];
$setoran = query("SELECT * FROM setoran ORDER BY idSetor ASC");

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Data Setoran</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/manual/styleuser.css">
    <link rel="stylesheet" type="text/css" href="css/datatables/CSS/jquery.dataTables.css">
    <script src="js/manual/preloader.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>
    $(document).ready(function() {
      $(".preloader").fadeOut();
    })
    </script>

  </head>
  <body>

    <!--Pre Loader-->
    <div class="preloader">
        <div class="loading">
        <img src="img/aset/loading.gif" width="80">
        </div>
    </div>

    <div class="sidebar">
			<ul>
        <li>
          <a href="admin.php" style="text-align: center; padding: 30px 0 30px 0; font-size: 20px;">Welcome, <br><?php echo $biodata["namaAdmin"]; ?> </a>
				</li>

				<li>
					<a href="pengguna.php"><span class="fas fa-users" aria-hidden="true"></span>Data Pengguna</a>
				</li>		
				 	
				<li>
					<a href="sampahAdmin.php"><span class="fas fa-trash" aria-hidden="true"></span>Data Sampah</a>
				</li>
				
				<li>
					<a href="setoranAdmin.php"><span class="fas fa-trash-restore-alt" aria-hidden="true"></span>Data Setoran</a>
				</li>

        <li>
					<a href="penarikanAdmin.php"><span class="fas fa-hand-holding-usd" aria-hidden="true"></span>Data Penarikan</a>
				</li>

        <li>
					<a href="penjualanAdmin.php"><span class="fas fa-dollar-sign" aria-hidden="true"></span>Data Penjualan</a>
				</li>

        <li>
					<a href="beritaAdmin.php"><span class="far fa-newspaper" aria-hidden="true"></span>Data Berita</a>
				</li>

				<li>
					<a href="monitoringAdmin.php"><span class="fas fa-chart-bar" aria-hidden="true"></span>Grafik Monitoring</a>
				</li>

				<li>
					<a href="logout.php"><span class="fas fa-sign-out-alt" aria-hidden="true"></span>Logout</a>
				</li>

                <br><br><br><br><br>
                <img src="img/logo/logo.png" style="width:75%" class="ms-4" alt="">
                <p class="text-center text-warning">Bank Sampah Mliriprowo</p>

			</ul>
		</div>
    <div class="box-1 text-center">
        <h2 style="font-size: 30px; color: #262626;">Daftar Setoran Pengguna</h2>
        <div class="card">
          <div class="card-body">
        
          <table id="example" class="display" cellspacing="0" width="100%" border="0" >
            <thead>
            <tr>
                <th>No</th>
                <th>ID Setoran</th>
                <th>Tanggal Setoran</th>
                <th>Nama Penyetor</th>
                <th>Nama Sampah</th>
                <th>Berat</th>
                <th>Harga/KG</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
					  <?php foreach ( $setoran as $row)  : ?>
            <?php $kode = $row["idUser"] ?>
            <?php $namaUser = query("SELECT namaUser FROM users WHERE idUser = '$kode' "); ?>
            <?php $kode2 = $row["idSampah"] ?>
            <?php $namaSampah = query("SELECT namaSampah,harga FROM sampah WHERE idSampah = '$kode2' "); ?>
            <tr align="center">
                <td><?php echo $i; ?></td>
                <td><?php echo $row['idSetor'] ?></td>
                <td><?php echo $row['tglSetor'] ?></td>
                <?php foreach ( $namaUser as $user)  : ?>
                <td><?php echo $user['namaUser']; ?></td>
                <?php endforeach; ?>
                <?php foreach ( $namaSampah as $sampah)  : ?>
                <td><?php echo $sampah['namaSampah']; ?></td>
                
                <td><?php echo $row['berat']." KG" ?></td>
                <td><?php echo "Rp. ".number_format($sampah['harga'], 2, ",", ".") ?></td>
                <td><?php echo "Rp. ".number_format(($row['total']), 2, ",", ".") ?></td>
                <?php endforeach; ?>
                <td>
                    <a href="editSetoran.php?idSetoran=<?php echo $row["idSetor"]; ?>">
                    <button class="btn_edit"><i class="fa fa-pencil"></i>Edit</button> 
                    </a>
                    
                    <a onclick="return confirm('Anda yakin ingin menghapus data ini?')" href="hapusSetoran.php?action=delete&id=<?php echo $row["idSetor"]; ?>">
                    <button class="btn_hapus"><i class="fa fa-trash-o"></i>Hapus</button>
                    </a>
                </td>
            </tr>
            <?php $i++; ?>
					  <?php endforeach; ?>
            </tbody>
          </table>
          <br>
          <br>
          
          <a href="tambahSetoran.php">
          <button class="tambah"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</button>
          </a>
          <script type="text/javascript" src="css/datatables/js/jquery.min.js"></script>
          <script type="text/javascript" src="css/datatables/js/jquery.dataTables.min.js"></script>
          <script>
              $(document).ready(function() {
                $('#example').DataTable();
              } );
          </script>
          </div>
      </div>
		</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>