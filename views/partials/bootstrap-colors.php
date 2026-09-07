<?php
/**
 * Bootstrap colors fields
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
<div id="bootstrap_color_scheme_fields" style="display: <?php echo ( plugin()->getValue( 'color_scheme' ) === 'bootstrap' ? 'block' : 'none' ); ?>;">

	<h3 class="form-heading"><?php lang()->p( 'Custom Colors' ); ?></h3>

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
