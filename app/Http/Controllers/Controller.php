<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use App\Cashledgers;
use App\Cashinhands;
use App\Accountsbks;
use App\Farmer;
use App\Heads;
use App\Suppliers;
use App\Obalances;
use App\Year;
use DB;

use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function FetchObalance()
    {
        $obalance = \DB::select("SELECT * FROM obalances where ob_fyear = '2021-2022'");
        for ($i = 0; $i < sizeof($obalance); $i++) {
            $obalance[$i]->ob_fyear = '2022-2023';
        }
        for ($i = 0; $i < sizeof($obalance); $i++) {
            $obalances = new Obalances();
            $obalances->sub_ID = $obalance[$i]->sub_ID;
            $obalances->sub_name = $obalance[$i]->sub_name;
            $obalances->ob_amount = $obalance[$i]->ob_amount;
            $obalances->ob_fyear = $obalance[$i]->ob_fyear;
            $obalances->save();
        }
    }

    // Closing Fiscal Year
    public function FetchAllData(Request $request)
    {

        $date = $request->input("date");
        if ($date == null) {
            $date = date('Y-m-d H:i:s');
        }
        $dates = $date . " 23:59:59";
        $fnl = \DB::table('fnlyear')->first();
        $result = sscanf($fnl->fn_name, '%d-%d');
        // dd($result[1]);
        $from = $result[0];
        $to = $result[1];
        $startMonth = 7; // Replace with the starting month
        $endMonth = 6; // Replace with the ending month
        $startDate = "$from-$startMonth-01";
        $endDate = "$to-$endMonth-30";
        $closing_record_cash = \DB::select('SELECT * FROM cashinhands');
        // $this->CashInHand($closing_record_cash, $fnl);
        foreach ($closing_record_cash as $item) {
            $totaldebit = 0;
            $totalcredit = 0;
            $ab_opening_blance = [];
            $voucher =  \DB::select('SELECT * from cashtransactions WHERE cih_title = ? AND fyear = ?', [$item->cih_title, $fnl->fn_name]);
            foreach ($voucher as $cashtransactions) {
                $totalcredit += $cashtransactions->ct_amount;
            }
            $rvoucher = \DB::select('SELECT * from cashreceipts WHERE cih_title = ? AND fyear = ?', [$item->cih_title, $fnl->fn_name]);
            foreach ($rvoucher as $rcashtransactions) {
                $totaldebit += $rcashtransactions->cr_amount;
            }
            $balances = \DB::select('SELECT * FROM cashinhands S JOIN obalances S2 ON S.cih_title = S2.sub_name WHERE S.cih_title = ? AND S2.ob_fyear = ?', [$item->cih_title, $fnl->fn_name]);
            // dd($balances);
            foreach ($balances as $orbalance) {
                $remaining =  $totaldebit - $totalcredit;
                if ($balances == null) {
                    $remaining = 0 + $remaining;
                    $orbalance = new \stdClass();
                    $orbalance->cih_title = '';
                    $orbalance->ob_amount = 0;
                    $orbalance->acc_balance = 0;
                    $orbalance->cih_balance = 0;
                } else {
                    $remaining = $orbalance->ob_amount + $remaining;
                }
                array_push($ab_opening_blance, $orbalance->ob_amount);
            }
            $item->cih_balance = $remaining;
            $item->cih_obalance = array_sum($ab_opening_blance);
            // dd($ab_opening_blance);
        }
        $closing_record_accounts = \DB::select('SELECT * FROM accountsbks');
        foreach ($closing_record_accounts as $item) {

            $totaldebit = 0;
            $totalcredit = 0;
            $ab_opening_blance = [];
            $ab_voucher =  \DB::select('SELECT * FROM banktransactions WHERE acc_number = ? AND fyear = ?', [$item->acc_number, $fnl->fn_name]);
            // dd($voucher);
            foreach ($ab_voucher as $cashtransactions) {
                $totalcredit += $cashtransactions->bt_amount;
            }
            $rvoucher = \DB::select('SELECT * FROM bankreceipts WHERE acc_number = ? AND fyear = ?', [$item->acc_number, $fnl->fn_name]);
            // dd($rvoucher);
            foreach ($rvoucher as $rcashtransactions) {
                $totaldebit += $rcashtransactions->br_amount;
            }

            $balances = \DB::select('SELECT * FROM accountsbks S JOIN obalances S2 ON S.acc_number = S2.sub_ID WHERE S.acc_number = ? AND S2.ob_fyear = ?', [$item->acc_number, $fnl->fn_name]);
            // dd($balances);
            foreach ($balances as $orbalance) {
                $remaining =  $totaldebit - $totalcredit;
                if ($balances == null) {
                    $remaining = 0 + $remaining;
                    $orbalance = new \stdClass();
                    $orbalance->acc_title = '';
                    $orbalance->ob_amount = 0;
                    $orbalance->acc_balance = 0;
                } else {
                    $remaining = $orbalance->ob_amount + $remaining;
                }
                array_push($ab_opening_blance, $orbalance->ob_amount);
            }
            $item->acc_balance = $remaining;
            $item->acc_opbalance = array_sum($ab_opening_blance);
            // dd($ab_opening_blance);
        }
        $closing_record_farmers = Farmer::where('updated_at', '<=', $dates)->get();
        foreach ($closing_record_farmers as $item) {
            // dd($item);
            $totaldebit = 0;
            $totalcredit = 0;
            $ab_opening_blance = [];
            $voucher =  \DB::select('SELECT DISTINCT sl_number, sl_name, sl_title, sl_grandtotal, created_at, fr_ID FROM sales WHERE fr_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
            $return =  \DB::select('SELECT DISTINCT slr_number, slr_name, slr_item, slr_saleprice, slr_quantity, created_at, fr_ID FROM salereturns WHERE fr_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
            $service =  \DB::select('SELECT DISTINCT svi_number, svi_name, svi_crorder, svi_grandtotal, created_at, svi_crid FROM svinvoices WHERE svi_crname = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
            $jv =  \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
            $fp =  \DB::select('SELECT * FROM fpayments WHERE fr_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
            // For Find Debit Vaules
            foreach ($voucher as $cashtransactions) {
                $totaldebit += $cashtransactions->sl_grandtotal;
            }
            foreach ($service as $services) {
                $totaldebit += $services->svi_grandtotal;
            }
            foreach ($jv as $cashtransactions) {
                if ($cashtransactions->jv_acc_status == 'Debit') {
                    $totaldebit += $cashtransactions->jv_amount;
                } else  if ($cashtransactions->jv_acc_status == 'Credit') {
                    $totalcredit += $cashtransactions->jv_amount;
                }
            }
            // End Here Debit Code
            // For Find Credit Vaules
            foreach ($return as $returns) {
                $sale = $returns->slr_saleprice * $returns->slr_quantity;
                $totalcredit += $sale;
            }
            foreach ($fp as $cashtransactions) {
                $totalcredit += $cashtransactions->fp_amount;
            }
            // dd($totaldebit);
            // End Here Credit Code
            $balances = \DB::select('SELECT * FROM farmers S JOIN obalances S2 ON S.fr_name = S2.sub_name WHERE S.fr_name = ? AND S2.ob_fyear = ? AND S.fr_ID = S2.sub_ID', [$item->fr_name, $fnl->fn_name]);
            // $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
            // dd($assetbalances);
            $remaining = 0;
            foreach ($balances as $orbalance) {
                if ($balances == null) {
                    $remaining = 0 + $remaining;
                    $orbalance = new \stdClass();
                    $orbalance->fr_name = '';
                    $orbalance->ob_amount = 0;
                } else {
                    $remaining = $orbalance->ob_amount + $totaldebit;
                    array_push($ab_opening_blance, $orbalance->ob_amount);
                }
            }
            $remaining =  $remaining - $totalcredit;
            $item->fr_balance = $remaining;
            $item->fr_opbalance = array_sum($ab_opening_blance);
        }
        $closing_record_suppliers = Suppliers::where('updated_at', '<=', $dates)->get();
        foreach ($closing_record_suppliers as $item) {
            $name = $item->s_company;
            $id = $item->s_ID;
            $voucher =  \DB::select('SELECT DISTINCT po_number, po_name, po_title, po_totalprice, created_at, s_ID, s_company, po_grandtotal FROM porders WHERE s_ID = ? AND s_company = ? AND fyear = ?', [$id, $name, $fnl->fn_name]);
            $jv =  \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND jv_acc_ID = ? AND fyear = ?', [$name, $id, $fnl->fn_name]);
            $sp =  \DB::select('SELECT * FROM spayments WHERE s_ID = ? AND s_company = ? AND fyear = ?', [$id, $name, $fnl->fn_name]);
            $totaldebit = 0;
            $totalcredit = 0;
            $ab_opening_blance = [];
            $remaining = 0;;
            foreach ($voucher as $cashtransactions) {
                $totalcredit += $cashtransactions->po_grandtotal;
            }
            foreach ($jv as $cashtransactions) {
                if ($cashtransactions->jv_acc_status == 'Debit') {
                    $totaldebit += $cashtransactions->jv_amount;
                } else if ($cashtransactions->jv_acc_status == 'Credit') {
                    $totalcredit += $cashtransactions->jv_amount;
                }
            }
            foreach ($sp as $cashtransactions) {
                $totaldebit += $cashtransactions->sp_amount;
            }
            $balances = \DB::select('SELECT * FROM suppliers S JOIN obalances S2 ON S.s_ID = S2.sub_ID AND S.s_company = S2.sub_name  WHERE S.s_ID = ? AND S.s_company = ? AND S2.ob_fyear = ? AND S.s_ID = S2.sub_ID', [$id, $name, $fnl->fn_name]);
            //  dd($balances);
            foreach ($balances as $orbalance) {

                $remaining =  $totalcredit - $totaldebit;
                if (empty($balances)) {
                    $remaining = 0 + $remaining;
                    $orbalance = new \stdClass();
                    $orbalance->s_company = '';
                    $orbalance->s_name = '';
                    $orbalance->ob_amount = 0;
                    $orbalance->s_balance = 0;
                    $orbalance->s_duedate = 0;
                } else {
                    $remaining = $orbalance->ob_amount + $remaining;
                }
                array_push($ab_opening_blance, $orbalance->ob_amount);
                //  dd($ab_opening_blance);
                $item->s_balance = $remaining;
                $item->s_obalance = array_sum($ab_opening_blance);
            }
        }
        $closing_record_asset = Heads::where("h_type", "Asset")->get();
        foreach ($closing_record_asset as $item) {
            // dd($item);
            $totaldebit = 0;
            $totalcredit = 0;
            $ab_opening_blance = [];
            $voucher =  \DB::select('SELECT * FROM cashtransactions WHERE ct_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            $rvoucher = \DB::select('SELECT * from cashreceipts WHERE cr_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            $bankvoucher = \DB::select('SELECT * FROM banktransactions WHERE ex_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            $bankrvoucher = \DB::select('SELECT * FROM bankreceipts WHERE br_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            $journalvoucher = \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            // For Find Debit Vaules
            foreach ($voucher as $cashtransactions) {
                $totaldebit += $cashtransactions->ct_amount;
            }
            foreach ($bankvoucher as $banktransactions) {
                $totaldebit += $banktransactions->bt_amount;
            }
            foreach ($journalvoucher as $journalvouchers) {
                if ($journalvouchers->jv_acc_status == 'Debit') {
                    $totaldebit += $journalvouchers->jv_amount;
                } else if ($journalvouchers->jv_acc_status == 'Credit') {
                    $totalcredit += $journalvouchers->jv_amount;
                }
            }
            // End Here Debit Code
            // For Find Credit Vaules
            foreach ($rvoucher as $rcashtransactions) {
                $totalcredit += $rcashtransactions->cr_amount;
            }
            foreach ($bankrvoucher as $rbanktransactions) {
                $totalcredit += $rbanktransactions->br_amount;
            }
            // End Here Credit Code
            $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
            // dd($assetbalances);
            $remaining = 0;
            foreach ($assetbalances as $orbalance) {
                if ($assetbalances == null) {
                    $remaining = 0 + $remaining;
                    $orbalance = new \stdClass();
                    $orbalance->h_name = '';
                    $orbalance->h_opbalance = 0;
                    $orbalance->h_balance = 0;
                    $orbalance->ob_amount = 0;
                } else {
                    $remaining = $orbalance->ob_amount + $totaldebit;
                    array_push($ab_opening_blance, $orbalance->ob_amount);
                }
            }
            $remaining =  $remaining - $totalcredit;
            $item->h_balance = $remaining;
            $item->h_opbalance = array_sum($ab_opening_blance);
        }
        $closing_record_liability = Heads::where('h_type', 'Liability')->get();
        foreach ($closing_record_liability as $item) {
            // dd($item);
            $totaldebit = 0;
            $totalcredit = 0;
            $ab_opening_blance = [];
            $voucher =  \DB::select('SELECT * FROM cashtransactions WHERE ct_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            $rvoucher = \DB::select('SELECT * FROM cashreceipts WHERE cr_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            $bankvoucher =  \DB::select('SELECT * FROM banktransactions WHERE ex_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            $bankrvoucher = \DB::select('SELECT * FROM bankreceipts WHERE br_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            $journalvoucher = \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            // dd($journalvoucher);
            foreach ($voucher as $cashtransactions) {
                $totaldebit += $cashtransactions->ct_amount;
            }
            foreach ($rvoucher as $rcashtransactions) {
                $totalcredit += $rcashtransactions->cr_amount;
            }
            foreach ($bankvoucher as $banktransactions) {
                $totaldebit += $banktransactions->bt_amount;
            }
            foreach ($bankrvoucher as $rbanktransactions) {
                $totalcredit += $rbanktransactions->br_amount;
            }
            foreach ($journalvoucher as $journalvouchers) {
                if ($journalvouchers->jv_acc_status == 'Debit') {
                    $totaldebit += $journalvouchers->jv_amount;
                } else if ($journalvouchers->jv_acc_status == 'Credit') {
                    $totalcredit += $journalvouchers->jv_amount;
                }
            }
            // $assetbalances = \DB::select('SELECT * FROM heads WHERE h_name = ?', [$id]);
            $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
            // dd($totalcredit);
            $remaining = 0;
            foreach ($assetbalances as $orbalance) {

                if ($assetbalances == null) {
                    $remaining = 0 + $remaining;
                    $orbalance = new \stdClass();
                    $orbalance->h_name = '';
                    $orbalance->ob_amount = 0;
                    $orbalance->h_opbalance = 0;
                    $orbalance->h_balance = 0;
                } else {
                    $remaining = $orbalance->ob_amount + $totalcredit;
                }
                array_push($ab_opening_blance, $orbalance->ob_amount);
            }
            // dd($totaldebit);
            $remaining =  $remaining - $totaldebit;

            $item->h_balance = $remaining;
            $item->h_opbalance = array_sum($ab_opening_blance);
            // dd($totaldebit);
        }
        // dd($closing_record_asset);
        return view('closingyear.closing_year', compact('closing_record_cash', 'closing_record_accounts', 'closing_record_farmers', 'closing_record_suppliers', 'closing_record_asset', 'closing_record_liability'));
    }

    public function ClosingRecords(Request $request)
    {
        $fnl = \DB::table('fnlyear')->first();
        $password = 'star123';
        // Get Previous Year Records of Opening Balance
        $obalance_cus = \DB::select("SELECT * FROM obalances WHERE `ob_fyear`= '2023-2024'");
        foreach ($obalance_cus as $item) {
            $obalance_check = \DB::select("SELECT * FROM obalances WHERE `sub_ID`='$item->sub_ID' AND sub_name ='$item->sub_name' AND `ob_fyear`= '2024-2025'");
            if (count($obalance_check) > 0) {
            } else {
                $obalance = new Obalances();
                $obalance->sub_ID = $item->sub_ID;
                $obalance->sub_name = $item->sub_name;
                $obalance->ob_amount = 0;
                $obalance->ob_fyear = '2024-2025';
                $obalance->save();
            }
        }

        if ($password == $request->password && count($obalance_check) <= 0) {

            $closing_record_cash = \DB::select('SELECT * FROM cashinhands');
            $this->CashInHand($closing_record_cash, $fnl);
            $closing_record_accounts = \DB::select('SELECT * FROM accountsbks');
            foreach ($closing_record_accounts as $item) {
                $totaldebit = 0;
                $totalcredit = 0;
                $ab_opening_blance = [];
                $ab_voucher =  \DB::select('SELECT * FROM banktransactions WHERE acc_number = ? AND fyear = ?', [$item->acc_number, $fnl->fn_name]);
                foreach ($ab_voucher as $cashtransactions) {
                    $totalcredit += $cashtransactions->bt_amount;
                }
                $rvoucher = \DB::select('SELECT * FROM bankreceipts WHERE acc_number = ? AND fyear = ?', [$item->acc_number, $fnl->fn_name]);
                foreach ($rvoucher as $rcashtransactions) {
                    $totaldebit += $rcashtransactions->br_amount;
                }
                $balances = \DB::select('SELECT * FROM accountsbks S JOIN obalances S2 ON S.acc_number = S2.sub_ID WHERE S.acc_number = ? AND S2.ob_fyear = ?', [$item->acc_number, $fnl->fn_name]);
                foreach ($balances as $orbalance) {
                    $remaining =  $totaldebit - $totalcredit;
                    if ($balances == null) {
                        $remaining = 0 + $remaining;
                        $orbalance = new \stdClass();
                        $orbalance->acc_title = '';
                        $orbalance->ob_amount = 0;
                        $orbalance->acc_balance = 0;
                    } else {
                        $remaining = $orbalance->ob_amount + $remaining;
                    }
                    array_push($ab_opening_blance, $orbalance->ob_amount);
                }
                $obalance_cus = \DB::update("update obalances set ob_amount=? WHERE sub_id = ? AND sub_name = ? AND ob_fyear = ?", [$remaining, $item->acc_number, $item->acc_title, '2024-2025']);
                $item->acc_balance = $remaining;
                $item->acc_opbalance = array_sum($ab_opening_blance);
            }
            $closing_record_farmers = \DB::select('SELECT * FROM farmers');
            foreach ($closing_record_farmers as $item) {
                $totaldebit = 0;
                $totalcredit = 0;
                $ab_opening_blance = [];
                $voucher =  \DB::select('SELECT DISTINCT sl_number, sl_name, sl_title, sl_grandtotal, created_at, fr_ID FROM sales WHERE fr_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
                $return =  \DB::select('SELECT DISTINCT slr_number, slr_name, slr_item, slr_saleprice, slr_quantity, created_at, fr_ID FROM salereturns WHERE fr_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
                $service =  \DB::select('SELECT DISTINCT svi_number, svi_name, svi_crorder, svi_grandtotal, created_at, svi_crid FROM svinvoices WHERE svi_crname = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
                $jv =  \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
                $fp =  \DB::select('SELECT * FROM fpayments WHERE fr_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
                // For Find Debit Vaules
                foreach ($voucher as $cashtransactions) {
                    $totaldebit += $cashtransactions->sl_grandtotal;
                }
                foreach ($service as $services) {
                    $totaldebit += $services->svi_grandtotal;
                }
                foreach ($jv as $cashtransactions) {
                    if ($cashtransactions->jv_acc_status == 'Debit') {
                        $totaldebit += $cashtransactions->jv_amount;
                    } else  if ($cashtransactions->jv_acc_status == 'Credit') {
                        $totalcredit += $cashtransactions->jv_amount;
                    }
                }
                // End Here Debit Code
                // For Find Credit Vaules
                foreach ($return as $returns) {
                    $sale = $returns->slr_saleprice * $returns->slr_quantity;
                    $totalcredit += $sale;
                }
                foreach ($fp as $cashtransactions) {
                    $totalcredit += $cashtransactions->fp_amount;
                }
                // dd($totaldebit);
                // End Here Credit Code
                $balances = \DB::select('SELECT * FROM farmers S JOIN obalances S2 ON S.fr_name = S2.sub_name WHERE S.fr_name = ? AND S2.ob_fyear = ? AND S.fr_ID = S2.sub_ID', [$item->fr_name, $fnl->fn_name]);
                // $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
                // dd($assetbalances);
                $remaining = 0;
                foreach ($balances as $orbalance) {
                    if ($balances == null) {
                        $remaining = 0 + $remaining;
                        $orbalance = new \stdClass();
                        $orbalance->fr_name = '';
                        $orbalance->ob_amount = 0;
                    } else {
                        $remaining = $orbalance->ob_amount + $totaldebit;
                        array_push($ab_opening_blance, $orbalance->ob_amount);
                    }
                }
                $remaining =  $remaining - $totalcredit;
                $obalance_cus = \DB::update("update obalances set ob_amount=? WHERE sub_id = ? AND sub_name = ? AND ob_fyear = ?", [$remaining, $item->fr_ID, $item->fr_name, '2024-2025']);
                $item->fr_balance = $remaining;
                $item->fr_opbalance = array_sum($ab_opening_blance);
            }
            $closing_record_suppliers = \DB::select('SELECT * FROM suppliers');
            // dd($closing_record_suppliers);
            foreach ($closing_record_suppliers as $item) {
                $name = $item->s_company;
                $id = $item->s_ID;
                $voucher =  \DB::select('SELECT DISTINCT po_number, po_name, po_title, po_totalprice, created_at, s_ID, s_company, po_grandtotal FROM porders WHERE s_ID = ? AND s_company = ? AND fyear = ?', [$id, $name, $fnl->fn_name]);
                $jv =  \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND jv_acc_ID = ? AND fyear = ?', [$name, $id, $fnl->fn_name]);
                $sp =  \DB::select('SELECT * FROM spayments WHERE s_ID = ? AND s_company = ? AND fyear = ?', [$id, $name, $fnl->fn_name]);
                $totaldebit = 0;
                $totalcredit = 0;
                $ab_opening_blance = [];
                $remaining = 0;;
                foreach ($voucher as $cashtransactions) {
                    $totalcredit += $cashtransactions->po_grandtotal;
                }
                foreach ($jv as $cashtransactions) {
                    if ($cashtransactions->jv_acc_status == 'Debit') {
                        $totaldebit += $cashtransactions->jv_amount;
                    } else if ($cashtransactions->jv_acc_status == 'Credit') {
                        $totalcredit += $cashtransactions->jv_amount;
                    }
                }
                foreach ($sp as $cashtransactions) {
                    $totaldebit += $cashtransactions->sp_amount;
                }
                $balances = \DB::select('SELECT * FROM suppliers S JOIN obalances S2 ON S.s_ID = S2.sub_ID AND S.s_company = S2.sub_name  WHERE S.s_ID = ? AND S.s_company = ? AND S2.ob_fyear = ? AND S.s_ID = S2.sub_ID', [$id, $name, $fnl->fn_name]);
                //  dd($balances);
                foreach ($balances as $orbalance) {

                    $remaining =  $totalcredit - $totaldebit;
                    if (empty($balances)) {
                        $remaining = 0 + $remaining;
                        $orbalance = new \stdClass();
                        $orbalance->s_company = '';
                        $orbalance->s_name = '';
                        $orbalance->ob_amount = 0;
                        $orbalance->s_balance = 0;
                        $orbalance->s_duedate = 0;
                    } else {
                        $remaining = $orbalance->ob_amount + $remaining;
                    }
                    array_push($ab_opening_blance, $orbalance->ob_amount);
                    //  dd($ab_opening_blance);
                    $obalance_cus = \DB::update("update obalances set ob_amount=? WHERE sub_id = ? AND sub_name = ? AND ob_fyear = ?", [$remaining, $item->s_ID, $item->s_company, '2024-2025']);
                    $item->s_balance = $remaining;
                    $item->s_obalance = array_sum($ab_opening_blance);
                }
            }
            $closing_record_asset = Heads::where("h_type", "Asset")->get();
            // dd($closing_record_asset);
            foreach ($closing_record_asset as $item) {
                // dd($item);
                $totaldebit = 0;
                $totalcredit = 0;
                $ab_opening_blance = [];
                $voucher =  \DB::select('SELECT * FROM cashtransactions WHERE ct_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                $rvoucher = \DB::select('SELECT * from cashreceipts WHERE cr_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                $bankvoucher = \DB::select('SELECT * FROM banktransactions WHERE ex_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                $bankrvoucher = \DB::select('SELECT * FROM bankreceipts WHERE br_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                $journalvoucher = \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                // For Find Debit Vaules
                foreach ($voucher as $cashtransactions) {
                    $totaldebit += $cashtransactions->ct_amount;
                }
                foreach ($bankvoucher as $banktransactions) {
                    $totaldebit += $banktransactions->bt_amount;
                }
                foreach ($journalvoucher as $journalvouchers) {
                    if ($journalvouchers->jv_acc_status == 'Debit') {
                        $totaldebit += $journalvouchers->jv_amount;
                    } else if ($journalvouchers->jv_acc_status == 'Credit') {
                        $totalcredit += $journalvouchers->jv_amount;
                    }
                }
                // End Here Debit Code
                // For Find Credit Vaules
                foreach ($rvoucher as $rcashtransactions) {
                    $totalcredit += $rcashtransactions->cr_amount;
                }
                foreach ($bankrvoucher as $rbanktransactions) {
                    $totalcredit += $rbanktransactions->br_amount;
                }
                // End Here Credit Code
                $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
                // dd($assetbalances);
                $remaining = 0;
                foreach ($assetbalances as $orbalance) {
                    if ($assetbalances == null) {
                        $remaining = 0 + $remaining;
                        $orbalance = new \stdClass();
                        $orbalance->h_name = '';
                        $orbalance->h_opbalance = 0;
                        $orbalance->h_balance = 0;
                        $orbalance->ob_amount = 0;
                    } else {
                        $remaining = $orbalance->ob_amount + $totaldebit;
                        array_push($ab_opening_blance, $orbalance->ob_amount);
                    }
                }
                $remaining =  $remaining - $totalcredit;
                $obalance_cus = \DB::update("update obalances set ob_amount=? WHERE sub_id = ? AND sub_name = ? AND ob_fyear = ?", [$remaining, $item->h_ID, $item->h_name, '2024-2025']);
                $item->h_balance = $remaining;
                $item->h_opbalance = array_sum($ab_opening_blance);
            }
            $closing_record_liability = Heads::where('h_type', 'Liability')->get();
            // dd($closing_record_liability);
            foreach ($closing_record_liability as $item) {
                // dd($item);
                $totaldebit = 0;
                $totalcredit = 0;
                $ab_opening_blance = [];
                $voucher =  \DB::select('SELECT * FROM cashtransactions WHERE ct_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                $rvoucher = \DB::select('SELECT * FROM cashreceipts WHERE cr_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                $bankvoucher =  \DB::select('SELECT * FROM banktransactions WHERE ex_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                $bankrvoucher = \DB::select('SELECT * FROM bankreceipts WHERE br_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                $journalvoucher = \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                // dd($journalvoucher);
                foreach ($voucher as $cashtransactions) {
                    $totaldebit += $cashtransactions->ct_amount;
                }
                foreach ($rvoucher as $rcashtransactions) {
                    $totalcredit += $rcashtransactions->cr_amount;
                }
                foreach ($bankvoucher as $banktransactions) {
                    $totaldebit += $banktransactions->bt_amount;
                }
                foreach ($bankrvoucher as $rbanktransactions) {
                    $totalcredit += $rbanktransactions->br_amount;
                }
                foreach ($journalvoucher as $journalvouchers) {
                    if ($journalvouchers->jv_acc_status == 'Debit') {
                        $totaldebit += $journalvouchers->jv_amount;
                    } else if ($journalvouchers->jv_acc_status == 'Credit') {
                        $totalcredit += $journalvouchers->jv_amount;
                    }
                }
                // $assetbalances = \DB::select('SELECT * FROM heads WHERE h_name = ?', [$id]);
                $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
                // dd($totalcredit);
                $remaining = 0;
                foreach ($assetbalances as $orbalance) {

                    if ($assetbalances == null) {
                        $remaining = 0 + $remaining;
                        $orbalance = new \stdClass();
                        $orbalance->h_name = '';
                        $orbalance->ob_amount = 0;
                        $orbalance->h_opbalance = 0;
                        $orbalance->h_balance = 0;
                    } else {
                        $remaining = $orbalance->ob_amount + $totalcredit;
                    }
                    array_push($ab_opening_blance, $orbalance->ob_amount);
                }
                // dd($totaldebit);
                $remaining =  $remaining - $totaldebit;
                $obalance_cus = \DB::update("update obalances set ob_amount=? WHERE sub_id = ? AND sub_name = ? AND ob_fyear = ?", [$remaining, $item->h_ID, $item->h_name, '2024-2025']);
                $item->h_balance = $remaining;
                $item->h_opbalance = array_sum($ab_opening_blance);
                // dd($totaldebit);
            }
            // dd($closing_record_cash);
            $array = [];
            $array_id = [];
            for ($i = 0; $i < sizeof($closing_record_cash); $i++) {
                array_push($array, $closing_record_cash[$i]->cih_balance);
                array_push($array_id, $closing_record_cash[$i]->cih_ID);
            }
            // dd($array);
            for ($i = 0; $i < sizeof($array_id); $i++) {

                $data = Cashinhands::where('cih_ID', $array_id[$i])->first();
                $data->cih_obalance = $array[$i];
                $data->cih_balance = 0;
                $data->save();
            }

            $array_account = [];
            $array_account_id = [];

            for ($i = 0; $i < sizeof($closing_record_accounts); $i++) {
                array_push($array_account, $closing_record_accounts[$i]->acc_balance);
                array_push($array_account_id, $closing_record_accounts[$i]->acc_ID);
            }

            for ($i = 0; $i < sizeof($array_account_id); $i++) {
                $account_data = Accountsbks::where('acc_ID', $array_account_id[$i])->first();
                $account_data->acc_opbalance = $array_account[$i];
                $account_data->acc_balance = 0;
                $account_data->save();
            }

            $array_farmer = [];
            $array_farmer_id = [];
            for ($i = 0; $i < sizeof($closing_record_farmers); $i++) {
                array_push($array_farmer, $closing_record_farmers[$i]->fr_balance);
                array_push($array_farmer_id, $closing_record_farmers[$i]->fr_ID);
            }
            for ($i = 0; $i < sizeof($array_farmer_id); $i++) {
                $farmer_data = Farmer::where('fr_ID', $array_farmer_id[$i])->first();
                $farmer_data->fr_opbalance = $array_farmer[$i];
                $farmer_data->fr_balance = 0;
                $farmer_data->save();
            }

            $array_suppliers = [];
            $array_suppliers_id = [];
            for ($i = 0; $i < sizeof($closing_record_suppliers); $i++) {
                array_push($array_suppliers, $closing_record_suppliers[$i]->s_balance);
                array_push($array_suppliers_id, $closing_record_suppliers[$i]->s_ID);
            }

            for ($i = 0; $i < sizeof($array_suppliers_id); $i++) {

                $suppliers_data = Suppliers::where('s_ID', $array_suppliers_id[$i])->first();
                $suppliers_data->s_obalance = $array_suppliers[$i];
                $suppliers_data->s_balance = 0;
                $suppliers_data->save();
            }

            $array_asset = [];
            $array_asset_id = [];
            for ($i = 0; $i < sizeof($closing_record_asset); $i++) {
                array_push($array_asset, $closing_record_asset[$i]->h_balance);
                array_push($array_asset_id, $closing_record_asset[$i]->h_ID);
            }

            for ($i = 0; $i < sizeof($array_asset_id); $i++) {
                $asset_data = Heads::Where('h_ID', $array_asset_id[$i])->first();
                $asset_data->h_opbalance = $array_asset[$i];
                $asset_data->h_balance = 0;
                $asset_data->save();
            }

            $array_liability = [];
            $array_liability_id = [];
            for ($i = 0; $i < sizeof($closing_record_liability); $i++) {
                array_push($array_asset, $closing_record_liability[$i]->h_balance);
                array_push($array_asset_id, $closing_record_liability[$i]->h_ID);
            }

            for ($i = 0; $i < sizeof($array_liability_id); $i++) {
                $asset_data = Heads::Where('h_ID', $array_liability_id[$i])->first();
                $asset_data->h_opbalance = $array_liability[$i];
                $asset_data->h_balance = 0;
                $asset_data->save();
            }
        } else {
        }
        return redirect()->back();
    }

    private function CashInHand($closing_record_cash, $fnl)
    {
        // dd($fnl);
        foreach ($closing_record_cash as $item) {
            $totaldebit = 0;
            $totalcredit = 0;
            $ab_opening_blance = [];
            $voucher =  \DB::select('SELECT * from cashtransactions WHERE cih_title = ? AND fyear = ?', [$item->cih_title, $fnl->fn_name]);
            foreach ($voucher as $cashtransactions) {
                $totalcredit += $cashtransactions->ct_amount;
            }
            $rvoucher = \DB::select('SELECT * from cashreceipts WHERE cih_title = ? AND fyear = ?', [$item->cih_title, $fnl->fn_name]);
            foreach ($rvoucher as $rcashtransactions) {
                $totaldebit += $rcashtransactions->cr_amount;
            }
            $balances = \DB::select('SELECT * FROM cashinhands S JOIN obalances S2 ON S.cih_title = S2.sub_name WHERE S.cih_title = ? AND S2.ob_fyear = ?', [$item->cih_title, $fnl->fn_name]);
            // dd($balances);
            foreach ($balances as $orbalance) {
                $remaining =  $totaldebit - $totalcredit;
                if ($balances == null) {
                    $remaining = 0 + $remaining;
                    $orbalance = new \stdClass();
                    $orbalance->cih_title = '';
                    $orbalance->ob_amount = 0;
                    $orbalance->acc_balance = 0;
                    $orbalance->cih_balance = 0;
                } else {
                    $remaining = $orbalance->ob_amount + $remaining;
                }
                array_push($ab_opening_blance, $orbalance->ob_amount);
            }
            $obalance_cus = \DB::update("update obalances set ob_amount=? WHERE sub_id = ? AND sub_name = ? AND ob_fyear = ?", [$remaining, $item->cih_ID, $item->cih_title, '2024-2025']);
            $item->cih_balance = $remaining;
            $item->cih_obalance = array_sum($ab_opening_blance);
            // dd($ab_opening_blance);
        }
    }
    // End Closing Fiscal Year
    public function index(Request $request)
    {

        $fnl = \DB::table('fnlyear')->first();

        $result = sscanf($fnl->fn_name, '%d-%d');
        $from = $result[0];
        $to = $result[1];
        $startMonth = 07; // Replace with the starting month
        $endMonth = 06; // Replace with the ending month
        $startDate = "$from-$startMonth-01";
        $endDate = "$to-$endMonth-30";

        $adminexpense = \DB::select('SELECT h_balance from heads WHERE h_stype = "Administrative Expenses"');

        $markexpense = \DB::select('SELECT h_balance from heads WHERE h_stype = "Marketing Expenses"');

        $cogexpense = \DB::select('SELECT h_balance from heads WHERE h_stype = "Cost of Goods"');

        $sales = \DB::select('SELECT * FROM sales WHERE fyear = ?', [$fnl->fn_name]);

        $services = \DB::select('SELECT DISTINCT svi_number, svi_grandtotal FROM svinvoices WHERE fyear = ?', [$fnl->fn_name]);
        // $suppliers = \DB::select('SELECT * FROM suppliers WHERE s_balance > "0"');
        $date = $request->input("date");
        if ($date == null) {
            $date = date('Y-m-d H:i:s');
        }
        $dates = $date . " 23:59:59";
        $suppliers = Suppliers::where('updated_at', '<=', $dates)->get();

        foreach ($suppliers as $item) {
            $name = $item->s_company;
            $id = $item->s_ID;
            $voucher =  \DB::select('SELECT DISTINCT po_number, po_name, po_title, po_totalprice, created_at, s_ID, s_company, po_grandtotal FROM porders WHERE s_ID = ? AND s_company = ? AND fyear = ?', [$id, $name, $fnl->fn_name]);
            $jv =  \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND jv_acc_ID = ? AND fyear = ?', [$name, $id, $fnl->fn_name]);
            $sp =  \DB::select('SELECT * FROM spayments WHERE s_ID = ? AND s_company = ? AND fyear = ?', [$id, $name, $fnl->fn_name]);
            $totaldebit = 0;
            $totalcredit = 0;
            $ab_opening_blance = [];
            $remaining = 0;;
            foreach ($voucher as $cashtransactions) {
                $totalcredit += $cashtransactions->po_grandtotal;
            }
            foreach ($jv as $cashtransactions) {
                if ($cashtransactions->jv_acc_status == 'Debit') {
                    $totaldebit += $cashtransactions->jv_amount;
                } else if ($cashtransactions->jv_acc_status == 'Credit') {
                    $totalcredit += $cashtransactions->jv_amount;
                }
            }
            foreach ($sp as $cashtransactions) {
                $totaldebit += $cashtransactions->sp_amount;
            }
            $balances = \DB::select('SELECT * FROM suppliers S JOIN obalances S2 ON S.s_ID = S2.sub_ID AND S.s_company = S2.sub_name  WHERE S.s_ID = ? AND S.s_company = ? AND S2.ob_fyear = ? AND S.s_ID = S2.sub_ID', [$id, $name, $fnl->fn_name]);
            //  dd($balances);
            foreach ($balances as $orbalance) {

                $remaining =  $totalcredit - $totaldebit;
                if (empty($balances)) {
                    $remaining = 0 + $remaining;
                    $orbalance = new \stdClass();
                    $orbalance->s_company = '';
                    $orbalance->s_name = '';
                    $orbalance->ob_amount = 0;
                    $orbalance->s_balance = 0;
                    $orbalance->s_duedate = 0;
                } else {
                    $remaining = $orbalance->ob_amount + $remaining;
                }
                array_push($ab_opening_blance, $orbalance->ob_amount);
                //  dd($ab_opening_blance);
                $item->s_balance = $remaining;
                $item->s_obalance = array_sum($ab_opening_blance);
            }
        }
        $customers = \DB::select('SELECT * FROM farmers');

        foreach ($customers as $item) {
            // dd($item);
            $totaldebit = 0;
            $totalcredit = 0;
            $ab_opening_blance = [];
            $voucher =  \DB::select('SELECT DISTINCT sl_number, sl_name, sl_title, sl_grandtotal, created_at, fr_ID FROM sales WHERE fr_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
            $return =  \DB::select('SELECT DISTINCT slr_number, slr_name, slr_item, slr_saleprice, slr_quantity, created_at, fr_ID FROM salereturns WHERE fr_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
            $service =  \DB::select('SELECT DISTINCT svi_number, svi_name, svi_crorder, svi_grandtotal, created_at, svi_crid FROM svinvoices WHERE svi_crname = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
            $jv =  \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
            $fp =  \DB::select('SELECT * FROM fpayments WHERE fr_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
            // For Find Debit Vaules
            foreach ($voucher as $cashtransactions) {
                $totaldebit += $cashtransactions->sl_grandtotal;
            }
            foreach ($service as $services) {
                $totaldebit += $services->svi_grandtotal;
            }
            foreach ($jv as $cashtransactions) {
                if ($cashtransactions->jv_acc_status == 'Debit') {
                    $totaldebit += $cashtransactions->jv_amount;
                } else  if ($cashtransactions->jv_acc_status == 'Credit') {
                    $totalcredit += $cashtransactions->jv_amount;
                }
            }
            // End Here Debit Code
            // For Find Credit Vaules
            foreach ($return as $returns) {
                $sale = $returns->slr_saleprice * $returns->slr_quantity;
                $totalcredit += $sale;
            }
            foreach ($fp as $cashtransactions) {
                $totalcredit += $cashtransactions->fp_amount;
            }
            // dd($totaldebit);
            // End Here Credit Code
            $balances = \DB::select('SELECT * FROM farmers S JOIN obalances S2 ON S.fr_name = S2.sub_name WHERE S.fr_name = ? AND S2.ob_fyear = ? AND S.fr_ID = S2.sub_ID', [$item->fr_name, $fnl->fn_name]);
            // $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
            // dd($assetbalances);
            $remaining = 0;
            foreach ($balances as $orbalance) {
                if ($balances == null) {
                    $remaining = 0 + $remaining;
                    $orbalance = new \stdClass();
                    $orbalance->fr_name = '';
                    $orbalance->ob_amount = 0;
                } else {
                    $remaining = $orbalance->ob_amount + $totaldebit;
                    array_push($ab_opening_blance, $orbalance->ob_amount);
                }
            }
            $remaining =  $remaining - $totalcredit;
            $item->fr_balance = $remaining;
            $item->fr_opbalance = array_sum($ab_opening_blance);
        }
        $frbalance = Farmer::where('updated_at', '<=', $dates)->get();
        foreach ($frbalance as $item) {
            // dd($item);
            $totaldebit = 0;
            $totalcredit = 0;
            $ab_opening_blance = [];
            $voucher =  \DB::select('SELECT DISTINCT sl_number, sl_name, sl_title, sl_grandtotal, created_at, fr_ID FROM sales WHERE fr_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
            $return =  \DB::select('SELECT DISTINCT slr_number, slr_name, slr_item, slr_saleprice, slr_quantity, created_at, fr_ID FROM salereturns WHERE fr_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
            $service =  \DB::select('SELECT DISTINCT svi_number, svi_name, svi_crorder, svi_grandtotal, created_at, svi_crid FROM svinvoices WHERE svi_crname = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
            $jv =  \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
            $fp =  \DB::select('SELECT * FROM fpayments WHERE fr_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
            // For Find Debit Vaules
            foreach ($voucher as $cashtransactions) {
                $totaldebit += $cashtransactions->sl_grandtotal;
            }
            foreach ($service as $services) {
                $totaldebit += $services->svi_grandtotal;
            }
            foreach ($jv as $cashtransactions) {
                if ($cashtransactions->jv_acc_status == 'Debit') {
                    $totaldebit += $cashtransactions->jv_amount;
                } else  if ($cashtransactions->jv_acc_status == 'Credit') {
                    $totalcredit += $cashtransactions->jv_amount;
                }
            }
            // End Here Debit Code
            // For Find Credit Vaules
            foreach ($return as $returns) {
                $sale = $returns->slr_saleprice * $returns->slr_quantity;
                $totalcredit += $sale;
            }
            foreach ($fp as $cashtransactions) {
                $totalcredit += $cashtransactions->fp_amount;
            }
            // End Here Credit Code
            $balances = \DB::select('SELECT * FROM farmers S JOIN obalances S2 ON S.fr_name = S2.sub_name WHERE S.fr_name = ? AND S2.ob_fyear = ? AND S.fr_ID = S2.sub_ID', [$item->fr_name, $fnl->fn_name]);
            // $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
            $remaining = 0;
            foreach ($balances as $orbalance) {
                if ($balances == null) {
                    $remaining = 0 + $remaining;
                    $orbalance = new \stdClass();
                    $orbalance->fr_name = '';
                    $orbalance->ob_amount = 0;
                } else {
                    $remaining = $orbalance->ob_amount + $totaldebit;
                    array_push($ab_opening_blance, $orbalance->ob_amount);
                }
            }
            $remaining =  $remaining - $totalcredit;
            $item->fr_balance = $remaining;
            $item->fr_opbalance = array_sum($ab_opening_blance);
        }
        // $cashinhands = \DB::select('SELECT cih_balance, cih_title FROM cashinhands');
        // $bankaccounts = \DB::select('SELECT acc_balance, acc_title FROM accountsbks');
        $cashinhands = Cashinhands::get();
        foreach ($cashinhands as $item) {
            $totaldebit = 0;
            $totalcredit = 0;
            $ab_opening_blance = [];
            $voucher =  \DB::select('SELECT * from cashtransactions WHERE cih_title = ? AND fyear = ?', [$item->cih_title, $fnl->fn_name]);
            foreach ($voucher as $cashtransactions) {
                $totalcredit += $cashtransactions->ct_amount;
            }
            $rvoucher = \DB::select('SELECT * from cashreceipts WHERE cih_title = ? AND fyear = ?', [$item->cih_title, $fnl->fn_name]);
            foreach ($rvoucher as $rcashtransactions) {
                $totaldebit += $rcashtransactions->cr_amount;
            }
            $balances = \DB::select('SELECT * FROM cashinhands S JOIN obalances S2 ON S.cih_title = S2.sub_name WHERE S.cih_title = ? AND S2.ob_fyear = ?', [$item->cih_title, $fnl->fn_name]);
            // dd($balances);
            $remaining = 0;
            foreach ($balances as $orbalance) {
                $remaining =  $totaldebit - $totalcredit;
                if ($balances == null) {
                    $remaining = 0 + $remaining;
                    $orbalance = new \stdClass();
                    $orbalance->cih_title = '';
                    $orbalance->ob_amount = 0;
                    $orbalance->acc_balance = 0;
                    $orbalance->cih_balance = 0;
                } else {
                    $remaining = $orbalance->ob_amount + $remaining;
                }
                array_push($ab_opening_blance, $orbalance->ob_amount);
            }
            $item->cih_balance = $remaining;
            $item->cih_obalance = array_sum($ab_opening_blance);
        }
        $bankaccounts = Accountsbks::get();
        foreach ($bankaccounts as $item) {
            $totaldebit = 0;
            $totalcredit = 0;
            $ab_opening_blance = [];
            $ab_voucher =  \DB::select('SELECT * FROM banktransactions WHERE acc_number = ? AND fyear = ?', [$item->acc_number, $fnl->fn_name]);
            foreach ($ab_voucher as $cashtransactions) {
                $totalcredit += $cashtransactions->bt_amount;
            }
            $rvoucher = \DB::select('SELECT * FROM bankreceipts WHERE acc_number = ? AND fyear = ?', [$item->acc_number, $fnl->fn_name]);
            foreach ($rvoucher as $rcashtransactions) {
                $totaldebit += $rcashtransactions->br_amount;
            }

            $balances = \DB::select('SELECT * FROM accountsbks S JOIN obalances S2 ON S.acc_number = S2.sub_ID WHERE S.acc_number = ? AND S2.ob_fyear = ?', [$item->acc_number, $fnl->fn_name]);
            // dd($balances);
            foreach ($balances as $orbalance) {
                $remaining =  $totaldebit - $totalcredit;
                if ($balances == null) {
                    $remaining = 0 + $remaining;
                    $orbalance = new \stdClass();
                    $orbalance->acc_title = '';
                    $orbalance->ob_amount = 0;
                    $orbalance->acc_balance = 0;
                } else {
                    $remaining = $orbalance->ob_amount + $remaining;
                }
                array_push($ab_opening_blance, $orbalance->ob_amount);
            }
            $item->acc_balance = $remaining;
            $item->acc_opbalance = array_sum($ab_opening_blance);
            // dd($ab_opening_blance);
        }

        $stock = \DB::select('SELECT * FROM stocks');

        $head = \DB::select('SELECT h_balance from heads WHERE h_name = "Advance Sales" AND created_at =?', [$fnl->fn_name]);

        $monthlysales = \DB::select('SELECT DISTINCT sl_grandtotal FROM sales WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())');

        $monthlyservices = \DB::select('SELECT DISTINCT svi_number, svi_grandtotal FROM svinvoices WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())');

        $jvdebit = \DB::select('SELECT SUM(jv_amount) AS d FROM journalvouchers WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) AND jv_acc_status = "Debit" AND jv_acc_name = "Advance Sales"');

        $jvcredit = \DB::select('SELECT SUM(jv_amount) AS c FROM journalvouchers WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) AND jv_acc_status = "Credit" AND jv_acc_name = "Advance Sales"');

        $monthlypurchases = \DB::select('SELECT DISTINCT sc_grandtotal FROM scvaluations WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())');

        $topitem = \DB::select('SELECT sl_item, SUM(sl_quantity) AS c from sales WHERE fyear = ? GROUP BY sl_item ORDER BY c DESC LIMIT 15', [$fnl->fn_name]);

        $toppayables = \DB::select('SELECT s_company, SUM(s_balance) AS p from suppliers GROUP BY s_company ORDER BY p DESC LIMIT 5');

        $topcustomers = \DB::select('SELECT fr_name, SUM(sl_totalprice) AS p from sales WHERE fyear = ? GROUP BY fr_name ORDER BY p DESC LIMIT 10', [$fnl->fn_name]);

        $fnl = \DB::select('SELECT fn_name FROM fnlyear');
        $monthsale = \DB::table("sales")
            ->select(\DB::raw('EXTRACT(MONTH FROM created_at ) AS month, EXTRACT(YEAR FROM created_at ) AS year , SUM(sl_totalprice) as tot'))
            ->where('fyear', $fnl[0]->fn_name)
            ->groupBy(\DB::raw('month'))
            ->groupBy(\DB::raw('year'))
            ->orderBy('sl_ID', 'ASC')
            ->get();
        $jvdebitmonthly = \DB::select('SELECT SUM(jv_amount) AS d, MONTH(created_at) AS mc FROM journalvouchers WHERE  jv_acc_status = "Debit" AND jv_acc_name = "Advance Sales" GROUP BY MONTH(created_at) ORDER BY jv_ID');

        $jvcreditmonthly = \DB::select('SELECT SUM(jv_amount) AS c, MONTH(created_at) AS mc FROM journalvouchers WHERE jv_acc_status = "Credit" AND jv_acc_name = "Advance Sales" GROUP BY MONTH(created_at) ORDER BY jv_ID');

        $monthservice = \DB::table("svinvoices")
            ->select(\DB::raw('EXTRACT(MONTH FROM created_at) AS month, EXTRACT(YEAR FROM created_at) AS year, SUM(svi_totalprice) as tot'))
            ->groupBy(\DB::raw('month'))
            ->groupBy(\DB::raw('year'))
            ->orderBy('svi_ID', 'ASC')
            ->get();

        $fyear = \DB::select('SELECT DISTINCT fyear FROM cashtransactions');
        $qyear = date('Y');
        $qyearp = date("Y", strtotime("-1 year"));

        // $quotes_this_month = \DB::select('SELECT MONTH(issueDate) AS M, COUNT(DISTINCT QuotationNumber) as totalq, Qyear FROM newquotes WHERE issuedate > "2020-06-30" GROUP BY M ORDER BY M ASC', [$qyear, $qyearp]);
        $quotes_this_month = \DB::select('
                                             SELECT
                                                 MONTH(issueDate) AS M,
                                                 COUNT(DISTINCT QuotationNumber) as totalq,
                                                 Qyear
                                             FROM
                                                 newquotes
                                             WHERE
                                                 issueDate >= ? AND issueDate <= ?
                                             GROUP BY
                                                 M
                                             ORDER BY
                                                 M ASC
                                         ', [$startDate, $endDate]);

        $orders_this_month = \DB::select('SELECT MONTH(created_at) AS M, COUNT(DISTINCT sq_number) as totalq, YEAR(created_at) AS Y FROM squotations WHERE fyear = ? GROUP BY M ORDER BY M ASC', [$fnl[0]->fn_name]);
        $years = Year::get();
        // Filter out suppliers with an s_balance of 0, null, or empty
        $filteredSuppliers = $suppliers->filter(function ($supplier) {
            return !($supplier->s_balance == 0 || $supplier->s_balance == "0" || is_null($supplier->s_balance) || empty($supplier->s_balance) || abs($supplier->s_balance) < 1e-10);
        });

        // Filter out Customer with an fr_balance of 0, null, or empty
        $customersCollection = collect($customers);
        $specificCustomer = $customersCollection->firstWhere('fr_name', 'GETZ PHARMA (Pvt) Ltd.');

        // Optionally, use dd() to debug the specific customer
        // dd($specificCustomer);
        $filteredCustomers = $customersCollection->filter(function ($customer) {
            return !($customer->fr_balance == 0 || $customer->fr_balance == "0" || is_null($customer->fr_balance) || empty($customer->fr_balance) || abs($customer->fr_balance) < 1e-10 || abs($customer->fr_balance) < 7e-10);
        });

        $costOfGoodsSum = $this->costOfGoodSum();
        $financialExpanseSum = $this->financialExpSum();
        $adminExpanseSum = $this->adminExpenseSum();
        $marketingExpanseSum = $this->marketingExpSum();

        $fiscalYear = $fnl[0]->fn_name;

        // Split the fiscal year string
        list($startYear, $endYear) = explode('-', $fiscalYear);

        // Construct the start and end dates
        $startDate = $startYear . '-07-01';
        $endDate = $endYear . '-06-30';
        // dd($startDate);
        $monthlyNetProfit = DB::table('netprofit as s1')
            ->select(DB::raw('s1.value, MONTH(s1.created_at) as month'))
            ->whereBetween('s1.created_at', [$startDate, $endDate])
            ->whereIn('s1.id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('netprofit as s2')
                    ->groupBy(DB::raw('YEAR(s2.created_at), MONTH(s2.created_at)'));
            })
            ->orderBy('month')
            ->get();

        return view('home', ['monthlyNetProfit' => $monthlyNetProfit, 'sales' => $sales, 'marketingExpanseSum' => $marketingExpanseSum, 'adminExpanseSum' => $adminExpanseSum, 'costOfGoodsSum' => $costOfGoodsSum, 'financialExpanseSum' => $financialExpanseSum], ['years' => $years, 'services' => $services, 'suppliers' => $filteredSuppliers, 'cashinhands' => $cashinhands, 'bankaccounts' => $bankaccounts, 'customers' => $filteredCustomers, 'stock' => $stock, 'head' => $head, 'frbalance' => $frbalance, 'fnl' => $fnl, 'fyear' => $fyear, 'monthlysales' => $monthlysales, 'topitem' => $topitem, 'monthlypurchases' => $monthlypurchases, 'adminexpense' => $adminexpense, 'markexpense' => $markexpense, 'cogexpense' => $cogexpense,  'monthsale' => $monthsale, 'jvdebit' => $jvdebit, 'jvcredit' => $jvcredit, 'monthlyservices' => $monthlyservices, 'jvdebitmonthly' => $jvdebitmonthly, 'jvcreditmonthly' => $jvcreditmonthly, 'monthservice' => $monthservice, 'toppayables' => $toppayables, 'topcustomers' => $topcustomers, 'quotes_this_month' => $quotes_this_month, 'orders_this_month' => $orders_this_month]);
    }
    private function adminExpenseSum()
    {
        $fnl = \DB::table('fnlyear')->first();
        $voucherSum = \DB::table('cashtransactions')
            ->leftJoin('heads', 'cashtransactions.ct_name', '=', 'heads.h_name')
            ->where('cashtransactions.fyear', $fnl->fn_name)
            ->where('heads.h_stype', 'Administrative Expenses')
            ->sum('cashtransactions.ct_amount');

        $rvoucherSum = \DB::table('cashreceipts')
            ->leftJoin('heads', 'cashreceipts.cr_name', '=', 'heads.h_name')
            ->where('cashreceipts.fyear', $fnl->fn_name)
            ->where('heads.h_stype', 'Administrative Expenses')
            ->sum('cashreceipts.cr_amount');

        $bankVoucherSum = \DB::table('banktransactions')
            ->leftJoin('heads', 'banktransactions.ex_name', '=', 'heads.h_name')
            ->where('banktransactions.fyear', $fnl->fn_name)
            ->where('heads.h_stype', 'Administrative Expenses')
            ->sum('banktransactions.bt_amount');

        $bankRVoucherSum = \DB::table('bankreceipts')
            ->leftJoin('heads', 'bankreceipts.br_name', '=', 'heads.h_name')
            ->where('bankreceipts.fyear', $fnl->fn_name)
            ->where('heads.h_stype', 'Administrative Expenses')
            ->sum('bankreceipts.br_amount');

        $journalVoucherSum = \DB::table('journalvouchers')
            ->leftJoin('heads', 'journalvouchers.jv_acc_name', '=', 'heads.h_name')
            ->where('journalvouchers.fyear', $fnl->fn_name)
            ->where('heads.h_stype', 'Administrative Expenses')
            ->get();

        $totalDebit = $voucherSum + $bankVoucherSum;
        $totalCredit = $rvoucherSum + $bankRVoucherSum;
        foreach ($journalVoucherSum as $journalvouchers) {
            if ($journalvouchers->jv_acc_status == 'Debit') {
                $totalDebit += $journalvouchers->jv_amount;
            } else {
                $totalCredit += $journalvouchers->jv_amount;
            }
        }

        return   $totalDebit - $totalCredit;
    }
    private function costOfGoodSum()
    {
        $fnl = \DB::table('fnlyear')->first();
        $voucherSum = \DB::table('cashtransactions')
            ->leftJoin('heads', 'cashtransactions.ct_name', '=', 'heads.h_name')
            ->where('cashtransactions.fyear', $fnl->fn_name)
            ->where('heads.h_stype', 'Cost of Goods')
            ->sum('cashtransactions.ct_amount');
        // dd($voucherSum);

        $rvoucherSum = \DB::table('cashreceipts')
            ->leftJoin('heads', 'cashreceipts.cr_name', '=', 'heads.h_name')
            ->where('cashreceipts.fyear', $fnl->fn_name)
            ->where('heads.h_stype', 'Cost of Goods')
            ->sum('cashreceipts.cr_amount');

        $bankVoucherSum = \DB::table('banktransactions')
            ->leftJoin('heads', 'banktransactions.ex_name', '=', 'heads.h_name')
            ->where('banktransactions.fyear', $fnl->fn_name)
            ->where('heads.h_stype', 'Cost of Goods')
            ->sum('banktransactions.bt_amount');

        $bankRVoucherSum = \DB::table('bankreceipts')
            ->leftJoin('heads', 'bankreceipts.br_name', '=', 'heads.h_name')
            ->where('bankreceipts.fyear', $fnl->fn_name)
            ->where('heads.h_stype', 'Cost of Goods')
            ->sum('bankreceipts.br_amount');

        $journalVoucherSum = \DB::table('journalvouchers')
            ->leftJoin('heads', 'journalvouchers.jv_acc_name', '=', 'heads.h_name')
            ->where('journalvouchers.fyear', $fnl->fn_name)
            ->where('heads.h_stype', 'Cost of Goods')
            ->get();

        $totalDebit = $voucherSum + $bankVoucherSum;
        $totalCredit = $rvoucherSum + $bankRVoucherSum;
        foreach ($journalVoucherSum as $journalvouchers) {
            if ($journalvouchers->jv_acc_status == 'Debit') {
                $totalDebit += $journalvouchers->jv_amount;
            } else {
                $totalCredit += $journalvouchers->jv_amount;
            }
        }

        return   $totalDebit - $totalCredit;
    }
    private function financialExpSum()
    {
        $fnl = \DB::table('fnlyear')->first();
        $voucherSum = \DB::table('cashtransactions')
            ->leftJoin('heads', 'cashtransactions.ct_name', '=', 'heads.h_name')
            ->where('cashtransactions.fyear', $fnl->fn_name)
            ->where('heads.h_stype', 'Financial Expenses')
            ->sum('cashtransactions.ct_amount');


        $rvoucherSum = \DB::table('cashreceipts')
            ->leftJoin('heads', 'cashreceipts.cr_name', '=', 'heads.h_name')
            ->where('cashreceipts.fyear', $fnl->fn_name)
            ->where('heads.h_stype', 'Financial Expenses')
            ->sum('cashreceipts.cr_amount');

        $bankVoucherSum = \DB::table('banktransactions')
            ->leftJoin('heads', 'banktransactions.ex_name', '=', 'heads.h_name')
            ->where('banktransactions.fyear', $fnl->fn_name)
            ->where('heads.h_stype', 'Financial Expenses')
            ->sum('banktransactions.bt_amount');

        $bankRVoucherSum = \DB::table('bankreceipts')
            ->leftJoin('heads', 'bankreceipts.br_name', '=', 'heads.h_name')
            ->where('bankreceipts.fyear', $fnl->fn_name)
            ->where('heads.h_stype', 'Financial Expenses')
            ->sum('bankreceipts.br_amount');

        $journalVoucherSum = \DB::table('journalvouchers')
            ->leftJoin('heads', 'journalvouchers.jv_acc_name', '=', 'heads.h_name')
            ->where('journalvouchers.fyear', $fnl->fn_name)
            ->where('heads.h_stype', 'Financial Expenses')
            ->get();

        $totalDebit = $voucherSum + $bankVoucherSum;
        $totalCredit = $rvoucherSum + $bankRVoucherSum;
        foreach ($journalVoucherSum as $journalvouchers) {
            if ($journalvouchers->jv_acc_status == 'Debit') {
                $totalDebit += $journalvouchers->jv_amount;
            } else {
                $totalCredit += $journalvouchers->jv_amount;
            }
        }

        return   $totalDebit - $totalCredit;
    }
    private function marketingExpSum()
    {
        $fnl = \DB::table('fnlyear')->first();
        $voucherSum = \DB::table('cashtransactions')
            ->leftJoin('heads', 'cashtransactions.ct_name', '=', 'heads.h_name')
            ->where('cashtransactions.fyear', $fnl->fn_name)
            ->where('heads.h_stype', 'Marketing Expenses')
            ->sum('cashtransactions.ct_amount');


        $rvoucherSum = \DB::table('cashreceipts')
            ->leftJoin('heads', 'cashreceipts.cr_name', '=', 'heads.h_name')
            ->where('cashreceipts.fyear', $fnl->fn_name)
            ->where('heads.h_stype', 'Marketing Expenses')
            ->sum('cashreceipts.cr_amount');

        $bankVoucherSum = \DB::table('banktransactions')
            ->leftJoin('heads', 'banktransactions.ex_name', '=', 'heads.h_name')
            ->where('banktransactions.fyear', $fnl->fn_name)
            ->where('heads.h_stype', 'Marketing Expenses')
            ->sum('banktransactions.bt_amount');

        $bankRVoucherSum = \DB::table('bankreceipts')
            ->leftJoin('heads', 'bankreceipts.br_name', '=', 'heads.h_name')
            ->where('bankreceipts.fyear', $fnl->fn_name)
            ->where('heads.h_stype', 'Marketing Expenses')
            ->sum('bankreceipts.br_amount');

        $journalVoucherSum = \DB::table('journalvouchers')
            ->leftJoin('heads', 'journalvouchers.jv_acc_name', '=', 'heads.h_name')
            ->where('journalvouchers.fyear', $fnl->fn_name)
            ->where('heads.h_stype', 'Marketing Expenses')
            ->get();

        $totalDebit = $voucherSum + $bankVoucherSum;
        $totalCredit = $rvoucherSum + $bankRVoucherSum;
        foreach ($journalVoucherSum as $journalvouchers) {
            if ($journalvouchers->jv_acc_status == 'Debit') {
                $totalDebit += $journalvouchers->jv_amount;
            } else {
                $totalCredit += $journalvouchers->jv_amount;
            }
        }

        return   $totalDebit - $totalCredit;
    }
    public function action(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = \DB::table('stocks')
                    ->where('ss_item', 'like', '%' . $query . '%')
                    ->orWhere('ss_size', 'like', '%' . $query . '%')
                    ->orWhere('ss_quantity', 'like', '%' . $query . '%')
                    ->orWhere('ss_costunit', 'like', '%' . $query . '%')
                    ->orWhere('lot_number', 'like', '%' . $query . '%')
                    ->orWhere('ss_ID', 'like', '%' . $query . '%')
                    ->orWhere('ss_saleprice', 'like', '%' . $query . '%')
                    ->orderBy('ss_ID', 'desc')
                    ->get();
            } else {
                $data = \DB::table('stocks')
                    ->orderBy('ss_ID', 'desc')
                    ->limit(5)
                    ->get();
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                foreach ($data as $row) {
                    $subtotal =  number_format($row->ss_costunit, 2, '.', ',');
                    $output .= '
            <tr>
            <td width="10%"><input type="hidden" class="form-control" name="pid[]" value="' . $row->ss_ID . '" readonly/>
            ' . $row->ss_ID . '</td>
            <td>' . $row->ss_item . '</td>
            <td>' . $row->ss_quantity . '</td>
            <td width="15%">' . $subtotal . '</td>
            <td width="20%">' . $row->lot_number . '</td>
            <td width="20%"><input type="number" class="form-control" name="saleprice[]" value="' . $row->ss_saleprice . '"/></td>
            </tr>
            ';
                }
            } else {
                $output = '
         <tr>
         <td align="center" colspan="5">No Data Found</td>
         </tr>
         ';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );
            echo json_encode($data);
        }
    }
    public function store(Request $request)
    {
        $titlefyear = $request->input('fyear');
        \DB::update('UPDATE fnlyear SET fn_name = ? WHERE fn_ID = "1"', [$titlefyear]);
        return back()->with('success', 'Financial Year Set Successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function backup()
    {
        $file = basename('star_accounts_backup.sql');
        $file = '/home/staritek/' . $file;

        if (!file_exists($file)) { // file does not exist
            die('file not found');
        } else {
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file");
            header("Content-Type: application/zip");
            header("Content-Transfer-Encoding: binary");

            // read the file from disk
            readfile($file);
        }
    }
    /**j
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
}


// select (SELECT SUM(jv_amount) AS credit FROM journalvouchers WHERE jv_acc_name = 'Advance Sales' AND jv_acc_status = 'Credit' AND fyear = '2019-2020') - (SELECT SUM(jv_amount) AS debit FROM journalvouchers WHERE jv_acc_name = 'Advance Sales' AND jv_acc_status = 'Debit' AND fyear = '2019-2020') AS Outstanding_Funds
