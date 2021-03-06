@extends('layouts.blog')


@section('content')                
    
    <div class="card" >
      
        <div class="card-body" >
            <div id="ajaxresponsebox" class="hidden col-xs-12 text-left">            
            </div>        
        </div>        
        
        <div class="card-body" >

            <form id="editForm" 
                  
                  class="form-signin text-left" 
                  action="user" 
                  method="post" >
                
                @csrf

                <input type="hidden" name="_method" value="POST">

                <h4>Register in our Blog</h4>
                
                <label for="inputName" class="sr-only">Name </label>
                <input name="name" type="text" id="inputName" class="margin-top-10 form-control" placeholder="Your name" required autofocus>
                
                <label for="inputEmail" class="sr-only">Email address</label>
                <input name="email"  type="email" id="inputEmail" class="margin-top-10 form-control" placeholder="Email address" required>
                
                <label for="inputPassword" class="sr-only">Password</label>
                <input name="password" type="password" id="inputPassword" class="margin-top-10 form-control" placeholder="Password" required>

                <label for="inputPassword_confirmation" class="sr-only">Password Repeat</label>
                <input name="password_confirmation" type="password" id="inputPassword_confirmation" class="margin-top-10 form-control" placeholder="Password Repeat" required>

                <button data-route="user" 
                        id="saveForm" 
                        class="saveForm margin-top-10 btn btn-lg btn-primary btn-block" 
                        type="submit">
                            Register
                </button>        
            </form>

        </div>

    </div>


@endsection

