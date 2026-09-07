<?php
/**
 * Configure 8 Options page
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Plugin\{
	plugin,
	lang
};
use function CFE_Colors\{
	picker_colors_light,
	picker_colors_dark,
	picker_colors_merged
};

// Guide page URL.
$guide_page = DOMAIN_ADMIN . 'plugin/' . plugin()->className();

// Database page URL.
$database_page = DOMAIN_ADMIN . 'plugin/' . plugin()->className() . '?page=database';

?>

<p class="page-description"><?php lang()->p( "Get help on the <a href='{$guide_page}'>options guide</a> index page." ); ?></p>

<div class="tab-content hide-if-no-js" data-toggle="tabslet" data-deeplinking="true" data-animation="true">

	<ul class="nav nav-tabs" id="nav-tabs" role="tablist">
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="general" aria-selected="false" href="#general"><?php lang()->p( 'General' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="header" aria-selected="false" href="#header"><?php lang()->p( 'Header' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="nav" aria-selected="false" href="#nav"><?php lang()->p( 'Menu' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="media" aria-selected="false" href="#media"><?php lang()->p( 'Media' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="loop" aria-selected="false" href="#loop"><?php lang()->p( 'Loops' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="page" aria-selected="false" href="#page"><?php lang()->p( 'Pages' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="sidebar" aria-selected="false" href="#sidebar"><?php lang()->p( 'Sidebar' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="footer" aria-selected="false" href="#footer"><?php lang()->p( 'Footer' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="style" aria-selected="false" href="#style"><?php lang()->p( 'Styles' ); ?></a>
		</li>
	</ul>

	<div id="general" class="tab-pane" role="tabpanel" aria-labelledby="general">
		<?php include( plugin()->phpPath() . '/views/fields-general.php' ); ?>
	</div>
	<div id="header" class="tab-pane" role="tabpanel" aria-labelledby="header">
		<?php include( plugin()->phpPath() . '/views/fields-header.php' ); ?>
	</div>
	<div id="nav" class="tab-pane" role="tabpanel" aria-labelledby="nav">
		<?php include( plugin()->phpPath() . '/views/fields-navigation.php' ); ?>
	</div>
	<div id="media" class="tab-pane" role="tabpanel" aria-labelledby="media">
		<?php include( plugin()->phpPath() . '/views/fields-media.php' ); ?>
	</div>
	<div id="loop" class="tab-pane" role="tabpanel" aria-labelledby="loop">
		<?php include( plugin()->phpPath() . '/views/fields-loop.php' ); ?>
	</div>
	<div id="page" class="tab-pane" role="tabpanel" aria-labelledby="page">
		<?php include( plugin()->phpPath() . '/views/fields-page.php' ); ?>
	</div>
	<div id="sidebar" class="tab-pane" role="tabpanel" aria-labelledby="sidebar">
		<?php include( plugin()->phpPath() . '/views/fields-sidebar.php' ); ?>
	</div>
	<div id="footer" class="tab-pane" role="tabpanel" aria-labelledby="footer">
		<?php include( plugin()->phpPath() . '/views/fields-footer.php' ); ?>
	</div>
	<div id="style" class="tab-pane" role="tabpanel" aria-labelledby="style">
		<?php include( plugin()->phpPath() . '/views/fields-style.php' ); ?>
	</div>
</div>
<?php if ( 'default' != plugin()->admin_theme() ) : ?>
<div class="hide-if-js no-js-message" style="padding-top: 2rem;">
	<h3><?php lang()->p( 'Action Required!' ); ?></h3>
	<p><?php lang()->p( 'Please enable JavaScript to display the options form.' ); ?></p>
</div>
<?php endif; ?>

<script>
jQuery(document).ready( function($) {

	// Tooltips.
	$( '.form-tooltip' ).tooltipster({
		distance : 5,
		delay : 150,
		animationDuration : 150,
		theme : 'cfe-tooltips'
	});
	$( '.image-in-album' ).tooltipster({
		distance : 5,
		delay : 150,
		animationDuration : 150,
		theme : 'cfe-tooltips'
	});

	// General color picker.
	$( '.custom-color' ).spectrum({
		type            : "component",
		showAlpha       : false,
		showPalette     : true,
		palette         : [
			['<?php echo implode( "', '", picker_colors_merged() ); ?>']
		],
		preferredFormat : "hex",
		showInitial     : true,
		allowEmpty      : false,
		showSelectionPalette : true,
	});
	$( '.custom-color' ).show();

	// Selected class for image uploads.
	$( '.bookmark-select-label' ).click( function() {
		$( '.bookmark-select-label' ).removeClass( 'selected' );
		$(this).addClass( 'selected' );
	});
	$( '.logo-standard-select-label' ).click( function() {
		$( '.logo-standard-select-label' ).removeClass( 'selected' );
		$(this).addClass( 'selected' );
	});
	$( '.logo-cover-select-label' ).click( function() {
		$( '.logo-cover-select-label' ).removeClass( 'selected' );
		$(this).addClass( 'selected' );
	});
	$( '.cover-select-label' ).click( function() {
		$(this).toggleClass( 'selected' );
	});
});
</script>
