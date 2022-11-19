<?php
session_start();
$total = 0;
require_once "conexao.php";

$tm = 0;
$tm2 = 0;
$tm3 = 0;
if (isset($_SESSION["timeout"])) {
    $tm = (int) $_SESSION["timeout"];
    $tm2 = (int) "" . date("YmdHm");
    $tm3 = $tm2 - $tm;
}
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $tm3 < 31) {
    ?> 
    <meta http-equiv = "refresh" content = "0; url=menu.php"/>
    <?php
    exit;
}
?>  
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login Page</title>
        <link rel="icon" href="img/amora.png" type="image/x-icon" sizes="32x32">
        <link rel="icon" type="image/x-icon" href="img/amoraicon.ico" >
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            input[type=text] {
                outline: 0;
                border-width: 0 0 2px;
                border-color: blue
            }
            input[type=text]:focus {
                border-color: green
            }
            input[type=password] {
                outline: 0;
                border-width: 0 0 2px;
                border-color: blue
            }
            input[type=password]:focus {
                border-color: green
            }
        </style>
    </head>
    <body>
        <?php
        
        $ip = $_SERVER['REMOTE_ADDR'];
                
        $username = $password = "";
        $username_err = $password_err = $login_err = "";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Check if username is empty
            if (empty(trim($_POST["username"]))) {
                $username_err = "Please enter username.";
            } else {
                $username = trim($_POST["username"]);
            }

            // Check if password is empty
            if (empty(trim($_POST["password"]))) {
                $password_err = "Please enter your password.";
            } else {
                $password = trim($_POST["password"]);
            }

            // Validate credentials
            if (empty($username_err) && empty($password_err)) {
                // Prepare a select statement
                $sql = "SELECT id, username, password FROM users WHERE username = '" . $username . "' and password = '" . $password . "'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    $id = $row["user_system_id"];
                    session_start();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["username"] = $username;
                    $_SESSION["timeout"] = "" . date("YmdHm");
                    ?> 
                    <meta http-equiv = "refresh" content = "0; url=menu.php"/>
                    <?php
                }
            }
            // Close connection
            mysqli_close($conn);
        }
        ?>
        <a href="index.php" class="w3-bar-item w3-button" style="position: absolute; left: 6px; top: 2px; text-decoration: none;"><img src="img/logo1.png" style="width: 32px; height: 32px; margin-right: 12px;"/><strong>Amora</strong> Sofware & Services</a><br>
             
        <div class="wrapper fadeInDown" style="margin-top: 100px;">
            <div id="formContent" style="border: 1px solid gray; width: 260px; height: 300px;margin: auto;">
                <!-- Login Form -->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . $p2; ?>" method='post' accept-charset='UTF-8' style="padding: 20px; background-color: #F2F3F4; background: linear-gradient(to bottom, #F2F3F4, white); ">
                    <div class="form-group">
                        <label>Usu&aacute;rio</label>
                        <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </div>    
                    <div class="form-group">
                        <label>Senha</label>
                        <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>

                    <br>
                    <a href="#" onclick="this.closest('form').submit();return false;">
                        <img src="img/login.png" style="width: 32px; height: 32px;" title="Entrar">
                    </a>                    
                    <!--<input type="submit" class="fadeIn fourth" value="Entrar">-->
                    <input type='hidden' name='t' value='0'>
                    <input type='hidden' id="tblmn" name='scrsz'>
                </form>

                <!-- Remind Passowrd  -->
                <div id="formFooter" style="padding-left: 20px;">
                    <a href="#" style="text-decoration: none;">Change my password</a>
                </div>

            </div>
        </div>
        <div style="width: 100%; position: absolute; bottom: 2px; text-align: center; margin-bottom: 2px;">     
            <a href="index.php" style="text-decoration: none;"><img src="img/img1.png" style="width: 32px; height: 32px;"/></a><br>
            <p>Powered by: Jos&iacute; Jaime Com&iacute;</p>
        </div>             
    </body>
</html>
