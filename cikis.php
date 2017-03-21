<?php include "kutuphane/baglanti.php"; ?>

<?php
session_destroy();
$guncelle="UPDATE personel SET durum='0'";
$sonuc = mysqli_query($baglanti,$guncelle);
header('Location:login.php');

?>
