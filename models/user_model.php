<?php
require_once dirname(__DIR__) . '/cfg/dbinit.php';

// ------------------- TESTS ---------------------

$usrname_test = "pingux";
$usrname_test2 = "pingux2";
$username = "pingux".rand(0,100000000);
$pwd = "password";

print_r(add_user($usrname_test, $pwd, $conn));
//echo "usr id =".get_userid($usrname_test,$conn)[0][0];
$id = get_userid($usrname_test,$conn)[0][0];
//print_r(update_username($id, $username ,$conn));
//delete_user($id, $conn);
//update_password($id, "pwd_updated", $conn);

// ------------------- METHODS ------------------------



// ------------------- DATABASE ACTIONS ------------------------

//Create a user   
function add_user($name, $pwd, $conn){
    $sql = "INSERT INTO `users` (`username`, `password`)
    VALUES ('".$name."', '".$pwd."');";
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
    $sql = "UPDATE `users` SET `password` = '".$pwd."'
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

    return $result->fetch_all(); //Return as an array
}




?>