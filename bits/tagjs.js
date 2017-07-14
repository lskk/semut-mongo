$(function(){
  $('.showimg').change(function(){
    if(this.checked){
      $.ajax({
        type :"get",
        dataType: "json",
        url : "http://localhost/bsts_murni_gab/fetch.php",
        success:function(data){
          //console.log(data);
          for(var naonweh in data) {
            console.log(data);
            marker = L.marker([Number(data[naonweh].latitude), Number(data[naonweh].longitude)],{icon: cctv}).bindPopup("<img src='http://bf-s.cloudapp.net/photosharing/my/img/"+data[naonweh].id+"/"+data[naonweh].id+".jpg' style='with:300px; height:200px;'><br>"+data[naonweh].lokasi);
            leaflet.addLayer(marker);
            bebas[data[naonweh].id] = marker;
          }
        }
      });
    }else{
      $.ajax({
        type :"get",
        dataType: "json",
        url : "http://localhost/bsts_murni_gab/fetch.php",
        success:function(data){
          for(var naonweh in data) {
           // console.Log(naonweh);
            leaflet.removeLayer(bebas[data[naonweh].id]);   
          }
        }
      });
    }
  });
});

$(function(){
  $('.food').change(function(){
    if(this.checked){
      $.ajax({
        url: 'http://localhost/bsts_murni_gab/peta/food.php',
				 type: 'GET',     
				 dataType: "json",
				 success: function(response) {
         // console.log(response);
				  var Latitude,Longitude,Name;      
				  for(var i=0;i<response.length;i++)
				  {
				   Latitude=response[i].Latitude;
				   Longitude=response[i].Longitude;
				   Name=response[i].Name;   

				 marker = L.marker([Latitude,Longitude],{icon: food}).bindPopup(""+Name );
            leaflet.addLayer(marker);
            tfood[response[i].ID] = marker;
          }
        }
      });
    }else{
      $.ajax({
        type :"get",
        dataType: "json",
        url : "http://localhost/bsts_murni_gab/peta/food.php",
        success:function(response){
        	
        	 // var Latitude,Longitude,Name;  
         for(var i=0;i<response.length;i++)
				  {
				  	//console.log(response[i]);

				  	  leaflet.removeLayer(tfood[response[i].ID]);
				  	
          //  leaflet.removeLayer(bebas[data[naonweh].id);   
          }
        }
      });
    }
  });
});




// fuel
 

$(function(){
  $('.fuel').change(function(){
    if(this.checked){
      $.ajax({
        url: 'http://localhost/bsts_murni_gab/peta/spbu.php',
         type: 'GET',     
         dataType: "json",
         success: function(response) {
         // console.log(response);
          var Latitude,Longitude,Name;      
          for(var i=0;i<response.length;i++)
          {

           Latitude=response[i].Latitude;
           Longitude=response[i].Longitude;
           Name=response[i].Name;   

         marker = L.marker([Latitude,Longitude],{icon: gas}).bindPopup(""+Name );
            leaflet.addLayer(marker);
             tfuel[response[i].ID] = marker;
          }
        }
      });
    }else{
      $.ajax({
        type :"get",
        dataType: "json",
        url : "http://localhost/bsts_murni_gab/peta/spbu.php",
        success:function(response){
          
           // var Latitude,Longitude,Name;  
         for(var i=0;i<response.length;i++)
          {
            //console.log(response[i]);

              leaflet.removeLayer(tfuel[response[i].ID]);
            
          //  leaflet.removeLayer(bebas[data[naonweh].id);   
          }
        }
      });
    }
  });
});

// bank

$(function(){
  $('.bank').change(function(){
    if(this.checked){
      $.ajax({
        url: 'http://localhost/bsts_murni_gab/peta/bank.php',
         type: 'GET',     
         dataType: "json",
         success: function(response) {
         // console.log(response);
          var Latitude,Longitude,Name;      
          for(var i=0;i<response.length;i++)
          {

           Latitude=response[i].Latitude;
           Longitude=response[i].Longitude;
           Name=response[i].Name;   

         marker = L.marker([Latitude,Longitude],{icon: bank}).bindPopup(""+Name );
            leaflet.addLayer(marker);
            tbank[response[i].ID] = marker;
          }
        }
      });
    }else{
      $.ajax({
        type :"get",
        dataType: "json",
        url : "http://localhost/bsts_murni_gab/peta/bank.php",
        success:function(response){
          
           // var Latitude,Longitude,Name;  
         for(var i=0;i<response.length;i++)
          {
            //console.log(response[i]);

              leaflet.removeLayer(tbank[response[i].ID]);
            
          //  leaflet.removeLayer(bebas[data[naonweh].id);   
          }
        }
      });
    }
  });
});
$(function(){
  $('.hospital').change(function(){
    if(this.checked){
      $.ajax({
        url: 'http://localhost/bsts_murni_gab/peta/rs.php',
         type: 'GET',     
         dataType: "json",
         success: function(response) {
         // console.log(response);
          var Latitude,Longitude,Name;      
          for(var i=0;i<response.length;i++)
          {

           Latitude=response[i].Latitude;
           Longitude=response[i].Longitude;
           Name=response[i].Name;   

         marker = L.marker([Latitude,Longitude],{icon: rs}).bindPopup(""+Name );
            leaflet.addLayer(marker);
             trs[response[i].ID] = marker;
          }
        }
      });
    }else{
      $.ajax({
        type :"get",
        dataType: "json",
        url : "http://localhost/bsts_murni_gab/peta/rs.php",
        success:function(response){
          
           // var Latitude,Longitude,Name;  
         for(var i=0;i<response.length;i++)
          {
            //console.log(response[i]);

              leaflet.removeLayer(trs[response[i].ID]);
            
          //  leaflet.removeLayer(bebas[data[naonweh].id);   
          }
        }
      });
    }
  });
});

$(function(){
  $('.bus').change(function(){
    if(this.checked){
      $.ajax({
        url: 'http://localhost/bsts_murni_gab/peta/terminal.php',
         type: 'GET',     
         dataType: "json",
         success: function(response) {
         // console.log(response);
          var Latitude,Longitude,Name;      
          for(var i=0;i<response.length;i++)
          {

           Latitude=response[i].Latitude;
           Longitude=response[i].Longitude;
           Name=response[i].Name;   

         marker = L.marker([Latitude,Longitude],{icon: bus}).bindPopup(""+Name );
            leaflet.addLayer(marker);
            tbus[response[i].ID] = marker;
          }
        }
      });
    }else{
      $.ajax({
        type :"get",
        dataType: "json",
        url : "http://localhost/bsts_murni_gab/peta/terminal.php",
        success:function(response){
          
           // var Latitude,Longitude,Name;  
         for(var i=0;i<response.length;i++)
          {
            //console.log(response[i]);

              leaflet.removeLayer(tbus[response[i].ID]);
            
          //  leaflet.removeLayer(bebas[data[naonweh].id);   
          }
        }
      });
    }
  });
});

$(function(){
  $('.colla').change(function(){
    if(this.checked){
      $.ajax({
         type: 'GET',     
         dataType: "json",
          url: 'http://localhost/bsts_murni_gab/peta/collage.php',
         success: function(response) {
         // console.log(response);
          var Latitude,Longitude,Name;  
          
          for(var i=0;i<response.length;i++)
          {

           Latitude=response[i].Latitude;
           Longitude=response[i].Longitude;
           Name=response[i].Name;   

         marker = L.marker([Latitude,Longitude],{icon: dian}).bindPopup(""+Name );
            leaflet.addLayer(marker);
            tcool[response[i].ID] = marker;
          }
        }, error: function(err){
          console.log(err.responseText);
        }
      });
    }else{
      $.ajax({
        type :"get",
        dataType: "json",
        url : "http://localhost/bsts_murni_gab/peta/collage.php",
        success:function(response){
       //   console.log(response);
           // var Latitude,Longitude,Name;  
         for(var i=0;i<response.length;i++)
          {
            //console.log(response[i]);

              leaflet.removeLayer(tcool[response[i].ID]);
            
          //  leaflet.removeLayer(bebas[data[naonweh].id);   
          }
        }
      });
    }
  });
});
//lokasi user

$(function(){
  $('.member').change(function(){
    if(this.checked){
      $.ajax({
        url: 'http://localhost/bsts_murni_gab/peta/lokasi-user.php',
         type: 'GET',     
         dataType: "json",
         success: function(response) {
         // console.log(response);
          var Latitude,Longitude,Name;      
          for(var i=0;i<response.length;i++)
          {
           Latitude=response[i].Latitude;
           Longitude=response[i].Longitude;
           //Name=response[i].Name;   

         marker = L.marker([Latitude,Longitude],{icon: member}).bindPopup(response[i].UserID);
            leaflet.addLayer(marker);
            tmember.push(marker);
          }
        }
      });
    }else{
      for(var i = 0; i < tmember.length; i++){
        leaflet.removeLayer(tmember[i]);
      }
    }
  });
});

// sekolah


$(function(){
  $('.sekolah').change(function(){
    if(this.checked){
      $.ajax({
         type: 'GET',     
         dataType: "json",
          url: 'http://localhost/bsts_murni_gab/peta/sekolah.php',
         success: function(response) {
         // console.log(response);
          var Latitude,Longitude,Name;  
          
          for(var i=0;i<response.length;i++)
          {

           Latitude=response[i].latitude;
           Longitude=response[i].longitude;
           Name=response[i].name;   

         marker = L.marker([Latitude,Longitude],{icon: sekolah}).bindPopup(""+Name );
            leaflet.addLayer(marker);
            tcool[response[i].id] = marker;
          }
        }, error: function(err){
          console.log(err.responseText);
        }
      });
    }else{
      $.ajax({
        type :"get",
        dataType: "json",
        url : "http://localhost/bsts_murni_gab/peta/sekolah.php",
        success:function(response){
        //  console.log("dian"+response);
           // var Latitude,Longitude,Name;  
         for(var i=0;i<response.length;i++)
          {
          //  console.log(response[i]);

              leaflet.removeLayer(tcool[response[i].id]);
            
          //  leaflet.removeLayer(bebas[data[naonweh].id);   
          }
        }
      });
    }
  });
});

// pariwisata

$(function(){
  $('.pariwisata').change(function(){
    if(this.checked){
      $.ajax({
         type: 'GET',     
         dataType: "json",
          url: 'http://localhost/bsts_murni_gab/peta/pariwisata.php',
         success: function(response) {
         // console.log(response);
          var Latitude,Longitude,Name;  
          
          for(var i=0;i<response.length;i++)
          {

           Latitude=response[i].latitude;
           Longitude=response[i].longitude;
           Name=response[i].name;   

         marker = L.marker([Latitude,Longitude],{icon: pariwisata}).bindPopup(""+Name );
            leaflet.addLayer(marker);
            tpariwisata[response[i].id] = marker;
          }
        }, error: function(err){
          console.log(err.responseText);
        }
      });
    }else{
      $.ajax({
        type :"get",
        dataType: "json",
        url : "http://localhost/bsts_murni_gab/peta/pariwisata.php",
        success:function(response){
      //    console.log("dian"+response);
           // var Latitude,Longitude,Name;  
         for(var i=0;i<response.length;i++)
          {
          //  console.log(response[i]);

              leaflet.removeLayer(tpariwisata[response[i].id]);
            
          //  leaflet.removeLayer(bebas[data[naonweh].id);   
          }