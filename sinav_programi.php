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
  $sorgu="UPDATE sinav_programi SET durum='1' WHERE id='{$sil}' LIMIT 1";
  $sonuc = mysqli_query($baglanti,$sorgu);

  if($sonuc==true) {
    $etkilenen_satir=mysqli_affected_rows($baglanti);
    if($etkilenen_satir>0) {
        header('Location:sinav_programi.php?mesaj=1');
    }else {
       $mesaj="Kayıt bulunamamıştır.";
       $turu=4;
    }  
  }else {
      $mesaj="Kayıt silinememiştir. Problem var.";
      $turu=4;
  }
}elseif(isset($_GET['gerial'])) {
  $gerial=$_GET['gerial'];
  $sorgu="UPDATE sinav_programi SET durum='0' WHERE id='{$gerial}' LIMIT 1";
  $sonuc = mysqli_query($baglanti,$sorgu);

  if($sonuc==true) {
    $etkilenen_satir=mysqli_affected_rows($baglanti);
    if($etkilenen_satir>0) {
        header('Location:sinav_programi.php?mesaj=2');
    }else {
       $mesaj="Kayıt ders bulunamamıştır.";
       $turu=4;
    }  
  }else {
      $mesaj="Kayıt ders geri alınamamıştır. Problem var.";
      $turu=4;
  }
}



$sorgu="SELECT SP.id, SP.tarih,SP.saat, DS.kodu,DS.adi AS ders_adi, A.sube,P2.unvan AS OU_unvan,P2.adi AS OU_adi,P2.soyadi AS OU_soyadi, P.unvan AS gozetmen_unvan, P.adi AS gozetmen_adi ,P.soyadi AS gozetmen_soyadi,D.adi AS derslik_adi, B.adi AS bina_adi
        FROM sinav_programi AS SP
        INNER JOIN takvim AS T ON T.id=SP.takvim_id
        INNER JOIN personel AS P ON P.id=SP.personel_id
        INNER JOIN derslik AS D ON D.id=SP.derslik_id
        INNER JOIN acilan_ders AS A ON A.id=SP.acilan_ders_id
        INNER JOIN ders AS DS ON DS.id=A.ders_id
        INNER JOIN personel AS P2 ON P2.id=A.personel_id
        INNER JOIN bina AS B ON B.id=D.bina_id
        WHERE SP.takvim_id='{$bilgi['id']}' AND SP.durum=0";
$sonuc = mysqli_query($baglanti,$sorgu);
$sayi=0;
$sayi2=0;
if (mysqli_num_rows($sonuc) > 0) {  // sorgu sonucu boş değilse
	
	 while($satir = mysqli_fetch_assoc($sonuc)) {
		$sinav_programlari[]=$satir;
 
	}
}


$sorgu="SELECT SP.id, SP.tarih,SP.saat, DS.kodu,DS.adi AS ders_adi, A.sube,P2.unvan AS OU_unvan,P2.adi AS OU_adi,P2.soyadi AS OU_soyadi, P.unvan AS gozetmen_unvan, P.adi AS gozetmen_adi ,P.soyadi AS gozetmen_soyadi,D.adi AS derslik_adi, B.adi AS bina_adi
        FROM sinav_programi AS SP
        INNER JOIN takvim AS T ON T.id=SP.takvim_id
        INNER JOIN personel AS P ON P.id=SP.personel_id
        INNER JOIN derslik AS D ON D.id=SP.derslik_id
        INNER JOIN acilan_ders AS A ON A.id=SP.acilan_ders_id
        INNER JOIN ders AS DS ON DS.id=A.ders_id
        INNER JOIN personel AS P2 ON P2.id=A.personel_id
        INNER JOIN bina AS B ON B.id=D.bina_id
        WHERE SP.durum=1";
$sonuc = mysqli_query($baglanti,$sorgu);
$sayi=0;
if (mysqli_num_rows($sonuc) > 0) {  // sorgu sonucu boş değilse
  
   while($satir = mysqli_fetch_assoc($sonuc)) {
    $silinen_sinav_programlari[]=$satir;
 
  }
}

if(isset($_GET['mesaj'])) {
  if($_GET['mesaj']==1) {
    $mesaj="Kayıt başarılı bir şekilde silinmiştir";
      $turu=1;
    }elseif($_GET['mesaj']==2) {
    $mesaj="Kayıt başarılı bir şekilde geri alınmıştır";
      $turu=2;
    }
}
?>

<?php include "kutuphane/ust.php"; ?>

<div class="table-responsive">
    <table class="table table-striped">
        
        <?php if(empty($bilgi)==false) :?>
        <tr>
          <td style="background-color:#CDE;">Aktif Sınav Dönemi :</td>
          <td style="text-align:right; background-color:#DFE;">Yıl :</td>
          <td><?php echo $bilgi['yil'];?></td>
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

<h2 class="page-header">Sınav Programı</h2>
<?php mesaj_goster(@$mesaj,@$turu);?>

 <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Sıra</th>
          <th>Ders Kodu</th>
          <th>Ders Adı</th>
          <th>Şube</th>
          <th>Personel</th>
          <th>Gözetmen</th>
          <th>Derslik Adı</th>
          <th>Bina Adı</th>
          <th>Zaman</th>
          <th>İşlemler</th>
        </tr>
      </thead>
      <tbody>
         <?php if(isset($sinav_programlari)) : ?>
      	<?php foreach($sinav_programlari as $sinav_programi)  : ?>
      	<?php $sayi++; ?>
        <tr>

          <td><?php echo $sayi;?></td>
          <td><?php echo $sinav_programi['kodu'];?></td>
          <td><?php echo $sinav_programi['ders_adi'];?></td>
          <td style="text-align:center;"><?php echo $sinav_programi['sube'];?></td>
          <td><?php echo "{$sinav_programi['OU_unvan']} {$sinav_programi['OU_adi']}
           {$sinav_programi['OU_soyadi']}";?></td>
           <td><?php echo "{$sinav_programi['gozetmen_unvan']} {$sinav_programi['gozetmen_adi']}
           {$sinav_programi['gozetmen_soyadi']}";?></td>
            <td style="text-align:center;"><?php echo $sinav_programi['derslik_adi'];?></td>
            <td style="text-align:center;"><?php echo $sinav_programi['bina_adi'];?></td>
          <td style="text-align:center;"><?php echo date("d-m-Y", strtotime($sinav_programi['tarih'])) ." / ". date("H:i", strtotime($sinav_programi['saat']));?></td>
          <td><a href="sinav_programi.php?sil=<?php echo $sinav_programi['id']?>">
              <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
              </a>
          </td>
        </tr>
       <?php endforeach; ?>
       <?php else : ?>
          <td colspan="10" style="text-align:center; background-color:#FDE">Kayıt Bulunamadı</td>
        <?php endif; ?>
      </tbody>
    </table>
</div>


<h4 class="page-header">Silinen Sınav Programı</h4>
 <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Sıra</th>
          <th>Ders Kodu</th>
          <th>Ders Adı</th>
          <th>Şube</th>
          <th>Personel</th>
           <th>Gözetmen</th>
          <th>Derslik Adı</th>
          <th>Bina Adı</th>
          <th>İşlemler</th>
        </tr>
      </thead>
      <tbody>
        <?php if(isset($silinen_sinav_programlari)) : ?>
        <?php foreach($silinen_sinav_programlari as $sinav_programi)  : ?>
        <?php $sayi2++; ?>
        <tr>
          <td><?php echo $sayi;?></td>
          <td><?php echo $sinav_programi['kodu'];?></td>
          <td><?php echo $sinav_programi['ders_adi'];?></td>
          <td style="text-align:center;"><?php echo $sinav_programi['sube'];?></td>
          <td><?php echo "{$sinav_programi['OU_unvan']} {$sinav_programi['OU_adi']}
           {$sinav_programi['OU_soyadi']}";?></td>
           <td><?php echo "{$sinav_programi['gozetmen_unvan']} {$sinav_programi['gozetmen_adi']}
           {$sinav_programi['gozetmen_soyadi']}";?></td>
            <td style="text-align:center;"><?php echo $sinav_programi['derslik_adi'];?></td>
            <td style="text-align:center;"><?php echo $sinav_programi['bina_adi'];?></td>
          <td><a href="sinav_programi.php?gerial=<?php echo $sinav_programi['id']?>">
              <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
              </a>
          </td>
        </tr>
       <?php endforeach; ?>
        <?php else : ?>
          <td colspan="10" style="text-align:center; background-color:#FDE">Kayıt Bulunamadı</td>
        <?php endif; ?>

      </tbody>
    </table>
</div>


<?php include "kutuphane/alt.php"; ?>