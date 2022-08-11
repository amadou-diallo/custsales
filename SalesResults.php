<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sales Detail</title>
    </head>
    <body>
        <h1>Sales Results</h1>
        
        <?php
            $custid="";
            $custid = $_GET['custid'];
            if ($custid > "") {
                require_once('dblink.php');
                $query = "SELECT * FROM customer WHERE CUSTOMER_ID = '$custid'; ";
                $result = mysqli_query($dbc,$query);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    echo "<table>";
                    echo "<tr><td>Customer #</td><td>" .$row['CUSTOMER_ID']. "</td></td>";
                    echo "<tr><td>Customer Name:</td><td>" .$row['NAME']. "</td></tr>";
                    echo "<tr><td>Address::</td><td>" .$row['ADDRESS']. "</td></tr>";
                    echo "<tr><td>City, State, Zip:</td><td>" .$row['CITY']. ", " .$row['STATE']. ", " .$row['ZIP_CODE']. "</td></tr>";
                    echo "</table><br>";
                    
                } else {
                    echo "<p>Customer ID not found in file</p>";
                    
                } 
                //code to build detail sales list for customer
                
                echo "<table border='1'>";
                echo "<caption>Sales on File</caption>";
                echo "<tr>";
                echo "<th>Order Id</th>";
                echo "<th>Order Date</th>";
                echo "<th>Ship Date</th>";
                echo "<th>Total</th>";
                $query2 = "SELECT * FROM sales_order WHERE customer_id = '$custid' ORDER BY order_date DESC; ";
                $result2 = mysqli_query($dbc,$query2);
                if (mysqli_num_rows($result2) > 0)  {
                    while ($row = mysqli_fetch_array($result2)) {
                        echo "<tr>";
                        echo "<td>" .$row['ORDER_ID']. "</td>";
                        echo "<td>" .$row['ORDER_DATE']. "</td>";
                        echo "<td>" .$row['SHIP_DATE']. "</td>";
                        echo "<td>" .$row['TOTAL']. "</td>";
                        echo "</tr>";
                    }
                    
                } else {
                        echo "<tr><td>No Sales on File</td></tr>";
                }
                        echo "</table>";
                        $query3 = "SELECT sum(TOTAL) As TotSales FROM SALES_ORDER WHERE CUSTOMER_ID = '$custid'";
                        $result3 = mysqli_query($dbc,$query3);
                        if (mysqli_num_rows($result3) > 0) {
                            $row = mysqli_fetch_array($result3);
                            echo "<br><p>Total Sales for Customer = $" .number_format($row['TotSales'],2). "</p>";
                        } else {
                            echo "<br><p>Total Sales Query returned no value</p>";
                        }
             }    else {
                    echo "<p>Customer id not found in form</p>";
            }
        ?>
    </body>
</html>
