function loadDoc(url) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        myFunction(this);
      }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}

function myFunction(xml) {
    var i;
    var xmlDoc = xml.responseXML;
    console.log(xmlDoc)
    var html = "";
    var x = xmlDoc.getElementsByTagName("company");
    for (i = 0; i <x.length; i++) {

        var data = `
            <div class="company">
                <img src="images/${x[i].getElementsByTagName("image")[0].childNodes[0].nodeValue}" alt="">
                <h4>${x[i].getElementsByTagName("name")[0].childNodes[0].nodeValue}</h4>
            </div> 
        `;
        html+=data;
    }
    document.getElementById("companies").innerHTML = html;
}