<?php
/**
 * Custom colors fields
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

?>
<div id="custom_color_scheme_fields" style="display: <?php echo ( plugin()->getValue( 'color_scheme' ) === 'custom' ? 'block' : 'none' ); ?>;">

	<h3 class="form-heading"><?php lang()->p( 'Custom Colors' ); ?></h3>

	<p><?php lang()->p( 'Custom colors will override colors for basic elements in the default light and dark color schemes. If you wish to use these colors for further customization then a CSS variable is provided for each color. Simply add your CSS rules with these variables to the custom code fields below.' ); ?></p>

	<p><?php lang()->p( "Current custom colors originate from the previously set theme: <strong>{$colors[$custom_from]['name']}</strong>" ); ?></p>

	<ul id="form-color-thumbs-list">
	<?php
	foreach ( $colors as $color => $option ) {

		if ( plugin()->getValue( 'custom_scheme_from' ) === $option['slug'] ) {
			$display = 'flex';
		} else {
			$display = 'none';
		}

		printf(
			'<li id="light_scheme_label_%s" style="margin-top: 1em; display: %s;">%s %s</li>',
			$option['slug'],
			$display,
			$option['name'],
			lang()->get( 'light mode colors:' )
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
					'<li id="%s_original_%s" class="form-tooltip" style="background-color: %s" title="%s"><span class="screen-reader-text">%s</span></li>',
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
			'<li id="dark_scheme_label_%s" style="margin-top: 1em; display: %s;">%s %s</li>',
			$option['slug'],
			$display,
			$option['name'],
			lang()->get( 'dark mode colors:' )
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
					'<li id="%s_original_%s_dark" class="form-tooltip" style="background-color: %s" title="%s"><span class="screen-reader-text">%s</span></li>',
					$option['slug'],
					$count,
					$thumb,
					$thumb,
					$thumb
				);
			}
		}
		echo '</ul>';
	} ?>
	</ul>

	<div class="tab-content hide-if-no-js" data-toggle="tabslet" data-deeplinking="false" data-animation="true">

		<ul class="nav nav-tabs" id="nav-tabs" role="tablist">
			<li class="nav-item">
				<a class="nav-link" role="tab" aria-controls="light-colors" aria-selected="false" href="#light-colors"><?php lang()->p( 'Light' ); ?></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" role="tab" aria-controls="dark-colors" aria-selected="false" href="#dark-colors"><?php lang()->p( 'Dark' ); ?></a>
			</li>
		</ul>

		<div id="light-colors">

			<p><?php lang()->p( 'These colors are used with default browser/device settings and when the user/device prefers a light color scheme.' ); ?></p>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="color_body"><?php lang()->p( 'Body Color' ); ?></label>
				<div class="col-sm-10">
					<div class="row color-picker-wrap">
						<input class="color-picker custom-color" id="color_body" name="color_body" value="<?php echo plugin()->getValue( 'color_body' ); ?>" />
						<input id="color_body_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['light']['body']; ?>" />
						<span class="btn btn-secondary btn-md hide-if-no-js" id="color_body_default_button"><?php lang()->p( 'Reset' ); ?></span>
					</div>
					<small class="form-text"><?php lang()->p( 'CSS variable: <code class="select">--cfe-scheme-color--body</code>' ); ?></small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="color_text"><?php lang()->p( 'Text Color' ); ?></label>
				<div class="col-sm-10">
					<div class="row color-picker-wrap">
						<input class="color-picker custom-color" id="color_text" name="color_text" value="<?php echo plugin()->getValue( 'color_text' ); ?>" />
						<input id="color_text_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['light']['text']; ?>" />
						<span class="btn btn-secondary btn-md hide-if-no-js" id="color_text_default_button"><?php lang()->p( 'Reset' ); ?></span>
					</div>
					<small class="form-text"><?php lang()->p( 'CSS variable: <code class="select">--cfe-scheme-color--text</code>' ); ?></small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="color_one"><?php lang()->p( 'Color One' ); ?></label>
				<div class="col-sm-10">
					<div class="row color-picker-wrap">
						<input class="color-picker custom-color" id="color_one" name="color_one" value="<?php echo plugin()->getValue( 'color_one' ); ?>" />
						<input id="color_one_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['light']['one']; ?>" />
						<span class="btn btn-secondary btn-md hide-if-no-js" id="color_one_default_button"><?php lang()->p( 'Reset' ); ?></span>
					</div>
					<small class="form-text"><?php lang()->p( 'CSS variable: <code class="select">--cfe-scheme-color--one</code>' ); ?></small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="color_two"><?php lang()->p( 'Color Two' ); ?></label>
				<div class="col-sm-10">
					<div class="row color-picker-wrap">
						<input class="color-picker custom-color" id="color_two" name="color_two" value="<?php echo plugin()->getValue( 'color_two' ); ?>" />
						<input id="color_two_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['light']['two']; ?>" />
						<span class="btn btn-secondary btn-md hide-if-no-js" id="color_two_default_button"><?php lang()->p( 'Reset' ); ?></span>
					</div>
					<small class="form-text"><?php lang()->p( 'CSS variable: <code class="select">--cfe-scheme-color--two</code>' ); ?></small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="color_three"><?php lang()->p( 'Color Three' ); ?></label>
				<div class="col-sm-10">
					<div class="row color-picker-wrap">
						<input class="color-picker custom-color" id="color_three" name="color_three" value="<?php echo plugin()->getValue( 'color_three' ); ?>" />
						<input id="color_three_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['light']['three']; ?>" />
						<span class="btn btn-secondary btn-md hide-if-no-js" id="color_three_default_button"><?php lang()->p( 'Reset' ); ?></span>
					</div>
					<small class="form-text"><?php lang()->p( 'CSS variable: <code class="select">--cfe-scheme-color--three</code>' ); ?></small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="color_four"><?php lang()->p( 'Color Four' ); ?></label>
				<div class="col-sm-10">
					<div class="row color-picker-wrap">
						<input class="color-picker custom-color" id="color_four" name="color_four" value="<?php echo plugin()->getValue( 'color_four' ); ?>" />
						<input id="color_four_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['light']['four']; ?>" />
						<span class="btn btn-secondary btn-md hide-if-no-js" id="color_four_default_button"><?php lang()->p( 'Reset' ); ?></span>
					</div>
					<small class="form-text"><?php lang()->p( 'CSS variable: <code class="select">--cfe-scheme-color--four</code>' ); ?></small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="color_five"><?php lang()->p( 'Color Five' ); ?></label>
				<div class="col-sm-10">
					<div class="row color-picker-wrap">
						<input class="color-picker custom-color" id="color_five" name="color_five" value="<?php echo plugin()->getValue( 'color_five' ); ?>" />
						<input id="color_five_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['light']['five']; ?>" />
						<span class="btn btn-secondary btn-md hide-if-no-js" id="color_five_default_button"><?php lang()->p( 'Reset' ); ?></span>
					</div>
					<small class="form-text"><?php lang()->p( 'CSS variable: <code class="select">--cfe-scheme-color--five</code>' ); ?></small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="color_six"><?php lang()->p( 'Color Six' ); ?></label>
				<div class="col-sm-10">
					<div class="row color-picker-wrap">
						<input class="color-picker custom-color" id="color_six" name="color_six" value="<?php echo plugin()->getValue( 'color_six' ); ?>" />
						<input id="color_six_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['light']['six']; ?>" />
						<span class="btn btn-secondary btn-md hide-if-no-js" id="color_six_default_button"><?php lang()->p( 'Reset' ); ?></span>
					</div>
					<small class="form-text"><?php lang()->p( 'CSS variable: <code class="select">--cfe-scheme-color--six</code>' ); ?></small>
				</div>
			</div>
		</div>

		<div id="dark-colors">

			<p><?php lang()->p( 'These colors are used when the user/device prefers a dark color scheme.' ); ?></p>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="color_body_dark"><?php lang()->p( 'Dark Body Color' ); ?></label>
				<div class="col-sm-10">
					<div class="row color-picker-wrap">
						<input class="color-picker custom-color" id="color_body_dark" name="color_body_dark" value="<?php echo plugin()->getValue( 'color_body_dark' ); ?>" />
						<input id="color_body_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['dark']['body']; ?>" />
						<span class="btn btn-secondary btn-md hide-if-no-js" id="color_body_dark_default_button"><?php lang()->p( 'Reset' ); ?></span>
					</div>
					<small class="form-text"><?php lang()->p( 'CSS variable: <code class="select">--cfe-scheme-color--body--dark</code>' ); ?></small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="color_text_dark"><?php lang()->p( 'Dark Text Color' ); ?></label>
				<div class="col-sm-10">
					<div class="row color-picker-wrap">
						<input class="color-picker custom-color" id="color_text_dark" name="color_text_dark" value="<?php echo plugin()->getValue( 'color_text_dark' ); ?>" />
						<input id="color_text_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['dark']['text']; ?>" />
						<span class="btn btn-secondary btn-md hide-if-no-js" id="color_text_dark_default_button"><?php lang()->p( 'Reset' ); ?></span>
					</div>
					<small class="form-text"><?php lang()->p( 'CSS variable: <code class="select">--cfe-scheme-color--text--dark</code>' ); ?></small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="color_one_dark"><?php lang()->p( 'Dark Color One' ); ?></label>
				<div class="col-sm-10">
					<div class="row color-picker-wrap">
						<input class="color-picker custom-color" id="color_one_dark" name="color_one_dark" value="<?php echo plugin()->getValue( 'color_one_dark' ); ?>" />
						<input id="color_one_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['dark']['one']; ?>" />
						<span class="btn btn-secondary btn-md hide-if-no-js" id="color_one_dark_default_button"><?php lang()->p( 'Reset' ); ?></span>
					</div>
					<small class="form-text"><?php lang()->p( 'CSS variable: <code class="select">--cfe-scheme-color--one--dark</code>' ); ?></small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="color_two_dark"><?php lang()->p( 'Dark Color Two' ); ?></label>
				<div class="col-sm-10">
					<div class="row color-picker-wrap">
						<input class="color-picker custom-color" id="color_two_dark" name="color_two_dark" value="<?php echo plugin()->getValue( 'color_two_dark' ); ?>" />
						<input id="color_two_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['dark']['two']; ?>" />
						<span class="btn btn-secondary btn-md hide-if-no-js" id="color_two_dark_default_button"><?php lang()->p( 'Reset' ); ?></span>
					</div>
					<small class="form-text"><?php lang()->p( 'CSS variable: <code class="select">--cfe-scheme-color--two--dark</code>' ); ?></small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="color_three_dark"><?php lang()->p( 'Dark Color Three' ); ?></label>
				<div class="col-sm-10">
					<div class="row color-picker-wrap">
						<input class="color-picker custom-color" id="color_three_dark" name="color_three_dark" value="<?php echo plugin()->getValue( 'color_three_dark' ); ?>" />
						<input id="color_three_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['dark']['three']; ?>" />
						<span class="btn btn-secondary btn-md hide-if-no-js" id="color_three_dark_default_button"><?php lang()->p( 'Reset' ); ?></span>
					</div>
					<small class="form-text"><?php lang()->p( 'CSS variable: <code class="select">--cfe-scheme-color--three--dark</code>' ); ?></small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="color_four_dark"><?php lang()->p( 'Dark Color Four' ); ?></label>
				<div class="col-sm-10">
					<div class="row color-picker-wrap">
						<input class="color-picker custom-color" id="color_four_dark" name="color_four_dark" value="<?php echo plugin()->getValue( 'color_four_dark' ); ?>" />
						<input id="color_four_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['dark']['four']; ?>" />
						<span class="btn btn-secondary btn-md hide-if-no-js" id="color_four_dark_default_button"><?php lang()->p( 'Reset' ); ?></span>
					</div>
					<small class="form-text"><?php lang()->p( 'CSS variable: <code class="select">--cfe-scheme-color--four--dark</code>' ); ?></small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="color_five_dark"><?php lang()->p( 'Dark Color Five' ); ?></label>
				<div class="col-sm-10">
					<div class="row color-picker-wrap">
						<input class="color-picker custom-color" id="color_five_dark" name="color_five_dark" value="<?php echo plugin()->getValue( 'color_five_dark' ); ?>" />
						<input id="color_five_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['dark']['five']; ?>" />
						<span class="btn btn-secondary btn-md hide-if-no-js" id="color_five_dark_default_button"><?php lang()->p( 'Reset' ); ?></span>
					</div>
					<small class="form-text"><?php lang()->p( 'CSS variable: <code class="select">--cfe-scheme-color--five--dark</code>' ); ?></small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="color_six_dark"><?php lang()->p( 'Dark Color Six' ); ?></label>
				<div class="col-sm-10">
					<div class="row color-picker-wrap">
						<input class="color-picker custom-color" id="color_six_dark" name="color_six_dark" value="<?php echo plugin()->getValue( 'color_six_dark' ); ?>" />
						<input id="color_six_dark_default" class="screen-reader-text" type="hidden" value="<?php echo $colors[$custom_from]['dark']['six']; ?>" />
						<span class="btn btn-secondary btn-md hide-if-no-js" id="color_six_dark_default_button"><?php lang()->p( 'Reset' ); ?></span>
					</div>
					<small class="form-text"><?php lang()->p( 'CSS variable: <code class="select">--cfe-scheme-color--six--dark</code>' ); ?></small>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
jQuery(document).ready( function($) {

	$( '#color_scheme' ).on( 'change', function() {
		var scheme = $(this).val();

		<?php foreach ( $colors as $color => $option ) :

			$slug = $option['slug'];
		?>
		if (
			'bootstrap' == scheme ||
			'tailwind' == scheme ||
			'custom' == scheme
		) {

			if ( 'custom' != scheme ) {
				$( '#custom_scheme_from' ).val( 'default' );
			}

			// Scheme descriptions, labels, and color thumbnails.
			if ( 'custom' == scheme ) {
				$( '#scheme_desc_<?php echo $option['slug']; ?>' ).css( 'display', 'none' );
			} else if ( scheme == '<?php echo $slug; ?>' ) {
				$( '#scheme_desc_<?php echo $slug; ?>' ).css( 'display', 'block' );
			}
			$( '#light_scheme_label_<?php echo $option['slug']; ?>' ).css( 'display', 'none' );
			$( '#dark_scheme_label_<?php echo $option['slug']; ?>' ).css( 'display', 'none' );
			$( '#light_scheme_thumbs_<?php echo $option['slug']; ?>' ).css( 'display', 'none' );
			$( '#dark_scheme_thumbs_<?php echo $option['slug']; ?>' ).css( 'display', 'none' );

		} else if ( scheme == '<?php echo $slug; ?>' ) {

			if ( 'custom' != scheme ) {
				$( '#custom_scheme_from' ).val( '<?php echo $slug; ?>' );
			}

			// Custom scheme descriptions, labels, and color thumbnails.
			$( '#scheme_desc_<?php echo $slug; ?>' ).css( 'display', 'block' );
			$( '#light_scheme_label_<?php echo $slug; ?>' ).css( 'display', 'block' );
			$( '#dark_scheme_label_<?php echo $slug; ?>' ).css( 'display', 'block' );
			$( '#light_scheme_thumbs_<?php echo $slug; ?>' ).css( 'display', 'flex' );
			$( '#dark_scheme_thumbs_<?php echo $slug; ?>' ).css( 'display', 'flex' );

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

			if ( 'default' != scheme ) {
				$( '#cover_blend' ).val( '<?php echo ( isset( $option['cover'] ) ? $option['cover'] : $option['light']['three'] ); ?>' );
			} else {
				$( '#cover_blend' ).val( '<?php echo plugin()->dbFields['cover_blend']; ?>' );
			}

		} else {

			// Scheme descriptions, labels, and color thumbnails.
			$( '#scheme_desc_<?php echo $option['slug']; ?>' ).css( 'display', 'none' );
			$( '#light_scheme_label_<?php echo $option['slug']; ?>' ).css( 'display', 'none' );
			$( '#dark_scheme_label_<?php echo $option['slug']; ?>' ).css( 'display', 'none' );
			$( '#light_scheme_thumbs_<?php echo $option['slug']; ?>' ).css( 'display', 'none' );
			$( '#dark_scheme_thumbs_<?php echo $option['slug']; ?>' ).css( 'display', 'none' );
		}
		<?php endforeach; ?>
	});
});
</script>
