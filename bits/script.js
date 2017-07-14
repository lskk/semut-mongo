var leaflet;
var point_prediksi = [[],[],[],[],[],[],[],[]];
var trafficCollection = {};
var currentRoute;
var globalBool = 0;

var PASTEUR = 0;
var CIHAMPELAS = 1;
var ASIAAFRIKA = 2;
var DIPATIUKUR = 3;
var JUANDA = 4;
var CIPAGANTI = 5;
var BUAHBATU = 6;
var SUKAJADI = 7;

var pointEuy = [];
var countClick = 0;

var bebas = {};
var tfood = {};
var tbus = {};
var trs = {};
var tuni = {};
var tfuel = {};
var tbank = {};
var tcool = {};
var tmember = [];
var tpariwisata = [];

//var trafficCollection;
var jalan = ['pasteur','cihampelas','asia afrika','dipatiukur','ir h.juanda','cipaganti','buah batu','sukajadi'];
// var konstanta = [
// 	[-0.1665,-0.979,0.621,0.6745],
// 	[-0.9085,0.608875,0.05825,0.44575], ;..
// 	[-0.35,-0.15,0.65,0.025],
// 	[-0.075,0.125,-0.075,-0.0625],
// 	[-0.26675,-0.26675,0.42075,0.233875],
// 	[-0.5,0.5125,1.525,-1.475],
// 	[-0.89175,-0.69175,0.865125,0.64775],
// 	[-1.2,-0.2,0.8,0.6],
// ];

var alfa =[-0.0293,0.0198,0.009,-0.0033,0.0039,0.0112,0.0149,0.0045];
var beta =[3.317,1.1108,1.423,1.3828,1.5809,1.2003,1.6942,1.1654];
var pagi =[0.1085,-0.3835,-0.525,0.075,-0.46675,-0.15,-0.89175,-0.1]; 
var siang =[-0.854,0.746375,0.275,0.4625,-0.05425,0.0625,-0.49175,0.1]; 
var sore =[0.371,-0.19175,0.25,-0.35,0.28325,0.2375,0.627625,-0.1]; 
var malam =[1.0245,0.17075,0.1875,-0.325,0.321375,-0.4,0.74775,0.1]; 

var DEFAULT_LONGLAT = [-6.903, 107.643];
var DEFAULT_ZOOM = 13;
var MAPQUEST_URL = 'http://otile{s}.mqcdn.com/tiles/1.0.0/osm/{z}/{x}/{y}.png';

//var MAPQUEST_URL = 'http://192.168.31.118/osm/{z}/{x}/{y}.png';
var MAPQUEST_ATTRIB = 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors';

// Demanded JSON format
// var dummy_1 = {
// 	id_str: '0',
// 	timestamp: '23:00:00',
// 	lokasi: 'dago_1',
// 	point: '(-6.9002142,107.6126498) (-6.9004710,107.6125299) (-6.9009045,107.6123291) (-6.9011479,107.6122217) (-6.9012962,107.6121540)',
// 	twitter: 'padat merayap',
// 	cctv: 'lancar',
// 	user: null
// };


// Initialize leaflet map
var Icon = L.Icon.extend({
				 options: {            
				 }     
				});
				var food=new Icon({iconUrl : 'img/resto.png'});

				 var Icon = L.Icon.extend({
         options: {            
         }     
        });


        var gas=new Icon({iconUrl : 'img/gas.png'});

        	var Icon = L.Icon.extend({
				 options: {            
				 }     
				});
				var bank=new Icon({iconUrl : 'img/bank.png'});

        var Icon = L.Icon.extend({
				 options: {            
				 }     
				});
				var dian=new Icon({iconUrl : 'img/university.png'});

				var Icon = L.Icon.extend({
				 options: {            
				 }     
				});
				var rs=new Icon({iconUrl : 'img/hospital.png'});

					var Icon = L.Icon.extend({
				 options: {            
				 }     
				});
				var bus=new Icon({iconUrl : 'img/parking.png'});
					var Icon = L.Icon.extend({
         options: {            
         }     
        });

function map_OnClick(e){
	if(!bool){
		return;
	}
	//alert("K");
	if (countClick < 2){	
		pointEuy[countClick] = e.latlng.lat + "|" + e.latlng.lng;
		//alert("Klik lokasi yang di tuju");
		if (countClick == 1){
			routing();
		}
		if (countClick == 0){
			alert ("Klik kembali untuk menentukan lokasi yang di tuju")
		}
		countClick = countClick + 1;
	}
}

function routing(){
	//alert(pointEuy[0]+"  hey  "+pointEuy[1]);
	var res = pointEuy[0].split("|");
	var res2 = pointEuy[1].split("|");
	currentRoute = L.Routing.control({
	  waypoints: [
		L.latLng(res[0],res[1]),
		L.latLng(res2[0],res2[1])
	  ]
	}).addTo(leaflet);
}

function routeOn(){
	alert ("Routing di mulai");
	bool = 1;
	//$('#pred :input, #cari-rute-angkot :input').attr('disabled', 'disabled');
	$('#buttonOn').attr('disabled', 'disabled');
	//leaflet.on('click', map_OnClick);
	//$('#buttonOff').removeAttr('disabled');
	for(var deta in trafficCollection){
		leaflet.removeLayer(trafficCollection[deta]);
	}
}

function routeOff(){
	alert ("Routing berakhir");
	bool = 0;
	//$('#pred :input, #cari-rute-angkot :input').removeAttr('disabled');
	//$('#buttonOff').attr('disabled', 'disabled');
	$('#pred :input, #cari-rute-angkot :input').removeAttr('disabled');
	for(var dikara in trafficCollection){
		leaflet.addLayer(trafficCollection[dikara]);
	}
	currentRoute.spliceWaypoints(0, 2);
	//currentRoute.getPlan().setWaypoints([]);
	/*leaflet.getMap().then(function(map){
		map.removeControl(currentRoute);
	});*/
}

var sekolah=new Icon({iconUrl : 'img/school.png'});


var Icon = L.Icon.extend({
         options: {            
         }     
        });
var pariwisata=new Icon({iconUrl : 'img/pariwisata.png'});

var Icon = L.Icon.extend({
         options: {            
         }     
        });
var angkot1=new Icon({iconUrl : 'img/angkot/Angkot 1.png'});
var angkot2 = new Icon({iconUrl : 'img/angkot/Angkot 2.png'});
var angkot3 = new Icon({iconUrl : 'img/angkot/Angkot 3.png'});
var angkot4 = new Icon({iconUrl : 'img/angkot/Angkot 4.png'});
var angkot5 = new Icon({iconUrl : 'img/angkot/Angkot 5.png'});
var angkot6 = new Icon({iconUrl : 'img/angkot/Angkot 6.png'});
var angkot7 = new Icon({iconUrl : 'img/angkot/Angkot 7.png'});
var angkot8 = new Icon({iconUrl : 'img/angkot/Angkot 8.png'});
var angkot9 = new Icon({iconUrl : 'img/angkot/Angkot 9.png'});
var angkot10 = new Icon({iconUrl : 'img/angkot/Angkot 10.png'});
var angkot11 = new Icon({iconUrl : 'img/angkot/Angkot 11.png'});
var angkot12 = new Icon({iconUrl : 'img/angkot/Angkot 12.png'});
var angkot13 = new Icon({iconUrl : 'img/angkot/Angkot 13.png'});
var angkot14 = new Icon({iconUrl : 'img/angkot/Angkot 14.png'});
var angkot15 = new Icon({iconUrl : 'img/angkot/Angkot 15.png'});
var angkot16 = new Icon({iconUrl : 'img/angkot/Angkot 16.png'});
var angkot17 = new Icon({iconUrl : 'img/angkot/Angkot 17.png'});
var angkot18 = new Icon({iconUrl : 'img/angkot/Angkot 18.png'});
var angkot19 = new Icon({iconUrl : 'img/angkot/Angkot 19.png'});
var angkot20 = new Icon({iconUrl : 'img/angkot/Angkot 20.png'});
var angkot21 = new Icon({iconUrl : 'img/angkot/Angkot 21.png'});
var angkot22 = new Icon({iconUrl : 'img/angkot/Angkot 22.png'});
var angkot23 = new Icon({iconUrl : 'img/angkot/Angkot 23.png'});
var angkot24 = new Icon({iconUrl : 'img/angkot/Angkot 24.png'});
var angkot25 = new Icon({iconUrl : 'img/angkot/Angkot 25.png'});
var angkot26 = new Icon({iconUrl : 'img/angkot/Angkot 26.png'});
var angkot27 = new Icon({iconUrl : 'img/angkot/Angkot 27.png'});
var angkot28 = new Icon({iconUrl : 'img/angkot/Angkot 28.png'});

var Icon = L.Icon.extend({
         options: {            
         }     
        });
var cctv=new Icon({iconUrl : 'img/camera.png'});
var member = new Icon({iconUrl : 'img/male.png'});
var kereta = new Icon({iconUrl : 'img/marker-station.png'});

var Icon = L.Icon.extend({
         options: {            
         }     
        });
var usr=new Icon({iconUrl : 'img/male.png'});
function initLeaflet() {
	leaflet = new L.map('my-map');

	var mapTile = new L.TileLayer(MAPQUEST_URL, {
		subdomains: '1234',
		maxZoom: 18,
		attribution: MAPQUEST_ATTRIB
	});

	leaflet.setView(DEFAULT_LONGLAT, DEFAULT_ZOOM);
	leaflet.addLayer(mapTile);

	
	//http://192.168.31.118/osm/slippymap.html
}

// Draw traffic collections
function drawTraffic(thing, jalan) {
	for(var iihh = 0; iihh < thing.length; iihh++) {
		var obj = thing[iihh];
		var pointCollection = obj.pt.split(') (');
		//console.log(pointCollection);
		//var condition = 'no data';
		var condition =0;
		var hitung= 0;

		// kondisi untuk operator
		if(obj.ko == 'lancar'){
			obj.ko=1;
		}
		if(obj.ko == 'ramai'){
			obj.ko=2;
		}
		if(obj.ko == 'padat'){
			obj.ko=3;
		}
		if(obj.ko == 'macet'){
			obj.ko=4;
		}
		if(obj.ko == 'diam'){
			obj.ko=5;
		}
		// kondisi untuk twitter
		if(obj.kt == 'lancar'){
			obj.kt=1;
		}
		if(obj.kt == 'ramai'){
			obj.kt=2;
		}
		if(obj.kt == 'padat'){
			obj.kt=3;
		}
		if(obj.kt == 'macet'){
			obj.kt=4;
		}
		if(obj.kt == 'diam'){
			obj.kt=5;
		}

		// // kondisi untuk cctv

		if(obj.kc == 'lancar'){
			obj.kc=1;
		}
		if(obj.kc == 'ramai'){
			obj.kc=2;
		}
		if(obj.kc == 'padat'){ 
			obj.kc=3;
		}
		if(obj.kc == 'macet'){
			obj.kc=4;
		}
		if(obj.kc == 'diam'){
			obj.kc=5;
		}

		// // kondisi untuk user

		if(obj.ku == 'lancar'){
			obj.ku=1;
		}
		if(obj.ku == 'ramai'){
			obj.ku=2;
		}
		if(obj.ku == 'padat'){
			obj.ku=3;
		}
		if(obj.ku == 'macet'){
			obj.ku=4;
		}
		if(obj.ku == 'diam'){
			obj.ku=5;
		}


		// semua memiliki data
		if(obj.ko && obj.kt && obj.kc && obj.ku){
			//condition1 = 0.20*obj.twitter*1+0.35*obj.cctv*1+0.45*obj.user*1;
			//alert(obj.twitter);
			hitung =Math.round(0.25*obj.ko+0.20*obj.kt+0.28*obj.kc+0.27*obj.ku);
			//alert(hitung);
			condition = hitung;
			//condition= obj.twitter;
		}

		// jika salah satu tidak mempunyai data
		if(!obj.ko && obj.kt && obj.kc && obj.ku){
			hitung =Math.round(0.25*obj.kt+0.30*obj.kc+0.45*obj.ku);
			condition = hitung;
		}
		if(obj.ko && !obj.kt && obj.kc && obj.ku){
			hitung =Math.round(0.25*obj.ko+0.30*obj.kc+0.45*obj.ku);
			condition = hitung;
		}
		if(obj.ko && obj.kt && !obj.kc && obj.ku){
			hitung =Math.round(0.30*obj.ko+0.25*obj.kt+0.45*obj.ku);
			condition = hitung;
		}
		if(obj.ko && obj.kt && obj.kc && !obj.ku){
			hitung =Math.round(0.30*obj.ko+0.25*obj.kt+0.45*obj.kc);
			condition = hitung;
		}

		// jika hanya dua data yang terisi 2 saja
		if(!obj.ko && !obj.kt && obj.kc && obj.ku){
			hitung =Math.round(0.50*obj.kc+0.50*obj.ku);
			condition = hitung;
		}
		if(!obj.ko && obj.kt && !obj.kc && obj.ku){
			hitung =Math.round(0.40*obj.kt+0.60*obj.ku);
			condition = hitung;
		}
		if(!obj.ko && obj.kt && obj.kc && !obj.ku){
			hitung =Math.round(0.40*obj.kt+0.60*obj.kc);
			condition = hitung;
		}
		if(obj.ko && !obj.kt && !obj.kc && obj.ku){
			hitung =Math.round(0.45*obj.ko+0.55*obj.ku);
			condition = hitung;
		}
		if(obj.ko && !obj.kt && obj.kc && !obj.ku){
			hitung =Math.round(0.45*obj.ko+0.55*obj.kc);
			condition = hitung;
		}
		if(obj.ko && obj.kt && !obj.kc && !obj.ku){
			hitung =Math.round(0.60*obj.ko+0.40*obj.kt);
			condition = hitung;
		}

		// jika hanya satu yang mempunyai data
		if (obj.ko && !obj.kt && !obj.kc && !obj.ku){
			hitung =Math.round(1*obj.ko);
			condition = hitung;
		}
		if (!obj.ko && obj.kt && !obj.kc && !obj.ku){
			hitung =Math.round(1*obj.kt);
			condition = hitung;
		}
		if (!obj.ko && !obj.kt && obj.kc && !obj.ku){

			hitung =Math.round(1*obj.kc);
			condition = hitung;
		}
		if (!obj.ko && !obj.kt && !obj.kc && obj.ku){
			hitung =Math.round(1*obj.ku);
			condition = hitung;
		}

		// jika tidak ada yang memiliki data
		if(!obj.ko && !obj.kt && !obj.kc && !obj.ku){ // kosong
			condition = 0;
		}

		//switch(condition.toLowerCase()) {
		switch(condition) {
			case 1: var polyColor = '#00ff00'; break;
			case 2: var polyColor = '#ffff00'; break;
			case 3: var polyColor = '#ff9900'; break;
			case 4: var polyColor = '#ff0000'; break;
			case 5: var polyColor = '#660000'; break;
			default: var polyColor = '#cccccc'; break;
		}
		//alert(pointCollection);
	//alert(pointCollection.length);
		for(var i = 0; i < pointCollection.length; i++ ) {
			pointCollection[i] = pointCollection[i].replace('(', '').replace(')', '');
			pointCollection[i] = pointCollection[i].split(',');
			for(var j = 0; j < pointCollection[i].length; j++) {
				pointCollection[i][j] = Number(pointCollection[i][j]);
			}
		}
		
		trafficCollection[obj.lokasi]= L.polyline(pointCollection, {
			color: polyColor,
			weight: 3,
			opacity: 1.0
		}).addTo(leaflet);

		// var table = $('#my-table table');
		// table.append('<tr>');
		// // for(var property in obj) {
		// // 	table.find('tr:last').append('<td>' + obj[property] + '</td>');
		// // }
		// table.find('tr:last').append('<td><button data-id="' + obj.id_str + '" class="show-traffic" disabled>Show</button> <button data-id="' + obj.id_str + '" class="hide-traffic">Hide</button></td>');
		//console.log(level);
		if (sesion != false && level =='operator'){
			trafficCollection[obj.lokasi].bindPopup('<b>Lokasi:</b> ' + obj.lokasi + '<br><b>Kondisi:</b> ' + condition + '<form method="post" action="inputoperator.php"> <input type="hid