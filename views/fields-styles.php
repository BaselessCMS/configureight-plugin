<?php
/**
 * Appearance options fields
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Plugin\{
	plugin,
	site,
	lang,
	admin_theme
};
use function CFE_Colors\{
	color_schemes,
	custom_schemes,
	hex_to_rgb
};
use function CFE_Fonts\{
	font_schemes,
	current_font_scheme
};

// Color schemes.
$colors = color_schemes();
$custom_from = plugin()->custom_scheme_from();

// Font schemes.
$fonts = font_schemes();
$current_fonts = current_font_scheme();

// Labels for admin configuration options.
$css_label = lang()->get( 'Theme Styles' );
if ( admin_theme() ) {
	$css_label = lang()->get( 'Styles Only' );
}

// Color schemes page URL.
$colors_page = DOMAIN_ADMIN . 'plugin/' . plugin()->className() . '?page=colors';

// Font schemes page URL.
$fonts_page = DOMAIN_ADMIN . 'plugin/' . plugin()->className() . '?page=fonts';

?>

<h3 class="form-heading"><?php lang()->p( 'Layout Options' ); ?></h3>

<fieldset>

	<legend class="screen-reader-text"><?php lang()->p( 'Layout' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="content_width"><?php lang()->p( 'Content Width' ); ?></label>
		<div class="col-sm-10 row">
			<div class="form-range-controls">
				<span class="form-range-value px-range-value"><span id="content_width_value"><?php echo ( plugin()->content_width() ? plugin()->content_width() : plugin()->dbFields['content_width'] ); ?></span><span id="content_width_units">px</span></span>
				<input type="range" class="form-control-range custom-range" onInput="$('#content_width_value').html($(this).val())" id="content_width" name="content_width" value="<?php echo plugin()->content_width(); ?>" min="300" max="2050" step="10" />
				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#content_width_value').text('<?php echo plugin()->dbFields['content_width']; ?>');$('#content_width').val('<?php echo plugin()->dbFields['content_width']; ?>');"><?php lang()->p( 'Default' ); ?></span>
			</div>
			<small class="form-text"><?php lang()->p( 'Sets a maximum width on the wrapper around the page content and the sidebar. Viewport breakpoints apply. ' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="horz_spacing"><?php lang()->p( 'Horizontal Space' ); ?></label>
		<div class="col-sm-10 row">
			<div class="form-range-controls">
				<span class="form-range-value rem-range-value"><span id="horz_spacing_value"><?php echo ( plugin()->horz_spacing() ? plugin()->horz_spacing() : plugin()->dbFields['horz_spacing'] ); ?></span><span id="horz_spacing_units">rem</span></span>
				<input type="range" class="form-control-range custom-range" onInput="$('#horz_spacing_value').html($(this).val())" id="horz_spacing" name="horz_spacing" value="<?php echo plugin()->horz_spacing(); ?>" min="0.5" max="4" step="0.025" />
				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#horz_spacing_value').text('<?php echo plugin()->dbFields['horz_spacing']; ?>');$('#horz_spacing').val('<?php echo plugin()->dbFields['horz_spacing']; ?>');"><?php lang()->p( 'Default' ); ?></span>
			</div>
			<small class="form-text"><?php lang()->p( 'General horizontal spacing between elements and areas. A fraction of this setting may be used where the full amount would not be appealing.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="vert_spacing"><?php lang()->p( 'Vertical Spacing' ); ?></label>
		<div class="col-sm-10 row">
			<div class="form-range-controls">
				<span class="form-range-value rem-range-value"><span id="vert_spacing_value"><?php echo ( plugin()->vert_spacing() ? plugin()->vert_spacing() : plugin()->dbFields['vert_spacing'] ); ?></span><span id="vert_spacing_units">rem</span></span>
				<input type="range" class="form-control-range custom-range" onInput="$('#vert_spacing_value').html($(this).val())" id="vert_spacing" name="vert_spacing" value="<?php echo plugin()->vert_spacing(); ?>" min="0.5" max="4" step="0.025" />
				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#vert_spacing_value').text('<?php echo plugin()->dbFields['vert_spacing']; ?>');$('#vert_spacing').val('<?php echo plugin()->dbFields['vert_spacing']; ?>');"><?php lang()->p( 'Default' ); ?></span>
			</div>
			<small class="form-text"><?php lang()->p( 'General vertical spacing between elements and areas. A fraction of this setting may be used where the full amount would not be appealing.' ); ?></small>
		</div>
	</div>
</fieldset>

<h3 class="form-heading"><?php lang()->p( 'Background Image' ); ?></h3>

<fieldset>

	<legend class="screen-reader-text"><?php lang()->p( 'Manage Background Image' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="body_img_use"><?php lang()->p( 'Enable Image' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="body_img_use" name="body_img_use">
				<option value="true" <?php echo ( plugin()->body_img_use() === true ? 'selected' : '' ); ?>><?php lang()->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( plugin()->body_img_use() === false ? 'selected' : '' ); ?>><?php lang()->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Add an image to the website body.' ); ?></small>
		</div>
	</div>

	<div id="body_img_options" style="display: <?php echo ( plugin()->body_img_use() === true ? 'block' : 'none' ); ?>;">

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="body_img_url"><?php lang()->p( 'Background Images' ); ?></label>
			<div class="col-sm-10">

				<div id="background-tabs" class="tab-content" data-toggle="tabslet" data-deeplinking="false" data-animation="true">

					<ul class="nav nav-tabs" id="background-nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link" role="tab" aria-controls="background-select" aria-selected="false" href="#background-select"><?php lang()->p( 'Select' ); ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" role="tab" aria-controls="background-upload" aria-selected="false" href="#background-upload"><?php lang()->p( 'Upload' ); ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" role="tab" aria-controls="background-album" aria-selected="false" href="#background-album"><?php lang()->p( 'Album' ); ?></a>
						</li>
					</ul>
					<div id="background-select" role="tabpanel" aria-labelledby="background-select">
						<p><?php lang()->p( 'Select one from uploaded background images.' ); ?></p>
						<?php echo $backgrounds->select_images( $background ); ?>
					</div>

					<div id="background-upload" class="tab-pane tab-pane-image-upload" role="tabpanel" aria-labelledby="background-upload">

						<p><?php lang()->p( 'Drag & drop images or click to browse. Allowed file types: .gif, .png, .ico' ); ?></p>

						<div class="dropzone" id="background-upload"></div>

						<div id="background-upload-notice" style="display: none;">
							<p><?php lang()->p( '<strong>Note:</strong> this page needs to be refreshed before new images can be managed or selected as a background image.' ); ?></p>
							<p><button class="button button-small btn btn-sm btn-primary" onClick="location.reload();"><?php lang()->p( 'Refresh' ); ?></button></p>
						</div>
					</div>

					<div id="background-album" class="tab-pane tab-pane-image-upload" role="tabpanel" aria-labelledby="background-album">
						<p><?php lang()->p( 'Manage uploaded background images.' ); ?></p>
						<div id="background-album-wrap"><?php echo $backgrounds->manage_images( $background ); ?></div>
					</div>
				</div>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="body_img_repeat"><?php lang()->p( 'Image Repeat' ); ?></label>
			<div class="col-sm-10">
				<div class="radio-buttons-wrap">

					<label class="check-label-wrap" for="bg_repeat"><input type="radio" name="body_img_repeat" id="bg_repeat" value="repeat" <?php echo ( 'repeat' == plugin()->body_img_repeat() ? 'checked' : '' ); ?>> <?php lang()->p( 'Repeat' ); ?></label>

					<label class="check-label-wrap" for="bg_no_repeat"><input type="radio" name="body_img_repeat" id="bg_no_repeat" value="no-repeat" <?php echo ( 'no-repeat' == plugin()->body_img_repeat() ? 'checked' : '' ); ?>> <?php lang()->p( 'No Repeat' ); ?></label>
				</div>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="body_img_x"><?php lang()->p( 'Position X' ); ?></label>
			<div class="col-sm-10">
				<div class="radio-buttons-wrap">

					<label class="check-label-wrap" for="bg_x_left"><input type="radio" name="body_img_x" id="bg_x_left" value="left" <?php echo ( 'left' == plugin()->body_img_x() ? 'checked' : '' ); ?>> <?php lang()->p( 'Left' ); ?></label>

					<label class="check-label-wrap" for="bg_x_center"><input type="radio" name="body_img_x" id="bg_x_center" value="center" <?php echo ( 'center' == plugin()->body_img_x() ? 'checked' : '' ); ?>> <?php lang()->p( 'Center' ); ?></label>

					<label class="check-label-wrap" for="bg_x_right"><input type="radio" name="body_img_x" id="bg_x_right" value="right" <?php echo ( 'right' == plugin()->body_img_x() ? 'checked' : '' ); ?>> <?php lang()->p( 'Right' ); ?></label>

					<label class="check-label-wrap" for="bg_x_custom"><input type="radio" name="body_img_x" id="bg_x_custom" value="custom" <?php echo ( 'custom' == plugin()->body_img_x() ? 'checked' : '' ); ?>> <?php lang()->p( 'Custom' ); ?></label>
				</div>
				<div id="body_img_x_custom_wrap" style="display: <?php echo ( 'custom' == plugin()->body_img_x() ? 'block' : 'none' ); ?>; margin-top: 0.5em;">
					<input type="text" id="body_img_x_custom" name="body_img_x_custom" value="<?php echo plugin()->body_img_x_custom() ?>" placeholder="<?php lang()->p( 'Enter valid CSS' ); ?>" />
				</div>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="body_img_y"><?php lang()->p( 'Position Y' ); ?></label>
			<div class="col-sm-10">
				<div class="radio-buttons-wrap">

					<label class="check-label-wrap" for="bg_y_top"><input type="radio" name="body_img_y" id="bg_y_top" value="top" <?php echo ( 'top' == plugin()->body_img_y() ? 'checked' : '' ); ?>> <?php lang()->p( 'Top' ); ?></label>

					<label class="check-label-wrap" for="bg_y_center"><input type="radio" name="body_img_y" id="bg_y_center" value="center" <?php echo ( 'center' == plugin()->body_img_y() ? 'checked' : '' ); ?>> <?php lang()->p( 'Center' ); ?></label>

					<label class="check-label-wrap" for="bg_y_bottom"><input type="radio" name="body_img_y" id="bg_y_bottom" value="bottom" <?php echo ( 'bottom' == plugin()->body_img_y() ? 'checked' : '' ); ?>> <?php lang()->p( 'Bottom' ); ?></label>

					<label class="check-label-wrap" for="bg_y_custom"><input type="radio" name="body_img_y" id="bg_y_custom" value="custom" <?php echo ( 'custom' == plugin()->body_img_y() ? 'checked' : '' ); ?>> <?php lang()->p( 'Custom' ); ?></label>
				</div>
				<div id="body_img_y_custom_wrap" style="display: <?php echo ( 'custom' == plugin()->body_img_y() ? 'block' : 'none' ); ?>; margin-top: 0.5em;">
					<input type="text" id="body_img_y_custom" name="body_img_y_custom" value="<?php echo plugin()->body_img_y_custom() ?>" placeholder="<?php lang()->p( 'Enter valid CSS' ); ?>" />
				</div>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="body_img_size"><?php lang()->p( 'Image Size' ); ?></label>
			<div class="col-sm-10">
				<div class="radio-buttons-wrap">

					<label class="check-label-wrap" for="bg_size_auto"><input type="radio" name="body_img_size" id="bg_size_auto" value="auto" <?php echo ( 'auto' == plugin()->body_img_size() ? 'checked' : '' ); ?>> <?php lang()->p( 'Auto' ); ?></label>

					<label class="check-label-wrap" for="bg_size_cover"><input type="radio" name="body_img_size" id="bg_size_cover" value="cover" <?php echo ( 'cover' == plugin()->body_img_size() ? 'checked' : '' ); ?>> <?php lang()->p( 'Cover' ); ?></label>

					<label class="check-label-wrap" for="bg_size_contain"><input type="radio" name="body_img_size" id="bg_size_contain" value="contain" <?php echo ( 'contain' == plugin()->body_img_size() ? 'checked' : '' ); ?>> <?php lang()->p( 'Contain' ); ?></label>

					<label class="check-label-wrap" for="bg_size_custom"><input type="radio" name="body_img_size" id="bg_size_custom" value="custom" <?php echo ( 'custom' == plugin()->body_img_size() ? 'checked' : '' ); ?>> <?php lang()->p( 'Custom' ); ?></label>
				</div>
				<div id="body_img_size_custom_wrap" style="display: <?php echo ( 'custom' == plugin()->body_img_size() ? 'block' : 'none' ); ?>; margin-top: 0.5em;">
					<input type="text" id="body_img_size_custom" name="body_img_size_custom" value="<?php echo plugin()->body_img_size_custom() ?>" placeholder="<?php lang()->p( 'Enter valid CSS' ); ?>" />
				</div>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="body_img_attach"><?php lang()->p( 'Image Attachment' ); ?></label>
			<div class="col-sm-10">
				<div class="radio-buttons-wrap">

					<label class="check-label-wrap" for="bg_attach_scroll"><input type="radio" name="body_img_attach" id="bg_attach_scroll" value="scroll" <?php echo ( 'scroll' == plugin()->body_img_attach() ? 'checked' : '' ); ?>> <?php lang()->p( 'Scroll' ); ?></label>

					<label class="check-label-wrap" for="bg_attach_fixed"><input type="radio" name="body_img_attach" id="bg_attach_fixed" value="fixed" <?php echo ( 'fixed' == plugin()->body_img_attach() ? 'checked' : '' ); ?>> <?php lang()->p( 'Fixed' ); ?></label>
				</div>
			</div>
		</div>
	</div>

</fieldset>

<h3 class="form-heading"><?php lang()->p( 'Color Schemes' ); ?></h3>

<fieldset>

	<legend class="screen-reader-text"><?php lang()->p( 'Manage Color Scheme' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="color_scheme"><?php lang()->p( 'Color Scheme' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="color_scheme" name="color_scheme">
				<?php

				// Sort schemes alphabetically then by category.
				ksort( $colors );
				usort( $colors, function( $one_thing, $another ) {
					return strcmp( $one_thing['category'], $another['category'] );
				} );

				// Category used for option groups.
				$category = '';

				// Exclude some schemes from loop.custom_schemes()
				$exclude = array_merge( [ 'default', 'dark' ], custom_schemes() );

				// Basic schemes.
				printf(
					'<optgroup label="%s"><option value="default" %s>%s</option><option value="dark" %s>%s</option></optgroup>',
					lang()->get( 'Basic' ),
					( plugin()->color_scheme() === 'default' ? 'selected' : '' ),
					lang()->get( 'Default' ),
					( plugin()->color_scheme() === 'dark' ? 'selected' : '' ),
					lang()->get( 'Dark' )
				);

				foreach ( $colors as $color => $option ) {

					// Skip custom scheme, added after.
					if ( 'custom' == $option['category'] ) {
						continue;
					}

					if ( $category != $option['category'] && 'basic' != $option['category'] ) {
						if ( $category != '' ) {
							echo '</optgroup>';
						}
						printf(
							'<optgroup label="%s">',
							ucwords( str_replace( '-', ' ', $option['category'] ) )
						);
					}
					if ( ! in_array( $option['slug'], $exclude ) ) {
						printf(
							'<option value="%s" %s>%s</option>',
							$option['slug'],
							( plugin()->color_scheme() === $option['slug'] ? 'selected' : '' ),
							$option['name']
						);
					}
					$category = $option['category'];
				}
				if ( $category != '' ) {
					echo '</optgroup>';
				}

				printf(
					'<optgroup label="%s">',
					lang()->get( 'Build Your Own' )
				);
				printf(
					'<option value="bootstrap" %s>%s</option>',
					( plugin()->color_scheme() === 'bootstrap' ? 'selected' : '' ),
					lang()->get( 'Bootstrap' )
				);
				printf(
					'<option value="tailwind" %s>%s</option>',
					( plugin()->color_scheme() === 'tailwind' ? 'selected' : '' ),
					lang()->get( 'Tailwind' )
				);
				printf(
					'<option value="custom" %s>%s</option>',
					( plugin()->color_scheme() === 'custom' ? 'selected' : '' ),
					lang()->get( 'Custom' )
				);
				echo '</optgroup>';
				?>
			</select>
			<input type="hidden" id="custom_scheme_from" name="custom_scheme_from" value="<?php echo plugin()->custom_scheme_from(); ?>" />

			<ul id="form-color-thumbs-list">
			<?php foreach ( $colors as $color => $option ) {

				if ( ! in_array( plugin()->color_scheme(), custom_schemes() ) && plugin()->color_scheme() === $option['slug'] ) {
					$display = 'flex';
				} else {
					$display = 'none';
				}

				if ( isset( $option['about'] ) && ! empty( $option['about'] ) ) {
					printf(
						'<li id="scheme_desc_%s" style="display: %s;"><p>%s</p></li>',
						$option['slug'],
						$display,
						$option['about']
					);
				}
				printf(
					'<li id="light_scheme_label_%s" style="margin-top: 1em; display: %s;">%s</li>',
					$option['slug'],
					$display,
					lang()->get( 'Light mode colors:' )
				);
				printf(
					'<ul id="light_scheme_thumbs_%s" style="display: %s;">',
					$option['slug'],
					$display
				);
				$count = 0;
				foreach ( $option['light'] as $thumb ) {
					$count++;
					if ( ! empty( $thumb ) ) {
						printf(
							'<li id="%s_thumb_%s" class="form-tooltip" style="background-color: %s" title="%s"><span class="screen-reader-text">%s</span></li>',
							$option['slug'],
							$count,
							$thumb,
							$thumb,
							$thumb
						);
					}
				}
				echo '</ul>';

				printf(
					'<li id="dark_scheme_label_%s" style="margin-top: 1em; display: %s;">%s</li>',
					$option['slug'],
					$display,
					lang()->get( 'Dark mode colors:' )
				);
				printf(
					'<ul id="dark_scheme_thumbs_%s" style="display: %s;">',
					$option['slug'],
					$display
				);
				$count = 0;
				foreach ( $option['dark'] as $thumb ) {
					$count++;
					if ( ! empty( $thumb ) ) {
						printf(
							'<li id="%s_thumb_%s_dark" class="form-tooltip" style="background-color: %s" title="%s"><span class="screen-reader-text">%s</span></li>',
							$option['slug'],
							$count,
							$thumb,
							$thumb,
							$thumb
						);
					}
				}
				echo '</ul>';

				if ( isset( $option['extra'] ) ) :

				printf(
					'<li id="extra_scheme_label_%s" style="margin-top: 1em; display: %s;">%s</li>',
					$option['slug'],
					$display,
					lang()->get( 'Color picker options:' )
				);
				printf(
					'<ul id="extra_scheme_thumbs_%s" style="display: %s;">',
					$option['slug'],
					$display
				);
				$count = 0;
				foreach ( $option['extra'] as $thumb ) {
					$count++;
					if ( ! empty( $thumb ) ) {
						printf(
							'<li id="%s_thumb_%s_extra" class="form-tooltip" style="background-color: %s" title="%s"><span class="screen-reader-text">%s</span></li>',
							$option['slug'],
							$count,
							$thumb,
							$thumb,
							$thumb
						);
					}
				}
				echo '</ul>';
				endif;
			} ?>
			</ul>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="use_dark_scheme"><?php lang()->p( 'Dark Version' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="use_dark_scheme" name="use_dark_scheme">
				<option value="true" <?php echo ( plugin()->use_dark_scheme() === true ? 'selected' : '' ); ?>><?php lang()->p( 'Use Always' ); ?></option>
				<option value="false" <?php echo ( plugin()->use_dark_scheme() === false ? 'selected' : '' ); ?>><?php lang()->p( 'Preference Only' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Use the dark version of the color scheme regardless of browser/device setting.' ); ?></small>
		</div>
	</div>

	<?php
	// Redefine `$colors` variable after sorting.
	$colors = color_schemes();

	include( plugin()->phpPath() . '/views/partials/custom-colors.php' );

	?>
	<h3 class="form-heading"><?php lang()->p( 'Typography' ); ?></h3>

	<div class="form-field form-group row">

		<label class="form-label col-sm-2 col-form-label" for="font_scheme"><?php lang()->p( 'Font Scheme' ); ?></label>

		<div class="col-sm-10">
			<select class="form-select" id="font_scheme" name="font_scheme">
				<?php foreach ( $fonts as $option => $scheme ) {
					printf(
						'<option value="%s" %s>%s</option>',
						$scheme['slug'],
						( plugin()->font_scheme() === $scheme['slug'] ? 'selected' : '' ),
						ucwords( $scheme['name'] )
					);
				} ?>
			</select>
			<?php foreach ( $fonts as $option => $scheme ) {
				$slug = $scheme['slug'];
				if ( array_key_exists( 'about', $scheme ) ) {
					if ( ! empty( $scheme['about'] ) ) {
						printf(
							'<p id="font-scheme-about-%s" style="display: %s;">%s</p>',
							$slug,
							( plugin()->font_scheme() === $slug ? 'block' : 'none' ),
							$scheme['about']
						);
					} else {
						printf(
						'<p id="font-scheme-about-%s" style="display: %s;">%s</p>',
						$slug,
						( plugin()->font_scheme() === $slug ? 'block' : 'none' ),
						lang()->get( 'See preview below.' )
					);
					}
				} else {
					printf(
						'<p id="font-scheme-about-%s" style="display: %s;">%s</p>',
						$slug,
						( plugin()->font_scheme() === $slug ? 'block' : 'none' ),
						lang()->get( 'See preview below.' )
					);
				}
			} ?>

			<ul id="font-preview-list">
			<?php foreach ( $fonts as $option => $scheme ) {

				$slug = $scheme['slug'];

				// Font weights & letter spacing.
				$weight_p = $scheme['primary']['weight'];
				$weight_s = $scheme['secondary']['weight'];
				$weight_d = $scheme['display']['weight'];
				$weight_t = $scheme['text']['weight'];
				$space_p  = $scheme['primary']['space'];
				$space_s  = $scheme['secondary']['space'];
				$space_d  = $scheme['display']['space'];
				$space_t  = $scheme['text']['space'];

				if ( $slug == plugin()->font_scheme() ) {
					$weight_p = plugin()->wght_primary();
					$weight_s = plugin()->wght_secondary();
					$weight_d = plugin()->wght_display();
					$weight_t = plugin()->wght_text();
					$space_p  = plugin()->space_primary();
					$space_s  = plugin()->space_secondary();
					$space_d  = plugin()->space_display();
					$space_t  = plugin()->space_text();
				}

				printf(
					'<!-- %1s %2s -->',
					lang()->get( 'Font scheme preview:' ),
					ucwords( $scheme['name'] )
				);
				printf(
					'<li id="font-scheme-preview-%1s" style="display: %2s; ">%3s %4s %5s %6s</li>' . "\r",
					$slug,
					( plugin()->font_scheme() === $slug ? 'block' : 'none' ),

					// Primary heading preview.
					sprintf(
						'<h2 id="primary-%s" class="primary-sample" style="margin-top: 0; font-family: %s; font-weight: %s; font-size: %s; letter-spacing: %s; font-variant: %s; text-transform: none;">%s</h2>',
						$slug,
						"var( --cfe-fpv--{$slug}--display--font-family )",
						$weight_p,
						"var( --cfe-fpv--{$slug}--primary--font-size, 2rem )",
						$space_p,
						"var( --cfe-fpv--{$slug}--primary--font-variant, normal )",
						lang()->get( 'Primary Heading' )
					),

					// Secondary heading preview.
					sprintf(
						'<h3 id="secondary-%s" class="secondary-sample" style="margin-top: 0; font-family: %s; font-weight: %s; font-size: %s; letter-spacing: %s; font-variant: %s; text-transform: none;">%s</h3>',
						$slug,
						"var( --cfe-fpv--{$slug}--display--font-family )",
						$weight_s,
						"var( --cfe-fpv--{$slug}--secondary--font-size, 1.375rem )",
						$space_s,
						"var( --cfe-fpv--{$slug}--secondary--font-variant, normal )",
						lang()->get( 'Secondary Heading' )
					),

					// General text preview.
					sprintf(
						'<p id="text-%s" class="text-sample" style="margin-top: 0; font-family: %s; font-weight: %s; font-size: %s; letter-spacing: %s;">%s</p>',
						$slug,
						"var( --cfe-fpv--{$slug}--general--family )",
						$weight_t,
						"var( --cfe-fpv--{$slug}--general--font-size, 1rem )",
						$space_t,
						lang()->get( 'Sample paragraph demonstrating the general text.' )
					),

					// Display text preview.
					sprintf(
						'<p><button id="display-%s" class="button btn btn-secondary btn-md display-sample" style="cursor: not-allowed; margin-top: 0; font-family: %s; font-weight: %s; font-size: %s; letter-spacing: %s; font-variant: %s; text-transform: none;">%s</button></p>',
						$slug,
						"var( --cfe-fpv--{$slug}--display--font-family )",
						$weight_d,
						"var( --cfe-fpv--{$slug}--display--font-size, 1rem )",
						$space_d,
						"var( --cfe-fpv--{$slug}--display--font-variant, normal )",
						lang()->get( 'Display Text' )
					)
				);
			} ?>
			</ul>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="wght_text"><?php lang()->p( 'General Text' ); ?></label>
		<div class="col-sm-10 row">

			<p class="text-above-field"><?php lang()->p( 'Font Weight' ); ?></p>
			<div class="form-range-controls">

				<span class="form-range-value rem-range-value"><span id="wght_text_value"><?php echo ( plugin()->wght_text() ? plugin()->wght_text() : plugin()->dbFields['wght_text'] ); ?></span></span>

				<input type="range" class="form-control-range custom-range" onInput="$('#wght_text_value').html($(this).val());$('.text-sample').css('font-weight',$(this).val());" id="wght_text" name="wght_text" value="<?php echo plugin()->wght_text(); ?>" min="<?php echo $current_fonts['text']['min']; ?>" max="<?php echo $current_fonts['text']['max']; ?>" step="<?php echo $current_fonts['text']['step']; ?>" />

				<input type="hidden" id="wght_text_default"  name="wght_text_default" value="<?php echo $current_fonts['text']['weight']; ?>" />

				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#wght_text_value').text($('#wght_text_default').val() );$('#wght_text').val($('#wght_text_default').val());$('.text-sample').css('font-weight', $('#wght_text_default').val());"><?php lang()->p( 'Default' ); ?></span>
			</div>
			<small id="wght_text_desc" class="form-text">
				<?php if ( ! $current_fonts['text']['var'] ) {
					lang()->p( 'This scheme is using a system font stack. Weights may vary by the font deployed by the user device.' );
				} else {
					echo '';
				} ?>
			</small>

			<p class="text-above-field"><?php lang()->p( 'Letter Spacing' ); ?></p>
			<div class="form-range-controls">
				<span class="form-range-value rem-range-value"><span id="space_text_value"><?php echo ( plugin()->space_text() ? plugin()->space_text() : $current_fonts['text']['space'] ); ?></span>em</span>

				<input type="range" class="form-control-range custom-range" onInput="$('#space_text_value').html($(this).val());$('.text-sample').css('letter-spacing',$(this).val()+'em');" id="space_text" name="space_text" value="<?php echo plugin()->space_text(); ?>" min="-0.100" max="0.150" step="0.001" />

				<input type="hidden" id="space_text_default"  name="space_text_default" value="<?php echo $current_fonts['text']['space']; ?>" />

				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#space_text_value').text($('#space_text_default').val() );$('#space_text').val($('#space_text_default').val());$('.text-sample').css('letter-spacing', $('#space_text_default').val()+'em');"><?php lang()->p( 'Default' ); ?></span>
			</div>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="wght_display"><?php lang()->p( 'Display Text' ); ?></label>
		<div class="col-sm-10 row">

			<p class="text-above-field"><?php lang()->p( 'Font Weight' ); ?></p>
			<div class="form-range-controls">
				<span class="form-range-value rem-range-value"><span id="wght_display_value"><?php echo ( plugin()->wght_display() ? plugin()->wght_display() : plugin()->dbFields['wght_display'] ); ?></span></span>

				<input type="range" class="form-control-range custom-range" onInput="$('#wght_display_value').html($(this).val());$('.display-sample').css('font-weight',$(this).val());" id="wght_display" name="wght_display" value="<?php echo plugin()->wght_display(); ?>" min="<?php echo $current_fonts['display']['min']; ?>" max="<?php echo $current_fonts['display']['max']; ?>" step="<?php echo $current_fonts['display']['step']; ?>" />

				<input type="hidden" id="wght_display_default"  name="wght_display_default" value="<?php echo $current_fonts['display']['weight']; ?>" />

				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#wght_display_value').text($('#wght_display_default').val() );$('#wght_display').val($('#wght_display_default').val());$('.display-sample').css('font-weight', $('#wght_display_default').val());"><?php lang()->p( 'Default' ); ?></span>
			</div>
			<small id="wght_display_desc" class="form-text">
				<?php if ( ! $current_fonts['display']['var'] ) {
					lang()->p( 'This scheme is using a system font stack. Weights may vary by the font deployed by the user device.' );
				} else {
					echo '';
				} ?>
			</small>

			<p class="text-above-field"><?php lang()->p( 'Letter Spacing' ); ?></p>
			<div class="form-range-controls">
				<span class="form-range-value rem-range-value"><span id="space_display_value"><?php echo ( plugin()->space_display() ? plugin()->space_display() : $current_fonts['display']['space'] ); ?></span>em</span>

				<input type="range" class="form-control-range custom-range" onInput="$('#space_display_value').html($(this).val());$('.display-sample').css('letter-spacing',$(this).val()+'em');" id="space_display" name="space_display" value="<?php echo plugin()->space_display(); ?>" min="-0.100" max="0.150" step="0.001" />

				<input type="hidden" id="space_display_default"  name="space_display_default" value="<?php echo $current_fonts['display']['space']; ?>" />

				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#space_display_value').text($('#space_display_default').val() );$('#space_display').val($('#space_display_default').val());$('.display-sample').css('letter-spacing', $('#space_display_default').val()+'em');"><?php lang()->p( 'Default' ); ?></span>
			</div>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="wght_primary"><?php lang()->p( 'Primary Headings' ); ?></label>
		<div class="col-sm-10 row">

			<p class="text-above-field"><?php lang()->p( 'Font Weight' ); ?></p>
			<div class="form-range-controls">
				<span class="form-range-value rem-range-value"><span id="wght_primary_value"><?php echo ( plugin()->wght_primary() ? plugin()->wght_primary() : plugin()->dbFields['wght_primary'] ); ?></span></span>

				<input type="range" class="form-control-range custom-range" onInput="$('#wght_primary_value').html($(this).val());$('.primary-sample').css('font-weight',$(this).val());" id="wght_primary" name="wght_primary" value="<?php echo plugin()->wght_primary(); ?>" min="<?php echo $current_fonts['primary']['min']; ?>" max="<?php echo $current_fonts['primary']['max']; ?>" step="<?php echo $current_fonts['primary']['step']; ?>" />

				<input type="hidden" id="wght_primary_default"  name="wght_primary_default" value="<?php echo $current_fonts['primary']['weight']; ?>" />

				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#wght_primary_value').text($('#wght_primary_default').val() );$('#wght_primary').val($('#wght_primary_default').val());$('.primary-sample').css('font-weight', $('#wght_primary_default').val());"><?php lang()->p( 'Default' ); ?></span>
			</div>
			<small id="wght_primary_desc" class="form-text">
				<?php if ( ! $current_fonts['primary']['var'] ) {
					lang()->p( 'This scheme is using a system font stack. Weights may vary by the font deployed by the user device.' );
				} else {
					echo '';
				} ?>
			</small>

			<p class="text-above-field"><?php lang()->p( 'Letter Spacing' ); ?></p>
			<div class="form-range-controls">
				<span class="form-range-value rem-range-value"><span id="space_primary_value"><?php echo ( plugin()->space_primary() ? plugin()->space_primary() : $current_fonts['primary']['space'] ); ?></span>em</span>

				<input type="range" class="form-control-range custom-range" onInput="$('#space_primary_value').html($(this).val());$('.primary-sample').css('letter-spacing',$(this).val()+'em')" id="space_primary" name="space_primary" value="<?php echo plugin()->space_primary(); ?>" min="-0.100" max="0.150" step="0.001" />

				<input type="hidden" id="space_primary_default"  name="space_primary_default" value="<?php echo $current_fonts['primary']['space']; ?>" />

				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#space_primary_value').text($('#space_primary_default').val() );$('#space_primary').val($('#space_primary_default').val());$('.primary-sample').css('letter-spacing', $('#space_primary_default').val()+'em')"><?php lang()->p( 'Default' ); ?></span>
			</div>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="wght_secondary"><?php lang()->p( 'Secondary Headings' ); ?></label>
		<div class="col-sm-10 row">

			<p class="text-above-field"><?php lang()->p( 'Font Weight' ); ?></p>
			<div class="form-range-controls">
				<span class="form-range-value rem-range-value"><span id="wght_secondary_value"><?php echo ( plugin()->wght_secondary() ? plugin()->wght_secondary() : plugin()->dbFields['wght_secondary'] ); ?></span></span>

				<input type="range" class="form-control-range custom-range" onInput="$('#wght_secondary_value').html($(this).val());$('.secondary-sample').css('font-weight',$(this).val());" id="wght_secondary" name="wght_secondary" value="<?php echo plugin()->wght_secondary(); ?>" min="<?php echo $current_fonts['secondary']['min']; ?>" max="<?php echo $current_fonts['secondary']['max']; ?>" step="<?php echo $current_fonts['secondary']['step']; ?>" />

				<input type="hidden" id="wght_secondary_default"  name="wght_secondary_default" value="<?php echo $current_fonts['secondary']['weight']; ?>" />

				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#wght_secondary_value').text($('#wght_secondary_default').val() );$('#wght_secondary').val($('#wght_secondary_default').val());$('.secondary-sample').css('font-weight', $('#wght_secondary_default').val());"><?php lang()->p( 'Default' ); ?></span>
			</div>
			<small id="wght_secondary_desc" class="form-text">
				<?php if ( ! $current_fonts['secondary']['var'] ) {
					lang()->p( 'This scheme is using a system font stack. Weights may vary by the font deployed by the user device.' );
				} else {
					echo '';
				} ?>
			</small>

			<p class="text-above-field"><?php lang()->p( 'Letter Spacing' ); ?></p>
			<div class="form-range-controls">
				<span class="form-range-value rem-range-value"><span id="space_secondary_value"><?php echo ( plugin()->space_secondary() ? plugin()->space_secondary() : $current_fonts['secondary']['space'] ); ?></span>em</span>

				<input type="range" class="form-control-range custom-range" onInput="$('#space_secondary_value').html($(this).val());$('.secondary-sample').css('letter-spacing',$(this).val()+'em')" id="space_secondary" name="space_secondary" value="<?php echo plugin()->space_secondary(); ?>" min="-0.100" max="0.150" step="0.001" />

				<input type="hidden" id="space_secondary_default"  name="space_secondary_default" value="<?php echo $current_fonts['secondary']['space']; ?>" />

				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#space_secondary_value').text($('#space_secondary_default').val() );$('#space_secondary').val($('#space_secondary_default').val());$('.secondary-sample').css('letter-spacing', $('#space_secondary_default').val()+'em')"><?php lang()->p( 'Default' ); ?></span>
			</div>
		</div>
	</div>

	<h3 class="form-heading"><?php lang()->p( 'Backend Interface' ); ?></h3>

	<div class="form-field form-group row">

		<label class="form-label col-sm-2 col-form-label" for="admin_theme"><?php lang()->p( 'Admin Theme' ); ?></label>

		<div class="col-sm-10">
			<select class="form-select" id="admin_theme" name="admin_theme">

				<?php if ( admin_theme() ) : ?>

				<option value="theme" <?php echo ( plugin()->admin_theme() === 'theme' ? 'selected' : '' ); ?>><?php lang()->p( 'Full Theme' ); ?></option>

				<?php endif; ?>

				<option value="css" <?php echo ( plugin()->admin_theme() === 'css' ? 'selected' : '' ); ?>><?php echo $css_label; ?></option>

				<option value="default" <?php echo ( plugin()->admin_theme() === 'default' ? 'selected' : '' ); ?>><?php lang()->p( 'Default Theme' ); ?></option>
			</select>

			<small id="admin-desc-default" class="form-text" style="display: <?php echo ( plugin()->admin_theme() === 'default' ? 'block' : 'none' ); ?>;"><?php lang()->p( 'The default theme option uses the admin theme included with the CMS without any modification. The user toolbar has been styled to match.' ); ?></small>

			<small id="admin-desc-css" class="form-text" style="display: <?php echo ( plugin()->admin_theme() === 'css' ? 'block' : 'none' ); ?>;"><?php lang()->p( 'The theme styles option uses the admin theme included with the CMS for HTML markup and adds Configure 8 styles.' ); ?></small>

			<?php if ( admin_theme() ) : ?>
			<small id="admin-desc-theme" class="form-text" style="display: <?php echo ( plugin()->admin_theme() === 'theme' ? 'block' : 'none' ); ?>;"><?php lang()->p( 'This option edits the site database where your Bludit installation is in <code>bl-content/databases/site.php</code>. It changes the <code>adminTheme</code> setting to <code>configureight</code> to use the Configure 8 admin theme.' ); ?></small>
			<?php endif; ?>

			<?php if ( ! admin_theme() ) :
				printf(
					'<small class="form-text">%s<br /><a href="%s" target="_blank" rel="noopener noreferrer">%s</a></small>',
					lang()->get( 'Download the Configure 8 admin theme for added features:' ),
					plugin()->website(),
					plugin()->website()
				);
			endif; ?>
		</div>
	</div>
</fieldset>

<h3 class="form-heading"><?php lang()->p( 'Custom Code' ); ?></h3>

<fieldset>

	<legend class="screen-reader-text"><?php lang()->p( 'Custom' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="custom_css"><?php lang()->p( 'Frontend Style Block' ); ?></label>
		<div class="col-sm-10">
			<p><small class="form-text"><?php lang()->p( 'This will be printed in the public &lt;head&gt; element, after enqueued stylesheets. CSS code only.' ); ?></small></p>
			<textarea class="code-field" id="custom_css" name="custom_css" placeholder=":root {}" cols="60" rows="10"><?php echo plugin()->custom_css(); ?></textarea>
		</div>
	</div>

	<?php if ( plugin()->admin_theme() ) : ?>
	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="admin_css"><?php lang()->p( 'Backend Style Block' ); ?></label>
		<div class="col-sm-10">
			<p><small class="form-text"><?php lang()->p( 'This will be printed in the admin &lt;head&gt; element, after enqueued stylesheets. CSS code only.' ); ?></small></p>
			<textarea class="code-field" id="admin_css" name="admin_css" placeholder=":root {}" cols="60" rows="10"><?php echo plugin()->admin_css(); ?></textarea>
		</div>
	</div>
	<?php endif; ?>
</fieldset>

<script>
$( function() {
	$( '.delete-background' ).bind( 'click', function() {
		if ( ! confirm( '<?php lang()->p( 'Are you sure you want to delete this image?' ); ?>' ) ) { return; }
		deleteBackground(this);
		$( "#background-images-count" ).load( window.location.href + " #background-images-count > span" );
	});
});

function deleteBackground(el) {
	$.post( background.config.ajaxUrl, {
		tokenCSRF : $( '#jstokenCSRF' ).val(),
		action    : 'deleteImage',
		album     : $(el).data( 'album' ),
		file      : $(el).data( 'file' )
	},
	function() {
		let manage = '#background-image-' + $(el).data( 'number' );
		let select = '#background-select-item-' + $(el).data( 'number' );
		let input  = '#background-select-item-' + $(el).data( 'number' ) + ' input';
		$( manage ).fadeOut( 450, function() {
			$(this).remove();
		} );
		$( select ).hide();
		$( input ).removeAttr( 'checked' );

	}).fail( function() {
		$.alert({
			title   : background.L.error,
			content : background.L.deleteImageError
		});
	});
}
</script>

<script>
jQuery(document).ready( function($) {

	$( '#color_scheme' ).on( 'change', function() {
		var scheme = $(this).val();
		var custom = [
			'bootstrap',
			'tailwind',
			'custom'
		];

		<?php foreach ( $colors as $color => $option ) :

			$slug = $option['slug'];
		?>
		if ( scheme == '<?php echo $slug; ?>' ) {

			if ( 'custom' != scheme ) {
				$( '#custom_scheme_from' ).val( '<?php echo $slug; ?>' );
			}

			$( '#scheme_desc_<?php echo $slug; ?>' ).css( 'display', 'block' );

			// Show scheme thumbnails if not one of the custom schemes.
			if ( $.inArray( scheme, custom ) == -1 ) {
				$( '#light_scheme_label_<?php echo $slug; ?>' ).css( 'display', 'block' );
				$( '#dark_scheme_label_<?php echo $slug; ?>' ).css( 'display', 'block' );
				$( '#extra_scheme_label_<?php echo $slug; ?>' ).css( 'display', 'block' );
				$( '#light_scheme_thumbs_<?php echo $slug; ?>' ).css( 'display', 'flex' );
				$( '#dark_scheme_thumbs_<?php echo $slug; ?>' ).css( 'display', 'flex' );
				$( '#extra_scheme_thumbs_<?php echo $slug; ?>' ).css( 'display', 'flex' );
			}

			// Custom scheme light colors.
			$( '#color_body' ).val( '<?php echo $option['light']['body']; ?>' );
			$( '#color_text' ).val( '<?php echo $option['light']['text']; ?>' );
			$( '#color_one' ).val( '<?php echo $option['light']['one']; ?>' );
			$( '#color_two' ).val( '<?php echo $option['light']['two']; ?>' );
			$( '#color_three' ).val( '<?php echo $option['light']['three']; ?>' );
			$( '#color_four' ).val( '<?php echo $option['light']['four']; ?>' );
			$( '#color_five' ).val( '<?php echo $option['light']['five']; ?>' );
			$( '#color_six' ).val( '<?php echo $option['light']['six']; ?>' );

			$( '#loader_bg_color' ).val( '<?php echo $option['light']['body']; ?>' );
			$( '#loader_text_color' ).val( '<?php echo $option['light']['text']; ?>' );

			$( '#header_bg_color' ).val( '<?php echo $option['light']['body']; ?>' );

			// Custom scheme dark colors.
			$( '#color_body_dark' ).val( '<?php echo $option['dark']['body']; ?>' );
			$( '#color_text_dark' ).val( '<?php echo $option['dark']['text']; ?>' );
			$( '#color_one_dark' ).val( '<?php echo $option['dark']['one']; ?>' );
			$( '#color_two_dark' ).val( '<?php echo $option['dark']['two']; ?>' );
			$( '#color_three_dark' ).val( '<?php echo $option['dark']['three']; ?>' );
			$( '#color_four_dark' ).val( '<?php echo $option['dark']['four']; ?>' );
			$( '#color_five_dark' ).val( '<?php echo $option['dark']['five']; ?>' );
			$( '#color_six_dark' ).val( '<?php echo $option['dark']['six']; ?>' );

			$( '#loader_bg_color_dark' ).val( '<?php echo $option['dark']['body']; ?>' );
			$( '#loader_text_color_dark' ).val( '<?php echo $option['dark']['text']; ?>' );

			$( '#header_bg_color_dark' ).val( '<?php echo $option['dark']['body']; ?>' );

			// Other.
			$( '#cover_blend' ).val( '<?php echo ( isset( $option['media'] ) ? $option['media'] : $option['light']['three'] ); ?>' );
			$( '#cover_text_color' ).val( '<?php echo plugin()->cover_text_default(); ?>' );

		} else {

			// Scheme descriptions, labels, and color thumbnails.
			$( '#scheme_desc_<?php echo $slug; ?>' ).css( 'display', 'none' );
			$( '#light_scheme_label_<?php echo $slug; ?>' ).css( 'display', 'none' );
			$( '#dark_scheme_label_<?php echo $slug; ?>' ).css( 'display', 'none' );
			$( '#extra_scheme_label_<?php echo $slug; ?>' ).css( 'display', 'none' );
			$( '#light_scheme_thumbs_<?php echo $slug; ?>' ).css( 'display', 'none' );
			$( '#dark_scheme_thumbs_<?php echo $slug; ?>' ).css( 'display', 'none' );
			$( '#extra_scheme_thumbs_<?php echo $slug; ?>' ).css( 'display', 'none' );
		}
		<?php endforeach; ?>
	});
});
</script>

<script>
jQuery(document).ready( function($) {

	$( '#font_scheme' ).on( 'change', function() {
		var scheme = $(this).val();

		<?php foreach ( $fonts as $font => $scheme ) : ?>
		if ( scheme == '<?php echo $scheme['slug']; ?>' ) {

			// General text weight.
			$( '#wght_text_default' ).val( '<?php echo $scheme['text']['weight']; ?>' );
			$( '#wght_text_value' ).html( '<?php echo $scheme['text']['weight']; ?>' );
			$( '#wght_text' ).attr( 'min', '<?php echo $scheme['text']['min']; ?>' );
			$( '#wght_text' ).attr( 'max', '<?php echo $scheme['text']['max']; ?>' );
			$( '#wght_text' ).attr( 'step', '<?php echo $scheme['text']['step']; ?>' );
			$( '#wght_text' ).val( '<?php echo $scheme['text']['weight']; ?>' );
			if ( true == '<?php echo $scheme['text']['var']; ?>' ) {
				$( '#wght_text_desc' ).html( '' );
			} else {
				$( '#wght_text_desc' ).html( '<?php lang()->p( 'This scheme is using a system font stack. Weights may vary by the font deployed by the user device.' ); ?>' );
			}

			// General text letter spacing.
			$( '#space_text' ).val( '<?php echo $scheme['text']['space']; ?>' );
			$( '#space_text_default' ).val( '<?php echo $scheme['text']['space']; ?>' );
			$( '#space_text_value' ).html( '<?php echo $scheme['text']['space']; ?>' );

			// Primary headings weight.
			$( '#wght_primary_default' ).val( '<?php echo $scheme['primary']['weight']; ?>' );
			$( '#wght_primary_value' ).html( '<?php echo $scheme['primary']['weight']; ?>' );
			$( '#wght_primary' ).attr( 'min', '<?php echo $scheme['primary']['min']; ?>' );
			$( '#wght_primary' ).attr( 'max', '<?php echo $scheme['primary']['max']; ?>' );
			$( '#wght_primary' ).attr( 'step', '<?php echo $scheme['primary']['step']; ?>' );
			$( '#wght_primary' ).val( '<?php echo $scheme['primary']['weight']; ?>' );
			if ( true == '<?php echo $scheme['primary']['var']; ?>' ) {
				$( '#wght_primary_desc' ).html( '' );
			} else {
				$( '#wght_primary_desc' ).html( '<?php lang()->p( 'This scheme is using a system font stack. Weights may vary by the font deployed by the user device.' ); ?>' );
			}

			// Primary headings letter spacing.
			$( '#space_primary' ).val( '<?php echo $scheme['primary']['space']; ?>' );
			$( '#space_primary_default' ).val( '<?php echo $scheme['primary']['space']; ?>' );
			$( '#space_primary_value' ).html( '<?php echo $scheme['primary']['space']; ?>' );

			// Secondary headings weight.
			$( '#wght_secondary_default' ).val( '<?php echo $scheme['secondary']['weight']; ?>' );
			$( '#wght_secondary_value' ).html( '<?php echo $scheme['secondary']['weight']; ?>' );
			$( '#wght_secondary' ).attr( 'min', '<?php echo $scheme['secondary']['min']; ?>' );
			$( '#wght_secondary' ).attr( 'max', '<?php echo $scheme['secondary']['max']; ?>' );
			$( '#wght_secondary' ).attr( 'step', '<?php echo $scheme['secondary']['step']; ?>' );
			$( '#wght_secondary' ).val( '<?php echo $scheme['secondary']['weight']; ?>' );
			if ( true == '<?php echo $scheme['secondary']['var']; ?>' ) {
				$( '#wght_secondary_desc' ).html( '' );
			} else {
				$( '#wght_secondary_desc' ).html( '<?php lang()->p( 'This scheme is using a system font stack. Weights may vary by the font deployed by the user device.' ); ?>' );
			}

			// Secondary headings letter spacing.
			$( '#space_secondary' ).val( '<?php echo $scheme['secondary']['space']; ?>' );
			$( '#space_secondary_default' ).val( '<?php echo $scheme['secondary']['space']; ?>' );
			$( '#space_secondary_value' ).html( '<?php echo $scheme['secondary']['space']; ?>' );

			// Main navigation weight.
			$( '#wght_display_default' ).val( '<?php echo $scheme['display']['weight']; ?>' );
			$( '#wght_display_value' ).html( '<?php echo $scheme['display']['weight']; ?>' );
			$( '#wght_display' ).attr( 'min', '<?php echo $scheme['display']['min']; ?>' );
			$( '#wght_display' ).attr( 'max', '<?php echo $scheme['display']['max']; ?>' );
			$( '#wght_display' ).attr( 'step', '<?php echo $scheme['display']['step']; ?>' );
			$( '#wght_display' ).val( '<?php echo $scheme['display']['weight']; ?>' );
			if ( true == '<?php echo $scheme['display']['var']; ?>' ) {
				$( '#wght_display_desc' ).html( '' );
			} else {
				$( '#wght_display_desc' ).html( '<?php lang()->p( 'This scheme is using a system font stack. Weights may vary by the font deployed by the user device.' ); ?>' );
			}

			// Main navigation letter spacing.
			$( '#space_display' ).val( '<?php echo $scheme['display']['space']; ?>' );
			$( '#space_display_default' ).val( '<?php echo $scheme['display']['space']; ?>' );
			$( '#space_display_value' ).html( '<?php echo $scheme['display']['space']; ?>' );
		}

		// Scheme preview.
		if ( scheme == '<?php echo $scheme['slug']; ?>' ) {
			$( '#font-scheme-preview-<?php echo $scheme['slug']; ?>' ).css( 'display', 'block' );
			$( '#font-scheme-about-<?php echo $scheme['slug']; ?>' ).css( 'display', 'block' );
		} else {
			$( '#font-scheme-preview-<?php echo $scheme['slug']; ?>' ).css( 'display', 'none' );
			$( '#font-scheme-about-<?php echo $scheme['slug']; ?>' ).css( 'display', 'none' );
		}
		<?php endforeach; ?>
	});
	$( '.display-sample' ).click( function(e) {
		e.preventDefault();
	});
});
</script>
