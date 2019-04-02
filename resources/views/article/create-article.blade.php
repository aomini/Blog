@extends('layouts.app')

@section('contents')
<div class="container">
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<div class="card">
				<h5 class="card-header">Create Article</h5>
				<div class="card-body">
					<form action="/article" method="POST">

						{{ csrf_field() }}
						@csrf
						
						<div class="form-group">
							<label for="">Title</label>
							<input type="text" name="title" class="form-control">
						</div>

						<div class="form-group">
							<label for="">Body</label>
							<textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea>
						</div>

						<button type="submit" class="btn btn-success">Submit</button>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection