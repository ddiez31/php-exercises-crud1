<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>SQL CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

</head>
<body>

<?php

$user = '****';
$pass = '****';

// liste clients
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
try {
    $bdd = new PDO('mysql:host=localhost;dbname=colyseum',$user,$pass);
    echo '<strong>'."Liste des 20 premiers clients:".'</strong><br>';
    foreach($bdd->query('SELECT * FROM clients LIMIT 20') as $row) {
        echo($row['id'].': '.$row['lastName'].' '.$row['firstName'].'<br>');
    }
    $bdd = null;
} catch(PDOException$e) {
    print "Erreur!:".$e->getMessage().'<br>';
    die();
}
echo '<hr>';


// liste clients avec carte fidélité
try {
    $bdd = new PDO('mysql:host=localhost;dbname=colyseum',$user,$pass);
    echo '<strong>'."Liste clients avec carte fidélité:".'</strong><br>';
    foreach($bdd->query('SELECT lastName, firstName FROM clients, cards WHERE clients.cardNumber=cards.cardNumber AND cardTypesId=1') as $row) {
        echo($row['lastName'].' '.$row['firstName'].'<br>');
    }
    $bdd = null;
} catch(PDOException$e) {
    print "Erreur!:".$e->getMessage().'<br>';
    die();
}
echo '<hr>';


// liste clients dont nom commence par M
try {
    $bdd = new PDO('mysql:host=localhost;dbname=colyseum',$user,$pass);
    echo '<strong>'."Liste clients dont le nom commence par la lettre M:".'</strong><br>';
    foreach($bdd->query('SELECT * FROM clients WHERE lastName LIKE "M%" ORDER BY lastName') as $row) {
        echo('Nom: '.$row['lastName'].'<br>');
        echo('Prénom: '.$row['firstName'].'<br>');
    }
    $bdd = null;
} catch(PDOException$e) {
    print "Erreur!:".$e->getMessage().'<br>';
    die();
}
echo '<hr>';


// liste calendrier spectacles
try {
    $bdd = new PDO('mysql:host=localhost;dbname=colyseum',$user,$pass);
    echo '<strong>'."Calendrier des spectacles:".'</strong><br>';
    foreach($bdd->query('SELECT * FROM shows ORDER BY title') as $row) {
        echo('- '.$row['title'].' par '.$row['performer'].', le '.$row['date'].' à '.$row['startTime'].'<br>');
    }
    $bdd = null;
} catch(PDOException$e) {
    print "Erreur!:".$e->getMessage().'<br>';
    die();
}
echo '<hr>';


// liste clients classés
try {
    $bdd = new PDO('mysql:host=localhost;dbname=colyseum',$user,$pass);
    echo '<strong>'."Liste clients classés:".'</strong><br>';
    foreach($bdd->query('SELECT * FROM clients LEFT JOIN cards ON clients.cardNumber=cards.cardNumber ORDER BY clients.id') as $row) {
        switch($row['cardTypesId']) {
            case !1:
                echo('Nom: '.$row['lastName'].'<br>');
                echo('Prénom: '.$row['firstName'].'<br>');
                echo('Date de naissance: '.$row['birthDate'].'<br>');
                echo('Carte de fidélité: Non<br>');
                echo '<br>';
                break;
            case 1:
                echo('Nom: '.$row['lastName'].'<br>');
                echo('Prénom: '.$row['firstName'].'<br>');
                echo('Date de naissance: '.$row['birthDate'].'<br>');
                echo('Carte de fidélité: Oui<br>');
                echo('Numéro de carte: '.$row['cardNumber'].'<br>');
                echo '<br>';
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
