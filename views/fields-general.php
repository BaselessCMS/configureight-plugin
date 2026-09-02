<?php
/**
 * General options fields
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
	color_schemes
};

// User toolbar option.
$show_toolbar = true;
if (
	'frontend' == plugin()->user_toolbar() ||
	'disabled' == plugin()->user_toolbar()
) {
	$show_toolbar = false;
}

// Color schemes.
$colors = color_schemes();
$custom_from = plugin()->custom_scheme_from();

?>

<h2 class="form-heading"><?php lang()->p( 'General Options' ); ?></h2>

<fieldset>

	<legend class="screen-reader-text"><?php lang()->p( 'General' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="keep_uploads"><?php lang()->p( ' Image Uploads' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="keep_uploads" name="keep_uploads">
				<option value="true" <?php echo ( plugin()->keep_uploads() === true ? 'selected' : '' ); ?>><?php lang()->p( 'Save Uploads' ); ?></option>
				<option value="false" <?php echo ( plugin()->keep_uploads() === false ? 'selected' : '' ); ?> <?php echo ( $show_toolbar ? '' : 'disabled' ); ?>><?php lang()->p( 'Delete Uploads' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Choose whether to save or delete this plugin\'s upload directory when deactivating.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="site_favicon"><?php lang()->p( 'Site Icon' ); ?></label>
		<div class="col-sm-10">
			<p><?php lang()->p( 'The bookmark image that appears in browser tabs and that is used when saving a page to a mobile screen.' ); ?></p>

			<div id="bookmark-tabs" class="tab-content" data-toggle="tabslet" data-deeplinking="false" data-animation="true">

				<ul class="nav nav-tabs" id="bookmark-nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link" role="tab" aria-controls="bookmark-select" aria-selected="false" href="#bookmark-select"><?php lang()->p( 'Select' ); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" role="tab" aria-controls="bookmark-upload" aria-selected="false" href="#bookmark-upload"><?php lang()->p( 'Upload' ); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" role="tab" aria-controls="bookmark-album" aria-selected="false" href="#bookmark-album"><?php lang()->p( 'Album' ); ?></a>
					</li>
				</ul>
				<div id="bookmark-select" role="tabpanel" aria-labelledby="bookmark-select">
					<p><?php lang()->p( 'Select one from uploaded bookmark images.' ); ?></p>
					<?php echo $bookmarks->select_images( $bookmark ); ?>
				</div>

				<div id="bookmark-upload" class="tab-pane tab-pane-image-upload" role="tabpanel" aria-labelledby="bookmark-upload">

					<p><?php lang()->p( 'Drag & drop images or click to browse. Allowed file types: .gif, .png, .ico' ); ?></p>

					<div class="dropzone" id="bookmark-upload"></div>

					<div id="bookmark-upload-notice" style="display: none;">
						<p><?php lang()->p( '<strong>Note:</strong> this page needs to be refreshed before new images can be managed or selected as a bookmark image.' ); ?></p>
						<p><button class="button button-small btn btn-sm btn-primary" onClick="location.reload();"><?php lang()->p( 'Refresh' ); ?></button></p>
					</div>
				</div>

				<div id="bookmark-album" class="tab-pane tab-pane-image-upload" role="tabpanel" aria-labelledby="bookmark-album">
					<p><?php lang()->p( 'Manage uploaded bookmark images.' ); ?></p>
					<div id="bookmark-album-wrap"><?php echo $bookmarks->manage_images( $bookmark ); ?></div>
				</div>
			</div>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="user_toolbar"><?php lang()->p( 'User Toolbar' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="user_toolbar" name="user_toolbar">
				<option value="enabled" <?php echo ( plugin()->getValue( 'user_toolbar' ) === 'enabled' ? 'selected' : '' ); ?>><?php lang()->p( 'Enabled' ); ?></option>

				<option value="backend" <?php echo ( plugin()->getValue( 'user_toolbar' ) === 'backend' ? 'selected' : '' ); ?>><?php lang()->p( 'Backend Only' ); ?></option>

				<option value="frontend" <?php echo ( plugin()->getValue( 'user_toolbar' ) === 'frontend' ? 'selected' : '' ); ?>><?php lang()->p( 'Frontend Only' ); ?></option>

				<option value="disabled" <?php echo ( plugin()->getValue( 'user_toolbar' ) === 'disabled' ? 'selected' : '' ); ?>><?php lang()->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Displayed only to logged-in users.' ); ?></small>
		</div>
	</div>

	<div id="toolbar_mobile_wrap" class="form-field form-group row" style="display: <?php echo ( plugin()->getValue( 'user_toolbar' ) != 'disabled' ? 'flex' : 'none' ); ?>;">
		<label class="form-label col-sm-2 col-form-label" for="toolbar_mobile"><?php lang()->p( 'Mobile Toolbar' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="toolbar_mobile" name="toolbar_mobile">
				<option value="true" <?php echo ( plugin()->getValue( 'toolbar_mobile' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'toolbar_mobile' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Allow the toolbar on mobile screens.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="admin_menu"><?php lang()->p( ' Admin Menu' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="admin_menu" name="admin_menu">
				<option value="true" <?php echo ( plugin()->admin_menu() === true ? 'selected' : '' ); ?>><?php lang()->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( plugin()->admin_menu() === false ? 'selected' : '' ); ?> <?php echo ( $show_toolbar ? '' : 'disabled' ); ?>><?php lang()->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Menu can only be disabled if the user toolbar is enabled on the back end.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="to_top_button"><?php lang()->p( 'To Top Button' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="to_top_button" name="to_top_button">
				<option value="enabled" <?php echo ( plugin()->getValue( 'to_top_button' ) === 'enabled' ? 'selected' : '' ); ?>><?php lang()->p( 'Enabled' ); ?></option>

				<option value="backend" <?php echo ( plugin()->getValue( 'to_top_button' ) === 'backend' ? 'selected' : '' ); ?>><?php lang()->p( 'Backend Only' ); ?></option>

				<option value="frontend" <?php echo ( plugin()->getValue( 'to_top_button' ) === 'frontend' ? 'selected' : '' ); ?>><?php lang()->p( 'Frontend Only' ); ?></option>

				<option value="disabled" <?php echo ( plugin()->getValue( 'to_top_button' ) === 'disabled' ? 'selected' : '' ); ?>><?php lang()->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Display a button to scroll to the top of the page.' ); ?></small>
		</div>
	</div>

	<?php if ( getPlugin( 'Search_Forms' ) ) : ?>
	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="search_icon"><?php lang()->p( 'Search Icon' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="search_icon" name="search_icon">
				<option value="true" <?php echo ( plugin()->getValue( 'search_icon' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'search_icon' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Replace search form submit text with a search icon. Text will remain available to screen readers.' ); ?></small>
		</div>
	</div>
	<?php endif; ?>

	<?php if ( BLUDIT_VERSION <= '3.17.2' ) : ?>
	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="show_customize"><?php lang()->p( 'Dashboard Customize' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="show_customize" name="show_customize">
				<option value="true" <?php echo ( plugin()->getValue( 'show_customize' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'show_customize' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Links to help guides and options on the dashboard.' ); ?></small>
		</div>
	</div>
	<?php endif; ?>
</fieldset>

<h3 class="form-heading"><?php lang()->p( 'Loading Screen' ); ?></h3>

<fieldset>

	<legend class="screen-reader-text"><?php lang()->p( 'Loader' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="page_loader"><?php lang()->p( 'Loading Screen' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="page_loader" name="page_loader" <?php echo ( plugin()->debug_mode() ? 'disabled' : '' ); ?>>
				<option value="false" <?php echo ( plugin()->page_loader() === false ? 'selected' : '' ); ?>><?php lang()->p( 'Disabled' ); ?></option>
				<option value="true" <?php echo ( plugin()->page_loader() === true ? 'selected' : '' ); ?>><?php lang()->p( 'Enabled' ); ?></option>
			</select>
			<?php if ( plugin()->debug_mode() ) : ?>
			<small class="form-text text-danger"><?php lang()->p( 'Option disabled while site is in debug mode.' ); ?></small>
			<?php else : ?>
			<small class="form-text"><?php lang()->p( 'A full-screen display that hides the web page until it is fully loaded. Disabled when site is in debug mode.' ); ?></small>
			<?php endif; ?>
		</div>
	</div>

	<div id="loader_options" style="display: <?php echo ( plugin()->getValue( 'page_loader' ) === true ? 'block' : 'none' ); ?>;">
		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="loader_text"><?php lang()->p( 'Loading Text' ); ?></label>
			<div class="col-sm-10">
				<input type="text" id="loader_text" name="loader_text" value="<?php echo plugin()->getValue( 'loader_text' ); ?>" placeholder="<?php echo plugin()->dbFields['loader_text']; ?>" />
				<small class="form-text"><?php lang()->p( 'The text to display on the loading screen.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="loader_icon"><?php lang()->p( 'Loading Icon' ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="loader_icon" name="loader_icon">

					<option value="spinner-dots" <?php echo ( plugin()->getValue( 'loader_icon' ) === 'spinner-dots' ? 'selected' : '' ); ?>><?php lang()->p( 'Dots Circle' ); ?></option>

					<option value="spinner-dashes" <?php echo ( plugin()->getValue( 'loader_icon' ) === 'spinner-dashes' ? 'selected' : '' ); ?>><?php lang()->p( 'Dashes Circle' ); ?></option>

					<option value="spinner-third" <?php echo ( plugin()->getValue( 'loader_icon' ) === 'spinner-third' ? 'selected' : '' ); ?>><?php lang()->p( 'Third Circle' ); ?></option>

					<option value="none" <?php echo ( plugin()->getValue( 'loader_icon' ) === 'none' ? 'selected' : '' ); ?>><?php lang()->p( 'No Icon' ); ?></option>
				</select>
				<small class="form-text">
					<?php lang()->p( 'Choose the style of icon to display below the text.' ); ?>
				</small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="loader-background-colors"><?php lang()->p( 'Background' ); ?></label>
			<div id="loader-background-colors" class="col-sm-10">

				<p><?php lang()->p( 'Light Mode Background' ); ?></p>
				<div class="row color-picker-wrap">
					<input class="color-picker custom-color" id="loader_bg_color" name="loader_bg_color" value="<?php echo plugin()->loader_bg_color(); ?>" />
					<input id="loader_bg_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['light']['body']; ?>" />
					<span class="btn btn-secondary btn-md hide-if-no-js" id="loader_bg_color_default"><?php lang()->p( 'Reset' ); ?></span>
				</div>
				<small class="form-text"><?php lang()->p( 'For devices with automatic or light user preference.' ); ?></small>

				<p><?php lang()->p( 'Dark Mode Background' ); ?></p>
				<div class="row color-picker-wrap">
					<input class="color-picker custom-color" id="loader_bg_color_dark" name="loader_bg_color_dark" value="<?php echo plugin()->loader_bg_color_dark(); ?>" />
					<input id="loader_bg_default_dark" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['dark']['body']; ?>" />
					<span class="btn btn-secondary btn-md hide-if-no-js" id="loader_bg_color_default_dark"><?php lang()->p( 'Reset' ); ?></span>
				</div>
				<small class="form-text"><?php lang()->p( 'For devices with a dark user preference.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="loader-text-colors"><?php lang()->p( 'Text Color' ); ?></label>
			<div id="loader-text-colors" class="col-sm-10">

				<p><?php lang()->p( 'Light Mode Text Color' ); ?></p>
				<div class="row color-picker-wrap">
					<input class="color-picker custom-color" id="loader_text_color" name="loader_text_color" value="<?php echo plugin()->loader_text_color(); ?>" />
					<input id="loader_text_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['light']['text']; ?>" />
					<span class="btn btn-secondary btn-md hide-if-no-js" id="loader_text_color_default"><?php lang()->p( 'Reset' ); ?></span>
				</div>
				<small class="form-text"><?php lang()->p( 'For devices with automatic or light user preference.' ); ?></small>

				<p><?php lang()->p( 'Dark Mode Text Color' ); ?></p>
				<div class="row color-picker-wrap">
					<input class="color-picker custom-color" id="loader_text_color_dark" name="loader_text_color_dark" value="<?php echo plugin()->loader_text_color_dark(); ?>" />
					<input id="loader_text_default_dark" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['dark']['text']; ?>" />
					<span class="btn btn-secondary btn-md hide-if-no-js" id="loader_text_color_default_dark"><?php lang()->p( 'Reset' ); ?></span>
				</div>
				<small class="form-text"><?php lang()->p( 'For devices with a dark user preference.' ); ?></small>
			</div>
		</div>
	</div>
</fieldset>

<script>
$( function() {
	$( '.delete-bookmark' ).bind( 'click', function() {
		if ( ! confirm( '<?php lang()->p( 'Are you sure you want to delete this image?' ); ?>' ) ) { return; }
		deleteBookmark(this);
	});
});

function deleteBookmark(el) {
	$.post( bookmark.config.ajaxUrl, {
		tokenCSRF : $( '#jstokenCSRF' ).val(),
		action    : 'deleteImage',
		album     : $(el).data( 'album' ),
		file      : $(el).data( 'file' )
	},
	function() {
		let manage = '#bookmark-image-' + $(el).data( 'number' );
		let select = '#bookmark-select-item-' + $(el).data( 'number' );
		let input  = '#bookmark-select-item-' + $(el).data( 'number' ) + ' input';
		$( manage ).fadeOut( 450 );
		$( select ).hide();
		$( input ).removeAttr( 'checked' );

	}).fail( function() {
		$.alert({
			title   : bookmark.L.error,
			content : bookmark.L.deleteImageError
		});
	});
}
</script>
