<?php
include_once "system/locale.php";
setDefaultPage("index");
handleLocaleChange("index.php");

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/index.css" />
    <title><?php lc("title"); ?></title>
</head>
<body>
<div class="bg"></div>
<div class="hero jumbotron jumbotron-fluid ">
    <div class="container">
        <div class="row">
            <div class="col-6 logo logo-ksm"></div>
            <div class="col-6 logo logo-adtec"></div>
        </div>
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="intro-info text-center">
                    <h4 class="f-worksans text-uppercase">
                        <?php lc("title1"); ?>
                    </h4>
                    <h5 class="f-montserrat"><?php lc("title2"); ?></h5>
                    <br />
                    <div class="address">
                        <p class="f-montserrat font-weight-bold m-0">
                            Pusat Latihan Teknologi Tinggi (ADTEC) Melaka
                        </p>
                        <p class="f-worksans">
                            Bandar Vendor Taboh Naning, <br />
                            78000 Alor Gajah <br />
                            Melaka
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <a href="account.php?page=register" class="btn btn-start"><?php lc("signup"); ?></a>
                <br />
                <a href="account.php?page=login" class="login-link btn-link btn btn-sm"><?php lc("login"); ?></a>
            </div>
        </div>
    </div>
</div>
<div class="bottom-bar f-worksans">
    <a href="index.php?locale=en" class="btn btn-link btn-sm">ENG</a>
    <a href="index.php?locale=my" class="btn btn-link btn-sm">MY</a>
</div>

<script src="js/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>

</script>
</body>
</html>
