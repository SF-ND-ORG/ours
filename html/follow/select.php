<!DOCTYPE html>
<?php

$dbhost="localhost:3306";
$dbuser="root";
$dbpass="PASSWORD";
$conn=mysqli_connect($dbhost,$dbuser,$dbpass);
mysqli_query($conn,"set names utf8");
mysqli_select_db($conn,'ours');

if($_SERVER["REQUEST_METHOD"]=="GET")
{
    $s=$_GET['ta'];
    $l=explode("\n",$s);
    foreach($l as $i)
    {
        if($i=='')continue;
        $sql="select * from follow where name='".$i."'";
        $retval=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($retval))
        {
            echo $row['qq']."<br>";
        }
    }
}

?>

<form action="select.php" method="GET" enctype="multipart/form-data">
<textarea name="ta"></textarea>
<hr>
<input type="submit" name="submit" value="Submit" />
</form>