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

// Submit button

function postCriterias(){
    let elementsSelected = getElementsSelected(), stringHref = "";
    for (tabCriteria in elementsSelected){
        stringHref += tabCriteria + "=";
        if (elementsSelected[tabCriteria].length === 0){
            stringHref += "all-";
        }else{
            for (elem of elementsSelected[tabCriteria]){
                if (elem === elementsSelected[tabCriteria].at(-1)){
                    stringHref += elem.replace(/ /g,"_") + "-";
                }else{
                    stringHref += elem.replace(/ /g,"_") + ".";
                }
            }
        }
        
    }
    location.href += "/" + (stringHref).slice(0, -1); // Faut que jme demerde pour avoir le bon url, plus le css marche pas ça commence a me peter les couilles
}

function getElementsSelected(){
    let tabElementsToDisplay = {};
    document.querySelectorAll("select").forEach(select => {
        let indexOfSelectedItems = M.FormSelect.getInstance(document.getElementById(select.id)).getSelectedValues(), selectedItems = [];
        for (index of indexOfSelectedItems){
            selectedItems.push(select[index-1].innerHTML);
        }        
        tabElementsToDisplay[select.id] = selectedItems;
    });
    return tabElementsToDisplay;
}