function filter(){
    var input, filter, table, tr, td, i, txtValue;
    input = document.querySelector(".searchbar");
    filter = input.value.toUpperCase();
    table = document.getElementById("products_T");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        tdi = tr[i].getElementsByTagName("td")[0];
        tdn = tr[i].getElementsByTagName("input")[0];
        if (tdn) {
            txtValue = tdn.value;
            txtId = tdi.textContent || tdi.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1||txtId==filter) {
                tr[i].style.display = "";
            }
            else {
                tr[i].style.display = "none";
            }
        }
    }
}