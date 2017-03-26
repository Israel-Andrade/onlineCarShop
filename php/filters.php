<?php

    /*
        This file abstracts out all php from index.php to keep it clean.
        Contains the filters presented in the main UI when needed.
    */

    if($_SESSION['make'] != "") {
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        
        if($_GET['model'] != "")
            $_SESSION['model'] = $_GET['model'];
        
        echo "<div class='margin-fix'>";
        
        echo "<label> Model</label>";
        echo "<select name='model'";
        echo ">";
        echo "<option value=''></option>";
        setDropDown($dbConn, "MODEL", $_SESSION['make']);
        echo "</select>";
        
        echo "</div>";
        echo "<div>";
        
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        
        if($_GET['max_price'] != "")
            $_SESSION['max_price'] = $_GET['max_price'];
        echo "<label>Max Price: </label>";
        echo "<input type='text' name='max_price' value=";
        if($_GET['max_price'] != "")
            echo $_GET['max_price'];
        else
            echo "";
        echo ">";
        
        echo "</div>";
        echo "<div>";
        
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        
        if($_GET['min_price'] != "")
            $_SESSION['min_price'] = $_GET['max_price'];
        echo "<label>Min Price: </label>";
        echo "<input  type='text' name='min_price' value=";
        if($_GET['min_price'] != "")
            echo $_GET['min_price'];
        else
            echo "";
        echo ">";
        
        echo "</div>";
        echo "<div>";
        echo "<label>Sort By:</label>";
        echo "</div>";
        echo "<div>";
        echo "<input type='radio' name='sort' value='byName'";
        if($_GET['sort'] and $_GET['sort'] == "byName")
            echo " checked";
        echo ">";
        echo "<label>Name</label>";
        echo "<input type='radio' name='sort' value='byPrice'";
        if($_GET['sort'] and $_GET['sort'] == "byPrice")
            echo " checked";
        echo ">";
        echo "<label>Price</label>";
        echo "</div>";
    }
?>