

<?php
$pdo = new PDO('mysql:host=localhost;dbname=dbkfz', 'root', ''); 
 
$statement = $pdo->prepare("SELECT email, password FROM users");
 
if($statement->execute()) {
    while($row = $statement->fetch()) {
        echo $row['email']."<br />";
    }    
} else {
    echo "SQL Error <br />";
    echo $statement->queryString."<br />";
    echo $statement->errorInfo()[2];
}
?>