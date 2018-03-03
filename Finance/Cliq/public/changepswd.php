<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $rows = CS50::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
        if (count($rows) == 1)
        {
            // first (and only) row
            $row = $rows[0];

            // compare hash of user's input against hash that's in database
            if (password_verify($_POST["o"], $row["hash"]))
            {
            
                // update password
                
                if(!empty($_POST["c"]))
                {
                
                    if(($_POST["c"] != $_POST["n"]))
                    {
                        apologize("confirmed password does not match with the given password!!");
                    }
                    else
                    {
                    //update
                  $hash = crypt($_POST["n"]);
 +		        	$id = $_SESSION["id"];
 +			
 +			// update the account to the new password
 +			cs50::query("UPDATE users SET hash='$hash' WHERE id=$id"); 
                    redirect("/");
                    }
                }
                else
                {
                    apologize("please confirm the new password");
                    redirect("changepswd.php");
                }
                
            }
            else
            {
                apologize("password you entered is wrong!");
            }
        
         }
    }     
    else
    {
        // render form
        render("changepswd_form.php", ["title" => "Change"]);
    }
?>