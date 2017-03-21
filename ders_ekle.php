<?php include "kutuphane/baglanti.php"; ?>
<?php 

$sorgu="SELECT * FROM bina";
$sonuc = mysqli_query($baglanti,$sorgu);

if (mysqli_num_rows($sonuc) > 0) {  // sorgu sonucu boş değilse
	
	 while($satir = mysqli_fetch_assoc($sonuc)) {
		  $binalar[]=$satir;

	}
}


if(isset($_POST['ekle'])) { // butona basılma kontrolü
	$kodu=$_POST['kodu'];
	$adi=$_POST['adi'];
	$kredisi=$_POST['kredisi'];
	$donem=$_POST['donem'];
	$tip=1;
	

	if(empty($kodu)==false && empty($adi)==false && empty($donem)==false && empty($tip)==false) {

		$sorgu="INSERT INTO ders (kodu,adi,kredisi,donem,tip)
				VALUES ('{$kodu}','{$adi}','{$kredisi}','{$donem}','{$tip}')";

		$sonuc=mysqli_query($baglanti, $sorgu);

		if($sonuc==true) {
			// eklendi işlemleri
			header('Location: ders.php');

		}else {
			$mesaj="Kaydetmede problem yaşadınız.";
			$turu=3;

		}




	}else {
		// alanları doldurması gerektigi uyarısını ver.
		$mesaj="Derslik ekleyebilmeniz için tüm alanlar doldurulmalıdır.";
		$turu="4";
	}
	
}


?>
<?php include "kutuphane/ust.php"; ?>


<h2 class="page-header">Ders Ekle</h2>
<?php mesaj_goster(@$mesaj,@$turu);?>

<form action="ders_ekle.php" method="POST">
<div class="form-group">
  <label for="kodu">Kodu:</label>
  <input type="text" name="kodu" class="form-control">
</div>
<div class="form-group">
  <label for="adi">Adı:</label>
  <input type="text" name="adi" class="form-control">
</div>

<div class="form-group">
  <label for="usr">Kredisi:</label>
  <input type="number" name="kredisi" class="form-control">
</div>

<div class="form-group">
  <label for="donemi">Dönemi:</label>
  <select class="form-control" id="donem" name="donem">
    <option value="0">Seçiniz</option>
   	<option value="1">1. Dönem</option>
   	<option value="2">2. Dönem</option>
   	<option value="3">3. Dönem</option>
   	<option value="4">4. Dönem</option>
   	<option value="5">5. Dönem</option>
   	<option value="6">6. Dönem</option>
   	<option value="7">7. Dönem</option>
   	<option value="8">8. Dönem</option>
  </select>
</div>

<div class="form-group">
<input type="submit" name="ekle" class="btn btn-info" value="Ekle">
</div>
</form>
<?php //echo @$sorgu;?>
<?php include "kutuphane/alt.php"; ?>