<?php include "kutuphane/baglanti.php"; ?>

<?php 
$sayi=0; $sayi2=0;

if(isset($_GET['sil'])) {
  $sil=$_GET['sil'];
 // $sorgu="DELETE FROM personel WHERE id='{$sil}' LIMIT 1";
  $sorgu="UPDATE personel SET durum='1' WHERE id='{$sil}' LIMIT 1";
  $sonuc = mysqli_query($baglanti,$sorgu);

  if($sonuc==true) {
    $etkilenen_satir=mysqli_affected_rows($baglanti);
    if($etkilenen_satir>0) {
       header('Location:personel.php?mesaj=1');
     
    }else {
       $mesaj="Personel bulunamamıştır.";
       $turu=4;
    }
   

  }else {
      $mesaj="Personel silinememiştir. Problem var.";
      $turu=4;
  }

}

if(isset($_GET['gerial'])) {
  $gerial=$_GET['gerial'];
 // $sorgu="DELETE FROM personel WHERE id='{$sil}' LIMIT 1";
  $sorgu="UPDATE personel SET durum='0' WHERE id='{$gerial}' LIMIT 1";
  $sonuc = mysqli_query($baglanti,$sorgu);

  if($sonuc==true) {
    $etkilenen_satir=mysqli_affected_rows($baglanti);
    if($etkilenen_satir>0) {
       header('Location:personel.php?mesaj=2');
     
    }else {
       $mesaj="Personel bulunamamıştır.";
       $turu=4;
    }
   

  }else {
      $mesaj="Personel bilgisi geri alınamadı. Problem var.";
      $turu=4;
  }

}

if(isset($_GET['mesaj'])) {
	if($_GET['mesaj']==1) {
	  $mesaj="Personel başarılı bir şekilde silinmiştir";
      $turu=1;
    }elseif($_GET['mesaj']==2) {
	  $mesaj="Personel başarılı bir şekilde geri alınmıştır";
      $turu=2;
    }
}

$sorgu="SELECT * FROM personel WHERE durum='0'";
$sonuc = mysqli_query($baglanti,$sorgu);

if (mysqli_num_rows($sonuc) > 0) {  // sorgu sonucu boş değilse
	
	 while($satir = mysqli_fetch_assoc($sonuc)) {
		$personeller[]=$satir;
 
	}
}

$sorgu="SELECT * FROM personel WHERE durum='1'";
$sonuc = mysqli_query($baglanti,$sorgu);

if (mysqli_num_rows($sonuc) > 0) {  // sorgu sonucu boş değilse
	
	 while($satir = mysqli_fetch_assoc($sonuc)) {
		$silinen_personeller[]=$satir;
 
	}
}



?>



<?php include "kutuphane/ust.php"; ?>
<h2 class="page-header">Personeller</h2>
<?php mesaj_goster(@$mesaj,@$turu);?>
 <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Sıra</th>
          <th>Adı Soyadı</th>
          <th>Sicil No</th>
          <th>İşlemler</th>
        </tr>
      </thead>
      <tbody>
      	<?php if(empty($personeller)==false) :?>
      	<?php foreach($personeller as $personel)  : ?>
      	<?php $sayi++; ?>
        <tr>
          <td><?php echo $sayi;?></td>
          <td><?php echo "{$personel['unvan']} {$personel['adi']} {$personel['soyadi']}";?></td>
          <td><?php echo $personel['sicilno']?></td>
          <td>
          <a href="personel.php?sil=<?php echo $personel['id']?>">
          <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
          </a>
           <a target="_blank" href="kutuphane/tcpdf/examples/gorev.php?cikti=<?php echo $personel['id']?>">
          <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
          </a>
          </td>
        </tr>
       <?php endforeach; ?>
        <?php else : ?>
  	   		<td colspan="4" style="text-align:center; background-color:#EBE8A3;">Kayıt Bulunamadı</td>
  	   <?php endif; ?>
      </tbody>
    </table>
</div>

<h4 class="page-header">Silinen Personel Listesi</h4>
<div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Sıra</th>
          <th>Adı Soyadı</th>
          <th>Sicil No</th>
          <th>İşlemler</th>
        </tr>
      </thead>
      <tbody>
      	<?php if(empty($silinen_personeller)==false) :?>
      	<?php foreach($silinen_personeller as $personel)  : ?>
      	<?php $sayi2++; ?>
        <tr>
          <td><?php echo $sayi2;?></td>
          <td><?php echo "{$personel['unvan']} {$personel['adi']} {$personel['soyadi']}";?></td>
          <td><?php echo $personel['sicilno']?></td>
          <td>
          <a href="personel.php?gerial=<?php echo $personel['id']?>">
          <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
          </a>
          <a href="kutuphane/tcpdf/examples/gorev.php?cikti=<?php echo $personel['id']?>">
          <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
          </a>
          </td>
        </tr>
       <?php endforeach; ?>
  	   <?php else : ?>
  	   		<td colspan="4" style="text-align:center; background-color:#EBE8A3;">Kayıt Bulunamadı</td>
  	   <?php endif; ?>


      </tbody>
    </table>
</div>

<?php include "kutuphane/alt.php"; ?>