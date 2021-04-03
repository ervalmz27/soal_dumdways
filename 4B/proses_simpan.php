<?php
// Load file koneksi.php
include "koneksi.php";

// Ambil Data yang Dikirim dari Form
$name = $_POST['name'];
$category_id = $_POST['category'];
$writer_id = $_POST['writer'];
$publication_year = $_POST['publication'];
$img = $_FILES['img']['name'];
$tmp = $_FILES['foto']['tmp_name'];

// Rename nama fotonya dengan menambahkan tanggal dan jam upload
$fotobaru = date('dmYHis').$foto;

// Set path folder tempat menyimpan fotonya
$path = "images/".$fotobaru;

// Proses upload
if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
  // Proses simpan ke Database
  $sql = $pdo->prepare("INSERT INTO dumdways(nama, category_id, writer_id,publication_id , img) VALUES(:nama,:category,:writer,:publication,:img)");
  $sql->bindParam(':nama', $name);
  $sql->bindParam(':category', $category_id);
  $sql->bindParam(':writer', $writer_id);
  $sql->bindParam(':publication', $publication_year);
  $sql->bindParam(':img', $img);
  $sql->execute(); // Eksekusi query insert

  if($sql){ // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    header("location: index.php"); // Redirect ke halaman index.php
  }else{
    // Jika Gagal, Lakukan :
    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
    echo "<br><a href='tambah_form.php'>Kembali Ke Form</a>";
  }
}else{
  // Jika gambar gagal diupload, Lakukan :
  echo "Maaf, Gambar gagal untuk diupload.";
  echo "<br><a href='tambah_form.php'>Kembali Ke Form</a>";
}
?>