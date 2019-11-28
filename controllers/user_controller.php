<?php include("../models/user_model.php"); 

public login($username, $pwd){

    $message = "error";

    if(check_login($username, $pwd, $conn)){
        $_SESSION["User"] = get_userid($username, $conn);
        $message = "You are now connected, welcome ".$username." !";
    }
    else  
    {
        $message = "Wrong username or password";
    }

    return $message;
}

public create_account($username, $pwd){

    $message = "error";

    if(!username_exists($username)){
        add_user($username, $pwd, $conn);
        $message = "Account created, you can log in";
    }
    else
    {
        $message = "Username already taken, try : xX".$username."Xx, Xtrem.".$username."Conqueror64 or ".$username."1";
    }

    return $message;
    
}

?>

