var Icon = L.Icon.extend({
      options: {            
        }     
      });
var acci=new Icon({iconUrl : 'img/accident.png'});

var Icon = L.Icon.extend({
      options: {            
        }     
      });
var clo=new Icon({iconUrl : 'img/closure.png'});

var Icon = L.Icon.extend({
      options: {            
        }     
      });
var trafic=new Icon({iconUrl : 'img/traffic.png'});

var Icon = L.Icon.extend({
      options: {            
        }     
      });
var dis=new Icon({iconUrl : 'img/disaster.png'});



$(function(){
      $.ajax({
        url: 'http://localhost/bsts_murni_gab/peta/user-accident.php',
         type: 'GET',     
         dataType: "json",
         success: function(response) {
          console.log(response);
          var Latitude,Longitude,Name,waktu;      
          for(var i=0;i<response.length;i++)
          {

           Latitude=response[i].latitude;
           Longitude=response[i].longitude;
           Name=response[i].id_user;   
           waktu=response[i].timestamp;   

         marker = L.marker([Latitude,Longitude],{icon: acci}).bindPopup("User Report = "+Name+" </br>Time report = "+waktu+"</br>Keterangan = Accident");
            leaflet.addLayer(marker);
             trs[response[i].id_ut] = marker;
          }
        }
      });
    });
$(function(){
      $.ajax({
        url: 'http://localhost/bsts_murni_gab/peta/user-closure.php',
         type: 'GET',     
         dataType: "json",
         success: function(response) {
          console.log(response);
          var Latitude,Longitude,Name,waktu;      
          for(var i=0;i<response.length;i++)
          {

           Latitude=response[i].latitude;
           Longitude=response[i].longitude;
           Name=response[i].id_user;   
           waktu=response[i].timestamp;   

         marker = L.marker([Latitude,Longitude],{icon: clo}).bindPopup("User Report = "+Name+" </br>Time report = "+waktu+"</br> Keterangan = Closure");
            leaflet.addLayer(marker);
             trs[response[i].id_ut] = marker;
          }
        }
      });
    });

$(function(){
      $.ajax({
        url: 'http://localhost/bsts_murni_gab/peta/user-traffic.php',
         type: 'GET',     
         dataType: "json",
         success: function(response) {
     //     console.log(response);
          var Latitude,Longitude,Name,waktu;      
          for(var i=0;i<response.length;i++)
          {

           Latitude=response[i].latitude;
           Longitude=response[i].longitude;
           Na