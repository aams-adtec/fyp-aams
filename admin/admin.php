<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/admin.css" />
    <title>Admin Page - AAMS</title>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Admin Page</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navbarNavDropdown" class="navbar-collapse collapse">
        <ul class="navbar-nav mr-auto">
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container-fluid d-flex h-100 flex-column">
    <div class="row flex-fill d-flex justify-content-start">
        <div class="col-12 main-container">
            <div class="row greeting">
                <div class="col text-left ml-md-4">
                    <h2 class="text-uppercase f-worksans">
                        Hello, Admin!
                    </h2>
                    <p class="text-muted">
                        This is where you can see all registered Alumni accounts.
                    </p>
                </div>
            </div>
            <div class="row content">
                <div class="accordion" id="controlpanel">
                    <div class="card" id="alumnis">
                        <div class="card-header" id="header-alumnis">
                            <h3 class="mb-0">
                                <button class="btn btn-link btn-sm" type="button" data-toggle="collapse" data-target="#content-alumnis" aria-expanded="true" aria-controls="content-alumnis">
                                    Registered Alumnis
                                </button>
                            </h3>
                        </div>
                        <div id="content-alumnis" class="collapse show" aria-labelledby="header-alumnis" data-parent="#controlpanel">
                            <div class="card-body">

                                <div class="tools-alumnis">
                                    <form id="tools-form">
                                        <h6 class="mb-3 font-weight-bolder text-muted text-uppercase">Add new Alumni</h6>
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-1 mb-md-0">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="tools-lbl-name">Full Name</span>
                                                    </div>
                                                    <input data-prop="fullname" type="text" id="tools-name" class="form-control form-control-sm" aria-describedby="#tools-lbl-name" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3 mb-1 mb-md-0">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend"><span class="input-group-text"
                                                                                           id="tools-lbl-ic">IC No.</span>
                                                    </div>
                                                    <input data-prop="ic" type="text" aria-describedby="#tools-lbl-ic" class="form-control form-control-sm"
                                                           id="tools-ic">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3 mb-1 mb-md-0">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend"><span class="input-group-text"
                                                                                           id="tools-lbl-gender">Gender</span>
                                                    </div>
                                                    <select data-prop="gender" class="form-control form-control-sm" id="tools-gender" aria-describedby="#tools-lbl-ic">
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-12 col-md-3 mb-1 mb-md-0">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend"><span class="input-group-text"
                                                                                           id="tools-lbl-dob">Date of Birth</span></div>
                                                    <input data-prop="dob" type="date" aria-describedby="#tools-lbl-dob"
                                                           class="form-control form-control-sm" id="tools-dob">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3 mb-1 mb-md-0">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend"><span class="input-group-text"
                                                                                           id="tools-lbl-session">Session</span>
                                                    </div>
                                                    <input data-prop="session" type="text" aria-describedby="#tools-lbl-session"
                                                           class="form-control form-control-sm" id="tools-session">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3 mb-1 mb-md-0">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend"><span class="input-group-text"
                                                                                           id="tools-lbl-ndp">NDP</span>
                                                    </div>
                                                    <input data-prop="ndp" type="text" aria-describedby="#tools-lbl-ndp"
                                                           class="form-control form-control-sm" id="tools-ndp">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3 mb-1 mb-md-0">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend"><span class="input-group-text"
                                                                                           id="tools-lbl-contact">Contact No.</span>
                                                    </div>
                                                    <input data-prop="contact" type="text" aria-describedby="#tools-lbl-contact"
                                                           class="form-control form-control-sm" id="tools-contact">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-12 mb-md-0 mb-1">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend"><span class="input-group-text"
                                                                                           id="tools-lbl-address">Address</span>
                                                    </div>
                                                    <textarea data-prop="address" name="tools-address" id="tools-address"
                                                              class="form-control form-control-sm"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-12 col-md-1 mb-md-0 mb-1">
                                                <div class="custom-control custom-checkbox">
                                                    <input data-prop="working" type="checkbox" class="custom-control-input" id="tools-working" checked="true" data-target="employed">
                                                    <label class="custom-control-label" for="tools-working">Working</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3 mb-md-0 mb-1">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend"><span class="input-group-text"
                                                                                           id="tools-lbl-salary">Salary</span>
                                                    </div>
                                                    <input data-prop="salary" type="number" min="0" aria-describedby="#tools-lbl-salary"
                                                           class="form-control form-control-sm" id="tools-salary">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3 mb-md-0 mb-1">
                                                <div class="input-group input-group-sm">
                                                    <div  class="input-group-prepend"><span class="input-group-text"
                                                                                           id="tools-lbl-occupation">Occupation</span>
                                                    </div>
                                                    <input data-prop="occupation" type="text" aria-describedby="#tools-lbl-occupation"
                                                           class="form-control form-control-sm" id="tools-occupation">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-5 mb-md-0 mb-1">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend"><span class="input-group-text"
                                                                                           id="tools-lbl-company">Company Address:</span>
                                                    </div>
                                                    <textarea data-prop="company" name="tools-company" id="tools-company"
                                                              class="form-control form-control-sm"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-sm btn-primary">Add</button>
                                            <button type="reset" class="btn btn-sm btn-secondary">Clear</button>
                                        </div>
                                    </form>
                                </div>
                                <hr />
                                <div class="table-responsive-md">
                                    <table id="table-alumnis" class="table table-bordered">
                                        <thead class="thead-dark">
                                        <tr>
                                            <td>Name</td>
                                            <td>IC</td>
                                            <td>Date of Birth</td>
                                            <td>Session</td>
                                            <td>NDP</td>
                                            <td>Contact No</td>
                                            <td>Action</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td colspan="7">Loading...</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="settings">
                        <div class="card-header" id="header-settings">
                            <h3 class="mb-0">
                                <button class="btn btn-link btn-sm" type="button" data-toggle="collapse" data-target="#content-settings" aria-expanded="true" aria-controls="content-settings">
                                    Site Settings
                                </button>
                            </h3>
                        </div>
                        <div id="content-settings" class="collapse" aria-labelledby="header-settings" data-parent="#controlpanel">
                            <div class="card-body">
                                Coming soon!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-details" tabindex="-1" role="dialog" aria-labelledby="modal-details-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-details-title">More Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="details-field details-addr">
                    <h5>Address:</h5>
                    <p>
                    </p>
                </div>

                <div class="details-field details-work">
                    <h5>Is working?</h5>
                    <p></p>
                </div>

                <div class="details-companyinfo">
                    <div class="details-field details-occupation">
                        <h5>Occupation</h5>
                        <p></p>
                    </div>
                    <div class="details-field details-occupation">
                        <h5>Salary</h5>
                        <p></p>
                    </div>
                    <div class="details-field details-company">
                        <h5>Company Address</h5>
                        <p></p>
                    </div>
                </div>

                <div class="details-templogin hide">
                    <div class="details-field details-temail">
                        <h5>Temporary Email Address:</h5>
                        <p></p>
                    </div>
                    <div class="details-field details-tpass">
                        <h5>Temporary Login Pass:</h5>
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="../js/jquery.js"></script>
<script src="../js/popper.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/core.js"></script>
<script>
    let alumnis = {};

    function showAlumniDetails(id) {
        let detail = alumnis[`a-${id}`];
        let modal = $("#modal-details");
        modal.find(".details-addr > p").html(detail.addr);
        modal.find(".details-work > p").html(detail.empl === "true" ? "Yes" : "No");

        if (detail.empl === "false") {
            modal.find(".details-companyinfo").addClass("d-none");
        } else {
            modal.find(".details-occupation > p").html(detail.occu);
            modal.find(".details-salary > p").html(`RM${detail.salary}`);
            modal.find(".details-company > p").html(detail.company);
        }

        if (!(!detail.temp)) {
            modal.find(".details-templogin").removeClass("hide");
            modal.find(".details-temail > p").html(detail.temp.email);
            modal.find(".details-tpass > p").html(detail.temp.pass);
        } else {
            modal.find(".details-templogin").addClass("hide");
            modal.find(".details-temail > p").html("none");
            modal.find(".details-tpass > p").html("none");
        }

        modal.modal('show');
    }
    async function preloadAlumni() {
        let payload = new FormData();
        let tbody = _1("table#table-alumnis tbody");

        let results = await (await fetch("action-alumni.php", {method: "POST"})).json();
        tbody.innerHTML = "";

        for (let alumni of results.result) {
            alumnis[`a-${alumni.id}`] = alumni;

            let row = document.createElement("tr");
            row.classList.add("alumni-row");
            row.setAttribute("data-id", alumni.id);

            let row_html = `
                <td>${alumni.name}</td>
                    <td>${alumni.ic}</td>
                    <td>${alumni.dob}</td>
                    <td>${alumni.sess}</td>
                    <td>${alumni.ndp}</td>
                    <td>${alumni.contact}</td>
                    <td>
                        <button class="btn btn-sm btn-primary alumni-details">Details</button>
                        <button class="btn btn-sm btn-secondary alumni-delete">Delete</button>
                    </td>
            `;

            row.innerHTML = row_html.trim();
            row.querySelectorAll("td:not(:last-child)").forEach((td) => {
               td.onclick = (e) => {
                   let row = td.closest("tr.alumni-row");
                   if (!row.classList.contains("bg-success")) {
                       row.classList.add("bg-success");
                       row.classList.add("text-light");
                   } else {
                       row.classList.remove("bg-success");
                       row.classList.remove("text-light");
                   }
               }
            });
            tbody.appendChild(row);
        }
        _n(".alumni-details").forEach((btn) => {
            btn.onclick = (e) => {
                let parent = btn.closest(".alumni-row");
                showAlumniDetails(parent.getAttribute("data-id"));
            }
        });
        _n(".alumni-delete").forEach((btn) => {
            btn.onclick = async (e) => {
                let parent = btn.closest(".alumni-row");
                let id = parent.getAttribute("data-id");

                if (confirm(`Do you want to delete this user?\n\nName: ${alumnis[`a-${id}`].name}`)) {
                    let pin = prompt("Please enter your Admin PIN to continue this action: ");
                    let payload = new FormData();
                    payload.append("action", "delete");
                    payload.append("id", id);
                    payload.append("pin", pin);

                    btn.setAttribute("disabled", "disabled");
                    let result = await (await fetch("action-alumni.php", {body: payload, method: "POST"})).json();
                    btn.removeAttribute("disabled");

                    switch (result.status) {
                        case "success":
                            delete alumnis[`a-${id}`];
                            parent.remove();
                            break;
                        case "failed":
                            alert(result.reason);
                            break;
                        case "error":
                        default:
                            alert("Error while removing alumni!");
                            break;
                    }
                }
            }
        })
    }

    function setupNewAlumniSubmission() {
        let form = _1("#tools-form");
        form.onsubmit = async (e) => {
            e.preventDefault();

            let inputs = _n("input, textarea, select");
            let payload = new FormData();
            for (let input of inputs) {
                let prop = input.getAttribute("data-prop");
                let value;

                if (input.tagName.toLowerCase() === "input") {
                    let type = input.getAttribute("type");
                    switch (type) {
                        case "text":
                        case "number":
                        case "date":
                            value = input.value;
                            break;
                        case "checkbox":
                            value = input.checked;
                            break;
                        default:
                            value = null;
                            break;
                    }
                } else  {
                    value = input.value;
                }
                payload.append(prop, value);
            }
            payload.append("action", "insert");

            $("input, textarea, select, button").attr("disabled", "disabled");
            let results = await (await fetch("action-alumni.php", {body: payload, method: 'POST'})).json();
            $("input, textarea, select, button").removeAttr("disabled");

            switch (results.status) {
                case "success":
                    $("#tools-form button[type='reset']").click();
                    $("#tools-name").focus();
                    preloadAlumni();
                    break;
                case "failed":
                    alert(`Fail to add new alumni! Reason: ${results.reason}`);
                    break;
                case "error":
                default:
                    alert("Error while adding new alumni");
                    break;
            }
        }
    }

    function boot() {
        preloadAlumni();
        setupNewAlumniSubmission();
    }

    window.onload = boot;
</script>
</body>
</html>
