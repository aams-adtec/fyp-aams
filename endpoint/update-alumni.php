<?php
include_once "../system/database.php";
session_start();

$image_ext = ['png', 'jpeg', 'jpg'];

function compressImage($source, $destination, $quality) {
    $info = getimagesize($source);
    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);
    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);
    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);
    imagejpeg($image, $destination, $quality);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_SESSION["session"]["user"]["id"];
    $fullname = post("fullname");
    $ic = post("ic");
    $dob = post("dob");
    $session = post("session");
    $ndp = post("ndp");
    $contact = post("contact");
    $address = post("address");
    $employed = post("employed");
    $occupation = post("occupation");
    $salary = post("salary");
    $company = post("company");

    $result = $db->query("UPDATE alumni SET fullname='$fullname', ic='$ic', dob='$dob', session='$session', ndp='$ndp', contactno='$contact', address='$address',
                                employed='$employed', occupation='$occupation', salary=$salary, companyaddress='$company' WHERE id='$id'");
    if (!$result) {
        echo json_encode(['status'=>'error', 'error'=>$db->error]);
        exit();
    }

    $result = $db->query("SELECT * FROM alumni WHERE id='$id'");
    $new_user = $result->fetch_assoc();

    $_SESSION['session']['user'] = $new_user;

    echo json_encode(['status'=>'success']);
}
?>