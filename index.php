<?php
require_once 'connect.php';
$pdo = new \PDO(DSN, USER);

// get the data from a form
$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);

// Formulaire
$query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
$statement = $pdo->prepare($query);
$statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
$statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);

$statement->execute();

$friends = $statement->fetchAll(PDO::FETCH_BOTH);
header("index.php");

//Liste
$state = $pdo->query("SELECT * FROM friend");
$teamWorks = $state->fetchAll();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDO FORMULAIRE ET LISTE</title>
</head>
    <body>

    <h2>Formulaire</h2>
    <form action="" method="post">
        <label for="firstname">First name:
            <input type="text"  name="firstname">
        </label>
        <br>
        <label for="lastname">Last name:
            <input type="text" name="lastname" >
        </label>
        <br>
        <input type="submit" value="Submit">
    </form>

    <h2>Listes d'amis</h2>

    <?php
    if ($teamWorks) {
        foreach ($teamWorks as $teamWork) {
        ?>
        <p>
            Prénom: <?= $teamWork['firstname']; ?>

            Nom :<?=  $teamWork['lastname'];
        }
    }?>
        </p>
    </body>
</html>