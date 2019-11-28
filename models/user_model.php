<?php
require_once dirname(__DIR__) . '/cfg/dbinit.php';

// ------------------- TESTS ---------------------

$usrname_test = "pingux";
$usrname_test2 = "pingux2";
$username = "pingux".rand(0,100000000);
$pwd = "password";

//$test = add_user($usrname_test, $pwd, $conn);
//print_r($test);

//echo ". pwd checkin = ".password_verify($pwd, $test)." --- ";

//echo check_login($usrname_test, $pwd, $conn);

echo username_exists($usrname_test, $conn);

//echo "usr id =".get_userid($usrname_test,$conn)[0][0];
//print_r(get_userid($usrname_test,$conn));
//$id = get_userid($usrname_test,$conn)[0][0];
//print_r(update_username($id, $username ,$conn));
//delete_user($id, $conn);
//update_password($id, "pwd_updated", $conn);
//print_r(check_login($usrname_test, $pwd, $conn));

//print_r(get_all_users($conn));
//$crypt = encryp_pwd("password");
//echo password_verify("password  ", $crypt);

// ------------------- METHODS ------------------------

//Encrypt password
function encryp_pwd($pwd){
    return password_hash($pwd, PASSWORD_DEFAULT);
}

//Check if usrname and pwd are mtching, if yes return id else return null 
function check_login($username, $password, $conn){
    //Set SQL Query
    $sql = "SELECT * FROM `users` WHERE `username` = '".$username."'";
    //Call the database
    $result = mysqli_fetch_row($conn->query($sql)); 
    // check password

    return password_verify($password, $result[2]);
}

//check if username exists
function username_exists($username, $conn){
    $sql = "SELECT * FROM `users` WHERE `username` = '".$username."'";

    $result = mysqli_fetch_row($conn->query($sql)); 

    return isset($result);
}

// ------------------- DATABASE ACTIONS ------------------------

//Create a user   
function add_user($name, $pwd, $conn){
    $pwd_en = encryp_pwd($pwd);
    $sql = "INSERT INTO `users` (`username`, `password`)
    VALUES ('".$name."', '".$pwd_en."');";
    $result = $conn->query($sql);

    return 0;
}

//Update username   
function update_username($id, $username, $conn){
    $sql = "UPDATE `users` SET `username` = '".$username."'
    WHERE `id` = ".$id." ;";
    $result = $conn->query($sql);

    return 0;
}

//Update password   
function update_password($id, $pwd, $conn){
    $sql = "UPDATE `users` SET `password` = '".encryp_pwd($pwd)."'
    WHERE `id` = ".$id." ;";
    $result = $conn->query($sql);

    return 0;
}


//Delete user   
function delete_user($user_id, $conn){
    $sql = "DELETE FROM `users` WHERE `id` = ".$user_id.";";
    $result = $conn->query($sql);

    return 0;
}

//Get a user ID from his username   
function get_userid($username, $conn){
    //Set SQL Query
    $sql = "SELECT `id` FROM `users` WHERE `username` = '".$username."';";
    //Call the database
    $result = $conn->query($sql); 

    return mysqli_fetch_row($result); //Return as an array
}

//Get all users
function get_all_users($conn){
    $sql = "SELECT * FROM `users`";

    $result = $conn->query($sql);
    
    return $result->fetch_all();
}




?>