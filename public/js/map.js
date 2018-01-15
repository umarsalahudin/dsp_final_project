
   var map;
   var myLatLng;
$(document).ready(function(){


    geoLocationInit();

    function geoLocationInit(){

        if(navigator.geolocation){

            navigator.geolocation.getCurrentPosition(success,fail)


        }else
        {
            alert('Browser Not Supported');
        }
    }
    function success (position) {

       // console.log(position);
        var latval=position.coords.latitude;
        var lngval=position.coords.longitude;
        //console.log([latval,lngval]);
        myLatLng=new google.maps.LatLng(latval,lngval);
        createMap(myLatLng);
       // nearSearch(myLatLng,'restaurant');
        searchMap(latval,lngval);

    }

    function fail() {

        alert('Map is failed');
    }


    function createMap (myLatLng) {

          map = new google.maps.Map(document.getElementById('map'),{

          center: myLatLng,
          scroolwheel:false,
          zoom:15
      });
           var marker = new google.maps.Marker({
            position: myLatLng,
               map: map
        });

  }


    function createMarker(latlng,icn,name){
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            icon:icn,
            title: name
        });


    }
    /*function nearSearch(myLatLng,type) {

        var request = {
            location: myLatLng,
            radius: '2500',
            type: [type]
        };

        service = new google.maps.places.PlacesService(map);
        service.nearbySearch(request, callback);

        function callback(results,status) {
            console.log(results);

            if (status == google.maps.places.PlacesServiceStatus.OK) {
                for (var i = 0; i < results.length; i++) {
                    var place = results[i];

                    latlng=place.geometry.location;
                    icn='https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
                    name=place.name;
                    createMarker(latlng,icn,name);


                }
            }
        }

    }*/
    
    function searchMap(lat,lng) {

        $.post('http://localhost:8000/api/dspMap',{lat:lat,lng:lng},function (match) {

           $.each(match,function (i,val) {

           var mlatval =val.lat;
           var mlngval =val.lng;
           var mname   =val.name;
           var gicn='https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';

           var gLatLng=new google.maps.LatLng(mlatval,mlngval);
               createMarker(gLatLng,gicn,mname);




        });
        })
        
    }
    $('#mapsearch').submit(function(e){
      e.preventDefault();
      var maploc=$('#towns_group').val();
      $.post('http://localhost/api/getlocationCoords',{maploc:maploc},function(match){
        console.log(match);

      });
      });





});
