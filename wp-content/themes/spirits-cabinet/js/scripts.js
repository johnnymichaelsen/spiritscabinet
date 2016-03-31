/**
 * scripts.js
 *
 * Custom JavaScript managing the adding and removing of spirits from users
 *
 */

function addSpirit(id, user_id) {

    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();

    } else {

        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

    }
    
    xmlhttp.onreadystatechange = function() {
        
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            document.getElementById("textHint").innerHTML = "xmlhttp.responseText;";
        }
    };

    xmlhttp.open("POST","/add-spirit.php?id="+id+"&user_id="+user_id, true);
    xmlhttp.send();
     
};
