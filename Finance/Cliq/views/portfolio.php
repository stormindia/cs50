<table class="table table-striped">

    <thead>
        <tr>
            <th class="text-center">Symbol</th>
            <th class="text-center">Name</th>
            <th class="text-center">Shares</th>
            <th class="text-center">Price</th>
            <th class="text-center">TOTAL</th>
        </tr>
    </thead>

    <tbody>

    <?php 
    
        foreach ($positions as $position)
        {
            printf("<tr>");
            printf("<td>%s</td>", htmlspecialchars($position["symbol"]));
            printf("<td>%s</td>", htmlspecialchars($position["name"]));
            printf("<td>%s</td>", number_format($position["shares"]));
            printf("<td>$%s</td>", number_format($position["price"], 2));
            printf("<td>$%s</td>", number_format($position["shares"] * $position["price"], 2));
            printf("</tr>");
        }

    ?>

    <tr>
        <td colspan="4">CASH</td>
        <td>$<?= number_format($cash, 2) ?></td>
    </tr>

    </tbody>

</table>
