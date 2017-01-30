/**
* Funcion para el boton de induccion
*/
$(document).ready(function() {
	$('input[type=radio][name=induccion]').change(function() {
		var id = document.getElementById("id").value;
		var valor = this.value;
		$.ajax({
			data: {'id': id,'valor': valor},
			type: "POST",
			url: "php/cambiarInduccion.php",
			success: function(data)
			{
				alert("Modificación de inducción correcta, ahora es " + valor);
			}
		});
	});
});

/**
* Funcion para agregar observacion a las personas
*/
$(function(){
	if(document.getElementById("agregarObservacion")!=null){
		document.getElementById("agregarObservacion").addEventListener("click", function(){
			if(document.getElementById("observacion")!=null)
				var observacion = document.getElementById("observacion").value;
			document.getElementById("observacion").value="";
			var seleccionados = "";
			var seleccionadosText = "";
			var i = 0;
			//SE CAPTURAN TODOS LOS CHECKBOX SELECCIONADOS
			$('.docsCheck:checked').each(
			    function() {
			    	if(i==0){
			    		seleccionados = seleccionados + $(this).val();
			    		seleccionadosText = seleccionadosText + $("label[for='"+ $(this).val() +"']").text();
			    		i=1;
			    	}else{
			    		seleccionados = seleccionados + "," + $(this).val();
			    		seleccionadosText = seleccionadosText + "," + $("label[for='"+ $(this).val() +"']").text();
			    	}
			    	$(this).attr('checked',false);
			    }
			);
			$.ajax({
				data: {
					'observacion':observacion,
					'tipo':'Persona',
					'documentos':seleccionados,
					'documentosText': seleccionadosText},
				type: "POST",
				url: "php/addObservacion.php",
				success: function(data)
				{
					alert("Observación enviada satisfactoriamente.");					
				}
			});

		});
	}
});
/**
* Funcion para el boton acreditar
*/
$(function(){
	if(document.getElementById("acreditar")!=null){
		document.getElementById("acreditar").addEventListener("click", function(){
			/*
			* Revisamos que todas las fechas se encuentren ingresadas al sistema.
			*/
			//Primero verificamos si aplica el documento o no
			if(document.getElementById("TDVAL_2")){
				if(document.getElementById("VAL_2")){
					if(document.getElementById("VAL_2").value){
						var val2 = document.getElementById("VAL_2").value;
					}else{
						return alert("Favor seleccione la fecha de caducidad del archivo de inducción.");
					}
				}else{
					
				}
			}else{
				var val2 = "no";
			}

			if(document.getElementById("TDVAL_5")){
				if(document.getElementById("VAL_5")){
					if(document.getElementById("VAL_5").value){
						var val5 = document.getElementById("VAL_5").value;
					}else{
						return alert("Favor seleccione la fecha de caducidad de la cédula de identidad.");
					}
				}else{
					
				}
			}else{
				var val5 = "no";
			}

			if(document.getElementById("TDVAL_6")){
				if(document.getElementById("VAL_6")){
					if(document.getElementById("VAL_6").value){
						var val6 = document.getElementById("VAL_6").value;
					}else{
						return alert("Favor seleccione la fecha de caducidad del Exámen Pre-Ocupacional.");
					}
				}else{
					
				}
			}else{
				var val6 = "no";
			}

			if(document.getElementById("TDVAL_14")){
				if(document.getElementById("TDVAL_14").innerHTML!="ARCHIVO FALTANTE"){
					if(document.getElementById("VAL_14")){
						if(document.getElementById("VAL_14").value){
							var val14 = document.getElementById("VAL_14").value;
						}else{
							return alert("Favor seleccione la fecha de caducidad del Certificado Especial.");
						}
					}else{
						
					}
				}else{
					var val14 = "no";
				}
			}else{
				var val14 = "no";
			}

			if(document.getElementById("TDVAL_20")){
				if(document.getElementById("VAL_20")){
					if(document.getElementById("VAL_20").value){
						var val20 = document.getElementById("VAL_20").value;
					}else{
						return alert("Favor seleccione la fecha de caducidad de la Documentación legal del Vehículo.");
					}
				}else{
					
				}
			}else{
				var val20 = "no";
			}

			if(document.getElementById("TDVAL_21")){
				if(document.getElementById("VAL_21")){
					if(document.getElementById("VAL_21").value){
						var val21 = document.getElementById("VAL_21").value;
					}else{
						return alert("Favor seleccione la fecha de caducidad del Check list del vehículo.");
					}
				}else{
					
				}
			}else{
				var val21 = "no";
			}

			if(document.getElementById("TDVAL_22")){
				if(document.getElementById("VAL_22")){
					if(document.getElementById("VAL_22").value){
						var val22 = document.getElementById("VAL_22").value;
					}else{
						return alert("Favor seleccione la fecha de caducidad de la licencia de conducir.");
					}
				}else{
					
				}
			}else{
				var val22 = "no";
			}

			if(document.getElementById("TDVAL_23")){
				if(document.getElementById("VAL_23")){
					if(document.getElementById("VAL_23").value){
						var val23 = document.getElementById("VAL_23").value;
					}else{
						return alert("Favor seleccione la fecha de caducidad de la visa de trabajo.");
					}
				}else{
					
				}
			}else{
				var val23 = "no";
			}


			$.ajax({
				data: {
					'val2':val2,
					'val5':val5,
					'val6':val6,
					'val14':val14,
					'val20':val20,
					'val21':val21,
					'val22':val22,
					'val23':val23},
				type: "POST",
				url: "php/acreditarPersonal.php",
				success: function(data)
				{	
					if(data=="Acreditado"){
						$("#estadoId").html(data);
	                    $("#estado").html("Aprobado");
	                    $("#estado").removeClass("pendiente");
	                    $("#estado").addClass("estado ok");
	                    alert("¡Trabajador acreditado satisfactoriamente!");	
	                    document.getElementById("acreditar").disabled = true;
					}else{
						alert("Hubo un error en el proceso, vuelva a intentarlo.");
					}
				}
			});
		});
	}
});

function cambiarAlerta(id,nuevoEstado){
	$.ajax({
		data: {
			'id':id,
			'nuevoEstado':nuevoEstado},
			type: "POST",
			url: "php/cambiarAlerta.php",
			success: function(data)
			{
				if(nuevoEstado==0){
					var link = '<a onclick="cambiarAlerta(' + id + ',1);">Mostrar</a>';
					document.getElementById("btnEstado").innerHTML = link;
					$("#visibilidad").addClass("btn-danger");
					$("#visibilidad").removeClass("btn-success");
					document.getElementById("visibilidad").innerHTML = "OCULTO";
				}
				if(nuevoEstado==1){
					var link = '<a onclick="cambiarAlerta(' + id + ',0);">Ocultar</a>';
					document.getElementById("btnEstado").innerHTML = link;
					$("#visibilidad").addClass("btn-success");
					$("#visibilidad").removeClass("btn-danger");	
					document.getElementById("visibilidad").innerHTML = "VISIBLE";
				}
			}
		});
}