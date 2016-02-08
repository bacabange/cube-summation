@extends('layout.base')

@section('content')
	<h1>Cube Summation <small>by: Stiven Castillo</small></h1>

	<div class="row">
		<div class="col-md-12">
			<div id="messages"></div>
		</div>
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
					{!! Form::number('cant', null, ['class' => 'form-control']) !!}
					<p class="help-block with-errors"></p>
				</div>

				<button type="submit" class="btn btn-primary pull-right">Guardar</button>
			{!! Form::close() !!}
		</div>

		<div class="col-md-6">
			{!! Form::open(['route' => 'config_save', 'method' => 'post', 'role' => 'form', 'id' => 'form-command', 'class' => 'hide']) !!}
				
				<div class="row">
					<div class="col-md-8">
						{!! Form::label('command', 'Comando') !!}
						{!! Form::text('command', null, ['class' => 'form-control', 'required' => true, 'id' => 'command']) !!}
					</div>
					
					<div class="col-md-4">
						<label for=""></label>
						<button type="submit" class="btn btn-primary btn-block">Ejecutar</button>
					</div>
				</div>

			{!! Form::close() !!}

			<br>

			<div id="result"></div>

		</div>
	</div>

	<script id="tem-error" type="text/x-handlebars-template">
		<div class="alert alert-danger">
			@{{ message }}
		</div>
	</script>

	<script id="tem-update" type="text/x-handlebars-template">
		<div class="panel panel-default">
			<div class="panel-body">
				<samp>@{{ result }}</samp>
			</div>
		</div>
	</script>

	<script id="tem-query" type="text/x-handlebars-template">
		<div class="panel panel-default">
			<div class="panel-body">
				<samp>@{{ result }}</samp>
				<br>
				<samp>> @{{ total }}</samp>
			</div>
		</div>
	</script>

@endsection