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
		$adi=$_POST['adi'];
		$kapasite=$_POST['kapasite'];
		$bina_id=$_POST['bina_id'];
		

		if(empty($adi)==false && empty($kapasite)==false && empty($bina_id)==false) {

			$sorgu="INSERT INTO derslik (adi,kapasite,bina_id)
					VALUES ('{$adi}','{$kapasite}','{$bina_id}')";

			$sonuc=mysqli_query($baglanti, $sorgu);

			if($sonuc==true) {
				// eklendi işlemleri
				header('Location: derslik.php');

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


<h2 class="page-header">Derslik Ekle</h2>
<?php mesaj_goster(@$mesaj,@$turu);?>

<form action="derslik_ekle.php" method="POST">
<div class="form-group">
  <label for="usr">Adı:</label>
  <input type="text" name="adi" class="form-control">
</div>
<div class="form-group">
  <label for="usr">Kapasite:</label>
  <input type="number" name="kapasite" class="form-control">
</div>
<div class="form-group">
  <label for="usr">Bina Adı:</label>
  <select class="form-control" id="sel1" name="bina_id">
    <option value="0">Seçiniz</option>
    <?php foreach($binalar as $bina)  : ?>
    	<option value="<?php echo $bina['id']; ?>">
    	<?php echo $bina['adi']; ?></option>
    <?php endforeach; ?>
   
  </select>
</div>

<div class="form-group">
<input type="submit" name="ekle" class="btn btn-info" value="Ekle">
</div>
</form>
<?php //echo @$sorgu;?>
<?php include "kutuphane/alt.php"; ?>