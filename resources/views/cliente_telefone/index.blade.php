@extends("template.popup")

@section("cadastro")
	
	<form action="/cliente_telefone" method="POST" class="row">
		
		@csrf
		<div class="form-group col-6">
			<label for="telefone">Telefone: </label>
			<input type="text" id="telefone" name="telefone" value="{{ $cliente_telefone->telefone }}" class="form-control" />
		</div>
		<div class="form-group col-4">
			<a class="btn btn-primary" href="/cliente_telefone?cliente={{ $cliente_telefone->cliente }}">Novo</a>
			<input type="hidden" id="id" name="id" value="{{ $cliente_telefone->id }}" />
			<input type="hidden" id="cliente" name="cliente" value="{{ $cliente_telefone->cliente }}" />
			<button class="btn btn-success" type="submit">Salvar</button>
		</div>
	</form>
		
	</form>
	
@endsection

@section("listagem")
	
	<table class="table table-striped">
		
		<thead>
			<tr>
				<th>Telefone</th>
				<th>Del</th>
			</tr>
		</thead>
		
		<tbody>
			
			@foreach ($cliente_telefones as $cliente_telefone)
				
				<tr>
					<td>{{ $cliente_telefone->telefone }}</td>
					<td>
						<form action="/cliente_telefone/{{ $cliente_telefone->id }}" method="POST">
							@csrf
							<input type="hidden" name="_method" value="DELETE" />
							<button  class="btn btn-danger" type="submit" onclick="return confirm('Tem Certeza?');">Del</button>
						</form>
					</td>
				</tr>
				
			@endforeach
			
		</tbody>
		
	</table>
	
@endsection