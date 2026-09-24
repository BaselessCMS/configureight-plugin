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
	custom_schemes,
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
	margin: 1rem 0 0 0 !important;
	font-size: var( --cfe-admin--color-heading--font-size, 1.625rem );
}
.color-list-heading {
	margin: 1rem 0 0 0 !important;
	font-size: var( --cfe-admin--color-list-heading--font-size, 1.25rem );
}
.color-list {
	list-style: var( --cfe-admin--color-list--list-style, none );
	margin: 1rem 0 0 0 !important;
	padding: 0 !important;
}
.color-list li {
	line-height: var( --cfe-admin--color-list--item--line-height, 1.3 );
}
.color-list-label {
	font-weight: var( --cfe-admin--color-list-value--font-weight, 600 );
}
.color-list-preview {
	display: inline-block;
	vertical-align: middle;
	width: 6rem;
	height: 1em;
	border: var( --cfe-form-element--border );
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
			<a class="nav-link" role="tab" aria-controls="schemes" aria-selected="false" href="#schemes"><?php lang()->p( 'Schemes' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="properties" aria-selected="false" href="#properties"><?php lang()->p( 'Properties' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="classes" aria-selected="false" href="#classes"><?php lang()->p( 'Classes' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="slugs" aria-selected="false" href="#slugs"><?php lang()->p( 'Slugs' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="details" aria-selected="false" href="#details"><?php lang()->p( 'Details' ); ?></a>
		</li>
	</ul>

	<div id="schemes" class="tab-pane" role="tabpanel" aria-labelledby="schemes">
		<?php include( plugin()->phpPath() . '/views/colors-schemes.php' ); ?>
	</div>

	<div id="properties" class="tab-pane" role="tabpanel" aria-labelledby="properties">
		<?php include( plugin()->phpPath() . '/views/colors-properties.php' ); ?>
	</div>

	<div id="classes" class="tab-pane" role="tabpanel" aria-labelledby="classes">
		<?php include( plugin()->phpPath() . '/views/colors-classes.php' ); ?>
	</div>

	<div id="slugs" class="tab-pane" role="tabpanel" aria-labelledby="slugs">
		<?php include( plugin()->phpPath() . '/views/colors-slugs.php' ); ?>
	</div>

	<div id="details" class="tab-pane" role="tabpanel" aria-labelledby="details">
		<?php include( plugin()->phpPath() . '/views/colors-details.php' ); ?>
	</div>
</div>

<script>

// jQuery tooltips.
jQuery(document).ready( function($) {
	$( '.form-tooltip' ).tooltipster({
		distance : 5,
		delay : 150,
		animationDuration : 150,
		theme : 'cfe-tooltips'
	});
});
</script>
