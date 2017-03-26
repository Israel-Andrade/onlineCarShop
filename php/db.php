<?php

    function connectDB($host, $user, $pass, $dbName) {
        $dbConn = mysqli_connect($host, $user, $pass, $dbName);
        
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        
        return $dbConn;
    }
    
    function closeDB(&$dbConn) {
        if(!empty($dbConn))
            mysqli_close($dbConn);
    }
    
    function setDropDown(&$dbConn, $tableName, $conditional) {
        $sql = "select $tableName from $tableName";
        // if($conditional != "") {
        //     $sql .= " JOIN MAKE ON MAKE.ID = MODEL.MAKE_ID";
        //     $sql .= " WHERE MAKE.MAKE = $conditional";
        // }
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
    
    function query($sql, &$dbConn, $title) {
        $i = 0;
        $meta = array();
        
        $res = mysqli_query($dbConn, $sql);
        if(!$res) {
            printf("Could not retrieve records: %s\n",mysqli_error($dbConn));
            mysqli_close($dbConn);
            exit();
        }
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
        echo "<table align='center', border='1'>";
        echo "<tr><th colspan=".($num_fields).">$title";
        echo "</th></tr>";
        echo "<tr>";
        for($j = 0; $j < $num_fields; $j++) {
                if($meta[$j] == $prod_desc_col)
                    continue;
                echo "<td><b>".$meta[$j]."</b></td>";
        }
        echo "</tr>";
        // retrieve row data from query
        while($newArray = mysqli_fetch_array($res, MYSQL_ASSOC)) {
            echo "<tr>";
            for($j = 0; $j < $num_fields; $j++)
                echo "<td>".$newArray[$meta[$j]]."</td>";
        }
        echo "</table>";
        mysqli_free_result($res);
    }
    
?>