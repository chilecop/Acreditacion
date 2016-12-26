/**
* - Ingreso de documentos al sistema, generando enlace con este hacia el trabajador.
* - Documento: Contrato de Trabajo
*/
$(function(){
	$("input[name='file']").on("change", function(){
		var formData = new FormData($("#formulario")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
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
		var ruta = "php/addDocumentacionTrabajador.php";
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
		var ruta = "php/addDocumentacionTrabajador.php";
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
		var ruta = "php/addDocumentacionTrabajador.php";
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
		var ruta = "php/addDocumentacionTrabajador.php";
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
		var ruta = "php/addDocumentacionTrabajador.php";
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
		var ruta = "php/addDocumentacionTrabajador.php";
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
		var ruta = "php/addDocumentacionTrabajador.php";
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
		var ruta = "php/addDocumentacionTrabajador.php";
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

$(function(){
	$("input[name='file11']").on("change", function(){
		var formData = new FormData($("#formulario11")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: function(datos)
			{
				$("#respuesta11").html(datos);
			}
		});
	});
});

$(function(){
	$("input[name='file12']").on("change", function(){
		var formData = new FormData($("#formulario12")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: function(datos)
			{
				$("#respuesta12").html(datos);
			}
		});
	});
});

$(function(){
	$("input[name='file13']").on("change", function(){
		var formData = new FormData($("#formulario13")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: function(datos)
			{
				$("#respuesta13").html(datos);
			}
		});
	});
});

$(function(){
	$("input[name='file14']").on("change", function(){
		var formData = new FormData($("#formulario14")[0]);
		var ruta = "php/addDocumentacionTrabajador.php";
		$.ajax({
			url: ruta,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: function(datos)
			{
				$("#respuesta14").html(datos);
			}
		});
	});
});

/**
* Funcion que permite guardar toda la informacion de cada uno de los archivos.
*/

$(function(){
	document.getElementById("guardarDocs").addEventListener("click", function(){
		var vobs1 = document.getElementById("obs1").value;
		var vobs2 = document.getElementById("obs2").value;
		var vobs3 = document.getElementById("obs3").value;
		var vobs4 = document.getElementById("obs4").value;
		var vobs5 = document.getElementById("obs5").value;
		var vobs6 = document.getElementById("obs6").value;
		var vobs7 = document.getElementById("obs7").value;
		var vobs8 = document.getElementById("obs8").value;
		var vobs9 = document.getElementById("obs9").value;
		var vobs10 = document.getElementById("obs10").value;
		var vobs11 = document.getElementById("obs11").value;
		var vobs12 = document.getElementById("obs12").value;
		var vobs13 = document.getElementById("obs13").value;
		var vobs14 = document.getElementById("obs14").value;
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
		var vval11 = document.getElementById("val11").value;
		var vval12 = document.getElementById("val12").value;
		var vval13 = document.getElementById("val13").value;
		var vval14 = document.getElementById("val14").value;


		$.ajax({
			data: {'obs1': vobs1,'obs2':vobs2,'obs3': vobs3,'obs4':vobs4,'obs5': vobs5,'obs6':vobs6,'obs7':vobs7,'obs8':vobs8,'obs9':vobs9,'obs10':vobs10,'obs11':vobs11,'obs12':vobs12,'obs13':vobs13,'obs14':vobs14,
			'val1':vval1,'val2':vval2,'val3':vval3,'val4':vval4,'val5':vval5,'val6':vval6,'val7':vval7,'val8':vval8,'val9':vval9,'val10':vval10,'val11':vval11,'val12':vval12,'val13':vval13,'val14':vval14},
			type: "POST",
			url: "php/addDocumentacionTrabajador2.php",
			success: function(data)
			{
				alert(data);
			}
		});

	});
});