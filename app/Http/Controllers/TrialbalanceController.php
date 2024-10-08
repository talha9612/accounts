<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
class TrialbalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request)
        {
             
            $fnl = \DB::table('fnlyear')->first();
            $result = sscanf($fnl->fn_name, '%d-%d');
            // dd($result[1]);
            $from = $result[0];
            $to = $result[1];
            $startMonth = 7; // Replace with the starting month
            $endMonth = 6; // Replace with the ending month
            $startDate = "$from-$startMonth-01";
            $endDate = "$to-$endMonth-30";
            // Get the current date
           $currentDate = \Carbon\Carbon::now();

           // Clone the current date to avoid modifying the original object
           $workingDate = $currentDate->copy();
           
           // Check if the current month is before July (the start of the accounting year)
           if ($currentDate->month < 7) {
               // If before July, the accounting year started in the previous calendar year
               $previousYear = $workingDate->subYear()->year;
               $currentYear = $currentDate->year;
           } else {
               // If July or later, the accounting year started in the current calendar year
               $previousYear = $currentDate->year;
               $currentYear = $workingDate->addYear()->year;
           }
           
           $accountingYearRange = $previousYear . '-' . $currentYear;
            if($fnl->fn_name == $accountingYearRange) 
            {
            $cashinhands = \DB::select('SELECT * FROM cashinhands');
            // dd($cashinhands);
            foreach($cashinhands as $item){
                $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
                $voucher =  \DB::select('SELECT * from cashtransactions WHERE cih_title = ? AND fyear = ?', [$item->cih_title, $fnl->fn_name]);
                foreach ($voucher as $cashtransactions){
                    $totalcredit += $cashtransactions->ct_amount;
                }
                $rvoucher = \DB::select('SELECT * from cashreceipts WHERE cih_title = ? AND fyear = ?', [$item->cih_title, $fnl->fn_name]);
                foreach ($rvoucher as $rcashtransactions){
                    $totaldebit += $rcashtransactions->cr_amount;
                }
                $balances = \DB::select('SELECT * FROM cashinhands S JOIN obalances S2 ON S.cih_title = S2.sub_name WHERE S.cih_title = ? AND S2.ob_fyear = ?', [$item->cih_title, $fnl->fn_name]);
                // dd($balances);
                foreach ($balances as $orbalance){
                    $remaining =  $totaldebit - $totalcredit;
                    if($balances ==null){
                         $remaining = 0 + $remaining;
                         $orbalance = new \stdClass();
                         $orbalance->cih_title ='';
                         $orbalance->ob_amount = 0;
                         $orbalance->acc_balance=0;
                         $orbalance->cih_balance=0;
                    }else{
                        $remaining = $orbalance->ob_amount + $remaining;
                    }
                    array_push($ab_opening_blance,$orbalance->ob_amount);
                }
                $item->cih_balance = $remaining;
                $item->cih_obalance = array_sum($ab_opening_blance);
                // dd($ab_opening_blance);
            }
            
            $accountsbks = \DB::select('SELECT * FROM accountsbks');
            foreach($accountsbks as $item){
                $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
                $ab_voucher =  \DB::select('SELECT * FROM banktransactions WHERE acc_number = ? AND fyear = ?', [$item->acc_number, $fnl->fn_name]);
                // dd($voucher);
                foreach ($ab_voucher as $cashtransactions){
                    $totalcredit += $cashtransactions->bt_amount;
                }
                $rvoucher = \DB::select('SELECT * FROM bankreceipts WHERE acc_number = ? AND fyear = ?', [$item->acc_number, $fnl->fn_name]);
                // dd($rvoucher);
                foreach ($rvoucher as $rcashtransactions){
                    $totaldebit += $rcashtransactions->br_amount;
                }
        
                $balances = \DB::select('SELECT * FROM accountsbks S JOIN obalances S2 ON S.acc_number = S2.sub_ID WHERE S.acc_number = ? AND S2.ob_fyear = ?', [$item->acc_number, $fnl->fn_name]);
                // dd($balances);
                foreach ($balances as $orbalance){
                    $remaining =  $totaldebit - $totalcredit;
                    if($balances ==null){
                        $remaining = 0 + $remaining;
                        $orbalance = new \stdClass();
                        $orbalance->acc_title ='';
                        $orbalance->ob_amount = 0;
                        $orbalance->acc_balance=0;
                    }else{
                        $remaining = $orbalance->ob_amount + $remaining;
                    }
                    array_push($ab_opening_blance,$orbalance->ob_amount);
                }
                $item->acc_balance = $remaining;
                $item->acc_opbalance = array_sum($ab_opening_blance);
                // dd($ab_opening_blance);
            }
            
            $heads = \DB::select("SELECT * FROM heads ");
         
            foreach($heads as $item){
                // dd($item);
                if($item->h_type == 'Asset'){
                     $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
                    $voucher =  \DB::select('SELECT * FROM cashtransactions WHERE ct_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    $rvoucher = \DB::select('SELECT * from cashreceipts WHERE cr_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    $bankvoucher = \DB::select('SELECT * FROM banktransactions WHERE ex_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    $bankrvoucher = \DB::select('SELECT * FROM bankreceipts WHERE br_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    $journalvoucher = \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    // For Find Debit Vaules
                    foreach ($voucher as $cashtransactions){
                        $totaldebit += $cashtransactions->ct_amount;
                    }
                    foreach ($bankvoucher as $banktransactions){
                        $totaldebit += $banktransactions->bt_amount;
                    }
                    foreach ($journalvoucher as $journalvouchers){
                        if($journalvouchers->jv_acc_status == 'Debit'){
                            $totaldebit += $journalvouchers->jv_amount;
                        }else if($journalvouchers->jv_acc_status == 'Credit'){
                            $totalcredit += $journalvouchers->jv_amount;
                        }
                    }
                    // End Here Debit Code
                    // For Find Credit Vaules
                    foreach ($rvoucher as $rcashtransactions){
                        $totalcredit += $rcashtransactions->cr_amount;
                    }
                    foreach ($bankrvoucher as $rbanktransactions){
                        $totalcredit += $rbanktransactions->br_amount;
                    }
                    // End Here Credit Code
                    $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
                    // dd($assetbalances);
                    $remaining = 0;
                    foreach($assetbalances as $orbalance) {
                        if($assetbalances == null){
                            $remaining = 0 + $remaining;
                                $orbalance = new \stdClass();
                                $orbalance->h_name ='';
                                $orbalance->h_opbalance = 0;
                                $orbalance->h_balance=0;
                                $orbalance->ob_amount=0;
                        }else{
                            $remaining = $orbalance->ob_amount + $totaldebit;
                            array_push($ab_opening_blance,$orbalance->ob_amount);
                        }
                    }
                    $remaining =  $remaining - $totalcredit;
                    $item->h_balance = $remaining;
                    $item->h_opbalance = array_sum($ab_opening_blance);
                }else if($item->h_type == 'Liability'){
                        $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
                        $voucher =  \DB::select('SELECT * FROM cashtransactions WHERE ct_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                        $rvoucher = \DB::select('SELECT * FROM cashreceipts WHERE cr_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                        $bankvoucher =  \DB::select('SELECT * FROM banktransactions WHERE ex_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                        $bankrvoucher = \DB::select('SELECT * FROM bankreceipts WHERE br_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                        $journalvoucher = \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                        // dd($journalvoucher);
                        foreach ($voucher as $cashtransactions){
                            $totaldebit += $cashtransactions->ct_amount;
                        }
                        foreach ($rvoucher as $rcashtransactions){
                            $totalcredit += $rcashtransactions->cr_amount;
                        }
                        foreach ($bankvoucher as $banktransactions){
                            $totaldebit += $banktransactions->bt_amount;
                        }
                        foreach ($bankrvoucher as $rbanktransactions){
                            $totalcredit += $rbanktransactions->br_amount;
                        }
                        foreach ($journalvoucher as $journalvouchers){
                            if($journalvouchers->jv_acc_status == 'Debit'){
                                $totaldebit += $journalvouchers->jv_amount;
                            }else if($journalvouchers->jv_acc_status == 'Credit') {
                                $totalcredit += $journalvouchers->jv_amount;
                            }
                        }
                        // $assetbalances = \DB::select('SELECT * FROM heads WHERE h_name = ?', [$id]);
                        $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
                        // dd($totalcredit);
                        $remaining = 0;
                        foreach ($assetbalances as $orbalance){
                
                            if($assetbalances ==null){
                                $remaining = 0 + $remaining;
                                $orbalance = new \stdClass();
                                $orbalance->h_name ='';
                                $orbalance->ob_amount = 0;
                                $orbalance->h_opbalance=0;
                                $orbalance->h_balance=0;
                            }else{
                                $remaining = $orbalance->ob_amount + $totalcredit;
                            }
                            array_push($ab_opening_blance,$orbalance->ob_amount);
                        }
                        // dd($totaldebit);
                        $remaining =  $remaining - $totaldebit;
                
                        $item->h_balance = $remaining;
                        $item->h_opbalance = array_sum($ab_opening_blance);
                }
                else if($item->h_type == 'Expense'){
                    $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
                    $voucher = \DB::select('SELECT * FROM cashtransactions WHERE ct_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    foreach ($voucher as $cashtransactions){
                        $totaldebit += $cashtransactions->ct_amount;
                    }
                    $rvoucher = \DB::select('SELECT * FROM cashreceipts WHERE cr_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    foreach ($rvoucher as $rcashtransactions){
                        $totalcredit += $rcashtransactions->cr_amount;
                    }
                    $bankvoucher = \DB::select('SELECT * FROM banktransactions WHERE ex_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    foreach ($bankvoucher as $banktransactions){
                        $totaldebit += $banktransactions->bt_amount;
                    }
                    $bankrvoucher = \DB::select('SELECT * FROM bankreceipts WHERE br_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    foreach ($bankrvoucher as $rbanktransactions){
                        $totalcredit += $rbanktransactions->br_amount;
                    }
                    $journalvoucher = \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    foreach ($journalvoucher as $journalvouchers){
                        if($journalvouchers->jv_acc_status == 'Debit'){
                            $totaldebit += $journalvouchers->jv_amount;
                        }else if($journalvouchers->jv_acc_status == 'Credit') {
                            $totalcredit += $journalvouchers->jv_amount;
                        }
                    }
                    $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
                    $gst = \DB::select('SELECT DISTINCT fr_name, sq_number, sq_title, sq_totalst, created_at FROM squotations WHERE fyear = ?', [$fnl->fn_name]);
                    foreach($assetbalances as $assetorbalance){
                        if($assetorbalance->h_name == 'Import GST & A. GST'){
                            foreach ($gst as $saletax){
                                $totalcredit += $saletax->sq_totalst;
                            }
                        } else {}
                    }
                    //    dd($assetbalances);
                    foreach ($assetbalances as $orbalance){
                        $remaining = 0;
                        if($assetbalances ==null){
                            $remaining = 0 + $remaining;
                            $orbalance = new \stdClass();
                            $orbalance->h_name ='';
                            $orbalance->ob_amount = 0;
                            $orbalance->h_opbalance=0;
                            $orbalance->h_balance=0;
                        }else{
                            $remaining = $orbalance->ob_amount + $totaldebit;
                        }
                        array_push($ab_opening_blance,$orbalance->ob_amount);
                    }
                    $remaining =  $remaining - $totalcredit;
                    $item->h_balance = $remaining;
                    $item->h_opbalance = array_sum($ab_opening_blance);
                   
                }
                else if($item->h_type == 'Income'){
                    $voucher = \DB::select('SELECT * FROM cashtransactions WHERE ct_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    $rvoucher = \DB::select('SELECT * FROM cashreceipts WHERE cr_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
        
                    $bankvoucher = \DB::select('SELECT * FROM banktransactions WHERE ex_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    $bankrvoucher = \DB::select('SELECT * FROM bankreceipts WHERE br_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
        
                    $journalvoucher = \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    // $assetbalances = \DB::select('SELECT * FROM heads WHERE h_name = ?', [$id]);
                    $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
                    foreach ($voucher as $cashtransactions){
                        $totaldebit += $cashtransactions->ct_amount;
                    }
                    foreach ($rvoucher as $rcashtransactions){
                        $totalcredit += $rcashtransactions->cr_amount;
                    }
                    foreach ($bankvoucher as $banktransactions){
                        $totaldebit += $banktransactions->bt_amount;
                    }
                    foreach ($bankrvoucher as $rbanktransactions){
                        $totalcredit += $rbanktransactions->br_amount;
                    }
                    foreach ($journalvoucher as $journalvouchers){
                        if($journalvouchers->jv_acc_status == 'Debit'){
                            $totaldebit += $journalvouchers->jv_amount;
                        }else  if($journalvouchers->jv_acc_status == 'Credit') {
                            $totalcredit += $journalvouchers->jv_amount;
                        }
                    }
                    // dd($totalcredit);
                    $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
                    // dd($assetbalances);
                    foreach ($assetbalances as $orbalance){
                        $remaining = 0;
                        $remaining =  $totalcredit - $totaldebit;
                        if($assetbalances ==null){
                             $remaining = 0 + $remaining;
                             $orbalance = new \stdClass();
                             $orbalance->h_name ='';
                             $orbalance->ob_amount = 0;
                             $orbalance->h_opbalance= 0;
                             $orbalance->h_balance= 0;
                        }else{
                            $remaining = $orbalance->ob_amount + $remaining;
                        }
                        array_push($ab_opening_blance,$orbalance->ob_amount);
                    }
                    $item->h_balance = $remaining;
                    $item->h_opbalance = array_sum($ab_opening_blance);
                }
            }
            
            $customers = \DB::select('SELECT * FROM farmers ');
            // dd($customers);
                foreach($customers as $item){
                    // dd($item);
                    $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
                    $voucher =  \DB::select('SELECT DISTINCT sl_number, sl_name, sl_title, sl_grandtotal, created_at, fr_ID FROM sales WHERE fr_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
                    $return =  \DB::select('SELECT DISTINCT slr_number, slr_name, slr_item, slr_saleprice, slr_quantity, created_at, fr_ID FROM salereturns WHERE fr_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
                    $service =  \DB::select('SELECT DISTINCT svi_number, svi_name, svi_crorder, svi_grandtotal, created_at, svi_crid FROM svinvoices WHERE svi_crname = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
                    $jv =  \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
                    $fp =  \DB::select('SELECT * FROM fpayments WHERE fr_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
                    // For Find Debit Vaules
                    foreach ($voucher as $cashtransactions){
                        $totaldebit += $cashtransactions->sl_grandtotal;
                    }
                    foreach ($service as $services){
                        $totaldebit += $services->svi_grandtotal;
                    }
                    foreach ($jv as $cashtransactions){
                        if($cashtransactions->jv_acc_status == 'Debit'){
                            $totaldebit += $cashtransactions->jv_amount;
                        }else  if($cashtransactions->jv_acc_status == 'Credit'){
                            $totalcredit += $cashtransactions->jv_amount;
                        }
                    }
                    // End Here Debit Code
                    // For Find Credit Vaules
                    foreach ($return as $returns){
                        $sale = $returns->slr_saleprice * $returns->slr_quantity;
                        $totalcredit += $sale;
                    }
                    foreach ($fp as $cashtransactions){
                        $totalcredit += $cashtransactions->fp_amount;
                    }
                    // dd($totaldebit);
                    // End Here Credit Code
                    $balances = \DB::select('SELECT * FROM farmers S JOIN obalances S2 ON S.fr_name = S2.sub_name WHERE S.fr_name = ? AND S2.ob_fyear = ? AND S.fr_ID = S2.sub_ID', [$item->fr_name, $fnl->fn_name]);
                    // $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
                    // dd($assetbalances);
                    $remaining = 0;
                    foreach($balances as $orbalance){
                        if($balances == null){
                            $remaining = 0 + $remaining;
                            $orbalance = new \stdClass();
                            $orbalance->fr_name ='';
                            $orbalance->ob_amount = 0;
                        }else{
                            $remaining = $orbalance->ob_amount + $totaldebit;
                            array_push($ab_opening_blance,$orbalance->ob_amount);
                        }
                    }
                    $remaining =  $remaining - $totalcredit;
                    $item->fr_balance = $remaining;
                    $item->fr_opbalance = array_sum($ab_opening_blance);
                }
            
            $suppliers = \DB::select('SELECT * FROM suppliers ');
            foreach($suppliers as $item){
                $name = $item->s_company;
                $id = $item->s_ID;
                $voucher =  \DB::select('SELECT DISTINCT po_number, po_name, po_title, po_totalprice, created_at, s_ID, s_company, po_grandtotal FROM porders WHERE s_ID = ? AND s_company = ? AND fyear = ?', [$id, $name, $fnl->fn_name]);
                $jv =  \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND jv_acc_ID = ? AND fyear = ?', [$name,$id, $fnl->fn_name]);
                $sp =  \DB::select('SELECT * FROM spayments WHERE s_ID = ? AND s_company = ? AND fyear = ?', [$id, $name, $fnl->fn_name]);
                 $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[]; $remaining = 0;;
                 foreach ($voucher as $cashtransactions){
                     $totalcredit += $cashtransactions->po_grandtotal;
                 }
                 foreach ($jv as $cashtransactions){
                     if($cashtransactions->jv_acc_status == 'Debit'){
                         $totaldebit += $cashtransactions->jv_amount;
                     }else if($cashtransactions->jv_acc_status == 'Credit') {
                         $totalcredit += $cashtransactions->jv_amount;
                     }
                 }
                 foreach ($sp as $cashtransactions){
                     $totaldebit += $cashtransactions->sp_amount;
                 }
                 $balances = \DB::select('SELECT * FROM suppliers S JOIN obalances S2 ON S.s_ID = S2.sub_ID AND S.s_company = S2.sub_name  WHERE S.s_ID = ? AND S.s_company = ? AND S2.ob_fyear = ? AND S.s_ID = S2.sub_ID', [$id, $name, $fnl->fn_name]);
                //  dd($balances);
                 foreach ($balances as $orbalance){
        
                     $remaining =  $totalcredit - $totaldebit;
                     if(empty($balances)){
                          $remaining = 0 + $remaining;
                          $orbalance = new \stdClass();
                          $orbalance->s_company ='';
                          $orbalance->s_name ='';
                          $orbalance->ob_amount = 0;
                          $orbalance->s_balance=0;
                          $orbalance->s_duedate=0;
                     }else{
                         $remaining = $orbalance->ob_amount + $remaining;
                     }
                     array_push($ab_opening_blance,$orbalance->ob_amount);
                    //  dd($ab_opening_blance);
                     $item->s_balance= $remaining;
                     $item->s_obalance = array_sum($ab_opening_blance);
                 }
            }
            // $stocks = \DB::select('SELECT * FROM stocks');
            $sales = \DB::select("SELECT * FROM sales WHERE fyear='$fnl->fn_name'");
            $salesreturn = \DB::select("SELECT * FROM salereturns WHERE fyear='$fnl->fn_name'");
            
            $purchases = \DB::select("SELECT DISTINCT po_grandtotal FROM porders WHERE fyear='$fnl->fn_name'");
            $purchasesreturn = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', ["Purchase Return", $fnl->fn_name]);
            
            // For Stock Records
            $stockorders = \DB::select('SELECT * from stocks WHERE ss_quantity <> "0"');
            // Stock end
            
            return view('trialbalances.index', ['cashinhands' => $cashinhands], ['accountsbks' => $accountsbks, 'heads' => $heads, 'customers' => $customers, 'suppliers' => $suppliers, 'sales' => $sales,'salesreturn'=>$salesreturn, 'purchases' => $purchases,'purchasesreturn'=>$purchasesreturn,'stockorders'=>$stockorders]);
            }

           else{
           $com = str_replace('-', ',', $fnl->fn_name);
           $myArray = explode(',', $com);
           $pre = $myArray[0];
           $curr = $myArray[1];
           $comb = ++$pre.'-'.++$curr;  

            $cashinhands = \DB::select('SELECT * FROM cashinhands S JOIN obalances S2 ON S.cih_title = S2.sub_name WHERE S2.ob_amount <> 0 AND S2.ob_fyear = ?', [$comb]);
            $accountsbks = \DB::select('SELECT * FROM accountsbks S JOIN obalances S2 ON S.acc_title = S2.sub_name WHERE S2.ob_amount <> 0 AND S2.ob_fyear = ?', [$comb]);
            $heads = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_ID = S2.sub_ID WHERE  S2.ob_fyear = ? AND S.h_name = S2.sub_name', [$fnl->fn_name]);
            $customers = \DB::select('SELECT * FROM farmers S JOIN obalances S2 ON S.fr_ID = S2.sub_ID WHERE S2.ob_amount <> 0 AND S2.ob_fyear = ? AND S.fr_name = S2.sub_name', [$comb]);
            $suppliers = \DB::select('SELECT * FROM suppliers S JOIN obalances S2 ON S.s_ID = S2.sub_ID WHERE S2.ob_amount <> 0 AND S2.ob_fyear = ? AND S.s_name = S2.sub_name', [$comb]);
            $sales = \DB::select('SELECT * FROM sales WHERE fyear = ?', [$comb]);
            $purchases = \DB::select('SELECT DISTINCT po_grandtotal FROM porders WHERE fyear = ?', [$comb]);
            $casht = \DB::select('SELECT * FROM cashtransactions WHERE ct_type = "Expense" AND fyear = ?', [$fnl->fn_name]);
            $bankt = \DB::select('SELECT * FROM banktransactions WHERE ex_type = "Expense" AND fyear = ?', [$fnl->fn_name]);
            $cashr = \DB::select('SELECT * FROM cashreceipts WHERE cr_type = "Expense" AND fyear = ?' , [$fnl->fn_name]);
            $bankr = \DB::select('SELECT * FROM bankreceipts WHERE br_type = "Expense" AND fyear = ?' , [$fnl->fn_name]);
            $jv = \DB::select('SELECT * FROM journalvouchers WHERE fyear = ?' , [$fnl->fn_name]);

            return view('trialbalances.indexr', ['cashinhands' => $cashinhands], ['accountsbks' => $accountsbks, 'heads' => $heads, 'customers' => $customers, 'suppliers' => $suppliers , 'sales' => $sales, 'purchases' => $purchases, 'casht' => $casht , 'bankt' => $bankt, 'cashr' => $cashr, 'bankr' => $bankr, 'jv' => $jv]);
           }
           
        }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ClosingTrialBalance(){
        {
             
            $fnl = \DB::table('fnlyear')->first();
            $result = sscanf($fnl->fn_name, '%d-%d');
            // dd($result[1]);
            $from = $result[0];
            $to = $result[1];
            $startMonth = 7; // Replace with the starting month
            $endMonth = 6; // Replace with the ending month
            $startDate = "$from-$startMonth-01";
            $endDate = "$to-$endMonth-30";
           // Get the current date
            $currentDate = Carbon::now();
            
            // Check if the current month is before July (the start of the accounting year)
            if ($currentDate->month < 7) {
                // If before July, the accounting year started in the previous calendar year
                $previousYear = $currentDate->subYear()->year;
                $currentYear = $currentDate->year;
            } else {
                // If July or later, the accounting year started in the current calendar year
                $previousYear = $currentDate->year;
                $currentYear = $currentDate->addYear()->year;
            }
            $accountingYearRange = $previousYear . '-' . $currentYear;
            if($fnl->fn_name == $accountingYearRange) 
            {
            $cashinhands = \DB::select('SELECT * FROM cashinhands WHERE cih_balance <> 0');
            // dd($cashinhands);
            foreach($cashinhands as $item){
                $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
                $voucher =  \DB::select('SELECT * from cashtransactions WHERE cih_title = ? AND fyear = ?', [$item->cih_title, $fnl->fn_name]);
                foreach ($voucher as $cashtransactions){
                    $totalcredit += $cashtransactions->ct_amount;
                }
                $rvoucher = \DB::select('SELECT * from cashreceipts WHERE cih_title = ? AND fyear = ?', [$item->cih_title, $fnl->fn_name]);
                foreach ($rvoucher as $rcashtransactions){
                    $totaldebit += $rcashtransactions->cr_amount;
                }
                $balances = \DB::select('SELECT * FROM cashinhands S JOIN obalances S2 ON S.cih_title = S2.sub_name WHERE S.cih_title = ? AND S2.ob_fyear = ?', [$item->cih_title, $fnl->fn_name]);
                // dd($balances);
                foreach ($balances as $orbalance){
                    $remaining =  $totaldebit - $totalcredit;
                    if($balances ==null){
                         $remaining = 0 + $remaining;
                         $orbalance = new \stdClass();
                         $orbalance->cih_title ='';
                         $orbalance->ob_amount = 0;
                         $orbalance->acc_balance=0;
                         $orbalance->cih_balance=0;
                    }else{
                        $remaining = $orbalance->ob_amount + $remaining;
                    }
                    array_push($ab_opening_blance,$orbalance->ob_amount);
                }
                $item->cih_balance = $remaining;
                $item->cih_obalance = array_sum($ab_opening_blance);
                // dd($ab_opening_blance);
            }
            
            $accountsbks = \DB::select('SELECT * FROM accountsbks WHERE acc_balance <> 0');
            foreach($accountsbks as $item){
                $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
                $ab_voucher =  \DB::select('SELECT * FROM banktransactions WHERE acc_number = ? AND fyear = ?', [$item->acc_number, $fnl->fn_name]);
                // dd($voucher);
                foreach ($ab_voucher as $cashtransactions){
                    $totalcredit += $cashtransactions->bt_amount;
                }
                $rvoucher = \DB::select('SELECT * FROM bankreceipts WHERE acc_number = ? AND fyear = ?', [$item->acc_number, $fnl->fn_name]);
                // dd($rvoucher);
                foreach ($rvoucher as $rcashtransactions){
                    $totaldebit += $rcashtransactions->br_amount;
                }
        
                $balances = \DB::select('SELECT * FROM accountsbks S JOIN obalances S2 ON S.acc_number = S2.sub_ID WHERE S.acc_number = ? AND S2.ob_fyear = ?', [$item->acc_number, $fnl->fn_name]);
                // dd($balances);
                foreach ($balances as $orbalance){
                    $remaining =  $totaldebit - $totalcredit;
                    if($balances ==null){
                        $remaining = 0 + $remaining;
                        $orbalance = new \stdClass();
                        $orbalance->acc_title ='';
                        $orbalance->ob_amount = 0;
                        $orbalance->acc_balance=0;
                    }else{
                        $remaining = $orbalance->ob_amount + $remaining;
                    }
                    array_push($ab_opening_blance,$orbalance->ob_amount);
                }
                $item->acc_balance = $remaining;
                $item->acc_opbalance = array_sum($ab_opening_blance);
                // dd($ab_opening_blance);
            }
            
            $heads = \DB::select("SELECT h_balance, h_name, h_type, h_stype FROM heads WHERE h_balance <> 0");
         
            foreach($heads as $item){
                // dd($item);
                if($item->h_type == 'Asset'){
                     $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
                    $voucher =  \DB::select('SELECT * FROM cashtransactions WHERE ct_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    $rvoucher = \DB::select('SELECT * from cashreceipts WHERE cr_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    $bankvoucher = \DB::select('SELECT * FROM banktransactions WHERE ex_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    $bankrvoucher = \DB::select('SELECT * FROM bankreceipts WHERE br_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    $journalvoucher = \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    // For Find Debit Vaules
                    foreach ($voucher as $cashtransactions){
                        $totaldebit += $cashtransactions->ct_amount;
                    }
                    foreach ($bankvoucher as $banktransactions){
                        $totaldebit += $banktransactions->bt_amount;
                    }
                    foreach ($journalvoucher as $journalvouchers){
                        if($journalvouchers->jv_acc_status == 'Debit'){
                            $totaldebit += $journalvouchers->jv_amount;
                        }else if($journalvouchers->jv_acc_status == 'Credit'){
                            $totalcredit += $journalvouchers->jv_amount;
                        }
                    }
                    // End Here Debit Code
                    // For Find Credit Vaules
                    foreach ($rvoucher as $rcashtransactions){
                        $totalcredit += $rcashtransactions->cr_amount;
                    }
                    foreach ($bankrvoucher as $rbanktransactions){
                        $totalcredit += $rbanktransactions->br_amount;
                    }
                    // End Here Credit Code
                    $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
                    // dd($assetbalances);
                    $remaining = 0;
                    foreach($assetbalances as $orbalance) {
                        if($assetbalances == null){
                            $remaining = 0 + $remaining;
                                $orbalance = new \stdClass();
                                $orbalance->h_name ='';
                                $orbalance->h_opbalance = 0;
                                $orbalance->h_balance=0;
                                $orbalance->ob_amount=0;
                        }else{
                            $remaining = $orbalance->ob_amount + $totaldebit;
                            array_push($ab_opening_blance,$orbalance->ob_amount);
                        }
                    }
                    $remaining =  $remaining - $totalcredit;
                    $item->h_balance = $remaining;
                    $item->h_opbalance = array_sum($ab_opening_blance);
                }else if($item->h_type == 'Liability'){
                        $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
                        $voucher =  \DB::select('SELECT * FROM cashtransactions WHERE ct_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                        $rvoucher = \DB::select('SELECT * FROM cashreceipts WHERE cr_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                        $bankvoucher =  \DB::select('SELECT * FROM banktransactions WHERE ex_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                        $bankrvoucher = \DB::select('SELECT * FROM bankreceipts WHERE br_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                        $journalvoucher = \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                        // dd($journalvoucher);
                        foreach ($voucher as $cashtransactions){
                            $totaldebit += $cashtransactions->ct_amount;
                        }
                        foreach ($rvoucher as $rcashtransactions){
                            $totalcredit += $rcashtransactions->cr_amount;
                        }
                        foreach ($bankvoucher as $banktransactions){
                            $totaldebit += $banktransactions->bt_amount;
                        }
                        foreach ($bankrvoucher as $rbanktransactions){
                            $totalcredit += $rbanktransactions->br_amount;
                        }
                        foreach ($journalvoucher as $journalvouchers){
                            if($journalvouchers->jv_acc_status == 'Debit'){
                                $totaldebit += $journalvouchers->jv_amount;
                            }else if($journalvouchers->jv_acc_status == 'Credit') {
                                $totalcredit += $journalvouchers->jv_amount;
                            }
                        }
                        // $assetbalances = \DB::select('SELECT * FROM heads WHERE h_name = ?', [$id]);
                        $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
                        // dd($totalcredit);
                        $remaining = 0;
                        foreach ($assetbalances as $orbalance){
                
                            if($assetbalances ==null){
                                $remaining = 0 + $remaining;
                                $orbalance = new \stdClass();
                                $orbalance->h_name ='';
                                $orbalance->ob_amount = 0;
                                $orbalance->h_opbalance=0;
                                $orbalance->h_balance=0;
                            }else{
                                $remaining = $orbalance->ob_amount + $totalcredit;
                            }
                            array_push($ab_opening_blance,$orbalance->ob_amount);
                        }
                        // dd($totaldebit);
                        $remaining =  $remaining - $totaldebit;
                
                        $item->h_balance = $remaining;
                        $item->h_opbalance = array_sum($ab_opening_blance);
                }
                else if($item->h_type == 'Expense'){
                    $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
                    $voucher = \DB::select('SELECT * FROM cashtransactions WHERE ct_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    foreach ($voucher as $cashtransactions){
                        $totaldebit += $cashtransactions->ct_amount;
                    }
                    $rvoucher = \DB::select('SELECT * FROM cashreceipts WHERE cr_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    foreach ($rvoucher as $rcashtransactions){
                        $totalcredit += $rcashtransactions->cr_amount;
                    }
                    $bankvoucher = \DB::select('SELECT * FROM banktransactions WHERE ex_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    foreach ($bankvoucher as $banktransactions){
                        $totaldebit += $banktransactions->bt_amount;
                    }
                    $bankrvoucher = \DB::select('SELECT * FROM bankreceipts WHERE br_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    foreach ($bankrvoucher as $rbanktransactions){
                        $totalcredit += $rbanktransactions->br_amount;
                    }
                    $journalvoucher = \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    foreach ($journalvoucher as $journalvouchers){
                        if($journalvouchers->jv_acc_status == 'Debit'){
                            $totaldebit += $journalvouchers->jv_amount;
                        }else if($journalvouchers->jv_acc_status == 'Credit') {
                            $totalcredit += $journalvouchers->jv_amount;
                        }
                    }
                    $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
                    $gst = \DB::select('SELECT DISTINCT fr_name, sq_number, sq_title, sq_totalst, created_at FROM squotations WHERE fyear = ?', [$fnl->fn_name]);
                    foreach($assetbalances as $assetorbalance){
                        if($assetorbalance->h_name == 'Import GST & A. GST'){
                            foreach ($gst as $saletax){
                                $totalcredit += $saletax->sq_totalst;
                            }
                        } else {}
                    }
                    //    dd($assetbalances);
                    foreach ($assetbalances as $orbalance){
                        $remaining = 0;
                        if($assetbalances ==null){
                            $remaining = 0 + $remaining;
                            $orbalance = new \stdClass();
                            $orbalance->h_name ='';
                            $orbalance->ob_amount = 0;
                            $orbalance->h_opbalance=0;
                            $orbalance->h_balance=0;
                        }else{
                            $remaining = $orbalance->ob_amount + $totaldebit;
                        }
                        array_push($ab_opening_blance,$orbalance->ob_amount);
                    }
                    $remaining =  $remaining - $totalcredit;
                    $item->h_balance = $remaining;
                    $item->h_opbalance = array_sum($ab_opening_blance);
                   
                }
                else if($item->h_type == 'Income'){
                    $voucher = \DB::select('SELECT * FROM cashtransactions WHERE ct_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    $rvoucher = \DB::select('SELECT * FROM cashreceipts WHERE cr_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
        
                    $bankvoucher = \DB::select('SELECT * FROM banktransactions WHERE ex_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    $bankrvoucher = \DB::select('SELECT * FROM bankreceipts WHERE br_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
        
                    $journalvoucher = \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                    // $assetbalances = \DB::select('SELECT * FROM heads WHERE h_name = ?', [$id]);
                    $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
                    foreach ($voucher as $cashtransactions){
                        $totaldebit += $cashtransactions->ct_amount;
                    }
                    foreach ($rvoucher as $rcashtransactions){
                        $totalcredit += $rcashtransactions->cr_amount;
                    }
                    foreach ($bankvoucher as $banktransactions){
                        $totaldebit += $banktransactions->bt_amount;
                    }
                    foreach ($bankrvoucher as $rbanktransactions){
                        $totalcredit += $rbanktransactions->br_amount;
                    }
                    foreach ($journalvoucher as $journalvouchers){
                        if($journalvouchers->jv_acc_status == 'Debit'){
                            $totaldebit += $journalvouchers->jv_amount;
                        }else  if($journalvouchers->jv_acc_status == 'Credit') {
                            $totalcredit += $journalvouchers->jv_amount;
                        }
                    }
                    // dd($totalcredit);
                    $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
                    // dd($assetbalances);
                    foreach ($assetbalances as $orbalance){
                        $remaining = 0;
                        $remaining =  $totalcredit - $totaldebit;
                        if($assetbalances ==null){
                             $remaining = 0 + $remaining;
                             $orbalance = new \stdClass();
                             $orbalance->h_name ='';
                             $orbalance->ob_amount = 0;
                             $orbalance->h_opbalance= 0;
                             $orbalance->h_balance= 0;
                        }else{
                            $remaining = $orbalance->ob_amount + $remaining;
                        }
                        array_push($ab_opening_blance,$orbalance->ob_amount);
                    }
                    $item->h_balance = $remaining;
                    $item->h_opbalance = array_sum($ab_opening_blance);
                }
            }
            
            $customers = \DB::select('SELECT fr_name, fr_balance FROM farmers WHERE fr_balance <> 0');
                foreach($customers as $item){
                    // dd($item);
                    $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
                    $voucher =  \DB::select('SELECT DISTINCT sl_number, sl_name, sl_title, sl_grandtotal, created_at, fr_ID FROM sales WHERE fr_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
                    $return =  \DB::select('SELECT DISTINCT slr_number, slr_name, slr_item, slr_saleprice, slr_quantity, created_at, fr_ID FROM salereturns WHERE fr_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
                    $service =  \DB::select('SELECT DISTINCT svi_number, svi_name, svi_crorder, svi_grandtotal, created_at, svi_crid FROM svinvoices WHERE svi_crname = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
                    $jv =  \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
                    $fp =  \DB::select('SELECT * FROM fpayments WHERE fr_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
                    // For Find Debit Vaules
                    foreach ($voucher as $cashtransactions){
                        $totaldebit += $cashtransactions->sl_grandtotal;
                    }
                    foreach ($service as $services){
                        $totaldebit += $services->svi_grandtotal;
                    }
                    foreach ($jv as $cashtransactions){
                        if($cashtransactions->jv_acc_status == 'Debit'){
                            $totaldebit += $cashtransactions->jv_amount;
                        }else  if($cashtransactions->jv_acc_status == 'Credit'){
                            $totalcredit += $cashtransactions->jv_amount;
                        }
                    }
                    // End Here Debit Code
                    // For Find Credit Vaules
                    foreach ($return as $returns){
                        $sale = $returns->slr_saleprice * $returns->slr_quantity;
                        $totalcredit += $sale;
                    }
                    foreach ($fp as $cashtransactions){
                        $totalcredit += $cashtransactions->fp_amount;
                    }
                    // dd($totaldebit);
                    // End Here Credit Code
                    $balances = \DB::select('SELECT * FROM farmers S JOIN obalances S2 ON S.fr_name = S2.sub_name WHERE S.fr_name = ? AND S2.ob_fyear = ? AND S.fr_ID = S2.sub_ID', [$item->fr_name, $fnl->fn_name]);
                    // $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
                    // dd($assetbalances);
                    $remaining = 0;
                    foreach($balances as $orbalance){
                        if($balances == null){
                            $remaining = 0 + $remaining;
                            $orbalance = new \stdClass();
                            $orbalance->fr_name ='';
                            $orbalance->ob_amount = 0;
                        }else{
                            $remaining = $orbalance->ob_amount + $totaldebit;
                            array_push($ab_opening_blance,$orbalance->ob_amount);
                        }
                    }
                    $remaining =  $remaining - $totalcredit;
                    $item->fr_balance = $remaining;
                    $item->fr_opbalance = array_sum($ab_opening_blance);
                }
            
            $suppliers = \DB::select('SELECT * FROM suppliers WHERE s_balance <> 0');
            foreach($suppliers as $item){
                $name = $item->s_company;
                $id = $item->s_ID;
                $voucher =  \DB::select('SELECT DISTINCT po_number, po_name, po_title, po_totalprice, created_at, s_ID, s_company, po_grandtotal FROM porders WHERE s_ID = ? AND s_company = ? AND fyear = ?', [$id, $name, $fnl->fn_name]);
                $jv =  \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND jv_acc_ID = ? AND fyear = ?', [$name,$id, $fnl->fn_name]);
                $sp =  \DB::select('SELECT * FROM spayments WHERE s_ID = ? AND s_company = ? AND fyear = ?', [$id, $name, $fnl->fn_name]);
                 $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[]; $remaining = 0;;
                 foreach ($voucher as $cashtransactions){
                     $totalcredit += $cashtransactions->po_grandtotal;
                 }
                 foreach ($jv as $cashtransactions){
                     if($cashtransactions->jv_acc_status == 'Debit'){
                         $totaldebit += $cashtransactions->jv_amount;
                     }else if($cashtransactions->jv_acc_status == 'Credit') {
                         $totalcredit += $cashtransactions->jv_amount;
                     }
                 }
                 foreach ($sp as $cashtransactions){
                     $totaldebit += $cashtransactions->sp_amount;
                 }
                 $balances = \DB::select('SELECT * FROM suppliers S JOIN obalances S2 ON S.s_ID = S2.sub_ID AND S.s_company = S2.sub_name  WHERE S.s_ID = ? AND S.s_company = ? AND S2.ob_fyear = ? AND S.s_ID = S2.sub_ID', [$id, $name, $fnl->fn_name]);
                //  dd($balances);
                 foreach ($balances as $orbalance){
        
                     $remaining =  $totalcredit - $totaldebit;
                     if(empty($balances)){
                          $remaining = 0 + $remaining;
                          $orbalance = new \stdClass();
                          $orbalance->s_company ='';
                          $orbalance->s_name ='';
                          $orbalance->ob_amount = 0;
                          $orbalance->s_balance=0;
                          $orbalance->s_duedate=0;
                     }else{
                         $remaining = $orbalance->ob_amount + $remaining;
                     }
                     array_push($ab_opening_blance,$orbalance->ob_amount);
                    //  dd($ab_opening_blance);
                     $item->s_balance= $remaining;
                     $item->s_obalance = array_sum($ab_opening_blance);
                 }
            }
            // $stocks = \DB::select('SELECT * FROM stocks');
            $sales = \DB::select('SELECT * FROM sales');
            
            
            $purchases = \DB::select('SELECT DISTINCT po_grandtotal FROM porders');
            return view('trialbalances.closingbalance', ['cashinhands' => $cashinhands], ['accountsbks' => $accountsbks, 'heads' => $heads, 'customers' => $customers, 'suppliers' => $suppliers, 'sales' => $sales, 'purchases' => $purchases]);
            }

           else{
           $com = str_replace('-', ',', $fnl->fn_name);
           $myArray = explode(',', $com);
           $pre = $myArray[0];
           $curr = $myArray[1];
           $comb = ++$pre.'-'.++$curr;  

            $cashinhands = \DB::select('SELECT * FROM cashinhands S JOIN obalances S2 ON S.cih_title = S2.sub_name WHERE S2.ob_amount <> 0 AND S2.ob_fyear = ?', [$comb]);
            $accountsbks = \DB::select('SELECT * FROM accountsbks S JOIN obalances S2 ON S.acc_title = S2.sub_name WHERE S2.ob_amount <> 0 AND S2.ob_fyear = ?', [$comb]);
            $heads = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_ID = S2.sub_ID WHERE  S2.ob_fyear = ? AND S.h_name = S2.sub_name', [$fnl->fn_name]);
            $customers = \DB::select('SELECT * FROM farmers S JOIN obalances S2 ON S.fr_ID = S2.sub_ID WHERE S2.ob_amount <> 0 AND S2.ob_fyear = ? AND S.fr_name = S2.sub_name', [$comb]);
            $suppliers = \DB::select('SELECT * FROM suppliers S JOIN obalances S2 ON S.s_ID = S2.sub_ID WHERE S2.ob_amount <> 0 AND S2.ob_fyear = ? AND S.s_name = S2.sub_name', [$comb]);
            $sales = \DB::select('SELECT * FROM sales WHERE fyear = ?', [$comb]);
            $purchases = \DB::select('SELECT DISTINCT po_grandtotal FROM porders WHERE fyear = ?', [$comb]);
            $casht = \DB::select('SELECT * FROM cashtransactions WHERE ct_type = "Expense" AND fyear = ?', [$fnl->fn_name]);
            $bankt = \DB::select('SELECT * FROM banktransactions WHERE ex_type = "Expense" AND fyear = ?', [$fnl->fn_name]);
            $cashr = \DB::select('SELECT * FROM cashreceipts WHERE cr_type = "Expense" AND fyear = ?' , [$fnl->fn_name]);
            $bankr = \DB::select('SELECT * FROM bankreceipts WHERE br_type = "Expense" AND fyear = ?' , [$fnl->fn_name]);
            $jv = \DB::select('SELECT * FROM journalvouchers WHERE fyear = ?' , [$fnl->fn_name]);

            return view('trialbalances.closingbalancer', ['cashinhands' => $cashinhands], ['accountsbks' => $accountsbks, 'heads' => $heads, 'customers' => $customers, 'suppliers' => $suppliers , 'sales' => $sales, 'purchases' => $purchases, 'casht' => $casht , 'bankt' => $bankt, 'cashr' => $cashr, 'bankr' => $bankr, 'jv' => $jv]);
           }
           
        }
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
