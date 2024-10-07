@extends('master')
@section('content')
<?php $totalstock = 0; ?>
<?php foreach ($stock as $stocks):?>
<?php $totalstock += $stocks->ss_costunit * $stocks->ss_quantity;
?>
<?php endforeach; ?>
<?php $totaladmin = 0; ?>
<?php foreach ($adminexpense as $adminexpnses):?>
<?php $totaladmin += $adminexpnses->h_balance;
?>
<?php endforeach; ?>
<?php $totalmark = 0; ?>
<?php foreach ($markexpense as $markexpnses):?>
<?php $totalmark += $markexpnses->h_balance;
?>
<?php endforeach; ?>
<?php $totalcog = 0; ?>
<?php foreach ($cogexpense as $cogexpnses):?>
<?php $totalcog += $cogexpnses->h_balance;
?>
<?php endforeach; ?>
    <!-- WORK AREA START -->
    <div class="container-fluid" style="background-color: #DEB887">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats" style="background-color: black;border-radius: 5px">
                    <div class="card-header card-header-warning card-header-icon">
                        <a data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <!--  <p class="card-category text-white" style="text-align: left;">Financial Year</p> -->
                        </a>
                        <?php foreach ($fnl as $fnls):?>
                        <b class="card-title text-white"><input type="text" name="sales" id="sales"
                                class="form-control text-white" value="Year: <?php echo $fnls->fn_name; ?>"
                                style="background-color: black;font-size: 12px" readonly />
                        </b>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="border-radius: 5px;background-color: #F5DEB3">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <canvas id="barChart"></canvas>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <canvas id="barChart2"></canvas>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <!-- <canvas id="labelChart"></canvas> -->
                <canvas id="lineChart"></canvas>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <!-- <canvas id="labelChart"></canvas> -->
                <canvas id="lineChart2"></canvas>
            </div>
        </div>
   <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-2 col-md-4 col-sm-4">
                    <div class="card card-stats" style="background-color: black;border-radius: 5px">
                        <div class="card-header card-header-warning card-header-icon">
                            <a data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                aria-controls="collapseOne">
                                <p class="card-category text-white" style="text-align: center;">Select Year</p>
                            </a>
                            <form method="post" action="{{ url('home') }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-6 p-0">
                                        <select class="form-control text-white" type="select" id="fyear" required
                                            name="fyear" style="background-color: black;font-size: 12px">
                                            @foreach ($years as $year)
                                                <option value="{{ $year->year_name }}">{{ $year->year_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="submit" name="submit" value="save"
                                            class="btn btn-sm bg-primary btn-primary text-white">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php $salesthismonth = 0;
                $jvdebitamount = 0;
                $jvcreditamount = 0;
                $totaladvance = 0;
                $totalservice = 0; ?>
    
                <?php foreach ($monthlysales as $monthlysale):?>
                <?php $salesthismonth += $monthlysale->sl_grandtotal; ?>
                <?php endforeach; ?>
    
                <?php foreach ($monthlyservices as $monthlyservice):?>
                <?php $totalservice += $monthlyservice->svi_grandtotal; ?>
                <?php endforeach; ?>
    
                <?php foreach ($jvdebit as $jvdebits):?>
                <?php $jvdebitamount += $jvdebits->d; ?>
                <?php endforeach; ?>
    
                <?php foreach ($jvcredit as $jvcredits):?>
                <?php $jvcreditamount += $jvcredits->c; ?>
                <?php endforeach; ?>
    
                <?php $totaladvance = $jvcreditamount - $jvdebitamount; ?>
                <?php $purchasethismonth = 0; ?>
                <?php foreach ($monthlypurchases as $monthlypurchase):?>
                <?php $purchasethismonth += $monthlypurchase->sc_grandtotal; ?>
                <?php endforeach; ?>
                <div class="col-lg-2 col-md-4 col-sm-4">
                    <div class="card card-stats" style="background-color: #00143c;border-radius: 5px">
                        <div class="card-header card-header-warning card-header-icon" style="text-align: center;">
                            <b class="text-white" >Monthly Purchase</b>
                            <p class="card-title text-white"><input type="text" name="sales" id="sales"
                                    class="form-control text-white" value="<?php $subtotal = number_format($purchasethismonth, 0, '.', ',');
                                    echo $subtotal; ?>"
                                    style="background-color: #00143c; text-align: center;" readonly />
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4">
                    <div class="card card-stats" style="background-color: #00143c;border-radius: 5px">
                        <div class="card-header card-header-warning card-header-icon" style="text-align: center;">
                            <b class="text-white">Monthly<br> Sales</b>
                            <p class="card-title text-white"><input type="text" name="sales" id="sales"
                                    class="form-control text-white" value="<?php $subtotal = number_format($salesthismonth + $totalservice, 0, '.', ',');
                                    echo $subtotal; ?>"
                                    style="background-color: #00143c; text-align: center;" readonly />
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4">
                    <div class="card card-stats" style="background-color: #00143c;border-radius: 5px">
                        <div class="card-header card-header-warning card-header-icon" style="text-align: center;">
                            <a>
                                <b class="text-white">Monthly Advance Sales</b>
                            </a>
                            <p class="card-title text-white"><input type="text" name="sales" id="sales"
                                    class="form-control text-white" value="<?php $subtotal = number_format($totaladvance, 0, '.', ',');
                                    echo $subtotal; ?>"
                                    style="background-color: #00143c; text-align: center;" readonly />
                            </p>
                        </div>
                    </div>
                </div>
                <?php $totalsale = 0; ?>
                <?php $totalservice = 0; ?>
    
                <?php foreach ($sales as $sale):?>
                <?php $totalsale += $sale->sl_totalprice; ?>
                <?php endforeach; ?>
                <div class="col-lg-2 col-md-4 col-sm-4">
                    <div class="card card-stats" style="background-color: #00143c;border-radius: 5px">
                        <div class="card-header card-header-info card-header-icon" style="text-align: center;">
                            <b class="text-white" >Admin Mkt Expense</b>
                            <p class="card-title text-white"><input type="text" name="sales" id="sales"
                                    class="form-control text-white" style="background-color: #00143c ; text-align: center;"
                                    value="<?php $subtotal = number_format($adminExpanseSum + $marketingExpanseSum , 0, '.', ',');
                                    echo $subtotal; ?>"readonly /></p>
                        </div>
                        <!--  <div class="card-footer">
                          <div class="stats">
                          </div>
                        </div> -->
                    </div>
                </div>
                 <div class="col-lg-2 col-md-4 col-sm-4">
                    <div class="card card-stats" style="background-color: #00143c;border-radius: 5px">
                        <div class="card-header card-header-info card-header-icon" style="text-align: center;">
                            <b class="text-white" >Cost Of <br/> Goods</b>
                            <p class="card-title text-white"><input type="text" name="sales" id="sales"
                                    class="form-control text-white" style="background-color: #00143c ; text-align: center;"
                                    value="<?php $subtotal = number_format($costOfGoodsSum , 0, '.', ',');
                                    echo $subtotal; ?>"readonly /></p>
                        </div>
                        <!--  <div class="card-footer">
                          <div class="stats">
                          </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
      
        <div class="container">
            <div class="row justify-content-center">
                <?php $totalcash = 0; ?>
                <?php $totalbank = 0; ?>
                <?php foreach ($cashinhands as $cash):?>
                <?php $totalcash += $cash->cih_balance; ?>
                <?php endforeach; ?>
                <?php foreach ($bankaccounts as $bankaccount):?>
                <?php $totalbank += $bankaccount->acc_balance; ?>
                <?php endforeach; ?>
                <div class="col-lg-2 col-md-4 col-sm-4">
                    <div class="card card-stats" style="background-color: #00143c;border-radius: 5px">
                        <div class="card-header card-header-warning card-header-icon" style="text-align: center;">
                            <a data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                aria-controls="collapseOne">
                                <b class="text-white" >Cash/Bank </b>
                            </a>
                            <p class="card-title text-white"><input type="text" name="sales" id="sales"
                                    class="form-control text-white" value="<?php $subtotal = number_format($totalcash + $totalbank, 0, '.', ',');
                                    echo $subtotal; ?>"
                                    style="background-color: #00143c; text-align: center;" readonly />
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 col-sm-4">
                    <div class="card card-stats" style="background-color: #00143c;border-radius: 5px">
                        <div class="card-header card-header-danger card-header-icon" style="text-align: center;">
                            <!--                   <div class="card-icon">
                            <i class="material-icons">receipt</i>
                          </div> -->
                            <b class="text-white" >Stocks</b>
                            <p class="card-title text-white"><input type="text" name="sales" id="sales"
                                    class="form-control text-white" style="background-color: #00143c ; text-align: center;"
                                    value="<?php $subtotal = number_format($totalstock, 0, '.', ',');
                                    echo $subtotal; ?>" readonly /></p>
                        </div>
                        <!--  <div class="card-footer">
                          <div class="stats">
                          </div>
                        </div> -->
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 col-sm-4">
                    <div class="card card-stats" style="background-color: #00143c;border-radius: 5px">
                        <div class="card-header card-header-success card-header-icon" style="text-align: center;">
                            <!--                   <div class="card-icon">
                            <i class="material-icons">monetization_on</i>
                          </div> -->
                            <?php $receivable = 0; ?>
                            <?php foreach ($frbalance as $receivables):?>
                            <?php $receivable += $receivables->fr_balance; ?>
                            <?php endforeach; ?>
                            <b class="text-white" >Receivables</b>
                            <p class="card-title text-white"><input type="text" name="sales" id="sales"
                                    class="form-control text-white" value="<?php $subtotal = number_format($receivable, 0, '.', ',');
                                    echo $subtotal; ?>"
                                    style="background-color: #00143c; text-align: center;" readonly /></p>
                        </div>
                        <!--  <div class="card-footer">
                          <div class="stats">
                          </div>
                        </div> -->
                    </div>
                </div>
                <?php $payables = 0; ?>
                <?php foreach ($suppliers as $supplier):?>
                <?php $payables += $supplier->s_balance; ?>
                <?php endforeach; ?>
                <div class="col-lg-2 col-md-4 col-sm-4">
                    <div class="card card-stats" style="background-color: #00143c;border-radius: 5px">
                        <div class="card-header card-header-danger card-header-icon" style="text-align: center;">
                            <!--                   <div class="card-icon">
                            <i class="material-icons">receipt</i>
                          </div> -->
                            <b class="text-white">Payables</b>
                            <p class="card-title text-white"><input type="text" name="sales" id="sales"
                                    class="form-control text-white" style="background-color: #00143c"
                                    value="<?php $subtotal = number_format($payables, 0, '.', ',');
                                    echo $subtotal; ?>" style="background-color: #00143c; text-align: center;" readonly /></p>
                        </div>
                        <!--  <div class="card-footer">
                          <div class="stats">
                          </div>
                        </div> -->
                    </div>
                </div>
               
    
    
                <?php foreach ($services as $service):?>
                <?php
                if (isset($service) && is_object($service) && property_exists($service, 'svi_grandtotal')) {
                    $totalservice += $service->svi_grandtotal;
                } else {
                }
                
                ?>
                <?php endforeach; ?>
    
    
                <?php foreach ($head as $heads):?>
                <?php $totalsale += $heads->h_balance; ?>
                <?php endforeach; ?>
              
                <div class="col-lg-2 col-md-4 col-sm-4">
                  <div class="card card-stats" style="background-color: #00143c;border-radius: 5px">
                      <div class="card-header card-header-info card-header-icon" style="text-align: center;">
                          <!--                   <div class="card-icon">
                          <i class="material-icons">poll</i>
                        </div> -->
                          <b class="text-white">Net</b>
                          <p class="card-title text-white"><input type="text" name="netprofit" id="netprofit"
                                  class="form-control text-white" style="background-color: #00143c; text-align: center;"
                                  value="<?php $subtotal = number_format($totalcash+ $totalbank+ $totalstock +$receivable- $payables, 0, '.', ',');
                                  echo $subtotal; ?>" readonly /></p>
                      </div>
                      <!--  <div class="card-footer">
                        <div class="stats">
                        </div>
                      </div> -->
                  </div>
              </div>
            </div>
        </div>
      
        <!-- Collapse for Bank/Cash -->
        <div id="accordion" class="col-md-12">
            <div class="card">
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body bg-light col-sm-12">
                        <h5>CASH/BANK ACCOUNTS</h5>
                        <table id="datatables1" class="table-bordered" style="width: 100%">
                            <thead class="bg-dark text-white">
                                <th>Acc Title</th>
                                <th>Acc Balance</th>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($cashinhands as $cashcoll):?>
                                <tr class="table-success">
                                    <td><?php echo $cashcoll->cih_title; ?></td>
                                    <td> <?php $subtotal = number_format($cashcoll->cih_balance, 2, '.', ',');
                                    echo $subtotal; ?> </td>
                                </tr>
                                <?php endforeach; ?>

                                <?php foreach ($bankaccounts as $bankcoll):?>
                                <tr class="table-primary">
                                    <td><?php echo $bankcoll->acc_title; ?></td>
                                    <td> <?php $subtotal = number_format($bankcoll->acc_balance, 2, '.', ',');
                                    echo $subtotal; ?> </td>
                                </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td></td>
                                    <td> Total Cash: <?php $subtotal = number_format($totalcash, 2, '.', ',');
                                    echo $subtotal; ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Total Bank: <?php $subtotal = number_format($totalbank, 2, '.', ',');
                                    echo $subtotal; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <b style="background-color: white">Top Suppliers</b>
                <canvas id="labelChart1"></canvas>
            </div>
            <div class="row col-lg-6 col-md-6 col-sm-6">
                <b style="background-color: white">Top Selling Items</b>
                <canvas id="labelChart"></canvas>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <b style="background-color: white">Top Customers</b>
                <canvas id="customerChart"></canvas>
            </div>
            <div class="row col-lg-3 col-md-3 col-sm-3" style="margin-right: 0;">
                <div class="card" id="farmers" style="background-color: #DEB887">
                    <div class="card-header card-header-tabs card-header-dark" style="background-color: #8c1414">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper bg-dark">
                                <span class="nav-tabs-title">Quotes Received for year <?php echo date('Y'); ?></span>
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive horizontal">
                        <table class="table table-hover">
                            <thead class="text-warning">
                                <tr>
                                    <th>Month</th>
                                    <th>Quotes</th>
                                </tr>
                            </thead>
                            <tfoot></tfoot>
                            <tbody>
                                <?php foreach ($quotes_this_month as $quotes):?>
                                <tr>
                                    <td><?php $monthNum = $quotes->M;
                                    $dateObj = DateTime::createFromFormat('!m', $monthNum);
                                    $monthName = $dateObj->format('F');
                                    echo $monthName; ?></td>
                                    <td><?php echo $quotes->totalq; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row col-lg-3 col-md-3 col-sm-3">
                <div class="card" id="farmers" style="background-color: #DEB887">
                    <div class="card-header card-header-tabs card-header-dark" style="background-color: #8c1414">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper bg-dark">
                                <span class="nav-tabs-title">Orders Received for year <?php echo date('Y'); ?></span>
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive horizontal">
                        <table class="table table-hover">
                            <thead class="text-warning">
                                <tr>
                                    <th>Month</th>
                                    <th>Orders</th>
                                </tr>
                            </thead>
                            <tfoot></tfoot>
                            <tbody>
                                <?php foreach ($orders_this_month as $orders):?>
                                <tr>
                                    <td><?php $monthNum = $orders->M;
                                    $dateObj = DateTime::createFromFormat('!m', $monthNum);
                                    $monthName = $dateObj->format('F');
                                    echo $monthName; ?></td>
                                    <td><?php echo $orders->totalq; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row table-dark" style="border-radius: 8px;">
            <div class="col-lg-6 col-md-12">
                <div class="card" id="today" style="background-color: #DEB887">
                    <div class="card-header card-header-tabs card-header-dark" style="background-color: #8c1414">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper bg-dark">
                                <span class="nav-tabs-title">Payables</span>
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active productsClass" id="profile">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Company</th>
                                            <th>Amount </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $TotalSupplier = 0; ?>
                                        @foreach ($suppliers as $supplier)
                                            <?php
                                            // Convert fr_balance to a numeric value if it's not already
                                            $supplier_balance = (float) $supplier->s_balance;
                                            // Add the balance to the total
                                            $TotalSupplier += $supplier_balance;
                                            ?>
                                            <tr>
                                                <td>{{ $supplier->s_ID }}</td>
                                                <td>{{ $supplier->s_company }}</td>
                                                <td>{{ number_format($supplier->s_balance, 2, '.', ',') }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Total</th>
                                            <th>{{ number_format($TotalSupplier, 2, '.', ',') }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="card" id="farmers" style="background-color: #DEB887">
                    <div class="card-header card-header-tabs card-header-dark" style="background-color: #8c1414">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper bg-dark">
                                <span class="nav-tabs-title">Receivables</span>
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive horizontal">
                        <table class="table table-hover">
                            <thead class="text-warning">
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tfoot></tfoot>
                            <tbody>
                                <?php $TotalCustomer = 0; ?>
                                @foreach ($customers as $customer)
                                    <?php
                                    // Convert fr_balance to a numeric value if it's not already
                                    $fr_balance = (float) $customer->fr_balance;
                                    // Add the balance to the total
                                    $TotalCustomer += $fr_balance;
                                    ?>
                                    <tr>
                                        <td>{{ $customer->fr_ID }}</td>
                                        <td>{{ $customer->fr_name }}</td>
                                        <td>{{ number_format($fr_balance, 2, '.', ',') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Total</th>
                                    <th>{{ number_format($TotalCustomer, 2, '.', ',') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- WORK AREA END -->
    <script src="{{ asset('assets/1023.min.js') }}"></script>
    <script>
        //bar
        var ctxB = document.getElementById("barChart").getContext('2d');
        var myBarChart = new Chart(ctxB, {
            type: 'bar',
            data: {
                labels: ["Cash", "Receivables", "Stock", "Payables"],
                datasets: [{
                    label: '(PKR)',
                    data: [<?php echo $totalcash + $totalbank; ?>, <?php echo $receivable; ?>, <?php echo $totalstock; ?>,
                        <?php echo $payables; ?>
                    ],
                    backgroundColor: [
                        'rgba(0, 100, 140)',
                        'rgba(230, 155, 0)',
                        'rgba(59, 122, 87)',
                        'rgba(160, 35, 35)',
                        'rgba(150, 50, 150)',
                        'rgba(0, 150, 180)'
                    ],
                    borderColor: [
                        'rgba(0, 100, 140)',
                        'rgba(230, 155, 0)',
                        'rgba(59, 122, 87)',
                        'rgba(160, 35, 35)',
                        'rgba(150, 50, 150)',
                        'rgba(0, 150, 180)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    <script>
        //bar
        var ctxB = document.getElementById("barChart2").getContext('2d');
        var myBarChart = new Chart(ctxB, {
            type: 'bar',
            data: {
                labels:["Cost Of Good", "Admin Exp", "Marketing", "Financial"],
                datasets: [{
                    label: '(PKR)',
                    data: [<?php echo $costOfGoodsSum; ?>, <?php echo $adminExpanseSum; ?>, <?php echo $marketingExpanseSum; ?>, <?php echo $financialExpanseSum; ?>,
                    ],
                    backgroundColor: [
                        'rgba(0, 100, 140)',
                        'rgba(230, 155, 0)',
                        'rgba(59, 122, 87)',
                        'rgba(160, 35, 35)',
                        'rgba(150, 50, 150)',
                        'rgba(0, 150, 180)'
                    ],
                    borderColor: [
                        'rgba(0, 100, 140)',
                        'rgba(230, 155, 0)',
                        'rgba(59, 122, 87)',
                        'rgba(160, 35, 35)',
                        'rgba(150, 50, 150)',
                        'rgba(0, 150, 180)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    <?php foreach ($topitem as $topitems):?>
    <?php $mydata[] = $topitems->sl_item; ?>
    <?php $mycount[] = $topitems->c; ?>
    <?php endforeach; ?>

    <?php foreach ($toppayables as $toppayable):?>
    <?php $mydata1[] = $toppayable->s_company; ?>
    <?php $mycount1[] = $toppayable->p; ?>
    <?php endforeach; ?>

    <?php foreach ($topcustomers as $topcustomer):?>
    <?php $mydata2[] = $topcustomer->fr_name; ?>
    <?php $mycount2[] = $topcustomer->p; ?>
    <?php endforeach; ?>



    <script type="text/javascript">
        var ctxP = document.getElementById("labelChart").getContext('2d');
        var myPieChart = new Chart(ctxP, {

            type: 'doughnut',
            data: {
                labels: [<?php if (!isset($mydata) || $mydata == '') {
                    $mydata[] = 0;
                }
                $json = json_encode($mydata);
                $string = str_replace(['[', ']'], '', $json);
                echo $string; ?>],
                datasets: [{
                    data: [<?php if (!isset($mycount) || $mycount == '') {
                        $mycount[] = 0;
                    }
                    $json = json_encode($mycount);
                    $string = str_replace(['[', ']'], '', $json);
                    echo $string; ?>],
                    backgroundColor: ["#800000", "#000075", "#E6194B", "#FFE119", "#BCF60C", "#3CB44B",
                        "#008080", "#911EB4", "#F032E6", "#FABEBE", "#9A6324", "#808000", "#46F0F0",
                        "#292930", "#FCD02C"
                    ],
                    hoverBackgroundColor: ["#000000", "#000000", "#000000", "#000000", "#000000", "#000000",
                        "#000000", "#000000", "#000000", "#000000", "#000000", "#000000", "#000000",
                        "#000000", "#000000"
                    ]
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'right',
                    labels: {
                        padding: 10,
                        boxWidth: 10
                    }
                },
            }
        });
    </script>
    <script type="text/javascript">
        var ctxP = document.getElementById("labelChart1").getContext('2d');
        var myPieChart = new Chart(ctxP, {

            type: 'doughnut',
            data: {
                labels: [<?php $json = json_encode($mydata1);
                $string = str_replace(['[', ']'], '', $json);
                echo $string; ?>],
                datasets: [{
                    data: [<?php $json = json_encode($mycount1);
                    $string = str_replace(['[', ']'], '', $json);
                    echo $string; ?>],
                    backgroundColor: ["#800000", "#000075", "#E6194B", "#FFE119", "#BCF60C", "#3CB44B",
                        "#008080", "#911EB4", "#F032E6", "#FABEBE", "#9A6324", "#808000", "#46F0F0",
                        "#292930", "#FCD02C"
                    ],
                    hoverBackgroundColor: ["#000000", "#000000", "#000000", "#000000", "#000000", "#000000",
                        "#000000", "#000000", "#000000", "#000000", "#000000", "#000000", "#000000",
                        "#000000", "#000000"
                    ]
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'right',
                    labels: {
                        padding: 10,
                        boxWidth: 10
                    }
                },
            }
        });
    </script>
    <script type="text/javascript">
        var ctxP = document.getElementById("customerChart").getContext('2d');
        var myPieChart = new Chart(ctxP, {

            type: 'doughnut',
            data: {
                labels: [<?php if (!isset($mydata2) || $mydata2 == '') {
                    $mydata2[] = 0;
                }
                $json2 = json_encode($mydata2);
                $string2 = str_replace(['[', ']'], '', $json2);
                echo $string2; ?>],
                datasets: [{
                    data: [<?php if (!isset($mycount2) || $mycount2 == '') {
                        $mycount2[] = 0;
                    }
                    $json2 = json_encode($mycount2);
                    $string2 = str_replace(['[', ']'], '', $json2);
                    echo $string2; ?>],
                    backgroundColor: ["#800000", "#000075", "#E6194B", "#FFE119", "#BCF60C", "#3CB44B",
                        "#008080", "#911EB4", "#F032E6"
                    ],
                    hoverBackgroundColor: ["#000000", "#000000", "#000000", "#000000", "#000000", "#000000",
                        "#000000", "#000000", "#000000", "#000000"
                    ]
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'right',
                    labels: {
                        padding: 10,
                        boxWidth: 10
                    }
                },
            }
        });
    </script>
    <?php foreach ($jvdebitmonthly as $jvdebitsmonthly):?>
    <?php $monthlydebit[] = $jvdebitsmonthly->d;
    $debitmonth[] = $jvdebitsmonthly->mc;
    ?>
    <?php endforeach; ?>

    <?php foreach ($jvcreditmonthly as $jvcreditsmonthly):?>
    <?php $monthlycredit[] = $jvcreditsmonthly->c; ?>
    <?php $creditmonth[] = $jvcreditsmonthly->mc; ?>
    <?php endforeach; ?>

    <?php foreach ($monthsale as $monthsales):?>
    <?php $salemonth[] = $monthsales->month; ?>
    <?php $monthdata[] = $monthsales->month . '-' . $monthsales->year; ?>
    <?php $monthcount[] = $monthsales->tot; ?>
    <?php endforeach; ?>

    <?php foreach ($monthservice as $monthlyservices):?>
    <?php $servicemonthly[] = $monthlyservices->tot;
    $servicemonths[] = $monthlyservices->month; ?>
    <?php endforeach; ?>

    <?php foreach ($monthsale as $monthsales):
        // $res = array();
        // echo $monthsales->tot; echo ',<br>';
        // for($i=0;$i<count($servicemonths);$i++)
        // {
        // if($servicemonths[$i] === $monthsales->month)
        // {
        // echo '('. $i .')'; echo $monthsales->tot + $servicemonthly[$i]; echo ',<br>';
        // $res = $servicemonths[$i];
        // }
        // else{
        //   }
        // }
    
        // for($i=0;$i<count($res);$i++)
        // {
        // if($res[$i] <> $monthsales->month)
        // {
        // echo $monthsales->tot; echo ',<br>';
        // }
        // }
    endforeach;
    ?>
    <script>
        var ctxL = document.getElementById("lineChart").getContext('2d');
        var myLineChart = new Chart(ctxL, {
            type: 'line',
            data: {
                labels: [<?php foreach ($monthsale as $monthsales):
                    echo '"';
                    echo $monthsales->month . '-' . $monthsales->year;
                    echo '"';
                    echo ',';
                endforeach;
                ?>],
                datasets: [{
                    label: "Sales Per Month",
                    //lineTension: 0,
                    data: [<?php foreach ($monthsale as $monthsales):
                        echo $monthsales->tot;
                        echo ',';
                    endforeach;
                    ?>],
                    backgroundColor: [
                        'rgba(0, 137, 132, .2)',
                    ],
                    borderColor: [
                        'rgba(0, 10, 130, .7)',
                    ],
                    borderWidth: 2
                }, ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
  <script>
    // Sample data from backend (use your actual data here)
    var monthlyNetProfit = @json($monthlyNetProfit);

    // Initialize NetProfitData array with zero values
    var NetProfitData = Array(12).fill(0);

    // Fill NetProfitData with values from monthlyNetProfit
    monthlyNetProfit.forEach(item => {
        NetProfitData[item.month - 1] = item.value;
    });

    // Adjust the data to start from July
    var adjustedNetProfitData = NetProfitData.slice(6).concat(NetProfitData.slice(0, 6));

    // Create labels in "month-number year" format
    var currentYear = new Date().getFullYear();
    var nextYear = currentYear + 1;
    var adjustedLabels = [
        `7-${currentYear}`, `8-${currentYear}`, `9-${currentYear}`, `10-${currentYear}`, `11-${currentYear}`, `12-${currentYear}`,
        `1-${nextYear}`, `2-${nextYear}`, `3-${nextYear}`, `4-${nextYear}`, `5-${nextYear}`, `6-${nextYear}`
    ];

    // Filter out zero values and corresponding labels
    var filteredData = [];
    var filteredLabels = [];
    adjustedNetProfitData.forEach((value, index) => {
        if (value !== 0) {
            filteredData.push(value);
            filteredLabels.push(adjustedLabels[index]);
        }
    });

    // Create the chart
    var ctxL = document.getElementById("lineChart2").getContext('2d');
    var myLineChart = new Chart(ctxL, {
        type: 'line',
        data: {
            labels: filteredLabels,
            datasets: [{
                label: "Net Per Month",
                data: filteredData,
                backgroundColor: [
                    'rgba(0, 137, 132, .2)',
                ],
                borderColor: [
                    'rgba(0, 10, 130, .7)',
                ],
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

    <script src="{{ asset('assets/sorting.js') }}"></script>
   
    <script>
    function sendRequest() {
        var p = $("#netprofit").val().replace(/,/g, '');
        $.ajax({
            url: '/save-netprofit',
            method: 'POST',
            data: {
                key1: p,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log('Data saved successfully:', response);
            },
            error: function(error) {
                console.error('Error saving data:', error);
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        setInterval(sendRequest, 3600000);
        // setInterval(sendRequest, 1000);

    });
</script>


@endsection
<link href="{{ asset('assets/material.css') }}" rel="stylesheet" />
