<html>
<head>
  <title>Aplikasi CRUD Plus Upload Gambar dengan PHP</title>
</head>
<body>
  <h1>Book</h1>
  <a href="tambah_form.php">Tambah Data</a><br><br>
  <table width="100%">
  <tr>
    <th>name</th>
    <th>category</th>
    <th>writer</th>
    <th>publication</th>
    <th>image</th>
    <th colspan="2">Aksi</th>
  </tr>
  <?php
  // Load file koneksi.php
  include "koneksi.php";
  // Buat query untuk menampilkan semua data siswa
  $sql = $pdo->prepare("SELECT * FROM dumdways");
  $sql->execute(); // Eksekusi querynya
  while($data = $sql->fetch()){ // Ambil semua data dari hasil eksekusi $sql
    echo "<tr>";
    echo "<td>".$data['name']."</td>";
    echo "<td>".$data['category']."</td>";
    echo "<td>".$data['writer']."</td>";
    echo "<td>".$data['publication']."</td>";
    echo "<td><img src='images/".$data['img']."' width='100' height='100'></td>";
    echo "<td><a href='form_ubah.php?id=".$data['id']."'>Ubah</a></td>";
    echo "<td><a href='proses_hapus.php?id=".$data['id']."'>Hapus</a></td>";
    echo "</tr>";
  }
  ?>
  </table>
</body>
</html>