<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // TODO
        if(empty($_POST["username"]))
        {
            apologize("username can't be empty");
        }
        if(empty($_POST["password"]))
        {
            apologize("password can't be empty");
        }
        if(empty($_POST["confirmation"]))
        {
            apologize("please confirm your password");
        }
        if((!empty($_POST["confirmation"])) && ($_POST["confirmation"] != $_POST["password"]))
        {
            apologize("confirmed password does not match with the given password!!");
        }
        
        $success = CS50::query("INSERT IGNORE INTO users (username, hash, cash) VALUES(?, ?, 10000.0000)", $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT));
        
        if($success !== 1) // also try cs50:: method and $success == 0 case 
        {
            apologize("Sorry but the username already exists");
        }
        else
        {
        $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
        $id = $rows[0]["id"];
        
        $_SESSION["id"] = $id;
        
        redirect("/");
        }
    }
    ?>