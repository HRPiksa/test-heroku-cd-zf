<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava</title>

    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    require 'db.php';

    session_start();

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = trim($_REQUEST['username']);
        $password = trim($_REQUEST['password']);

        $query = $con->prepare("SELECT * FROM zeljko_k WHERE username = ?;");

        $query->bind_param("s", $username);

        $query->execute();

        $row = $query->get_result()->fetch_assoc();

        if ($row) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username;

                header("Location: dashboard.php");
            } else {
                echo "<div class='form'>
                      <h3>Neispravna lozinka.</h3><br/>
                      <p class='link'>Kliknite ovdje za ponovnu <a href='login.php'>Prijavu</a> .</p>
                      </div>";
            }
        } else {
            echo "<div class='form'>
                  <h3>Nepostojeći korisnik.</h3><br/>
                  <p class='link'>Kliknite ovdje za ponovnu <a href='login.php'>Prijavu</a> .</p>
                  </div>";
        }
    } else {
    ?>
        <form class="form" method="post" name="login">
            <h1 class="login-title">Prijava</h1>

            <input type="text" class="login-input" name="username" placeholder="Korisnik" autofocus="true" />
            <input type="password" class="login-input" name="password" placeholder="Lozinka" />

            <input type="submit" value="Prijava" name="submit" class="login-button" />

            <p class="link">Nemate račun? <a href="register.php">Registrirajte se</a></p>
        </form>
    <?php
    }
    ?>
</body>

</html>