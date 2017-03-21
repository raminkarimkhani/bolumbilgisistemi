<?php include "kutuphane/baglanti.php"; ?>

<?php 
	if(isset($_POST['ekle'])) { // butona basılma kontrolü
		$adi=$_POST['adi'];
		$soyadi=$_POST['soyadi'];
		$unvan=$_POST['unvan'];
		$sicilno=$_POST['sicilno'];

		if(empty($adi)==false && empty($soyadi)==false && empty($unvan)==false && empty($sicilno)==false ) {

			$sorgu="INSERT INTO personel (adi,soyadi,unvan,sicilno)
					VALUES ('{$adi}','{$soyadi}','{$unvan}','{$sicilno}')";

			$sonuc=mysqli_query($baglanti, $sorgu);

			if($sonuc==true) {
				// eklendi işlemleri
				header('Location: personel.php');

			}else {
				$hata="Kaydetmede problem yaşadınız.";

			}




		}else {
			// alanları doldurması gerektigi uyarısını ver.
			$mesaj="Personel ekleyebilmeniz için tüm alanlar doldurulmalıdır.";
			$turu="4";
		}
		
	}


?>
<?php include "kutuphane/ust.php"; ?>


<h2 class="page-header">Personel Ekle</h2>
<?php mesaj_goster(@$mesaj,@$turu);?>

<form action="personel_ekle.php" method="POST">
<div class="form-group">
  <label for="usr">Adı:</label>
  <input type="text" name="adi" class="form-control">
</div>
<div class="form-group">
  <label for="usr">Soyadı:</label>
  <input type="text" name="soyadi" class="form-control">
</div>
<div class="form-group">
  <label for="usr">Ünvan:</label>
  <input type="text" name="unvan" class="form-control">
</div>
<div class="form-group">
  <label for="usr">Sicil No:</label>
  <input type="text" name="sicilno" class="form-control">
</div>

<div class="form-group">
<input type="submit" name="ekle" class="btn btn-info" value="Ekle">
</div>
</form>
<?php //echo @$sorgu;?>
<?php include "kutuphane/alt.php"; ?>