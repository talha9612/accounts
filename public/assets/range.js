// FOR RANGE CALCULATION
  function rangeCal() {

    var table, rows, fromdate, todate;
    table = document.getElementById("myTable");
    rows = table.rows;
    fromdate = document.getElementById("fromdate");
    todate = document.getElementById("todate");

    for (var i = 1; i < (rows.length); i++) {
      x = rows[i].getElementsByTagName("TD")[0];
       if(x !== undefined)
      {
      var compdate = Date.parse(x.innerHTML);
      }
      
      if(Date.parse(fromdate.value + ' 12:00 AM') <= compdate  && Date.parse(todate.value + ' 11:59 PM') >= compdate)
      {

      }
      else{
        rows[i].style.visibility = "hidden";
        // rows[i].remove();
       // document.getElementById("datatables1").deleteRow(i); 
      }
  }
   for (var j = 1; j < (rows.length - 1); j++) {
      if(rows[j].style.visibility === "hidden")
      {
       rows[j].hidden = true;
       }
       else{

       }
      }

  totaldebit();
  totalcredit(); 
 
    }

document.getElementById('myInput').onkeypress = function(e){
    if (!e) e = window.event;
    var keyCode = e.keyCode || e.which;
    if (keyCode == '13'){
      // Enter pressed
        totaldebit();
        totalcredit();

    }
  }

 function calcFunction() {
    totaldebit();
    totalcredit();

 }     

//  FOR TOTAL DEBIT AND CREDIT
 setTimeout(function()
 { 
 totaldebit();
 totalcredit();
   
 }, 1000);

 function totaldebit(){ 
  var debit = document.getElementsByName('debit[]');
  var totaldebit;
  var line = document.getElementsByClassName('line[]');
  var b = 0;
  var runningtotal = document.getElementById('totaldebit');
   for(var i=0;i<line.length;i++){

   if(line[i].style.visibility === "hidden" || line[i].style.display === "none")
   {
   
   }
   else{ 
    if(parseFloat(debit[i].value))
    {
    b += parseFloat(debit[i].value); 
    runningtotal.innerHTML = b.toFixed(2).toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    else{
    
      b += 0;
     runningtotal.innerHTML = b.toFixed(2).toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","); 
    }
  }

  }
}

function totalcredit(){ 
  var credit = document.getElementsByName('credit[]');
  var totalcredit;
  var line = document.getElementsByClassName('line[]');
  var c = 0;
  var runningtotal = document.getElementById('totalcredit');
   for(var i=0;i<line.length;i++){

    if(line[i].style.visibility === "hidden" || line[i].style.display === "none")
   {

   }
 else{
    if(parseFloat(credit[i].value))
    {
    c += parseFloat(credit[i].value); 
    runningtotal.innerHTML = c.toFixed(2).toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    else{

      c += 0;
      runningtotal.innerHTML = c.toFixed(2).toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
     
    }
  }

  }
}

// FOR BALANCE CALCULATION
document.onreadystatechange = () => {
  if (document.readyState === 'complete') {
    setTimeout(function()
 { 
  if(document.getElementById('counter').value === "")
  {
     findBalance();
  }
  else {
    findBalancecounter();
    }
 }, 1000);
  }
};

  function findBalance(){
    var spn = document.getElementsByClassName('balance');
    var arr = document.getElementsByName('balance[]');
    var debit = document.getElementsByName('debit[]');
    var credit = document.getElementsByName('credit[]');
    var tot = document.getElementById('openingbalance').value;
    for(var i=0;i<arr.length;i++){
      var b = 0;
      if(credit[i].value === '-')
      {
       tot = +parseFloat(tot)+ +parseFloat(debit[i].value);
       b = tot.toFixed(2);
       arr[i].value = b.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
       spn[i].innerHTML = arr[i].value;
      }
      else{
        
        tot = parseFloat(tot) - parseFloat(credit[i].value);
        b = tot.toFixed(2);
        arr[i].value = b.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        spn[i].innerHTML = arr[i].value;
      }
    }
}

function findBalancecounter(){
    var spn = document.getElementsByClassName('balance');
    var arr = document.getElementsByName('balance[]');
    var debit = document.getElementsByName('debit[]');
    var credit = document.getElementsByName('credit[]');
    var tot = document.getElementById('openingbalance').value;
    for(var i=0;i<arr.length;i++){
      var b = 0;
      if(debit[i].value === '-')
      {
       tot = +parseFloat(tot)+ +parseFloat(credit[i].value);
       b = tot.toFixed(2);
       arr[i].value = b.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
       spn[i].innerHTML = arr[i].value;
      }
      else{
        
        tot = parseFloat(tot) - parseFloat(debit[i].value);
        b = tot.toFixed(2);
        arr[i].value = b.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        spn[i].innerHTML = arr[i].value;
      }
    }
}