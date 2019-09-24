<?php
include_once "../system/database.php";
include_once "../system/util.php";

session_start();

function retrieveAlumniList() {
    global $db;
    $limit = post("limit");
    $offset = post("offset");
    $limit = !($limit == "") ? $limit : "10";
    $offset = !($offset == "") ? $offset : "0";

    $results = $db->query("SELECT id, user, pass, fullname, ic, dob, gender, session, ndp, contactno, address, employed, occupation, salary, companyaddress, creation FROM alumni LIMIT $limit OFFSET $offset;");

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

        if ($alumni['creation'] === "admin") {
            $item->temp = new stdClass();
            $item->temp->email = $alumni['user'];
            $item->temp->pass = $alumni['pass'];
        }

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

function insertAlumni() {
    global $db;
    $fullname = post("fullname");
    $ic = post("ic");
    $gender = post("gender");
    $dob = post("dob");
    $session = post("session");
    $ndp = post("ndp");
    $contact = post("contact");
    $address = post("address");
    $working = post("working");
    $salary = post("salary");
    $occupation = post("occupation");
    $company = post("company");

    $userid = bin2hex(random_bytes(12));
    $emailId = randStr(8) . "@temporary";
    $password = randStr(10);

    $query = "INSERT INTO alumni (id, user, pass, fullname, ic, dob, gender, session, ndp, contactno, address, employed, occupation, salary, companyaddress, creation)
                          VALUES ('$userid', '$emailId', '$password', '$fullname', '$ic', '$dob', '$gender', '$session', '$ndp', 
                                  '$contact', '$address', '$working', '$occupation', '$salary', '$company', 'admin')";
    $results = $db->query($query);

    if ($results) {
        echo json_encode(['status'=>'success', 'result'=>['tempuser'=>$emailId, 'temppass'=>$password]]);
    } else {
        echo json_encode(['status'=>'failed', 'reason'=>$db->error]);
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
        case "insert":
            insertAlumni();
            break;
        default:
            break;
    }

}
?>