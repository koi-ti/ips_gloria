<table align="center" width="100%" class="table table-striped">
	@foreach ($childrens as $children) 
		{{--*/ $permits = Permission::where('modulo', $children->id)->where('rol', $role)->first(); /*--}}
		<tr>
			<th align="center">
				<span class="glyphicon glyphicon-tag"></span>
			</th>
			<td align="left" width="30%"><strong>{{ $children->nombre }}</strong></td>
			<td width="10%">
				C: 
				<a href="#" id="link_children_consulta_{{ $children->id }}" title="Cambiar permiso">
					@if(@$permits->consulta) 
						<span class="glyphicon glyphicon-ok" style="color:#21610B;"></span>
					@else 
						<span class="glyphicon glyphicon-remove" style="color:#8A0808;"></span>
					@endif
				</a>
			<td>
			<td width="10%">
				A:
				<a href="#" id="link_children_adiciona_{{ $children->id }}" title="Cambiar permiso">
					@if(@$permits->adiciona) 
						<span class="glyphicon glyphicon-ok" style="color:#21610B;"></span>
					@else 
						<span class="glyphicon glyphicon-remove" style="color:#8A0808;"></span>
					@endif
				</a>
			<td>
			<td width="10%">
				E:
				<a href="#" id="link_children_modifica_{{ $children->id }}" title="Cambiar permiso">
					@if(@$permits->modifica) 
						<span class="glyphicon glyphicon-ok" style="color:#21610B;"></span>
					@else 
						<span class="glyphicon glyphicon-remove" style="color:#8A0808;"></span>
					@endif
				</a>
			<td>
			<td width="10%"> 
				B:
				<a href="#" id="link_children_borra_{{ $children->id }}" title="Cambiar permiso">
					@if(@$permits->borra) 
						<span class="glyphicon glyphicon-ok" style="color:#21610B;"></span>
					@else 
						<span class="glyphicon glyphicon-remove" style="color:#8A0808;"></span>
					@endif
				</a>
			<td>
			<td width="10%"> 
				OP1:
				<a href="#" id="link_children_otrouno_{{ $children->id }}" title="Cambiar permiso">
					@if(@$permits->otrouno) 
						<span class="glyphicon glyphicon-ok" style="color:#21610B;"></span>
					@else 
						<span class="glyphicon glyphicon-remove" style="color:#8A0808;"></span>
					@endif
				</a>
			<td>
			<td width="10%">
				OP2:
				<a href="#" id="link_children_otrodos_{{ $children->id }}" title="Cambiar permiso">
					@if(@$permits->otrodos) 
						<span class="glyphicon glyphicon-ok" style="color:#21610B;"></span>
					@else 
						<span class="glyphicon glyphicon-remove" style="color:#8A0808;"></span>
					@endif
				</a>
			<td>
		</tr>
		<script type="text/javascript">
			$(function() {
				$("#link_children_consulta_"+{{ $children->id }}).click(function( event ) {
					event.preventDefault();
		            window.Misc.changePermission('{{ $children->id }}', '{{ $children->nivel1 }}', '{{ $role }}', 'consulta'); 
				});
				$("#link_children_adiciona_"+{{ $children->id }}).click(function( event ) {
					event.preventDefault();
		            window.Misc.changePermission('{{ $children->id }}', '{{ $children->nivel1 }}', '{{ $role }}', 'adiciona'); 
				});
				$("#link_children_modifica_"+{{ $children->id }}).click(function( event ) {
					event.preventDefault();
		            window.Misc.changePermission('{{ $children->id }}', '{{ $children->nivel1 }}', '{{ $role }}', 'modifica'); 
				});
				$("#link_children_borra_"+{{ $children->id }}).click(function( event ) {
					event.preventDefault();
		            window.Misc.changePermission('{{ $children->id }}', '{{ $children->nivel1 }}', '{{ $role }}', 'borra'); 
				});
				$("#link_children_otrouno_"+{{ $children->id }}).click(function( event ) {
					event.preventDefault();
		            window.Misc.changePermission('{{ $children->id }}', '{{ $children->nivel1 }}', '{{ $role }}', 'otrouno'); 
				});
				$("#link_children_otrodos_"+{{ $children->id }}).click(function( event ) {
					event.preventDefault();
		            window.Misc.changePermission('{{ $children->id }}', '{{ $children->nivel1 }}', '{{ $role }}', 'otrodos'); 
				});
			});
		</script>
	@endforeach
</table>