<?php

require("../includes/config.php");

if ($_SERVER["REQUEST_METHOD"]== "POST")
{
    if( empty($_POST["symbol"]))
    {
        apologize("you did not select any stock!");
    }
    
    $rows = CS50::query("SELECT shares FROM portfolios WHERE user_id = ? AND symbol = ?", $_SESSION["id"] , $_POST["symbol"]);
    if (count($rows) != 1)
    {
        apologize("you need to buy that stock first in order to sell it");
    }
    $shares = $rows[0]["shares"];
    
    $stock = lookup($_POST["symbol"]);
    if($stock !== false)
    {
         // update portfolio
            CS50::query("DELETE FROM portfolios WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);

            // update cash
            CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?", $shares * $stock["price"], $_SESSION["id"]);
            
            //history
            CS50::query("INSERT INTO history (user_id, transaction, symbol, shares, price, datetime)
                VALUES(?, 'SELL', ?, ?, ?, NOW())", $_SESSION["id"], $stock["symbol"],
                $shares, $stock["price"]);

                redirect("/");
    }
}
else
{
    $symbols = [];
    $rows = CS50::query("SELECT symbol FROM portfolios WHERE user_id = ? ORDER BY symbol", $_SESSION["id"]);
    if($rows === false)
    {
        apologize("sorry, could not find your portfolio!");
    }
    
    foreach ($rows as $row)
        {
            $symbols[] = $row["symbol"];
        }

        // render form
        if (count($symbols) > 0)
        {
            render("sell_form.php", ["symbols" => $symbols, "title" => "Sell"]);
        }
        else
        {
            apologize("Nothing to sell.");
        }
}


?>