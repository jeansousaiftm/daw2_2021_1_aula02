@extends("template.default")

@section("titulo", "Clientes")

@section("cadastro")
	
	<h3>Clientes</h3>
	
	<form method="POST" action="/cliente" class="row">
		@csrf
		<div class="form-group col-4">
			<label for="nome">Nome: </label>
			<input type="text" id="nome" name="nome" value="{{ $cliente->nome }}" class="form-control" />
		</div>
		<div class="form-group col-4">
			<label for="email">E-mail: </label>
			<input type="email" id="email" name="email" value="{{ $cliente->email }}" class="form-control" />
		</div>
		<div class="form-group col-4">
			<a class="btn btn-primary" href="/cliente">Novo</a>
			<input type="hidden" id="id" name="id" value="{{ $cliente->id }}" />
			<button class="btn btn-success" type="submit">Salvar</button>
		</div>
	</form>
		
@endsection
		
@section("listagem")

	<table class="table table-striped">
		<thead>
			<tr>
				<th>Nome</th>
				<th>E-mail</th>
				<th>Telefones</th>
				<th>Edit</th>
				<th>Del</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($clientes as $cliente)
				<tr>
					<td>{{ $cliente->nome }}</td>
					<td>{{ $cliente->email }}</td>
					<td>
						<a data-fancybox data-type="iframe" class="btn btn-success" href="/cliente_telefone?cliente={{ $cliente->id }}">Telefone</a>
					</td>
					<td>
						<a class="btn btn-warning" href="/cliente/{{ $cliente->id }}/edit">Edit</a>
					</td>
					<td>
						<form action="/cliente/{{ $cliente->id }}" method="POST">
							@csrf
							<input type="hidden" name="_method" value="DELETE" />
							<button  class="btn btn-danger" type="submit" onclick="return confirm('Tem Certeza?');">Del</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	
	<script>
		
		$(document).ready(function() {
			
			$('[data-fancybox]').fancybox({
				toolbar  : false,
				smallBtn : true,
				iframe : {
					preload : false,
					css : {
						width : '600px',
						height : '400px'
					}
				}
			});
			
		});
		
	</script>

@endsection