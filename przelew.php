<?php
include 'connect.php';
$kontoZ = $_POST['naJakieKonto'];
if($kontoZ == 1){
    $kontoDo = 2;
}
else{
    $kontoDo = 1;
}


$ilosc = $_POST['ile'];

$waluta = $_POST['jakaWaluta'];
if($waluta == "pln"){
    $waluta = "Srodki_zl";
}
else if($waluta == "eur"){
    $waluta = "Srodki_eu";
}
else if($waluta == "usd"){
    $waluta = "Srodki_am";
}

$sql1 = "UPDATE konto set `$waluta`= `$waluta`+$ilosc where `id_konta`=$kontoZ";
$sql2 = "UPDATE konto set `$waluta`= `$waluta`-$ilosc where `id_konta`=$kontoDo";
if(mysqli_query($link, $sql1)){
    echo "1, udało się";
}
else{
    echo "Nie udało się". mysqli_error($link);
}
if(mysqli_query($link, $sql2)){
    echo "2, udało się";
}
else{
    echo "Nie udało się". mysqli_error($link);
}
header('location:index2.php')
?>