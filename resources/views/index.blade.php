@extends('layouts.blog')


@section('content')                
    
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
    <div class="col-xs-12 " >
    	{{ $data->links() }}
    </div>
    @endif

@endsection

