<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
   public $primaryKey = 'SrNo';
   protected $fillable = ['Ref', 'QuotationNumber' , 'QMonth', 'QYear','REV','category','CustomerName','Attn','Designation','CustomerRFQ','Location','ContactNum','Email','QuotationSubject','IssueDate','ShippingTerms','DeliveryPeriod','PaymentTerms','Currency','ValidTill','PreparedBy','ApprovedBy','AdditionalComments','Description','Model','make','specs','Unit','qty','Unit Price','Total Price','Totalprice_exc','Sale_tax','Tax_amount','Grand_total'];
}
