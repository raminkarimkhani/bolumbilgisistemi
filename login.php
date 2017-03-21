<?php include "kutuphane/baglanti_login.php"; ?>

<?php


if(isset($_POST['giris'])) {

	$sicil=$_POST['sicil'];
	$sifre=$_POST['parola'];

	$sorgusicil="SELECT * FROM personel WHERE sicilno='{$sicil}' AND parola='{$sifre}'";
	$sonucsicil= mysqli_query($baglanti,$sorgusicil);
	if (mysqli_num_rows($sonucsicil) > 0)
	{
		$girisbilgileri = mysqli_fetch_array($sonucsicil);
	}else {
		$mesaj="Mail veya Şifre Yanlış";
		$turu=4;
	}
	if($girisbilgileri['sicilno']==$sicil && $girisbilgileri['parola']==$sifre && $sifre!="0") {
		$_SESSION['id']=$girisbilgileri['id'];
		$_SESSION['sicil']=$sicil;
		$guncelle="UPDATE personel SET durum='1' WHERE sicilno='{$sicil}' LIMIT 1";
	  $sonuc = mysqli_query($baglanti,$guncelle);
		if($sonuc=true)
		{

		}else {
			# code...
		}
		header('Location:index.php');
	}else {
		$mesaj="Mail veya Şifre Yanlış";
		$turu=4;
	}

}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.ico">

    <title>Bölüm Bilgi Sistemi Yönetici Paneli</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin" action="login.php" method="post">
        <h2 class="form-signin-heading">BBS Yönetici Paneli</h2>
        <?php mesaj_goster(@$mesaj,@$turu);?>
        <label for="inputEmail" class="sr-only">Sicil Numarası</label>
        <input type="number" name="sicil" title="Lütfen sayı giriniz" id="inputEmail" class="form-control" placeholder="Sicil Numarası" required autofocus>
        <label for="inputPassword" class="sr-only">Parola</label>
        <input type="password" name="parola" pattern=".{8,16}" title="8-16 karakter arası parola giriniz" maxlength="16" id="inputPassword" class="form-control" placeholder="Parola" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Hatırla Beni
          </label>
        </div>
        <button  name="giris" value="giris" class="btn btn-lg btn-primary btn-block" type="submit">Giriş Yap</button>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
    <?php //print_r($_POST); ?>
  </body>
</html>
