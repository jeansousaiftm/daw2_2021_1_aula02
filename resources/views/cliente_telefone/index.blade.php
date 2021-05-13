@extends("template.popup")

@section("cadastro")
	
	<form action="/cliente_telefone" method="POST" class="row">
		
		@csrf
		<div class="form-group col-6">
			<label for="telefone">Telefone: </label>
			<input type="text" id="telefone" name="telefone" value="{{ $cliente_telefone->telefone }}" class="form-control" />
		</div>
		<div class="form-group col-6">
			
			<label for="preferencial">
				<input type="checkbox" name="preferencial" value="1" /> 
				Telefone Preferencial
			</label><br/>
			
			<a class="btn btn-primary" href="/cliente_telefone?cliente={{ $cliente_telefone->cliente }}">Novo</a>
			<input type="hidden" id="id" name="id" value="{{ $cliente_telefone->id }}" />
			<input type="hidden" id="cliente" name="cliente" value="{{ $cliente_telefone->cliente }}" />
			<button class="btn btn-success" type="submit">Salvar</button>
		</div>
	</form>
		
	<script>
		$(document).ready(function() {
			
			var options =  {
				onKeyPress: function(telefone, e, field, options) {
					var masks = [ '(00) 00000-0000', '(00) 0000-00009' ];
					var mask = (telefone.replace(/\D/g, '').length == 11) ? masks[0] : masks[1];
					$('#telefone').mask(mask, options);
				}
			};

			$('#telefone').mask('(00) 0000-00009', options);
			
			$("span.telefone").each(function() {
				var len = $(this).html().trim().length;
				if (len == 11) {
					$(this).mask('(00) 00000-0000', options);
				} else {
					$(this).mask('(00) 0000-0000', options);
				}
			});
			
			
		});
	</script>
	
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
					<td>
						@if ($cliente_telefone->preferencial == 1)
							<i class="fa fa-star"></i>
						@endif
						<span class="telefone">
							{{ $cliente_telefone->telefone }} 
						</span>
					</td>
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