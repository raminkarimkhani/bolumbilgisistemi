<?php include "kutuphane/baglanti.php"; ?>
<?php 

if(isset($_GET['sil'])) {
  $sil=$_GET['sil'];
  $sorgu="UPDATE derslik SET durum='1' WHERE id='{$sil}' LIMIT 1";
  $sonuc = mysqli_query($baglanti,$sorgu);

  if($sonuc==true) {
    $etkilenen_satir=mysqli_affected_rows($baglanti);
    if($etkilenen_satir>0) {
        header('Location:derslik.php?mesaj=1');
    }else {
       $mesaj="Derslik bulunamamıştır.";
       $turu=4;
    }  
  }else {
      $mesaj="Derslik silinememiştir. Problem var.";
      $turu=4;
  }
}

if(isset($_GET['gerial'])) {
  $gerial=$_GET['gerial'];
  //$sorgu="DELETE FROM derslik WHERE id='{$gerial}' LIMIT 1";
  $sorgu="UPDATE derslik SET durum='0' WHERE id='{$gerial}' LIMIT 1";
  $sonuc = mysqli_query($baglanti,$sorgu);

  if($sonuc==true) {
    $etkilenen_satir=mysqli_affected_rows($baglanti);
    if($etkilenen_satir>0) {
        header('Location:derslik.php?mesaj=2');
    }else {
       $mesaj="Derslik bulunamamıştır.";
       $turu=4;
    }
   

  }else {
      $mesaj="Derslik silinememiştir. Problem var.";
      $turu=4;
  }

}


$sayi=0;
$sorgu="SELECT D.id,D.adi,D.kapasite,B.adi AS bina_adi
        FROM derslik AS D
        INNER JOIN bina AS B ON B.id=D.bina_id
        WHERE D.durum='0'";
$sonuc = mysqli_query($baglanti,$sorgu);

if (mysqli_num_rows($sonuc) > 0) {  // sorgu sonucu boş değilse
	
	 while($satir = mysqli_fetch_assoc($sonuc)) {
		  $derslikler[]=$satir;

	}
}

$sayi2=0;
$sorgu="SELECT D.id,D.adi,D.kapasite,B.adi AS bina_adi
        FROM derslik AS D
        INNER JOIN bina AS B ON B.id=D.bina_id
        WHERE D.durum='1'";
$sonuc = mysqli_query($baglanti,$sorgu);

if (mysqli_num_rows($sonuc) > 0) {  // sorgu sonucu boş değilse
  
   while($satir = mysqli_fetch_assoc($sonuc)) {
      $silinen_derslikler[]=$satir;

  }
}

if(isset($_GET['mesaj'])) {
  if($_GET['mesaj']==1) {
    $mesaj="Derslik başarılı bir şekilde silinmiştir";
      $turu=1;
    }elseif($_GET['mesaj']==2) {
    $mesaj="Derslik başarılı bir şekilde geri alınmıştır";
      $turu=2;
    }
}


?>



<?php include "kutuphane/ust.php"; ?>
<h2 class="page-header">Derslikler</h2>
<?php mesaj_goster(@$mesaj,@$turu);?>

 <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Sıra</th>
          <th>Adı</th>
          <th>Kapasitesi</th>
          <th>Bina Adı</th>
          <th>İşlemler</th>
        </tr>
      </thead>
      <tbody>
        <?php if(empty($derslikler)==false) :?>
      	<?php foreach($derslikler as $derslik)  : ?>
      	<?php $sayi++; ?>
        <tr>
          <td><?php echo $sayi;?></td>
          <td><?php echo $derslik['adi']?></td>
          <td><?php echo $derslik['kapasite']?></td>
          <td><?php echo $derslik['bina_adi']?></td>
          <td><a href="derslik.php?sil=<?php echo $derslik['id']?>">
          <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
          </a></td>
        </tr>
       <?php endforeach; ?>
        <?php else : ?>
          <td colspan="5" style="text-align:center; background-color:#EBE8A3;">Kayıt Bulunamadı</td>
       <?php endif; ?>
      </tbody>
    </table>
</div>


<div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Sıra</th>
          <th>Adı</th>
          <th>Kapasitesi</th>
          <th>Bina Adı</th>
          <th>İşlemler</th>
        </tr>
      </thead>
      <tbody>
        <?php if(empty($silinen_derslikler)==false) :?>
        <?php foreach($silinen_derslikler as $derslik)  : ?>
        <?php $sayi++; ?>
        <tr>
          <td><?php echo $sayi;?></td>
          <td><?php echo $derslik['adi']?></td>
          <td><?php echo $derslik['kapasite']?></td>
          <td><?php echo $derslik['bina_adi']?></td>
          <td><a href="derslik.php?gerial=<?php echo $derslik['id']?>">
          <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
          </a></td>
        </tr>
       <?php endforeach; ?>
       <?php else : ?>
          <td colspan="5" style="text-align:center; background-color:#EBE8A3;">Kayıt Bulunamadı</td>
       <?php endif; ?>
      </tbody>
    </table>
</div>


<?php //print_r($_GET); ?>
<?php include "kutuphane/alt.php"; ?>