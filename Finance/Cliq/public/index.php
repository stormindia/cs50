<?php

    // configuration
    require("../includes/config.php"); 
    
    $rows = CS50::query("SELECT cash from users WHERE id = ?", $_SESSION["id"]);
    if($rows === false)
    {
        apologize("sorry, could not find your cash");
    }
    $cash = $rows[0]["cash"];
    
    $rows = CS50::query("SELECT * FROM portfolios WHERE user_id = ?", $_SESSION["id"]);
    if($rows === false)
    {
        apologize("sorry, could not find your portfolio");
    }
    $positions = [];
    foreach ($rows as $row)
{
    $stock = lookup($row["symbol"]);
    if ($stock !== false)
    {
        $positions[] = [
            "name" => $stock["name"],
            "price" => $stock["price"],
            "shares" => $row["shares"],
            "symbol" => $row["symbol"]
        ];
    }
}
    
    // render portfolio
    render("portfolio.php", ["cash" => $cash, "positions" => $positions, "title" => "Portfolio"]);

?>
