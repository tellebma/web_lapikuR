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
 * Adds all selected elements to an Array
 * @returns An Array with all selected elements gated behind a key corresponding to one select.
 */
 function getElementsSelected(){
    let tabSelectedItems = [], select = document.getElementById("selectSympt");
    for (index of M.FormSelect.getInstance(select).getSelectedValues()){
        tabSelectedItems.push(select[index - 1].value);
    }
    return tabSelectedItems;
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
 * Fetches all symptomes and pathologies and displays it in a collapsible
 */
function fetchSymptomesByPathologies(){
    let collapsibleToPopulate = document.getElementsByClassName("collapsible")[0];
    fetch(url + "pathologie/all/symptomes").then(function(res){
            return res.json().then(function(json){
                    json.forEach(elem => {
                        let listHeader = document.createElement("li"), divHeader = document.createElement("div"), divBody = document.createElement("div"), ulBody = document.createElement("ul");
                        divHeader.className = "collapsible-header";
                        divHeader.innerHTML = '<i class="material-icons">transfer_within_a_station</i>' + capitalize(elem.desc);                   
                        divBody.className = "collapsible-body";
                        elem.symptomes.forEach((elemBis, i) =>{
                            let listElement = document.createElement("li");
                            listElement.innerHTML = elemBis.desc;
                            ulBody.appendChild(listElement);
                        });
                        divBody.appendChild(ulBody);
                        listHeader.appendChild(divHeader);
                        listHeader.appendChild(divBody);
                        collapsibleToPopulate.appendChild(listHeader);
                    });
                    $('.collapsible').collapsible();
            });
    });
}

/**
 * Fetches all symptomes and populates a select
 * @param {Event} event 
 */

function fetchSymptomes(event){
    let selectToPopulate = document.getElementById("selectSympt");
    fetch(url + "symptome/all").then(function(res){
            return res.json().then(function(json){
                    json.forEach((elem, i) => {
                        let optionElement = document.createElement("option");
                        optionElement.value = i+1;
                        optionElement.innerHTML = capitalize(elem.desc);
                        selectToPopulate.appendChild(optionElement);
                    });
                    $('select').formSelect();
                    renderSearch(event);
            });
    });
}

/**
 * Filters according to selected symptomes. Will display any pathologie that has at least one symptom matching
 */
function filterBySymptomes(){
    let collapsibleToPopulate = document.getElementsByClassName("collapsible")[0], arrayIdOfSelectedElements = getElementsSelected(), display;
    console.log(arrayIdOfSelectedElements);
    if (arrayIdOfSelectedElements.length != 0){
        collapsibleToPopulate.innerHTML = "";
        arrayIdOfSelectedElements.forEach(id => {
            fetch(url + "pathologie/all/symptomes").then(function(res){
                return res.json().then(function(json){
                        json.forEach(elem => {
                            display = false
                            elem.symptomes.forEach(elemBis => {
                                if (elemBis.idS == id){
                                    display = true;
                                }
                            });
                            if (display){
                                let listHeader = document.createElement("li"), divHeader = document.createElement("div"), divBody = document.createElement("div"), ulBody = document.createElement("ul");
                                divHeader.className = "collapsible-header";
                                divHeader.innerHTML = '<i class="material-icons">transfer_within_a_station</i>' + capitalize(elem.desc);                   
                                divBody.className = "collapsible-body";
                                elem.symptomes.forEach((elemBis) =>{
                                    let listElement = document.createElement("li");
                                    listElement.innerHTML = elemBis.desc;
                                    ulBody.appendChild(listElement);
                                });
                                divBody.appendChild(ulBody);
                                listHeader.appendChild(divHeader);
                                listHeader.appendChild(divBody);
                                collapsibleToPopulate.appendChild(listHeader);
                            }
                        });
                        $('.collapsible').collapsible();
                });
            });
        });
    }else{
        fetchSymptomesByPathologies();
    }
}

// Events

window.addEventListener("load", event => {
    fetchSymptomesByPathologies();
    fetchSymptomes(event);
});