<!DOCTYPE html>
<html>
    <head>
        <title>
            Shopping Cart
        </title>
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
    </head>
</html>

<?php
    session_start();
    //check for the check items in db 
    //if checked then add that item to my array
    //
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
            echo "<table align = 'center' border='1'>";
            echo "<tr>";
            foreach($inventory[0] as $key => $value)
            {
                echo "<th colspan='1'>" . $key . "</th>";
                
            }
            echo "</tr>";
            echo "</table>";
        }
        dislayTable($shopping_cart, $inventory);

?>