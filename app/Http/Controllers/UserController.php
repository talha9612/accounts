<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = \DB::select('SELECT * FROM users');
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        $user = User::find($id);
        return view('users.edit',compact('user','id'));
    }

    public function editPassword($id)
    {
        
        $user = User::find($id);
        return view('users.editpassword',compact('user','id'));
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
        if(isset($request->password) && !empty($request->password))
        {
            if(isset($request->confirm_password) && !empty($request->confirm_password))
            {
                if($request->password != $request->confirm_password)
                {
                    return back()->with('warning', 'Both passwords did not match, Please Try again');
            
                }
                else{
                    \DB::update('UPDATE users SET password = ? WHERE id = ?', [Hash::make($request['confirm_password']) ,$request->input('id')]);

                    return redirect('users')->with('success','Password has been updated');
                }
            }
            else{
                return back()->with('warning', 'Please Fill Both Fields');
            }

        }
        else
        {
        //  FOR USER ROLES
         $customerview = $request->input('customerview', false);
         $customeradd = $request->input('customeradd', false);
         $customeredit = $request->input('customeredit', false);
         $customerdelete = $request->input('customerdelete', false);

         $companyview = $request->input('companyview', false);
         $companyadd = $request->input('companyadd', false);
         $companyedit = $request->input('companyedit', false);
         $companydelete = $request->input('companydelete', false);

         $cpersonview = $request->input('cpersonview', false);
         $cpersonadd = $request->input('cpersonadd', false);
         $cpersonedit = $request->input('cpersonedit', false);
         $cpersondelete = $request->input('cpersondelete', false);

         $assetledgersview = $request->input('assetledgersview', false);

         $bankslistview = $request->input('bankslistview', false);
         $bankslistadd = $request->input('bankslistadd', false);
         $bankslistedit = $request->input('bankslistedit', false);
         $bankslistdelete = $request->input('bankslistdelete', false);

         $bankaccountsview = $request->input('bankaccountsview', false);
         $bankaccountsadd = $request->input('bankaccountsadd', false);
         $bankaccountsedit = $request->input('bankaccountsedit', false);
         $bankaccountsdelete = $request->input('bankaccountsdelete', false);

         $cashaccountsview = $request->input('cashaccountsview', false);
         $cashaccountsadd = $request->input('cashaccountsadd', false);
         $cashaccountsedit = $request->input('cashaccountsedit', false);
         $cashaccountsdelete = $request->input('cashaccountsdelete', false);

         $assetsview = $request->input('assetsview', false);
         $assetsadd = $request->input('assetsadd', false);
         $assetsedit = $request->input('assetsedit', false);
         $assetsdelete = $request->input('assetsdelete', false);

         $liabilitiesview = $request->input('liabilitiesview', false);
         $liabilitiesadd = $request->input('liabilitiesadd', false);
         $liabilitiesedit = $request->input('liabilitiesedit', false);
         $liabilitiesdelete = $request->input('liabilitiesdelete', false);

         $expenseview = $request->input('expenseview', false);
         $expenseadd = $request->input('expenseadd', false);
         $expenseedit = $request->input('expenseedit', false);
         $expensedelete = $request->input('expensedelete', false);

         $incomeview = $request->input('incomeview', false);
         $incomeadd = $request->input('incomeadd', false);
         $incomeedit = $request->input('incomeedit', false);
         $incomedelete = $request->input('incomedelete', false);

         $subtypesview = $request->input('subtypesview', false);
         $subtypesadd = $request->input('subtypesadd', false);
         $subtypesedit = $request->input('subtypesedit', false);
         $subtypesdelete = $request->input('subtypesdelete', false);

         $cpaymentsview = $request->input('cpaymentsview', false);
         $cpaymentsadd = $request->input('cpaymentsadd', false);

         $bpaymentsview = $request->input('bpaymentsview', false);
         $bpaymentsadd = $request->input('bpaymentsadd', false);

         $creceiptsview = $request->input('creceiptsview', false);
         $creceiptsadd = $request->input('creceiptsadd', false);

         $breceiptsview = $request->input('breceiptsview', false);
         $breceiptsadd = $request->input('breceiptsadd', false);

         $jvview = $request->input('jvview', false);
         $jvadd = $request->input('jvadd', false);
         
         $cashledgersview = $request->input('cashledgersview', false);

         $bankledgersview = $request->input('bankledgersview', false);

         $expenseledgersview = $request->input('expenseledgersview', false);

         $liabilitiesledgersview = $request->input('liabilitiesledgersview', false);

         $incomeledgersview = $request->input('incomeledgersview', false);

         $customerledgersview = $request->input('customerledgersview', false);

         $supplierledgersview = $request->input('supplierledgersview', false);

         $purchaseledgersview = $request->input('purchaseledgersview', false);

         $salesledgersview = $request->input('salesledgersview', false);

         $trialbalanceview = $request->input('trialbalanceview', false);

         $incomestatementview = $request->input('incomestatementview', false);

         $suppliersview = $request->input('suppliersview', false);
         $suppliersadd = $request->input('suppliersadd', false);
         $suppliersedit = $request->input('suppliersedit', false);
         $suppliersdelete = $request->input('suppliersdelete', false);

         $productsview = $request->input('productsview', false);
         $productsadd = $request->input('productsadd', false);
         $productsedit = $request->input('productsedit', false);
         $productsdelete = $request->input('productsdelete', false);

         $stockview = $request->input('stockview', false);
         $stockedit = $request->input('stockedit', false);

         $grossprofitview = $request->input('grossprofitview', false);

         $dbbackupview = $request->input('dbbackupview', false);

         $purchaseview = $request->input('purchaseview', false);

         $salesview = $request->input('salesview', false);

         $serviceview = $request->input('serviceview', false);

         $quotesview = $request->input('quotesview', false);

         $ordersview = $request->input('ordersview', false);

         $cancelledordersview = $request->input('cancelledordersview', false);
         

        \DB::update('UPDATE users SET 
            name = ?, 
            email = ?, 
            role = ?, 

            customerview = ?, 
            customeradd = ?, 
            customeredit = ?, 
            customerdelete = ?, 

            companyview = ?, 
            companyadd = ?, 
            companyedit = ?, 
            companydelete = ?, 

            cpersonview = ?, 
            cpersonadd = ?, 
            cpersonedit = ?, 
            cpersondelete = ?,

            assetledgersview = ?, 

            bankslistview = ?, 
            bankslistadd = ?, 
            bankslistedit = ?, 
            bankslistdelete = ?,

            bankaccountsview = ?, 
            bankaccountsadd = ?, 
            bankaccountsedit = ?, 
            bankaccountsdelete = ?, 

            cashaccountsview = ?, 
            cashaccountsadd = ?, 
            cashaccountsedit = ?, 
            cashaccountsdelete = ?, 

            assetsview = ?, 
            assetsadd = ?, 
            assetsedit = ?, 
            assetsdelete = ?, 

            liabilitiesview = ?, 
            liabilitiesadd = ?, 
            liabilitiesedit = ?, 
            liabilitiesdelete = ?, 

            expenseview = ?, 
            expenseadd = ?, 
            expenseedit = ?, 
            expensedelete = ?, 

            incomeview = ?, 
            incomeadd = ?, 
            incomeedit = ?, 
            incomedelete = ?,

            subtypesview = ?, 
            subtypesadd = ?, 
            subtypesedit = ?, 
            subtypesdelete = ?,

            cpaymentsview = ?, 
            cpaymentsadd = ?, 

            bpaymentsview = ?, 
            bpaymentsadd = ?, 

            creceiptsview = ?, 
            creceiptsadd = ?, 

            breceiptsview = ?, 
            breceiptsadd = ?, 

            jvview = ?, 
            jvadd = ?, 

            cashledgersview = ?,

            bankledgersview = ?, 

            expenseledgersview = ?,

            liabilitiesledgersview = ?, 

            incomeledgersview = ?, 

            customerledgersview = ?, 

            supplierledgersview = ?,

            purchaseledgersview = ?, 

            salesledgersview = ?, 

            trialbalanceview = ?, 

            incomestatementview = ?, 

            suppliersview = ?, 
            suppliersadd = ?, 
            suppliersedit = ?, 
            suppliersdelete = ?,

            productsview = ?, 
            productsadd = ?, 
            productsedit = ?, 
            productsdelete = ?, 

            stockview = ?, 
            stockedit = ?,

            grossprofitview = ?, 

            dbbackupview = ?,

            purchaseview = ?, 

            salesview = ?, 

            serviceview = ?,

            quotesview = ?, 
            ordersview = ?, 
            cancelledordersview = ?

             WHERE id = ?', 

             [$request->input('name'), 
             $request->input('email'), 
             $request->input('role'), 

             $customerview, 
             $customeradd, 
             $customeredit, 
             $customerdelete, 

             $companyview, 
             $companyadd, 
             $companyedit, 
             $companydelete, 

             $cpersonview, 
             $cpersonadd, 
             $cpersonedit, 
             $cpersondelete, 

             $assetledgersview,

             $bankslistview, 

             $bankslistadd, 
             $bankslistedit, 
             $bankslistdelete,

             $bankaccountsview, 
             $bankaccountsadd, 
             $bankaccountsedit, 
             $bankaccountsdelete,

             $cashaccountsview, 
             $cashaccountsadd, 
             $cashaccountsedit, 
             $cashaccountsdelete, 

             $assetsview, 
             $assetsadd, 
             $assetsedit, 
             $assetsdelete, 

             $liabilitiesview, 
             $liabilitiesadd, 
             $liabilitiesedit, 
             $liabilitiesdelete, 

             $expenseview, 
             $expenseadd, 
             $expenseedit, 
             $expensedelete,

             $incomeview, 
             $incomeadd, 
             $incomeedit, 
             $incomedelete, 

             $subtypesview, 
             $subtypesadd, 
             $subtypesedit, 
             $subtypesdelete, 

             $cpaymentsview, 
             $cpaymentsadd, 

             $bpaymentsview, 
             $bpaymentsadd,

             $creceiptsview, 
             $creceiptsadd, 

             $breceiptsview, 
             $breceiptsadd, 

             $jvview, 
             $jvadd, 

             $cashledgersview, 

             $bankledgersview,

             $expenseledgersview,

             $liabilitiesledgersview,

             $incomeledgersview, 

             $customerledgersview,

             $supplierledgersview,

             $purchaseledgersview,

             $salesledgersview, 

             $trialbalanceview, 

             $incomestatementview, 

             $suppliersview, 
             $suppliersadd, 
             $suppliersedit, 
             $suppliersdelete,

             $productsview, 
             $productsadd, 
             $productsedit, 
             $productsdelete, 

             $stockview, 
             $stockedit, 

             $grossprofitview, 

             $dbbackupview, 

             $purchaseview, 

             $salesview, 

             $serviceview, 

             $quotesview, 
             $ordersview, 
             $cancelledordersview, 
             $request->input('id')]);

        return redirect('users')->with('success','User has been updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('users')->with('success','User has been  Deleted!');
    }
}
