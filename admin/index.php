<?php
session_start();

if (isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit();
}

function lc() {
    $args = func_get_args();
    echo "ok";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/account.css">
    <title>Login to Admin Panel</title>
</head>
<body>
<div class="container-fluid auth d-flex flex-column h-100">
    <div class="row flex-fill d-flex justify-content-start">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-6 offset-md-3 main-container">
            <div class="row logo">
                <div class="col-12 text-center">
                    <img src="../img/logo-adtec.svg" class="img logo"/>
                </div>
            </div>
            <hr/>
            <div class="content page-login">
                <div class="text-center">
                    <h3 class="font-weight-lighter text-uppercase">
                        Admin Login Page
                    </h3>
                    <p>
                        Login with your admin credential info to access the admin control panel.
                    </p>
                </div>
                <div class="login-form f-worksans">
                    <form>
                        <div class="form-group">
                            <label for="login-email">Admin ID: </label>
                            <input type="text" class="form-control form-control-sm" id="login-id"
                                   placeholder="Your admin ID...">
                        </div>
                        <div class="form-group">
                            <label for="login-pass">Admin Password:</label>
                            <div class="input-group">
                                <input type="password" class="form-control form-control-sm" id="login-pass"
                                       placeholder="Your admin password..." aria-describedby="login-pass-show">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" id="login-pass-show">
                                        Show
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <input type="submit" class="btn btn-primary" value="Login"/>
                        <input type="reset" class="btn btn-secondary" value="Reset"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../js/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="../js/core.js"></script>
<script>
    function txt(selector) {
        return _1(selector).value;

    }
    function boot() {

        let forms = _n("form");
        let firstContent = _1(".auth .content");
        firstContent.classList.add("content-visible");

        let btn_showpass = _1("#login-pass-show"),
            txt_pass = _1("#login-pass"),
            login_form = _1(".page-login form");

        login_form.onsubmit = (e) => {
            async function sendPayload() {
                let payload = new FormData();
                payload.append("u", txt("#login-id"));
                payload.append("p", txt("#login-pass"));

                _n(".page-login input").forEach((n) => {n.setAttribute("disabled", "disabled");});
                let result = await (await fetch("action-login.php", {body: payload, method: 'POST'})).json();
                _n(".page-login input").forEach((n) => {n.removeAttribute("disabled");});

                switch (result.status) {
                    case "success":
                        window.location.replace("admin.php");
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

        btn_showpass.onclick = (e) => {
            let vals = [];
            if (e.target.innerText === "Show") {
                vals = ["text", "Hide"];
            } else {
                vals = ["password", "Show"];
            }

            e.target.innerText = vals[1];
            txt_pass.setAttribute("type", vals[0]);
        }
    }

    window.onload = boot;
</script>
</body>
</html>
