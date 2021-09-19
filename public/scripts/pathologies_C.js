/*
    MaterializeCSS tweak to allow text filtering in multiple selects.
    It should be fairly easy to adapt it for use in single selects. :-)
*/

document.addEventListener('DOMContentLoaded', event => {
    document.querySelectorAll('select[searchable]').forEach(elem => {
        const select = elem.M_FormSelect;
        const options = select.dropdownOptions.querySelectorAll('li:not(.optgroup)');

        // Add search box to dropdown
        const placeholderText = select.el.getAttribute('searchable');
        const searchBox = document.createElement('div');
        searchBox.style.padding = '6px 16px 0 16px';
        searchBox.innerHTML = `
            <input type="text" placeholder="${placeholderText}">
            </input>`
        select.dropdownOptions.prepend(searchBox);
        
        // Function to filter dropdown options
        function filterOptions(event) {
            const searchText = event.target.value.toLowerCase();
            
            options.forEach(option => {
                const value = option.textContent.toLowerCase();
                const display = value.indexOf(searchText) === -1 ? 'none' : 'block';
                option.style.display = display;
            });

            select.dropdown.recalculateDimensions();
        }

        // Function to give keyboard focus to the search input field
        function focusSearchBox() {
            searchBox.firstElementChild.focus({
                preventScroll: true
            });
        }

        select.dropdown.options.autoFocus = false;

        if (window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
            select.input.addEventListener('click', focusSearchBox);
            options.forEach(option => {
                option.addEventListener('click', focusSearchBox);
            });
        }
        searchBox.addEventListener('keyup', filterOptions);
    });
});

// Filter

function filter(event){
    let select = event.target, tab = document.getElementsByClassName("collapsible-master")[0];

    switch(select.id){
        case 'crit-meridien':
            let selectedMeridien = select[select.value].innerHTML;
            console.log(getMeridienOfEachLi(tab));
            break;
        case 'crit-type-path':
            let selectedPathologie = select[select.value].innerHTML;
            console.log(getPathologieOfEachLi(tab));
            break;
        case 'crit-carac':
            let selectedKeyword = select[select.value].innerHTML;
            break;
        case 'symptomes':
            let indexOfSelectedSymptomes = M.FormSelect.getInstance(document.getElementById(select.id)).getSelectedValues(), selectedSymptomes = [];
            for (index of indexOfSelectedSymptomes){
                selectedSymptomes.push(select[index-1].innerHTML);
            }
            break;
        default:
            break;
    }
}

// Helpers for filter function (EN FAIT c'est ici qu'il faut que je check des trucs. Genre si dans mon elem, le texte du meridien != du selectedmeridien
// ALORS je vire l'élement en quesiton (instance.destroy() ?))

function getMeridienOfEachLi(ulElement){
    let tabMeridiens = [];
    for(elem of document.getElementsByClassName("master")){
        tabMeridiens.push(elem.lastChild.textContent.split('|')[1].slice(1));
    }
    return tabMeridiens;
}

function getPathologieOfEachLi(ulElement){
    let tabPathologies = [];
    for(elem of document.getElementsByClassName("master")){
        tabPathologies.push(elem.lastChild.textContent.split('|')[0].slice(0, -1));
    }
    return tabPathologies;
}