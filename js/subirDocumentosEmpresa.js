/**
* - Ingreso de documentos al sistema, generando enlace con este hacia el trabajador.
* - Documento: Contrato de Trabajo
*/
$(function(){
	$("input[name='file']").on("change", function(){
		var formData = new FormData($("#formulario")[0]);
		var ruta = "php/addDocumentacionEmpresa.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: function(datos)
			{
				$("#respuesta").html(datos);
			}
		});
	});
});

$(function(){
	$("input[name='file2']").on("change", function(){
		var formData = new FormData($("#formulario2")[0]);
		var ruta = "php/addDocumentacionEmpresa.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: function(datos)
			{
				$("#respuesta2").html(datos);
			}
		});
	});
});

$(function(){
	$("input[name='file3']").on("change", function(){
		var formData = new FormData($("#formulario3")[0]);
		var ruta = "php/addDocumentacionEmpresa.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: function(datos)
			{
				$("#respuesta3").html(datos);
			}
		});
	});
});

$(function(){
	$("input[name='file4']").on("change", function(){
		var formData = new FormData($("#formulario4")[0]);
		var ruta = "php/addDocumentacionEmpresa.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: function(datos)
			{
				$("#respuesta4").html(datos);
			}
		});
	});
});

$(function(){
	$("input[name='file5']").on("change", function(){
		var formData = new FormData($("#formulario5")[0]);
		var ruta = "php/addDocumentacionEmpresa.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: function(datos)
			{
				$("#respuesta5").html(datos);
			}
		});
	});
});

$(function(){
	$("input[name='file6']").on("change", function(){
		var formData = new FormData($("#formulario6")[0]);
		var ruta = "php/addDocumentacionEmpresa.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: function(datos)
			{
				$("#respuesta6").html(datos);
			}
		});
	});
});

$(function(){
	$("input[name='file7']").on("change", function(){
		var formData = new FormData($("#formulario7")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: function(datos)
			{
				$("#respuesta7").html(datos);
			}
		});
	});
});

$(function(){
	$("input[name='file8']").on("change", function(){
		var formData = new FormData($("#formulario8")[0]);
		var ruta = "php/addDocumentacionEmpresa.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: function(datos)
			{
				$("#respuesta8").html(datos);
			}
		});
	});
});

$(function(){
	$("input[name='file9']").on("change", function(){
		var formData = new FormData($("#formulario9")[0]);
		var ruta = "php/addDocumentacionEmpresa.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: function(datos)
			{
				$("#respuesta9").html(datos);
			}
		});
	});
});

$(function(){
	$("input[name='file10']").on("change", function(){
		var formData = new FormData($("#formulario10")[0]);
		var ruta = "php/addDocumentacionEmpresa.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: function(datos)
			{
				$("#respuesta10").html(datos);
			}
		});
	});
});



/**
* Funcion que permite guardar toda la informacion de cada uno de los archivos.
*/

$(function(){
	document.getElementById("guardarDocs").addEventListener("click", function(){
		var vval1 = document.getElementById("val1").value;
		var vval2 = document.getElementById("val2").value;
		var vval3 = document.getElementById("val3").value;
		var vval4 = document.getElementById("val4").value;
		var vval5 = document.getElementById("val5").value;
		var vval6 = document.getElementById("val6").value;
		var vval7 = document.getElementById("val7").value;
		var vval8 = document.getElementById("val8").value;
		var vval9 = document.getElementById("val9").value;
		var vval10 = document.getElementById("val10").value;


		$.ajax({
			data: {'val1':vval1,'val2':vval2,'val3':vval3,'val4':vval4,'val5':vval5,'val6':vval6,'val7':vval7,'val8':vval8,'val9':vval9,'val10':vval10},
			type: "POST",
			url: "php/addDocumentacionEmpresa2.php",
			success: function(data)
			{
				alert(data);
			}
		});

	});
});