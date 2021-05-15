function add_designation()
    {
    var a=document.getElementById(1).value;    
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("test").innerHTML = this.responseText;
    //window.alert(""+this.responseText);
    }
    };
    xmlhttp.open("POST", "js_queries.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("desig=" + a);
    }

function remove_employee(a)
    {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("rm_test").innerHTML = this.responseText;
    //window.alert(""+this.responseText);
    }
    };
    xmlhttp.open("POST", "js_queries.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("delete=" + a);
    }

function onlyNumberKey(evt)
    {
        // Only ASCII charactar in that range allowed 
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
            return false; 
        return true; 
    }