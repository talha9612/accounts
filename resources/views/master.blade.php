<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Star Automation</title>

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon-precomposed" href="images/star.png">
    <link rel="icon" sizes="192x192" href="images/star.png">
    <link rel="shortcut icon" href="images/star.png">
    <link rel="stylesheet" href="{{asset('css/material-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-material-design.min.css')}}"/>
    <link href="{{asset('assets/styles.css')}}" rel="stylesheet"/>
    <script src="{{asset('assets/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('assets/jquery-ui.min.js')}}"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/jquery-ui-1.11.2.css')}}">

    <style type="text/css">
    li.mhover:hover, li.mhover:active {background: #00897b;}
    .productsClass {
      height: 270px;
      overflow-y: auto;
      overflow-x: hidden;
    }
    .horizontal {
      height: 300px;
      overflow-y: auto;
      overflow-x: hidden;
    }
    .ui-autocomplete {
    font-size: 14px;
    height: 300px;
    overflow-y: scroll;
    }
    #fiscalyear{
      visibility: hidden;
    }

    </style>
</head>
<body>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <!-- Left Side Of Navbar -->
    <ul class="navbar-nav mr-auto">
       <li class="nav-item active">
                            <a class="nav-link" href="{{action('Controller@index')}}">Home <span class="sr-only">(current)</span></a>
                          </li>
      </ul>
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
          </ul>
  </div>
<div class="bmd-layout-container bmd-drawer-f-l">
  <header class="bmd-layout-header">
    <div class="navbar navbar-light bg-faded">
      <button class="navbar-toggler text-dark" type="button" data-toggle="drawer" data-target="#dw-p1">
        <span class="sr-only">Toggle drawer</span>
        <i class="material-icons">menu</i>
      </button>
      <img src="{{asset('images/star.png')}}" style="background-color: white;" width="12%" height="auto">
        <nav class="navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
       <!-- Authentication Links -->
                        @guest
                            <li class="nav-item bg-dark">
                                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <!--  <li class="nav-item bg-dark">
                                @if (Route::has('register'))
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li> -->
                        @else
                          <li class="nav-item active">
                            <a class="nav-link" href="{{action('Controller@index')}}">Home <span class="sr-only">(current)</span></a>
                          </li>
                           <?php
                            if(isset(Auth::user()->jvadd) && Auth::user()->jvadd == '1')
                                { ?>
                          <li class="nav-item">
                            <a class="nav-link" href="{{action('JvController@create')}}">J-Vouchers</a>
                          </li>
                          <?php } else {} ?>
                           <?php
                            if(isset(Auth::user()->cpaymentsadd) && Auth::user()->cpaymentsadd == '1')
                                { ?>
                          <li class="nav-item">
                            <a class="nav-link" href="{{action('CashtransactionController@create')}}">Cash Payment</a>
                          </li>
                           <?php } else {} ?>
                             <?php
                            if(isset(Auth::user()->creceiptsadd) && Auth::user()->creceiptsadd == '1')
                                { ?>
                          <li class="nav-item">
                            <a class="nav-link" href="{{action('CashreceiptController@create')}}">Cash Receipt</a>
                          </li>
                           <?php } else {} ?>
                              <?php
                            if(isset(Auth::user()->bpaymentsadd) && Auth::user()->bpaymentsadd == '1')
                                { ?>
                          <li class="nav-item">
                            <a class="nav-link" href="{{action('BanktransactionController@create')}}">Bank Payment</a>
                          </li>
                           <?php } else {} ?>
                           <?php
                          if(isset(Auth::user()->breceiptsadd) && Auth::user()->breceiptsadd == '1')
                                { ?>
                          <li class="nav-item">
                            <a class="nav-link" href="{{action('BankreceiptController@create')}}">Bank Receipt</a>
                          </li>
                           <?php } else {} ?>

                          <li class="nav-item dropdown bg-dark">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}  <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                      </ul>
                    </div>
                  </nav>
  </header>
  <div id="dw-p1" class="bmd-layout-drawer" style="background-color: #E1E8ED">
    <header class="bg-primary">
      <a class="navbar-brand text-white" href="https://www.starautomation.net">STAR AUTOMATION</a>
    </header>
      @guest
       @else
     <?php
        if(isset(Auth::user()->customerview) && Auth::user()->customerview == '1')
          {  ?>
      <p align="center" style="color:#E1E8ED" class="bg-dark">CUSTOMER MANAGEMENT</p>
    <ul class="nav flex-column">
    <li class="dropdown-item">
      <a style="text-decoration: none" href="{{action('DirectfarmerController@index')}}" aria-expanded="false">
      <i class="material-icons text-rose">
        person</i>
       <b> Customer </b>
      </a>
    </li>
    <?php }  else {} ?>
    <li class="dropdown-item">
     <a style="text-decoration: none" data-toggle="collapse" href="#crm" aria-expanded="false" aria-controls="crm">
      <i class="material-icons text-dark">person</i>
      <b>Customer Relationship</b>
    </a>
    <div class="collapse" id="crm">
        <?php
            if(isset(Auth::user()->companyview) && Auth::user()->companyview == '1')
                { ?>
        <a href="{{action('CompanyController@index')}}" class="dropdown-item text-primary"> Companies</a>
         <?php  } else { } ?>
          <?php
            if(isset(Auth::user()->cpersonview) && Auth::user()->cpersonview == '1')
                { ?>
        <a href="{{action('CpersonController@index')}}" class="dropdown-item text-primary"> Contact Persons</a>
          <?php  } else { } ?>
    </div>
  </li>
<li class="dropdown-item">
     <a style="text-decoration: none" data-toggle="collapse" href="#quotes" aria-expanded="false" aria-controls="quotes">
      <i class="material-icons text-dark">dvr</i>
      <b>Quotations</b>
    </a>
    <div class="collapse" id="quotes">
        <?php
            if(isset(Auth::user()->quotesview) && Auth::user()->quotesview == '1')
                { ?>
        <a style="text-decoration: none" href="{{action('QuotationController@index')}}" class="dropdown-item text-primary">
          Quotations
      </a>
         <?php  } else { } ?>
          <?php
            if(isset(Auth::user()->ordersview) && Auth::user()->ordersview == '1')
                { ?>
         <a style="text-decoration: none" href="{{action('OrdersController@index')}}" class="dropdown-item text-primary">
          Received Orders
      </a>
          <?php  } else { } ?>
           <?php
            if(isset(Auth::user()->cancelledordersview) && Auth::user()->cancelledordersview == '1')
                { ?>
        <a style="text-decoration: none" href="{{action('CnordersController@index')}}" class="dropdown-item text-primary">
          Cancelled Quotations
      </a>
          <?php  } else { } ?>
    </div>
  </li>
    <li class="dropdown-item">
    <a style="text-decoration: none" data-toggle="collapse" href="#qreports" aria-expanded="false" aria-controls="qreports">
    <i class="material-icons text-dark">assignment</i>
    <b>Quotation Reports</b>
    </a>
    <div class="collapse" id="qreports">
    <a style="text-decoration: none" href="{{action('QuotationController@show',1)}}" class="dropdown-item text-primary">
          DIB Report
    </a>
    <a style="text-decoration: none" href="{{action('QuotationController@showSreport',1)}}" class="dropdown-item text-primary">
          Summary Report
    </a>
    <a style="text-decoration: none" href="{{action('QuotationController@edit',1)}}" class="dropdown-item text-primary">
          Model Search
    </a>
    </div>
    </li>
      <br>
    <p align="center" style="color:#E1E8ED" class="bg-dark">ACCOUNTS MANAGEMENT</p>
    <li class="dropdown-item">
     <a style="text-decoration: none" data-toggle="collapse" href="#ac" aria-expanded="false" aria-controls="ac">
      <i class="material-icons text-dark">attach_money</i>
      <b>Accounts Maintenance</b>
    </a>
    <div class="collapse" id="ac">
      <?php
            if(isset(Auth::user()->bankslistview) && Auth::user()->bankslistview == '1')
                { ?>
        <a href="{{action('BankController@index')}}" class="dropdown-item text-primary"> Banks List</a>
            <?php  } else { } ?>
        <?php
          if(isset(Auth::user()->bankaccountsview) && Auth::user()->bankaccountsview == '1')
            { ?>
        <a href="{{action('AccountsbksController@index')}}" class="dropdown-item text-primary"> Bank Accounts</a>
           <?php  } else { } ?>
        <?php
        if(isset(Auth::user()->cashaccountsview) && Auth::user()->cashaccountsview == '1')
          { ?>
        <a href="{{action('CashinhandController@index')}}" class="dropdown-item text-primary"> Cash Accounts</a>
          <?php  } else { } ?>

         <?php
            if(isset(Auth::user()->assetsview) && Auth::user()->assetsview == '1')
                { ?>
        <a href="{{action('AssetController@index')}}" class="dropdown-item text-primary"> Assets List</a>
         <?php  } else { } ?>

         <?php
            if(isset(Auth::user()->liabilitiesview) && Auth::user()->liabilitiesview == '1')
                { ?>
        <a href="{{action('LiabilitiesController@index')}}" class="dropdown-item text-primary"> Liabilities List</a>
         <?php  } else { } ?>

          <?php
            if(isset(Auth::user()->expenseview) && Auth::user()->expenseview == '1')
                { ?>
        <a href="{{action('ExpenseController@index')}}" class="dropdown-item text-primary"> Expense List</a>
          <?php  } else { } ?>

           <?php
            if(isset(Auth::user()->incomeview) && Auth::user()->incomeview == '1')
                { ?>
        <a href="{{action('IncomeController@index')}}" class="dropdown-item text-primary"> Income List</a>
         <?php  } else { } ?>

         <?php
            if(isset(Auth::user()->subtypesview) && Auth::user()->subtypesview == '1')
                { ?>
        <a href="{{action('ExptypeController@index')}}" class="dropdown-item text-primary"> Sub-Types</a>
         <?php  } else { } ?>
    </div>
  </li>
  <?php
        if(isset(Auth::user()->cpaymentsview) && Auth::user()->cpaymentsview == '1')
                { ?>
    <li class="dropdown-item">
      <a style="text-decoration: none" href="{{action('CashtransactionController@index')}}" aria-expanded="false">
        <i class="material-icons text-dark card-icon">monetization_on</i>
          <b>Cash Payments</b>
        </a>
    </li>
    <?php  } else { } ?>
     <?php
        if(isset(Auth::user()->bpaymentsview) && Auth::user()->bpaymentsview == '1')
                { ?>
    <li class="dropdown-item">
    <a style="text-decoration: none" href="{{action('BanktransactionController@index')}}" aria-expanded="false">
      <i class="material-icons text-dark">account_balance</i>
        <b>Bank Payments</b>
      </a>
    </li>
    <?php  } else { } ?>
     <?php
        if(isset(Auth::user()->creceiptsview) && Auth::user()->creceiptsview == '1')
                { ?>
    <li class="dropdown-item">
    <a style="text-decoration: none" href="{{action('CashreceiptController@index')}}" aria-expanded="false">
     <i class="material-icons text-dark">assignment</i>
        <b>Cash Receipts</b>
      </a>
    </li>
     <?php  } else { } ?>
    <?php
      if(isset(Auth::user()->breceiptsview) && Auth::user()->breceiptsview == '1')
                { ?>
    <li class="dropdown-item">
    <a style="text-decoration: none" href="{{action('BankreceiptController@index')}}" aria-expanded="false">
      <i class="material-icons text-dark">receipt</i>
        <b>Bank Receipts</b>
      </a>
    </li>
     <?php  } else { } ?>
      <?php
        if(isset(Auth::user()->jvview) && Auth::user()->jvview == '1')
                { ?>
    <li class="dropdown-item">
   <a style="text-decoration: none"  href="{{action('JvController@index')}}" aria-expanded="false">
    <i class="material-icons text-dark">library_books</i>
        <b>Journal Vouchers</b>
      </a>
    </li>
    <?php  } else { } ?>
    <li class="dropdown-item">
     <a style="text-decoration: none" data-toggle="collapse" href="#ledgers" aria-expanded="false" aria-controls="ledgers">
      <i class="material-icons text-dark">chrome_reader_mode</i>
      <b>Ledgers</b>
    </a>
    <div class="collapse" id="ledgers">
        <?php
        if(isset(Auth::user()->cashledgersview) && Auth::user()->cashledgersview == '1')
                { ?>
        <a href="{{action('CashledgerController@index')}}" class="dropdown-item text-primary"> Cash Ledger</a>
        <?php  } else { } ?>
        <?php
        if(isset(Auth::user()->bankledgersview) && Auth::user()->bankledgersview == '1')
                { ?>
        <a href="{{action('BankledgerController@index')}}" class="dropdown-item text-primary"> Bank Ledger</a>
        <?php  } else { } ?>
        <?php
        if(isset(Auth::user()->assetledgersview) && Auth::user()->assetledgersview == '1')
          { ?>
        <a href="{{action('AssetledgerController@index')}}" class="dropdown-item text-primary"> Assets Ledger</a>
        <?php  } else {  } ?>
        <?php
        if(isset(Auth::user()->expenseledgersview) && Auth::user()->expenseledgersview == '1')
          { ?>
        <a href="{{action('ExpenseledgerController@index')}}" class="dropdown-item text-primary"> Expense Ledger</a>
         <?php  } else {  } ?>
         <?php
        if(isset(Auth::user()->liabilitiesledgersview) && Auth::user()->liabilitiesledgersview == '1')
          { ?>
        <a href="{{action('LiabilityledgerController@index')}}" class="dropdown-item text-primary"> Liabilities Ledger</a>
         <?php  } else {  } ?>
         <?php
        if(isset(Auth::user()->incomeledgersview) && Auth::user()->incomeledgersview == '1')
          { ?>
        <a href="{{action('IncomeledgerController@index')}}" class="dropdown-item text-primary"> Income Ledger</a>
        <?php  } else {  } ?>
         <?php
        if(isset(Auth::user()->customerledgersview) && Auth::user()->customerledgersview == '1')
          { ?>
        <a href="{{action('FarmerledgerController@index')}}" class="dropdown-item text-primary"> Customer Ledger</a>
        <?php  } else {  } ?>
         <?php
        if(isset(Auth::user()->supplierledgersview) && Auth::user()->supplierledgersview == '1')
          { ?>
        <a href="{{action('SupplierledgerController@index')}}" class="dropdown-item text-primary"> Supplier Ledger</a>
        <?php  } else {  } ?>
         <?php
        if(isset(Auth::user()->purchaseledgersview) && Auth::user()->purchaseledgersview == '1')
          { ?>
        <a href="{{action('PrledgerController@index')}}" class="dropdown-item text-primary"> Purchase Ledger</a>
         <?php  } else {  } ?>
          <?php
        if(isset(Auth::user()->salesledgersview) && Auth::user()->salesledgersview == '1')
          { ?>
        <a href="{{action('SaleledgerController@index')}}" class="dropdown-item text-primary"> Sales Ledger</a>
         <?php  } else {  } ?>
    </div>
  </li>
     <li class="dropdown-item">
        <a style="text-decoration: none" data-toggle="collapse" href="#trialbalance" aria-expanded="false" aria-controls="ledgers">
         <i class="material-icons text-dark">chrome_reader_mode</i>
         <b>Trial Balance</b>
       </a>
       <div class="collapse" id="trialbalance">
        <?php
        if(isset(Auth::user()->trialbalanceview) && Auth::user()->trialbalanceview == '1')
          { ?>
           <a href="{{action('TrialbalanceController@index')}}"class="dropdown-item text-primary"> Opening Balance</a>
          
           
          
           <a href="{{action('TrialbalanceController@ClosingTrialBalance')}}" class="dropdown-item text-primary"> Closing Balance</a>
          
           <?php  } else { } ?>
       </div>
     </li>

     <?php
        if(isset(Auth::user()->incomestatementview) && Auth::user()->incomestatementview == '1')
          { ?>
       <li class="dropdown-item">
   <a style="text-decoration: none"  href="{{action('IncomestatementController@index')}}" aria-expanded="false">
    <i class="material-icons text-dark">library_books</i>
        <b>Income Statement</b>
      </a>
    </li>
      <?php  } else {  } ?>


       <li class="dropdown-item">
   <a style="text-decoration: none"  href="closing/closing_year" aria-expanded="false">
    <i class="material-icons text-dark">library_books</i>
        <b>Closing Fiscal Year</b>
      </a>
    </li>

<!--<li class="dropdown-item">-->
<!--   <a style="text-decoration: none"  href="obalance/fetch_o_balance" aria-expanded="false">-->
<!--    <i class="material-icons text-dark">library_books</i>-->
<!--        <b>Closing Obalance</b>-->
<!--      </a>-->
<!--    </li>-->

  <br>
    <p align="center" style="color:#E1E8ED" class="bg-dark">INVENTORY MANAGEMENT</p>

     <?php
        if(isset(Auth::user()->suppliersview) && Auth::user()->suppliersview == '1')
          { ?>
    <li class="dropdown-item" >
    <a style="text-decoration: none"  href="{{action('SupplierController@index')}}" aria-expanded="false">
      <i class="material-icons text-dark">local_shipping</i>
      <b>Suppliers</b>
    </a>
  </li>
  <?php  } else {  } ?>
  <?php
        if(isset(Auth::user()->productsview) && Auth::user()->productsview == '1')
          { ?>
    <li class="dropdown-item">
     <a  style="text-decoration: none" href="{{action('ProductController@index')}}" aria-expanded="false">
      <i class="material-icons text-dark">view_module</i>
      <b>Products</b>
    </a>
  </li>
  <?php  } else {  } ?>
  <?php
        if(isset(Auth::user()->stockview) && Auth::user()->stockview == '1')
          { ?>
  <li class="dropdown-item">
    <a style="text-decoration: none"  href="{{action('StockController@index')}}" aria-expanded="false">
      <i class="material-icons text-dark">store</i>
      <b>Stock</b>
    </a>
  </li>
   <?php  } else {  } ?>
   <?php
  if(isset(Auth::user()->purchaseview) && Auth::user()->purchaseview == '1')
      { ?>
  <li class="dropdown-item">
    <a style="text-decoration: none" data-toggle="collapse" href="#purchase" aria-expanded="false" aria-controls="purchase">
      <i class="material-icons text-dark">shopping_cart</i>
      <b>Purchase</b>
    </a>
    <div class="collapse" id="purchase">
        <a href="{{action('PrequisitionController@index')}}" class="dropdown-item text-primary"> Purchase Requisitions</a>
        <a href="{{action('PorderController@index')}}" class="dropdown-item text-primary"> Purchase Orders (local)</a>
        <a href="{{action('PorderController@importPo')}}" class="dropdown-item text-primary"> Purchase Orders (import)</a>
        <a href="{{action('GateinwardController@index')}}" class="dropdown-item text-primary"> Inward Gate Pass</a>
        <a href="{{action('MrreportController@index')}}" class="dropdown-item text-primary"> Material Receiving Report</a>
        <a href="{{action('ScvaluationController@index')}}" class="dropdown-item text-primary"> Stock Cost Valuations </a>
    </div>
  </li>
   <?php  } else {  } ?>
   <?php
  if(isset(Auth::user()->salesview) && Auth::user()->salesview == '1')
      { ?>
  <li class="dropdown-item">
    <a style="text-decoration: none" data-toggle="collapse" href="#sales" aria-expanded="false" aria-controls="sales">
      <i class="material-icons text-dark">poll</i>
      <b>Sales</b>
    </a>
    <div class="collapse" id="sales">
      <a href="{{action('SrequisitionController@index')}}" class="dropdown-item text-primary"> Sale Requisitions</a>
            <a href="{{action('SquotationController@index')}}" class="dropdown-item text-primary"> Sales Invoice</a>
            <a href="{{action('GateoutwardController@index')}}" class="dropdown-item text-primary"> Outward Gate Pass</a>
            <a href="{{action('SaleController@index')}}" class="dropdown-item text-primary"> Sales</a>
            <a href="{{action('SalereturnController@index')}}" class="dropdown-item text-primary"> Sale Returns</a>
    </div>
  </li>
   <?php  } else {  } ?>
   <?php
        if(isset(Auth::user()->grossprofitview) && Auth::user()->grossprofitview == '1')
          { ?>
   <li class="dropdown-item">
    <a style="text-decoration: none" href="{{action('GpController@index')}}" aria-expanded="false">
      <i class="material-icons text-dark">receipt</i>
        <b>Gross Profit</b>
      </a>
    </li>
     <?php  } else {  } ?>
  <?php
        if(isset(Auth::user()->serviceview) && Auth::user()->serviceview == '1')
          { ?>
  <li class="dropdown-item">
    <a style="text-decoration: none" data-toggle="collapse" href="#services" aria-expanded="false" aria-controls="services">
      <i class="material-icons text-dark">shopping_cart</i>
      <b>Services</b>
    </a>
    <div class="collapse" id="services">
      <a href="{{action('SrvrequisitionController@index')}}" class="dropdown-item text-primary"> Service Requisitions</a>
      <a href="{{action('SrvinvoiceController@index')}}" class="dropdown-item text-primary"> Service Invoice</a>
      <a href="{{action('SrvgrossprofitController@index')}}" class="dropdown-item text-primary"> Gross Profit</a>
    </div>
  </li>
   <?php  } else {  } ?>
  <?php
  if(isset(Auth::user()->role) && Auth::user()->role == 'Admin')
        {
        echo '
    <p align="center" style="color:#E1E8ED" class="bg-dark">USER MANAGEMENT</p>
    <li class="dropdown-item">
    <a style="text-decoration: none" data-toggle="collapse" href="#user" aria-expanded="false" aria-controls="sales">
      <i class="material-icons text-dark">poll</i>
      <b>Users</b>
    </a>
    <div class="collapse" id="user">
      <a href="'.route('register').'" class="dropdown-item text-primary"> Register new User</a>
      <a href="'.action('UserController@index').'" class="dropdown-item text-primary"> Users List</a>
    </div>
  </li>
  ';
        }
        else{}
  ?>
   <?php
        if(isset(Auth::user()->dbbackupview) && Auth::user()->dbbackupview == '1')
          { ?>
   <li class="dropdown-item">
    <a style="text-decoration: none" href="{{action('Controller@backup')}}" aria-expanded="false">
     <i class="material-icons text-dark">cloud_download</i>
        <b>DB Back-up</b>
      </a>
    </li>
  <?php }
else {}
    ?>
     <li class="dropdown-item">
        <a style="text-decoration: none" href="{{url('/year')}}" aria-expanded="false">
          <i class="material-icons text-dark">receipt</i>
            <b>Add Year</b>
          </a>
        </li>
    </ul>
    @endguest
  </div>
  <main class="bmd-layout-content">
      <div style="margin-left: 2%;margin-right: 1%;margin-bottom: 3%">
    <div class="container">

       @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif
      @if (\Session::has('success'))
      <div class="alert alert-success">
          <p>{{ \Session::get('success') }}</p>
      </div>
      @endif
      @if (\Session::has('warning'))
      <div class="alert alert-warning">
          <p>{{ \Session::get('warning') }}</p>
      </div>
      @endif
    </div>
     @yield('content')
   </div>
  <footer class="fixed-bottom">
      <md-toolbar class="md-scroll-shrink">
        <div layout="row" layout-align="center center" align="center" class="bg-primary text-white" flex>
        Copyright© <?php
        $copyYear = 2018;
        $curYear = date('Y');
        echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
        ?>
Star Automation <small class="text-white">(Developed by IT Department <a href="https://www.starautomation.net" style="color: white" target="new">Star Automation)</a></small>
        </div>
      </md-toolbar>
  </footer>
  </main>
</div>
</body>
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap-material-design.js')}}"></script>
    <script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
    <script src="{{asset('assets/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/material.min.js')}}"></script>
    <script>
    $(document).ready(function() {
        $('#datatables').DataTable({
          dom: 'lBfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
          "pagingType": "full_numbers",
          "aaSorting": [[ 0, "desc" ]],
          "lengthMenu": [
            [50, 100, 150, -1],
            [50, 100, 150, "All"]
          ],
          responsive: true,
          language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records",
          },
        });
        var table = $('#datatable').DataTable();
        table.on('click', '.edit', function() {
          $tr = $(this).closest('tr');
          var data = table.row($tr).data();
          alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
        });
        table.on('click', '.remove', function(e) {
          $tr = $(this).closest('tr');
          table.row($tr).remove().draw();
          e.preventDefault();
        });
        table.on('click', '.like', function() {
          alert('You clicked on Like button');
        });
    });
    </script>
    <script type="text/javascript">
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 2000);
    </script>
</html>
