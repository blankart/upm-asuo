function searchValidation() {
    // Declare variables
    var input, filter, ul, li, a, i;
    input = document.getElementById('idInput');
    filter = input.value.toUpperCase();
    ul = document.getElementById("searchList");
    li = ul.getElementsByClassName('li');

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByClassName("view-message")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}