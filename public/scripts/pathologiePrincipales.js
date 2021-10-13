const url = "http://localhost/api/";

// JS Functions

/*
    MaterializeCSS tweak to allow text filtering in multiple selects.
    It should be fairly easy to adapt it for use in single selects. :-)
*/

function renderSearch(event){
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
}

/**
 * Capitalize the first letter of a word
 * 
 * @param {String} str 
 * @returns The string with it's first letter capitalized
 */
function capitalize(str) {
        const lower = str.toLowerCase();
        return str.charAt(0).toUpperCase() + lower.slice(1);
}
      
/**
 * Fetches all pathologies through the API and displays it in a list
 * @param {Event} event 
 */
function fetchPathologies(event){
        let listToPopulate = document.getElementsByClassName("collection")[0];
        fetch(url + "pathologie/all").then(function(res){
                return res.json().then(function(json){
                        json.forEach((elem, i) => {
                                let listElement = document.createElement("li");
                                listElement.className = "collection-item";
                                listElement.innerHTML = capitalize(elem.desc);
                                listToPopulate.appendChild(listElement);
                        });
                        renderSearch(event);
                });
        });
}

/**
 * Fetches all pathologies corresponding to a given name and displays results in a list and also populates a list with all pathologies
 */
function filterByPathologie(){
        let textInput = document.getElementById("pathologie").value;
        let listToPopulate = document.getElementsByClassName("collection")[0];
        listToPopulate.innerHTML = "";
        fetch(url + "pathologie/all").then(function(res){
                return res.json().then(function(json){
                        json.forEach((elem, i) => {
                                if (elem.desc.includes(textInput.toLowerCase())){
                                        let listElement = document.createElement("li");
                                        listElement.className = "collection-item";
                                        listElement.innerHTML = capitalize(elem.desc);
                                        listToPopulate.appendChild(listElement);
                                }
                        });
                });
        });
}

// Events

window.addEventListener("load", event => {
        fetchPathologies(event);
});