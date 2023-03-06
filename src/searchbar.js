function filter(){
    var input, filter, table, tr, i;
    input = document.querySelector(".searchbar");
    filter = input.value.toUpperCase();
    table = document.getElementById("edit_table");
    if(table){
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            var tdi = tr[i].getElementsByTagName("td")[0];
            var tdn = tr[i].getElementsByTagName("input")[0];
            if (tdn) {
                var txtId = tdi.textContent || tdi.innerText;
                var txtName = tdn.value;
                if (txtName.toUpperCase().indexOf(filter) > -1||txtId==filter) {
                    tr[i].style.display = "";
                }
                else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    else{
        table = document.getElementById("read_table");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            var tdi = tr[i].getElementsByTagName("td")[0];
            var tdn = tr[i].getElementsByTagName("td")[1];
            if (tdn) {
                var txtId = tdi.textContent || tdi.innerText;
                var txtName = tdn.textContent || tdn.innerText;
                if (txtName.toUpperCase().indexOf(filter) > -1||txtId==filter) {
                    tr[i].style.display = "";
                }
                else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
}