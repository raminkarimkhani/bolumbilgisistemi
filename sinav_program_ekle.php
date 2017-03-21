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

$sorgu="SELECT * FROM sinav ORDER BY id";
$sonuc = mysqli_query($baglanti,$sorgu);

if (mysqli_num_rows($sonuc) > 0) {  // sorgu sonucu boş değilse
	
	 while($satir = mysqli_fetch_assoc($sonuc)) {
		  $sinavlar[]=$satir;

	}
}

$sorgu="SELECT D.id,D.adi,D.kapasite,B.adi AS bina_adi
        FROM derslik AS D
        INNER JOIN bina AS B ON B.id=D.bina_id
        WHERE D.durum=0";
$sonuc = mysqli_query($baglanti,$sorgu);

if (mysqli_num_rows($sonuc) > 0) {  // sorgu sonucu boş değilse
	
	 while($satir = mysqli_fetch_assoc($sonuc)) {
		  $derslikler[]=$satir;

	}
}

$sorgu="SELECT A.id, A.sube, D.kodu, D.adi AS ders_adi, D.donem, P.adi,P.soyadi,P.unvan
        FROM acilan_ders AS A
        INNER JOIN ders AS D ON D.id=A.ders_id
        INNER JOIN personel AS P ON P.id=A.personel_id
        WHERE A.durum=0
        ORDER BY D.donem,D.kodu,A.sube";

$sonuc = mysqli_query($baglanti,$sorgu);

if (mysqli_num_rows($sonuc) > 0) {  // sorgu sonucu boş değilse
	
	 while($satir = mysqli_fetch_assoc($sonuc)) {
		  $acilan_dersler[]=$satir;

	}
}



if(isset($_POST['ekle'])) { // butona basılma kontrolü
	$acilan_ders_id=$_POST['acilan_ders_id'];
	$takvim_id=$bilgi['id'];
	$personel_id=$_POST['personel_id'];
	$derslik_id=$_POST['derslik_id'];
  $tarih=$_POST['tarih'];
	$saat=$_POST['saat'];

	if(empty($acilan_ders_id)==false && empty($takvim_id)==false
	 && empty($personel_id)==false && empty($derslik_id)==false
   && empty($tarih)==false && empty($saat)==false) {

		$sorgu="INSERT INTO sinav_programi (acilan_ders_id,takvim_id,personel_id,derslik_id,tarih,saat)
				VALUES ('{$acilan_ders_id}','{$takvim_id}','{$personel_id}','{$derslik_id}',
              '{$tarih}','{$saat}')";

		$sonuc=mysqli_query($baglanti, $sorgu);

		if($sonuc==true) {
			// eklendi işlemleri
			header('Location: sinav_program_ekle.php');

		}else {
			$mesaj="Kaydetmede problem yaşadınız.";
			$turu=3;

		}




	}else {
		// alanları doldurması gerektigi uyarısını ver.
		$mesaj="Programa yeni kayıt yapabilmeniz için tüm alanlar doldurulmalıdır.";
		$turu="4";
	}
	
}


?>
<?php include "kutuphane/ust.php"; ?>


<h2 class="page-header">Sınav Program Ekle</h2>
<?php mesaj_goster(@$mesaj,@$turu);?>

<form action="sinav_program_ekle.php" method="POST">

<div class="form-group">
  <label for="usr">Açılan Ders:</label>
  <select class="form-control" id="sel1" name="acilan_ders_id">
    <option value="0">Seçiniz</option>
    <?php foreach($acilan_dersler as $ders)  : ?>
    	<option value="<?php echo $ders['id']; ?>">
    	<?php echo "{$ders['kodu']} {$ders['ders_adi']} Şube {$ders['sube']} 
    	{$ders['adi']} {$ders['soyadi']}"; ?></option>
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
  <label for="usr">Derslik:</label>
  <select class="form-control" id="sel1" name="derslik_id">
    <option value="0">Seçiniz</option>
    <?php foreach($derslikler as $derslik)  : ?>
    	<option value="<?php echo $derslik['id']; ?>">
    	<?php echo "{$derslik['adi']} - {$derslik['kapasite']}- {$derslik['bina_adi']}"; ?></option>
    <?php endforeach; ?>
   
  </select>
</div>

<div class="form-group">
  <label for="tarih">Tarih:</label>
  <input type="date" name="tarih" class="form-control">
</div>

<div class="form-group">
  <label for="saat">Saat:</label>
  <input type="time" name="saat" class="form-control">
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
<?php


?>
<?php include "kutuphane/alt.php"; ?>