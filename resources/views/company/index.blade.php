@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
						Create new company
					</button>
				</div>
				<div class="card-body">
					Hi guy!
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="myModalLabel">Create comany</h4>
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
									{!! Form::open(['url' =>[route('company.store') ] , 'method'=> 'POST','files' => true]) !!}
									<div class="form-group">
										{!! Form::label('file', 'Logo:') !!}
										{!! Form::file('file', ['class' => 'field-select'] ) !!}

									</div>
									<div class="form-group">
										{!! Form::label('name', 'Co name') !!}
										{!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Company name']) !!}
									</div>
									{{--  name --}}

									<div class="form-group">
										{!! Form::label('description', 'Description') !!}
										{!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => 'description']) !!}
									</div>
									{{-- description --}}

									<div class="form-group">
										{!! Form::label('country', 'Country') !!}
										{!! Form::text('country', old('country'), ['class' => 'form-control', 'placeholder' => 'country']) !!}
									</div>
									{{-- Country --}}



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