function showData(id){
    var myDisplay = document.getElementById(id).style.display;
    if(myDisplay == "block")
            document.getElementById(id).style.display = "none";
    else
            document.getElementById(id).style.display = "block";
}

function searchPathology(){
        var filter = document.getElementById("name-pathologie").value.toUpperCase(), ul = document.getElementById("item-list"), li = ul.getElementsByTagName("li");
        for (let i=0;i<li.length; i+=3){
                let filters = filter.split(" "), shouldDisplay = true;
                filters = filters.filter(f => f.length);
                filters.forEach(filt => {
                        shouldDisplay = shouldDisplay && li[i].innerText.toUpperCase().includes(filt)
                });
                li[i].style.display = (shouldDisplay || filters.length === 0) ? "" : "none";
        }
}