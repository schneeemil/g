<style>
    h3 {
        margin: 2px;
    }
    
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
    text-align: center;
    align: center;
}

img.kag-logo {
    position: absolute;
    left: 50%;
    margin-left: -156px;
    margin-top: 15px;
}

div.box {
    overflow: hidden;
    width: 800px;
    color: black;
    position: absolute;
    left: 50%;
    margin-left: -400px;
    margin-top: 50px;
    border-radius: 12px;
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
    background-color: rgb(225, 241, 248);
}

h2.title-box {
    margin-top: 160px;
}

input[type=text],input[type=password],select {
    border: none;
    background-color: #ffffff;
    width: 100%;
    padding: 6px;
    border-radius: 3px;
    height: 30px;
    transition: ease-in-out 250ms;
    color: black;
}

input[type=submit] {
    border: none;
    background-color: #ffffff;
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
input.input {
    border-radius: 3px;
    
}
table.radio {
    margin-left:355px;
}
h2.d {
    margin-top: 50px;
}
h3 {
    margin-left: 360px;
    text-align: left;
}
input.submit{
    font: 1.5em;
}
p.echo{
    margin-top: 50px;
}
</style>

<?php

$pdo = new PDO("mysql:host=localhost;dbname=test", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
<div class="box">
<form>
    <p>Was ist Ihr Vorname?</p>
    <input name="page" class="input">
<?php
if ($_REQUEST['page']=="Chrastian") {
    echo '
    1.frage richtig';
}
?>

    <p>Was ist Ihr Nachname?</p>
    <input name ="page2"class="input"><br><br>
    <input type="submit" value="Überprüfen" class="submit">
<?php
if ($_REQUEST['page2']=="Hoffmann") {
    echo '<br><br>
    <h3>C harmant</h3>
    <h3>H umorvoll</h3>
    <h3>R adfan</h3>
    <h3>I ntilligent</h3>
    <h3>S au nett</h3>
    <h3>T anzbär</h3>
    <h3>I nformatikaffin</h3>
    <h3>A llesesser</h3>
    <h3>N iederbayer</h3>
    <br>
    <h3>H ilfsbereit</h3>
    <h3>O ffen</h3>
    <h3>F hysiker</h3>
    <h3>F indig</h3>
    <h3>M ulitinteressiert</h3>
    <h3>A lpenliebend</h3>
    <h3>N atürlich</h3>
    <h3>N eugierig</h3>
    ';
}
?>
<hr>
<?php
echo '   

<form>
    <h4>Waren Sie mit der Version HFF 3.0 zufrieden?   </h4>
    <table class="radio">
    <td>
    Ja
    <input type="radio" name="frage1" value="Ja" checked> 
    </td>
    <td>
    Nein
    <input type="radio" name="frage1" value="Nein">
    </td>
    </table>  
    <h4>Wollen Sie die Features Berge 4.0, Basteln 4.0, Zweisamkeit 4.0, Freude 4.0 und Freunde 4.0 nutzen?</h4>
    <table class="radio">
    <td>
    Ja
    <input type="radio" name="frage2" value="Ja" > 
    </td>
    <td>
    Nein
    <input type="radio" name="frage2" value="Nein">
    </td>
    </table> 
    <h4>Gibt es eine weitere Userin der Version HFF 4.0?</h4>
    <table class="radio">
    <td>
    Ja
    <input type="radio" name="frage3" value="Ja"> 
    </td>
    <td>
    Nein
    <input type="radio" name="frage3" value="Nein">
    </td>
    </table>
    <h4>Sind sie in der Lage bei Bedarf kleinere Änderungen des Betriebsystems vorzunehmen?</h4>
    <table class="radio">
    <td>
    Ja
    <input type="radio" name="frage4" value="Ja"> 
    </td>
    <td>
    Nein
    <input type="radio" name="frage4" value="Nein">
    </td>
    </table>  
    <br><BR>
    <input type="submit" value="Überprüfen">
</form>
';

if ($_REQUEST['frage1']=="Ja") {
    
    if ($_REQUEST['frage2']=="Ja") {
        
        if ($_REQUEST['frage3']=="Ja") {
            
            if ($_REQUEST['frage4']=="Ja") {

                echo'<h2 class="d">Das Update war erfolgreich. Herzlichen Glückwunsch! Das System ist fit für die nächsten 40 Jahre ;)<h2>';

            }else{
                echo'<p class="echo">Leider falsch :(</p>';
            }
            
        }else{
            echo'<p class="echo">Leider falsch :(</p>';
        } 
        
    }else{
        echo'<p class="echo">Leider falsch :(</p>';
    } 
    
}else{
    echo'<p class="echo">Leider falsch :(</p>';
} 

?>
</div>
