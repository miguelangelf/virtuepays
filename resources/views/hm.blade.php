<?php
	$pagename=$title;
	$cardcolor="blue-grey lighten-5";
	$nomessage="There is no post till now. Login and write a new post now!!!";
?>

@extends('background')


@section('pagename')
	{{$pagename}}
@endsection




@section('content')
<script type="text/javascript">

function getAverage(id){
	
	jQuery(document).ready(function() {
    	$.post("{{ route('average') }}",
		{
			'id':id
		},
		function(data){
			if(data!=0){
				$('#p'+id).html("Rate: "+data+" pts");
			}else{
				$('#p'+id).html("Not rated yet");		
			}
			thekey=data.csrf_token;
		})
		.fail(function() {
			$('#p'+id).html("Error while fetching");
  		});
	});
}
</script>


@if ( !$posts->count() )
	{{$nomessage}}
@else
	
	<div class="row">
		@foreach( $posts as $post )
		
		<div class="col l6 m6 s12">
			<div class="large card hoverable {{$cardcolor}}">

				@if ($post->image != null)
					 
					<div   class="card-image waves-effect waves-block waves-light">
	            		  <img class="activator" align="top" src="{{ asset('uploads/'.$post->image) }}">
	            	
	            	</div>
	            @endif


	            <div   class="card-content">
	            	<span class="card-title activator grey-text text-darken-4 ">{{ $post->title }}
	            	
	            	 <i class="material-icons right">more_vert</i></span>
	            	

	            	<br/>

	            	<i>
		            	<p>
		            		{{ $post->created_at->format('M d,Y \a\t h:i a') }} by <a href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a>
		            	</p>
	            	</i>
				</div>

				<div class="card-reveal {{$cardcolor}}">
			      <span class="card-title grey-text text-darken-4">{{ $post->title }}<i class="material-icons right">close</i></span>
			      <p>
	            		{!! str_limit($post->description, $limit = 55500, $end = '....... <a href='.url("/".$post->slug).'>Read More</a>') !!}
	            	</p>
			    </div>



				<div class="card-action">
					<div class="col s8 ">
					@if($post->active == '1')
						<a href="{{ url('/'.$post->slug) }}">Read</a>
					@endif
					@if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
						@if($post->active == '1')
							<a href="{{ url('edit/'.$post->slug)}}">Edit Post</a>
						@else
							<a href="{{ url('edit/'.$post->slug)}}">Edit Draft</a>
						@endif
					@endif
					</div>

					<div class="col s4">

					<span class="left-align" id='p{{$post->id}}'>
						
					</span>
	            	<script type="text/javascript">getAverage('{{$post->id}}','{{ csrf_token() }}');</script>
	            	</div>

				</div>
			</div>
		</div>
		@endforeach
	</div>
		
	<div class="center-align">{!! str_replace('/?', '?', $posts->render()) !!}</div>

@endif
@endsection
