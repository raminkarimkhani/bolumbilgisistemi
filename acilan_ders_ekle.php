<?php include "kutuphane/baglanti.php"; ?>
<?php 

$sorgu="SELECT T.id,T.yil,T.donem,T.durum, T.sinav_id,S.turu
        FROM takvim AS T
        INNER JOIN sinav AS S ON S.id=T.sinav_id
        WHERE durum=1";
$sonuc = mysqli_query($baglanti,$sorgu);

$bilgi = mysqli_fetch_array($sonuc);


$sorgu="SELECT * FROM personel WHERE durum=0";
$sonuc = mysqli_query($baglanti,$sorgu);

if (mysqli_num_rows($sonuc) > 0) {  // sorgu sonucu boş değilse
	
	 while($satir = mysqli_fetch_assoc($sonuc)) {
		  $personeller[]=$satir;

	}
}

$sorgu="SELECT * FROM ders WHERE durum=0 ORDER BY donem,kodu";
$sonuc = mysqli_query($baglanti,$sorgu);

if (mysqli_num_rows($sonuc) > 0) {  // sorgu sonucu boş değilse
	
	 while($satir = mysqli_fetch_assoc($sonuc)) {
		  $dersler[]=$satir;

	}
}



	if(isset($_POST['ekle'])) { // butona basılma kontrolü
		$ders_id=$_POST['ders_id'];
		$personel_id=$_POST['personel_id'];
		$sube=$_POST['sube'];
		$takvim_id=$bilgi['id'];

		if(empty($ders_id)==false && empty($personel_id)==false 
			&& empty($sube)==false && empty($takvim_id)==false) {

			$sorgu="INSERT INTO acilan_ders (ders_id,personel_id,sube,takvim_id)
					VALUES ('{$ders_id}','{$personel_id}','{$sube}','{$takvim_id}')";
 		
			$sonuc=mysqli_query($baglanti, $sorgu);

			if($sonuc==true) {
				// eklendi işlemleri
				header('Location: acilan_ders.php');

			}else {
				$mesaj="Kaydetmede problem yaşadınız.";
				$turu=3;

			}




		}else {
			// alanları doldurması gerektigi uyarısını ver.
			$mesaj="Ders açabilmeniz için tüm alanlar doldurulmalıdır.";
			$turu="4";
		}
		
	}



?>
<?php include "kutuphane/ust.php"; ?>


<h2 class="page-header">Açılan Ders Ekle</h2>
<?php mesaj_goster(@$mesaj,@$turu);?>

<form action="acilan_ders_ekle.php" method="POST">

<div class="form-group">
  <label for="usr">Ders Adı:</label>
  <select class="form-control" id="sel1" name="ders_id">
    <option value="0">Seçiniz</option>
    <?php foreach($dersler as $ders)  : ?>
    	<option value="<?php echo $ders['id']; ?>">
    	<?php echo $ders['kodu'] . " " . $ders['adi']; ?></option>
    <?php endforeach; ?>
  </select>
</div>
<div class="form-group">
  <label for="usr">Personel:</label>
  <select class="form-control" id="sel1" name="personel_id">
    <option value="0">Seçiniz</option>
    <?php foreach($personeller as $personel)  : ?>
    	<option value="<?php echo $personel['id']; ?>">
    	<?php echo $personel['unvan'] . " " . $personel['adi']
    	. " " . $personel['soyadi'] ; ?></option>
    <?php endforeach; ?>
   
  </select>
</div>

<div class="form-group">
  <label for="usr">Şube:</label>
  <select class="form-control" id="sel1" name="sube">
    <option value="0">Seçiniz</option>
    <option value="1">Şube 1</option>
    <option value="2">Şube 2</option>
    <option value="3">Şube 3</option>
    <option value="4">Şube 4</option>
  </select>
</div>

<div class="form-group">
<input type="submit" name="ekle" class="btn btn-info" value="Ekle">
</div>
</form>


<div class="table-responsive">
    <table class="table table-striped">
        
        <?php if(empty($bilgi)==false) :?>
        <tr>
          <td style="background-color:#CDE;">Aktif Sınav Dönemi :</td>
          <td style="text-align:right; background-color:#DFE;">Yıl :</td>
          <td><?php echo $bilgi['yil'] . " - " .($bilgi['yil']+1);?></td>
          <td style="text-align:right; background-color:#DFE;">Dönem :</td>
          <td><?php echo $bilgi['donem'];?></td>
          <td style="text-align:right; background-color:#DFE;">Sınav Türü :</td>
          <td><?php echo $bilgi['turu'];?></td>
        </tr>
         <?php else : ?>
        <tr>
          <td colspan="3" style="text-align:center; background-color:#EBE8A3;">Aktif Dönem Bulunamadı</td>
        </tr>
       <?php endif; ?>
     
    </table>
</div>
<?php //echo $sorgu;?>
<?php include "kutuphane/alt.php"; ?>