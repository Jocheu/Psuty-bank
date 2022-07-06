<?php
include 'connect.php';
$doZakupu = $_POST['iloscKupiona'];
$zaIle = $_POST['zaIleKupiona'];
$walutaIle = $_POST['wyborWalutyZakup'];
if($walutaIle == 1){
    $walutaIle = "Srodki_zl";
}
else if($walutaIle ==2){
    $walutaIle = "Srodki_eu";
}else{
    $walutaIle = "Srodki_am";
}
$walutaZaIle = $_POST['wyborWalutyZaCo'];
if($walutaZaIle == 1){
    $walutaZaIle = "Srodki_zl";
}
else if($walutaZaIle ==2){
    $walutaZaIle = "Srodki_eu";
}else{
    $walutaZaIle = "Srodki_am";
}
$konto = $_POST['naKtoreKontoKup'];
echo $doZakupu.'<br>';
echo $zaIle.'<br>';
echo $walutaIle.'<br>';
echo $walutaZaIle.'<br>';
echo $konto.'<br>';
$sql1 = "UPDATE konto set $walutaIle = $walutaIle+$doZakupu where id_konta=$konto";
$sql2 = "UPDATE konto set $walutaZaIle = $walutaZaIle-$zaIle where id_konta=$konto";
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