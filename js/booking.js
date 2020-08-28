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
}