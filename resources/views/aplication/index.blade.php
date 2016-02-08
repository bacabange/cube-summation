@extends('layout.base')

@section('content')
	<h1>Cube Summation <small>by: Stiven Castillo</small></h1>

	<div class="row">
		<div class="col-md-6">
			{!! Form::open(['route' => 'config_save', 'method' => 'post', 'data-toggle' => 'validator', 'role' => 'form', 'id' => 'form-config']) !!}
				<div class="form-group">
					{!! Form::label('test', 'Test') !!}
					{!! Form::number('test', null, ['class' => 'form-control', 'required' => true]) !!}
					<p class="help-block with-errors"></p>
				</div>

				<div class="form-group">
					{!! Form::label('size', 'Tamaño de Cubo') !!}
					{!! Form::number('size', null, ['class' => 'form-control', 'required' => true]) !!}
					<p class="help-block with-errors"></p>
				</div>

				<div class="form-group">
					{!! Form::label('cant', 'Cantidad de Comandos') !!}
					{!! Form::number('cant', null, ['class' => 'form-control', 'required' => true]) !!}
					<p class="help-block with-errors"></p>
				</div>

				<button type="submit" class="btn btn-primary pull-right">Guardar</button>
			{!! Form::close() !!}
		</div>

		<div class="col-md-6">
			
		</div>
	</div>

@endsection