<?php
include_once "system/locale.php";
session_start();

if (isset($_SESSION["session"])) {
    header("Location: profile.php");
    exit();
}

setDefaultPage("account");
handleLocaleChange("account.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/account.css">
    <title><?php lc("title"); ?></title>
</head>
<body>
<div class="container-fluid auth d-flex flex-column h-100">
    <div class="row flex-fill d-flex justify-content-start">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-6 offset-md-3 main-container">
            <div class="row logo">
                <div class="col-12 text-center">
                    <img src="img/logo-adtec.svg" class="img logo"/>
                </div>
            </div>
            <hr/>
            <div class="content page-login">
                <div class="text-center">
                    <h3 class="font-weight-lighter text-uppercase">
                        <?php lc("title-login") ?>
                    </h3>
                    <p>
                        <?php lc("subtitle-login"); ?>
                    </p>
                </div>
                <div class="login-form f-worksans">
                    <form>
                        <div class="form-group">
                            <label for="login-email"><?php lc("login-email"); ?> </label>
                            <input type="email" class="form-control form-control-sm" id="login-email"
                                   placeholder="<?php lc("login-email-pc"); ?>">
                        </div>
                        <div class="form-group">
                            <label for="login-pass"><?php lc("login-pass"); ?></label>
                            <div class="input-group">
                                <input type="password" class="form-control form-control-sm" id="login-pass"
                                       placeholder="<?php lc("login-pass-pc"); ?>" aria-describedby="login-pass-show">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" id="login-pass-show">
                                        <?php lc("login-pass-show"); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="login-save">
                            <label for="login-save" class="form-check-label"><?php lc("login-remember"); ?></label>
                        </div>
                        <br/>
                        <input type="submit" class="btn btn-primary" value="<?php lc("login-submit") ?>"/>
                        <input type="reset" class="btn btn-secondary" value="<?php lc("login-reset") ?>"/>
                    </form>
                </div>
                <div class="text-center p-1 mt-4">
                    <a href="#" id="nav-register" class="btn btn-sm btn-link"><?php lc("login-switchmode"); ?></a>
                </div>
            </div>
            <div class="content page-signup">
                <div class="text-center">
                    <h3 class="font-weight-lighter text-uppercase">
                        <?php lc("title-reg") ?>
                    </h3>
                    <p>
                        <?php lc("subtitle-reg") ?>
                    </p>
                </div>
                <div class="login-form f-worksans">
                    <form>
                        <div class="form-group">
                            <label for="reg-name"><?php lc("reg-fullname") ?></label>
                            <input type="text" class="form-control form-control-sm" id="reg-name"
                                   placeholder="<?php lc("reg-fullname-pc") ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="reg-ic"><?php lc("reg-ic") ?></label>
                            <input type="text" class="form-control form-control-sm" id="reg-ic"
                                   placeholder="<?php lc("reg-ic-pc") ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="reg-dob"><?php lc("reg-dob") ?></label>
                            <input type="date" class="form-control form-control-sm" id="reg-dob"
                                   placeholder="<?php lc("reg-dob-pc") ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="reg-gender"><?php lc("reg-gender") ?></label>
                            <select class="form-control" id="reg-gender">
                                <option value="male"><?php lc("reg-gender-m") ?></option>
                                <option value="female"><?php lc("reg-gender-f") ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="reg-email"><?php lc("login-email") ?></label>
                            <input id="reg-email" class="form-control form-control-sm" type="email"
                                   aria-describedby="reg-email-help" placeholder="<?php lc("login-email-pc") ?>"/>
                            <small id="reg-email-help" class="form-text text-muted">
                                <?php lc("reg-email-ht") ?>
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="reg-pass"><?php lc("login-pass") ?></label>
                            <input id="reg-pass" class="form-control form-control-sm" type="password"
                                   aria-describedby="reg-pass-help" placeholder="<?php lc("login-pass-pc") ?>"/>
                            <small id="reg-pass-help" class="form-text text-muted">
                                <?php lc("reg-pass-ht") ?>
                            </small>
                        </div>
                        <br/>
                        <input type="submit" class="btn btn-primary" value="<?php lc("reg-submit") ?>"/>
                        <input type="reset" class="btn btn-secondary" value="<?php lc("reg-submit") ?>"/>
                    </form>
                </div>
                <div class="text-center p-1 mt-4">
                    <a href="#" id="nav-login" class="btn btn-sm btn-link"><?php lc("reg-switchmode") ?></a>
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
    function txt(selector) {
        return _1(selector).value;

    }
    function switchPage(content1, content2) {
        let c1 = _1(content1);
        let c2 = _1(content2);

        c1.classList.remove("content-visible");
        c2.classList.add("content-visible");
    }

    function boot() {

        let forms = _n("form");
        let firstContent = _1(".auth .content");
        firstContent.classList.add("content-visible");

        let link_register = _1("#nav-register"),
            link_login = _1("#nav-login"),
            btn_showpass = _1("#login-pass-show"),
            txt_pass = _1("#login-pass"),
            login_form = _1(".page-login form"),
            register_form = _1(".page-signup form");

        login_form.onsubmit = (e) => {
            async function sendPayload() {
                let payload = new FormData();
                payload.append("u", txt("#login-email"));
                payload.append("p", txt("#login-pass"));

                _n(".page-login input").forEach((n) => {n.setAttribute("disabled", "disabled");});
                let result = await (await fetch("endpoint/login.php", {body: payload, method: 'POST'})).json();
                _n(".page-login input").forEach((n) => {n.removeAttribute("disabled");});

                switch (result.status) {
                    case "success":
                        window.location.replace("profile.php");
                        break;
                    case "failed":
                        alert(result.reason);
                        break;
                    case "error":
                    default:
                        alert("Failed to login!");
                        break;
                }
            }

            e.preventDefault();
            sendPayload();
            return false;
        }



        register_form.onsubmit = (e) => {
            async function sendPayload() {
                let payload = new FormData();
                payload.append("u", txt("#reg-email"));
                payload.append("p", txt("#reg-pass"));
                payload.append("fullname", txt("#reg-name"));
                payload.append("ic", txt("#reg-ic"));
                payload.append("dob", txt("#reg-dob"));
                payload.append("gender", txt("#reg-gender"));

                _n(".page-signup input").forEach((n) => {
                    n.setAttribute("disabled", "disabled")
                });

                let result = await (await fetch("endpoint/register.php", {body: payload, method: "post"})).json();

                _n(".page-signup input").forEach((n) => {
                    n.removeAttribute("disabled")
                });

                switch (result.status) {
                    case "success":
                        console.log(result);
                        window.location.replace("registration.php");
                        break;
                    case "failed":
                        alert(result.reason);
                        break;
                    case "error":
                    default:
                        alert("Failed to register!");
                        break;
                }
            }

            e.preventDefault();
            sendPayload();
            return false;
        }

        link_register.onclick = (e) => {
            switchPage(".page-login", ".page-signup");
            return;
        };

        link_login.onclick = (e) => {
            switchPage(".page-signup", ".page-login");
            return;
        }

        btn_showpass.onclick = (e) => {
            let vals = [];
            if (e.target.innerText === "<?php lc("login-pass-show"); ?>") {
                vals = ["text", "<?php lc("login-pass-hide"); ?>"];
            } else {
                vals = ["password", "<?php lc("login-pass-show"); ?>"];
            }

            e.target.innerText = vals[1];
            txt_pass.setAttribute("type", vals[0]);
        }

        let args = [...new URLSearchParams(document.location.search).entries()].reduce((q, [k, v]) => Object.assign(q, {[k]: v}), {});
        if (args.page) {
            if (args.page == "login") {
                switchPage(".page-signup", ".page-login");
            } else if (args.page == "register") {
                switchPage(".page-login", ".page-signup");
            }
        }
    }

    window.onload = boot;
</script>
</body>
</html>
