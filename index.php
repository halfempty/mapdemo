<html>
	<head>
		<title>Maps Test</title>
		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript">
		
		var infowindow = new google.maps.InfoWindow();
		var pinkmarker = new google.maps.MarkerImage('/wp-content/themes/mapdemo/pink_Marker.png', new google.maps.Size(20, 34) );
		var shadow = new google.maps.MarkerImage('/wp-content/themes/mapdemo/shadow.png', new google.maps.Size(37, 34) );

		function initialize() {

			<?php

			$the_query = new WP_Query('showposts=1');

			while ( $the_query->have_posts() ) : $the_query->the_post();
				$coordinates = get_geocode_latlng($post->ID);
			endwhile;

			?>


			map = new google.maps.Map(document.getElementById('map'), { 
				zoom: 12, 
				center: new google.maps.LatLng<?php echo $coordinates ?>,
				mapTypeId: google.maps.MapTypeId.ROADMAP 
			});

			for (var i = 0; i < locations.length; i++) {  
				var marker = new google.maps.Marker({
			    	position: locations[i].latlng,
					icon: pinkmarker,
					shadow: shadow,
					map: map
				});
				google.maps.event.addListener(marker, 'click', (function(marker, i) {
				  return function() {
				    infowindow.setContent(locations[i].info);
				    infowindow.open(map, marker);
				  }
				})(marker, i));
			}

		}
		
		</script>




		<?php wp_head(); ?>
	</head>
 
	<body onload="initialize()">

		<?php if ( have_posts() ) : ?>
			<!-- WordPress has found matching posts -->
			<div style="display: none;">
				<?php $i = 1; ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php if ( get_geocode_latlng($post->ID) !== '' ) : ?>
						<div id="item<?php echo $i; ?>">
							<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
							<?php the_content(); ?>
						</div>
					<?php endif; ?>
					<?php $i++;	?>
				<?php endwhile; ?>
			</div>
			<script type="text/javascript">
				var locations = [
					<?php  $i = 1; while ( have_posts() ) : the_post(); ?>
						<?php if ( get_geocode_latlng($post->ID) !== '' ) : ?>
							{
								latlng : new google.maps.LatLng<?php echo get_geocode_latlng($post->ID); ?>, 
								info : document.getElementById('item<?php echo $i; ?>')
						},
						<?php endif; ?>
					<?php $i++; endwhile; ?>
				];
			</script>
			<div id="map" style="width: 100%; height: 100%;"></div>

		<?php else : ?>
			<!-- No matching posts, show an error -->
			<h1>Error 404 &mdash; Page not found.</h1>
		<?php endif; ?>

		<?php wp_footer(); ?>
	</body>
</html>