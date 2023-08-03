<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Anggota</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <?php

    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id_peminjam
    if (isset($_GET['id_peminjam'])) {
        $id_peminjam=input($_GET["id_peminjam"]);

        $sql="select * from peserta where id_peminjam=$id_peminjam";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);


    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_peminjam=htmlspecialchars($_POST["id_peminjam"]);
        $nama=input($_POST["nama"]);
        $alamat=input($_POST["alamat"]);
        $nm_buku=input($_POST["nm_buku"]);
        $jns_buku=input($_POST["jns_buku"]);
        $petugas=input($_POST["petugas"]);

        //Query update data pada tabel anggota
        $sql="update peserta set
			nama='$nama',
			alamat='$alamat',
			nm_buku='$nm_buku',
			jns_buku='$jns_buku',
			petugas='$alamat'
			where id_peminjam=$id_peminjam";

        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }

    ?>
    <h2>Update Data</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
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
        <div class="form-group">
            <label>Jenis Buku:</label>
            <input type="text" name="jns_buku" class="form-control" placeholder="Masukan Jenis Buku" required/>
        </div>
        <div class="form-group">
            <label>petugas:</label>
            <textarea name="petugas" class="form-control" rows="5"placeholder="Masukan Petugas" required></textarea>
        </div>    

        <input type="hidden" name="id_peminjam" value="<?php echo $data['id_peminjam']; ?>" />

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>