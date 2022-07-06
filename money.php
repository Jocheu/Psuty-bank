<?php
include 'connect.php';
$sql = "UPDATE konto SET Srodki_zl = Srodki_zl + 250 WHERE id_konta = 1";
if(mysqli_query($link, $sql)){
    echo "udało się";
}
else{
    echo "Nie udało się". mysqli_error($link);
}
header('location:index.html');
?>