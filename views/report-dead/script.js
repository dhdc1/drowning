$(function () {
    $('#gps').click(function(e){
        if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position){
           var lat = position.coords.latitude;
           var lon = position.coords.longitude;
           $('#reportdead-location_lat').val(lat);
           $('#reportdead-location_lon').val(lon);
        });
    }else{
        alert('Your browser not support location.')
    } 
    });
    

});