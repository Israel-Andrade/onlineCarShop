<?php
    /*
        Helper function to abstract out the connecting and error checking to db.
        Returns db connection obj
    */
    function connectDB($host, $user, $pass, $dbName) {
        $dbConn = mysqli_connect($host, $user, $pass, $dbName);
        
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        
        return $dbConn;
    }
    
    /*
        Closes the db and error checks
    */
    function closeDB(&$dbConn) {
        if(!empty($dbConn))
            mysqli_close($dbConn);
    }
    
    /*
        Sets the dropdown menu for Make and model based on the table name
    */
    
    function setDropDown(&$dbConn, $tableName, $conditional) {
        $sql = "select $tableName from $tableName";
        if($conditional != "") {
            $sql .= " JOIN CAR_INFORMATION ON MODEL.ID = CAR_INFORMATION.MODEL_ID";
            $sql .= " JOIN MAKE ON MAKE.ID = CAR_INFORMATION.MAKE_ID";
            $sql .= " WHERE MAKE.MAKE = '$conditional'";
        }
        $res = mysqli_query($dbConn, $sql);
        if(!$res) {
            printf("Could not retrieve records: %s\n",mysqli_error($dbConn));
            mysqli_close($dbConn);
            exit();
        }
        
        while($newArray = mysqli_fetch_array($res, MYSQL_ASSOC)) {
            if(isset($_SESSION) and $_SESSION[strtolower($tableName)] == $newArray[$tableName])
                echo  "<option selected>".$newArray[$tableName]."</option>";
            else
                echo  "<option>".$newArray[$tableName]."</option>";
            
        }
    }
    
    /*
        Queries the given sql string and returns the result
    */
    
    function query($sql, &$dbConn) {
        $res = mysqli_query($dbConn, $sql);
        if(!$res) {
            printf("Could not retrieve records: %s\n",mysqli_error($dbConn));
            mysqli_close($dbConn);
            exit();
        }
        
        return $res;
    }
    
    /*
        Based on a result from a previous query, this generates a table as a form
        to allow checks to be made and submitted.
        
        **Returns the items in the table as an array of arrays (for each row)
    */
    
    function generateTableWithForm(&$res, $title) {
        $curItems = array();
        $i = 0;
        $meta = array();
        $num_fields = mysqli_num_fields($res);
        // check if no data avaialable
        if($res->num_rows == 0) {
            echo "<table class='centerTable'>";
            echo "<tr><th colspan=".'1'.">No Data";
            echo "</th></tr>";
            echo "<tr>";
            exit();
        }
        // store all column field names in array
        while ($i < $num_fields) {
            $meta[] = mysqli_fetch_field($res)->name;
            if (!$meta) {
                die("No information available<br />");
            }
            $i++;
        }
        // *************************** create table
        echo "<form method='post' action='shopping_cart.php'>";
        echo "<div>";
        echo "<table align='center', border='1'>";
        echo "<tr><th colspan=".($num_fields + 1).">$title";
        echo "</th></tr>";
        echo "<tr>";
        for($j = 0; $j < $num_fields; $j++) {
                // if($meta[$j] == $prod_desc_col)
                //     continue;
                echo "<td><b>".$meta[$j]."</b></td>";
        }
        echo "<td><b>CHECK TO SELECT</b></td>";
        echo "</tr>";
        // retrieve row data from query
        $t = 0;
        while($newArray = mysqli_fetch_array($res, MYSQL_ASSOC)) {
            echo "<tr>";
           // $curRow = array();
            for($j = 0; $j < $num_fields; $j++) {
                echo "<td>".$newArray[$meta[$j]]."</td>";
                //$curRow[] = $newArray[$meta[$j]];
            }
            echo "<td>";
            echo "<input type='checkbox'  name = 'shopping_cart[]' value= " . $t . ">";
           // echo "<input type='checkbox' name="."check".$t.">";
            echo "</td>";
            $t++;
            //$curItems[] = $currRow;
            $curItems[] = $newArray;
        }
        echo "</table>";
        echo "</div>";
        echo "<div style='margin: 10px; text-align: center;'>";
        // echo "<div class='margin-fix'>";
        // echo "<input type='submit' name='submit' value='OK'>";
        // echo "<a href='index.php?clear=2'>Clear</a>";
        // echo "</div>";
        echo "<input type='submit' name='addToCart' value='Add To Cart'>";
        echo "</div>";
        echo "</form>";
        mysqli_free_result($res);
        return $curItems;
    }
    
?>