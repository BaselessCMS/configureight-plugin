<?php
/**
 * Color Scheme Reference page
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @category   Guide page
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Plugin\{
	plugin,
	site,
	lang
};
use function CFE_Colors\{
	color_schemes,
	get_color_scheme,
	default_color_scheme,
	current_color_scheme,
	color_scheme_category,
	hex_to_rgb
};

$schemes = color_schemes();
$current = current_color_scheme();

// Guide page URL.
$guide_page = DOMAIN_ADMIN . 'plugin/' . plugin()->className();

// Settings page URL.
$settings_page = DOMAIN_ADMIN . 'configure-plugin/' . plugin()->className();

?>

<style>
.color-heading {
	font-size: 1.5rem;
}
h4.form-heading {
	margin-bottom: 0;
}
.form-rule {
	margin-top: 2rem;
}
.scheme-details {
	margin-top: 1.5rem;
}
.scheme-detail {
	margin: 0;
}
pre {
	user-select: all;
	cursor: pointer;
	max-width: 720px;
	margin: 1rem 0;
	white-space: pre-wrap;
}
code.select {
	cursor: pointer;
}
</style>

<h1 class="page-title"><span class="page-title-icon fa fa-eyedropper"></span><span class="page-title-text"><?php lang()->p( 'Colors Reference' ); ?></span></h1>

<p class="page-description"><?php lang()->p( "Go to the <a href='{$guide_page}'>options guide</a> index page. Edit appearance on the <a href='{$settings_page}#style'>website options</a> page." ); ?></p>

<div class="tab-content" data-toggle="tabslet" data-deeplinking="true" data-animation="true">

	<ul class="nav nav-tabs" id="nav-tabs" role="tablist">
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="intro" aria-selected="false" href="#intro"><?php lang()->p( 'Intro' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="schemes" aria-selected="false" href="#schemes"><?php lang()->p( 'Schemes' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="palettes" aria-selected="false" href="#palettes"><?php lang()->p( 'Palettes' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="styles" aria-selected="false" href="#styles"><?php lang()->p( 'CSS' ); ?></a>
		</li>
	</ul>

	<div id="intro" class="tab-pane" role="tabpanel" aria-labelledby="intro">
		<?php include( plugin()->phpPath() . '/views/colors-intro.php' ); ?>
	</div>

	<div id="schemes" class="tab-pane" role="tabpanel" aria-labelledby="schemes">
		<?php include( plugin()->phpPath() . '/views/colors-schemes.php' ); ?>
	</div>

	<div id="palettes" class="tab-pane" role="tabpanel" aria-labelledby="palettes">
		<?php include( plugin()->phpPath() . '/views/colors-palettes.php' ); ?>
	</div>

	<div id="styles" class="tab-pane" role="tabpanel" aria-labelledby="styles">
		<?php include( plugin()->phpPath() . '/views/colors-styles.php' ); ?>
	</div>
</div>

<script>

// jQuery tooltips.
jQuery(document).ready( function($) {
	$( '.form-tooltip' ).tooltipster({
		distance : 5,
		delay : 0,
		animationDuration : 150,
		theme : 'cfe-tooltips'
	});
	$( '.color-tooltip' ).tooltipster({
		distance : 5,
		delay : 150,
		delayTouch: 0,
		animationDuration : 150,
		theme : 'cfe-tooltips',
		interactive : true,
		trigger : 'custom',
		triggerOpen: {
			hover : false,
			mouseenter : false,
			click : true,
			touchstart : true
		},
		triggerClose: {
			mouseleave : true,
			scroll : true,
			touchleave : false
		}
	});
});
</script>
