<!DOCTYPE html>
<html>
<body>

<h1>DATABASE CONNECTION</h1>

<?php
ini_set('display_errors', 1);
echo "Hello Cloud computing class 0818!";
?>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     echo '<p>The DB exists</p>';
     echo getenv("dbname");
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
       "host=ec2-23-21-186-85.compute-1.amazonaws.com;port=5432;user=ecxuhvkjjpabxs;password=4aa6e7a3c326588d49403cf672346476746695df8c3e99974f871a647dab4720;dbname=dafbodjoa0vfna",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
        
   ));
}  

$sql = "SELECT * FROM student ORDER BY stuid";
$stmt = $pdo->prepare($sql);
//Thiết lập kiểu dữ liệu trả về
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$resultSet = $stmt->fetchAll();
echo '<p>Students information:</p>';
foreach ($resultSet as $row) {
	echo $row['stuid'];
        echo "    ";
        echo $row['fname'];
        echo "    ";
        echo $row['email'];
        echo "    ";
        echo $row['classname'];
        echo "<br/>";
}

?>
</body>
</html>
