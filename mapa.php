<!DOCTYPE html>
<html>
  <head>
    <title>loteamento-novo2</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
   
    <!--<link rel="stylesheet" href="https://npmcdn.com/leaflet@1.0.0-rc.3/dist/leaflet.css" />
    <script src="https://npmcdn.com/leaflet@1.0.0-rc.3/dist/leaflet.js"></script>-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Bad+Script' rel='stylesheet' type='text/css'>
    <link href="icheck-bootstrap-master/icheck-bootstrap.css" rel="stylesheet">

    </head>

    <style>
      html, body, #map { width:100%; height:100%; margin:0; padding:0; z-index: 1;  background-color: #568f2c; }
        body {
            font-family: 'Lato', Calibri, Arial, sans-serif;
            color: #777;   
        }

      #slider{ position: absolute; top: 10px; right: 10px; z-index: 5; }
        
        #caixa-suspensa {
            position: absolute;
            width: 250px;
            height: 300px;
            border: solid thin #dadada;
            background-color: aliceblue;
            background-color: rgba(255,255,255,0.5);
            top: 200px;
            z-index: 900;
            float: left;
            margin-left: 10px;
            opacity: 0.9;
        }
        
        #caixa-suspensa #itens-suspensos {
            padding-top: 15px;
            list-style: none;
        }
        #bt-fecha-janela {
            position: relative;
            float: right;
            z-index: 950;
            margin-right: 15px;
            margin-top: 10px;
            display: none;
        }
        
        #menu-hamburguer {
            background-color: #fff;
            padding: 5px 8px 5px 8px;
            padding-top: 5px !important;
            padding-top: 0;
            position: absolute;
            top: 204px;
            left: 15px;
            z-index: 999;
        }
        
        .deslizarEsquerda {
            transform: translate(-300px);
            transition: 300ms ease-out;
        }
        
        .deslizarDireita {
            transform: translate(0px);
            transition: 300ms ease-out;
        }        
        
        #itens-suspensos {
            color: #337ab7;
            margin-left: 10px;
            margin-top: 45px;
            border-top: dashed thin #dadada;
            /*background-color: #fff;
            padding-right: 17px;
            padding-bottom: 5px;
            padding-left: 15px;*/ 
            width: 90%;
        }

        .deslizaMenu {
            
        }
        
        .content-pop {
            color: #ddd;
            
        }
        
        .box-flex {
            padding: 10px;
        }
        
        #header {
            padding-bottom: 15px;
            text-align: center;
        }

        #footer {
            width: 100%;
            border-top: solid thin #ddd;
            word-break: break-all;
        }

        #content {
            padding-bottom: 15px;
        }

        #content h4 {
            text-align: center;
        }        
        
.leaflet-marker-icon,
.leaflet-marker-shadow {
  -webkit-animation: fadein 1s; /* Safari, Chrome and Opera > 12.1 */
  -moz-animation: fadein 1s; /* Firefox < 16 */
  -ms-animation: fadein 1s; /* Internet Explorer */
  -o-animation: fadein 1s; /* Opera < 12.1 */
  animation: fadein 1s;
}

@keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Firefox < 16 */
@-moz-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Safari, Chrome and Opera > 12.1 */
@-webkit-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Internet Explorer */
@-ms-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Opera < 12.1 */
@-o-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}
        
    </style>
  
  <body onload="init()">
    <div id="map"></div>
    <a href="" id="menu-hamburguer"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a>
    <div id="caixa-suspensa">
        <a href="" id="bt-fecha-janela"> <i class="fa fa-times fa-2x" aria-hidden="true"></i></a>
        <ul id="itens-suspensos">
            <!--<li><input id="input-todos" type="checkbox" name="check-todos" class="form-check-input" onClick="OnOffTodos()"><span class="itens-menu">TODOS</span></li>-->
            <li>
                <div id="input-todos" class="checkbox icheck-primary" onClick="OnOffTodos()">
                      <input type="checkbox" id="todos" />
                      <label for="todos"><span style="padding-left: 5px;">MARCAR TODOS</span></label>
                </div>            
            </li>
            <!--<li><input id="input-disponiveis" type="checkbox" name="check-disponiveis" class="form-check-input" onClick="OnOffDisponiveis()"><span class="itens-menu">DISPONÍVEIS</span></li>-->
            <li>
                <div id="input-disponiveis" class="checkbox icheck-primary" onClick="OnOffDisponiveis()">
                      <input type="checkbox" id="disponiveis" />
                      <label for="disponiveis"><i style="color: green; background-color: #ddd;" class="fa fa-map-marker fa-lg"></i><span style="padding-left: 7px;">DISPONÍVEIS</span></label>
                </div>             
            </li>
            <!--<li><input id="input-reservados" type="checkbox" name="check-reservados" class="form-check-input" onClick="OnOffReservados()"><span class="itens-menu">RESERVADOS</span></li>-->
            <li>
                <div id="input-reservados" class="checkbox icheck-primary" onClick="OnOffReservados()">
                      <input type="checkbox" id="reservados" />
                      <label for="reservados"><i style="color: yellow; background-color: #ddd;" class="fa fa-map-marker fa-lg"></i><span style="padding-left: 7px;">RESERVADOS</span></label>
                </div>                
            </li>
            <li>
                <div id="input-vendidos" class="checkbox icheck-primary" onClick="OnOffVendidos()">
                      <input type="checkbox" id="vendidos" />
                      <label for="vendidos"><i style="color: red; background-color: #ddd;" class="fa fa-map-marker fa-lg"></i><span style="padding-left: 7px;">VENDIDOS</span></label>
                </div>                
            </li>            
            <!--<li><input id="input-vendidos" type="checkbox" name="check-vendidos" class="form-check-input" onClick="OnOffVendidos()"><span class="itens-menu">VENDIDOS</span></li>-->
            <!--<li><input id="input-teste" type="checkbox" name="check-teste" class="form-check-input" onClick="OnOffTeste()"> Teste azul</li>-->
        </ul>
    </div>
    <!-- <input id="slider" type="range" min="0" max="1" step="0.1" value="1" oninput="layer.setOpacity(this.value)"> -->

    
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> 
    
    <script>
        

        
    $('#menu-hamburguer').on('click', function(e){
        //$('#caixa-suspensa').fadeIn();
        //$("#caixa-suspensa").animate({width: 'toggle'});
        if($("#caixa-suspensa").position().left > -300){
            $("#caixa-suspensa").removeClass('deslizarDireita');
            $("#caixa-suspensa").addClass('deslizarEsquerda');
        } else{
            $("#caixa-suspensa").removeClass('deslizarEsquerda');
            $("#caixa-suspensa").addClass('deslizarDireita');
        }
        //map.setZoom(0);
        //setTimeout(function () { map.setZoom(3); }, 50);
        //map.flyTo([-30.5, 96.5], 3) // flyTo FUNCIONA
        //map.flyTo([-105.5, 96.5], 3) // flyTo FUNCIONA
        e.preventDefault();
    })        
        
    var x = 0;
    var y = 0;
    var _pinColor = '';
    var _status = ['','Vendido','Reservado','Disponível'];
    var markers = [
                    {
                    
                    },
                    {
                        idLocation: 'lote-001',
                        coordinates: [-33.28125, 83.21875],
                        pinColor: 'red',
                        status: [1, 'Vendido'],
                        idQuadra: '01',
                        area: '1.444',
                        titular: 'Rosângela - 1'
                    },
                    {
                        idLocation: 'lote-002',
                        coordinates: [-23.8125, 99.6875],
                        pinColor: 'yellow',
                        status: [2, 'Reservado'],
                        idQuadra: '01',
                        area: '1.460',
                        titular: 'Rosângela - 2'
                    },
                    {
                        idLocation: 'lote-003',
                        coordinates: [-41.5, 69.375],
                        pinColor: 'green',
                        status: [3, 'Disponível'],
                        idQuadra: '01',
                        area: '1.830',
                        titular: 'Rosângela Cândido da Silva - 3'
                    },
                    {
                        idLocation: 'lote-004',
                        coordinates: [-42.5625, 70.8125],
                        pinColor: 'green',
                        status: [3, 'Disponível'],
                        idQuadra: '01',
                        area: '1.460',
                        titular: 'Rosângela Cândido da Silva - 4'
                    },
                    {
                        idLocation: 'lote-005',
                        coordinates: [-43.34375, 72.625],
                        pinColor: 'green',
                        status: [3, 'Disponível'],
                        idQuadra: '01',
                        area: '1.500',
                        titular: 'Rosângela Cândido da Silva - 5'

                    },
                    {
                        idLocation: 'lote-006',
                        coordinates: [-44.3125, 74.40625],
                        pinColor: 'green',
                        status: [3, 'Disponível'],
                        idQuadra: '01',
                        area: '1.550',
                        titular: 'Cândido - 6'
                    },
                    {

                    },
                    {

                    },
                    {

                    },
                    {

                    },
                    {

                    },
                    {

                    },
                    {

                    },
                    {

                    },
                    {

                    },
                    {

                    },
                    {

                    },
                    {

                    },
                    {

                    },
                    {

                    },
                    {

                    }
               ];

    var map;        
    var layer;
    var disponiveis_green;
    var reservados_yellow;
    var vendidos_red;
    var blue;
        
    var marker1;
      function init() {
        $('#todos').attr('checked', true);
        var mapMinZoom = 1;
        var mapMaxZoom = 6;
        blue = L.layerGroup();
        vendidos_red = L.layerGroup();
        reservados_yellow = L.layerGroup();
        disponiveis_green = L.layerGroup();
        map = L.map('map', {
          center: [-64.75, 118],
          maxZoom: mapMaxZoom,
          minZoom: mapMinZoom,
          crs: L.CRS.Simple
        }).setView([-64.75, 118], mapMaxZoom);
        //}).setView([0, 0], mapMaxZoom);
          
        
        var mapBounds = new L.LatLngBounds(
            map.unproject([0, 8448], mapMaxZoom),
            map.unproject([13824, 0], mapMaxZoom));
            
        map.fitBounds(mapBounds);
        layer = L.tileLayer('{z}/{x}/{y}.png', {
          minZoom: mapMinZoom, maxZoom: mapMaxZoom,
          bounds: mapBounds,
          attribution: 'Desenvolvido por Self Control tecnologia',
          noWrap: true,
          tms: false
        }).addTo(map);
          
        
          
        var redIcon = new L.Icon({
          iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
          shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
          iconSize: [30, 45],
          iconAnchor: [12, 41],
          popupAnchor: [1, -34],
          shadowSize: [41, 41]
        });
          
        var yellowIcon = new L.Icon({
          iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-yellow.png',
          shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
          iconSize: [30, 45],
          iconAnchor: [12, 41],
          popupAnchor: [1, -34],
          shadowSize: [41, 41]
        });          
          
        var greenIcon = new L.Icon({
          iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
          shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
          iconSize: [30, 45],
          iconAnchor: [12, 41],
          popupAnchor: [1, -34],
          shadowSize: [41, 41]
        });
          
        var blueIcon = new L.Icon({
          iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',
          shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
          iconSize: [30, 45],
          iconAnchor: [12, 41],
          popupAnchor: [1, -34],
          shadowSize: [41, 41]
        }); 
          
         var polygon = L.polygon([
            [-31.75, 84.1875],
            [-32.59375, 85.70313],
            [-34.51562, 82.1875],
            [-33.82812, 80.71875]
            ],{color: 'red', opacity: 1, fillOpacity: 0.7, fillColor: 'red'}).addTo(vendidos_red);
          
          
         var polygon2 = L.polygon([
            [-22.34375, 100.71875],
            [-23.15625, 102.125],
            [-25.21875, 98.71875],
            [-24.34375, 97.28125]
            ],{color: 'yellow', opacity: 0.9, fillOpacity: 0.7}).addTo(reservados_yellow);
          
          
         var polygon3 = L.polygon([
            [-41.01562, 71.79688],
            [-41.84375, 73.23438],
            [-43.82812, 69.76563],
            [-42.98437, 68.29688]
            ],{color: 'green', opacity: 0.9, fillOpacity: 0.5}).addTo(disponiveis_green);
          
          
         var polygon4 = L.polygon([
            [-39.95312, 70.04688],
            [-40.8125, 71.59375],
            [-42.79687, 68.10938],
            [-42, 66.65625]
            ],{color: 'green', opacity: 0.9, fillOpacity: 0.5}).addTo(disponiveis_green);
          
          
         var polygon10 = L.polygon([
            [-37.79687, 73.78125],
            [-38.6875, 75.29688],
            [-40.64062, 71.78125],
            [-39.73437, 70.32813]
            ],{color: 'green', opacity: 0.9, fillOpacity: 0.5}).addTo(disponiveis_green);
          
          
         var polygon12 = L.polygon([
            [-38.78125, 75.5],
            [-39.625, 76.9375],
            [-41.64062, 73.46875],
            [-40.8125, 72.01563]
            ],{color: 'green', opacity: 0.9, fillOpacity: 0.5}).addTo(disponiveis_green);
          
          
         var polygon13 = L.polygon([
            [-39.76562, 77.125],
            [-40.60937, 78.625],
            [-42.60937, 75.17188],
            [-41.75, 73.70313]
            ],{color: 'green', opacity: 0.9, fillOpacity: 0.5}).addTo(disponiveis_green);
          
          
         var polygon14 = L.polygon([
            [-40.73437, 78.79688],
            [-41.60937, 80.312],
            [-43.64062, 76.84375],
            [-42.75, 75.375]
            ],{color: 'green', opacity: 0.9, fillOpacity: 0.5}).addTo(disponiveis_green);
          
          
         var polygon15 = L.polygon([
            [-41.76562, 80.51563],
            [-42.65625, 82.03125],
            [-44.625, 78.54688],
            [-43.76562, 77.09375]
            ],{color: 'green', opacity: 0.9, fillOpacity: 0.5}).addTo(disponiveis_green);
          
          
         var polygon16 = L.polygon([
            [-42.75, 82.17188],
            [-43.65625, 83.67188],
            [-45.65625, 80.26563],
            [-44.79687, 78.71875]
            ],{color: 'green', opacity: 0.9, fillOpacity: 0.5}).addTo(disponiveis_green);
          
          
         var polygon17 = L.polygon([
            [-43.76562, 83.875],
            [-44.64062, 85.35938],
            [-46.65625, 81.96875],
            [-45.78125, 80.45313]
            ],{color: 'green', opacity: 0.9, fillOpacity: 0.5}).addTo(disponiveis_green);
          
          // var myIcon = L.divIcon({className: 'my-div-icon'});
          x = markers[1].coordinates[0];
          y = markers[1].coordinates[1];
          _pinColor = markers[1].pinColor;
          marker1= L.marker([x,y], {icon: redIcon}).addTo(vendidos_red);
          x = markers[2].coordinates[0];
          y = markers[2].coordinates[1];          
          var marker2 = L.marker([x,y], {icon: yellowIcon}).addTo(reservados_yellow);
          x = markers[3].coordinates[0];
          y = markers[3].coordinates[1];
          _pinColor = markers[3].pinColor;          
          var marker3 = L.marker([x,y], {icon: greenIcon}).addTo(disponiveis_green);
          x = markers[4].coordinates[0];
          y = markers[4].coordinates[1];
          _pinColor = markers[4].pinColor;
          var marker4 = L.marker([x,y], {icon: greenIcon}).addTo(disponiveis_green);
          var marker5 = L.marker([-43.34375, 72.625], {icon: greenIcon}).addTo(disponiveis_green);
          var marker10 = L.marker([-39.26562, 72.85938], {icon: greenIcon}).addTo(disponiveis_green);
          var marker6 = L.marker([-44.15625, 74.40625], {icon: greenIcon}).addTo(disponiveis_green);
          var marker7 = L.marker([-45.28125, 76.15625], {icon: greenIcon}).addTo(disponiveis_green);
          var marker8 = L.marker([-46.1875, 77.78125], {icon: greenIcon}).addTo(disponiveis_green);
          var marker9 = L.marker([-47.32812, 79.46875], {icon: greenIcon}).addTo(disponiveis_green);
          var marker11 = L.marker([-40.28125, 95.125], {icon: greenIcon}).addTo(disponiveis_green);
          var marker12 = L.marker([-40.1875, 74.5625], {icon: greenIcon}).addTo(disponiveis_green);
          var marker13 = L.marker([-41.14062, 76.21875], {icon: greenIcon}).addTo(disponiveis_green);
          var marker14 = L.marker([-42.26562, 77.89063], {icon: greenIcon}).addTo(disponiveis_green);
          var marker15 = L.marker([-43.1875, 79.60938], {icon: greenIcon}).addTo(disponiveis_green);
          var marker16 = L.marker([-44.17187, 81.17188], {icon: greenIcon}).addTo(disponiveis_green);
          //var marker16 = L.marker([-105, 99], {icon: greenIcon}).addTo(disponiveis_green);
          var marker17 = L.marker([-45.20312, 82.89063], {icon: greenIcon}).addTo(disponiveis_green);
          //var marker18 = L.marker([-49.5, 108.5], {icon: blueIcon}).addTo(blue);
          //var marker19 = L.marker([-55.5, 113.5], {icon: blueIcon}).addTo(blue);
          //var marker20 = L.marker([-61.5, 118.5], {icon: blueIcon}).addTo(blue);
          // marker2.valueOf()._icon.style.backgroundColor = 'green'; //or any color
         
       
          
                
          
        var overlayMaps = {
            /*"Teste" : blue,*/
            "Disponiveis" : disponiveis_green,
            "Vendidos" : vendidos_red,
            "Reservados" : reservados_yellow
        }; 
          
        map.removeLayer(vendidos_red);
        map.removeLayer(reservados_yellow);
        map.removeLayer(disponiveis_green);
        //map.removeLayer(blue);
          
        map.addLayer(vendidos_red);
        map.addLayer(reservados_yellow);
        map.addLayer(disponiveis_green);
        //map.addLayer(blue);          

          
          //L.control.layers(overlayMaps).addTo(map);
          
          marker1.bindPopup(
              '<div class="box-flex"><div id="header"><h4>'+_status[markers[1].status[0]]+'</h4></div><div id="content"><span><strong>Quadra:</strong> '+ markers[1].idQuadra+'</span><br /><span><strong>Área:</strong> '+ markers[1].area+'</span></div><div id="footer"><h4 style="width: 80%; word-break: break-all; word-wrap: break-word;">'+ markers[1].titular+' 01</h4></div></div>'
          );
          
          marker2.bindPopup(
              '<div class="box-flex"><div id="header"><h4>'+_status[markers[2].status[0]]+'</h4></div><div id="content"><span><strong>Quadra:</strong> '+ markers[2].idQuadra+'</span><br /><span><strong>Área:</strong> 1.450</span></div><div id="footer"><h4>Cota - 02</h4></div></div>'
          );       
          
          marker3.bindPopup('<div class="box-flex"><div id="header"><h4>'+_status[markers[3].status[0]]+'</h4></div><div id="content"><span><strong>Quadra:</strong> 01</span><br /><span><strong>Área:</strong> '+ markers[3].area+'</span></div><div id="footer"><h4>Cota - 03</h4></div></div>'
          );
          
          marker4.bindPopup('<div class="box-flex"><div id="header"><h4>'+_status[markers[4].status[0]]+'</h4></div><div id="content"><span><strong>Quadra:</strong> 01</span><br /><span><strong>Área:</strong> '+ markers[4].area+'</span></div><div id="footer"><h4>Cota - 04</h4></div></div>'
          );
          
          marker5.bindPopup(
        '<div class="box-flex"><div id="header"><h4>'+_status[markers[5].status[0]]+'</h4></div><div id="content"><span><strong>Quadra:</strong> 01</span><br /><span><strong>Área:</strong> '+ markers[5].area+'</span></div><div id="footer"><h4>Cota - 05</h4></div></div>'
          );
          
          marker6.bindPopup(
        '<div class="box-flex"><div id="header"><h4>'+_status[markers[6].status[0]]+'</h4></div><div id="content"><span><strong>Quadra:</strong> 01</span><br /><span><strong>Área:</strong> '+ markers[6].area+'</span></div><div id="footer"><h4>Cota - 06</h4></div></div>'
          );
          
          marker7.bindPopup(
              '<h4>7</h4>'
          );
          
          marker8.bindPopup(
              '<h4>8</h4>'
          );
          
          marker9.bindPopup(
              '<h4>9</h4>'
          );
          
          marker10.bindPopup(
              '<h4>10</h4>'
          );
          
          marker11.bindPopup(
              '<h4>11</h4>'
          );
          
          marker12.bindPopup(
              '<h4>12</h4>'
          );
          
          marker13.bindPopup(
              '<h4>13</h4>'
          );
          
          marker14.bindPopup(
              '<h4>14</h4>'
          );
          
          marker15.bindPopup(
              '<h4>15</h4>'
          );
          
          marker16.bindPopup(
              '<h4>16</h4>'
          );
          
          marker17.bindPopup(
              '<h4>17</h4>'
          );
          
          /*marker18.bindPopup(
              '<h4>18</h4>'
          );
          
          marker19.bindPopup(
              '<h4>19</h4>'
          );
          
          marker20.bindPopup(
              '<h4>20</h4>'
          );*/
          
          map.on('click', onMapClick); 
          
          map.flyTo([-64.75, 118], 3);
          
      }
        
        function OnOffVendidos (){
            console.log('check on/off - vendidos');
            //if(document.getElementById("input-vendidos").checked){
            if($("#vendidos").is(":checked") == true) {
                if($("#todos").is(":checked") == true){removeTodos()}
                $("#todos").attr("checked", false);
                map.addLayer(vendidos_red);
                map.flyTo([-33.1875, 82.25], 6)
            } else {
                map.removeLayer(vendidos_red);
            }
        }         
      
        function OnOffDisponiveis (){
            console.log('check on/off - disponiveis');
            //if(document.getElementById("input-disponiveis").checked){
            if($("#disponiveis").is(":checked") == true) {
                if($("#todos").is(":checked") == true){removeTodos()}
                $("#todos").attr("checked", false);
                map.addLayer(disponiveis_green);
                map.flyTo([-39.26562, 72.85938], 6)
            } else {
                map.removeLayer(disponiveis_green);
            }
        }
        
        function OnOffReservados (){
            console.log('check on/off - reservados');
            //if(document.getElementById("input-reservados").checked){
            if($("#reservados").is(":checked") == true) {
                if($("#todos").is(":checked") == true){removeTodos()}
                $("#todos").attr("checked", false);
                map.addLayer(reservados_yellow);
                map.flyTo([-23.75, 98.5625], 6);
            } else {
                map.removeLayer(reservados_yellow);
            }
        }        
        
        /*function OnOffTeste (){
            console.log('check on/off - teste');
            if(document.getElementById("input-teste").checked){
                map.addLayer(blue);
            } else {
                map.removeLayer(blue); 
            }
        }*/
        
        function OnOffTodos (){
            //if(document.getElementById("input-todos").checked){
            if($("#todos").is(":checked") == true) {
            console.log('check on/off - todos check habilitado');
                //map.addLayer(blue);
                map.addLayer(vendidos_red);
                map.addLayer(reservados_yellow);
                map.addLayer(disponiveis_green);
                //document.getElementById("input-disponiveis").checked = false;
                $("#disponiveis").attr("checked", false);
                //document.getElementById("input-vendidos").checked = false;
                $("#vendidos").attr("checked", false);
                //document.getElementById("input-reservados").checked = false;
                $("#reservados").attr("checked", false);
            } else {
                console.log('check on/off - todos check desabilitado');
                //map.removeLayer(blue);
                map.removeLayer(vendidos_red);
                map.removeLayer(reservados_yellow);
                map.removeLayer(disponiveis_green);
                removeTodos();
            }
        }
        
        function removeTodos(){
                //map.removeLayer(blue);
                map.removeLayer(vendidos_red);
                map.removeLayer(reservados_yellow);
                map.removeLayer(disponiveis_green);            
        }
        
        $('#bt-fecha-janela').on('click', function(e){
            //$(this).parent().fadeOut();
            $("#caixa-suspensa").animate({left: '-350px'});
            e.preventDefault();
        }) 
        
        function onMapClick(e) {
            alert("You clicked the map at " + e.latlng);
        }

             
    </script>

  </body>
</html>
