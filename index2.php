<?php
include 'connect.php';
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style4.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body onload="initClock()">


    <section>
        <div id="pasek">
            <img src="logo.gif" id="logo" alt="">
            <div id="napis-logo">
                <h1 style="--i:1;">I</h1>
                <h1 style="--i:2;">n</h1>
                <h1 style="--i:3;">f</h1>
                <h1 style="--i:4;">i</h1>
                <h1 style="--i:5;">n</h1>
                <h1 style="--i:6;">i </h1>
                <h1 style="--i:7;">B</h1>
                <h1 style="--i:8;">a</h1>
                <h1 style="--i:9;">n</h1>
                <h1 style="--i:10;">k</h1>
            </div>
        </div>
        <div id="content">
            <div id="wazneRzeczy">
                <div id="podst-info">
                    <?php
                    $sql = "SELECT * FROM konto WHERE id_konta = 1";
                    $res = mysqli_query($link, $sql);
                    $result = mysqli_fetch_array($res);
                    $sql2 = "SELECT * FROM konto WHERE id_konta = 2";
                    $res2 = mysqli_query($link, $sql2);
                    $result2 = mysqli_fetch_array($res2);
                    ?>
                    <div id="wybor">
                        <button id="numeroUno" onclick="pokaz1()">Konto1</button>
                        <button id="numeroDos" onclick="pokaz2()">Konto2</button>
                    </div>

                    <div id="konto1" class="konta">
                        <div class="inf">
                            <h3>Nazwa konta: <?php echo $result['Nazwa'] ?></h3>
                            <h3>Dostępne środki: </h3>

                            <p><?php echo sprintf('%.2f', $result['Srodki_zl']) ?> zł </p>
                            <p><?php echo sprintf('%.2f', $result['Srodki_eu']) ?> € </p>
                            <p><?php echo sprintf('%.2f', $result['Srodki_am']) ?> $ </p>
                            <h3>Numer konta: <?php echo $result['Numer_konta'] ?></h3>
                        </div>


                    </div>
                    <div id="konto2" class="konta">
                        <div class="inf">
                            <h3>Nazwa konta: <?php echo $result2['Nazwa'] ?></h3>
                            <h3>Dostępne środki: </h3>

                            <p><?php echo sprintf('%.2f', $result2['Srodki_zl']) ?> zł </p>
                            <p><?php echo sprintf('%.2f', $result2['Srodki_eu']) ?> € </p>
                            <p><?php echo sprintf('%.2f', $result2['Srodki_am']) ?> $ </p>
                            <h3>Numer konta: <?php echo $result2['Numer_konta'] ?></h3>
                        </div>

                    </div>
                </div>
                <div id="operacje">
                    <div id="przelew">
                        <form action="przelew.php" method="post">
                            <h3>Przelew: </h3>
                            <p>Przelej na konto: <select name="naJakieKonto" id="selectKonto">
                                    <option value="1"><?php echo $result['Nazwa'] ?></option>
                                    <option value="2"><?php echo $result2['Nazwa'] ?></option>
                                </select> </p>
                            <p>Sumę: <input id="ilosc1" type="text" name="ile" onkeyup="kod1()">
                                <select name="jakaWaluta" id="selectWaluta">
                                    <option value="pln">zł</option>
                                    <option value="eur">€</option>
                                    <option value="usd">$</option>
                                </select>
                            </p>
                            <input id="przelew1" type="submit" value="Wykonaj">
                        </form>
                    </div>
                    <div id="zakupWalut">
                        <form action="zakup.php" method="post">
                            <h3>Zakup Walut</h3>
                            <p>Kup: <input id="ileKupic" type="text" name="iloscKupiona" onkeyup="kod2()">
                                <select name="wyborWalutyZakup" id="wyborWalutyZakup">
                                    <option value="1">zł</option>
                                    <option value="2">€</option>
                                    <option value="3">$</option>
                                </select>
                            </p>
                            <p>Za: <input name="zaIleKupiona" id="wynik" type="text"> </a> <select name="wyborWalutyZaCo" id="wyborWalutyZaCo">
                                    <option value="1">zł</option>
                                    <option value="2">€</option>
                                    <option value="3">$</option>
                                </select> </p>
                            <p>Na konto: <select name="naKtoreKontoKup" id="selectKonto">
                                    <option value="1"><?php echo $result['Nazwa'] ?></option>
                                    <option value="2"><?php echo $result2['Nazwa'] ?></option>
                                </select> </p>
                            <input id="zatwZakup" type="submit" value="Zakup">
                        </form>
                    </div>

                </div>
            </div>
            <div id="mniejWazne">
                <div id="zegar">
                    <div id="date">
                        <span id="dayname">Day,</span>
                        <span id="daynum">00</span>
                        <span id="month">Month</span>
                        <span id="year">year</span>
                    </div>
                    <div id="czas">
                        <span id="hour">00</span>:
                        <span id="minute">00</span>:
                        <span id="seconds">00</span>:
                        <span id="period">AM</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

</body>

</html>

<script>
    alert("zapłać nam");
    var i = 0;
    var konto1 = document.getElementById("konto1");
    var konto2 = document.getElementById("konto2");
    var przelew1 = document.getElementById("przelew1");
    let spr1 = new RegExp('[0-9,.]{1,}');
    przelew1.disabled = true;

    konto2.style.display = "none";

    function pokaz1() {
        konto1.style.display = "block";
        konto2.style.display = "none";
    }

    function pokaz2() {
        konto1.style.display = "none";
        konto2.style.display = "block";
    }

    function kod1() {
        var ilosc1 = document.getElementById("ilosc1").value;
        if (spr1.test(ilosc1)) {
            przelew1.disabled = false;
        } else {
            przelew1.disabled = true;
            return;
        }

    }

    var btnZakup = document.getElementById("zatwZakup");
    btnZakup.disabled = true;
    var wynikTu = document.getElementById("wynik");
    var wynik;

    function kod2() {
        var ileKupic = document.getElementById("ileKupic").value;
        ileKupic = parseFloat(ileKupic);
        if (document.getElementById("wyborWalutyZakup").value == 1) {
            if (document.getElementById("wyborWalutyZaCo").value == 1) {
                wynik = ileKupic;
                wynik = wynik.toFixed(2);
                wynikTu.value = wynik;
                btnZakup.disabled = false;
            } else if (document.getElementById("wyborWalutyZaCo").value == 2) {
                wynik = ileKupic * 0.21;
                wynik = wynik.toFixed(2);
                wynikTu.value = wynik;
                btnZakup.disabled = false;
            } else if (document.getElementById("wyborWalutyZaCo").value == 3) {
                wynik = ileKupic * 0.23;
                wynik = wynik.toFixed(2);
                wynikTu.value = wynik;
                btnZakup.disabled = false;
            }
        } else if (document.getElementById("wyborWalutyZakup").value == 2) {
            if (document.getElementById("wyborWalutyZaCo").value == 1) {
                wynik = ileKupic * 4.67;
                wynik = wynik.toFixed(2);
                wynikTu.value = wynik;
                btnZakup.disabled = false;
            } else if (document.getElementById("wyborWalutyZaCo").value == 2) {
                wynik = ileKupic;
                wynik = wynik.toFixed(2);
                wynikTu.value = wynik;
                btnZakup.disabled = false;
            } else if (document.getElementById("wyborWalutyZaCo").value == 3) {
                wynik = ileKupic * 1.06;
                wynik = wynik.toFixed(2);
                wynikTu.value = wynik;
                btnZakup.disabled = false;
            }
        } else if (document.getElementById("wyborWalutyZakup").value == 3) {
            if (document.getElementById("wyborWalutyZaCo").value == 1) {
                wynik = ileKupic * 4.42;
                wynik = wynik.toFixed(2);
                wynikTu.value = wynik;
                btnZakup.disabled = false;
            } else if (document.getElementById("wyborWalutyZaCo").value == 2) {
                wynik = ileKupic * 0.95;
                wynik = wynik.toFixed(2);
                wynikTu.value = wynik;
                btnZakup.disabled = false;
            } else if (document.getElementById("wyborWalutyZaCo").value == 3) {
                wynik = ileKupic;
                wynik = wynik.toFixed(2);
                wynikTu.value = wynik;
                btnZakup.disabled = false;
            }
        }
    }

    function updateClock(){
        var now = new Date();
        var dname = now.getDay(), mo = now.getMonth(), dnum = now.getDate(), yr = now.getFullYear(), hou = now.getHours(), minut = now.getMinutes(), sec = now.getSeconds(), pe = "AM";
        if(hou == 0){
            hou = 12;
        }
        if(hou > 12){
            hou = hou -12;
            pe = "PM";
        }

        Number.prototype.pad = function(digits){
            for(var n = this.toString(); n.length < digits; n = 0 +n);
            return n;
        }
        var months = ["Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień"];
        var week = [ "Niedziela", "Poniedziałek", "Wtorek", "Środa", "Czwartek", "Piątek", "Sobota"];
        var ids = ["dayname", "daynum", "month", "year", "hour", "minute", "seconds", "period"];
        var values = [week[dname], dnum.pad(2), months[mo], yr, hou.pad(2), minut.pad(2), sec.pad(2), pe];
        for(var i = 0; i<ids.length; i++){
            document.getElementById(ids[i]).firstChild.nodeValue = values[i];
        }
    }
    function initClock(){
        updateClock();
        window.setInterval("updateClock()", 1);
    }
</script>


<?php
mysqli_close($link);
?>