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
    $id = $_SESSION["registration"]["user"]["id"];

    if (isset($_FILES['image'])) {
        $f_image = $_FILES['image'];
        $fname = $f_image['name'];
        if (in_array(strtolower(pathinfo($fname, PATHINFO_EXTENSION)), $image_ext)) {
            $destination = "../img/" . substr($id, 0, 12) . ".jpg";
            compressImage($f_image['tmp_name'], $destination, 60);
        } else {
            echo json_encode(['status'=>'failed', 'reason'=>'Unsupported image format!']);
        }
    }

    $session = post("session");
    $ndp = post("ndp");
    $contact = post("contact");
    $address = post("address");
    $employed = post("employed");
    $occupation = post("occupation");
    $salary = post("salary");
    $company = post("company");

    $results = $db->query("UPDATE alumni SET session='$session', ndp='$ndp', contactno='$contact', address='$address', employed='$employed', occupation='$occupation', salary='$salary', companyaddress='$company' WHERE id='$id'");
    if ($results) {
        unset($_SESSION["registration"]);
        echo json_encode(['status'=>'success']);
    } else {
        json_encode(['status'=>'error', 'error'=>$db->error]);
    }
}
?>