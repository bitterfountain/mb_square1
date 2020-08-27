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

                <h4>New Entry Blog</h4>
                
                <label for="inputTitle" class="sr-only">Title </label>
                <input name="title" type="text" id="inputTitle" class="margin-top-10 form-control" placeholder="Title..." required autofocus>
                
                
                <label for="inputPassword" class="sr-only">Description</label>
                <textarea name="description" 
                          id="inputDescription" 
                          class="margin-top-10 form-control" 
                          placeholder="Description..." required></textarea>

                <label for="inputDate" class="sr-only">Date</label>
                <input name="date"  type="date" id="inputDate" class="margin-top-10 form-control" value="{{$date ?? ''}}}" placeholder="" required>

                <button data-route="savepost" 
                        id="savePost" 
                        class="savePost margin-top-10 btn btn-lg btn-primary btn-block" 
                        type="submit">
                            Save Post
                </button>        
            </form>

        </div>

    </div>


@endsection

