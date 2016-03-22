@extends('background')

@section('pagename')
	Edit: {{$post->title}}
@endsection

@section('content')
<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
	tinymce.init({
		selector : "textarea",
		plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste jbimages"],
		toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages"
	}); 
</script>

<div class="row">

		<div class="content">
			<form class="form-horizontal" id="upload" enctype="multipart/form-data" method="post" action="{{ url('upload/image') }}" autocomplete="off">				
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<div class="file-field input-field">
					<div class="btn">
				    	<span>File</span>
				    	<input type="file" name="image" id="image" /> 
				    </div>
				    <div class="file-path-wrapper">
				    	<input class="file-path validate" value="{{ $post->image  }}" type="text">
				    	</div>
				    </div>					
			</form>
		</div>			

		<div class="span5">
			<div id="output" >
				@if( $post->title !="" )
					<img class="laimagen" src="{{asset('uploads/'.$post->image)}}">
				@endif
			</div>
		</div>
</div>

<form method="post" action='{{ url("/update") }}'>

	<input type="hidden" name="image" value="{{ old('image') }}{{$post->image}}" id="imgtoupload">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="post_id" value="{{ $post->id }}{{ old('post_id') }}">

	<div class="form-group">
		<input required="required" placeholder="Enter description" type="text" name = "description" class="form-control" value="@if(!old('description')){{$post->description}}@endif{{ old('description') }}"/>
	</div>
		
	<div class="form-group">
		<textarea name='body'class="form-control">
			@if(!old('body'))
				{!! $post->body !!}
			@endif
				{!! old('body') !!}
		</textarea>
	</div>

	@if($post->active == '1')
	<input type="submit" name='publish' class="btn btn-success" value = "Update"/>
	@else
	<input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
	@endif

	<script type="text/javascript">
		$(document).ready(function(){
		    $('.modal-trigger').leanModal();
		});
	</script>
	<a class="waves-effect waves-light btn modal-trigger red" href="#modal1">Delete Post</a>
</form>



<!-- Modal Structure -->
<div id="modal1" class="modal">
	<div class="modal-content">
		<h5>Are you sure you want to delete this post?</h5>
		<p>This action can not be undone, if you continue this post will be deleted and the comments will no be longer available.
			<br/>
			If you want to continue click DELETE, otherwise click CANCEL.
		</p>
	</div>
	<div class="modal-footer">
		<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
		<a onclick="deletepost()" id="urltodelete"  href="{{  url('delete/'.$post->id.'?_token='.csrf_token()) }}" class="btn red">Delete</a>
	</div>
</div>

@endsection


