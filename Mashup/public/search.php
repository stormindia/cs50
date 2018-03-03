<?php

    require(__DIR__ . "/../includes/config.php");
     $places = [];
    // ensure proper usage
    if (!isset($_GET["geo"]) || strlen($_GET["geo"]) === 0)
    {
        http_response_code(400);
        exit;
    }

    $places = CS50::query("SELECT * FROM places WHERE MATCH(postal_code,place_name,admin_name1,admin_name2) AGAINST (?) LIMIT 50", $_GET["geo"]);

    // output places as JSON (pretty-printed for debugging convenience)
    header("Content-type: application/json");
    print(json_encode($places, JSON_PRETTY_PRINT));

?>
