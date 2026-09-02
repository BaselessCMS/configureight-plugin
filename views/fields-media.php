<?php
/**
 * Media options fields
 *
 * @package    Configure 8 Options
 * @subpackage Views
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
	current_cover_color,
	hex_to_rgb
};

?>

<h2 class="form-heading"><?php lang()->p( 'Media Options' ); ?></h2>

<fieldset>
	<legend class="screen-reader-text"><?php lang()->p( 'Media Options' ); ?></legend>

	<p><?php lang()->p( 'Image width and height options are for images inserted into post & page content. This does not affect the original upload size. The quality option is for all image uploads.' ); ?></p>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="thumb_width"><?php lang()->p( 'Image Width' ); ?></label>
		<div class="col-sm-10">
			<div class="field-has-buttons">
				<input type="text" id="thumb_width" name="thumb_width" value="<?php echo plugin()->thumb_width(); ?>" placeholder="0" />
				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#thumb_width').val('<?php echo plugin()->dbFields['thumb_width']; ?>');"><?php lang()->p( 'Default' ); ?></span>
			</div>
			<small class="form-text"><?php lang()->p( 'Image width in pixels (px).' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="thumb_height"><?php lang()->p( 'Image Height' ); ?></label>
		<div class="col-sm-10">
			<div class="field-has-buttons">
				<input type="text" id="thumb_height" name="thumb_height" value="<?php echo plugin()->thumb_height(); ?>" placeholder="0" />
				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#thumb_height').val('<?php echo plugin()->dbFields['thumb_height']; ?>');"><?php lang()->p( 'Default' ); ?></span>
			</div>
			<small class="form-text"><?php lang()->p( 'Image height in pixels (px).' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="img_upload_quality"><?php lang()->p( 'Image Quality' ); ?></label>
		<div class="col-sm-10">
			<div class="field-has-buttons">
				<input type="text" id="img_upload_quality" name="img_upload_quality" value="<?php echo plugin()->img_upload_quality(); ?>" placeholder="0" />
				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#img_upload_quality').val('<?php echo plugin()->dbFields['img_upload_quality']; ?>');"><?php lang()->p( 'Default' ); ?></span>
			</div>
			<small class="form-text"><?php lang()->p( 'Image quality in percentage (%).' ); ?></small>
		</div>
	</div>

	<hr />

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="modal_bg_color"><?php lang()->p( 'Modal Background' ); ?></label>
		<div class="col-sm-10">
			<div class="row color-picker-wrap">
				<input class="color-picker" id="modal_bg_color" name="modal_bg_color" value="<?php echo plugin()->modal_bg_color(); ?>" />
				<input id="modal_bg_default" class="screen-reader-text" type="hidden" value="<?php echo plugin()->dbFields['modal_bg_color']; ?>" />
				<span class="btn btn-secondary btn-md hide-if-no-js" id="modal_bg_color_default"><?php lang()->p( 'Default' ); ?></span>
			</div>
			<small class="form-text"><?php lang()->p( 'Background color for modal (pop-up) windows.' ); ?></small>
		</div>
	</div>
</fieldset>

<h3 class="form-heading"><?php lang()->p( 'Cover Images' ); ?></h3>

<fieldset>

	<legend class="screen-reader-text"><?php lang()->p( 'Cover Images' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for=""><?php lang()->p( 'Default Covers' ); ?></label>

		<div class="col-sm-10 cover-form">

			<p><?php lang()->p( 'Images used on loop pages and used when a page has no cover image set and is not using random covers from page images.' ); ?></p>

			<div id="cover-tabs" class="tab-content" data-toggle="tabslet" data-deeplinking="false" data-animation="true">

				<ul class="nav nav-tabs" id="cover-nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link" role="tab" aria-controls="cover-select" aria-selected="false" href="#cover-select"><?php lang()->p( 'Select' ); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" role="tab" aria-controls="cover-upload" aria-selected="false" href="#cover-upload"><?php lang()->p( 'Upload' ); ?></a>
					</li>
					<li class="nav-item">
						<a id="cover-album-tab" class="nav-link" role="tab" aria-controls="cover-album" aria-selected="false" href="#cover-album"><?php lang()->p( 'Album' ); ?><span id="cover-images-count"><span><?php echo ' (' . $covers->count_images() . ')'; ?></span></span></a>
					</li>
				</ul>

				<div id="cover-select" role="tabpanel" aria-labelledby="cover-select">
					<p><?php lang()->p( 'Select from uploaded cover images.' ); ?></p>
					<?php echo $covers->select_images( $cover ); ?>
				</div>

				<div id="cover-upload" class="tab-pane tab-pane-image-upload" role="tabpanel" aria-labelledby="cover-upload">

					<p><?php lang()->p( 'Drag & drop images or click to browse. Allowed file types: .jpg, .jpeg, .png' ); ?></p>

					<div class="dropzone" id="cover-upload"></div>

					<div id="cover-upload-notice" style="display: none;">
						<p><?php lang()->p( '<strong>Note:</strong> this page needs to be refreshed before new images can be managed or selected as cover images.' ); ?></p>
						<p><button class="button button-small btn btn-sm btn-primary" onClick="location.reload();"><?php lang()->p( 'Refresh' ); ?></button></p>
					</div>
				</div>

				<div id="cover-album" class="tab-pane tab-pane-image-upload" role="tabpanel" aria-labelledby="cover-album">
					<div>
						<p><?php lang()->p( 'Manage uploaded cover images.' ); ?></p>
						<div id="cover-album-wrap"><?php echo $covers->manage_images( $cover ); ?></div>
					</div>
					<div id="cover-album-empty" class="upload-album-empty" style="display: <?php echo ( $covers->count_images() > 0 ? 'none' : 'flex' ); ?>"><p><?php lang()->p( 'No images uploaded' ) ?></p></div>
				</div>
			</div>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cover_in_post"><?php lang()->p( 'Cover in Posts' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="cover_in_post" name="cover_in_post">

				<option value="header" <?php echo ( plugin()->getValue( 'cover_in_post' ) === 'header' ? 'selected' : '' ); ?>><?php lang()->p( 'Below Header' ); ?></option>

				<option value="full" <?php echo ( plugin()->getValue( 'cover_in_post' ) === 'full' ? 'selected' : '' ); ?>><?php lang()->p( 'Full Screen' ); ?></option>

				<option value="none" <?php echo ( plugin()->getValue( 'cover_in_post' ) === 'none' ? 'selected' : '' ); ?>><?php lang()->p( 'No Cover' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'The default cover image template for posts. Cover templates can override this setting on a per-post basis.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cover_in_page"><?php lang()->p( 'Cover in Pages' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="cover_in_page" name="cover_in_page">

				<option value="header" <?php echo ( plugin()->getValue( 'cover_in_page' ) === 'header' ? 'selected' : '' ); ?>><?php lang()->p( 'Below Header' ); ?></option>

				<option value="full" <?php echo ( plugin()->getValue( 'cover_in_page' ) === 'full' ? 'selected' : '' ); ?>><?php lang()->p( 'Full Screen' ); ?></option>

				<option value="none" <?php echo ( plugin()->getValue( 'cover_in_page' ) === 'none' ? 'selected' : '' ); ?>><?php lang()->p( 'No Cover' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'The default cover image template for pages. Cover templates can override this setting on a per-page basis.' ); ?></small>
		</div>
	</div>

	<?php if ( getPlugin( 'User_Profiles' ) ) : ?>
	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cover_in_profile"><?php lang()->p( 'Cover in Profiles' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="cover_in_profile" name="cover_in_profile">
				<option value="profile" <?php echo ( plugin()->getValue( 'cover_in_profile' ) === 'profile' ? 'selected' : '' ); ?>><?php lang()->p( 'Profile Only' ); ?></option>

				<option value="header" <?php echo ( plugin()->getValue( 'cover_in_profile' ) === 'header' ? 'selected' : '' ); ?>><?php lang()->p( 'Header Only' ); ?></option>

				<option value="both" <?php echo ( plugin()->getValue( 'cover_in_profile' ) === 'both' ? 'selected' : '' ); ?>><?php lang()->p( 'Header & Profile' ); ?></option>

				<option value="none" <?php echo ( plugin()->getValue( 'cover_in_profile' ) === 'none' ? 'selected' : '' ); ?>><?php lang()->p( 'No Cover' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'User cover image display on profile pages.' ); ?></small>
		</div>
	</div>
	<?php endif; ?>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cover_style"><?php lang()->p( 'Cover Color Style' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="cover_style" name="cover_style">
				<option value="overlay" <?php echo ( plugin()->getValue( 'cover_style' ) === 'overlay' ? 'selected' : '' ); ?>><?php lang()->p( 'Color Overlay' ); ?></option>
				<option value="blend" <?php echo ( plugin()->getValue( 'cover_style' ) === 'blend' ? 'selected' : '' ); ?>><?php lang()->p( 'Color Blend' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Cover images can have a simple overlay or blend with a color.' ); ?></small>
		</div>
	</div>

	<div id="cover_overlay_wrap" style="display: <?php echo ( plugin()->getValue( 'cover_style' ) === 'overlay' ? 'block' : 'none' ); ?>;">
		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="cover_desaturate"><?php lang()->p( 'Desaturate' ); ?></label>
			<div class="col-sm-10 row">
				<div class="form-range-controls">
					<span class="form-range-value px-range-value"><span id="cover_desaturate_value"><?php echo ( plugin()->getValue( 'cover_desaturate' ) ? plugin()->getValue( 'cover_desaturate' ) : plugin()->dbFields['cover_desaturate'] ); ?></span><span id="cover_desaturate_units">%</span></span>
					<input type="range" class="form-control-range custom-range" onInput="$('#cover_desaturate_value').html($(this).val())" id="cover_desaturate" name="cover_desaturate" value="<?php echo plugin()->getValue( 'cover_desaturate' ); ?>" min="0" max="100" step="1" />
					<span id="cover_desaturate_reset" class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#cover_desaturate_value').text('<?php echo plugin()->dbFields['cover_desaturate']; ?>');$('#cover_desaturate').val('<?php echo plugin()->dbFields['cover_desaturate']; ?>');"><?php lang()->p( 'Default' ); ?></span>
				</div>
				<small class="form-text"><?php lang()->p( 'Percentage to desaturate images. Set 100% for full grayscale (black & white).' ); ?></small>
			</div>
		</div>

		<div id="cover-desaturate-use-wrap" class="form-field form-group row" style="display: <?php echo ( plugin()->cover_desaturate() > 0 ? 'flex' : 'none' ); ?>">
			<label class="form-label col-sm-2 col-form-label" for="cover_desaturate_use"><?php lang()->p( 'Desaturate Usage' ); ?></label>
			<div class="col-sm-10">
				<small class="form-text"><?php lang()->p( 'Where to apply desaturation to cover images.' ); ?></small>

				<div id="cover-desaturate-use" class="multi-check-wrap">

					<label class="check-label-wrap" for="desaturate_covers"><input class="cover-desaturate" type="checkbox" name="cover_desaturate_use[]" id="desaturate_covers" value="covers" <?php echo ( is_array( plugin()->cover_desaturate_use() ) && in_array( 'covers', plugin()->cover_desaturate_use() ) ? 'checked' : '' ); ?>> <?php lang()->p( 'Page Covers' ); ?></label>

					<?php if ( plugin()->posts_slider() ) : ?>
					<label class="check-label-wrap" for="desaturate_slider"><input class="cover-desaturate" type="checkbox" name="cover_desaturate_use[]" id="desaturate_slider" value="slider" <?php echo ( is_array( plugin()->cover_desaturate_use() ) && in_array( 'slider', plugin()->cover_desaturate_use() ) ? 'checked' : '' ); ?>> <?php lang()->p( 'Front Page Slider' ); ?></label>
					<?php endif; ?>

					<label class="check-label-wrap" for="desaturate_loop"><input class="cover-desaturate" type="checkbox" name="cover_desaturate_use[]" id="desaturate_loop" value="loop" <?php echo ( is_array( plugin()->cover_desaturate_use() ) && in_array( 'loop', plugin()->cover_desaturate_use() ) ? 'checked' : '' ); ?>> <?php lang()->p( 'Main Loop' ); ?></label>

					<label class="check-label-wrap" for="desaturate_cat"><input class="cover-desaturate" type="checkbox" name="cover_desaturate_use[]" id="desaturate_cat" value="cat" <?php echo ( is_array( plugin()->cover_desaturate_use() ) && in_array( 'cat', plugin()->cover_desaturate_use() ) ? 'checked' : '' ); ?>> <?php lang()->p( 'Category Loop' ); ?></label>

					<label class="check-label-wrap" for="desaturate_tag"><input class="cover-desaturate" type="checkbox" name="cover_desaturate_use[]" id="desaturate_tag" value="tag" <?php echo ( is_array( plugin()->cover_desaturate_use() ) && in_array( 'tag', plugin()->cover_desaturate_use() ) ? 'checked' : '' ); ?>> <?php lang()->p( 'Tag Loop' ); ?></label>

					<label class="check-label-wrap" for="desaturate_search"><input class="cover-desaturate" type="checkbox" name="cover_desaturate_use[]" id="desaturate_search" value="search" <?php echo ( is_array( plugin()->cover_desaturate_use() ) && in_array( 'search', plugin()->cover_desaturate_use() ) ? 'checked' : '' ); ?>> <?php lang()->p( 'Search Loop' ); ?></label>

					<label class="check-label-wrap" for="desaturate_related"><input class="cover-desaturate" type="checkbox" name="cover_desaturate_use[]" id="desaturate_related" value="related" <?php echo ( is_array( plugin()->cover_desaturate_use() ) && in_array( 'related', plugin()->cover_desaturate_use() ) ? 'checked' : '' ); ?>> <?php lang()->p( 'Related Posts' ); ?></label>

					<?php if ( getPlugin( 'User_Profiles' ) ) : ?>
					<label class="check-label-wrap" for="desaturate_profile"><input class="cover-desaturate" type="checkbox" name="cover_desaturate_use[]" id="desaturate_profile" value="profile" <?php echo ( is_array( plugin()->cover_desaturate_use() ) && in_array( 'profile', plugin()->cover_desaturate_use() ) ? 'checked' : '' ); ?>> <?php lang()->p( 'User Profiles' ); ?></label>
					<?php endif; ?>
				</div>
				<small class="form-text"><?php lang()->p( '' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="cover_overlay"><?php lang()->p( 'Overlay Color' ); ?></label>
			<div class="col-sm-10 row color-picker-wrap">
				<input class="color-picker" id="cover_overlay" name="cover_overlay" value="<?php echo plugin()->cover_overlay(); ?>" />
				<input id="cover_overlay_default" class="screen-reader-text" type="hidden" value="<?php echo plugin()->dbFields['cover_overlay']; ?>" />
				<span class="btn btn-secondary btn-md hide-if-no-js" id="cover_overlay_default_button"><?php lang()->p( 'Default' ); ?></span>
			</div>
		</div>
	</div>

	<div id="cover_blend_wrap" style="display: <?php echo ( plugin()->getValue( 'cover_style' ) === 'blend' ? 'block' : 'none' ); ?>;">
		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="cover_blend"><?php lang()->p( 'Blend Color' ); ?></label>
			<div class="col-sm-10">
				<div class="row color-picker-wrap">
					<input class="color-picker custom-color" id="cover_blend" name="cover_blend" value="<?php echo plugin()->cover_blend(); ?>" />
					<input id="cover_blend_default" class="screen-reader-text" type="hidden" value="<?php echo ( current_cover_color() ? current_cover_color() : $this-dbFields['cover_blend'] ); ?>" />
					<span class="btn btn-secondary btn-md hide-if-no-js" id="cover_blend_default_button"><?php lang()->p( 'Reset' ); ?></span>
				</div>
				<small class="form-text"><?php lang()->p( 'Save new color scheme setting to get colors from that scheme.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="cover_blend_use"><?php lang()->p( 'Color Blend Usage' ); ?></label>
			<div class="col-sm-10">
				<small class="form-text"><?php lang()->p( 'Where to apply color blend to cover images.' ); ?></small>

				<div id="cover-blend-use-wrap" class="multi-check-wrap">
					<label class="check-label-wrap" for="blend_covers"><input class="cover-blend" type="checkbox" name="cover_blend_use[]" id="blend_covers" value="covers" <?php echo ( is_array( plugin()->cover_blend_use() ) && in_array( 'covers', plugin()->cover_blend_use() ) ? 'checked' : '' ); ?>> <?php lang()->p( 'Page Covers' ); ?></label>

					<label id="blend_slider_label" class="check-label-wrap" for="blend_slider" style="display: <?php echo ( plugin()->posts_slider() ? 'inline-block' : 'none' ); ?>"><input class="cover-blend" type="checkbox" name="cover_blend_use[]" id="blend_slider" value="slider" <?php echo ( is_array( plugin()->cover_blend_use() ) && in_array( 'slider', plugin()->cover_blend_use() ) ? 'checked' : '' ); ?>> <?php lang()->p( 'Front Page Slider' ); ?></label>

					<label class="check-label-wrap" for="blend_loop"><input class="cover-blend" type="checkbox" name="cover_blend_use[]" id="blend_loop" value="loop" <?php echo ( is_array( plugin()->cover_blend_use() ) && in_array( 'loop', plugin()->cover_blend_use() ) ? 'checked' : '' ); ?>> <?php lang()->p( 'Main Loop' ); ?></label>

					<label class="check-label-wrap" for="blend_cat"><input class="cover-blend" type="checkbox" name="cover_blend_use[]" id="blend_cat" value="cat" <?php echo ( is_array( plugin()->cover_blend_use() ) && in_array( 'cat', plugin()->cover_blend_use() ) ? 'checked' : '' ); ?>> <?php lang()->p( 'Category Loop' ); ?></label>

					<label class="check-label-wrap" for="blend_tag"><input class="cover-blend" type="checkbox" name="cover_blend_use[]" id="blend_tag" value="tag" <?php echo ( is_array( plugin()->cover_blend_use() ) && in_array( 'tag', plugin()->cover_blend_use() ) ? 'checked' : '' ); ?>> <?php lang()->p( 'Tag Loop' ); ?></label>

					<label class="check-label-wrap" for="blend_search"><input class="cover-blend" type="checkbox" name="cover_blend_use[]" id="blend_search" value="search" <?php echo ( is_array( plugin()->cover_blend_use() ) && in_array( 'search', plugin()->cover_blend_use() ) ? 'checked' : '' ); ?>> <?php lang()->p( 'Search Loop' ); ?></label>

					<label class="check-label-wrap" for="blend_galleries"><input class="cover-blend" type="checkbox" name="cover_blend_use[]" id="blend_galleries" value="galleries" <?php echo ( is_array( plugin()->cover_blend_use() ) && in_array( 'galleries', plugin()->cover_blend_use() ) ? 'checked' : '' ); ?>> <?php lang()->p( 'Gallery Thumbnails' ); ?></label>

					<label class="check-label-wrap" for="blend_related"><input class="cover-blend" type="checkbox" name="cover_blend_use[]" id="blend_related" value="related" <?php echo ( is_array( plugin()->cover_blend_use() ) && in_array( 'related', plugin()->cover_blend_use() ) ? 'checked' : '' ); ?>> <?php lang()->p( 'Related Posts' ); ?></label>

					<?php if ( getPlugin( 'User_Profiles' ) ) : ?>
					<label class="check-label-wrap" for="blend_profile"><input class="cover-blend" type="checkbox" name="cover_blend_use[]" id="blend_profile" value="profile" <?php echo ( is_array( plugin()->cover_blend_use() ) && in_array( 'profile', plugin()->cover_blend_use() ) ? 'checked' : '' ); ?>> <?php lang()->p( 'User Profiles' ); ?></label>
					<?php
					endif;

					// Never empty array.
					printf(
						'<label class="check-label-wrap" for="blend_foobar" style="display: none !important;"><input type="checkbox" name="cover_blend_use[]" id="blend_foobar" value="foobar" checked /> %s</label>',
						lang()->get( 'Ignore This' )
					);
					?>


				</div>
				<small class="form-text"><?php lang()->p( 'Select "Color Overlay" style above to fully disable color blend.' ); ?></small>
			</div>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cover_text_color"><?php lang()->p( 'Text Color' ); ?></label>
		<div class="col-sm-10 row color-picker-wrap">
			<input class="color-picker" id="cover_text_color" name="cover_text_color" value="<?php echo plugin()->cover_text_color(); ?>" />
			<input id="cover_text_default" class="screen-reader-text" type="hidden" value="<?php echo plugin()->dbFields['cover_text_color']; ?>" />
			<span class="btn btn-secondary btn-md hide-if-no-js" id="cover_text_color_default"><?php lang()->p( 'Default' ); ?></span>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cover_text_shadow"><?php lang()->p( 'Text Shadow' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="cover_text_shadow" name="cover_text_shadow">
				<option value="true" <?php echo ( plugin()->getValue( 'cover_text_shadow' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'cover_text_shadow' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Shadow behind overlay text can provide needed contrast.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cover_icon"><?php lang()->p( 'Down Icon' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="cover_icon" name="cover_icon">

				<option value="angle-down" <?php echo ( plugin()->getValue( 'cover_icon' ) === 'angle-down' ? 'selected' : '' ); ?>><?php lang()->p( 'Angle' ); ?></option>

				<option value="angle-down-light" <?php echo ( plugin()->getValue( 'cover_icon' ) === 'angle-down-light' ? 'selected' : '' ); ?>><?php lang()->p( 'Angle Light' ); ?></option>

				<option value="angles-down" <?php echo ( plugin()->getValue( 'cover_icon' ) === 'angles-down' ? 'selected' : '' ); ?>><?php lang()->p( 'Double Angle' ); ?></option>

				<option value="angles-down-light" <?php echo ( plugin()->getValue( 'cover_icon' ) === 'angles-down-light' ? 'selected' : '' ); ?>><?php lang()->p( 'Double Angle Light' ); ?></option>

				<option value="arrow-down" <?php echo ( plugin()->getValue( 'cover_icon' ) === 'arrow-down' ? 'selected' : '' ); ?>><?php lang()->p( 'Arrow' ); ?></option>

				<option value="arrow-down-light" <?php echo ( plugin()->getValue( 'cover_icon' ) === 'arrow-down-light' ? 'selected' : '' ); ?>><?php lang()->p( 'Arrow Light' ); ?></option>

				<option value="none" <?php echo ( plugin()->getValue( 'cover_icon' ) === 'none' ? 'selected' : '' ); ?>><?php lang()->p( 'None' ); ?></option>
			</select>
			<small class="form-text">
				<?php lang()->p( 'Choose the style of icon to scroll to content. For full-screen covers only.' ); ?>
			</small>
		</div>
	</div>
</fieldset>

<script>
$( function() {
	$( '.delete-cover' ).bind( 'click', function() {
		if ( ! confirm( '<?php lang()->p( 'Are you sure you want to delete this image?' ); ?>' ) ) { return; }
		deleteCover(this);
		$( "#cover-images-count" ).load( window.location.href + " #cover-images-count > span" );
	});
});

function deleteCover(el) {
	$.post( cover.config.ajaxUrl, {
		tokenCSRF : $( '#jstokenCSRF' ).val(),
		action    : 'deleteImage',
		album     : $(el).data( 'album' ),
		file      : $(el).data( 'file' )
	},
	function() {
		let manage = '#cover-image-' + $(el).data( 'number' );
		let select = '#cover-select-item-' + $(el).data( 'number' );
		let input  = '#cover-select-item-' + $(el).data( 'number' ) + ' input';
		$( manage ).fadeOut( 450, function() {
			$(this).remove();
		} );
		$( select ).hide();
		$( input ).removeAttr( 'checked' );

	}).fail( function() {
		$.alert({
			title   : cover.L.error,
			content : cover.L.deleteImageError
		});
	});
}
</script>
