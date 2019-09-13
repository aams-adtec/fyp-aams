<?php
include_once "../system/database.php";
session_start();

function retrieveAlumniList() {
    global $db;
    $limit = post("limit");
    $offset = post("offset");
    $limit = !($limit == "") ? $limit : "10";
    $offset = !($offset == "") ? $offset : "0";

    $results = $db->query("SELECT id, fullname, ic, dob, gender, session, ndp, contactno, address, employed, occupation, salary, companyaddress FROM alumni LIMIT $limit OFFSET $offset;");

    $items = [];

    if (!$results) {
        echo json_encode(['status'=>'error']);
        exit();
    }

    $all = $results->fetch_all(MYSQLI_ASSOC);
    foreach ($all as $alumni) {
        $item = new stdClass();
        $item->id = $alumni['id'];
        $item->name = $alumni['fullname'];
        $item->ic = $alumni['ic'];
        $item->dob = $alumni['dob'];
        $item->sess = $alumni['session'];
        $item->ndp =  $alumni['ndp'];
        $item->contact = $alumni['contactno'];
        $item->addr = $alumni['address'];
        $item->empl = $alumni['employed'];
        $item->occu = $alumni['occupation'];
        $item->salary = $alumni['salary'];
        $item->company = $alumni['companyaddress'];

        array_push($items, $item);
    }

    echo json_encode(['status'=>'success', 'result'=>$items]);
}

function deleteAlumni() {
    global $db;
    $id = post("id");
    $r_pin = post("pin");
    $pin = $_SESSION["admin"]["pin"];

    if ($r_pin == $pin) {
        $result = $db->query("DELETE FROM alumni WHERE id='$id'");
        if (!$result) {
            echo json_encode(['status'=>'error']);
        } else {
            echo json_encode(['status'=>'success']);
        }
    } else {
        echo json_encode(['status'=>'failed', 'reason'=>'Invalid pin!']);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = (isset($_POST['action']) ? $_POST['action'] : "retrieve");

    switch ($action) {
        case "retrieve":
            retrieveAlumniList();
            break;
        case "delete":
            deleteAlumni();
            break;
        default:
            break;
    }

}
?>