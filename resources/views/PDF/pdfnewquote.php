<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php foreach ($records as $details):?>
<title>Quotation <?php echo $details->QuotationNumber; ?></title>
<style>
@include('PDF.style')
</style>
<style>
#p2 { font-family: Helvetica, Arial, sans-serif; font-size: 12px }
</style>
<style>
#p3 { font-family: Helvetica, Arial, sans-serif; font-size: 13px }
</style>
<style>
#customers {
font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
border-collapse: collapse;
width: 100%;
}
#customers td, #customers th {
border: 1px solid black;
padding: 0px;
}
#customers tr:nth-child(even){background-color: #f2f2f2;}
#customers tr:hover {background-color: #ddd;}
#customers th {
padding-top: 10px;
padding-bottom: 10px;
text-align: center;
background-color: #6e6e6e;
color: white;
}
#header {
  display: table-header-group;
}

#main {
  display: table-row-group;
}

#footer {
  display: table-footer-group;
}
</style>
</head>
<body>
<div style="width: 732px">
<div>
<img src="../public/images/star.png" style="background-color: white;margin-top: 2px" width="25%" height="25%">
<div style="float: right;margin-right:1px; margin-top: 12px" id=p2>157-F, Johar Town. Lahore Pakistan <br>Tel: +92-42-35175265/6<br> Email: sales@starautomation.net<br>NTN: 2726171-9<br>GST: 03-04-8400-154-73</div>

</div>
<hr>
<?php $newDate1 = date("d-M-Y", strtotime($details->IssueDate)); ?>
<div id=p2>Issue Date: <?php echo $newDate1; ?>
<span style="margin-left: 377px">Ref No: <?php echo $details->Ref; ?>-<?php echo $details->QuotationNumber; ?></span><span style="margin-left: 10px">Rev- <?php echo $details->REV; ?></span> </div>
<?php $newDate = date("d-M-Y", strtotime($details->ValidTill)); ?>
<div id=p2>Valid Till: <?php echo $newDate; ?> <span style="margin-left: 386px">Customer RFQ No: <?php echo $details->CustomerRFQ; ?></span></div>
<div id=p2 style= "margin-left: 510px"><b>Currency: <?php echo $details->Currency; ?></b></div>
<div id=p2><b>To: <?php echo $details->CustomerName; ?></b></div>
<div id=p2 style= "margin-left: 22px"><?php echo $details->Location; ?></div>
<div id=p2><b>Attn: <?php echo $details->Attn; ?> <span style="margin-left: 1px"> | <?php echo $details->Designation; ?></span></b></div>
<div id=p2><b>Subject: <?php echo $details->QuotationSubject; ?></b></div>
<br>
<?php endforeach; ?> 
<table id="customers" autosize="1">
<thead id="head">
<tr>
<th style="font-size: 13px;" width="150px" align="center">Description</th>
<th style="font-size: 13px;" width="100px" align="center">Model</th>  
<th style="font-size: 13px;" width="100px" align="center">Make</th>  
<th style="font-size: 13px;" width="100px" align="center">Specs</th>  
<th style="font-size: 13px;" width="35px" align="center">Unit</th>   
<th style="font-size: 13px;" width="35px" align="center">Quantity</th>                   
<th style="font-size: 13px;" width="70px" align="center">Unit Price</th>                         
<th style="font-size: 13px;" width="80px" align="center">Total</th>   
</tr>
</thead>
<tbody id="main">
<?php foreach ($items as $pass):?>
<tr>
<td style="font-size: 13px;"align="center"><?php echo nl2br($pass->Description); ?></td>
<td style="font-size: 13px;"align="center"><?php echo $pass->Model; ?></td>
<td style="font-size: 13px;"align="center"><?php echo $pass->make; ?></td>
<td style="font-size: 13px;"align="center"><?php echo $pass->specs; ?></td>
<td style="font-size: 13px;"align="center"><?php echo $pass->Unit; ?></td>
<td style="font-size: 13px;"align="center"><?php echo $pass->qty; ?></td>
<td style="font-size: 13px;"align="center"><?php $subtotal = number_format($pass->UnitPrice, 2, '.', ',');echo $subtotal; ?></td>
<td style="font-size: 13px;"align="center"><?php $subtotal = number_format($pass->TotalPrice, 2, '.', ',');echo $subtotal;?></td>
</tr>
</tbody>
<?php endforeach; ?>
<tfoot id="head"></tfoot>
</table>
<br>
<div id=p3 style= "margin-left: 505px">Total Price Excl. GST:<span style="margin-left: 6px"><?php $subtotal =  number_format($details->Totalprice_exc, 2, '.', ',');
                    echo $subtotal; ?></span></div>
<div id=p3 style= " margin-left: 505px">Sales Tax @ <?php echo $details->Sale_tax; ?> %:<span style="margin-left: 24px" ><?php $subtotal =  number_format($details->Tax_amount, 2, '.', ',');
                    echo $subtotal; ?></span></div>
<div id=p3><b style= "margin-left: 505px">Total Price Incl. GST:<span style="margin-left: 1px" >
  <?php $subtotal =  number_format($details->Grand_total, 2, '.', ',');
                    echo $subtotal; ?></span></b></div>
<div id=p3><u>Terms and Conditions:</u></div>
<div id=p2>Shipping Terms: <?php echo $details->ShippingTerms; ?> </div>
<div id=p2>Payment Terms: <?php echo $details->PaymentTerms; ?> </div>
<div id=p2>Delivery Period:<span>  </span> <?php echo $details->DeliveryPeriod; ?> </div><br>
<div id=p3><u>Note:</u> <br> <span><?php echo nl2br($details->AdditionalComments); ?></span></div>
<br>
<a id=p2>For any further information, please feel free to contact us. Assuring you our best service and looking forward to your valuable order.</a>
</div>
<div style="position: fixed;bottom:65"> 
<div id=p3 style=" margin-left: 70px">Prepared By<span style="margin-left: 400px">Approved By</span></div>
<div id=p3 style=" margin-left: 35px"><i><?php echo $details->PreparedBy; ?><span style="margin-left: 280px"><?php echo $details->ApprovedBy; ?></span></i></div>    
<br>
</div>
<div style="position: fixed;bottom:40">
<hr>
<div align="center">
<a id=p2>Thank You For Contacting Us<br><i>www.starautomation.net</i></a>
</div>     
</div>
</body>
</html>