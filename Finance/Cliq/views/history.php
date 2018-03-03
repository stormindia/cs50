<table class="table table-striped">

    <thead>
        <tr>
            <th class="text-center">Transaction</th>
            <th class="text-center">Date/Time</th>
            <th class="text-center">Symbol</th>
            <th class="text-center">Shares</th>
            <th class="text-center">Price</th>
        </tr>
    </thead>

    <tbody>
    <?php 
    
        foreach ($transactions as $transaction)
        {
            printf("<tr>");
            printf("<td>%s</td>", $transaction["transaction"]);
            printf("<td>%s</td>", date("n/j/y, g:ia", strtotime($transaction["datetime"])));
            printf("<td>%s</td>", htmlspecialchars($transaction["symbol"]));
            printf("<td>%s</td>", number_format($transaction["shares"]));
            printf("<td>$%s</td>", number_format($transaction["price"], 2));
            printf("</tr>");
        }

    ?>
    </tbody>

</table>