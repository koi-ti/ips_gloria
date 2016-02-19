( function( $, window, document, undefined ){

    var Misc = function( a ){

        // attributes or global vars here

    }

    Misc.prototype = {  
        /**
        * Inializes the functions when DOM ready
        */
        initialize: function() {
			$('label.tree-toggler').click(function () {
				$(this).parent().children('ul.tree').toggle(300);
			});
        }

    	/**
        * Check session app
        */
        , searchCustomer: function () {
            _this = this;
            var inputVal = $("#cliente_cedula").val();
	        var numericReg = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
	        
	        $('#cliente').val('')
	        $('#cliente_nombre').val('')
			$("#cliente_imagen").attr("src", '')

	        if(!numericReg.test(inputVal)) {
	            $("#cliente_cedula").val('')
	        }else{
	            $.ajax({
	                type: 'get',
	                cache: false,
	                dataType: 'json',
	                data: { cedula : inputVal },
	                url : document.url + '/pacientes/buscar',
	                beforeSend: function() {
	                    $('#loading-app').modal('show');
	                },
	                success: function(data) {
	                    $('#loading-app').modal('hide')

	                    _customer = 0;
	                    if(data.success == false) {
	                        $('#cedula').val('')                                  
	                        $('#cliente_cedula').val('')                                  
	                        $('#cliente_nombre').val('') 
    						$("#cliente_imagen").attr("src", '')
	                    }else{                          
	                        $('#cliente').val(data.customer.id)
	                        $('#cliente_cedula').val(data.customer.cedula)
	                        $('#cliente_nombre').val(data.customer.nombre)  
    						$("#cliente_imagen").attr("src", data.customer.imagen)
	                       	_customer = data.customer.id;
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

     	/**
        * search children permits
        */
        , childrenPermits: function (module, nivel1, role) {
			$.ajax({	
				url: document.url + '/util/permisos/nivel1',		
				type : 'get',
				data: { 'module': module, 'nivel1': nivel1, 'role': role},	
				datatype: "html"
			})
			.done(function(data) {		
				$("#parent_"+module).empty().html(data.html)
			})
			.fail(function(jqXHR, ajaxOptions, thrownError)
			{
				$('#error-app').modal('show');
				$("#error-app-label").empty().html("No hay respuesta del servidor - Consulte al administrador.");				
			});
     	}

     	/**
        * Change permission
        */
        , changePermission: function (module, nivel1, role, permission) {
            _this = this;
			$.ajax({	
				url: document.url + '/util/permisos/cambiar',		
				type : 'post',
				data: { '_token': $('meta[name="csrf-token"]').attr('content'), 'module': module, 'nivel1': nivel1, 'role': role, 'permission': permission},	
				datatype: "html"
			})
			.done(function(data) {		
				if(data.success == true) {
            		_this.childrenPermits( module, nivel1, role );
                }
			})
			.fail(function(jqXHR, ajaxOptions, thrownError)
			{
				$('#error-app').modal('show');
				$("#error-app-label").empty().html("No hay respuesta del servidor - Consulte al administrador.");				
			});
     	} 

     	/**
        * Search customer
        */
        , searchCustomers: function (cedula, nombre) {
            _this = this;
            if((cedula!=undefined && cedula!='') || (nombre!=undefined && nombre!='')){
	            $.ajax({    
					url: document.url + '/pacientes/filtrar',		
	                type : 'get',
	                data: {'cedula' : cedula, 'nombre': nombre}, 
	                datatype: "html",
	                beforeSend: function() {
	                    $('#loading-app').modal('show')
	                }
	            })
	            .done(function(data) {      
	                $('#loading-app').modal('hide')
	                $('#customers').empty().html(data.html)
	            })
	            .fail(function(jqXHR, ajaxOptions, thrownError)
	            {
	                $('#loading-app').modal('hide');
	                $('#error-app').modal('show');
	                $("#error-app-label").empty().html("No hay respuesta del servidor - Consulte al administrador.");               
	            });
	     	}
     	}

     	/**
        * setIMC
        */
        , setIMC: function (peso, estatura) {
        	var numericReg = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
	        
	        if(!numericReg.test(peso) || !numericReg.test(estatura)) {
	            $("#imc").val('')
	        }else{
	        	estatura = (estatura/100);
	        	var imc = Math.round(peso / (estatura*estatura));
	        	$("#imc").val( imc );
	        	this.setIMCEval( imc );
	        }
        }

        /**
        * setIMC 
        */
        , setIMCEval: function (imc) {
        	var numericReg = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
	        
	        if(!numericReg.test(imc) || !numericReg.test(imc)) {
	            $("#imc_text").val('')
	        }else {
	        	var eval = '';
	        	if( imc < 18.5) {
	       			eval = 'Peso insuficiente';
	        	}else if( imc >= 18.5 && imc <=24.9){
	       			eval = 'Normopeso';
	        	}else if( imc >= 25 && imc <=26.9){
	       			eval = 'Sobrepeso grado I';
	        	}else if( imc >= 27 && imc <= 29.9){
	       			eval = 'Sobrepeso grado II (preobesidad)';
	        	}else if( imc >= 30 && imc <= 34.9){
	       			eval = 'Obesidad de tipo I';
	        	}else if( imc >= 35 && imc <= 39.9){
	       			eval = 'Obesidad de tipo II';
	        	}else if( imc >= 40 && imc <= 49.9){
	       			eval = 'Obesidad de tipo III (mórbida)';
	        	}else if( imc >= 50){
	       			eval = 'Obesidad de tipo IV (extrema)';
	        	}
	        	$("#imc_text").text(eval)
	   			// <18,5 Peso insuficiente	
				// 18,5-24,9 Normopeso	
				// 25-26,9	Sobrepeso grado I
				// 27-29,9	Sobrepeso grado II (preobesidad)
				// 30-34,9	Obesidad de tipo I
				// 35-39,9	Obesidad de tipo II
				// 40-49,9	Obesidad de tipo III (mórbida)
				// >50	Obesidad de tipo IV (extrema)
	        }
        }

        /**
		 * Funcion que devuelve true o false dependiendo de si la fecha es correcta.
		 * Tiene que recibir el dia, mes y año
		 */
		, isValidDate: function(day,month,year) {
		    var dteDate;
		    month=month-1;
		    dteDate=new Date(year,month,day);
		 
		    //Devuelva true o false...
		    return ((day==dteDate.getDate()) && (month==dteDate.getMonth()) && (year==dteDate.getFullYear()));
		}
		 
		/**
		 * Funcion para validar una fecha
		 * Tiene que recibir:
		 *  La fecha en formato ingles yyyy-mm-dd
		 * Devuelve:
		 *  true-Fecha correcta
		 *  false-Fecha Incorrecta
		 */
		, validateFecha: function(fecha)
		{
		    var patron = new RegExp("^(19|20)+([0-9]{2})([-])([0-9]{1,2})([-])([0-9]{1,2})$");
		 
		    if(fecha.search(patron)==0)
		    {
		        var values=fecha.split("-");
		        if(this.isValidDate(values[2],values[1],values[0]))
		        {
		            return true;
		        }
		    }
		    return false;
		}

        /**
		 * Esta función calcula la edad de una persona y los meses
		 * La fecha la tiene que tener el formato yyyy-mm-dd que es
		 * metodo que por defecto lo devuelve el <input type="date">
		 */
		, calcularEdad: function(fecha) {
		    if(this.validateFecha(fecha)==true)
		    {
		        // Si la fecha es correcta, calculamos la edad
		        var values=fecha.split("-");
		        var dia = values[2];
		        var mes = values[1];
		        var ano = values[0];
		 
		        // cogemos los valores actuales
		        var fecha_hoy = new Date();
		        var ahora_ano = fecha_hoy.getYear();
		        var ahora_mes = fecha_hoy.getMonth()+1;
		        var ahora_dia = fecha_hoy.getDate();
		 
		        // realizamos el calculo
		        var edad = (ahora_ano + 1900) - ano;
		        if ( ahora_mes < mes )
		        {
		            edad--;
		        }
		        if ((mes == ahora_mes) && (ahora_dia < dia))
		        {
		            edad--;
		        }
		        if (edad > 1900)
		        {
		            edad -= 1900;
		        }
		 
		        // calculamos los meses
		        var meses=0;
		        if(ahora_mes>mes)
		            meses=ahora_mes-mes;
		        if(ahora_mes<mes)
		            meses=12-(mes-ahora_mes);
		        if(ahora_mes==mes && dia>ahora_dia)
		            meses=11;
		 
		        // calculamos los dias
		        var dias=0;
		        if(ahora_dia>dia)
		            dias=ahora_dia-dia;
		        if(ahora_dia<dia)
		        {
		            ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
		            dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
		        }
		 		$("#div_edad").text(edad+" años, "+meses+" meses y "+dias+" días");
		    }else{
		 		$("#div_edad").text('');
		    }
		}		
    };
    window.Misc = new Misc();
    window.Misc.initialize();

})( jQuery, this, this.document );