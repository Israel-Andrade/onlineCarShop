<?php
    if($_SESSION['make'] != "") {
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        
        if($_GET['model'] != "")
            $_SESSION['model'] = $_GET['model'];
        
        echo "<div class='margin-fix'>";
        
        echo "<label> Model</label>";
        echo "<select name='model'";
        if($_SESSION['model'])
            echo " disabled";
        echo ">";
        echo "<option value=''></option>";
        echo "<option value='option2'";
        if($_SESSION['model'])
            echo "selected";
        echo ">option 2</option>";
        echo "</select>";
        
        echo "</div>";
    // }
    // if($_SESSION['model'] != "") {
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
    }
?>