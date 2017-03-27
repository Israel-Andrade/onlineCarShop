<!DOCTYPE html>
<html>
    <head>
        <title>
            Shopping Cart
        </title>
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
    </head>
</html>
<body>
           <div id="wrapper">
          <div id="header">
              <h1 style="color:white; text-align: center;">Car Shop</h1>
          </div>
          <div id="content">
<?php
    session_start();
    //check for the check items in db 
    //if checked then add that item to my array
    //
        $TOTAL = 0;
        var_dump($_SESSION['currentItems']);
        $inventory = $_SESSION['currentItems'];
        $shopping_cart = $_POST["shopping_cart"];
        echo "<br>";
        echo sizeof($inventory);
        echo sizeof($shopping_cart);
        if(!empty($shopping_cart))
        {
            for($i = 0; $i < sizeof($shopping_cart); $i++)
            {
                //echo "<td>".$newArray[$meta[$j]]."</td>";
                    $index = intval($shopping_cart[$i]);
                    $TOTAL += intval($inventory[$index]['PRICE']);
                    echo $inventory[$index]['PRICE'];
                    echo '<br>';
            }
  
            /*
            for($i = 0; $i < sizeof($inventory); $i++)
                foreach($inventory[$i] as $key => $value)
                {
                    if()
            
                }
            */
        }
        function dislayTable($shopping_cart, $inventory)
        {
            global $TOTAL;
            echo "<table align = 'center' border='1'>";
            echo "<th colspan = '6'>SHOPPING CART </th>";
            echo "<tr>";
            foreach($inventory[0] as $key => $value)
            {
                echo "<th colspan='1'>" . $key . "</th>";
            }
            echo "</tr>";
            for($i = 0; $i < sizeof($shopping_cart); $i++)
            {       
                    $index = intval($shopping_cart[$i]);
                    echo "<tr>";
                        echo "<td>" .$inventory[$index]['MAKE'] . "</td>";
                        echo "<td>" .$inventory[$index]['MODEL'] . "</td>";
                        echo "<td>" .$inventory[$index]['PRICE'] . "</td>";
                        echo "<td>" .$inventory[$index]['YEAR'] . "</td>";
                        echo "<td>" .$inventory[$index]['FUEL_EFFICIENCY'] . "</td>";
                    echo "</tr>";
            }
            echo "<th colspan = '6'>TOTAL PRICE: " . $TOTAL . " </th>";
            echo "</table>";
        }
        dislayTable($shopping_cart, $inventory);

?>
</diV>
</div>sss
</body>
