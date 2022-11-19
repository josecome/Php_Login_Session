<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // Check if the user is logged in, if not then redirect him to login page
        $tm = 0;
        $tm2 = 0;
        $tm3 = 0;
        if (isset($_SESSION["timeout"])) {
            $tm = (int) $_SESSION["timeout"];
            $tm2 = (int) "" . date("YmdHm");
            $tm3 = $tm2 - $tm;
        }
        //echo "" . $tm . "," . $tm2; || $tm3 > 30
        if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $tm3 > 30) {
            $conn->close();
            //flush(); // Flush the buffer
            //ob_flush();
            header("location: login.php");
            exit;
        }
        ?>
        Logged in. <a href="logout.php">Log out</a>
    </body>
</html>
