
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
  },5000);

  function getRandom(){
    return Math.round(Math.random()*100);
  }

  // GRÁFICO DE AREA DE TRABAJO
  var datos2 ={
    labels : ["11-10-2016","12-10-2016","13-10-2016","14-10-2016", "15-10-2016","16-10-2016","17-10-2016"],
    datasets : [{
      label : "Bodega",
      backgroundColor : "rgba(220,220,220,0.7)",
      data : [47,48,46,45,47,46,48]
    },
    {
      label : "Taller",
      backgroundColor : "rgba(151,187,205,0.7)",
      data : [30,34,32,32,32,34,32]
    },
    {
      label : "Administración",
      backgroundColor : "rgba(240,187,205,0.7)",
      data : [57,58,56,57,58,57,57]
    },
    {
      label : "Casinos",
      backgroundColor : "rgba(151,150,205,0.7)",
      data : [16,14,14,13,14,14,15]
    },
    {
      label : "Garita",
      backgroundColor : "rgba(151,187,120,0.7)",
      data : [48,48,46,47,48,48,48]
    },]
  };

  var canvas2 = document.getElementById('chart2').getContext('2d');
  window.bar = new Chart(canvas2, {
    type : "bar",
    data: datos2
  })

  // GRÁFICO TIPO DE PERSONAL
  var datos3 ={
    labels : ["11-10-2016","12-10-2016","13-10-2016","14-10-2016", "15-10-2016","16-10-2016","17-10-2016"],
    datasets : [{
      label : "Trabajador Planta",
      backgroundColor : "rgba(255, 99, 132, 0.7)",
      data : [238,224,256,235,267,260,255]
    },
    {
      label : "Proveedor",
      backgroundColor : "rgba(54, 162, 235, 0.7)",
      data : [30,3,45,17,26,15,5]
    },
    {
      label : "Cliente",
      backgroundColor : "rgba(255, 206, 86, 0.7)",
      data : [5,8,3,1,7,10,4]
    },
    {
      label : "Visita",
      backgroundColor : "rgba(75, 192, 192, 0.7)",
      data : [18,12,5,25,13,20,11]
    },
    {
      label : "Transportista",
      backgroundColor : "rgba(153, 102, 255, 0.7)",
      data : [7,3,11,7,8,4,6]
    },]
  };

  var canvas3 = document.getElementById('chart3').getContext('2d');
  window.bar = new Chart(canvas3, {
    type : "bar",
    data: datos3
  })
});