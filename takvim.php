<?php include "kutuphane/baglanti.php"; ?>
<?php 
$guncel_yil=date("Y");
$sorgu="SELECT * FROM sinav ORDER BY id";
$sonuc = mysqli_query($baglanti,$sorgu);

if (mysqli_num_rows($sonuc) > 0) {  // sorgu sonucu boş değilse
	
	 while($satir = mysqli_fetch_assoc($sonuc)) {
		  $sinavlar[]=$satir;

	}
}

$sayi=0;
$sorgu="SELECT T.id,T.yil,T.donem,T.durum, S.turu
        FROM takvim AS T
        INNER JOIN sinav AS S ON S.id=T.sinav_id";

$sonuc = mysqli_query($baglanti,$sorgu);

if (mysqli_num_rows($sonuc) > 0) {  // sorgu sonucu boş değilse
	
	 while($satir = mysqli_fetch_assoc($sonuc)) {
		  $takvimler[]=$satir;

	}
}

if(isset($_GET['aktif'])) {
  $aktif=$_GET['aktif'];
  $sorgu1="UPDATE takvim SET durum='0'";
  $sonuc1 = mysqli_query($baglanti,$sorgu1);

  if($sonuc1==true) {
			$sorgu2="UPDATE takvim SET durum='1' WHERE id='{$aktif}'";
			$sonuc2=mysqli_query($baglanti, $sorgu2);

			if($sonuc2==true) {
			header('Location: takvim.php');

			}else {
				$mesaj="Aktif yapılamadı";
				$turu=3;
			}

		}else {
			$mesaj="Takvim sıfırlanamıyor. Yöneticiye başvurun";
			$turu=4;
		}



  
}

if(isset($_POST['ekle'])) { // butona basılma kontrolü
	$yil=$_POST['yil'];
	$donem=$_POST['donem'];
	$sinav_id=$_POST['sinav_id'];
	

	if(empty($yil)==false && empty($donem)==false && empty($sinav_id)==false) {
		$sorgu1="UPDATE takvim SET durum=0";
		$sonuc1=mysqli_query($baglanti, $sorgu1);


		if($sonuc1==true) {
			$sorgu2="INSERT INTO takvim (yil,donem,sinav_id,durum)
					VALUES ('{$yil}','{$donem}','{$sinav_id}','1')";

			$sonuc2=mysqli_query($baglanti, $sorgu2);

			if($sonuc2==true) {
			header('Location: takvim.php');

			}else {
				$mesaj="Kaydetmede problem yaşadınız.";
				$turu=3;
			}

		}else {
			$mesaj="Takvim sıfırlanamıyor. Yöneticiye başvurun";
			$turu=4;
		}


		


	}else {
		// alanları doldurması gerektigi uyarısını ver.
		$mesaj="Kayıt ekleyebilmeniz için tüm alanlar doldurulmalıdır.";
		$turu="4";
	}
	
}


?>
<?php include "kutuphane/ust.php"; ?>


<h2 class="page-header">Takvim</h2>
<?php mesaj_goster(@$mesaj,@$turu);?>

<form action="takvim.php" method="POST">
<div class="form-group">
  <label for="usr">Yil:</label>
  <select class="form-control" id="yil" name="yil">
  		  <option value="0">Seçiniz</option>
  		  <?php for($i=$guncel_yil-3;$i<=$guncel_yil+3; $i++) : ?>
  		  <option value="<?php echo $i; ?>"><?php echo $i . "-" . ($i+1); ?></option>
  		  <?php endfor; ?>
  </select>
</div>
<div class="form-group">
  <label for="usr">Dönem:</label>
  <select class="form-control" id="donem" name="donem">
  		  <option value="0">Seçiniz</option>
  		  <option value="1">Güz Dönemi</option>
  		  <option value="2">Bahar Dönemi</option>
  </select>
</div>
<div class="form-group">
  <label for="usr">Sinav Adı:</label>
  <select class="form-control" id="sel1" name="sinav_id">
    <option value="0">Seçiniz</option>
    <?php foreach($sinavlar as $sinav)  : ?>
    	<option value="<?php echo $sinav['id']; ?>">
    	<?php echo $sinav['turu']; ?></option>
    <?php endforeach; ?>
   
  </select>
</div>

<div class="form-group">
<input type="submit" name="ekle" class="btn btn-info" value="Ekle">
</div>
</form>


 <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Sıra</th>
          <th>Yil</th>
          <th>Dönem</th>
          <th>Sinav Türü</th>
          <th>Durum</th>
          <th>İşlemler</th>
        </tr>
      </thead>
      <tbody>
        <?php if(empty($takvimler)==false) :?>
      	<?php foreach($takvimler as $takvim)  : ?>
      	<?php $sayi++; ?>
        <tr  style="background-color: <?php echo  $takvim['durum']==1 ? "#DFE" : "" ;    ?>">
          <td><?php echo $sayi;?></td>
          <td><?php echo $takvim['yil'] ."-". ($takvim['yil']+1);?></td>
          <td><?php echo $takvim['donem'];?></td>
          <td><?php echo $takvim['turu'];?></td>
          <?php if($takvim['durum']==0) : ?>
          <td><?php echo "Pasif";?></td>
     	  <?php else : ?>
     	  	 <td><?php echo "Aktif";?></td>
     	  <?php endif; ?>
          <td>
          <?php if($takvim['durum']==0) : ?>
          <a title="aktif yap" href="takvim.php?aktif=<?php echo $takvim['id']?>">
          <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
          </a>
    	  <?php endif; ?>
          </td>
        </tr>
       <?php endforeach; ?>
        <?php else : ?>
        <tr>
          <td colspan="6" style="text-align:center; background-color:#EBE8A3;">Kayıt Bulunamadı</td>
       	</tr>
       <?php endif; ?>
      </tbody>
    </table>
</div>

<?php //echo @$sorgu;?>
<?php include "kutuphane/alt.php"; ?>