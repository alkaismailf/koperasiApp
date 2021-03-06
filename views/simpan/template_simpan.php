<?php
 use yii\helpers\Html;
 use yii\grid\GridView;
 ?>

 <style type="text/css">
   table {
    *border-collapse: collapse; /* IE7 and lower */
    border-spacing: 0;
    width: 100%;   
   }
   .zebra td, .zebra th {
    padding: 10px;
    border-bottom: 1px solid #f2f2f2;   
   }
   
   .zebra tbody tr:nth-child(even) {
    background: #f5f5f5;
    -webkit-box-shadow: 0 1px 0 rgba(255,255,255,.8) inset;
    -moz-box-shadow:0 1px 0 rgba(255,255,255,.8) inset; 
    box-shadow: 0 1px 0 rgba(255,255,255,.8) inset;       
   }
   
   .zebra th {
    text-align: left;
    text-shadow: 0 1px 0 rgba(255,255,255,.5);
    border-bottom: 1px solid #ccc;
    background-color: #eee;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#f5f5f5), to(#eee));
    background-image: -webkit-linear-gradient(top, #f5f5f5, #eee);
    background-image:    -moz-linear-gradient(top, #f5f5f5, #eee);
    background-image:     -ms-linear-gradient(top, #f5f5f5, #eee);
    background-image:      -o-linear-gradient(top, #f5f5f5, #eee);
    background-image:         linear-gradient(top, #f5f5f5, #eee);
   }
   
   .zebra th:first-child {
    -moz-border-radius: 6px 0 0 0;
    -webkit-border-radius: 6px 0 0 0;
    border-radius: 6px 0 0 0; 
   }
   
   .zebra th:last-child {
    -moz-border-radius: 0 6px 0 0;
    -webkit-border-radius: 0 6px 0 0;
    border-radius: 0 6px 0 0;
   }
   
   .zebra th:only-child{
    -moz-border-radius: 6px 6px 0 0;
    -webkit-border-radius: 6px 6px 0 0;
    border-radius: 6px 6px 0 0;
   }
   
   .zebra tfoot td {
    border-bottom: 0;
    border-top: 1px solid #fff;
    background-color: #f1f1f1; 
   }
   
   .zebra tfoot td:first-child {
    -moz-border-radius: 0 0 0 6px;
    -webkit-border-radius: 0 0 0 6px;
    border-radius: 0 0 0 6px;
   }
   
   .zebra tfoot td:last-child {
    -moz-border-radius: 0 0 6px 0;
    -webkit-border-radius: 0 0 6px 0;
    border-radius: 0 0 6px 0;
   }
   
   .zebra tfoot td:only-child{
    -moz-border-radius: 0 0 6px 6px;
    -webkit-border-radius: 0 0 6px 6px
    border-radius: 0 0 6px 6px
   }
 </style>
 
 <h2 style="text-align:center;">Data Penyimpanan Koperasi Sejahtera</h2>
    <br>
 <table class="zebra" style="margin:auto; width:100%;">
  <thead>
   <tr>
    <th>No. </th>
    <th>No. Simpan</th>
    <th>ID Anggota</th>
    <th>Jumlah Simpan (Rp.)</th>
    <th>Tanggal Simpan</th>
    <th>ID Karyawan</th>
   </tr>
  </thead>
  <?php
   $i=1;
   foreach($model as $data){
    echo '
     <tr>
      <td>'.$i.'</td>
      <td>'.$data['no_simpan'].'</td>
      <td>'.$data['id_anggota'].'</td>
      <td>'.$data['jml_simpan'].'</td>
      <td>'.$data['tgl_simpan'].'</td>
      <td>'.$data['id_karyawan'].'</td>
     </tr>
    ';
    $i++;
   }
  ?>
 </table>