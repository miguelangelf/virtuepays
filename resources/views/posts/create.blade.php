<?php

$overridefloating=false;
?>

@extends('background')


@section('pagename')
Write a New Post
@endsection

@section('content')

<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
	tinymce.init({
		convert_urls: false,
		selector : "textarea",
		plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste jbimages"],
		toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
	}); 
</script>


		<div class="content">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">Note</span>
              <p>After you click on submit you would not be able to edit the title.<br/>
              Be careful and choose a unique title and according to your post.
              </p>
            </div>
            
          </div>
        </div>




		<div class="content">

				<form class="form-horizontal" id="upload" enctype="multipart/form-data" method="post" action="{{ url('upload/image') }}" autocomplete="off">

				
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />

					    <div class="file-field input-field">
				      <div class="btn">
				        <span>File</span>
				        <input type="file" name="image" id="image" /> 
				      </div>
				      <div class="file-path-wrapper">
				        <input class="file-path validate" value="{{ old('image') }}" type="text">
				      </div>
				    </div>



					
				</form>

			</div>
			

			<div class="span5">
				<div id="output" >
					@if( old('title')!="" )
						<img class="laimagen" src="{{asset('uploads/'.old('image') )}}">

					@endif
				</div>
			</div>


<form action="new-post" method="post">

	<input type="hidden" name="image" value="{{ old('image') }}" id="imgtoupload">



<input type="hidden" name="_token" value="{{ csrf_token() }}">	<div class="form-group">
		<input required="required" value="{{ old('title') }}" placeholder="Enter title here" type="text" name = "title"class="form-control" />

	</div>

	<div class="form-group">
		<input required="required" value="{{ old('description') }}" placeholder="Enter a brief description" type="text" name = "description"class="form-control" />
	</div>

	<div class="form-group">
		<textarea id="mytextarea"  name='body'class="form-control materialize-textarea">{{ old('body') }}</textarea>
	</div>
	<input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
	<!--<input type="submit" name='save' class="btn btn-default" value = "Save Draft" />-->
</form>
@endsection
