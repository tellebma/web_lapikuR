$(document).ready(function() {
    $('select').material_select();
    });

function fillHeader(){
    document.getElementsByClassName("nav")[0].innerHTML = '<div class="nav-wrapper container"><a href="#" class="brand-logo">LaPikuR</a><ul id="nav-mobile" class="right hide-on-med-and-down"><li><a href="?p=index">Accueil</a></li><li><a href="?p=pathologies">Pathologies</a></li><li><a href="?p=criteres">Criteres</a></li></ul></div>';
}