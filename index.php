<html>
	<head>
		<title>Maps Test</title>
		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/map.js"></script>

		<?php wp_head(); ?>
	</head>
 
	<body onload="initialize()">

		<?php if ( have_posts() ) : ?>
			<!-- WordPress has found matching posts -->
			<div style="display: none;">
				<?php $i = 1; ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php if ( get_post_meta($post->ID, 'latlng', true) !== '' ) : ?>
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
						<?php if ( get_post_meta($post->ID, 'latlng', true) !== '' ) : ?>
							{
								latlng : new google.maps.LatLng<?php echo get_post_meta($post->ID, 'latlng', true); ?>, 
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