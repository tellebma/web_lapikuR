function showData(id) {
    var my_disply = document.getElementById(id).style.display;
    if(my_disply == "block")
            document.getElementById(id).style.display = "none";
    else
            document.getElementById(id).style.display = "block";
}
