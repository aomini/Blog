@extends('layouts.app')
@section('contents')

	<div class="container mt-10 m-t-10">
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<div class="card">
					<h5 class="card-header">
						
						{{-- {{$article->user}} posted --}}

						<div class="level">
							<div class="flex">
								{{$article->title}}	
							</div>
							@if(auth()->check()?(int)$article->user_id === auth()->id():false)
								<form action="/article/{{$article->slug}}" method="POST">
									{{ csrf_field() }}
									
									{{method_field('DELETE')}}

									<button class="btn btn-link" type="submit">Delete</button>							
									
								</form>		
							@endif			
						</div>


					</h5>
					<div class="card-body">
						{{ $article->body }}						
					</div>
				</div>
				@foreach($comments as $comment)
					<div class="card mt-10">
						<h4 class="card-header">
							<div class="level">
								<div class="flex">
									{{$comment->commenter->name}} commented
								</div>
								<div><h5>{{$comment->created_at->diffForHumans()}}</h5></div>
							</div>
						</h4>
						<div class="card-body">
							{{$comment->comment}}
						</div>
					</div>
				@endforeach

				<form action="/article/{{$article->slug}}/comment" method="POST" class="mt-10">
					{{ csrf_field() }}
					<textarea name="comment" class="form-control" rows="5" placeholder="Write a comment"></textarea>
					<button class="btn btn-primary mt-10">Submit Comment</button>
				</form>
			</div>
		</div>
	</div>


@endsection