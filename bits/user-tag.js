var Icon = L.Icon.extend({
				 options: {            
				 }     
				});
				var usertag=new Icon({iconUrl : 'img/male.png'});
if (sesion != false){
			getLocation();
		}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.watchPosition(showPosition);
    } else { 
       
    }
  }
    
function showPosition(position) {
	insertPositionToDatabase(position);
}

function insertPositionToDatabase(position) {
	$.ajax({
		type: 'GET',
		data: {lat: position.coords.latitude, lon: position.coords.longitude},
		//dataType: 'json',
		url: 'dbtweet/inserttag.php',
		success: function(json){
			L.marker(
				[position.coords.latitude,position.coords.longitude],{icon: usertag}).bindPopup("<b>Report User</b> </br></br> <form method='post' action='inputreportuser.php'><input type='hidden' name='lat' value='"+position.coords.latitude+"'><input type='hidden' name='lon' value='"+position.coords.longitude+"'><input type='hidden' name='namauser' value='"+sesion+"'><input type='hidden' name='tipe' value='1'><input type='image' src='img/accident.png' alt='Submit'></br><label>Accident</label></form><form method='post' action='inputreportuser.php'><input type='hidden' name='lat' value='"+position.coords.latitude+"'><input type='hidden' name='lon' value='"+position.coords.longitude+"'><input type='hidden' name='namauser' value='"+sesion+"'><input type='hidden' name='tipe' value='2'><input type='image' src='img/closure.png' alt='Submit'></br><label>Closure</label></form><form method='post' action='inputreportuser.php'><input type='hidden' name='lat' value='"+position.coords.latitude+"'><input type='hidden' name='lon' value='"+position.coords.longitude+"'><input type='hidden' name='namauser' value='"+sesion+"'><input type='hidden' name='tipe' value='3'><input type='image' src='img/traffic.png' alt='Submit'></br></br><label>Traffic</label></form><form method='post' action='inputreportuser.php'><input type='hidden' name='lat' value='"+position.coords.latitude+"'><input type='hidden' name='lon' value='"+position.coords.longitude+"'><input type='hidden' name='namauser' value='"+sesion+"'><input type='hidden' name='tipe' value='4'><input type='image' src='img/disaster.png' alt='Submit'></br><label>Disaster</label></form>").addTo(leaflet);
		}, error: function(err){
			//console.log(err);
		}
	})
	
}

