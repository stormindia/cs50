<?php

require("../includes/config.php"); 
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if($_POST["add"] > 500)
        {
            apologize("you can't add more than $500 in your account at once");
        }
        
        
            CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?", $_POST["add"], $_SESSION["id"]);
            
              CS50::query("INSERT INTO history (user_id, transaction, price, datetime)
            VALUES(?, 'ADD', ?, NOW())", $_SESSION["id"], $_POST["add"]);
        
        redirect("/");
    }
    
    else
    {
        render("addcash_form.php", ["title" => "Add"]);
    }


?>