function initMap() {
    let cairoPosition = {lat: 30.0444, lng: 31.2357};
    let mapElms = $(".map");
    if (mapElms.length > 0) {
        mapElms.each(function () {
                let lat = parseFloat($(this).attr('data-lat'));
                let lng = parseFloat($(this).attr('data-lng'));
                let position = null;
                if (isNaN(lat) || isNaN(lng)) {
                    position = cairoPosition;
                } else {
                    position = {lat: lat, lng: lng};
                }
                let map = new google.maps.Map($(this)[0], {
                    center: position,
                    zoom: 17
                });
                let marker = new google.maps.Marker({
                    position: position,
                    map: map,
                });

                if (parseInt($(this).attr('data-enable-selection')) === 1) {
                    let latElm = document.getElementById($(this).attr('data-latitude-input-id'));
                    let lngElm = document.getElementById($(this).attr('data-longitude-input-id'));
                    map.addListener('click', function (e) {
                        marker.setPosition(e.latLng);
                        map.panTo(e.latLng);
                        latElm.value = e.latLng.lat();
                        lngElm.value = e.latLng.lng();
                    });
                }
            }
        );
    }
}

(function () {
    if ($("select[multiple]").length) {
        $("select[multiple]").select2();
    }
})();