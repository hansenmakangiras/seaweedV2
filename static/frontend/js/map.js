


    //Map parametrs
    var mapOptions = {
        zoom: 14,
        scrollwheel: false,
        center: new google.maps.LatLng(41.143, -73.341),
        mapTypeId: google.maps.MapTypeId.ROADMAP,

        mapTypeControl: false,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            position: google.maps.ControlPosition.BOTTOM_CENTER
        },
        panControl: false,
        panControlOptions: {
            position: google.maps.ControlPosition.TOP_RIGHT
        },
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.LARGE,
            position: google.maps.ControlPosition.TOP_RIGHT
        },
        scaleControl: false,
        scaleControlOptions: {
            position: google.maps.ControlPosition.TOP_LEFT
        },
        streetViewControl: true,
        streetViewControlOptions: {
            position: google.maps.ControlPosition.LEFT_TOP
        }
    };

    //map
    var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);


    //icon
    var icon = [
        'img/icon/01.png',
        'img/icon/02.png',
        'img/icon/03.png',
        'img/icon/04.png',
        'img/icon/05.png',
        'img/icon/06.png',
        'img/icon/07.png',
        'img/icon/08.png',
        'img/icon/09.png'];