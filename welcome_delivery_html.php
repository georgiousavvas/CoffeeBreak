<?php session_start(); ?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>CoffeeBreak</title>
	<link rel="icon" type="image/png" sizes="32x32" href="favicon_transp.png">
    <style>
           /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
       
		width: 60%;
		height: 60%;
		left: 20%;
		top: 5%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
		background-image: url("coffee_time.jpg");
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 20px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 450px;
		height: 50px;
		position:absolute; 
		top:13%;
		left:35%;
		
      }

      #pac-input:focus {
        border-color: #4d90fe;
		
      }

      
      #target {
        width: 345px;
      }
	  
	  .logout_btn {
		position:absolute; 
		top:0; 
		right:0;
	  
	  }
	  
	  .start_btn {
		position:absolute; 
		bottom: 0;
		left: 45%;
	  }
	  
	  
	  
	  
	  .buttonHover:hover {
        background-color: green;
        -webkit-transition-duration: 0.5s;
		transition-duration: 0.5s;
        color: white;
      }
	  
	  ::placeholder { 
    
		font-size: 20px;
		text-align: center;
		
    
		}
		
		.textbox{
			color:white; 
		}
		
		input[type=text]:focus {
			outline: 5px solid #1062e8;
	 
		
		
				 
				
				 
		
    </style>
  </head>
  <body>
  
  
  <p align="center" style="font-family: Georgia,serif; font-size:90px; font-style: italic; color:white;  margin-bottom: 20px; margin-top: 0px; text-shadow: 5px 5px #ff0000;">CoffeeBreak</p>
   <div id="map" ></div>
	
	
	<form action="/logout.php">
	<div class="logout_btn">
        <button class="buttonHover" type="submit" style="height:40px; width:200px; font-size: 15px; border-radius: 25px; border: 5px solid red;">Αποσύνδεση</button>
	</div>
	</form>	
	
	<input id="pac-input" class="controls" name="search"  type="text" placeholder="Αναζήτηση" autocomplete="off" >
	<form action="/delivery.php" method="post" autocomplete="off">
	
	<input type="hidden" name="lat" id="secret1" required>
	<input type="hidden" name="long" id="secret2" required>
    <input type="hidden" name="address" id="secret3">
    <input type="hidden" name="search" id="secret4">
	
	<div class="start_btn">
        <button class="buttonHover" type="submit" style="height:140px; width:140px; font-size: 20px; border-radius: 50%; border: 5px solid green;">'Εναρξη βάρδιας</button>
	</div>
	
	</form>		
	
	<script>
	function fillHiddenFields(position, place) {
		var lat = document.getElementById("secret1");
		var lng = document.getElementById("secret2");
		var address = document.getElementById("secret3");
		var search = document.getElementById("secret4");
		
		//myElement.text(marker.position.lat().toFixed(4) + ',' + marker.position.lng().toFixed(4));
		lat.value = position.lat();
		lng.value = position.lng();
		if (place){
			address.value = place.formatted_address || "";
			search.value = place.name || "";
		}
	}	
	</script>
	
	
    <script>
	var searchBox = null;
	var map;
	var marker;
	var myAddress;

	function map_init() {
	
	// Initialize the map centered at Greece.
	map = new google.maps.Map(document.getElementById('map'), {
	  center: {lat: 39.0998, lng: 21.8023},
	  zoom: 7
	});
	
	
	marker = new google.maps.Marker({
	  map: map,
	  draggable: true,
	  anchorPoint: new google.maps.Point(0, -29),
	  icon: 'http://www.google.com/intl/en_us/mapfiles/ms/icons/red-dot.png'
	});
	
	google.maps.event.addListener(marker, "position_changed", function(){
		fillHiddenFields(marker.getPosition());
	});
	
	var input = document.getElementById('pac-input');
	
	if (input == null) return;

	// Replaced Autocomplete with SearchBox.
	// The reason is SearchBox behaves identically,
	// but in addition it performs a search in case
	// our user does not select an address from the list
	// but hits enter instead.
	
	// var autocomplete = new google.maps.places.Autocomplete(input, { componentRestrictions: {country: 'gr'}});
	// autocomplete.setTypes([]);
	searchBox = new google.maps.places.SearchBox(input);

	// autocomplete.addListener('place_changed', function() {
	google.maps.event.addListener(searchBox, 'places_changed', function() {
		
	  myAddress = input.value;
	  
	  marker.setVisible(false);
	  
	  // var place = autocomplete.getPlace();
	  var place = searchBox.getPlaces()[0];
	  
	  if (!place || !place.geometry) {
		// User entered the name of a Place that was not suggested and
		// pressed the Enter key, or the Place Details request failed.
		window.alert("Μη έγκυρη τοποθεσία: '" + myAddress + "'");
		return;
	  }

	  // If the place has a geometry, then present it on a map.
	  if (place.geometry.viewport)
		  
		map.fitBounds(place.geometry.viewport);	
		
	  else {
		map.setCenter(place.geometry.location);
		map.setZoom(17);  // Why 17? Because it looks good.
	  }
	  
	 marker.setPosition(place.geometry.location);
	  marker.setVisible(true);
	  
	  fillHiddenFields(place.geometry.location, place);
	  

	  var address = '';
	  if (place.address_components) {
		address = [
		  (place.address_components[0] && place.address_components[0].short_name || ''),
		  (place.address_components[1] && place.address_components[1].short_name || ''),
		  (place.address_components[2] && place.address_components[2].short_name || '')
		].join(' ');
	  }
	});
	
}
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNq9sbi2H_cpnxJJzRy34RenH2qVECJUY&libraries=places&callback=map_init"
         async defer></script>
	 
		 
  </body>
</html>
