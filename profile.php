<?php
include_once "system/database.php";
include_once "system/locale.php";

session_start();
setDefaultPage("profile");
handleLocaleChange("profile.php");

if (!isset($_SESSION['admin'])) {
    if (!isset($_SESSION['session'])) {
        header("Location: index.php");
        exit();
    }
}
$user;
$update_query = "";

if (!isset($_SESSION['admin'])) {
    $user = $_SESSION['session']['user'];
} else {
    $alumni_id = filter_input(INPUT_GET, "alumni");
    $res = $db->query("SELECT * FROM alumni WHERE id='$alumni_id'");
    if ($res) {
        $user = $res->fetch_assoc();
        $update_query = "?alumni=$alumni_id";
    } else {
        header("Location: logout.php");
        exit();
    }
}
$name = uesc($user['fullname']);
$dp_path = "img/" . substr($user['id'], 0, 12) . ".jpg";
$dp_path = (file_exists($dp_path) ? $dp_path : "img/img-profile.svg");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/profile.css" />
    <link rel="stylesheet" href="css/all.css" />
    <title><?php lc("title") ?></title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><?php lc("nav-title") ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navbarNavDropdown" class="navbar-collapse collapse">
        <ul class="navbar-nav mr-auto">

        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="logout.php"><?php lc("nav-logout") ?></a>
            </li>
        </ul>
    </div>
</nav>

<div class="container-fluid d-flex h-100 flex-column profile">
    <div class="row flex-fill d-flex justify-content-start">
        <div class="col-12 main-container">
            <div class="row greeting">
                <div class="col-12 col-sm-12 col-md-2 col-lg-2">
                    <img src="<?php echo $dp_path; ?>" class="img-thumbnail profile-pic" alt="Profile picture">
                    <div class="d-block d-sm-block d-md-none d-lg-none spacer">

                    </div>
                </div>
                <div class="col text-left">
                    <h2 class="text-uppercase f-worksans">
                        <?php echo $name ?>
                    </h2>
                    <div class="table-preview">
                        <table class="text-muted">
                            <tr>
                                <td><i class="fa fa-phone-alt"></i></td>
                                <td><?=$user['contactno']?></td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-envelope"></i></td>
                                <td><?=$user['user']?></td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-home"></i></td>
                                <td><?=$user['address'];?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row content f-worksans">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="field-info">
                                <label><?php lc(".account.reg-ic") ?></label>
                                <h6><?=$user['ic']?></h6>
                            </div>

                            <div class="field-info">
                                <label><?php lc(".account.reg-dob") ?></label>
                                <h6><?=$user['dob']?></h6>
                            </div>

                            <div class="field-info">
                                <label><?php lc(".regis.step2-sess") ?></label>
                                <h6><?=$user['session']?></h6>
                            </div>

                            <div class="field-info">
                                <label><?php lc(".regis.step2-ndp") ?></label>
                                <h6><?=$user['ndp']?></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="field-info">
                                <label><?php lc(".regis.step2-occupation") ?></label>
                                <h6>
                                    <?php
                                    if ($user['employed'] == "true") {
                                        echo $user["occupation"];
                                    } else {
                                        echo "N/A";
                                    }
                                    ?>
                                </h6>
                            </div>

                            <?php
                            if ($user['employed'] == "true") {
                                ?>

                                <div class="field-info">
                                    <label><?php lc(".regis.step2-salary") ?></label>
                                    <h6><?=$user['salary']?></h6>
                                </div>

                                <div class="field-info">
                                    <label><?php lc(".regis.step2-company") ?></label>
                                    <h6><?=$user['companyaddress']?></h6>
                                </div>

                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center mt-4">
                    <a href="edit-profile.php<?=$update_query?>" class="btn btn-primary"><?php lc("submit") ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="js/core.js"></script>
<script>
    function txt(selector) {if (_1(selector).type == "checkbox") return _1(selector).checked; else return _1(selector).value;}

    function boot() {
        let btn_update = _1("#btn-update");


    }

    window.onload = boot;
</script>
</body>
</html>
