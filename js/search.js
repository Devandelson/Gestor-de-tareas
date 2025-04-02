// function for the filter
let search_input = document.getElementById("search_input");
search_input.addEventListener("input" , (e) => {
    let value = e.target.value;
    let table = document.getElementById("data");

    // -- now conditions
    for (let x = 0; x < table.children.length; x++){
        let arrow = table.children[x];
        if (value == ""){
            arrow.classList.remove("disable");

        } else {    
            if (arrow.children[1].innerHTML.trim().toLocaleLowerCase().startsWith(value.toLocaleLowerCase().trim())){
                arrow.classList.remove("disable");
            } else {
                arrow.classList.add("disable");
            }
        }
    }
});