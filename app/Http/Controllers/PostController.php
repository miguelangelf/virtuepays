<?php namespace App\Http\Controllers;

use App\Posts;
use App\User;
use App\Stars;
use Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;

use Illuminate\Http\Request;

use DB;

// note: use true and false for active posts in postgresql database
// here '0' and '1' are used for active posts because of mysql database

class PostController extends Controller {



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = Posts::where('active','1')->orderBy('created_at','desc')->paginate(10);
		$title = 'Latest Posts';
		return view('hm')->withPosts($posts)->withTitle($title);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		// 
		if($request->user()->can_post())
		{
			return view('posts.create');
		}	
		else 
		{
			return redirect('/home')->withErrors('You have not sufficient permissions for writing post');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(PostFormRequest $request)
	{


		$title=$request->get('title');

		$post = new Posts();
		$image=$request->get('image');
		$post->image=$image;
		$post->title = $title;
		$post->body = $request->get('body');
		$post->description = $request->get('description');
		$post->slug = str_slug($post->title);
		$post->author_id = $request->user()->id;

		$repeated = DB::table('posts')->where('title', $title)->count();

		if(empty($image)){
			return back()->withInput()->withErrors('Please select an image');
		}

		if($repeated != 0){
			return back()->withInput()->withErrors('Title must be unique');
		}

		if($request->has('save'))
		{
			$post->active = 0;
			$message = 'Post saved successfully';			
		}			
		else 
		{
			$post->active = 1;
			$message = 'Post published successfully';
		}
		$post->save();
		return redirect($post->slug)->withMessage($message);
	}

	public function average(Request $request){
		$publicacion=$request['publicacionid'];
		$publicacion=$request['id'];
		$cantidad = DB::table('stars')->select('rate')->where('on_post', $publicacion)->get();



		$tamano=count($cantidad);
		if($tamano==0) return 0;

		$suma=0;

		for($i=0;$i<$tamano;$i++){
			$suma+=$cantidad[$i]->rate;
		}

		$avg=$suma/$tamano;

		return round($avg,1);
	}

	public function getmyRate(Request $request){
		$user=$request->user()->id;
		$publicacion=$request['publicacionid'];
		$counter = DB::table('stars')->where('on_post', $publicacion)->where('by_user',$user)->count();

		if($counter==0)return 0;

		$cantidad = DB::table('stars')->select('rate')->where('on_post', $publicacion)->where('by_user',$user)->first();
		if($cantidad==null) $cantidad=0;
		return round($cantidad->rate);
	}


	public function setrate(Request $request){
		$puntaje=$request['example'];
		$user=$request->user()->id;
		$publicacion=$request['publicacionid'];

		$cantidad = DB::table('stars')->where('on_post', $publicacion)->where('by_user',$user)->count();

		if($cantidad==0){
			$stars=new Stars();
			$stars->on_post=$publicacion;
			$stars->by_user=$user;
			$stars->rate=$puntaje;
			$stars->save();
		}
		else{
			DB::table('stars')->where('on_post', $publicacion)->where('by_user',$user)->update(['rate' => $puntaje]);			
		}



		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$post = Posts::where('slug',$slug)->first();

		if($post)
		{
			if($post->active == false)
				return redirect('/')->withErrors('requested page not found');
			$comments = $post->comments;	
		}
		else 
		{
			return redirect('/home')->withErrors('requested page not found');
		}
		return view('posts.show')->withPost($post)->withComments($comments);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Request $request,$slug)
	{
		$post = Posts::where('slug',$slug)->first();
		if($post && ($request->user()->id == $post->author_id || $request->user()->is_admin()))
			return view('posts.edit')->with('post',$post)->with('title','Edit');
		else 
		{
			return redirect('/home')->withErrors('you have not sufficient permissions, this action will be reported');
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		//
		$post_id = $request->input('post_id');
		$post = Posts::find($post_id);
		if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin()))
		{
		//	$title = $request->input('title');
		//	$slug = str_slug($title);
		//	$duplicate = Posts::where('slug',$slug)->first();

			/*
			if($duplicate)
			{
				if($duplicate->id != $post_id)
				{
					return redirect('edit/'.$post->slug)->withErrors('Title already exists.')->withInput();
				}
				else 
				{
					$post->slug = $slug;
				}
			}
			*/
			//$post->title = $title;

			$entrada=$request->input('body');
			$salida = str_replace("../", "/itesmblog/public/", $entrada);
			$post->image=$request->input('image');
			$post->description=$request->input('description');

			$post->body = $salida;
			
			if($request->has('save'))
			{
				$post->active = 0;
				$message = 'Post saved successfully';
				$landing = 'edit/'.$post->slug;
			}			
			else {
				$post->active = 1;
				$message = 'Post updated successfully';
				$landing = $post->slug;
			}
			$post->save();
	 		return redirect($landing)->withMessage($message);
		}
		else
		{
			return redirect('/home')->withErrors('you have not sufficient permissions');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request, $id)
	{
		//
		$post = Posts::find($id);
		if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin()))
		{
			$post->active=0;
			$post->save();
			$data['message'] = 'Post deleted Successfully';
		}
		else 
		{
			$data['errors'] = 'Invalid Operation. You have not sufficient permissions, This action will be reported';
		}
		
		return redirect('/home')->with($data);
	}
}
