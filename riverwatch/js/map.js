var ia_map = null;

var markersArray = [];
var infowindowsArray = [];
var featuredCount=0;

//create empty LatLngBounds object
var bounds = new google.maps.LatLngBounds();

// Shows any overlays currently in the array
function showOverlays() {
  if (markersArray) {
    for (i in markersArray) {
      markersArray[i].setMap(ia_map);
    }
  }
}

// Clears any overlays currently in the array
function clearOverlays() {
  if (markersArray) {
    for (var i = 0; i < markersArray.length; i++ ) {
      markersArray[i].setMap(null);
    }
  }
}

// Closes any infowindows currently in the Array
function closeInfowindows() {
  if (infowindowsArray) {
    for (var i = 0; i < infowindowsArray.length; i++ ) {
      infowindowsArray[i].close();
    }
  }
}


// Build a Map.
function initialize_map(){
  var MY_MAPTYPE_ID = 'custom_style';
  var mapOptions = { scrollwheel:false, panControl:true, panControlOptions:{ position:google.maps.ControlPosition.LEFT_BOTTOM }, streetViewControl:false, zoomControlOptions:{ style:google.maps.ZoomControlStyle.SMALL, position:google.maps.ControlPosition.LEFT_CENTER }, mapTypeId: MY_MAPTYPE_ID, draggable:!("ontouchend" in document) };
  ia_map = new google.maps.Map(document.getElementById('map'),mapOptions);
  var featureOpts = [
    {
        "featureType": "administrative",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "lightness": 33
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "labels",
        "stylers": [
            {
                "saturation": "-100"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "labels.text",
        "stylers": [
            {
                "gamma": "0.75"
            }
        ]
    },
    {
        "featureType": "administrative.neighborhood",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "lightness": "-37"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#f9f9f9"
            }
        ]
    },
    {
        "featureType": "landscape.man_made",
        "elementType": "geometry",
        "stylers": [
            {
                "saturation": "-100"
            },
            {
                "lightness": "40"
            },
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "landscape.natural",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "saturation": "-100"
            },
            {
                "lightness": "-37"
            }
        ]
    },
    {
        "featureType": "landscape.natural",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "saturation": "-100"
            },
            {
                "lightness": "100"
            },
            {
                "weight": "2"
            }
        ]
    },
    {
        "featureType": "landscape.natural",
        "elementType": "labels.icon",
        "stylers": [
            {
                "saturation": "-100"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "geometry",
        "stylers": [
            {
                "saturation": "-100"
            },
            {
                "lightness": "80"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "labels",
        "stylers": [
            {
                "saturation": "-100"
            },
            {
                "lightness": "0"
            }
        ]
    },
    {
        "featureType": "poi.attraction",
        "elementType": "geometry",
        "stylers": [
            {
                "lightness": "-4"
            },
            {
                "saturation": "-100"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#c5dac6"
            },
            {
                "visibility": "on"
            },
            {
                "saturation": "-95"
            },
            {
                "lightness": "62"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "lightness": 20
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
            {
                "lightness": 20
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels",
        "stylers": [
            {
                "saturation": "-100"
            },
            {
                "gamma": "1.00"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.text",
        "stylers": [
            {
                "gamma": "0.50"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.icon",
        "stylers": [
            {
                "saturation": "-100"
            },
            {
                "gamma": "0.50"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#c5c6c6"
            },
            {
                "saturation": "-100"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "lightness": "-13"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "labels.icon",
        "stylers": [
            {
                "lightness": "0"
            },
            {
                "gamma": "1.09"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#e4d7c6"
            },
            {
                "saturation": "-100"
            },
            {
                "lightness": "47"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "lightness": "-12"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels.icon",
        "stylers": [
            {
                "saturation": "-100"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#fbfaf7"
            },
            {
                "lightness": "77"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "lightness": "-5"
            },
            {
                "saturation": "-100"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "saturation": "-100"
            },
            {
                "lightness": "-15"
            }
        ]
    },
    {
        "featureType": "transit.station.airport",
        "elementType": "geometry",
        "stylers": [
            {
                "lightness": "47"
            },
            {
                "saturation": "-100"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#83adc2"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
            {
                "saturation": "53"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "lightness": "-42"
            },
            {
                "saturation": "17"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "lightness": "61"
            }
        ]
    }
];
  var styledMapOptions = { name: MY_MAPTYPE_ID };
  var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);
  ia_map.mapTypes.set(MY_MAPTYPE_ID, customMapType);
  var marker_cntr = 0;

  //create categories container
  var keys=$('#categories');
  keys.find('li').remove();


  //loop through categories
  for(var j=0;j<categories.length;j++) {
    var newCatLI=$(document.createElement('li'));
    var newCatSpan=$(document.createElement('span'));
    newCatSpan.append(categories[j].category_name);
    newCatSpan.addClass('category');
    var newCatUL=$(document.createElement('ul'));
    newCatUL.attr('id','cat'+j);
    newCatSpan.click(function(){

      //create empty LatLngBounds object
      var bounds = new google.maps.LatLngBounds();

      //close any open info windows
      closeInfowindows();

      //hide other markers
      clearOverlays();

      //remove active class from other li
      $(this).parent('li').siblings().removeClass('active');

      //add active class to the category's li
      $(this).parent('li').addClass('active');

      //loop through markers to display those from this category
      $(this).parent('li').children('ul').children('li').each(function() {
        var marker = $(this).attr('id').replace(/marker/,'');
        markersArray[marker].setVisible(true);
        markersArray[marker].setMap(ia_map);;

        //extend the bounds to include each marker's position
        bounds.extend(markersArray[marker].position);
      });

      //add property marker to bounds
      bounds.extend(propertyMarker.position);

      //show property marker
      propertyMarker.setVisible(true);
      propertyMarker.setMap(ia_map);

      //now fit the map to the newly inclusive bounds
      ia_map.fitBounds(bounds);
    });

    newCatLI.append(newCatSpan);
    newCatLI.append(newCatUL);
    //loop through category pois
    var pois=categories[j].pois;
    for(var k=0; k<pois.length;k++){

        //check if lat and lng are actual coordinates
        var coordinates = new google.maps.LatLng(pois[k].latitude,pois[k].longitude);
        if (typeof categories[j].category_map_marker != 'undefined') {
          var marker_icon=categories[j].category_map_marker;
        }
        if (typeof marker_icon != 'undefined'){
          var overlay_icon = {
            url: marker_icon.url,
            size: new google.maps.Size(marker_icon.width, marker_icon.height),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point((marker_icon.width / 2), (-93))
          };
          marker = new google.maps.Marker({
            position: coordinates,
            title: pois[k].name,
            visible:true,
            icon:overlay_icon
          });
        }else{
          marker = new google.maps.Marker({
            position: coordinates,
            title: pois[k].name,
            visible:true
          });
        }


        //extend the bounds to include each marker's position
        bounds.extend(marker.position);
        markersArray.push(marker);


      //create infowindow
      var address = pois[k].address+', '+pois[k].city+', '+pois[k].state+' '+pois[k].zip;
      var address2 = address.replace(/\s/g,'+');
      var map_url = 'http://maps.google.com/maps?q='+address2+'&hl=en&z=16';
      var map_link = '<a href="'+map_url+'" target="_blank">Directions</a>';
      if (address.split(',').length > 2){
        address=address.replace(', ','<br>');
      }
      var cur_info = '<div class="info-window"><strong>'+pois[k].name+'</strong><br>'+address+'<br>'+map_link+'</div>';
      var infowindow = new google.maps.InfoWindow({
        content: cur_info
      });
      infowindowsArray.push(infowindow);


      //add click event to display infowindow
      var cur_marker = marker_cntr;
      google.maps.event.addListener(markersArray[cur_marker], 'click', function(event) {
        var current_marker = this;
        var marker_key = false;
        for(l=0;l<markersArray.length;l++){
          if(markersArray[l].title == current_marker.title){
            var marker_key = l;
            break;
          }
        }
        closeInfowindows();
        if(marker_key !== false){
          infowindowsArray[marker_key].open(ia_map,current_marker);
        }
      });


      //create li to add to categories list
      var newLI = $(document.createElement('li'));
      newLI.attr('id','marker'+ marker_cntr);
      newLI.addClass('poi');

      newLI.on({
        click: function() {
          var id = $(this).attr('id');
          var marker_key = id.replace(/marker/,'');
          //marker key is getting set to 1 too high so we subtract 1 to get the correct number
          //current marker still needs the original number so we add the 1 back in
          marker_key = parseInt(marker_key);
          // console.log(marker_key);
          var current_marker = markersArray[marker_key];
          closeInfowindows();
          infowindowsArray[marker_key].open(ia_map,current_marker);
        }
      })

      newLI.append(pois[k].name);
      newCatUL.append(newLI);
      marker_cntr++;
    } // end poi for loop
    keys.append(newCatLI);
  } // end category for loop



  //add property marker
  if (typeof propertyObj !== 'undefined'){
    var coordinates = new google.maps.LatLng(propertyObj.latitude,propertyObj.longitude);
    if (typeof propertyObj.property_map_marker != 'undefined'){
      var property_icon=propertyObj.property_map_marker;
      var overlay_icon = {
        url: property_icon.url,
        size: new google.maps.Size(property_icon.width,property_icon.height),
        origin: new google.maps.Point(0,0),
        anchor: new google.maps.Point((property_icon.width/2),(property_icon.height/2))
      };
      marker = new google.maps.Marker({
        position: coordinates,
        title: propertyObj.property_name,
        visible:true,
        icon:overlay_icon
      });
    }else{
      marker = new google.maps.Marker({
        position: coordinates,
        title: propertyObj.property_name,
        visible:true
      });
    }


    //extend the bounds to include each marker's position
    bounds.extend(marker.position);
    markersArray.push(marker);


    //create infowindow
    var currentAddress=propertyObj.address+', '+propertyObj.city+', '+propertyObj.state+' '+propertyObj.zip;
    var map_link = '<a href="http://maps.google.com/?q='+currentAddress+'" target="_blank">Directions</a>';
    var description = '';
    if (typeof propertyObj.description != "undefined" && propertyObj.description != ''){
      description = '<br>' + propertyObj.description;
    }
    var cur_info = '<div class="info-window"><strong>'+propertyObj.property_name+'</strong><br>'+currentAddress.replace(',','<br />')+description+'<br>'+map_link+'</div>';
    var infowindow = new google.maps.InfoWindow({
      content: cur_info
    });
    infowindowsArray.push(infowindow);


    //add click event to display infowindow
    var cur_marker = marker_cntr;
    google.maps.event.addListener(markersArray[cur_marker], 'click', function(event) {
      var current_marker = this;
      var marker_key = false;
      for(l=0;l<markersArray.length;l++){
        if(markersArray[l].title == current_marker.title){
          var marker_key = l;
          break;
        }
      }
      closeInfowindows();
      if(marker_key !== false){
        infowindowsArray[marker_key].open(ia_map,current_marker);
      }
    });
    var propertyMarker=marker;
  }



  //now fit the map to the newly inclusive bounds
  ia_map.fitBounds(bounds);



  //if map just contains single POI, zoom out
  var listener = google.maps.event.addListener(ia_map, "idle", function() {
    if (ia_map.getZoom() > 14) ia_map.setZoom(14);
    google.maps.event.removeListener(listener);
  });

  //show markers
  showOverlays();
}

function init(){
  $.getJSON(templateURL + "/JSON/area.json", function(data) {
    categories=data.categories;
    propertyObj=data.property;  

    // console.log(data);  // This will display the data in the .json file.  Uncomment to check for troubleshooting help.
    initialize_map();
  });
}

$(window).load(function(){
  init();
});