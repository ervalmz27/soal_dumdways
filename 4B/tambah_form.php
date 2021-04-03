<html>
<head>
  <title>Aplikasi CRUD dengan PHP</title>
</head>
<body>
  <h1>Tambah Data Siswa</h1>
  <form method="post" action="proses_simpan.php" enctype="multipart/form-data">
  <table cellpadding="8">
  <tr>
    <td>Name</td>
    <td><input type="text" name="nis"></td>
  </tr>
  <tr>
    <td>Categori</td>
    <td>
    <input type="radio" name="category" value="Laki-laki"> Komik
    <input type="radio" name="categori" value="Perempuan">Novel
  </tr>
  <tr>
    <td>publication</td>
    <td><input name="publication"></input></td>
  </tr>
  <tr>
    <td>writer</td>
    <td><textarea type="text" name="writer"></textarea></td>
  </tr>
  <tr>
    <td>image</td>
    <td><input type="file" name="img"></td>
  </tr>
  </table>
  
  <hr>
  <input type="submit" value="Simpan">
  <a href="index.php"><input type="button" value="Batal"></a>
  </form>
</body>
</html>