//  Nama        : Sausan Berliana Arrizqi
//  NIM         : 24060122130092
//  Tanggal     : 22 September 2024
//  Lab         : PBP B1 

function getXMLHTTPRequest() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
}

function callAjax(url,inner) {
    var xmlhttp = getXMLHTTPRequest();
    xmlhttp.open('GET', url, true);
    xmlhttp.onreadystatechange = function () {
        if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
            document.getElementById(inner).innerHTML = xmlhttp.responseText;
        }
        return false;
    }
    xmlhttp.send(null);
}

function showBook(judul) {
    var inner = "search_result";
    var url = "get_book.php?judul=" + judul;
    if (judul == "") {
        document.getElementById(inner).innerHTML = "";
    }
    else {
        callAjax(url, inner);
    }
}

const keyword = document.getElementById('keyword');
const searchResult = document.getElementById('search_result');

keyword.addEventListener('keyup', function(){
    showBook(keyword.value);
});