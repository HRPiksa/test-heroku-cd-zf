<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>

    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    require 'db.php';

    if (isset($_REQUEST['name']) && isset($_REQUEST['username']) && isset($_REQUEST['email']) && isset($_REQUEST['password'])) {
        $name = trim($_REQUEST['name']);
        $username = trim($_REQUEST['username']);
        $email = trim($_REQUEST['email']);
        $password = trim($_REQUEST['password']);
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $query = $con->prepare("SELECT * FROM zeljko_k WHERE username = ?;");

        $query->bind_param("s", $username);

        $query->execute();
        $query->store_result();

        if ($query->num_rows() > 0) {
            echo "<div class='form'>
                  <h3>Ovaj korisnik je već registriran.</h3><br/>
                  <p class='link'>Kliknite ovdje za ponovnu <a href='register.php'>Registraciju</a> .</p>
                  </div>";
        } else {
            $insertQuery = $con->prepare("INSERT INTO zeljko_k (name, username, email, password) VALUES (?, ?, ?, ?);");

            $insertQuery->bind_param("ssss", $name, $username, $email, $password_hash);

            $result = $insertQuery->execute();

            if ($result) {
                echo "<div class='form'>
                      <h3>Uspješno ste se registrirali.</h3><br/>
                      <p class='link'>Kliknite ovdje za <a href='login.php'>Prijavu</a></p>
                      </div>";
            } else {
                echo "<div class='form'>
                      <h3>Nedostaju obavezna polja.</h3><br/>
                      <p class='link'>Kliknite ovdje za ponovnu <a href='register.php'>Registraciju</a> .</p>
                      </div>";
            }
        }
    } else {
    ?>
        <form class="form" action="" method="post">
            <h1 class="login-title">Registracija</h1>

            <input type="text" class="login-input" name="name" placeholder="Ime i prezime" required />
            <input type="text" class="login-input" name="email" placeholder="Email adresa">
            <input type="text" class="login-input" name="username" placeholder="Korisnik" required />
            <input type="password" class="login-input" name="password" placeholder="Lozinka">

            <input type="submit" name="submit" value="Registracija" class="login-button">

            <p class="link">Već imate račun? <a href="login.php">Prijavite se ovdje</a></p>
        </form>
    <?php
    }
    ?>
</body>

</html>