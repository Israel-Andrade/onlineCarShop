<?php

    function connectDB() {
        $dbConn = mysqli_connect("localhost", "web_user", "s3cr3t", "Cars");
        
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
    
    function setDropDown(&$dbConn, $tableName) {
        $sql = "select '$tableName' from '$tableName'";
        $res = mysqli_query($dbConn, $sql);
        if(!$res) {
            printf("Could not retrieve records: %s\n",mysqli_error($dbConn));
            mysqli_close($dbConn);
            exit();
        }
        
        while($newArray = mysqli_fetch_array($res, MYSQL_ASSOC)) {
            echo  "<option>".$newArray[$tableName]."</option>";
        }
    }
    
?>