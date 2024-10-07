<!-- edit.blade.php -->
@extends('master')
@section('content')
<?php if(isset(Auth::user()->role) && Auth::user()->role == 'Admin') {  ?>
<!-- WORK AREA START -->

    <h3 align="center" class="text-primary">Edit Record <small class="text-muted">(User)</small></h3>
          <br>
      <form method="post" action="{{action('UserController@update', $user['id'])}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
            <div id="accordion" class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary" id="headingOne">
                <h5 class="mb-0">
                  <a class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     <i class="material-icons text-warning">account_circle</i>User Details
                  </a>
                </h5>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body bg-light">
                 <div class="container">
                        <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary">Name</label>
                          <input type="text" class="form-control" id="name" required name="name" value="{{$user->name}}">
                          <input type="hidden" class="form-control" id="id" required name="id" value="{{$user->id}}">
                        </div>
                        <div class="form-group">
                          <label for="sowodo" class="bmd-label-floating text-primary">Email</label>
                          <input type="text" class="form-control" id="email" required name="email" value="{{$user->email}}">
                        </div>

                      <?php if($user->name == Auth::user()->name) 

                      {
                         echo '<div class="form-group">
                            <label for="term" class="text-primary">Role</label>
                            <select class="form-control" type="select" id="role" required name="role">
                              <option value="'.$user->role.'">'.$user->role.'</option>
                              <option value="Admin">Admin</option>
                            </select>
                          </div>';
                      }
                      

                      else{

                        echo '<div class="form-group">
                            <label for="term" class="text-primary">Role</label>
                            <select class="form-control" type="select" id="role" required name="role">
                              <option value="'.$user->role.'">'.$user->role.'</option>
                              <option value="Admin">Admin</option>
                              <option value="Operator">Operator</option>
                            </select>
                          </div>';
                      }

                      ?>
                      </div>

                      <br>

            <table id="datatables1" class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead class="bg-primary">
                <tr role="row">
                  <th class="sorting_asc text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 80px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Name</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;" aria-label="Position: activate to sort column ascending">View</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;" aria-label="Office: activate to sort column ascending">Add +</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 40px;" aria-label="Age: activate to sort column ascending">Edit</th>
                  <th class="disabled-sorting sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 80px;" aria-label="Actions: activate to sort column ascending">Delete</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th>Name</th>
                  <th>View</th>
                  <th>+Add</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </tfoot>
              <tbody>
                
                <tr>
                  <td>Customers</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="1" id="customerview" name="customerview"   
                        <?php 
                          if(isset($user->customerview) && $user->customerview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="customerview">VIEW</label>
                      </div>
                  </td>

                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="1" id="customeradd" name="customeradd"
                         <?php 
                          if(isset($user->customeradd) && $user->customeradd == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="customeradd">+ADD</label>
                      </div>
                  </td>

                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="1" id="customeredit" name="customeredit"
                         <?php 
                          if(isset($user->customeredit) && $user->customeredit == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="customeredit">EDIT</label>
                      </div>
                  </td>

                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="1" id="customerdelete" name="customerdelete"
                         <?php 
                          if(isset($user->customerdelete) && $user->customerdelete == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="customerdelete">DELETE</label>
                      </div>
                  </td>
                </tr>



                <tr>
                  <td>Companies</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="1" id="companyview" name="companyview"   
                        <?php 
                          if(isset($user->companyview) && $user->companyview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="companyview">VIEW</label>
                      </div>
                  </td>

                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="1" id="companyadd" name="companyadd"
                         <?php 
                          if(isset($user->companyadd) && $user->companyadd == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="companyadd">+ADD</label>
                      </div>
                  </td>

                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="1" id="companyedit" name="companyedit"
                         <?php 
                          if(isset($user->companyedit) && $user->companyedit == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="companyedit">EDIT</label>
                      </div>
                  </td>

                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="1" id="companydelete" name="companydelete"
                         <?php 
                          if(isset($user->companydelete) && $user->companydelete == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="companydelete">DELETE</label>
                      </div>
                  </td>
                </tr>


                 <tr>
                  <td>Contact person</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="1" id="cpersonview" name="cpersonview"   
                        <?php 
                          if(isset($user->cpersonview) && $user->cpersonview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="cpersonview">VIEW</label>
                      </div>
                  </td>

                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="1" id="cpersonadd" name="cpersonadd"
                         <?php 
                          if(isset($user->cpersonadd) && $user->cpersonadd == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="cpersonadd">+ADD</label>
                      </div>
                  </td>

                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="1" id="cpersonedit" name="cpersonedit"
                         <?php 
                          if(isset($user->cpersonedit) && $user->cpersonedit == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="cpersonedit">EDIT</label>
                      </div>
                  </td>

                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="1" id="cpersondelete" name="cpersondelete"
                         <?php 
                          if(isset($user->cpersondelete) && $user->cpersondelete == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="cpersondelete">DELETE</label>
                      </div>
                  </td>
                </tr>







                 <tr>
                  <td>Banks List</td>

                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="bankslistview" value="1" name="bankslistview"  
                        <?php 
                          if(isset($user->bankslistview) && $user->bankslistview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="bankslistview">VIEW</label>
                      </div>
                  </td>

                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="bankslistadd" value="1" name="bankslistadd"  <?php 
                          if(isset($user->bankslistadd) && $user->bankslistadd == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                      >
                        <label class="custom-control-label text-dark" for="bankslistadd">+ADD</label>
                      </div>
                  </td>

                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="bankslistedit" value="1" name="bankslistedit"
                         <?php 
                          if(isset($user->bankslistedit) && $user->bankslistedit == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="bankslistedit">EDIT</label>
                      </div>
                  </td>

                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="bankslistdelete" value="1" name="bankslistdelete"
                         <?php 
                          if(isset($user->bankslistdelete) && $user->bankslistdelete == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="bankslistdelete">DELETE</label>
                      </div>
                  </td>
                </tr>

                <tr>
                  <td>Bank Accounts</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="bankaccountsview" value="1" name="bankaccountsview"
                         <?php 
                          if(isset($user->bankaccountsview) && $user->bankaccountsview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="bankaccountsview">VIEW</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="bankaccountsadd" value="1" name="bankaccountsadd"
                        <?php 
                          if(isset($user->bankaccountsadd) && $user->bankaccountsadd == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="bankaccountsadd">+ADD</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="bankaccountsedit" value="1" name="bankaccountsedit"
                        <?php 
                          if(isset($user->bankaccountsedit) && $user->bankaccountsedit == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="bankaccountsedit">EDIT</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="bankaccountsdelete" value="1" name="bankaccountsdelete"
                        <?php 
                          if(isset($user->bankaccountsdelete) && $user->bankaccountsdelete == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="bankaccountsdelete">DELETE</label>
                      </div>
                  </td>
                </tr>

                <tr>
                  <td>Cash Accounts</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="cashaccountsview" value="1" id="cashaccountsview" 
                        <?php 
                          if(isset($user->cashaccountsview) && $user->cashaccountsview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="cashaccountsview">VIEW</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="cashaccountsadd" value="1" id="cashaccountsadd" 
                         <?php 
                          if(isset($user->cashaccountsadd) && $user->cashaccountsadd == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="cashaccountsadd">+ADD</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="cashaccountsedit" value="1" id="cashaccountsedit" 
                         <?php 
                          if(isset($user->cashaccountsedit) && $user->cashaccountsedit == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="cashaccountsedit">EDIT</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="cashaccountsdelete" value="1" id="cashaccountsdelete" 
                         <?php 
                          if(isset($user->cashaccountsdelete) && $user->cashaccountsdelete == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="cashaccountsdelete">DELETE</label>
                      </div>
                  </td>
                </tr>

                 <tr>
                  <td>Assets List</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="assetsview" value="1" name="assetsview"
                         <?php 
                          if(isset($user->assetsview) && $user->assetsview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="assetsview">VIEW</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="assetsadd" value="1" name="assetsadd"
                         <?php 
                          if(isset($user->assetsadd) && $user->assetsadd == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="assetsadd">+ADD</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="assetsedit" value="1" name="assetsedit"
                         <?php 
                          if(isset($user->assetsedit) && $user->assetsedit == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="assetsedit">EDIT</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="assetsdelete" value="1" name="assetsdelete"
                         <?php 
                          if(isset($user->assetsdelete) && $user->assetsdelete == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="assetsdelete">DELETE</label>
                      </div>
                  </td>
                </tr>

                 <tr>
                  <td>Liabilities List</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="liabilitiesview" value="1" name="liabilitiesview"
                         <?php 
                          if(isset($user->liabilitiesview) && $user->liabilitiesview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="liabilitiesview">VIEW</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="liabilitiesadd" value="1" name="liabilitiesadd" 
                         <?php 
                          if(isset($user->liabilitiesadd) && $user->liabilitiesadd == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="liabilitiesadd">+ADD</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="liabilitiesedit" value="1" name="liabilitiesedit"
                         <?php 
                          if(isset($user->liabilitiesedit) && $user->liabilitiesedit == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="liabilitiesedit">EDIT</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="liabilitiesdelete" value="1" name="liabilitiesdelete"
                         <?php 
                          if(isset($user->liabilitiesdelete) && $user->liabilitiesdelete == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="liabilitiesdelete">DELETE</label>
                      </div>
                  </td>
                </tr>

                 <tr>
                  <td>Expense List</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="expenseview" value="1" name="expenseview"
                        <?php 
                          if(isset($user->expenseview) && $user->expenseview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="expenseview">VIEW</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="expenseadd"  value="1" name="expenseadd"
                         <?php 
                          if(isset($user->expenseadd) && $user->expenseadd == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="expenseadd">+ADD</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="expenseedit" value="1" name="expenseedit"
                         <?php 
                          if(isset($user->expenseedit) && $user->expenseedit == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="expenseedit">EDIT</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="expensedelete" value="1" name="expensedelete"
                         <?php 
                          if(isset($user->expensedelete) && $user->expensedelete == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="expensedelete">DELETE</label>
                      </div>
                  </td>
                </tr>

                 <tr>
                  <td>Income List</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="incomeview" value="1" name="incomeview" 
                          <?php 
                          if(isset($user->incomeview) && $user->incomeview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="incomeview">VIEW</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="incomeadd"  value="1" name="incomeadd"
                         <?php 
                          if(isset($user->incomeadd) && $user->incomeadd == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="incomeadd">+ADD</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="incomeedit" value="1" name="incomeedit"
                         <?php 
                          if(isset($user->incomeedit) && $user->incomeedit == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="incomeedit">EDIT</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="incomedelete" value="1" name="incomedelete"
                         <?php 
                          if(isset($user->incomedelete) && $user->incomedelete == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="incomedelete">DELETE</label>
                      </div>
                  </td>
                </tr>

                 <tr>
                  <td>Sub Types</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="subtypesview" value="1" name="subtypesview"
                         <?php 
                          if(isset($user->subtypesview) && $user->subtypesview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="subtypesview">VIEW</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="subtypesadd" value="1" name="subtypesadd"
                        <?php 
                          if(isset($user->subtypesadd) && $user->subtypesadd == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="subtypesadd">+ADD</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="subtypesedit" value="1" name="subtypesedit"
                        <?php 
                          if(isset($user->subtypesedit) && $user->subtypesedit == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="subtypesedit">EDIT</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="subtypesdelete" value="1" name="subtypesdelete"
                        <?php 
                          if(isset($user->subtypesdelete) && $user->subtypesdelete == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="subtypesdelete">DELETE</label>
                      </div>
                  </td>
                </tr>

                <tr>
                  <td>Cash Payments</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="cpaymentsview" value="1" name="cpaymentsview"
                        <?php 
                          if(isset($user->cpaymentsview) && $user->cpaymentsview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="cpaymentsview">VIEW</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="cpaymentsadd" value="1" name="cpaymentsadd"
                         <?php 
                          if(isset($user->cpaymentsadd) && $user->cpaymentsadd == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="cpaymentsadd">+ADD</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                </tr>

                <tr>
                  <td>Bank Payments</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="bpaymentsview" value="1" name="bpaymentsview"
                         <?php 
                          if(isset($user->bpaymentsview) && $user->bpaymentsview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="bpaymentsview">VIEW</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="bpaymentsadd" value="1" name="bpaymentsadd"
                         <?php 
                          if(isset($user->cpaymentsadd) && $user->cpaymentsadd == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="bpaymentsadd">+ADD</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                </tr>

                 <tr>
                  <td>Cash Receipt</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="creceiptsview" value="1" name="creceiptsview"
                         <?php 
                          if(isset($user->creceiptsview) && $user->creceiptsview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="creceiptsview">VIEW</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="creceiptsadd" value="1" name="creceiptsadd"
                          <?php 
                          if(isset($user->creceiptsadd) && $user->creceiptsadd == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="creceiptsadd">+ADD</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                </tr>

                 <tr>
                  <td>Bank Receipt</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="breceiptsview" value="1" name="breceiptsview"
                         <?php 
                          if(isset($user->breceiptsview) && $user->breceiptsview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="breceiptsview">VIEW</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="breceiptsadd" value="1" name="breceiptsadd"
                        <?php 
                          if(isset($user->breceiptsadd) && $user->breceiptsadd == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="breceiptsadd">+ADD</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                </tr>

                 <tr>
                  <td>Journal Vouchers</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="jvview" value="1" name="jvview"
                          <?php 
                          if(isset($user->jvview) && $user->jvview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="jvview">VIEW</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="jvadd" value="1" name="jvadd"
                         <?php 
                          if(isset($user->jvadd) && $user->jvadd == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="jvadd">+ADD</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                </tr>

                 <tr>
                  <td>Cash Ledgers</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="cashledgersview" value="1" name="cashledgersview"
                        <?php 
                          if(isset($user->cashledgersview) && $user->cashledgersview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="cashledgersview">VIEW</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>

                 <tr>
                  <td>Bank Ledgers</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="bankledgersview" value="1" name="bankledgersview"
                        <?php 
                          if(isset($user->bankledgersview) && $user->bankledgersview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="bankledgersview">VIEW</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>

                 <tr>
                  <td>Assets Ledgers</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="assetledgersview" value="1" name="assetledgersview"
                        <?php 
                          if(isset($user->assetledgersview) && $user->assetledgersview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="assetledgersview">VIEW</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>

                <tr>
                  <td>Expense Ledgers</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="expenseledgersview" value="1" name="expenseledgersview"
                        <?php 
                          if(isset($user->expenseledgersview) && $user->expenseledgersview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="expenseledgersview">VIEW</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>

                 <tr>
                  <td>Liabilities Ledgers</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="liabilitiesledgersview" value="1" name="liabilitiesledgersview"
                        <?php 
                          if(isset($user->liabilitiesledgersview) && $user->liabilitiesledgersview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="liabilitiesledgersview">VIEW</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>

                 <tr>
                  <td>Income Ledgers</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="incomeledgersview" value="1" name="incomeledgersview"
                        <?php 
                          if(isset($user->incomeledgersview) && $user->incomeledgersview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="incomeledgersview">VIEW</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>

                 <tr>
                  <td>Customer Ledgers</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customerledgersview" value="1" name="customerledgersview" 
                        <?php 
                          if(isset($user->customerledgersview) && $user->customerledgersview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="customerledgersview">VIEW</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>

                 <tr>
                  <td>Supplier Ledgers</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="supplierledgersview" value="1" name="supplierledgersview"
                        <?php 
                          if(isset($user->supplierledgersview) && $user->supplierledgersview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="supplierledgersview">VIEW</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>

                 <tr>
                  <td>Purchase Ledgers</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="purchaseledgersview" value="1" name="purchaseledgersview"
                        <?php 
                          if(isset($user->purchaseledgersview) && $user->purchaseledgersview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="purchaseledgersview">VIEW</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>

                 <tr>
                  <td>Sales Ledgers</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="salesledgersview" value="1" name="salesledgersview"
                        <?php 
                          if(isset($user->salesledgersview) && $user->salesledgersview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="salesledgersview">VIEW</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>

                  <tr>
                  <td>Trial Balance</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="trialbalanceview" value="1" name="trialbalanceview"
                        <?php 
                          if(isset($user->trialbalanceview) && $user->trialbalanceview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="trialbalanceview">VIEW</label>
                      </div>
                  </td><td>
                  </td><td>
                  </td><td>
                  </td>
                </tr>

                <tr>
                  <td>Income Statement</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="incomestatementview"  value="1" name="incomestatementview"
                        <?php 
                          if(isset($user->incomestatementview) && $user->incomestatementview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="incomestatementview">VIEW</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>

                 <tr>
                  <td>Suppliers</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="suppliersview" value="1" name="suppliersview" 
                        <?php 
                          if(isset($user->suppliersview) && $user->suppliersview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="suppliersview">VIEW</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="suppliersadd" value="1" name="suppliersadd"
                        <?php 
                          if(isset($user->suppliersadd) && $user->suppliersadd == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="suppliersadd">+ADD</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="suppliersedit" value="1" name="suppliersedit"
                        <?php 
                          if(isset($user->suppliersedit) && $user->suppliersedit == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="suppliersedit">EDIT</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="suppliersdelete" value="1" name="suppliersdelete"
                        <?php 
                          if(isset($user->suppliersdelete) && $user->suppliersdelete == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="suppliersdelete">DELETE</label>
                      </div>
                  </td>
                </tr>

                <tr>
                  <td>Products</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="productsview" value="1" name="productsview" 
                        <?php 
                          if(isset($user->productsview) && $user->productsview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="productsview">VIEW</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="productsadd" value="1" name="productsadd"
                        <?php 
                          if(isset($user->productsadd) && $user->productsadd == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="productsadd">+ADD</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="productsedit" value="1" name="productsedit"
                        <?php 
                          if(isset($user->productsedit) && $user->productsedit == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="productsedit">EDIT</label>
                      </div>
                  </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="productsdelete" value="1" name="productsdelete"
                        <?php 
                          if(isset($user->productsdelete) && $user->productsdelete == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="productsdelete">DELETE</label>
                      </div>
                  </td>
                </tr>

                <tr>
                  <td>Stock</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="stockview" value="1" name="stockview" 
                        <?php 
                          if(isset($user->stockview) && $user->stockview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>

                        >
                        <label class="custom-control-label text-dark" for="stockview">VIEW</label>
                      </div>
                  </td>
                  <td> </td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="stockedit" value="1" name="stockedit"
                        <?php 
                          if(isset($user->stockedit) && $user->stockedit == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="stockedit">EDIT</label>
                      </div>
                  </td>
                  <td>
                  </td>
                </tr>

                <tr>
                  <td>Gross Profit</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="grossprofitview" value="1" name="grossprofitview"
                        <?php 
                          if(isset($user->grossprofitview) && $user->grossprofitview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="grossprofitview">VIEW</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>

                 <tr>
                  <td>Purchase View</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="purchaseview" value="1" name="purchaseview"
                        <?php 
                          if(isset($user->purchaseview) && $user->purchaseview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="purchaseview">VIEW</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>

                 <tr>
                  <td>Sales View</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="salesview" value="1" name="salesview"
                        <?php 
                          if(isset($user->salesview) && $user->salesview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="salesview">VIEW</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>

                <tr>
                  <td>Service View</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="serviceview" value="1" name="serviceview"
                        <?php 
                          if(isset($user->serviceview) && $user->serviceview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="serviceview">VIEW</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>

                 <tr>
                  <td>DB Backup</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="dbbackupview" value="1" name="dbbackupview"
                        <?php 
                          if(isset($user->dbbackupview) && $user->dbbackupview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="dbbackupview">VIEW</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                 <tr>
                  <td>Quotations</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="quotesview" value="1" name="quotesview"
                        <?php 
                          if(isset($user->quotesview) && $user->quotesview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="quotesview">VIEW</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                 <tr>
                  <td>Received Orders</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="ordersview" value="1" name="ordersview"
                        <?php 
                          if(isset($user->ordersview) && $user->ordersview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="ordersview">VIEW</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                 <tr>
                  <td>Cancelled Orders</td>
                  <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="cancelledordersview" value="1" name="cancelledordersview"
                        <?php 
                          if(isset($user->cancelledordersview) && $user->cancelledordersview == '1')
                                     { echo 'checked'; } 
                                     else {} 
                        ?>
                        >
                        <label class="custom-control-label text-dark" for="cancelledordersview">VIEW</label>
                      </div>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
                   </div>
                 </div>
               </div>
              </div>
                <br>
                <div align="center" >
              <a href="{{action('UserController@index')}}" class="btn btn-warning btn-raised">Cancel </a>
                <button type="submit" class="btn btn-primary btn-raised">Submit</button>
              </div>
            </form>
       <!-- WORK AREA END -->   
       <script src="{{asset('assets/sorting.js')}}"></script>       
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
 <?php  } else {  redirect()->to('home')->send(); } ?>