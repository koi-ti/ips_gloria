{{ Form::open(array('route' => array('util.cart.destroy', $index), 'method' => 'DELETE', 'id' => "form-remove-$item->_key"."_$index")) }}
	{{ Form::hidden('_key',$item->_key) }}
	{{ Form::hidden('_template',$item->_template) }}
	<button type="button" id="btn-remove-{{ $item->_key.$index }}" class="btn btn-default btn-md">
		<span class="glyphicon glyphicon-minus-sign"></span>
	</button>
{{ Form::close() }}
<script type="text/javascript">
	$(function() {
		$("#btn-remove-{{ $item->_key.$index }}").click(function() {
			$("#form-remove-{{ $item->_key.'_'.$index }}").submit();
		});	

		$("#form-remove-{{ $item->_key.'_'.$index }}").on('submit', function(event){                             
            var url = $(this).attr('action');
            event.preventDefault();
			utilList.remove(url,$("#form-remove-{{ $item->_key.'_'.$index }}").serialize(), '{{ $layer }}')
		});
	});
</script>