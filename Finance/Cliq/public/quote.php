<?php

require("../includes/config.php");

if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("quote_form.php",["title" => "Quote"]);
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST")
    { 
        $stock = lookup($_POST["symbol"]);
        if($stock == FALSE)
        {
            apologize("the stock you entered could not be found");
        }
        render("stock_info.php", ["stock" => $stock]);
    }

?>