<?php
  include '../config/functions.php';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = check_input( $_POST['Email']);
    $password = check_input($_POST['Password']);
    $json_path = '../config/dump/users.json';
    $json_data_str = file_get_contents($json_path);
    $parsed_json = json_decode($json_data_str, true);
    $flag = false;
    $admin_acct = $user_acct  = '';


    foreach ($parsed_json as $user) {
        if($email == $user['email'] && $password == $user['password']){
            $flag = true;
            $switch_acct_type = $user['acct_type'];
            switch ($switch_acct_type) {
                case 'user':
                    $acct_type = 'user';
                    break;
                case 'admin':
                    $acct_type = 'admin';
                    break;
            }
            session_start();
            $_SESSION['email'] = $email;
            break;
        }
    }

    switch (true) {
        case ($flag && $acct_type === 'user'):
            echo json_encode(["success" => true, "message" => "Login Successful", "acct_type"=>"user"]);
            break;
        case ($flag && $acct_type === 'admin'):
            echo json_encode(["success" => true, "message" => "Login Successful", "acct_type"=>"admin"]);
            break;
        default:
            echo json_encode(["success" => false, "message" => "Invalid Login Credentials"]);
            break;
    }

  
  }

?>