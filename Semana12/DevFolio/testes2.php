<!DOCTYPE html>
<html>
  <head>
    <title>Visualização de Polígono no Google Maps</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=SUA_CHAVE_API"></script>
    <script>
      function initMap() {
        var myLatLng = {lat: -23.5505, lng: -46.6333}; // coordenadas de São Paulo
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: myLatLng
        });

        // coordenadas do polígono obtidas através do SQL
        var polygonCoords = [
          {lat: -23.5612, lng: -46.6976},
          {lat: -23.5612, lng: -46.6219},
          {lat: -23.5013, lng: -46.6219},
          {lat: -23.5013, lng: -46.6976},
        ];

        // cria uma nova camada de polígono
        var polygon = new google.maps.Polygon({
          paths: polygonCoords,
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF0000',
          fillOpacity: 0.35
        });

        // adiciona a camada de polígono no mapa
        polygon.setMap(map);
      }
    </script>
  </head>
  <body onload="initMap()">
    <div id="map" style="width:100%; height:500px;"></div>
  </body>
</html>
