
$(document).ready(function(){
  var datos ={
    type: "pie",
    data : {
      datasets : [{
        data : [
        5,
        10,
        40,
        12,
        23,
        ],
        backgroundColor:[
        "#F7464A",
        "#46BFBD",
        "#FDB45C",
        "#949FB1",
        "#4D5360",
        ],
      }],
      labels : [
      "Garita 1",
      "Garita 2",
      "Garita 3",
      "Garita 4",
      "Garita 5",
      ]
    },
    options: {
      responsive : true,
    }
  };

  var canvas = document.getElementById("chart").getContext('2d');
  window.pie = new Chart(canvas, datos);

  setInterval(function(){
    datos.data.datasets.splice(0);
    var newData = {
      data : [
      getRandom(),
      getRandom(),
      getRandom(),
      getRandom(),
      getRandom()
      ],
      backgroundColor:[
      "#F7464A",
      "#46BFBD",
      "#FDB45C",
      "#949FB1",
      "#4D5360",
      ]
    };
    datos.data.datasets.push(newData);
    window.pie.update();
  },1000);

  /*

  function getRandom(){
    return Math.round(Math.random()*100);
  }

  */

  function fecha(d, fecha)
  {
   var Fecha = new Date();
   var sFecha = fecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
   var sep = sFecha.indexOf('/') != -1 ? '/' : '-'; 
   var aFecha = sFecha.split(sep);
   var fecha = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
   fecha= new Date(fecha);
   fecha.setDate(fecha.getDate()+parseInt(d));
   var anno=fecha.getFullYear();
   var mes= fecha.getMonth()+1;
   var dia= fecha.getDate();
   mes = (mes < 10) ? ("0" + mes) : mes;
   dia = (dia < 10) ? ("0" + dia) : dia;
   var fechaFinal = dia+sep+mes+sep+anno;
   return (fechaFinal);
 }

  // GRÁFICO DE AREA DE TRABAJO
  var id = 2;
  $.ajax({
    data: {'id': id},
    type: "POST",
    url: "php/graficos/graficoAcreditacionesMensuales.php",
    dataType:'json',
    contentType: false,
    processData: false,
    success: function(datos)
    {
      var datosAcreditados = {
        labels : ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
        datasets : [{
          label : "Acreditados",
          backgroundColor : "rgba(220,220,220,1)",
          data : [
          datos.Enero.a,
          datos.Febrero.a,
          datos.Marzo.a,
          datos.Abril.a,
          datos.Mayo.a,
          datos.Junio.a,
          datos.Julio.a,
          datos.Agosto.a,
          datos.Septiembre.a,
          datos.Octubre.a,
          datos.Noviembre.a,
          datos.Diciembre.a]
        },
        {
          label : "Pendientes",
          backgroundColor : "rgba(239,176,42,1)",
          data : [
          datos.Enero.p,
          datos.Febrero.p,
          datos.Marzo.p,
          datos.Abril.p,
          datos.Mayo.p,
          datos.Junio.p,
          datos.Julio.p,
          datos.Agosto.p,
          datos.Septiembre.p,
          datos.Octubre.p,
          datos.Noviembre.p,
          datos.Diciembre.p]
        },
        {
          label : "Rechazados",
          backgroundColor : "rgba(240,187,205,1)",
          data : [
          datos.Enero.r,
          datos.Febrero.r,
          datos.Marzo.r,
          datos.Abril.r,
          datos.Mayo.r,
          datos.Junio.r,
          datos.Julio.r,
          datos.Agosto.r,
          datos.Septiembre.r,
          datos.Octubre.r,
          datos.Noviembre.r,
          datos.Diciembre.r,
          ]
        }]
      };
      var canvas = document.getElementById('chart').getContext('2d');
      window.bar = new Chart(canvas, {
        type : "bar",
        data: datosAcreditados
      })
    }
  });

  // GRÁFICO DE TORTA
  var id = 2;
  $.ajax({
    data: {'id': id},
    type: "POST",
    url: "php/graficos/graficoTortaPorcentajeAcreditacion.php",
    dataType:'json',
    contentType: false,
    processData: false,
    success: function(datos)
    {
      var datos ={
      type: "pie",
      data : {
        datasets : [{
          data : [
          datos.r,
          datos.a,
          datos.p
          ],
          backgroundColor:[
          "#F7464A",
          "#46BFBD",
          "#FDB45C"
          ],
        }],
        labels : [
        "Rechazados",
        "Acreditados",
        "Pendientes"
        ]
      },
      options: {
        responsive : true,
      }
    };

    var canvas = document.getElementById("chartTorta").getContext('2d');
    window.pie = new Chart(canvas, datos);      
    }
  });
});