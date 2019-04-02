@extends('layouts.app')
@section('contents')
	<div class="container mt-10 m-t-10">
		<div class="row">
			@foreach($user->articles as $article)
				<div class="col-md-8 offset-md-2 m-t-10">
					<div class="card">
						<h5 class="card-header">			
								
							<div class="level">
								<div class="flex">									
									<a href="/article/{{$article->slug}}">{{$article->title}}	</a>
								</div>

								<div>{{$article->created_at->diffForHumans()}}</div>
							</div>

						</h5>
						<div class="card-body">
							{{ $article->body }}						
						</div>
					</div>						
				</div>
			@endforeach
		</div>
	</div>
@endsection