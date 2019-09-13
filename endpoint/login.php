<?php
include_once "../system/database.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = esc(filter_input(INPUT_POST, "u"));
    $password = esc(filter_input(INPUT_POST, "p"));
    $password = base64_encode(sha1($password));

    $result = $db->query("SELECT * FROM alumni WHERE user='$username' AND pass='$password'");

    if ($result) {
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $_SESSION['session'] = [
                'user'=>$data
            ];
            echo json_encode(['status'=>'success']);
        } else {
            echo json_encode(['status'=>'failed', 'reason'=>'No email & password matches!']);
        }
    } else {
        echo json_encode(['status'=>'error']);
    }
}
?>