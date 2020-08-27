@extends('layouts.blog')


@section('content')                
    
    <div class="card" >
      
        <div class="card-body" >
            <div id="ajaxresponsebox" class="hidden col-xs-12 text-left">            
            </div>        
        </div>        
        
        <div class="card-body" >

            <form id="loginForm"                   
                  class="form-signin text-left" 
                  action="login" 
                  method="post" >
                
                @csrf

                <input type="hidden" name="_method" value="POST">

                <h4>Login as member</h4>
                
                <label for="inputEmail" class="sr-only">Email address</label>
                <input name="email"  type="email" id="inputEmail" class="margin-top-10 form-control" placeholder="Email address" required>
                
                <label for="inputPassword" class="sr-only">Password</label>
                <input name="password" type="password" id="inputPassword" class="margin-top-10 form-control" placeholder="Password" required>

                <button data-route="login" 
                        id="loginUser" 
                        class="loginUser margin-top-10 btn btn-lg btn-primary btn-block" 
                        type="submit">
                            Login
                </button>        
            </form>

        </div>

    </div>


@endsection

