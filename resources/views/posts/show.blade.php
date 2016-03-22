<?php
	$cardcolor="blue-grey lighten-5";
?>

@extends('background')



@section('postbg')
	<div class="parallax-container">
	      <div class="parallax"><img src="{{ asset('uploads/'.$post->image) }}"></div>
	 </div>
@endsection



@section('details')	

@endsection



@section('pagename')
	{{ $post->title }} 	
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
				$('#p'+id).html(data+" pts");
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

<blockquote id="thequote">



		@if(!Auth::guest() && $post->author_id != Auth::user()->id)

		<form name="therate" id="therate" method="post" action="setrate">

			<input type="hidden" name="publicacionid" value="{{$post->id}}" />
			<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
			<div id="star-rating">
			    <input type="radio" name="example" class="rating" value="1" />
			    <input type="radio" name="example" class="rating" value="2" />
			    <input type="radio" name="example" class="rating" value="3" />
			    <input type="radio" name="example" class="rating" value="4" />
			    <input type="radio" name="example" class="rating" value="5" />
			</div>
		</form>

		<script type="text/javascript">
			jQuery(document).ready(function() {
				function mark(numero){
					for(var i=1;i<=numero;i++){
						$("a[title="+i+"]").addClass('fullStar');		
					}		
				}

		    	$.post('myrate',{
					'_token':'{{ csrf_token() }}',
					'publicacionid':'{{$post->id}}'
				},function(data){
					mark(data);
				});
			});
		</script>
		@endif




		<script type="text/javascript">getAverage('{{$post->id}}')</script>
		@if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
			@if($post->active == '1')
				<p>
				<a href="{{ url('edit/'.$post->slug)}}">Edit Post</a>
				</p>
			@else
				<p>
				<a href="{{ url('edit/'.$post->slug)}}">Edit Draft</a>
				</p>
			@endif
		@endif
		<div>
			<b>Created on:</b> {{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a>
		</div>





		<p><b>Rate: </b> <span id="p{{$post->id}}"></span></p>
		<p><b>Description:</b> {!! $post->description !!}</p>
</blockquote>

<div class="{{$cardcolor}}">
	<div>
		{!! $post->body !!}
	</div>	
</div>

<hr/>








<div>
	<h4 class="header">Leave a comment</h4>
</div>



@if(Auth::guest())
	<p>Login to Comment</p>
@else
<div class="row">
	<form class="col s12 " method="post" action="comment/add">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="on_post" value="{{ $post->id }}">
		<input type="hidden" name="slug" value="{{ $post->slug }}">
		<div class="row">
			<div class="input-field col s12">
				<textarea name="body" id="textarea1" class="materialize-textarea"></textarea>
				<label for="textarea1">Comment</label>
			</div>
		</div>
		<input type="submit" name='post_comment' class="btn btn-success" value = "Post"/>
	</form>
</div>
@endif


<div>
	@if($comments)
	<ul style="list-style: none; padding: 0">
		@foreach($comments as $comment)
		<li class="panel-body">
			<div class="list-group">
				<div class="list-group-item">
					<big><b class="header"><a href="{{ url('/user/'.$comment->author->id)}}" >{{ $comment->author->name }}</a></b> On </big>{{ $comment->created_at->format('M d,Y \a\t h:i a') }}:
				</div>
				<div class="list-group-item">
					<p><i>{{ $comment->body }}</i></p>
				</div>
			</div>
		</li>
		@endforeach
	</ul>
	@endif
</div>

@endsection
