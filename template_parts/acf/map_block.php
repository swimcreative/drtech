
        <?php the_sub_field('map_block_description');

        // settings
        $locations = get_sub_field('map_block_locations');
        $display   = get_sub_field('map_block_display');

        $html = '';

        // The Loop
        if( $locations ):
          $html .= '<div class="acf-map">';

          $row = 1;
        	foreach( $locations as $location ):

            $address = $location['location_address'];
            $link = $location['location_link'];


            $html .= '<div class="marker" data-lat="' . $address['lat'] . '" data-lng="' . $address['lng'] . '">';
            $html .= '<div class="infopad">';
      			$html .= '<h4 class="location-title">' . $location['location_title'] . '</h4>';
            $html .= '<div class="location-description">';
            $html .= $location['location_description'];
      			$html .= '<p class="location-address">' . $address['address'] . '</p>';
      			$html .= ( is_array( $link ) ? '<a class="btn" href="' . $link['url'] . '" target="' . $link['target'] . '">' . $link['title'] . '</a>' : '' );
            $html .= '</div>';
            $html .= '</div>';
      			$html .= '</div>';//marker


            $row++;
        	endforeach;

          $html .= '</div>';// ..map-block..

        else :
        	//$html = 'No posts found.';
        endif;

        echo $html;

        ?>



  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2JXGb9Yd04ByPErUXKcmUOosRnPMStFo"></script>
  <script type="text/javascript">
  (function($) {

  /*
  *  new_map
  *
  *  This function will render a Google Map onto the selected jQuery element
  *
  *  @type	function
  *  @date	8/11/2013
  *  @since	4.3.0
  *
  *  @param	$el (jQuery element)
  *  @return	n/a
  */

  function new_map( $el ) {

  	// var
  	var $markers = $el.find('.marker');


  	// vars
  	var args = {
  		zoom		: 16,
  		center		: new google.maps.LatLng(0, 0),
  		mapTypeId	: google.maps.MapTypeId.ROADMAP
  	};


  	// create map
  	var map = new google.maps.Map( $el[0], args);


  	// add a markers reference
  	map.markers = [];


  	// add markers
  	$markers.each(function(){

      	add_marker( $(this), map );

  	});


  	// center map
  	center_map( map );


  	// return
  	return map;

  }

  /*
  *  add_marker
  *
  *  This function will add a marker to the selected Google Map
  *
  *  @type	function
  *  @date	8/11/2013
  *  @since	4.3.0
  *
  *  @param	$marker (jQuery element)
  *  @param	map (Google Map object)
  *  @return	n/a
  */

  function add_marker( $marker, map ) {

  	// var
  	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

  	// create marker
  	var marker = new google.maps.Marker({
  		position	: latlng,
  		map			: map,
      //icon: '/wp-content/themes/drtech/assets/img/drtech-marker.png'
  	});

  	// add to array
  	map.markers.push( marker );

  	// if marker contains HTML, add it to an infoWindow
  	if( $marker.html() )
  	{
  		// create info window
  		var infowindow = new google.maps.InfoWindow({
  			content		: $marker.html()
  		});

  		// show info window when marker is clicked
  		google.maps.event.addListener(marker, 'click', function() {

  			infowindow.open( map, marker );

  		});
  	}

  }

  /*
  *  center_map
  *
  *  This function will center the map, showing all markers attached to this map
  *
  *  @type	function
  *  @date	8/11/2013
  *  @since	4.3.0
  *
  *  @param	map (Google Map object)
  *  @return	n/a
  */

  function center_map( map ) {

  	// vars
  	var bounds = new google.maps.LatLngBounds();

  	// loop through all markers and create bounds
  	$.each( map.markers, function( i, marker ){

  		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

  		bounds.extend( latlng );

  	});

  	// only 1 marker?
  	if( map.markers.length == 1 )
  	{
  		// set center of map
  	    map.setCenter( bounds.getCenter() );
  	    map.setZoom( 16 );
  	}
  	else
  	{
  		// fit to bounds
  		map.fitBounds( bounds );
  	}

  }

  /*
  *  document ready
  *
  *  This function will render each map when the document is ready (page has loaded)
  *
  *  @type	function
  *  @date	8/11/2013
  *  @since	5.0.0
  *
  *  @param	n/a
  *  @return	n/a
  */
  // global var
  var map = null;

  $(document).ready(function(){

  	$('.acf-map').each(function(){

  		// create map
  		map = new_map( $(this) );


    });
});//doc ready

  })(jQuery);
  </script>
