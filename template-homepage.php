<?php
/**
 * Template Name: Homepage Widget
 * Description: Front Page Template
 */

get_header() ?>

<div class="widgetized-sections">
	<?php dynamic_sidebar('sidebar-homepage'); ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
