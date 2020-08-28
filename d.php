<?php



session_start();

$_SESSION['name'] = "MeyerTho";

$_SESSION['group'] = "schueler";

$pdo = new PDO("mysql:host=localhost;dbname=test", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if($_SESSION['group'] == "lehrer") {
    header("Location: ./admin.php");
}

$name = $_SESSION['name'];

$success = 'null';
$err_code = 0;
if(isset($_GET['err_code'])) {
    $err_code = $_GET['err_code'];
}
$isAlreadySet = false;

$ziel_1_id = 0;
$ziel_2_id = 0;

if(isset($_POST['ziel_1']) && isset($_POST['ziel_2']) && isset($_POST['bemerkung'])){
    $ziel_1_id = $_POST['ziel_1'];
    $ziel_2_id = $_POST['ziel_2'];
    $statement_fetch = $pdo->prepare("SELECT * FROM stud_user WHERE kuerzel = '$name'");
    $statement_fetch->execute();
    while($row = $statement_fetch->fetch()) {
        if($row['ziel_1'] != 0 && $row['ziel_2'] != 0) {
            $ziel_1_id = $row['ziel_1'];
            $ziel_2_id = $row['ziel_2'];
            $isAlreadySet = true;
            if($err_code == 0) {
                $err_code = 2;
            }
        }
    }

    if($ziel_1_id != 0 && $ziel_2_id != 0 && !$isAlreadySet) {
        $statement_insert = $pdo->prepare("INSERT INTO `stud_user` (`ID`, `kuerzel`, `ziel_1`, `ziel_2`, `bemerkungen`) VALUES (NULL, '$name', '$ziel_1_id', '$ziel_2_id', '$bemerkung')");
        $statement_insert->execute();
        $success = 'true';
        $isAlreadySet = true;
    }
} else {
    $statement_fetch = $pdo->prepare("SELECT * FROM stud_user WHERE kuerzel = '$name'");
    $statement_fetch->execute();
    while($row = $statement_fetch->fetch()) {
        $ziel_1_id = $row['ziel_1'];
        $ziel_2_id = $row['ziel_2'];
        if($ziel_1_id != 0 && $ziel_2_id != 0) {
            $isAlreadySet = true;
        }
    }
}



?>

<!DOCTYPE html>
<html>
    <head>
        <title>Studienfahrt - Anmeldung (Schüler)</title>
        <meta charset="utf-8">
		<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,450,500,600" rel="stylesheet">
        <meta charset="utf-8">
        <style>
        h2,h3 {
    font-weight: 450;
    transition: ease-in-out 250ms;
}

h2:hover,h3:hover {
    color: rgb(0, 71, 133);
}

body {
    margin: 20px;
    font-family: 'Rubik';
    color: black;
    font-size: 15px;
}

img.kag-logo {
    position: absolute;
    left: 50%;
    margin-left: -156px;
    margin-top: 15px;
}

div.box {
    overflow: hidden;
    width: 600px;
    color: black;
    position: absolute;
    left: 50%;
    margin-left: -300px;
    margin-top: 50px;
    border-radius: 8px;
    padding: 15px;
    transition: ease 300ms;
    box-shadow: 0 5px 5px 0 rgba(0, 0, 0, 0.05);
}

hr {
    border: 0;
    border-top: 1px solid #eeeeee;
}

div.box:hover {
    transition: ease 300ms;
    box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.1);
    margin-top: 45px;
}

h2.title-box {
    margin-top: 160px;
}

input[type=text],input[type=password],select {
    border: none;
    background-color: #e5e5e5;
    width: 100%;
    padding: 6px;
    border-radius: 3px;
    height: 30px;
    transition: ease-in-out 250ms;
    color: black;
}

input[type=submit] {
    border: none;
    background-color: #e5e5e5;
    width: 120px;
    padding: 6px;
    height: 30px;
    border-radius: 3px;
    font-family: 'Rubik';
    font-weight: 450;
    position: absolute;
    color: black;
    left: 50%;
    margin-left: -60px;
    transition: ease-in-out 250ms;
}

input:hover,select:hover {
    background-color: rgba(0, 53, 100, 0.158);
}

p.about {
    position: absolute;
    bottom: 0;
    left: 0;
    font-size: 10;
    color: white;
}
        h2.title-box {
    margin-top: 40px;
}

div.box {
    width: 90%;
    margin-left: 5%;
    left: 0;
}

table {
    position: relative;
    width: 100%;
    border-spacing: 0;
    border-collapse: collapse;
}

th {
    padding-bottom: 5px;
    transition: ease-in-out 250ms;
    padding-left: 10px;
}

td {
    text-align: center;
    padding-top: 5px;
    padding-bottom: 5px;
    border-top: 1px solid black;
    border-spacing: 0;
    overflow: hidden;
    padding-left: 15px;
    transition: ease-in-out 250ms;
}

table th:hover {
    color: rgb(0, 71, 133);
}

table td:hover {
    color: rgb(0, 71, 133);
}

td.register_td {
    padding-left: 80px;
    padding-right: 15px;
}

button {
    position: absolute;
    border: none;
    background-color: #e5e5e5;
    width: 110px;
    padding: 6px;
    height: 40px;
    border-radius: 3px;
    font-family: 'Rubik';
    font-weight: 450;
    color: black;
    left: 50%;
    margin-left: -80px;
    transition: ease-in-out 250ms;
}

button.register {
    position: relative;
}

input.submit {
    margin-top: 45px;
}

textarea {
    outline: none;
    resize: none;
    background-color: white;
}

button.reset {
    width: 120px;
    height: 30px;
    margin-left: -60px;
    margin-top: 40px;
    border: none;
}

button:hover,select:hover {
    background-color: rgba(0, 53, 100, 0.158);
}

button.grey {
    background-color: #e5e5e5;
    color: gray;
}

button.grey:hover {
    background-color: #e5e5e5;
}

@media screen and (max-width: 1300px) {
    div.box {
        width: 96%;
        margin-left: 1%;
    }
}
        </style>
    </head>
    <body>
        <h2 align=center class="title">Korbinian-Aigner-Gymnasium Erding</h2>
        <div class="box">
            <?php
                if($success == 'true') {
                    echo '<p style="color: green; font-weight: bold;">Erfolgreich eingetragen!</p>';
                }

                if($err_code) {
                    if($err_code == 1) {
                        echo '<p style="color: red; font-weight: bold;">Fehler: Nicht alles ausgefÃ¼llt</p>';
                    } else if($err_code == 2) {
                        echo '<p style="color: red; font-weight: bold;">Fehler: Bereits eingetragen! Du kannst die Eintragung weder rÃ¼ckgÃ¤ngig machen noch verÃ¤ndern</p>';
                    } else {
                        echo '<p style="color: red; font-weight: bold;">Fehler: Unbekannter Fehler</p>';
                    }
                }
            ?>
            <p style="font-weight: bold;">Anleitung:</p>
            <p>Als erstes siehst du unten eine Tabelle. Dort stehen alle Fahrten und die grundlegenden Informationen. Solltest du dich eintragen wollen, kannst du auf den Knopf in der Zeile deines gewünschten Projektes klicken. Sobald du das getan hast wird dir es als eingetragen für den ersten Wunsch angezeigt. Du hast aber auch noch einen zweiten Wunsch, solltest du in den ersten nicht reinkommen. Du kannst, wenn du auf den Knopf "Zurücksetzen" klickst deine Eingaben wieder rückgängig machen. Unten siehst du auch noch ein Textfeld für die Bemerkungen, in diesem Textfeld kannst du Nachrichten an den Organisator schreiben. Sobald du auf den Knopf "Abschicken" klickst wirst du eingetragen. Nachdem du dich eingetragen hast ist die Eintragung <b>nicht</b> mehr veränderbar!</p>
            <table>
                <th>Ziel</th>
			    <th>Lehrkraft</th>
			    <th>Bemerkung</th>
			    <th>Transfer</th>
			    <th>Voraussetzungen</th>
			    <th>Startdatum</th>
			    <th>Enddatum</th>
			    <th>Max Teilnehmer</th>
			    <th>Unterbringung</th>
                <th>Max Preis</th>
            
                <?php
                    $statement = $pdo->prepare("SELECT * FROM stud_ziel");
                    $statement->execute();
                    while($row = $statement->fetch()) {
                        $var = $row['ziel'];
                        echo "\n<tr>
                        <td>
                        $var
                        </td>
                        ";
                        $var = $row['Lehrkraft'];
                        echo "
                        <td>
                        $var
                        </td>
                        ";
                        $var = $row['bemerkung'];
                        echo "
                        <td>
                        $var
                        </td>
                        ";
                        $var = $row['transfer'];
                        echo "
                        <td>
                        $var
                        </td>
                        ";
                        $var = $row['voraussetzung'];
                        echo "
                        <td>
                        $var
                        </td>
                        ";
                        $var = $row['start_datum'];
                        $splitted = explode("-", $var);
                        $comp = $splitted[2] . "." . $splitted[1] . "." . $splitted[0];
                        echo "
                        <td>
                        $comp
                        </td>
                        ";
                        $var = $row['end_datum'];
                        $splitted = explode("-", $var);
                        $comp = $splitted[2] . "." . $splitted[1] . "." . $splitted[0];
                        echo "
                        <td>
                        $comp
                        </td>
                        ";
                        $var = $row['max_teilnehmer'];
                        echo "
                        <td>
                        $var
                        </td>
                        ";
                        $var = $row['unterbringung'];
                        echo "
                        <td>
                        $var
                        </td>
                        ";
                        $var = $row['max_preis'];
                        echo "
                        <td>
                        $var
                        </td>
                        ";
                        $grey = "";
                        if($isAlreadySet) {
                            $grey = " grey";
                        }
                        echo '
                        <td class="register_td">
                        <button class="register' . $grey . '" id="reg' . $row['ID'] . '" onclick="onClickOnButton(' . $row['ID'] . ');">Eintragen 1. Wunsch</button>
                        </td>
                        ';
                        echo "</tr>";
                    }
                ?>

                
            </table>
            <?php if(!$isAlreadySet) {echo '<button onclick="reset();" id="reset" class="reset">Zurücksetzen</button>';}?>
            <form action="." method="POST" id="submit"> 
                <input type="hidden" id="ziel_1" name="ziel_1" value="<?php echo $ziel_1_id;?>"></input>
                <input type="hidden" id="ziel_2" name="ziel_2" value="<?php echo $ziel_2_id;?>"></input>
                <?php if(!$isAlreadySet) {echo '<p style="font-size: 12px; font-weight: bold;">Um zu verhindern, dass du dieses Feld übersehen hast gebe doch bitte, sofern du keine Bemerkungen hast, "Keine Bemerkungen" ein.</p>';}?>
                <?php if(!$isAlreadySet) {echo '<textarea id="bemerkung" rows="5" cols="60" name="bemerkung" placeholder="Bitte hier Bemerkungen eingeben!" required></textarea>';}?>
                <?php if(!$isAlreadySet) {echo '<input type="submit" value="Abschicken" class="submit">';}?>
            </form>
        </div>
        
    </body>
    <script>
    var state = 1;

var ziel_1_selected = 0;
var ziel_2_selected = 0;

var select1 = "Eintragen 1. Wunsch";
var select2 = "Eintragen 2. Wunsch";
var alreadySelected1 = "Eingetragen als 1. Wunsch";
var alreadySelected2 = "Eingetragen als 2. Wunsch";
var alreadySelected = "Bereits eingetragen";

var ziel_1 = document.getElementById("ziel_1").value;
    var ziel_2 = document.getElementById("ziel_2").value;
    if(ziel_1 != 0 && ziel_2 != 0) {
        state = 3;
        var buttons = document.getElementsByClassName("register");
        for(var i = 0; i < buttons.length; i++) {
            if(buttons[i].id.replace("reg", "") == ziel_1) {
                buttons[i].innerHTML = alreadySelected1;
            } else if(buttons[i].id.replace("reg", "") == ziel_2) {
                buttons[i].innerHTML = alreadySelected2;
            } else {
                buttons[i].innerHTML = alreadySelected;
            }
        }
    }

window.addEventListener("load",function() {
    document.getElementById('submit').addEventListener("submit",function(e) {
        if(ziel_1_selected == 0 || ziel_2_selected == 0) {
            document.getElementById("submit").action = "./?err_code=1";
        } else {
            document.getElementById("ziel_1").value = ziel_1_selected;
            document.getElementById("ziel_2").value = ziel_2_selected;
        }
    });
  });



function onClickOnButton(id) {
    if(state == 1) {
        state = 2;
        ziel_1_selected = id;
        var button = document.getElementById("reg" + id);
        var buttons = document.getElementsByClassName("register");
        for(var i = 0; i < buttons.length; i++) {
            buttons[i].innerHTML = select2;
        }
        button.innerHTML = alreadySelected1;
    } else if(state == 2 && id != ziel_1_selected) {
        state = 3;
        ziel_2_selected = id;
        var button = document.getElementById("reg" + id);
        var buttons = document.getElementsByClassName("register");
        for(var i = 0; i < buttons.length; i++) {
            if(buttons[i].id.replace("reg", "") != ziel_1_selected) {
                buttons[i].innerHTML = alreadySelected;
            }
            buttons[i].classList.add("grey");
        }
        button.innerHTML = alreadySelected2;
    }
}

function reset() {
    state = 1;
    ziel_1_selected = 0;
    ziel_2_selected = 0;
    var buttons = document.getElementsByClassName("register");
    for(var i = 0; i < buttons.length; i++) {
        buttons[i].innerHTML = select1;
        buttons[i].classList.remove("grey");
    }
}</script>
</html>
