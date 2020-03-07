<?php
include_once "system/database.php";
include_once "system/locale.php";

session_start();
setDefaultPage("profile");
handleLocaleChange("edit-profile.php");

if (!isset($_SESSION['admin'])) {
    if (!isset($_SESSION['session'])) {
        header("Location: index.php");
        exit();
    }
}
$user;
$update_query = "";
$mode;
$tid = "none";

if (!isset($_SESSION['admin'])) {
    $user = $_SESSION['session']['user'];
    $mode = "user";
} else {
    $alumni_id = filter_input(INPUT_GET, "alumni");
    $user = $db->query("SELECT * FROM alumni WHERE id='$alumni_id'")->fetch_assoc();
    $update_query = "?alumni=$alumni_id";
    $mode = "admin";
    $tid = $alumni_id;
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
                <div class="col text-left ml-md-4">
                    <h2 class="text-uppercase f-worksans">
                        <?php lc("greet1", $name) ?>
                    </h2>
                    <p class="text-muted">
                        <?php lc("greet2") ?>
                    </p>
                </div>
            </div>
            <div class="row content f-worksans">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <?php lc("header1") ?>
                        </div>
                        <div class="card-body">
                            <form id="personalInfo">
                                 <div class="form-group">
                                    <label for="reg-name"><?php lc(".account.reg-fullname"); ?></label>
                                    <input type="text" class="form-control form-control-sm" id="reg-name"
                                           placeholder="<?php lc(".account.reg-fullname-pc") ?>" value="<?php echo $user['fullname']; ?>" data-target="fullname"/>
                                </div>
                                <div class="form-group">
                                    <label for="reg-ic"><?php lc(".account.reg-ic") ?></label>
                                    <input type="text" class="form-control form-control-sm" id="reg-ic"
                                           placeholder="<?php lc(".account.reg-ic-pc") ?>" value="<?php echo $user['ic']; ?>" data-target="ic"/>
                                </div>
                                <div class="form-group">
                                    <label for="reg-dob"><?php lc(".account.reg-dob") ?></label>
                                    <input type="date" class="form-control form-control-sm" id="reg-dob"
                                           placeholder="<?php lc(".account.reg-dob-pc") ?>" value="<?php echo $user['dob']; ?>" data-target="dob"/>
                                </div>
                                <div class="form-group">
                                    <label for="prof-session"><?php lc(".regis.step2-sess") ?></label>
                                    <input type="text" id="prof-session" class="form-control form-control-sm" placeholder="<?php lc(".regis.step2-sess-pc") ?>" data-target="session" value="<?php echo $user['session']; ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="prof-class"><?php lc(".regis.step2-ndp") ?></label>
                                    <input type="text" id="prof-class" class="form-control form-control-sm" placeholder="<?php lc(".regis.step2-ndp-pc") ?>" value="<?php echo $user['ndp']; ?>" data-target="ndp"/>
                                </div>
                                <div class="form-group">
                                    <label for="prof-phone"><?php lc(".regis.step2-contact") ?></label>
                                    <input type="tel" id="prof-phone" class="form-control form-control-sm" placeholder="<?php lc(".regis.step2-contact-pc") ?>" value="<?php echo $user['contactno']; ?>" data-target="contact"/>
                                </div>
                                <div class="form-group">
                                    <label for="prof-address" class="col-form-label"><?php lc(".regis.step2-address") ?> </label>
                                    <textarea id="prof-address" class="form-control form-control-sm" rows="3" data-target="address"><?php echo $user['address']; ?></textarea>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <?php lc("header2") ?>
                        </div>
                        <div class="card-body">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="prof-employed" <?php echo ($user["employed"] == "true" ? "checked=\"true\"" : ""); ?> data-target="employed"/>
                                <label class="custom-control-label" for="prof-employed"><?php lc(".regis.step2-employed") ?></label>
                            </div>
                            <br />
                            <div class="form-group">
                                <label for="prof-employ-occupation"><?php lc(".regis.step2-occupation") ?></label>
                                <input type="text" id="prof-employ-occupation" class="form-control form-control-sm" placeholder="<?php lc(".regis.step2-occupation-pc") ?>" value="<?php echo $user['occupation']; ?>" data-target="occupation"/>
                            </div>
                            <div class="form-group">
                                <label for="prof-employ-salary"><?php lc(".regis.step2-salary") ?></label>
                                <input type="number" id="prof-employ-salary" class="form-control form-control-sm" placeholder="2000.00" value="<?php echo $user['salary']; ?>" data-target="salary"/>
                            </div>
                            <div class="form-group">
                                <label for="prof-employ-address" class="col-form-label"><?php lc(".regis.step2-company") ?></label>
                                <textarea id="prof-employ-address" class="form-control form-control-sm" rows="3" data-target="company"><?php echo $user['companyaddress']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center mt-4">
                    <button class="btn btn-primary" id="btn-update"><?php lc("submit") ?></button>
                    <a href="profile.php" class="btn btn-secondary"><?php lc("return") ?></a>
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
    let img_file = null;

    function boot() {
        let btn_update = _1("#btn-update"),
            img_profile = _1("img.profile-pic");

        img_profile.onclick = async (e) => {
            let file_input = document.createElement("input");
            file_input.type = "file";
            file_input.accept = "image/*";
            file_input.onchange = () => {
                img_file = file_input.files[0];
                let reader = new FileReader();
                reader.onloadend = (ev) => {
                    img_profile.src = reader.result;
                }
                reader.readAsDataURL(file_input.files[0]);
            };

            file_input.click();
        }

        btn_update.onclick = async (e) => {
            let inputs = _n("input, textarea");
            let payload = new FormData();
            payload.append("mode", "<?=$mode?>");
            payload.append("id", "<?=$tid?>");

            inputs.forEach((input) => {
               let target = input.getAttribute("data-target");
               let value = (input.type == "checkbox" ? input.checked : input.value);
               payload.append(target, value);
            });

            if (img_file !== null) {
                payload.append("dp", img_file);
            }

            _n("input, textarea").forEach((n)=>{n.setAttribute("disabled", "disabled")});
            let results = await (await fetch("endpoint/update-alumni.php", {body: payload, method: "POST"})).json();
            _n("input, textarea").forEach((n)=>{n.removeAttribute("disabled")});

            switch (results.status) {
                case "success":
                    window.location.replace("profile.php<?=$update_query?>");
                    break;
                case "failed":
                    alert(results.reason);
                    break;
                case "error":
                default:
                    alert("Error while updating profile!");
                    break;
            }
        }
    }

    window.onload = boot;
</script>
</body>
</html>
