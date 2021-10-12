/*
    MaterializeCSS tweak to allow text filtering in multiple selects.
    It should be fairly easy to adapt it for use in single selects. :-)
*/

const url = "http://localhost/api/"

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

// JS Functions

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
 */
function fetchPathologies(){
        let listToPopulate = document.getElementsByClassName("collection")[0];
        let selectToPopulate = document.getElementById("selectPatho");
        fetch(url + "pathologie/all").then(function(res){
                return res.json().then(function(json){
                        json.forEach((elem, i) => {
                                let listElement = document.createElement("li"), optionElement = document.createElement("option");
                                listElement.className = "collection-item";
                                listElement.innerHTML = capitalize(elem.desc);
                                optionElement.value = i+1;
                                optionElement.innerHTML = capitalize(elem.desc);
                                listToPopulate.appendChild(listElement);
                                selectToPopulate.appendChild(optionElement);
                        })
                });
        });
}

/**
 * Fetches all pathologies corresponding to a given name and displays results in a list and also populates a list with all pathologies
 */
function filterPathologies(){      
        let listToPopulate = document.getElementsByClassName("collection")[0];
        listToPopulate.innerHTML = "";
        let id  = document.getElementById("selectPatho").value;
        if (id == 0){
                fetchPathologies();
        }else{
                fetch(url + "pathologie/" + id).then(function(res){
                        return res.json().then(function(json){
                                console.log(json);
                                json.forEach((elem, i) => {
                                        let listElement = document.createElement("li");
                                        listElement.className = "collection-item";
                                        listElement.innerHTML = capitalize(elem.desc);
                                        listToPopulate.appendChild(listElement);
                                })
                        });
                });
        }
}