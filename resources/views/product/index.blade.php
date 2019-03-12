@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
						Create new product
					</button>
				</div>
				<div class="card-body">
					Hi guy!
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="myModalLabel">Create product</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									
								</div>
								<div class="modal-body">
									@if ($errors->any())
									<div class="alert alert-danger">
										<ul>
											@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
									@endif
									{!! Form::open(['url' =>[route('product.store') ] , 'method'=> 'POST','files' => true]) !!}
									<div class="form-group">
										{!! Form::label('name', 'User name') !!}
										{!! Form::text('name', old('user_name'), ['class' => 'form-control', 'placeholder' => 'User name']) !!}
									</div>
									{{-- User name --}}

									<div class="form-group">
										{!! Form::label('email', 'Email') !!}
										{!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Email']) !!}
									</div>
									{{-- email --}}

									<div class="form-group">
										{!! Form::label('password', 'Password') !!}
										{!! Form::text('password', old('password'), ['class' => 'form-control', 'placeholder' => 'Password']) !!}
									</div>
									{{-- Password --}}



									<button type="submit" class="btn btn-success">Submit</button>
									{!! Form::close() !!}

								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection