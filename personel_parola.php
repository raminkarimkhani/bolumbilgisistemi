<?php include "kutuphane/baglanti.php"; ?>
<?php
//PERSONEL LİSTELEME
$sorgu="SELECT sicilno,unvan,adi,soyadi FROM personel";
$sonuc= mysqli_query($baglanti,$sorgu);
if (mysqli_num_rows($sonuc) > 0)
{  // sorgu sonucu boş değilse

	 while($satir = mysqli_fetch_assoc($sonuc))
   {
		$personeller[]=$satir;

	}
}
?>

<?php
//PAROLA ATAMA
if(isset($_POST['parolaata']))
{
  $parola=$_POST['parola'];
  $parolaonay=$_POST['parolaonay'];
  $sicil=$_POST['personeller'];
  if($parola==$parolaonay)
  {
    $sorgu="UPDATE personel SET parola='{$parola}' WHERE sicilno='{$sicil}' LIMIT 1";
    $sonuc = mysqli_query($baglanti,$sorgu);

    if($sonuc==true) {
      $etkilenen_satir=mysqli_affected_rows($baglanti);
      if($etkilenen_satir>0) {
          $mesaj="Parola atandı.";
          $turu=1;
         

      }else {
         $mesaj="Parola atanamadı.";
         $turu=4;
      }


    }
  }
  else {
    $mesaj="Parolalar eşleşmiyor.";
    $turu=4;
  }
}
?>
<?php include "kutuphane/ust.php"; ?>

<h2 class="page-header">Personel PAROLA</h2>
<?php mesaj_goster(@$mesaj,@$turu);?>

<form action="personel_parola.php" method="POST">
<div class="form-group">
  <label for="usr">Personel:</label><br>
  <select class="form-control" name="personeller">
  <?php foreach($personeller as $p)  : ?>
    <option value="<?php echo $p['sicilno'];?>"><?php echo $p['sicilno']."  ".$p['unvan']." ".$p['adi']." ".$p['soyadi'];?></option>
  <?php endforeach; ?>
  </select>
</div>
<div class="form-group">
  <label for="usr">Parola:</label>
  <input type="password" name="parola" class="form-control" maxlength="16" pattern=".{8,16}" title="En az 8 en fazla 16 karakter">
</div>
<div class="form-group">
  <label for="usr">Parola Onay:</label>
  <input type="password" name="parolaonay" maxlength="16" class="form-control"  pattern=".{8,16}" title="En az 8 en fazla 16 karakter">
</div>

<div class="form-group">
<input type="submit" name="parolaata" class="btn btn-info" value="Parola Ata">
</div>
</form>
<?php //echo @$sorgu;?>
<?php include "kutuphane/alt.php"; ?>
