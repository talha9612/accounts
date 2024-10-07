@extends('master')
@section('content')
<br>
<br>
<?php if(isset(Auth::user()->role) && Auth::user()->role == 'Admin')
   {
    echo '   <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4>'. __('Register') .'</h4>

                 <div class="card-body">
                    <form method="POST" action="'. route('register') .'">
                        '.csrf_field().'
                <div class="form-group row">
                            <label for="name" class="bmd-label-floating text-primary">'. __('Name') .'</label>
                             <div class="col-md-12">
                                <input id="name" type="text" class="form-control"';
                                    $errors->has('name') ? " is-invalid" : "" ;
                                 echo '" name="name" value="'. old('name') .'" required autofocus>';
                                if ($errors->has('name')){
                                    echo '<span class="invalid-feedback" role="alert">
                                    <strong>';
                                     $errors->first('name');
                                     echo '</strong>
                                    </span>';
                                }
                                 echo '</div>
                                    </div>';
                                 echo '
                    <div class="form-group row">
                        <label for="email" class="bmd-label-floating text-primary">'. __('E-Mail Address') .'</label>
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control"';
                                    $errors->has('email') ? " is-invalid" :  "" ; 
                                    echo '" name="email" value="'. old('email') .'" required>';
                                        if ($errors->has('email')){
                                            echo '<span class="invalid-feedback" role="alert">
                                                <strong>';
                                                 $errors->first('email'); 
                                          echo '</strong>
                                            </span>';
                                        }
                                        echo '</div>
                                    </div>';
                                
                                echo '
                    <div class="form-group row">
                            <label for="role" class="bmd-label-floating text-primary">'. __('Role') .'</label>

                            <div class="col-md-12">
                                <select class="form-control"';
                                  $errors->has('role') ? " is-invalid" : "";
                                  echo '"type="select" id="role" name="role" value="'. old('role') .'" required autofocus>
                                    <option value="Admin">Admin</option>
                                    <option value="Operator">Operator</option>
                                </select>';
                                if ($errors->has('role')){
                                    echo '<span class="invalid-feedback" role="alert">
                                        <strong>';
                                         $errors->first('role'); 
                                        echo ' </strong>
                                    </span>';
                                }
                            echo '</div>
                        </div>';

                        echo'
                    <div class="form-group row">
                            <label for="Password" class="bmd-label-floating text-primary">'. __('Password') .'</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control';
                                 $errors->has('password') ? " is-invalid" : "" ;
                                 echo ' " name="password" required>';

                                if ($errors->has('password'))
                                {
                                    echo '<span class="invalid-feedback" role="alert">
                                        <strong>';
                                         $errors->first('password'); 
                                         echo '</strong>
                                    </span>';
                                }
                            echo '</div>
                        </div>
                        ';
                        echo'
                        <div class="form-group row">
                           <label for="password-confirm" class="bmd-label-floating text-primary">'. __('Confirm Password') .'</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        ';
                        echo '
                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    '. __('Register') .'
                                </button>                    
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>';
    }

   else{
   redirect()->to('home')->send();
    }
   ?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
@endsection
