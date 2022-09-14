var sErrIsEmpty = " es requerido.\n";
var sErrNoValid = " tiene caracteres invalidos .\n";
var sErrValidateText2 = " debe contener solamente numeros y letras .\n";
var sErrNoValidDate = " tiene un formato de fecha invalido .\n";
var sErrNoValidTime = " tiene un formato de hora invalido .\n";
var sErrEmpty = " no debe contener valor .\n";
var sErrNoNumber = " debe ser numerico .\n";
var sErrNoValidMail = " es una direccion de correo electronico invalida .\n";


function validateText(sText, sName, bAllowEmpty)
{
    var sErrorMsg = "";


    if (bAllowEmpty && sText === "") // If empty
    {
        sErrorMsg = "- " + sName + sErrIsEmpty;
    }
    else {
        var n = sText.length;
        for (var i = 0; i < n; i++) {
            var c = sText.charAt(i);
            if (c === ' ' || c === '\t' || c === '\n') {
                sErrorMsg = "- " + sName + sErrNoValid;
            } else
                break;
        }



    }

    return sErrorMsg;
}

function validateEmpty(sText, sName)
{
    var sErrorMsg = "";


    if (sText !== "") // If empty
    {
        sErrorMsg = "- " + sName + sErrEmpty;
    }

    return sErrorMsg;
}


function validateText2(sText, sName, bAllowEmpty)
{
    var sErrorMsg = "";

    if (bAllowEmpty && sText === "") // If empty
    {
        sErrorMsg = "- " + sName + sErrIsEmpty;
    }
    else if (sText !== "") // else if to short or to long string or nonvalid characters
    {
        sErrorMsg = validateText(sText, sName, bAllowEmpty);

        if (sErrorMsg === "")
        {
            for (var i = 0; i < sText.length; i++)
            {
                if (!(sText.charAt(i) <= "9" && sText.charAt(i) >= "0" ||
                        sText.charAt(i) <= "z" && sText.charAt(i) >= "a" ||
                        sText.charAt(i) <= "Z" && sText.charAt(i) >= "A"))
                {
                    sErrorMsg += "- " + sName + sErrValidateText2;
                    break;
                }
            }
        }
    }

    return sErrorMsg;
}

function validateDate(sText, sName, bAllowEmpty) {

    var date = sText.split("-");
    var nyear = parseFloat(date[0]);
    var nmonth = parseFloat(date[1]);
    var nday = parseFloat(date[2]);

    var sErrorMsg = "";

    //alert(nday+","+nmonth+","+nyear);

    if (!isNaN(nmonth) && !isNaN(nyear) && !isNaN(nday)) {

        // alert(nday+","+nmonth+","+nyear);
        //el mes debe estar entre 1 y 12
        if (nmonth < 1 || nmonth > 12) {
            sErrorMsg += "- " + sName + sErrNoValidDate;

        }
        //comprueba que el a�o este entre 1900 y 2099
        if (nyear < 1900 || nyear > 2099) {
            sErrorMsg += "- " + sName + sErrNoValidDate;
        }
        //comprueba el numero de dias dependiendo del mes
        if (nmonth === 1 || nmonth === 3 || nmonth === 5 || nmonth === 7 || nmonth === 8 || nmonth === 10 || nmonth === 12) {
            if (nday <= 0 || nday > 31) {
                sErrorMsg += "- " + sName + sErrNoValidDate;
            }
        }
        if (nmonth === 4 || nmonth === 6 || nmonth === 9 || nmonth === 11) {
            if (nday <= 0 || nday > 30) {
                sErrorMsg += "- " + sName + sErrNoValidDate;
            }
        }
        if (nmonth === 2) {
            if (nyear % 4 > 0) {
                if (nday > 28) {
                    sErrorMsg += "- " + sName + sErrNoValidDate;
                }
            } else {
                if (nday > 29) {
                    sErrorMsg += "- " + sName + sErrNoValidDate;
                }
            }
        }
    }

    else {
        if (sText.length === 0) {
            if (bAllowEmpty)
                sErrorMsg += "- " + sName + sErrIsEmpty;
        }
        else {
            sErrorMsg += "- " + sName + sErrNoValidDate;
        }
    }
    return sErrorMsg;
}


function validateTime(sText, sName, bAllowEmpty) {

    var hora = sText.split(":");
    var h = parseFloat(hora[0]);
    var m = parseFloat(hora[1]);

    var sErrorMsg = "";

    if (!isNaN(h) && !isNaN(m)) {
        if (h < 0 || h > 23) {
            sErrorMsg += "- " + sName + sErrNoValidTime;
        }
        if (m < 0 || m > 60) {
            sErrorMsg += "- " + sName + sErrNoValidTime;
        }
    }
    else {
        if (sText.length === 0) {
            if (bAllowEmpty)
                sErrorMsg += "- " + sName + sErrIsEmpty;
        }
        else {
            sErrorMsg += "- " + sName + sErrNoValidDate;
        }
    }

    return sErrorMsg;

}

function validateNumber(sText, sName, bAllowEmpty) {

    var sErrorMsg = "";
    var number = new Number(sText);

    if (sText.length === 0) {
        if (bAllowEmpty) {
            sErrorMsg += "- " + sName + sErrIsEmpty;
        }
    } else if (isNaN(number)) {
        sErrorMsg += "- " + sName + sErrNoNumber;
    }

    return sErrorMsg;

}
function validateInt(sText, sName, bAllowEmpty) {

    var sErrorMsg = "";
    var number = parseInt(sText);

    if (sText.length === 0) {
        if (bAllowEmpty) {
            sErrorMsg += "- " + sName + sErrIsEmpty;
        }
    } else if (isNaN(number)) {
        sErrorMsg += "- " + sName + sErrNoNumber;
    }

    return sErrorMsg;

}

function validateEmail(sText, sName, bAllowEmpty) {

    var sErrorMsg = "";
    //var s =  "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";	

    if (sText.length === 0) {
        if (bAllowEmpty)
            sErrorMsg += "- " + sName + sErrIsEmpty;

    } else {
        if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(sText)))
            sErrorMsg += "- " + sName + sErrNoValidMail;
    }

    return sErrorMsg;

}

function execute(command) {
    document.form1.cmd.value = command;
}


function confirmar(msg) {

    if (msg === null)
        msg = "Esta seguro de eliminar este registro ..";

    if (confirm(msg)) {
        return true;
    }
    else {
        return false;
    }

}

function open_window(url, name, toolbar, statusbar, width, height, aligment, scroll) {

    var win;
    var posx;
    var posy;
    var window_features;

    if (aligment === 'center') {
        posx = (screen.availWidth - width) / 2;
        posy = (screen.availHeight - height) / 2;
    }
    else {
        if (aligment === 'left') {
            posx = 0;
            posy = 0;
        }
        else {
            posx = (screen.width - width - 10);
            posy = 0;
        }

    }

    window_features = 'status=' + statusbar + ',toolbar=' + toolbar + ',top=' + posy + ',left=' + posx + ',width=' + width + ',height=' + height + ',scrollbars=' + scroll + ',location=no';

    win = window.open(url, name, window_features);

    win.focus();

}

function medida(d) {

    var sep = "/";
    var patron = new Array(2, 2);

    if (d.valant !== d.value) {
        val = d.value;
        largo = val.length;
        val = val.split(sep);
        val2 = '';

        for (r = 0; r < val.length; r++) {
            val2 += val[r];
        }

        for (z = 0; z < val2.length; z++) {
            if (isNaN(val2.charAt(z))) {
                letra = new RegExp(val2.charAt(z), "g");
                val2 = val2.replace(letra, "");
            }
        }


        val = '';
        val3 = new Array();
        for (s = 0; s < patron.length; s++) {
            val3[s] = val2.substring(0, patron[s]);
            val2 = val2.substr(patron[s]);
        }
        for (q = 0; q < val3.length; q++) {
            if (q === 0) {
                val = val3[q];
            }
            else {
                if (val3[q] !== "") {
                    val += sep + val3[q];
                }
            }
        }
        d.value = val;
        d.valant = val;
    }
}

function submitbutton(cmd) {
    document.form1.cmd.value = cmd;
    document.form1.submit();
}

function getItemCheked() {

    var radios = document.getElementsByName("item");
    var valor = -1;

    for (var x = 0; x < radios.length; x++) {
        if (radios[x].checked) {
            valor = radios[x].value;
            break;
        }
    }

    return valor;
}
	