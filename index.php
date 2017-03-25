<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>
    <body>
        <div id="wrapper">
          <div id="header">
          </div>
          <div id="content">
              <?php
                echo "GET: ";
                var_dump($_GET);
                echo "<br><br><br>";
                
                if (session_status() == PHP_SESSION_NONE)
                    session_start();
                if(isset($_SESSION)) {
                    echo "SESSION: ";
                    var_dump($_SESSION);
                }
                if($_GET['clear'] == 1) {
                    session_destroy();
                    session_start();
                    var_dump($_SESSION);
                }
              ?>
              <form name="myForm" method="get" action="">
                    <div class="margin-fix">
                        <label>Make</label>
                        <select name="make" 
                        <?php
                            if($_GET['make'] != "")
                                $_SESSION['make'] = $_GET['make'];
                            if($_SESSION['make'] != "")
                                echo "disabled";
                        ?>
                        >
                            <option value=""></option>
                            <option value="option1"
                            <?php
                                    if (session_status() == PHP_SESSION_NONE)
                                        session_start();
                                    if($_SESSION['make'] == 'option1')
                                        echo " selected";
                            ?>
                            >option 1</option>
                        </select>
                        <br>
                    </div>
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
                        }
                        if($_SESSION['model'] != "") {
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
                    
                    
                    <div class="margin-fix">
                        <input type="submit" name="submit" value="OK">
                        <a href="index.php?clear=1">Clear</a>
                    </div>
                </form>
          </div>
          <div id="footer">
            <footer id="footer">
            </footer>
          </div>
        </div>
    </body>
</html>