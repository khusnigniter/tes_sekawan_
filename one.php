<?php  
 //$sumber = 'http://ppid.jakarta.go.id/json?url=http://data.jakarta.go.id/dataset/06f19910-82c3-428f-9e13-14d848486f69/resource/a7cc5803-9993-427b-a3df-9745a233b38d/download/Lomba-bercerita-anak-TerbaikEdited.csv';
 //function ambil_data(){
  $sumber = 'http://static.sekawamedia.co.id/data.json';
  $konten = file_get_contents($sumber);
  $data = json_decode($konten, true);
  //return $data;
//}

 //echo $data[1]["nama_lokasi"];
 //echo "<h1 align='center'>Jumlah ada ".count($data)." Pegawai</h1>";
 //echo "<br/>";
?>

<!DOCTYPE html>
<html>
<head>
 <title>Menampilkan data json</title>
 <style>
  table {
   width: 100%; 
  }
  table tr td {
   padding: 1rem;
  }
 </style>
</head>
<body>
 <table border="1">
  <tr>
   <th>No</th>
   <th>ID Peg</th>
   <th>Nama Pegawai</th>
   <th>Gaji</th>
   <th>Usia</th>
   <th>Foto</th> 
  </tr>
  <?php   
   for($a=0; $a < count($data); $a++)
   {
    print "<tr>";
    // penomeran otomatis
    print "<td>".$a."</td>";
    // menayangkan 
    print "<td>".$data[$a]['tahun']."</td>";
    print "<td>".$data[$a]['jenis']."</td>";
    print "<td>".$data[$a]['juara']."</td>";
    print "<td>".$data[$a]['nama']."</td>";
    print "<td>".$data[$a]['sekolah']."</td>";
    print "</tr>";
   }
  ?>
 </table>
</body>
</html>