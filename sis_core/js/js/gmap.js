//======= START GOOGLE MAP ======
var mapDrawing,
list_marker, list_polygon, list_polyline, list_circle,
list_infowindow,
drawingManager,
selectedShape,
range_start, range_end,
infoWindow, maxZoomService,
tmp_address, search_place, tmp_place, coor_place,
directionsService, directionsDisplay;

function callMap(div_id='map',coordinate={lat:-8.65191, lng:116.518869}, zoom=18){
// Map Type ID
// ROADMAP (normal, default 2D map)
// SATELLITE (photographic map)
// HYBRID (photographic map + roads and city names)
// TERRAIN (map with mountains, rivers, etc.)
	list_marker=[];
	list_polygon=[];
	list_polyline=[];
	list_infowindow=[];
	list_circle=[];
	directionsService='';
	directionsDisplay='';
	coordinate = parseCoor(coordinate, 'coordinat');
	var map = new google.maps.Map(document.getElementById(div_id), {
		zoom: zoom,
		center: coordinate,
		mapTypeId: 'roadmap',
            // mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: true,
            mapTypeControlOptions: {
            	style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            	position: google.maps.ControlPosition.BOTTOM_LEFT
            }, 
            disableDefaultUI: true,
            optimized: false, 
            zoomControl: true
          });
	infoWindow = new google.maps.InfoWindow();

	maxZoomService = new google.maps.MaxZoomService();

	mapDrawing=map;
	return map; 
}

function setDrawingManager(){
	drawingManager = new google.maps.drawing.DrawingManager({
		drawingMode: google.maps.drawing.OverlayType.Polygon,
		drawingControl: true,
		drawingControlOptions: {
			position: google.maps.ControlPosition.TOP_CENTER,
			drawingModes: ['polygon']
		}
	});
	drawingManager.setMap(mapDrawing);
	return drawingManager;
}

function setPolygon(coordinate='', strokeColor='', fillColor='', editable=false, id=''){
	// var polygonCoord = [
	// {lat: 25.774, lng: -80.190},
	// {lat: 18.466, lng: -66.118},
	// {lat: 32.321, lng: -64.757},
	// {lat: 25.774, lng: -80.190}
	// ];
	var polygonCoord = [];
	if(coordinate!=''){
		polygonCoord = coordinate;
	}
	polygonCoord = parseCoor(polygonCoord, 'array');
	var polygonMap = new google.maps.Polygon({
		paths: polygonCoord,
		strokeColor: strokeColor==''? '#7DBB37' : strokeColor,
		strokeOpacity: 0.8,
		strokeWeight: 2,
		fillColor: fillColor==''? '#A2CB38' : fillColor,
		editable: editable,
		id: id,
		fillOpacity: 0.35
	});
	list_polygon.push(polygonMap);
	polygonMap.setMap(mapDrawing);
	return polygonMap;
}

function setPolyLine(coordinate='', color='', editable=false, id=''){
	var polygonCoord = [
	{lat: 25.774, lng: -80.190},
	{lat: 18.466, lng: -66.118},
	{lat: 32.321, lng: -64.757},
	{lat: 25.774, lng: -80.190}
	];
	if(coordinate!=''){
		polygonCoord = coordinate;
	}
	polygonCoord = parseCoor(polygonCoord, 'array');
	var polyline = new google.maps.Polyline({
		path: coordinate,
		geodesic: true,
		strokeColor: color==''? '#FF0000' : color,
		strokeOpacity: 1.0,
		editable: editable,
		id: id,
		strokeWeight: 2
	});

	list_polyline.push(polyline);
	polyline.setMap(mapDrawing); 	
	return polyline;
}

function setMarker(coordinate={lat:-8.65191, lng:116.518869}, label='.', hover_text='', draggable=false){
	var address = '';
	coordinate = parseCoor(coordinate, 'coordinat');
	if(hover_text==''){
		var geocoder = new google.maps.Geocoder;
		geocoder.geocode({'location': coordinate}, function(results, status) {
			address = 'unkown address';
			if (status == google.maps.GeocoderStatus.OK) {
				address = results[0].formatted_address;
			}
			var marker = new google.maps.Marker({
				position: coordinate,
				map: mapDrawing,
				label : label,
				title: 'Status : Not Move - '+address
			});
			list_marker.push(marker);
		});
	}else{
		var marker = new google.maps.Marker({
			position: coordinate,
			map: mapDrawing,
			draggable: draggable,
			label : label,
			title: hover_text
		});
		list_marker.push(marker);
	}
	return marker;
}

function setRoute(start={lat:-8.65191, lng:116.518869}, end={lat:-8.65191, lng:116.518869}){
	start = parseCoor(start, 'coordinat');
	end = parseCoor(end, 'coordinat');
	if(directionsService=='')
		directionsService = new google.maps.DirectionsService();
	
	if(directionsDisplay!='')
		directionsDisplay.setMap(null);
	
	directionsDisplay = new google.maps.DirectionsRenderer();

	var bounds = new google.maps.LatLngBounds();
	bounds.extend(start);
	bounds.extend(end);
	mapDrawing.fitBounds(bounds);
	var request = {
		origin: start,
		destination: end,
		travelMode: google.maps.TravelMode.DRIVING
	};
	directionsService.route(request, function (response, status) {
		if (status == google.maps.DirectionsStatus.OK) {
			directionsDisplay.setDirections(response);
			directionsDisplay.setMap(mapDrawing);
		} else {
			swalMessage("Directions Request from " + start.toUrlValue(6) + " to " + end.toUrlValue(6) + " failed: " + status);
		}
	});
	// directionsDisplay.addListener('click', function(e){
		// console.log(directionsService);
	// });
}

// function getLocation(coordinate={lat:25.774, lng:-80.190})
// {
// 	var geocoder = new google.maps.Geocoder;
// 		geocoder.geocode({'location': coordinate}, function(results, status) {
// 						        		address = results[0].formatted_address;
// 						        		var marker = new google.maps.Marker({
// 								          position: coordinate,
// 								          map: mapDrawing,
// 								          label : label,
// 								          title: 'Status : Not Move - '+address
// 								        });
// 								        list_marker.push(marker);
// 							        });

// }

function setMovingMarker(coordinate={lat:-8.65191, lng:116.518869}, hover_text='', image='https://client.terra-id.com/src/icon/tractor-point.gif')
{
	var marker = new google.maps.Marker({
		position: coordinate,
		map: mapDrawing,
		animation: google.maps.Animation.DROP,
		icon: image,
		title: hover_text
	});
	list_marker.push(marker);
	return marker;
}

function moveMarker(marker='', coordinate={lat:-8.65191, lng:116.518869})
{
	marker = marker==''? list_marker[0] : marker;
	marker.setPosition( coordinate );
	marker.setAnimation(google.maps.Animation.DROP);
	moveToLocation(coordinate, use_marker=false);
}

function moveToLocation(coordinate={lat:-8.65191, lng:116.518869}, use_marker=false, label_marker='.', hover_text_marker=''){
	coordinate = parseCoor(coordinate, 'coordinat');
	if( use_marker )
		setMarker(coordinate, label_marker, hover_text_marker);
  // using global variable:
  mapDrawing.panTo(coordinate);
}

function clearMarker(){
	$.each(list_marker, function(key, val) {
		val.setMap(null);
	});
	list_marker=[];

}

function clearInfowindow(){
	$.each(list_infowindow, function(key, val) {
		val.close();
	});
	list_infowindow=[];
}

function clearPolygon(id=''){
	if(id==''){
		$.each(list_polygon, function(key, val) {
			val.setMap(null);
		});
		list_polygon=[];
	}else{
		var key = findPolygonById(id);
		list_polygon[key].setMap(null);
		list_polygon.splice(key, 1);
	}
}

function cleardrawPolygon() {
	if (draw_polygon) {
		draw_polygon.setEditable(false);
		draw_polygon.setMap(null);
		draw_polygon = '';
	}
}


function clearPolyline(id=''){
	if(id==''){
		$.each(list_polyline, function(key, val) {
			val.setMap(null);
		});
		list_polyline=[];
	}else{
		var key = findPolylineById(id);
		list_polyline[key].setMap(null);
		list_polyline.splice(key, 1);
	}
	
}

function getPolygonCenter(coordinate=''){
	var polygonCoord = [
	{lat: 25.774, lng: -80.190},
	{lat: 18.466, lng: -66.118},
	{lat: 32.321, lng: -64.757},
	{lat: 25.774, lng: -80.190}
	];
	if(coordinate!=''){
		polygonCoord = parseCoor(coordinate, 'array');
	}
	var sumLat = 0, sumLong = 0;
	$.each(polygonCoord, function(key, val) {
		sumLat += val.lat;
		sumLong += val.lng;
	});
	return {lat:(sumLat / polygonCoord.length),lng:(sumLong / polygonCoord.length)};
}

function getPolygonCenter_string(coordinate=''){
	var polygonCoord = [
	{lat: 25.774, lng: -80.190},
	{lat: 18.466, lng: -66.118},
	{lat: 32.321, lng: -64.757},
	{lat: 25.774, lng: -80.190}
	];
	if(coordinate!=''){
		polygonCoord = coordinate;
	}
	var sumLat = 0, sumLong = 0;
	$.each(polygonCoord, function(key, val) {
		sumLat += val.lat;
		sumLong += val.lng;
	});
	return (sumLat / polygonCoord.length) +  "@" +(sumLong / polygonCoord.length);
}

function callInfoWindow(coordinate={lat:25.774, lng:-80.190}, message=''){
	coordinate = parseCoor(coordinate, 'coordinat');
	var x = new google.maps.InfoWindow();
	x.setContent(message);
	x.setPosition(coordinate);
	x.open(mapDrawing);
	list_infowindow.push(x);
}

function addListener(var_key, listener='click', event){
		clearListener(var_key);
		var_key.addListener('click', function(e){
			event(e);
		});
	}

function clearListener(var_key){
	var event_listener = ['click', 'keyup', 'keydown', 'keypress', 'change'];
	$.each(event_listener, function(key, event_listener) {
		google.maps.event.clearListeners(var_key, event_listener);
	});
}

function setCircle(center, radius){
	// center: {"lat": -8.651738986878408,"lng": 116.51920695833586}
	// radius: in meter
	var map = mapDrawing;
	var circle = new google.maps.Circle({
		strokeColor: "#FF0000",
		strokeOpacity: 0.8,
		strokeWeight: 2,
		fillColor: "#FF0000",
		fillOpacity: 0.35,
		map,
		center: center,
		radius: parseFloat(radius),
	});
	list_circle.push(circle);
	return circle;
}

function clearCircle(){
	$.each(list_circle, function(key, val) {
			val.setMap(null);
		});
		list_circle=[];
}

//======= End GOOGLE MAP ======

//======= Start extend GOOGLE MAP =======
function sizeOfPolygonById(id){
	var area = google.maps.geometry.spherical.computeArea(list_polygon[id].getPath());
	return area.toFixed(4); //satuan meter
}


function sizeOfPolygon(polygon=''){
	var area = google.maps.geometry.spherical.computeArea(polygon.getPath());
	return area.toFixed(4); //satuan meter
}

function getPolygonCoordinat(polygon){
	var coor = [];
	polygon.getPath().forEach(function(xy,i){
    coor.push({lat: xy.lat(), lng: xy.lng()});
  });
	return coor;
}

function findPolygonById(id){
	var result='';
	$.each(list_polygon, function(key, val){
		if( $(this)[0]['id']==id ){
			result= key;
			return false;
		}
	});
	return result;
}

function findPolylineById(id){
	var result='';
	$.each(list_polyline, function(key, val){
		if( $(this)[0]['id']==id ){
			result= key;
			return false;
		}
	});
	return result;
}

var tmp_track_record=[];
function setPolylineRangeSlider(id_polyline, color, track=[]){
	if( track.length==0 || Object.keys(track).length==0 )
		track={};

	var values =[];
	var start,end;
	var no=0;
	
	tmp_track_record=track;
	$.each(track, function(key, val) {
		if(no==0)
			start=key;
						
		values.push(key);
		end=key;
		no++;
	});
	$('#range_time').empty();
	$('#range_time').append('<div id="this-range"></div>');
	$("#this-range").ionRangeSlider({
		type: "double",
		grid: true,
		from: start,
		to: end,
		values: values
	});
	$('#this-range').on('change', function(){
		setNewPolyline(id_polyline, $(this).val(), color, tmp_track_record);
	});
	setTimeout(function(){
		setNewPolyline(id_polyline, $('#this-range').val(), color, tmp_track_record);
	},200);

}
var rangePoly_coor=[];
var rangePoly_coor_raw=[];
function setNewPolyline(id_polyline, range_value, color, track_record){
	var range = range_value.split(';');
	var new_polyline = [];
	var no=0;
	var start,end;
	clearPolyline(id_polyline);
	rangePoly_coor=[];
	rangePoly_coor_raw=[];
	$.each(track_record, function(date_, coor) {
			// console.log([dateToSecond(date_), dateToSecond(range[0]), dateToSecond(range[1])]);
			// console.log([date_, range[0], range[1]]);
			if( dateToSecond(range[0])<=dateToSecond(date_) && dateToSecond(date_)<=dateToSecond(range[1]) ){
				if(no==0)
					start=coor;

				var parse_coor = parseCoor(coor, 'koor');
				new_polyline.push(parse_coor);
				end=parse_coor;
				rangePoly_coor.push( (parse_coor.lat).toFixed(4)+''+(parse_coor.lng).toFixed(4) );
				rangePoly_coor_raw.push( parse_coor );
				no++;
			}
		});
	var poli = setPolyLine(new_polyline, color, false, id_polyline);
	poli.addListener('click', function(e) {
		var path = e.latLng;
		var key_ = (path.lat()).toFixed(4)+''+(path.lng()).toFixed(4);
		var index_ = rangePoly_coor.indexOf(key_);
		if(  index_>0 ){
			$('#this-range').data("ionRangeSlider").update({
				to: index_
			});
			$('#this-range').trigger('change');
		}
	});
	clearMarker();
	setMarker(start, label='A', '-');
	setMarker(end, label='B', '-');
	if( range[0]== range_start){
		moveToLocation(end, false);
	}else{
		moveToLocation(start, false);
	}
	range_start = range[0];
	range_end = range[1];
}

function findRecordDate(date_time='2020-01-03 05:52:46'){
  		var date_time = dateToSecond(date_time);
  		var a = '';
  		var result = '';
  		var index = 0;
  		$.each(tmp_track_record,function(key, val) {
  			var rec = dateToSecond(key);
  			if( date_time > rec ){
  				result=index;
  			}else{
  				if( a<(rec-date_time) ){
  					result=index;
  				}
  				return false;
  			}
  			index++;
  		});

  		return result;
  	}

function setRangeSlider(from="2020-01-04 08:28:29", to="2020-01-04 09:33:24"){
	from = findRecordDate(from);
	to = findRecordDate(to);
	var instance = $('#this-range').data("ionRangeSlider");
	instance.update({
		from: from,
		to: to
	});
}

function setAddress(coordinate={lat:-8.65191, lng:116.518869})
{
	var geocoder = new google.maps.Geocoder;
	document.geoCodeRequestCompleteFlag = 0;
	geocoder.geocode({'location': coordinate}, function(results, status) {
		tmp_address = results[0].formatted_address; 
	});
}

function getAddress(coordinat={lat:25.774, lng:-80.190}){
	setAddress(coordinat);
	return tmp_address;
}

function parseCoor(coor, type='array'){
	var lat_list=['lng', 'long', 'longi', 'longitude', 'longitudehistory'];
	var lng_list=['lat', 'latitude', 'latitudehistory'];
	var index_list=['historyfulldate'];
	var new_coor=[];
	if(type=='array'){
		$.each(coor, function(key, val) {
			var lat=0;
			var lng=0;
			$.each(val, function(k,v){
				if( $.inArray(k.toLowerCase(), lat_list)!=-1 ){
					lng=parseFloat(v);
				}
				if( $.inArray(k.toLowerCase(), lng_list)!=-1 ){
					lat=parseFloat(v);
				}
			});
			new_coor.push({lat:lat, lng:lng});
		});
	}else if(type=='rangeslider'){
		new_coor={};
		$.each(coor, function(key, val) {
			var lat=0;
			var lng=0;
			var index=key;
			$.each(val, function(k,v){
				if( $.inArray(k.toLowerCase(), lat_list)!=-1 ){
					lng=parseFloat(v);
				}
				if( $.inArray(k.toLowerCase(), lng_list)!=-1 ){
					lat=parseFloat(v);
				}
				if( $.inArray(k.toLowerCase(), index_list)!=-1 ){
					index=v;
				}
			});
			new_coor[index] = {lat:lat, lng:lng};
		});
	}else{
		var lat=0;
		var lng=0;
		$.each(coor, function(k,v){
			if( $.inArray(k.toLowerCase(), lat_list)!=-1 ){
				lng=parseFloat(v);
			}
			if( $.inArray(k.toLowerCase(),lng_list)!=-1 ){
				lat=parseFloat(v);
			}
		});
		new_coor={lat:lat, lng:lng};
	}
	return new_coor;
};

function setSearchPlace(){
	$('#search-address').empty();
	$('#search-address').append('<input id="search-address-input" class="form-control" \
				placeholder="masukan Alamat yang di cari"\
				onFocus="geolocate()"\
				type="text"/>');
	search_place = new google.maps.places.Autocomplete(document.getElementById('search-address-input'), {types: ['geocode']});
	search_place.bindTo('bounds', mapDrawing);
	search_place.setFields(['address_components', 'geometry', 'icon', 'name']);
	search_place.addListener('place_changed', returnSearchPlace);
}

function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle(
          {center: geolocation, radius: position.coords.accuracy});
      search_place.setBounds(circle.getBounds());
    });
  }
}

function returnSearchPlace(coordinat={lat:0, lng:0}){
	coor_place = coordinat;
	if( coordinat.lat==0 && coordinat.lng==0 ){
		tmp_place = search_place.getPlace();
	  $('#search-address-input').trigger('change');
	}else{
		var geocoder = new google.maps.Geocoder;
		document.geoCodeRequestCompleteFlag = 0;
		geocoder.geocode({'location': coordinat}, function(results, status) {
			// console.log([results, status]);
			if(status=='OK'){
				tmp_place = results[0];
				$('#search-address-input').trigger('change');
			}
		});
	}
}

//======= End extend GOOGLE MAP =======