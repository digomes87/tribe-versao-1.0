<?php
// // Values received via ajax

$title=$_POST['title'];
$start=$_POST['start'];
$end=$_POST['end'];
 
// connection in dataBase
 try {
 $bdd = new PDO('mysql:host=localhost;dbname=tribe', 'root', '');
 } catch(Exception $e) {
 exit('Impossible de se connecter à la base de données.');
 }
 
$sql = "INSERT INTO evenement (title, start, end) VALUES (:title, :start, :end)";
$q = $bdd->prepare($sql);
$q->execute(array(':title'=>$title, ':start'=>$start, ':end'=>$end));

echo "Tudo certo Brow !";
?>
