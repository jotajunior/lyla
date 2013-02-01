function GetXMLHttp() {

    if(navigator.appName == "Microsoft Internet Explorer") {

        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");

    }

    else {

        xmlHttp = new XMLHttpRequest();

    }

    return xmlHttp;

}


var xmlRequest = GetXMLHttp();