<?php
/**
 * Header options fields
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

use function CFE_Plugin\{
	plugin,
	site,
	lang
};

// Default values.
$logo_filename = '';
if ( site()->logo() ) {
	$logo_filename = str_replace( DOMAIN_UPLOADS, '', site()->logo() );
}

?>

<h3 class="form-heading"><?php lang()->p( 'Header Options' ); ?></h3>

<fieldset>

	<legend class="screen-reader-text"><?php lang()->p( 'Header' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="header_layout"><?php lang()->p( 'Header Layout' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="header_layout" name="header_layout">
				<option value="horz" <?php echo ( plugin()->getValue( 'header_layout' ) === 'horz' ? 'selected' : '' ); ?>><?php lang()->p( 'Horizontal' ); ?></option>
				<option value="vert" <?php echo ( plugin()->getValue( 'header_layout' ) === 'vert' ? 'selected' : '' ); ?>><?php lang()->p( 'Vertical' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Does not apply to mobile layouts.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="site_title"><?php lang()->p( 'Website Title' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="site_title" name="site_title">
				<option value="true" <?php echo ( plugin()->getValue( 'site_title' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'site_title' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Title will not be hidden from search engines and screen readers.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cover_logo"><?php lang()->p( 'Website Slogan' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="site_slogan" name="site_slogan">
				<option value="true" <?php echo ( plugin()->getValue( 'site_slogan' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'site_slogan' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Slogan will not be hidden from search engines and screen readers.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="logo-standard-select"><?php lang()->p( 'Standard Logo' ); ?></label>
		<div class="col-sm-10">
			<p><?php lang()->p( 'The standard logo image displays in the site header when it has a solid background.' ); ?></p>

			<div id="logo-tabs-std" class="tab-content">

				<ul class="nav nav-tabs" id="logo-nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link" role="tab" aria-controls="logo-standard-select" aria-selected="false" href="#logo-standard-select"><?php lang()->p( 'Select' ); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" role="tab" aria-controls="logo-standard-upload" aria-selected="false" href="#logo-standard-upload"><?php lang()->p( 'Upload' ); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" role="tab" aria-controls="logo-standard-album" aria-selected="false" href="#logo-standard-album"><?php lang()->p( 'Album' ); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" role="tab" aria-controls="logo-standard-code" aria-selected="false" href="#logo-standard-code"><?php lang()->p( 'SVG' ); ?></a>
					</li>
				</ul>
				<div id="logo-standard-select" role="tabpanel" aria-labelledby="logo-standard-select">
					<p><?php lang()->p( 'Select one from uploaded logo images. SVG logo will override this selection.' ); ?></p>
					<?php echo $logos_std->select_images( $logo_std ); ?>
				</div>

				<div id="logo-standard-upload" class="tab-pane tab-pane-image-upload" role="tabpanel" aria-labelledby="logo-standard-upload">

					<p><?php lang()->p( 'Drag & drop images or click to browse. Allowed file types: .png, .gif, .jpg, .jpeg' ); ?></p>

					<div class="dropzone" id="logo-standard-upload"></div>

					<div id="logo-standard-upload-notice" style="display: none;">
						<p><?php lang()->p( '<strong>Note:</strong> this page needs to be refreshed before new images can be managed or selected as a logo image.' ); ?></p>
						<p><button class="button button-small btn btn-sm btn-primary" onClick="location.reload();"><?php lang()->p( 'Refresh' ); ?></button></p>
					</div>

				</div>

				<div id="logo-standard-album" class="tab-pane tab-pane-image-upload" role="tabpanel" aria-labelledby="logo-standard-album">
					<p><?php lang()->p( 'Manage uploaded logo images.' ); ?></p>
					<div id="logo-standard-album-wrap"><?php echo $logos_std->manage_images( $logo_std ); ?></div>
				</div>

				<div id="logo-standard-code" role="tabpanel" aria-labelledby="logo-standard-code">
					<p><?php lang()->p( 'Paste in SVG code to override any upload selection. Be sure that the SVG you enter is safe, that there is no malicious code.' ); ?></p>
					<textarea class="code-field" name="logo_standard_svg" id="logo-standard-svg" cols="60" rows="6"><?php echo plugin()->getValue( 'logo_standard_svg' ) ?></textarea>
				</div>
			</div>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="logo-cover-select"><?php lang()->p( 'Cover Logo' ); ?></label>
		<div class="col-sm-10">
			<p><?php lang()->p( 'Optional: the cover logo image displays in the site header when it has a full-screen cover image. If no cover logo is selected then the standard logo will be used with full-screen covers.' ); ?></p>

			<div id="logo-tabs-cover" class="tab-content">

				<ul class="nav nav-tabs" id="logo-nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link" role="tab" aria-controls="logo-cover-select" aria-selected="false" href="#logo-cover-select"><?php lang()->p( 'Select' ); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" role="tab" aria-controls="logo-cover-upload" aria-selected="false" href="#logo-cover-upload"><?php lang()->p( 'Upload' ); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" role="tab" aria-controls="logo-cover-album" aria-selected="false" href="#logo-cover-album"><?php lang()->p( 'Album' ); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" role="tab" aria-controls="logo-cover-code" aria-selected="false" href="#logo-cover-code"><?php lang()->p( 'SVG' ); ?></a>
					</li>
				</ul>
				<div id="logo-cover-select" role="tabpanel" aria-labelledby="logo-cover-select">
					<p><?php lang()->p( 'Select one from uploaded logo images. SVG logo will override this selection.' ); ?></p>
					<?php echo $logos_cover->select_images( $logo_cover ); ?>
				</div>

				<div id="logo-cover-upload" class="tab-pane tab-pane-image-upload" role="tabpanel" aria-labelledby="logo-cover-upload">

					<p><?php lang()->p( 'Drag & drop images or click to browse. Allowed file types: .png, .gif, .jpg, .jpeg' ); ?></p>

					<div class="dropzone" id="logo-cover-upload"></div>

					<div id="logo-cover-upload-notice" style="display: none;">
						<p><?php lang()->p( '<strong>Note:</strong> this page needs to be refreshed before new images can be managed or selected as a logo image.' ); ?></p>
						<p><button class="button button-small btn btn-sm btn-primary" onClick="location.reload();"><?php lang()->p( 'Refresh' ); ?></button></p>
					</div>

				</div>

				<div id="logo-cover-album" class="tab-pane tab-pane-image-upload" role="tabpanel" aria-labelledby="logo-cover-album">
					<p><?php lang()->p( 'Manage uploaded logo images. Click image to view full size.' ); ?></p>
					<div id="logo-cover-album-wrap"><?php echo $logos_cover->manage_images( $logo_cover ); ?></div>
				</div>

				<div id="logo-cover-code" role="tabpanel" aria-labelledby="logo-cover-code">
					<p><?php lang()->p( 'Paste in SVG code to override any upload selection. Be sure that the SVG you enter is safe, that there is no malicious code.' ); ?></p>
					<textarea class="code-field" name="logo_cover_svg" id="logo-cover-svg" cols="60" rows="6"><?php echo plugin()->getValue( 'logo_cover_svg' ) ?></textarea>
				</div>
			</div>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cover_logo_dark_mode"><?php lang()->p( 'Dark Mode Logo' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="cover_logo_dark_mode" name="cover_logo_dark_mode">
				<option value="true" <?php echo ( plugin()->getValue( 'cover_logo_dark_mode' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Cover Logo' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'cover_logo_dark_mode' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Standard Logo' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'The logo to use when in dark mode.' ); ?></small>
		</div>
	</div>

	<div id="logo_fields">
		<div id="logo_width_std_wrap" class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="logo_width_std"><?php lang()->p( 'Logo Width, Desktop' ); ?></label>
			<div class="col-sm-10">
				<figure id="logo_preview_desktop" class="form-range-preview-image" style="width: <?php echo plugin()->getValue( 'logo_width_std' ); ?>px">
					<?php
					if ( plugin()->logo_standard_svg() ) :
						echo htmlspecialchars_decode( plugin()->logo_standard_svg() );
					elseif ( plugin()->standard_logo_src() ) : ?>
					<img class="img-fluid img-thumbnail" alt="<?php echo ( plugin()->standard_logo_src() ? lang()->get( 'Desktop logo preview' ) : lang()->get( 'No logo uploaded' ) ); ?>" src="<?php echo ( plugin()->standard_logo_src() ? plugin()->standard_logo_src() : '' ); ?>" width="<?php echo plugin()->getValue( 'logo_width_std' ); ?>" style="width: 100%;" />
					<?php endif; ?>
				</figure>
				<div class="form-range-controls row">
					<span class="form-range-value px-range-value"><span id="logo_width_std_value"><?php echo plugin()->getValue( 'logo_width_std' ); ?></span><span id="logo_width_std_units">px</span></span>
					<input type="range" class="form-control-range custom-range" onInput="$('#logo_width_std_value').html($(this).val());$('#logo_preview_desktop').css('width',$(this).val()+'px');" id="logo_width_std" name="logo_width_std" value="<?php echo plugin()->getValue( 'logo_width_std' ); ?>" min="0" max="320" step="1" />
					<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#logo_width_std_value').text('<?php echo plugin()->dbFields['logo_width_std']; ?>');$('#logo_width_std').val('<?php echo plugin()->dbFields['logo_width_std']; ?>');$('#logo_preview_desktop').css('width','<?php echo plugin()->dbFields['logo_width_std']; ?>');"><?php lang()->p( 'Default' ); ?></span>
				</div>
				<small class="form-text"><?php lang()->p( 'This is a maximum width in pixels.' ); ?></small>
			</div>
		</div>

		<div id="logo_width_mob_wrap" class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="logo_width_mob"><?php lang()->p( 'Logo Width, Mobile' ); ?></label>
			<div class="col-sm-10">
				<figure id="logo_preview_mobile" class="form-range-preview-image" style="width: <?php echo plugin()->getValue( 'logo_width_mob' ); ?>px">
					<?php
					if ( plugin()->logo_standard_svg() ) :
						echo htmlspecialchars_decode( plugin()->logo_standard_svg() );
					elseif ( plugin()->standard_logo_src() ) : ?>
					<img class="img-fluid img-thumbnail" alt="<?php echo ( plugin()->standard_logo_src() ? lang()->get( 'Mobile logo preview' ) : lang()->get( 'No logo uploaded' ) ); ?>" src="<?php echo ( plugin()->standard_logo_src() ? plugin()->standard_logo_src() : '' ); ?>" width="<?php echo plugin()->getValue( 'logo_width_mob' ); ?>" style="width: 100%;" />
					<?php endif; ?>
				</figure>
				<div class="form-range-controls row">
					<span class="form-range-value px-range-value"><span id="logo_width_mob_value"><?php echo plugin()->getValue( 'logo_width_mob' ); ?></span><span id="logo_width_mob_units">px</span></span>
					<input type="range" class="form-control-range custom-range" onInput="$('#logo_width_mob_value').html($(this).val());$('#logo_preview_mobile').css('width',$(this).val()+'px');" id="logo_width_mob" name="logo_width_mob" value="<?php echo plugin()->getValue( 'logo_width_mob' ); ?>" min="0" max="320" step="1" />
					<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#logo_width_mob_value').text('<?php echo plugin()->dbFields['logo_width_mob']; ?>');$('#logo_width_mob').val('<?php echo plugin()->dbFields['logo_width_mob']; ?>');$('#logo_preview_mobile').css('width','<?php echo plugin()->dbFields['logo_width_mob']; ?>');"><?php lang()->p( 'Default' ); ?></span>
				</div>
				<small class="form-text"><?php lang()->p( 'This is a maximum width in pixels.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="logo_location"><?php lang()->p( 'Logo Placement' ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="logo_location" name="logo_location">
					<option value="before" <?php echo ( plugin()->getValue( 'logo_location' ) === 'before' ? 'selected' : '' ); ?>><?php lang()->p( 'Before Text' ); ?></option>

					<option value="after" <?php echo ( plugin()->getValue( 'logo_location' ) === 'after' ? 'selected' : '' ); ?>><?php lang()->p( 'After Text' ); ?></option>

					<option value="above" <?php echo ( plugin()->getValue( 'logo_location' ) === 'above' ? 'selected' : '' ); ?>><?php lang()->p( 'Above Text' ); ?></option>

					<option value="below" <?php echo ( plugin()->getValue( 'logo_location' ) === 'below' ? 'selected' : '' ); ?>><?php lang()->p( 'Below Text' ); ?></option>
				</select>
				<small class="form-text"><?php lang()->p( 'Where to place the logo in the header branding section.' ); ?></small>
			</div>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="header_sticky"><?php lang()->p( 'Sticky Header' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="header_sticky" name="header_sticky">
				<option value="true" <?php echo ( plugin()->getValue( 'header_sticky' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'header_sticky' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Makes the branding and navigation stick to the top of the viewport. Not for mobile screens.' ); ?></small>
		</div>
	</div>
</fieldset>

<script>
jQuery(document).ready( function($) {
	$( '#logo-tabs-std' ).tabslet({
		active : <?php echo ( plugin()->logo_standard_svg() ? 4 : 1 ); ?>,
		animation : true
	});
	$( '#logo-tabs-cover' ).tabslet({
		active : <?php echo ( plugin()->logo_cover_svg() ? 4 : 1 ); ?>,
		animation : true
	});
});

$( function() {
	$( '.delete-logo-standard' ).bind( 'click', function() {
		if ( ! confirm( '<?php lang()->p( 'Are you sure you want to delete this image?' ); ?>' ) ) { return; }
		deleteStandardLogo(this);
	});
	$( '.delete-logo-cover' ).bind( 'click', function() {
		if ( ! confirm( '<?php lang()->p( 'Are you sure you want to delete this image?' ); ?>' ) ) { return; }
		deleteCoverLogo(this);
	});
});

function deleteStandardLogo(el) {
	$.post( logo.config.ajaxUrl, {
		tokenCSRF : $( '#jstokenCSRF' ).val(),
		action    : 'deleteImage',
		album     : $(el).data( 'album' ),
		file      : $(el).data( 'file' )
	},
	function() {
		let manage = '#logo-standard-image-' + $(el).data( 'number' );
		let select = '#logo-standard-select-item-' + $(el).data( 'number' );
		let input  = '#logo-standard-select-item-' + $(el).data( 'number' ) + ' input';
		$( manage ).fadeOut( 450 );
		$( select ).hide();
		$( input ).removeAttr( 'checked' );

	}).fail( function() {
		$.alert({
			title   : logo.L.error,
			content : logo.L.deleteImageError
		});
	});
}
function deleteCoverLogo(el) {
	$.post( logo.config.ajaxUrl, {
		tokenCSRF : $( '#jstokenCSRF' ).val(),
		action    : 'deleteImage',
		album     : $(el).data( 'album' ),
		file      : $(el).data( 'file' )
	},
	function() {
		let manage = '#logo-cover-image-' + $(el).data( 'number' );
		let select = '#logo-cover-select-item-' + $(el).data( 'number' );
		let input  = '#logo-cover-select-item-' + $(el).data( 'number' ) + ' input';
		$( manage ).fadeOut( 450 );
		$( select ).hide();
		$( input ).removeAttr( 'checked' );

	}).fail( function() {
		$.alert({
			title   : logo.L.error,
			content : logo.L.deleteImageError
		});
	});
}
</script>
