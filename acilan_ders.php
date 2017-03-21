<?php include "kutuphane/baglanti.php"; ?>
<?php 
$sorgu="SELECT T.id,T.yil,T.donem,T.durum, S.turu
        FROM takvim AS T
        INNER JOIN sinav AS S ON S.id=T.sinav_id
        WHERE durum=1";
$sonuc = mysqli_query($baglanti,$sorgu);

$bilgi = mysqli_fetch_array($sonuc);


if(isset($_GET['sil'])) {
  $sil=$_GET['sil'];
  $sorgu="UPDATE acilan_ders SET durum='1' WHERE id='{$sil}' LIMIT 1";
  $sonuc = mysqli_query($baglanti,$sorgu);

  if($sonuc==true) {
    $etkilenen_satir=mysqli_affected_rows($baglanti);
    if($etkilenen_satir>0) {
        header('Location:acilan_ders.php?mesaj=1');
    }else {
       $mesaj="Açılan ders bulunamamıştır.";
       $turu=4;
    }  
  }else {
      $mesaj="Açılan ders silinememiştir. Problem var.";
      $turu=4;
  }
}elseif(isset($_GET['gerial'])) {
  $gerial=$_GET['gerial'];
  $sorgu="UPDATE acilan_ders SET durum='0' WHERE id='{$gerial}' LIMIT 1";
  $sonuc = mysqli_query($baglanti,$sorgu);

  if($sonuc==true) {
    $etkilenen_satir=mysqli_affected_rows($baglanti);
    if($etkilenen_satir>0) {
        header('Location:acilan_ders.php?mesaj=2');
    }else {
       $mesaj="Açılan ders bulunamamıştır.";
       $turu=4;
    }  
  }else {
      $mesaj="Açılan ders geri alınamamıştır. Problem var.";
      $turu=4;
  }
}
$yil=$bilgi['yil'];
$donem=$bilgi['donem'];

$sorgu="SELECT A.id, A.sube, D.kodu, D.adi AS ders_adi, D.donem, P.adi,P.soyadi,P.unvan
        FROM acilan_ders AS A
        INNER JOIN ders AS D ON D.id=A.ders_id
        INNER JOIN personel AS P ON P.id=A.personel_id
        INNER JOIN takvim AS T ON T.id=A.takvim_id
        WHERE T.yil='{$yil}' AND T.donem='{$donem}' AND A.durum=0
        ORDER BY D.donem,D.kodu,A.sube";
$sonuc = mysqli_query($baglanti,$sorgu);
$sayi=0;
if (mysqli_num_rows($sonuc) > 0) {  // sorgu sonucu boş değilse
	
	 while($satir = mysqli_fetch_assoc($sonuc)) {
		$acilan_dersler[]=$satir;
 
	}
}


$sorgu="SELECT A.id, A.sube, D.kodu, D.adi AS ders_adi, D.donem, P.adi,P.soyadi,P.unvan
        FROM acilan_ders AS A
        INNER JOIN ders AS D ON D.id=A.ders_id
        INNER JOIN personel AS P ON P.id=A.personel_id
        WHERE A.durum=1
        ORDER BY D.donem,D.kodu,A.sube";
$sonuc = mysqli_query($baglanti,$sorgu);
$sayi=0;
if (mysqli_num_rows($sonuc) > 0) {  // sorgu sonucu boş değilse
  
   while($satir = mysqli_fetch_assoc($sonuc)) {
    $silinen_acilan_dersler[]=$satir;
 
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
<h2 class="page-header">Açılan Dersler</h2>
<?php mesaj_goster(@$mesaj,@$turu);?>

 <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Sıra</th>
          <th>Ders Kodu</th>
          <th>Ders Adı</th>
          <th>Dönemi</th>
          <th>Personel</th>
          <th>Şube</th>
          <th>İşlemler</th>
        </tr>
      </thead>
      <tbody>
        <?php if(isset($acilan_dersler)) : ?>
      	<?php foreach($acilan_dersler as $acilan_ders)  : ?>
      	<?php $sayi++; ?>
        <tr>
          <td><?php echo $sayi;?></td>
          <td><?php echo $acilan_ders['kodu'];?></td>
          <td><?php echo $acilan_ders['ders_adi'];?></td>
          <td style="text-align:center;"><?php echo $acilan_ders['donem'];?></td>
          <td><?php echo "{$acilan_ders['unvan']} {$acilan_ders['adi']}
           {$acilan_ders['soyadi']}";?></td>
          <td style="text-align:center;"><?php echo $acilan_ders['sube'];?></td>
           <td><a href="acilan_ders.php?sil=<?php echo $acilan_ders['id']?>">
          <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
          </a></td>
        </tr>
       <?php endforeach; ?>
         <?php else : ?>
          <tr>
          <td colspan="7" style="text-align:center; background-color:#FDE">Kayıt Bulunamadı</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
</div>


<h4 class="page-header">Silinen Açılmış Dersler</h4>
 <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Sıra</th>
          <th>Ders Kodu</th>
          <th>Ders Adı</th>
          <th>Dönemi</th>
          <th>Personel</th>
          <th>Şube</th>
          <th>İşlemler</th>
        </tr>
      </thead>
      <tbody>
        <?php if(isset($silinen_acilan_dersler)) : ?>
        <?php foreach($silinen_acilan_dersler as $acilan_ders)  : ?>
        <?php $sayi++; ?>
        <tr>
          <td><?php echo $sayi;?></td>
          <td><?php echo $acilan_ders['kodu'];?></td>
          <td><?php echo $acilan_ders['ders_adi'];?></td>
          <td style="text-align:center;"><?php echo $acilan_ders['donem'];?></td>
          <td><?php echo "{$acilan_ders['unvan']} {$acilan_ders['adi']}
           {$acilan_ders['soyadi']}";?></td>
          <td style="text-align:center;"><?php echo $acilan_ders['sube'];?></td>
           <td><a href="acilan_ders.php?gerial=<?php echo $acilan_ders['id']?>">
          <span class="glyphicon glyphicon-hand-left" aria-hidden="true"></span>
          </a></td>
        </tr>
         <?php endforeach; ?>
        <?php else : ?>
          <tr>
          <td colspan="7" style="text-align:center; background-color:#FDE">Kayıt Bulunamadı</td>
          </tr>
        <?php endif; ?>

      </tbody>
    </table>
</div>


<?php include "kutuphane/alt.php"; ?>