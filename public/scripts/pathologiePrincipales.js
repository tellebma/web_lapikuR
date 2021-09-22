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

// Filter. Really bad way to do it ? Maybe use my API to get the data I want to display.

/**
 * Everytime an event is generated (everytime the select list is used) gets all selected elements by the client, hides
 * all the elements of the display div, gets all elements that correspond to the selected elements by the client, then
 * shows those elements
 * 
 * @param {Event} event, Used to get the id of the element used, a select in this case.
 */
function filter(event){
        let tabSelectedItems = [], select = event.target, result = false;
        for (index of M.FormSelect.getInstance(document.getElementById(select.id)).getSelectedValues()){
                tabSelectedItems.push(select[index - 1].innerHTML);
        }

        voidDisplay();

        for (elem of getElementsToDisplay(tabSelectedItems)){
                elem.style.display = "";
                result = true;
        }

        if (!result){
                resetDisplay();
        }
}

/**
 * Gets all elements that should be displayed thanks to the items selected by the client
 * 
 * @param {Array} tabSelectedItems 
 * @returns An array of all the DOM elements that match the items selected by the client
 */
function getElementsToDisplay(tabSelectedItems){
        let tabElementsToDisplay = [];
        for (item of tabSelectedItems){
                for (elem of document.getElementsByClassName("collapsible-header")){
                        if (item === elem.lastChild.textContent){
                                tabElementsToDisplay.push(elem);
                        }
                }
        }
        return tabElementsToDisplay;
}

/**
 * Sets the display style on all DOM elements with the classname "collapsible-header" to 'None'
 */
function voidDisplay(){
        for (elem of document.getElementsByClassName("collapsible-header")){
                elem.style.display = "None";
        }
}

/**
 * Sets the display style on all DOM elements with the classname "collapsible-header" to ''
 */
function resetDisplay(){
        for (elem of document.getElementsByClassName("collapsible-header")){
                elem.style.display = "";
        }
}