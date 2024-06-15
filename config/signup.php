<?php
  // this part of the code works with database. However since I am storing the data in json files, I have taken out this bit. Feel free to go through it if the usecase applies to you.
  // include 'handles/connection.php';
  // include 'functions.php';

  // header('Content-Type: application/json');

  // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //   $email = $password = $user_photo = $acct_type= '';
  //   $email = check_input($_POST['Email']);
  //   //hash password using sha1 or/and md5
  //   $password = check_input($_POST['Password']);

  //   if (isset($_FILES['Photo-Upload'])) {
  //     $file = $_FILES['Photo-Upload'];
  //     $file_name = $file['name'];
  //     $file_temp_dir = $file['tmp_name'];
  //     $file_size = $file['size'];
  //     $file_error = $file['error'];
  //     $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
  //     $allowed_ext = ['jpg', 'jpeg', 'png'];
  //     if (in_array($file_ext, $allowed_ext)) {
  //       if($file_error === 0){
  //         $max_file_size = 5242880;
  //         if ($file_size <=$max_file_size) {
  //           $file_name = explode('@', $email);
  //           $new_file_name = $file_name[0] .'.'. $file_ext;
  //           $target_dir = '../vendor/';
  //           $new_file_path = $target_dir . $new_file_name;
  //           $move_uploaded_file = move_uploaded_file($file_temp_dir, $new_file_path);
  //           if($move_uploaded_file){  
  //             $confirmation_code = generate_unique_code();
  //             if(isset($_POST['user_account'])){
  //               $acct_type = 0;
  //               $sql = "SELECT * FROM users WHERE user_email= '" . $email . "' AND acct_type = '" . $acct_type . "'";
  //               $result = mysqli_query($conn, $sql);
  //               if (mysqli_num_rows($result) > 0) {
  //               echo json_encode(["success"=>false,"message"=>"This email has been used to sign up previously"]);
  //               exit;
  //               mysqli_close($conn);
  //               }else{
  //                 $sql = "INSERT INTO users (user_email, user_password,user_avatar, acct_type) VALUES ('$email', '$password', '$new_file_path', '$acct_type')";
  //                 if(mysqli_query($conn, $sql)){
  //                   $confirmation_code = generate_unique_code();
  //                   sendEmailVerification($file_name[0], $email, 'globalpowder@proton.me', $confirmation_code);
  //                   echo json_encode(["success"=> true, "message"=>'You have successfully created a user account.', "url"=>true,"page"=>"index.html"]);
  //                   exit;
  //                   header('Location: ../index.html');
  //                 }else {
  //                   echo mysqli_error($conn);
  //                 }
  //               }
  //             }

  //             if(isset($_POST['admin_account'])){
  //               $acct_type = 1;
  //               $sql = "SELECT * FROM users WHERE user_email= '" . $email . "' AND acct_type = '" . $acct_type . "'";
  //               $result = mysqli_query($conn,$sql);
  //               if (mysqli_num_rows($result) > 0) {
  //                 echo json_encode(["success"=>false,"message"=>"This email has been used to sign up previously"]);
  //                 exit;
  //               }else{
  //                   $sql = "INSERT INTO users (user_email, user_password,user_avatar, acct_type) VALUES ('$email', '$password', '$new_file_path', '$acct_type')";
  //                 if(mysqli_query($conn, $sql)){
  //                   $confirmation_code = generate_unique_code();
  //                   sendEmailVerification($file_name[0], $email, 'globalpowder@proton.me', $confirmation_code);
  //                   echo json_encode(["success"=> true, "message"=>'You have successfully created an admin account.', "url"=>"../index.html","page"=>"index.html"]);
  //                   exit;
  //                 }else {
  //                   echo mysqli_error($conn);
  //                 }
  //               }
  //             }
  //           }else{
  //             echo json_encode(["success"=>false,"message"=>"File Upload Failed"]);
  //           }
  //         }else {
  //           echo json_encode(["success"=>false,"message"=>"File must be less than 5mb"]);
  //         }
  //       }else{
  //         echo json_encode(["success"=>false,"message"=>$file_error]);
  //       }
  //     }else{
  //     echo json_encode(["success"=>false,"message"=>"Only jpg, png and jpeg format allowed"]);
  //     }
  //   }
  // }

  // this part of the code works with JSON files to store the data. Feel free to go through it if the usecase applies to you.
  
  include 'functions.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $password = $user_photo = $acct_type= '';
    $email = check_input($_POST['Email']);
    //hash password using sha1 or/and md5
    $password = check_input($_POST['Password']);
    $json_path = 'dump/users.json';
    
    if (isset($_FILES['Photo-Upload'])) {
      $file = $_FILES['Photo-Upload'];
      $file_name = $file['name'];
      $file_temp_dir = $file['tmp_name'];
      $file_size = $file['size'];
      $file_error = $file['error'];
      $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
      $allowed_ext = ['jpg', 'jpeg', 'png'];
      if (in_array($file_ext, $allowed_ext)) {
        if($file_error === 0){
          $max_file_size = 5242880;
          if ($file_size <=$max_file_size) {
            $file_name = explode('@', $email);
            $new_file_name = $file_name[0] .'.'. $file_ext;
            $target_dir = '../vendor/';
            $new_file_path = $target_dir . $new_file_name;
            $move_uploaded_file = move_uploaded_file($file_temp_dir, $new_file_path);
            if($move_uploaded_file){  
              $confirmation_code = generate_unique_code();
              if(isset($_POST['user_account'])){
                $acct_type = 'user';
                $data = array(
                  'email' =>  $email,
                  'password' =>  $password,
                  'user_avatar' =>  $new_file_path,
                  'acct_type'  =>  $acct_type
                  );
                $data_json_string = file_get_contents($json_path);
                $parsed_json = json_decode($data_json_string, true);
                $flag = false;
                //check this part again
                if (is_array($parsed_json) || is_object($parsed_json))
                {
                  foreach($parsed_json as $key => $value)  {
                    if($value['email'] == $email){
                      $flag = true;
                      break;
                    }
                  }
                }
               if($flag){
                  echo  json_encode(["success" => false, "message" => "This email has been used to sign in previously.", "page"=>"same"]);
               }else{
                 $parsed_json[] = $data;
                  $data_json_string =  json_encode($parsed_json);
                  $validate = file_put_contents($json_path, $data_json_string);
                  if($validate){
                    echo json_encode(["success" => true, "message" => "You have successfully created a user account.", "page"=>"./index.html"]);
                  }
                }
              }

              if(isset($_POST['admin_account'])){
                $acct_type = 'admin';
                $data = array(
                  'email' =>  $email,
                  'password' =>  $password,
                  'user_avatar' =>  $new_file_path,
                  'acct_type'  =>  $acct_type
                  );
                $data_json_string = file_get_contents($json_path);
                $parsed_json = json_decode($data_json_string, true);
                $flag = false;
                if (is_array($parsed_json) || is_object($parsed_json))
                {
                  foreach($parsed_json as $key => $value)  {
                    if($value['email'] == $email){
                      $flag = true;
                      break;
                    }
                  }
                }
               if($flag){
                  echo  json_encode(["success" => false, "message" => "This email has been used to sign in previously.", "page"=>"same"]);
               }else{
                $parsed_json[] = $data;
                $data_json_string =  json_encode($parsed_json);
                $validate = file_put_contents($json_path, $data_json_string);
                  if($validate){
                    echo json_encode(["success" => true, "message" => "You have successfully created a admin account.", "page"=>"./index.html"]);
                  }
                }
                }
              }
            }else{
              echo json_encode(["success"=>false,"message"=>"File Upload Failed"]);
            }
          }else {
            echo json_encode(["success"=>false,"message"=>"File must be less than 5mb"]);
          }
        }else{
          echo json_encode(["success"=>false,"message"=>$file_error]);
        }
      }else{
      echo json_encode(["success"=>false,"message"=>"Only jpg, png and jpeg format allowed"]);
      }
    }
  // } removing this makes it work
?>
