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
							<form action="/article/{{$article->slug}}/favourite" method="POST">
								{{ csrf_field() }}

								<button class="btn btn-info" {{ $article->isFavourited() ? "disabled" : ''}}/>
									{{$article->favourites_count}}&nbsp;{{str_plural('favourite',$article->favourites_count)}}
								</button>
							</form>
							@can('update', $article)
								<form action="/article/{{$article->slug}}" method="POST">
									{{ csrf_field() }}
									
									{{method_field('DELETE')}}

									<button class="btn btn-link" type="submit">Delete</button>							
									
								</form>	

							@endcan	
						</div>


					</h5>
					<div class="card-body">
						{{ $article->body }}						
					</div>
				</div>
				@foreach($comments as $comment)
					<div class="card mt-10">
						<h4 class="card-header">
							<div class="level" style="align-items: center">
								<div class="flex">
									{{$comment->commenter->name}} commented
								</div>
								<div><h5>{{$comment->created_at->diffForHumans()}}</h5></div>
								<form action="/comment/{{$comment->id}}/favourite" method="POST">
									{{ csrf_field() }}

									<button class="btn btn-info" style="margin-left: 10px" {{ $article->isFavourited() ? "disabled" : ''}}>
										{{$comment->favourites_count}}&nbsp;{{str_plural('favourite',$comment->favourites_count)}}
									</button>
								</form>
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