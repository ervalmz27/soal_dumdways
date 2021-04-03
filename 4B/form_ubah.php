<html>
<head>
  <title>Aplikasi CRUD dengan PHP</title>
</head>
<body>
  <h1>Ubah Data</h1>
  <?php
  // Load file koneksi.php
  include "koneksi.php";
  // Ambil data NIS yang dikirim oleh index.php melalui URL
  $id = $_GET['id'];
  // Query untuk menampilkan data siswa berdasarkan ID yang dikirim
  $sql = $pdo->prepare("SELECT * FROM dumdways WHERE id=:id");
  $sql->bindParam(':id', $id);
  $sql->execute(); // Eksekusi query insert
  $data = $sql->fetch(); // Ambil semua data dari hasil eksekusi $sql
  ?>
  <form method="post" action="proses_ubah.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
    <table cellpadding="8">
      <tr>
        <td>Nama</td>
        <td><input type="text" name="name" value="<?php echo $data['name']; ?>"></td>
      </tr>
      <tr>
        <td>Publication</td>
        <td><input type="text" name="category" value="<?php echo $data['category_id']; ?>"></td>
      </tr>
      <tr>
        <td>Category</td>
        <td>
        <?php
        if($data['category_id'] == "Komik"){
          echo "<input type='radio' name='category' value='Komik' checked='checked'> Komik";
          echo "<input type='radio' name='category' value='Novel'> Novel";
        }else{
          echo "<input type='radio' name='category' value='Komik'> Komik";
          echo "<input type='radio' name='category' value='Novel' checked='checked'> Novel";
        }
        ?>
        </td>
      </tr>
        <td>writer</td>
        <td><textarea name="writer"><?php echo $data['writer_id']; ?></textarea></td>
      </tr>
      <tr>
        <td>image</td>
        <td>
          <input type="file" name="img">
        </td>
      </tr>
    </table>
    <hr>
    <input type="submit" value="Ubah">
    <a href="index.php"><input type="button" value="Batal"></a>
  </form>
</body>
</html>