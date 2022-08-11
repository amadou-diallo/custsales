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
        <script src="ajax.js"></script>
        <script src="Sales.js"></script>
    </head>
    <body>
        <h1>Customer Sales Summary</h1>
        <p>Select a customer and click 'GO' to see sales</p>
        <form id='CustomerForm' action='SalesResults.php' method='get'>
        <?php
            require_once('dblink.php');
            $query = "SELECT * FROM CUSTOMER ORDER BY name;";
            $result = mysqli_query($dbc,$query);
            if (mysqli_num_rows($result) > 0){
                echo "<select id='custid' name='custid'>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='" .$row['CUSTOMER_ID']. "'>" 
                        .$row['NAME'].
                         "</option>";
                    
                }
                echo "</select>";
            } else {
                echo "<p>No Customer Found";
            }
         ?>
            <input type='submit' name='go' id='go' value='GO' />
        </form>
        <div id="results"></div>
    </body>
</html>
