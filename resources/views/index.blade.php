@extends('layouts.blog')


@section('content')                

	@if ( Session::get('import')  !== null )
	<div class="col-xs-12 text-left margin-top-10 " >
		{{ Session::get('import') }}
	</div>
    @endif

    @if( Session::get('usuario_actual') == '1' ) 
	    <div class="col-xs-12 margin-top-10 text-right" >
    	    <a href="/importposts" ><button class="btn btn-warning">Import manually</button></a>
	    </div>
    @endif

    <div class="col-xs-12 margin-top-10 text-right" >
    	@if( isset($total_post) ) 
    		Total Post: {{$total_post}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
    	@endif
    	@if (isset($route) && $route=='index')
	    	<a href="/?order_by=asc" class="@if($order_by=='asc')green @endif" title="First Olders" >Date Asc</a> | 
	    	<a href="/?order_by=desc" class="@if($order_by=='desc')green @endif " title="Fisrt newest" >Date Desc</a>
	    @elseif (isset($route) && $route=='mypost')
	    	<a href="mypost?order_by=asc" class="@if($order_by=='asc')green @endif" title="First Olders" >Date Asc</a> | 
	    	<a href="mypost?order_by=desc" class="@if($order_by=='desc')green @endif" title="Fisrt newest" >Date Desc</a>
	    @endif
    </div>

  
    @if($data instanceof \Illuminate\Pagination\LengthAwarePaginator )
    <div class="col-xs-12 margin-top-10 text-right" >
    	{{ $data->links() }} 
    </div>
    @endif
    

	@foreach( $data as $item ) 
	<div class="card col-xs-12 text-left margin-top-10" >
		<div class="card-body" >
			<h4>{{$item->title}}</h4>
			<p>{{$item->description}}</p>
			<h6 class="gray" ><strong>Published:</strong> {{$item->date}} <strong>by</strong> {{$item->name}} </h6>
		</div>
	</div>
	@endforeach



    @if($data instanceof \Illuminate\Pagination\LengthAwarePaginator )
    <div class="col-xs-12 margin-top-10" >
    	{{ $data->links() }}
    </div>
    @endif

@endsection

