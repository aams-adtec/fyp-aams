<?php
include_once "system/database.php";
include_once "system/locale.php";
setDefaultPage("regis");
handleLocaleChange("registration.php");

session_start();

if (!isset($_SESSION['registration']))
{
    header("Location: index.php");
    exit();
}

$fullname = uesc($_SESSION["registration"]["user"]['fullname']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/registration.css" />
    <title><?php lc("title"); ?></title>
</head>
<body>

<div class="container-fluid d-flex h-100 flex-column regis">
    <div class="row flex-fill d-flex justify-content-start">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-6 offset-md-3 main-container">
            <div class="row greeting">
                <div class="text-center">
                    <h2 class=" text-uppercase f-worksans">
                        <?php lc("greet1", ($fullname ? $fullname : "fullname")) ?>
                    </h2>
                    <p class="text-muted">
                        <?php lc("greet2"); ?>
                    </p>
                </div>
            </div>
            <div class="profile f-worksans">
                <div class="row">
                    <div class="col-12 col-sm-4 text-center">
                        <img id="img-prof" src="img/img-profile.svg" class="img img-thumbnail" style="width: 128px;">
                    </div>
                    <div class="col-12 col-sm mt-3 mt-sm-0">
                        <h5><?php lc("step1"); ?></h5>
                        <br />
                        <input type="file" class="form-control" id="prof-img" accept="image/*"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div style="text-align: center;">
                            <h5><?php lc("step2"); ?></h5>
                        </div>
                        <br />
                        <form class="ml-sm-3 mr-sm-3">
                            <div class="form-group row">
                                <label for="prof-session" class="col-sm-3 col-form-label"><?php lc("step2-sess"); ?></label>
                                <div class="col-sm-9">
                                    <input type="text" id="prof-session" class="form-control" placeholder="<?php lc("step2-sess-pc") ?>" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="prof-class" class="col-sm-3 col-form-label"><?php lc("step2-ndp") ?></label>
                                <div class="col-sm-9">
                                    <input type="text" id="prof-class" class="form-control" placeholder="<?php lc("step2-ndp-pc") ?>" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="prof-phone" class="col-sm-3 col-form-label"><?php lc("step2-contact") ?></label>
                                <div class="col-sm-9">
                                    <input type="tel" id="prof-phone" class="form-control" placeholder="<?php lc("step2-contact-pc") ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="prof-address" class="col-form-label"><?php lc("step2-address") ?></label>
                                <textarea id="prof-address" class="form-control" rows="3"></textarea>
                            </div>
                            <br />
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="prof-employed" />
                                <label class="custom-control-label" for="prof-employed"><?php lc("step2-employed") ?></label>
                            </div>
                            <div class="employment d-none">
                                <div class="form-group row">
                                    <label for="prof-employ-occupation" class="col-sm-3 col-form-label"><?php lc("step2-occupation") ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" id="prof-employ-occupation" class="form-control" placeholder="<?php lc("step2-occupation-pc") ?>" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="prof-employ-salary" class="col-sm-3 col-form-label"><?php lc("step2-salary") ?></label>
                                    <div class="col-sm-9">
                                        <input type="number" id="prof-employ-salary" class="form-control" placeholder="2000.00" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="prof-employ-address" class="col-form-label"><?php lc("step2-company") ?></label>
                                    <textarea id="prof-employ-address" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="buttons text-center">
                                <input type="submit" class="btn btn-primary" value="<?php lc("submit") ?>" />
                                <input type="reset" class="btn btn-secondary" value="<?php lc("reset") ?>" />
                            </div>
                        </form>
                    </div>
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
    function txt(selector) { return document.querySelector(selector).value; }
    function boot() {
        let form = _1("form");
        let chk_employed = _1("#prof-employed");
        let section_employment = _1(".employment");
        let file_prof = _1("#prof-img");
        let img_prof = _1("#img-prof");

        form.onsubmit = (e) => {
            async function sendPayload() {
                let payload = new FormData();
                payload.append("image", file_prof.files[0]);
                payload.append("session", txt("#prof-session"));
                payload.append("ndp", txt("#prof-class"));
                payload.append("contact", txt("#prof-phone"));
                payload.append("address", txt("#prof-address"));
                payload.append("employed", _1("#prof-employed").checked);
                payload.append("occupation", txt("#prof-employ-occupation"));
                payload.append("salary", txt("#prof-employ-salary"));
                payload.append("company", txt("#prof-employ-address"));

                _n(".profile input").forEach((n) => {n.setAttribute("disabled", "disabled")});

                let results = await (await fetch("endpoint/update-profile.php", {body: payload, method: 'post'})).json();

                _n(".profile input").forEach((n) => {n.removeAttribute("disabled")});

                switch (results.status) {
                    case "success":
                        window.location.replace("account.php?page=login");
                        break;
                    case "failed":
                        alert(results.reason);
                        break;
                    case "error":
                    default:
                        alert("Cannot update profile!");
                        break;
                }
            }

            e.preventDefault();
            sendPayload();
            return false;
        }

        chk_employed.onchange = (e) => {
            if (e.target.checked) {
                section_employment.classList.remove("d-none");
                section_employment.scrollIntoView(true);
            } else {
                section_employment.classList.add("d-none");
            }
        }

        file_prof.onchange = (e) => {
            let reader = new FileReader();
            let file = file_prof.files[0];

            reader.onload = (f) => {
                img_prof.src=reader.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    }

    window.onload = boot;

</script>
</body>
</html>
