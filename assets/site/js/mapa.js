function initMap()
{
    var local = {lat: -20.715022703139628, lng: -46.6107083313365}
    var html = '<div id="iw-container">' +
                    '<div class="iw-title">Ângelo Corretor</div><br><br>' +
                        '<p id="rua" class="texto-mapa">R. Dep. Lourenço de Andrade, 687 - Centro</p>'+
                        '<p id="cidade" class="texto-mapa">Cidade: Passos - MG</p>'+
                        '<p id="cep" class="texto-mapa">CEP:37900-093</p>'+
                        '<p id="fone" class="texto-mapa">(35) 99234-2525</p>'
                  '</div>';
    var mapa = new google.maps.Map(document.getElementById('mapa'),
    {
        zoom: 20,
        center: local,
        streetViewControl: false,
        mapTypeControl: false
    }); 
    
    var image = '/assets/site/img/map_marker.png';

    var localMarker = new google.maps.Marker({
        map: mapa,
        icon: image,
        draggable: false,
        title:"Ângelo Corretor",
        animation: google.maps.Animation.DROP,
        position: local
    });

    function attachInstructionText(marker, text)
    {
        google.maps.event.addListener(marker, 'click', function() 
        {
            infowindow.setContent(text);
            infowindow.open(mapa, marker);
        });
    }

    google.maps.event.addListener(localMarker, 'click', function(){
        infowindow = new google.maps.InfoWindow({
            maxWidth: 350,
        });
        attachInstructionText(localMarker, html);
    });
}

initMap();