<?php 
	$currentsession=Auth::id();
	$name=$user['name']; 
?>

@extends('background')

@section('pagename')
	{{ $user->name }}
@endsection

@section('content')
	<ul class="collection">
		<li class="collection-item avatar">
			<i class="material-icons circle green">perm_identity</i>
			<span class="title">	{{ $user->name }}</span>
			<p>Joined on {{$user->created_at->format('M d,Y \a\t h:i a') }}</p>
		</li>

		@if ($user['id'] == $currentsession && false )
			<li class="collection-item avatar">
				<i class="material-icons circle blue">view_agenda</i>
				<span class="title">Total Posts</span>
				<p> You have created  {{$posts_count}} posts. (Published and Filed) <br>
					<a href="{{ url('/my-all-posts')}}">Show All</a>
				</p>
			</li>
		@endif


		<li class="collection-item avatar">
			<i class="material-icons circle orange">comment</i>
			<span class="title">Published Posts</span>
			<p>Currently, you have {{$posts_active_count}} published posts <br>
				<a href="{{ url('/user/'.$user->id.'/posts')}}">Show All</a>
			</p>
		</li>

		@if ($user['id'] == $currentsession  && false )
			<li class="collection-item avatar">
				<i class="material-icons circle red">folder</i>
				<span class="title">Filed Posts</span>
				<p>You have {{$posts_draft_count}} posts filed <br>
					<a href="{{ url('my-drafts')}}">Show All</a>
				</p>
			</li>
		@endif
	</ul>


	<h5 class="header">
		LATEST POSTS					
	</h5>

	@if(!empty($latest_posts[0]))
		<table class="striped">
        	<thead>
        		<tr>
            		<th data-field="id">Post</th>
            		<th data-field="name">Date</th>
          		</tr>
        	</thead>
        	<tbody>
        		@foreach($latest_posts as $latest_post)
        			<tr>
            			<td><a href="{{ url('/'.$latest_post->slug) }}">{{ $latest_post->title }}</a></td>
            			<td>{{ $latest_post->created_at->format('M d,Y \a\t h:i a') }}</td>
          			</tr>
          		@endforeach
        	</tbody>
      </table>
    @else
      	<p>You have not written any post till now.</p>
	@endif


	<h5 class="header">
		LATEST COMMENTS	(Click to see more)				
	</h5>

	@if(!empty($latest_comments[0]))


			<ul class="collapsible" data-collapsible="accordion">
        		@foreach($latest_comments as $latest_comment)
        			<li>
        				<div class="collapsible-header">
            			<a href="{{ url('/'.$latest_comment->post->slug) }}">{{ $latest_comment->post->title }}</a>
            			On
            			{{ $latest_comment->created_at->format('M d,Y \a\t h:i a') }}
            			</div>
            			<div class="collapsible-body"><p>{{ $latest_comment->body }}</p></div>
          			</li>
          		@endforeach
          	</ul>
        	
    @else
      	<p>You have not written any post till now.</p>
	@endif
@endsection