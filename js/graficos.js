
$(document).ready(function(){
  /*var datos ={
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
  },5000);*/

  function getRandom(){
    return Math.round(Math.random()*100);
  }

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
  var datosAcreditados ={
    labels : [fecha(-6),fecha(-5),fecha(-4),fecha(-3), fecha(-2),fecha(-1),fecha(0)],
    datasets : [{
      label : "Acreditados",
      backgroundColor : "rgba(220,220,220,0.7)",
      data : [47,48,46,45,47,46,48]
    },
    {
      label : "Rechazados",
      backgroundColor : "rgba(151,187,205,0.7)",
      data : [30,34,32,32,32,34,32]
    },
    {
      label : "Pendientes",
      backgroundColor : "rgba(240,187,205,0.7)",
      data : [57,58,56,57,58,57,57]
    },]
  };

  var canvas2 = document.getElementById('chart').getContext('2d');
  window.bar = new Chart(canvas2, {
    type : "bar",
    data: datosAcreditados
  })

});