<?php
include_once "../system/database.php";
$accounts = json_decode(file_get_contents(__DIR__ . "/admin-accounts.json"), true);
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, "u");
    $password = filter_input(INPUT_POST, "p");

    if (isset($accounts[$username])) {
        if ($accounts[$username]["pass"] == $password) {
            $_SESSION["admin"] = [
                'id'=>$username,
                'pin'=>$accounts[$username]["pin"]
            ];
            echo json_encode(['status'=>'success']);
        } else {
            echo json_encode(['status'=>'failed', 'reason'=>'Admin password mismatch!']);
        }
    } else {
        echo json_encode(['status'=>'failed', 'reason'=>'Admin ID not found!', 'info'=>[$username, $password]]);
    }
}
?>