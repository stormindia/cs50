<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        if (empty($_POST["email"]))
        {
            apologize("You must provide your email.");
        }
        
        // Validate e-mail
            if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) 
            {
                apologize("invalid email!");
            }
            
        
        if((!empty($_POST["username"])) && (!empty($_POST["email"])))
        {
            $rows = CS50::query("SELECT * FROM users WHERE username = ?", $_POST["u"]);
            if (count($rows) == 1)
            {
                // Generating Password
                $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
                $password = substr( str_shuffle( $chars ), 0, 8 );
                 //hashing it
                 $password1= sha1($password); //Encrypting Password
                
                $un = $_POST["username"];
                //updating the database
                
                $un = $_POST["username"];
                $querry = CS50::query("UPDATE users SET hash = '$password1' WHERE username = $un ");
                
                //sending mail
                if($querry)
                {
                    // instantiate mailer
                            $mail = new PHPMailer();

                             // configure mailer
                            // http://phpmailer.worxware.com/index.php?pg=methods
                            // http://phpmailer.worxware.com/index.php?pg=properties
                            // https://www.google.com/settings/u/0/security/lesssecureapps
                            $mail->IsSMTP();
                            $mail->Host = "smtp.gmail.com";
                            $mail->Password = "stormcs50pset7";
                            $mail->Port = 587;
                            $mail->SMTPAuth = true;
                            $mail->SMTPDebug = 1;
                            $mail->SMTPSecure = "tls";
                            $mail->Username = "bot storm";
                    // set From:
                    $mail->SetFrom("storm.bot123@gmail.com");

                     // set body
                    $mail->Body = "your new password is '$password1'";
                    
                    if ($mail->Send())
                    {
                        print("Sent text");
                    }
                    else
                        {
                        print($mail->ErrorInfo);
                        }
                }
            }
            else
            {
                apologize("user not found!");
            }
        }
        
        
    }
    
    else
    {
        // render form
        render("fpswd_form.php", ["title" => "Send Mail"]);
    }
?>