<?php include "kutuphane/baglanti.php"; ?>
<?php 

$sorgu="SELECT T.id,T.yil,T.donem,T.durum, S.turu
        FROM takvim AS T
        INNER JOIN sinav AS S ON S.id=T.sinav_id
		    WHERE durum=1";
$sonuc = mysqli_query($baglanti,$sorgu);

$bilgi = mysqli_fetch_array($sonuc);


?>
<?php include "kutuphane/ust.php"; ?>
<h1 class="page-header">Anasayfa</h1>

<div class="table-responsive">
    <table class="table table-striped">
      <thead>
      	 <tr>
          <th colspan="3" style="text-align:center;">Aktif Sınav Dönemi</th>
         
        </tr>
        <tr>
          <th>Yıl</th>
          <th>Dönem</th>
          <th>Sınav Türü</th>
        </tr>
      </thead>
      <tbody>
        <?php if(empty($bilgi)==false) :?>
        <tr>
        	<td><?php echo $bilgi['yil'];?></td>
        	<td><?php echo $bilgi['donem'];?></td>
        	<td><?php echo $bilgi['turu'];?></td>
        </tr>
      	
        <?php else : ?>
        <tr>
          <td colspan="3" style="text-align:center; background-color:#EBE8A3;">Aktif Dönem Bulunamadı</td>
       	</tr>
       <?php endif; ?>
      </tbody>
    </table>
</div>

<?php include "kutuphane/alt.php"; ?>
