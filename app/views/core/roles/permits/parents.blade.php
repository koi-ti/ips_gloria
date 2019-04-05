<table align="center" width="100%" class="table table-bordered">	  
	@foreach($parents as $parent)
		<table align="center" width="100%" class="table table-bordered">
			<tr>
				<th align="left" width="5%">
					<a href="#" id="link_parent_{{ $parent->id }}">
						<span class="glyphicon glyphicon-plus-sign"></span>
					</a>
				</th>
				<td align="left" width="95%"><strong>{{ $parent->nombre }}</strong></td>
			</tr>
			<tr>
				<td colspan="2">
					<div id="parent_{{ $parent->id }}"></div>
				</td>
			</tr>
		</table>
		<script type="text/javascript">
			$(function() {
				$("#link_parent_"+{{ $parent->id }}).click(function( event ) {
					event.preventDefault();
		            window.Misc.childrenPermits('{{ $parent->id }}', '{{ $parent->nivel1 }}', '{{ $role }}'); 
				});
			});
		</script>
	@endforeach
</table>