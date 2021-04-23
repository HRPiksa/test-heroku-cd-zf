<?php
    include "author.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nadzorna ploča</title>

    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="form">
        <p>Pozdrav,  <b> <?php echo $_SESSION['username']; ?>!</b></p>

        <br>

        <p>Ovo je početna stranica.</p>

        <br>

        <p><a href="logout.php">Odjava</a></p>
    </div>
</body>

</html>