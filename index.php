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
                if (session_status() == PHP_SESSION_NONE)
                    session_start();
                if($_GET['clear'] == 1) {
                    session_destroy();
                    session_start();
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
                        include 'php/filters.php';
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