<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>
    <body>
        <div id="wrapper">
          <div id="header">
              <?php
                function isSessionValid() {
                    echo "here";
                    return ($_GET['make'] != "" or $_GET['model'] != "" or $_GET['max_price'] != "");
                }
              ?>
          </div>
          <div id="content">
              <?php
                if (session_status() == PHP_SESSION_NONE)
                    session_start();
                if( !($_GET['make'] != "" or $_GET['model'] != "" or $_GET['max_price'] != "") )
                    session_destroy();
              ?>
              <form name="myForm" method="get" action="">
                    <div class="margin-fix">
                        <label>Make</label>
                        <select name="make" 
                        <?php
                            
                            if($_GET['make'] != "" or $_GET['model'] != "" or $_GET['max_price'] != "")
                                echo "disabled";
                        ?>
                        >
                            <option value=""></option>
                            <option value="option1"
                            <?php
                                if($_GET['make'] != "" or $_GET['model'] != "" or $_GET['max_price'] != "") {
                                    if (session_status() == PHP_SESSION_NONE)
                                        session_start();
                                    if($_GET['make'] != "")
                                        $_SESSION['make'] = $_GET['make'];
                                    if($_SESSION['make'] == 'option1')
                                        echo " selected";
                                }
                            ?>
                            >option 1</option>
                        </select>
                        <br>
                    </div>
                    <?php
                        if($_GET['make'] != "" or $_GET['model'] != "" or $_GET['max_price'] != "") {

                            if (session_status() == PHP_SESSION_NONE)
                                session_start();
                            
                            if($_GET['model'] != "")
                                $_SESSION['model'] = $_GET['model'];
                            
                            echo "<div class='margin-fix'>";
                            
                            echo "<label> Model</label>";
                            echo "<select name='model'";
                            if($_GET['model'] != "" or $_GET['max_price'] != "")
                                echo " disabled";
                            echo ">";
                            echo "<option value=''></option>";
                            echo "<option value='option2'";
                            if($_GET['model'] != "" or $_GET['max_price'])
                                echo "selected";
                            echo ">option 2</option>";
                            echo "</select>";
                            
                            echo "</div>";
                        }
                        if($_GET['model'] != "" or $_GET['max_price'] != "") {
                            echo "<div>";
                            
                            if (session_status() == PHP_SESSION_NONE)
                                session_start();
                            
                            if($_GET['max_price'] != "")
                                $_SESSION['max_price'] = $_GET['max_price'];
                            //$_SESSION['model'] = $_GET['model'];
                            echo "<label>Max Price: </label>";
                            echo "<input type='text' name='max_price' value=";
                            if($_GET['max_price'] != "")
                                echo $_GET['max_price'];
                            else
                                echo "";
                            echo ">";
                            
                            echo "</div>";
                        }
                    ?>
                    <div class="margin-fix">
                        <input type="submit" name="submit" value="OK">
                        <a href="index.php">Clear</a>
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