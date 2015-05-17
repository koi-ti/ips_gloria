( function( $, window, document, undefined ){

    var Misc = function( a ){

        // attributes or global vars here

    }

    Misc.prototype = {  
        /**
        * Inializes the functions when DOM ready
        */
        initialize: function() {
        }

    	/**
        * Check session app
        */
        , searchCustomer: function (addresses) {
            _this = this;
            var inputVal = $("#cliente_nit").val();
	        var numericReg = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
	        
	        $('#cliente').val('')
	        $('#cliente_nombre').val('')

	        if(!numericReg.test(inputVal)) {
	            $("#cliente_nit").val('')
	        }else{
	            $.ajax({
	                type: 'post',
	                cache: false,
	                dataType: 'json',
	                data: { nit : inputVal },
	                url : document.url + '/clientes/buscar',
	                beforeSend: function() {
	                    $('#loading-app').modal('show');
	                },
	                success: function(data) {
	                    $('#loading-app').modal('hide')

	                    _customer = 0;
	                    if(data.success == false) {
	                        $('#cedula').val('')                                  
	                        $('#cliente_nit').val('')                                  
	                        $('#cliente_nombre').val('')                                
	                    }else{                          
	                        $('#cliente').val(data.customer.id)
	                        $('#cliente_nit').val(data.customer.nit)
	                        $('#cliente_nombre').val(data.customer.nombre)  
	                       	_customer = data.customer.id;
	                    }

	                    // Address customer
                        if(addresses) {
                    		_this.searchCustomerAddress( _customer );
                        }  
	                },
	                error: function(xhr, textStatus, thrownError) {
	                    $('#loading-app').modal('hide');
	                    $('#error-app').modal('show');
	                    $("#error-app-label").empty().html("No hay respuesta del servidor - Consulte al administrador.");               
	                }
	            });                                         
	        }
        }

        /**
        * Search address
        */
        , searchCustomerAddress: function (customer) {
        	$('#cliente_direccion').find('option:gt(0)').remove();
        	if(customer) {
				$.ajax({
	                type: 'post',
	                cache: false,
	                dataType: 'json',
	                data: { cliente : customer },
	                url : document.url + '/clientes/direcciones',
	                beforeSend: function() {
	                    $('#loading-app').modal('hide')
	                },
	                success: function(data) {
	                    $('#loading-app').modal('hide')

	                    if(data.success == true) {
	                        $.each( data.addresses, function( key, value ) {
								$('#cliente_direccion').append($("<option></option>")
							     	    .attr("value",key).text(value)); 							
     						});                              
	                    }	                    
	                },
	                error: function(xhr, textStatus, thrownError) {
	                    $('#loading-app').modal('hide');
	                    $('#error-app').modal('show');
	                    $("#error-app-label").empty().html("No hay respuesta del servidor - Consulte al administrador.");               
	                }
	            });        	
			}
     	}

     	/**
        * pagination
        */
        , pagination: function (form, div, url) {
        	$.ajax({
				url: url,
				type: "GET",
				data: $('#'+form).serialize(),
				datatype: "html",
				beforeSend: function() {
					$('#loading-app').modal('show');
				}
			})
			.done(function(data) {				
				$('#loading-app').modal('hide');
				$("#"+div).empty().html(data.html);
			})
			.fail(function(jqXHR, ajaxOptions, thrownError)
			{
				$('#loading-app').modal('hide');
				$('#error-app').modal('show');
				$("#error-app-label").empty().html("No hay respuesta del servidor - Consulte al administrador.");				
			});
     	}

     	/**
        * search
        */
        , search: function (form, div, url) {
			$.ajax({	
				url: document.url + url,		
				type : 'get',
				data: $('#'+form).serialize(),	
				datatype: "html",
				beforeSend: function() {
					$('#loading-app').modal('show')
				}
			})
			.done(function(data) {		
				$('#loading-app').modal('hide')
				$("#"+div).empty().html(data.html)
			})
			.fail(function(jqXHR, ajaxOptions, thrownError)
			{
				$('#loading-app').modal('hide');
				$('#error-app').modal('show');
				$("#error-app-label").empty().html("No hay respuesta del servidor - Consulte al administrador.");				
			});
     	}	
    };
    window.Misc = new Misc();
    window.Misc.initialize();

})( jQuery, this, this.document );