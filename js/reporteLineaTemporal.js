function llenarContratos()
{
	var empresaSelect = document.getElementById("empresa");
	var contratos = document.getElementById("contratos");
	var seleccionada = empresaSelect.options[empresaSelect.selectedIndex].value
	//Limpiamos los Trabajadores
	trabajadores.options.length = 0;
	trabajadores.options[0] = new Option("Seleccionar Trabajador...","0");
	if(seleccionada!=0){
		$.ajax({
			data: {'empresa':seleccionada, 'tipo':'LineaTiempo'},
			type: "POST",
			datatype: "json",
			url: "php/getContratosReporte.php",
			success: function(response)
			{
				contratos.options.length = 0;
				if(response!=0){
					var contratosRecibidos = JSON.parse(response); 
					if(contratosRecibidos.length<1){    
						contratos.options[0] = new Option("Seleccionar Contrato...","0");
					}else{
						for (var i = 0; i < contratosRecibidos.length; i++)
						{                
							contratos.options[i] = new Option(contratosRecibidos[i].numero,contratosRecibidos[i].id);
						}
					}
				}else{
					contratos.options[0] = new Option("No existen contratos definidos.","");
				}            
			}
		});
	}else{
		contratos.options.length = 0;
		contratos.options[0] = new Option("Seleccionar Contrato...","0");
		trabajadores.options.length = 0;
		trabajadores.options[0] = new Option("Seleccionar Trabajador...","0");

	}
}

function llenarTrabajadores()
{
	var ordenContratos = document.getElementById("contratos");
	var trabajadores = document.getElementById("trabajadores");
	var seleccionada = ordenContratos.options[ordenContratos.selectedIndex].value
	if(seleccionada!=0){
		$.ajax({
			data: {'contrato':seleccionada},
			type: "POST",
			datatype: "json",
			url: "php/getTrabajadoresReporte.php",
			success: function(response)
			{
				trabajadores.options.length = 0;
				if(response!=0){
					var trabajadoresRecibidos = JSON.parse(response); 
					if(trabajadoresRecibidos.length<1){    
						trabajadores.options[0] = new Option("Seleccionar Trabajador...","0");
					}else{
						for (var i = 0; i < trabajadoresRecibidos.length; i++)
						{                
							trabajadores.options[i] = new Option(trabajadoresRecibidos[i].datos,trabajadoresRecibidos[i].id);
						}
					}
				}else{
					trabajadores.options[0] = new Option("No existen trabajadores.","");
				}            
			}
		});
	}else{
		trabajadores.options.length = 0;
		trabajadores.options[0] = new Option("Seleccionar Trabajador...","0");
	}
}