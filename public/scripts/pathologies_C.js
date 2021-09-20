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

function filter(){
    let tabElementsToDisplay = {}, result = false;
    document.querySelectorAll("select").forEach(select => {
        let indexOfSelectedItems = M.FormSelect.getInstance(document.getElementById(select.id)).getSelectedValues(), selectedItems = [];
        for (index of indexOfSelectedItems){
            selectedItems.push(select[index-1].innerHTML);
        }        
        tabElementsToDisplay[select.id] = getElementsToDisplay(selectedItems, select.id);
    });

    voidDisplay();

    for (stuff in tabElementsToDisplay){
        for (elem of tabElementsToDisplay[stuff]){
            elem.style.display = "";
            result = true;
        }
    }

    if (!result){
        resetDisplay();
    }
}

// Check functions for filter

function displayElems(selectedElements, criteria){
    for (elemToDisplay of getElementsToDisplay(selectedElements, criteria)){
        elemToDisplay.style.display = "";
    }
}

function checkKeywordOfEachLi(selectedKeyword){
    for(elem of document.getElementsByClassName("master")){
        if (elem.style.display === ""){
            let found = false;
            for (elemBis of elem.nextSibling.nextSibling.getElementsByClassName("slave")){
                for (elemThird of elemBis.nextSibling.parentElement.getElementsByTagName("li")){
                    if (selectedKeyword === elemThird.innerHTML){
                        found = true;
                    }else if (selectedKeyword !== elemThird.innerHTML && !found){
                        found = false;
                    }
                }
                if (!found){
                    elem.style.display = "None";
                }else{
                    elem.style.display = "";
                }
            }
        }
    }
}

// Helpers for filter

function getElementsToDisplay(tabElements, criteria){
    let tabElementsToDisplay = [];

    for (element of tabElements){
        for(elem of document.getElementsByClassName("master")){
            if (criteria === "crit-meridien"){
                if (element === elem.lastChild.textContent.split('|')[1].slice(1)){
                    tabElementsToDisplay.push(elem);
                }
            }else if (criteria === "crit-type-path"){
                if (element === elem.lastChild.textContent.split('|')[0].slice(0, -1)){
                    tabElementsToDisplay.push(elem);
                }
            }
        }
    }
    return tabElementsToDisplay;
}

function getElementsDisplayed(){
    tabElementsDisplayed = [];
    for(elem of document.getElementsByClassName("master")){
        if (elem.style.display === ""){
            tabElementsDisplayed.push(elem);
        }
    }
    return tabElementsDisplayed;
}

function resetDisplay(){
    for(elem of document.getElementsByClassName("master")){
        elem.style.display = "";
    }
}

function voidDisplay(){
    for(elem of document.getElementsByClassName("master")){
        elem.style.display = "None";
    }
}