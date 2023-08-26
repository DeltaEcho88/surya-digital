(function($){
  const dataMaps = $('#map').data('settings');

  var script = document.createElement('script');
  script.src = 'https://maps.googleapis.com/maps/api/js?key='+ dataMaps.key +'&callback=initMap&libraries=places';
  script.async = true;

  window.initMap = function() {
    const map = new google.maps.Map($("#map")[0], {
      zoom: 14,
      center: new google.maps.LatLng(dataMaps.latitude, dataMaps.longitude),
      mapTypeId: "roadmap",
    });

    // Construct the polygon.
    const mapsPolygon = new google.maps.Polygon({
      paths: dataMaps.coordinates,
      strokeColor: "#FF0000",
      strokeOpacity: 0,
      strokeWeight: 2,
      fillColor: "#FF0000",
      fillOpacity: 0,
    });


    mapsPolygon.setMap(map);
    loadKmlLayer(dataMaps.kmlUrl, map);


    // Create the search box and link it to the UI element.
    const input = document.getElementById("sd-input");
    const searchBox = new google.maps.places.SearchBox(input);
    const buttonAction = $('.sd-maps-button');
    
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    // Bias the SearchBox results towards current map's viewport.
    map.addListener("bounds_changed", () => {
      searchBox.setBounds(map.getBounds());
    });

    searchBox.addListener("places_changed", () => {
      const places = searchBox.getPlaces();

      if (places.length == 0) {
        return;
      }

      places.forEach((place) => {
        const isExists = google.maps.geometry.poly.containsLocation(new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng()), mapsPolygon);
        if( isExists ){
          buttonAction.attr('href', dataMaps.actionInside );
          buttonAction.removeClass('disabled');
        } else {
          buttonAction.attr('href', dataMaps.actionOutside );
          buttonAction.removeClass('disabled');
        }
      });
    });
  }

  function loadKmlLayer(src, map) {
    kmlLayer = new google.maps.KmlLayer(src, {
      suppressInfoWindows: true,
      preserveViewport: false,
      map: map
    });
  }

  document.head.appendChild(script);

})(jQuery);