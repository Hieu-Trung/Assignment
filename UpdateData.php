<!DOCTYPE html>
<html>
<body>

<h1>UPDATE DATA TO DATABASE</h1>
<ul>
 <form name="UpdateData" action="UpdateData.php" method="POST" >
<li style="list-style: none;">User ID:</li><li style="list-style: none;"><input type="text" name="stuid" /></li>
<li style="list-style: none;">Full Name:</li><li style="list-style: none;"><input type="text" name="fname" /></li>
<li style="list-style: none;">Email:</li><li style="list-style: none;"><input type="text" name="email" /></li>
<li style="list-style: none;">Address:</li><li style="list-style: none;"><input type="text" name="classname" /></li>
<li style="list-style: none;"><input type="submit" /></li>
</form>
</ul>
<?php
// ini_set('display_errors', 1);
// echo "Update database!";
?>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     
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

//$sql = 'UPDATE student '
//                . 'SET name = :name, '
//                . 'WHERE ID = :id';
// 
//      $stmt = $pdo->prepare($sql);
//      //bind values to the statement
//        $stmt->bindValue(':name', 'Lee');
//        $stmt->bindValue(':id', 'SV02');
        // update data in the database
//        $stmt->execute();

        // return the number of row affected
        //return $stmt->rowCount();
$sql = "UPDATE student SET fname = '$_POST[fname]', email = '$_POST[email]', classname = '$_POST[classname]' WHERE stuid = '$_POST[stuid]'";
      $stmt = $pdo->prepare($sql);
if($stmt->execute() == TRUE){
    echo "Record updated successfully.";
} else {
    echo "Error updating record. ";
}
    
?>
</body>
</html>
