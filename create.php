<!DOCTYPE html>
<html>
<head>
    <title>Form Pendataan Peminjaman Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    include "koneksi.php";

    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nama=input($_POST["nama"]);
        $alamat=input($_POST["sekolah"]);
        $nm_buku=input($_POST["nm_buku"]);
        $jns_buku=input($_POST["jns_buku"]);
        $petugas=input($_POST["petugas"]);

        $sql="insert into peserta (nama,alamat,nm_buku,jns_buku,petugas) values
		('$nama','$alamat','$nm_buku','$jns_buku','$petugas')";

        $hasil=mysqli_query($kon,$sql);

        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }
    ?>
    <h2>Input Data</h2>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required />

        </div>
        <div class="form-group">
            <label>Alamat:</label>
            <input type="text" name="alamat" class="form-control" placeholder="Masukan Alamat Anda" required/>
        </div>
       <div class="form-group">
            <label>Nama Buku :</label>
            <input type="text" name="nm_buku" class="form-control" placeholder="Masukan Nama Buku" required/>
        </div>
                </p>
        <div class="form-group">
            <label>Jenis Buku:</label>
            <input type="text" name="jns_buku" class="form-control" placeholder="Masukan Jenis Buku" required/>
        </div>
        <div class="form-group">
            <label>petugas:</label>
            <textarea name="petugas" class="form-control" rows="5"placeholder="Masukan Petugas" required></textarea>
        </div>       

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>