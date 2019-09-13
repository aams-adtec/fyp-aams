<?php
include_once "../system/database.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = esc(filter_input(INPUT_POST, "u"));
    $password = esc(filter_input(INPUT_POST, "p"));
    $password = base64_encode(sha1($password));

    $fullname = esc(filter_input(INPUT_POST, "fullname"));
    $ic = esc(filter_input(INPUT_POST, "ic"));
    $dob = esc(filter_input(INPUT_POST, "dob"));
    $gender = esc(filter_input(INPUT_POST, "gender"));

    $result = $db->query("SELECT * FROM alumni WHERE user='$username'");

    if ($result) {
        if ($result->num_rows > 0) {
            echo json_encode(['status'=>'failed', 'reason'=>'Email had already been registered!']);
        } else {
            $newid = bin2hex(random_bytes(12));
            $result = $db->query("INSERT INTO alumni (id, user, pass, fullname, ic, dob, gender) VALUES ('$newid', '$username', '$password', '$fullname', '$ic', '$dob', '$gender');");
            if ($result) {
                $_SESSION["registration"] = [
                    'user'=>[
                        'id'=>$newid,
                        'fullname'=>$fullname,
                    ]
                ];
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'error' => $db->error]);
            }
        }
    } else {
        echo json_encode(['status'=>'error']);
    }
}
?>