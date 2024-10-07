 // $(document).ready(function() {
 //        $('#datatables1').DataTable({
 //          "pagingType": "full_numbers",
 //          "lengthMenu": [
 //            [10, 25, 50, -1],
 //            [10, 25, 50, "All"]
 //          ],
          
 //          responsive: true,
 //          language: {
 //            search: "_INPUT_",
 //            searchPlaceholder: "Search records",
 //          },
 //           "paging": false
            
 //        });
 //        var table = $('#datatable1').DataTable();
 //        table.on('click', '.edit', function() {
 //          $tr = $(this).closest('tr');
 //          var data = table.row($tr).data();
 //          alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
 //        });
 //        table.on('click', '.remove', function(e) {
 //          $tr = $(this).closest('tr');
 //          table.row($tr).remove().draw();
 //          e.preventDefault();
 //        });
 //        table.on('click', '.like', function() {
 //          alert('You clicked on Like button');
 //        });
 //    });


 // setInterval(function()
 // {
 //     sortTable();
 // }, 1000);

// function sortTable() {
// // FOR TABLE SORTING
//   var table, rows, switching, i, x, y, shouldSwitch;
//   table = document.getElementById("datatables1");
//   switching = true;
//   /*Make a loop that will continue until
//   no switching has been done:*/
//   while (switching) {
//     //start by saying: no switching is done:
//     switching = false;
//     rows = table.rows;
//     /*Loop through all table rows (except the
//     first, which contains table headers):*/
//     for (i = 1; i < (rows.length - 1); i++) {
//       //start by saying there should be no switching:
//       shouldSwitch = false;
//       /*Get the two elements you want to compare,
//       one from current row and one from the next:*/
//       x = rows[i].getElementsByTagName("TD")[0];
//       y = rows[i + 1].getElementsByTagName("TD")[0];
//       //check if the two rows should switch place:
//       var firstDate = Date.parse(x.innerHTML);
//       if(y !== undefined)
//       {
//       var secondDate = Date.parse(y.innerHTML);
//       }
//       else{

//       }
//       if (firstDate > secondDate) {
//         //if so, mark as a switch and break the loop:
//         shouldSwitch = true;
//         break;
//       }
//     }
//     if (shouldSwitch) {
//       /*If a switch has been marked, make the switch
//       and mark that a switch has been done:*/
//       rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
//       switching = true;
//     }
//   }
// }

$(document).ready(function(){

  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

const getCellValue = (tr, idx) => Date.parse(tr.children[idx].innerText) || Date.parse(tr.children[idx].textContent);

const comparer = (idx, asc) => (a, b) => ((v1, v2) => 
    v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
    )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

// do the work...
document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
    const table = th.closest('table');
    Array.from(table.querySelectorAll('tr:nth-child(n)'))
        .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
        .forEach(tr => table.appendChild(tr) );
})));

jQuery(function(){
   jQuery('#spn').click();
});
