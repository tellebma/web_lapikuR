const url = "http://localhost/api/";

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

// postSymptomes

/**
 * Forges an URL depending on the elements selected by the client
 */
function postSymptomes(){
    let tabElementsSelected = getElementsSelected(), stringHref = "";
    stringHref += "critsympt=";
    if (tabElementsSelected.length === 0){
        stringHref += "all-";
    }else{
        for (elem of tabElementsSelected){
            if (elem === tabElementsSelected.at(-1)){
                stringHref += elem.replace(/ /g,"_") + "-";
            }else{
                stringHref += elem.replace(/ /g,"_") + ".";
            }
        }
    }
    document.location = "/pathologieSymptomes/" + (stringHref).slice(0, -1);
}

/**
 * Adds all selected elements to an Array
 * @returns An Array with all selected elements gated behind a key corresponding to one select.
 */
function getElementsSelected(){
    let tabSelectedItems = [], select = document.getElementById("selectSympt");
    for (index of M.FormSelect.getInstance(select).getSelectedValues()){
        tabSelectedItems.push(select[index - 1].innerHTML);
    }
    return tabSelectedItems;
}