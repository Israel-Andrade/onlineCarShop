<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>
    <body>
        <div id="wrapper">
          <div id="header">
              <h1 style="color:white; text-align: center;">Car Shop</h1>
          </div>
          <div id="content">
              <?php
                include 'php/db.php';
                if (session_status() == PHP_SESSION_NONE)
                    session_start();
                if(isset($_GET) && $_GET['clear'] == 1) {
                    session_destroy();
                    session_start();
                }
                //if(isset($_SESSION) and $_SESSION['make'] != "") {
                $dbConn = connectDB("localhost", "", "", "Car_Inventory");
                //}
              ?>
              <form name="myForm" method="get" action="">
                    <div class="margin-fix">
                        <label>Make</label>
                        <select name="make" 
                        <?php
                            if(isset($_GET) and $_GET['make'] != "")
                                $_SESSION['make'] = $_GET['make'];
                            if(isset($_SESSION) and $_SESSION['make'] != "")
                                echo " disabled";
                        ?>
                        >
                            <option value=""></option>
                            <?php
                                    if (session_status() == PHP_SESSION_NONE)
                                        session_start();
                                    // if($_SESSION['make'] == 'option1')
                                    //     echo " selected";
                                    setDropDown($dbConn, "MAKE", "");
                            ?>
                        </select>
                        <br>
                    </div>
                    <?php
                        // php that creates html filters or fields based on conditions
                        include 'php/filters.php';
                    ?>
                    <div class="margin-fix">
                        <input type="submit" name="submit" value="OK">
                        <a href="index.php?clear=1">Clear</a>
                    </div>
                </form>
                <?php
                    echo "<div>";
                    echo "<div style='display: inline-block'>";
                    // build sql query for results from form
                    $isTableReady = (isset($_GET) and $_GET['model'] != ""
                        or $_GET['min_price'] != "" or $_GET['max_price'] != "" or $_GET['make'] or $_GET['submit'])
                        and $_SESSION['make'] != "";
                    if( $isTableReady ) {
                        $sql = "SELECT m.MAKE, mo.MODEL, c.PRICE, c.YEAR, c.FUEL_EFFICIENCY, FROM CAR_INFORMATION As c";
                        
                        if(isset($_SESSION) and $_SESSION['make'] != "") {
                            $makeStr = $_SESSION['make'];
                            $sql .= " JOIN MAKE As m ON m.ID = c.MAKE_ID";
                            $sql .= " JOIN MODEL As mo ON mo.ID = c.MODEL_ID";
                            if(isset($_GET) and $_GET['model'] != "") {
                                $modelStr = $_GET['model'];
                                $sql .= " WHERE '$modelStr' = mo.MODEL";
                            }
                            $sql .= " AND '$makeStr' = m.MAKE";
                        }
                        
                        if(isset($_GET) and $_GET['max_price'] != "") {
                            $maxPrice = $_GET['max_price'];
                            $sql .= " AND c.PRICE <= '$maxPrice'";
                        }
                        if(isset($_GET) and $_GET['min_price'] != "") {
                            $minPrice = $_GET['min_price'];
                            $sql .= " And c.PRICE >= '$minPrice'";
                        }
                        if(isset($_GET) and $_GET['sort'] != "") {
                            if($_GET['sort'] == 'byName') {
                                $sql .= " ORDER BY mo.MODEL ASC";
                            }
                            else if($_GET['sort'] == 'byPrice') {
                                $sql .= " ORDER BY c.PRICE ASC";
                            }
                        }
                        //echo "<p>".$sql."</p>";
                        $res = query($sql, $dbConn);
                        $currentItems = array();
                        $currentItems = generateTableWithForm($res, "AVAILABLE CARS");
                        var_dump($currentItems);
                        $_SESSION['currentItems'] = $currentItems;
                    }
                ?>
          </div>
          <div id="footer">
            <footer id="footer">
            </footer>
          </div>
        </div>
    </body>
</html>