<?php include "kutuphane/baglanti.php"; ?>
<?php 

if(isset($_GET['sil'])) {
  $sil=$_GET['sil'];
  $sorgu="UPDATE ders SET durum='1' WHERE id='{$sil}' LIMIT 1";
  $sonuc = mysqli_query($baglanti,$sorgu);

  if($sonuc==true) {
    $etkilenen_satir=mysqli_affected_rows($baglanti);
    if($etkilenen_satir>0) {
        header('Location:ders.php?mesaj=1');
    }else {
       $mesaj="Ders bulunamamıştır.";
       $turu=4;
    }
  }else {
      $mesaj="Ders silinememiştir. Problem var.";
      $turu=4;
  }
}

if(isset($_GET['gerial'])) {
  $gerial=$_GET['gerial'];
  $sorgu="UPDATE ders SET durum='0' WHERE id='{$gerial}' LIMIT 1";
  $sonuc = mysqli_query($baglanti,$sorgu);

  if($sonuc==true) {
    $etkilenen_satir=mysqli_affected_rows($baglanti);
    if($etkilenen_satir>0) {
        header('Location:ders.php?mesaj=2');
    }else {
       $mesaj="Ders bulunamamıştır.";
       $turu=4;
    }
  }else {
      $mesaj="Ders geri alınamamıştır. Problem var.";
      $turu=4;
  }
}


$sorgu="SELECT * FROM ders WHERE durum='0' ORDER BY donem";
$sonuc = mysqli_query($baglanti,$sorgu);
$sayi=0;
if (mysqli_num_rows($sonuc) > 0) {  // sorgu sonucu boş değilse
	
	 while($satir = mysqli_fetch_assoc($sonuc)) {
		$dersler[]=$satir;
 
	}
}

$sorgu="SELECT * FROM ders WHERE durum='1' ORDER BY donem";
$sonuc = mysqli_query($baglanti,$sorgu);
$sayi=0;
if (mysqli_num_rows($sonuc) > 0) {  // sorgu sonucu boş değilse
  
   while($satir = mysqli_fetch_assoc($sonuc)) {
    $silinen_dersler[]=$satir;
 
  }
}


if(isset($_GET['mesaj'])) {
  if($_GET['mesaj']==1) {
    $mesaj="Ders başarılı bir şekilde silinmiştir";
      $turu=1;
    }elseif($_GET['mesaj']==2) {
    $mesaj="Ders başarılı bir şekilde geri alınmıştır";
      $turu=2;
    }
}

?>

<?php include "kutuphane/ust.php"; ?>

<h2 class="page-header">Dersler</h2>
<?php mesaj_goster(@$mesaj,@$turu);?>
 <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Sıra</th>
          <th>Ders Kodu</th>
          <th>Ders Adı</th>
          <th>Kredisi</th>
          <th>Dönem</th>
          <th>İşlemler</th>
        </tr>
      </thead>
      <tbody>
      	<?php foreach($dersler as $ders)  : ?>
      	<?php $sayi++; ?>
        <tr>
          <td><?php echo $sayi;?></td>
          <td><?php echo $ders['kodu'];?></td>
          <td><?php echo $ders['adi'];?></td>
          <td><?php echo $ders['kredisi'];?></td>
          <td><?php echo $ders['donem'] . ". dönem";?></td>
          <td><a href="ders.php?sil=<?php echo $ders['id']; ?>">
          <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
          </a></td>
        </tr>
       <?php endforeach; ?>
      </tbody>
    </table>
</div>


<h4 class="page-header">Silinen Dersler</h4>
 <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Sıra</th>
          <th>Ders Kodu</th>
          <th>Ders Adı</th>
          <th>Kredisi</th>
          <th>Dönem</th>
          <th>İşlemler</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($silinen_dersler as $ders)  : ?>
        <?php $sayi++; ?>
        <tr>
          <td><?php echo $sayi;?></td>
          <td><?php echo $ders['kodu'];?></td>
          <td><?php echo $ders['adi'];?></td>
          <td><?php echo $ders['kredisi'];?></td>
          <td><?php echo $ders['donem'] . ". dönem";?></td>
         <td><a href="ders.php?gerial=<?php echo $ders['id']?>">
          <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
          </a></td>
        </tr>
       <?php endforeach; ?>
      </tbody>
    </table>
</div>


<?php //print_r($_GET); ?>
<?php include "kutuphane/alt.php"; ?>