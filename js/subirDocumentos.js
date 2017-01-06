/**
* - Ingreso de documentos al sistema, generando enlace con este hacia el trabajador.
* - Documento: Contrato de Trabajo
*/

/**
* Variable que guarda la carga de un archivo
*/
var cargando = 0;

$(function(){
	$("input[name='file1']").on("change", function(){
		cargando = 1;
		$("#respuesta1").html("Cargando...");
		var formData = new FormData($("#formulario1")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta1").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file2']").on("change", function(){
		cargando = 1;
		$("#respuesta2").html("Cargando...");
		var formData = new FormData($("#formulario2")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta2").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file3']").on("change", function(){
		cargando = 1;
		$("#respuesta3").html("Cargando...");
		var formData = new FormData($("#formulario3")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta3").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file4']").on("change", function(){
		cargando = 1;
		$("#respuesta4").html("Cargando...");
		var formData = new FormData($("#formulario4")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta4").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file5']").on("change", function(){
		cargando = 1;
		$("#respuesta5").html("Cargando...");
		var formData = new FormData($("#formulario5")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta5").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file6']").on("change", function(){
		cargando = 1;
		$("#respuesta6").html("Cargando...");
		var formData = new FormData($("#formulario6")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta6").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file7']").on("change", function(){
		cargando = 1;
		$("#respuesta7").html("Cargando...");
		var formData = new FormData($("#formulario7")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta7").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file8']").on("change", function(){
		cargando = 1;
		$("#respuesta8").html("Cargando...");
		var formData = new FormData($("#formulario8")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta8").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file9']").on("change", function(){
		cargando = 1;
		$("#respuesta9").html("Cargando...");
		var formData = new FormData($("#formulario9")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta9").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file10']").on("change", function(){
		cargando = 1;
		$("#respuesta10").html("Cargando...");
		var formData = new FormData($("#formulario10")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta10").html(datos.link);
				}
		});
	});
});

$(function(){
	$("input[name='file11']").on("change", function(){
		cargando = 1;
		$("#respuesta11").html("Cargando...");
		var formData = new FormData($("#formulario11")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta11").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file12']").on("change", function(){
		cargando = 1;
		$("#respuesta12").html("Cargando...");
		var formData = new FormData($("#formulario12")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta12").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file13']").on("change", function(){
		cargando = 1;
		$("#respuesta13").html("Cargando...");
		var formData = new FormData($("#formulario13")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta13").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file14']").on("change", function(){
		cargando = 1;
		$("#respuesta14").html("Cargando...");
		var formData = new FormData($("#formulario14")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta14").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file15']").on("change", function(){
		cargando = 1;
		$("#respuesta15").html("Cargando...");
		var formData = new FormData($("#formulario15")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta15").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file16']").on("change", function(){
		cargando = 1;
		$("#respuesta16").html("Cargando...");
		var formData = new FormData($("#formulario16")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta16").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file17']").on("change", function(){
		cargando = 1;
		$("#respuesta17").html("Cargando...");
		var formData = new FormData($("#formulario17")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta17").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file18']").on("change", function(){
		cargando = 1;
		$("#respuesta18").html("Cargando...");
		var formData = new FormData($("#formulario18")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta18").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file19']").on("change", function(){
		cargando = 1;
		$("#respuesta19").html("Cargando...");
		var formData = new FormData($("#formulario19")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta19").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file20']").on("change", function(){
		cargando = 1;
		$("#respuesta20").html("Cargando...");
		var formData = new FormData($("#formulario20")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta20").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file21']").on("change", function(){
		cargando = 1;
		$("#respuesta21").html("Cargando...");
		var formData = new FormData($("#formulario21")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta21").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file22']").on("change", function(){
		cargando = 1;
		$("#respuesta22").html("Cargando...");
		var formData = new FormData($("#formulario22")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta22").html(datos.link);
			}
		});
	});
});

$(function(){
	$("input[name='file23']").on("change", function(){
		cargando = 1;
		$("#respuesta23").html("Cargando...");
		var formData = new FormData($("#formulario23")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			dataType:'json',
			contentType: false,
			processData: false,
			success: function(datos)
			{
				cargando = 0;
				if(datos.mensaje!='okey'){
					alert(datos.mensaje);
				}
				$("#respuesta23").html(datos.link);
			}
		});
	});
});

window.onbeforeunload = function exitAlert(){
	if(cargando == 1){
		var alerta = "Aún existen archivos cargando y se perderá el progreso. ¿Desea cerrar? ";
		return alerta;
	}
}

function liberarDocumento(ndoc,tipo){
	$.ajax({
		url: "php/liberarDocumento.php",
		type: "POST",
		data: {'ndoc':ndoc,'tipo':tipo},
		success: function(datos)
		{
			var respuesta = "#respuesta" + ndoc;
			$(respuesta).html("");
			alert("Documento liberado exitosamente.");
		}
	});
	
}

/**
* Funcion que permite guardar toda la informacion de cada uno de los archivos.
*/

$(function(){
	document.getElementById("guardarDocs").addEventListener("click", function(){
		if(cargando==0){
			if(document.getElementById("obs1")!=null)
			var vobs1 = document.getElementById("obs1").value;
			if(document.getElementById("obs2")!=null)
			var vobs2 = document.getElementById("obs2").value;
			if(document.getElementById("obs3")!=null)
			var vobs3 = document.getElementById("obs3").value;
			if(document.getElementById("obs4")!=null)
			var vobs4 = document.getElementById("obs4").value;
			if(document.getElementById("obs5")!=null)
			var vobs5 = document.getElementById("obs5").value;
			if(document.getElementById("obs6")!=null)
			var vobs6 = document.getElementById("obs6").value;
			if(document.getElementById("obs7")!=null)
			var vobs7 = document.getElementById("obs7").value;
			if(document.getElementById("obs8")!=null)
			var vobs8 = document.getElementById("obs8").value;
			if(document.getElementById("obs9")!=null)
			var vobs9 = document.getElementById("obs9").value;
			if(document.getElementById("obs10")!=null)
			var vobs10 = document.getElementById("obs10").value;
			if(document.getElementById("obs11")!=null)
			var vobs11 = document.getElementById("obs11").value;
			if(document.getElementById("obs12")!=null)
			var vobs12 = document.getElementById("obs12").value;
			if(document.getElementById("obs13")!=null)
			var vobs13 = document.getElementById("obs13").value;
			if(document.getElementById("obs14")!=null)
			var vobs14 = document.getElementById("obs14").value;
			if(document.getElementById("obs15")!=null)
			var vobs15 = document.getElementById("obs15").value;
			if(document.getElementById("obs16")!=null)
			var vobs16 = document.getElementById("obs16").value;
			if(document.getElementById("obs17")!=null)
			var vobs17 = document.getElementById("obs17").value;
			if(document.getElementById("obs18")!=null)
			var vobs18 = document.getElementById("obs18").value;
			if(document.getElementById("obs19")!=null)
			var vobs19 = document.getElementById("obs19").value;
			if(document.getElementById("obs20")!=null)
			var vobs20 = document.getElementById("obs20").value;
			if(document.getElementById("obs21")!=null)
			var vobs21 = document.getElementById("obs21").value;
			if(document.getElementById("obs22")!=null)
			var vobs22 = document.getElementById("obs22").value;
			if(document.getElementById("obs23")!=null)
			var vobs23 = document.getElementById("obs23").value;

			if(document.getElementById("val1")!=null)
			var vval1 = document.getElementById("val1").value;
			if(document.getElementById("val2")!=null)
			var vval2 = document.getElementById("val2").value;
			if(document.getElementById("val3")!=null)
			var vval3 = document.getElementById("val3").value;
			if(document.getElementById("val4")!=null)
			var vval4 = document.getElementById("val4").value;
			if(document.getElementById("val5")!=null)
			var vval5 = document.getElementById("val5").value;
			if(document.getElementById("val6")!=null)
			var vval6 = document.getElementById("val6").value;
			if(document.getElementById("val7")!=null)
			var vval7 = document.getElementById("val7").value;
			if(document.getElementById("val8")!=null)
			var vval8 = document.getElementById("val8").value;
			if(document.getElementById("val9")!=null)
			var vval9 = document.getElementById("val9").value;
			if(document.getElementById("val10")!=null)
			var vval10 = document.getElementById("val10").value;
			if(document.getElementById("val11")!=null)
			var vval11 = document.getElementById("val11").value;
			if(document.getElementById("val12")!=null)
			var vval12 = document.getElementById("val12").value;
			if(document.getElementById("val13")!=null)
			var vval13 = document.getElementById("val13").value;
			if(document.getElementById("val14")!=null)
			var vval14 = document.getElementById("val14").value;
			if(document.getElementById("val15")!=null)
			var vval15 = document.getElementById("val15").value;
			if(document.getElementById("val16")!=null)
			var vval16 = document.getElementById("val16").value;
			if(document.getElementById("val17")!=null)
			var vval17 = document.getElementById("val17").value;
			if(document.getElementById("val18")!=null)
			var vval18 = document.getElementById("val18").value;
			if(document.getElementById("val19")!=null)
			var vval19 = document.getElementById("val19").value;
			if(document.getElementById("val20")!=null)
			var vval20 = document.getElementById("val20").value;
			if(document.getElementById("val21")!=null)
			var vval21 = document.getElementById("val21").value;
			if(document.getElementById("val22")!=null)
			var vval22 = document.getElementById("val22").value;
			if(document.getElementById("val23")!=null)
			var vval23 = document.getElementById("val23").value;

			$.ajax({
				data: {
					'obs1':vobs1,
					'obs2':vobs2,
					'obs3':vobs3,
					'obs4':vobs4,
					'obs5':vobs5,
					'obs6':vobs6,
					'obs7':vobs7,
					'obs8':vobs8,
					'obs9':vobs9,
					'obs10':vobs10,
					'obs11':vobs11,
					'obs12':vobs12,
					'obs13':vobs13,
					'obs14':vobs14,
					'obs15':vobs15,
					'obs16':vobs16,
					'obs17':vobs17,
					'obs18':vobs18,
					'obs19':vobs19,
					'obs20':vobs20,
					'obs21':vobs21,
					'obs22':vobs22,
					'obs23':vobs23,
					'val1':vval1,
					'val2':vval2,
					'val3':vval3,
					'val4':vval4,
					'val5':vval5,
					'val6':vval6,
					'val7':vval7,
					'val8':vval8,
					'val9':vval9,
					'val10':vval10,
					'val11':vval11,
					'val12':vval12,
					'val13':vval13,
					'val14':vval14,
					'val15':vval15,
					'val16':vval16,
					'val17':vval17,
					'val18':vval18,
					'val19':vval19,
					'val20':vval20,
					'val21':vval21,
					'val22':vval22,
					'val23':vval23},
				type: "POST",
				url: "php/addDocumentacionTrabajador2.php",
				success: function(data)
				{
					var link = "http://www.chilecop.cl/acreditacion/listarPersonal.php?id=" + data;
					window.location=link;
				}
			});
		} else {
			alert("Aún no se terminan de subir los archivos. Por favor espere...");
		}
	});

});

$(function(){
	document.getElementById("agregarObservacion").addEventListener("click", function(){
		if(document.getElementById("observacion")!=null)
			var observacion = document.getElementById("observacion").value;
		document.getElementById("observacion").value="";
		var seleccionados = "";
		var i = 0;
		//SE CAPTURAN TODOS LOS CHECKBOX SELECCIONADOS
		$('#docsCheck:checked').each(
		    function() {
		    	if(i==0){
		    		seleccionados = seleccionados + $(this).val();
		    		i=1;
		    	}else{
		    		seleccionados = seleccionados + "," + $(this).val();
		    	}
		    	$(this).attr('checked',false);
		    }
		);
		$.ajax({
			data: {
				'observacion':observacion,
				'tipo':'Persona',
				'documentos':seleccionados},
			type: "POST",
			url: "php/addObservacion.php",
			success: function(data)
			{
				alert("Observación enviada satisfactoriamente.");
					
			}
		});

	});
});

