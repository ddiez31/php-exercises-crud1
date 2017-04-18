<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>SQL CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

</head>
<body>

<?php

$user = 'root';
$pass = '070401';

// liste client
try {
    $bdd = new PDO('mysql:host=localhost;dbname=colyseum',$user,$pass);
    echo '<strong>'."Liste clients:".'</strong><br>';
    foreach($bdd->query('SELECT * FROM clients') as $row) {
        echo($row['lastName'].' '.$row['firstName'].'<br>');
    }
    $bdd = null;
} catch(PDOException$e) {
    print "Erreur!:".$e->getMessage().'<br>';
    die();
}
echo '<hr>';


// liste types spectables
try {
    $bdd = new PDO('mysql:host=localhost;dbname=colyseum',$user,$pass);
    echo '<strong>'."Liste types de spectacles:".'</strong><br>';
    foreach($bdd->query('SELECT * FROM showTypes') as $row) {
        echo(utf8_encode($row['type']).'<br>');
    }
    $bdd = null;
} catch(PDOException$e) {
    print "Erreur!:".$e->getMessage().'<br>';
    die();
}
echo '<hr>';


// liste 20 premiers clients
$count = 0;
try {
    $bdd = new PDO('mysql:host=localhost;dbname=colyseum',$user,$pass);
    echo '<strong>'."Liste des 20 premiers clients:".'</strong><br>';
    foreach($bdd->query('SELECT * FROM clients') as $row) {
        $count +=1;
        if($count <= 20) {
            echo($row['id'].': '.$row['lastName'].' '.$row['firstName'].'<br>');
        }
    }
    $bdd = null;
} catch(PDOException$e) {
    print "Erreur!:".$e->getMessage().'<br>';
    die();
}
echo '<hr>';


?>

</body>
</html>