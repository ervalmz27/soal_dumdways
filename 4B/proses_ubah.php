<?php
// Load file koneksi.php
include "koneksi.php";

// Ambil data ID yang dikirim oleh form_ubah.php melalui URL
$id = $_GET['id'];

// Ambil Data yang Dikirim dari Form
$name = $_POST['name'];
$category_id = $_POST['category'];
$publication_year = $_POST['publication'];
$writer_id = $_POST['writer'];

// Ambil data foto yang dipilih dari form
$img = $_FILES['img']['name'];
$tmp = $_FILES['img']['tmp_name'];

// Cek apakah user ingin mengubah fotonya atau tidak
if(empty($foto)){ // Jika user tidak memilih file foto pada form
  // Lakukan proses update tanpa mengubah fotonya
  // Proses ubah data ke Database
  $sql = $pdo->prepare("UPDATE dumdways SET nama=:nama, puclication_year=:pb, writer_id = :wr, category_id=:category_id WHERE id=:id");
  $sql->bindParam(':nama', $name);
  $sql->bindParam(':pb', $publication_year);
  $sql->bindParam(':category_id', $category_id);
  $sql->bindParam(':wr', $writer_id);
  $sql->bindParam(':id', $id);
  $execute = $sql->execute(); // Eksekusi / Jalankan query

  if($sql){ // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    header("location: index.php"); // Redirect ke halaman index.php
  }else{
    // Jika Gagal, Lakukan :
    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
    echo "<br><a href='form_ubah.php'>Kembali Ke Form</a>";
  }
}else{ // Jika user memilih foto / mengisi input file foto pada form
  // Lakukan proses update termasuk mengganti foto sebelumnya
  // Rename nama fotonya dengan menambahkan tanggal dan jam upload
  $newimg = date('dmYHis').$img;

  // Set path folder tempat menyimpan fotonya
  $path = "images/".$newimg;

  // Proses upload
  if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
    // Query untuk menampilkan data siswa berdasarkan ID yang dikirim
    $sql = $pdo->prepare("SELECT foto FROM siswa WHERE id=:id");
    $sql->bindParam(':id', $id);
    $sql->execute(); // Eksekusi query insert
    $data = $sql->fetch(); // Ambil semua data dari hasil eksekusi $sql

    // Cek apakah file foto sebelumnya ada di folder images
    if(is_file("images/".$data['foto'])) // Jika foto ada
      unlink("images/".$data['foto']); // Hapus file foto sebelumnya yang ada di folder images

    // Proses ubah data ke Database
    $sql = $pdo->prepare("UPDATE dumdways SET  nama=:nama, category_id=:cd, writer_id=:wr, publication_year=:py, img=:img WHERE id=:id");
    $sql->bindParam(':nama', $nama);
    $sql->bindParam(':cd', $category_id);
    $sql->bindParam(':wr', $writer_id);
    $sql->bindParam(':publication', $publication_year);
    $sql->bindParam(':img', $newimg);
    $sql->bindParam(':id', $id);
    $execute = $sql->execute(); // Eksekusi / Jalankan query

    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
      // Jika Sukses, Lakukan :
      header("location: index.php"); // Redirect ke halaman index.php
    }else{
      // Jika Gagal, Lakukan :
      echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
      echo "<br><a href='form_ubah.php'>Kembali Ke Form</a>";
    }
  }else{
    // Jika gambar gagal diupload, Lakukan :
    echo "Maaf, Gambar gagal untuk diupload.";
    echo "<br><a href='form_ubah.php'>Kembali Ke Form</a>";
  }
}
?>