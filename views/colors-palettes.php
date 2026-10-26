<?php
/**
 * Colors page schemes tab
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @category   Guide page
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Plugin\{
	plugin,
	lang
};
use function CFE_Colors\{
	color_schemes,
	option_schemes_data,
	palette_schemes,
	get_palette,
	hex_to_rgb
};

?>
<hr class="hide-if-js" role="presentation" />

<h2 class="color-heading"><?php lang()->p( 'Color Palettes' ); ?></h2>

<p><?php lang()->p( 'The color scheme option includes many color palettes from which to choose, under the Build You Own category. These color palettes are from various UI kits and design systems which offer their color palettes for free. The majority of the color palettes are quite similar to one another. They are offered for those who may have a favorite palette.' ); ?></p>
<p><?php lang()->p( 'Two of the palettes, Bootstrap UI and Pantone Colors of the Year, have been expanded from single colors to include tints and shades. The Sanzo Wada and CSS Names palettes do not include tints and shades.' ); ?></p>
<p><?php lang()->p( 'When a palette is selected in the color scheme option, only colors from that palette, plus a standard grayscale, are available in the various color picker fields. But the color fields will accept a different color pasted from this reference, so colors from various palettes may be mixed in that manner.' ); ?></p>
<p><?php lang()->p( 'Each palette option begins with blue colors from the palette, in keeping with the default color scheme. Those initial colors are included with each palette in the reference list below.' ); ?></p>
<p><?php lang()->p( 'Click or tap any color swatch to get its hex and rgb codes.' ); ?></p>

<?php
foreach ( option_schemes_data() as $data => $palette ) {
	if ( 'custom' == $palette['slug'] ) {
		continue;
	}
	echo '<div style="margin-top: 1em">';
	echo '<hr />';
	printf(
		'<h3 class="form-heading">%s</h3>',
		$palette['name']
	);
	printf(
		'<p>%s</p>',
		$palette['about']
	);
	printf(
		'<h4 class="form-heading">%s</h4>',
		lang()->get( 'Initial Light Colors' )
	);
	echo '<div class="form-color-thumbs-list"><ul>';
	$count = 1;
	foreach ( $palette['light'] as $colors => $color ) {
		printf(
			'<li style="background-color: %s;" class="color-tooltip" data-tooltip-content="#tooltip-%s-light-%s"><span class="screen-reader-text">%s</span></li>',
			$color,
			$palette['slug'],
			$count,
			$color
		);
		printf(
			'<div style="display: none"><div id="tooltip-%s-light-%s">Hex: %s <br />RGB: %s</div></div>',
			$palette['slug'],
			$count,
			$color,
			hex_to_rgb( $color )
		);
		$count++;
	}
	echo '</ul></div>';
	printf(
		'<h4 class="form-heading">%s</h4>',
		lang()->get( 'Initial Dark Colors' )
	);
	echo '<div class="form-color-thumbs-list"><ul>';
	$count = 1;
	foreach ( $palette['dark'] as $colors => $color ) {
		printf(
			'<li style="background-color: %s;" class="color-tooltip" data-tooltip-content="#tooltip-%s-dark-%s"><span class="screen-reader-text">%s</span></li>',
			$color,
			$palette['slug'],
			$count,
			$color
		);
		printf(
			'<div style="display: none"><div id="tooltip-%s-dark-%s">Hex: %s <br />RGB: %s</div></div>',
			$palette['slug'],
			$count,
			$color,
			hex_to_rgb( $color )
		);
		$count++;
	}
	echo '</ul></div>';

	foreach ( get_palette( $palette['slug'] ) as $colors => $color ) {

		if ( array_key_first( $color ) ) {
			printf(
				'<h4 class="form-heading">%s</h4>',
				$color['label']
			);
		}

		echo '<div class="form-color-thumbs-list"><ul>';

		$slug  = strtolower( str_replace( [ ' ', '(', ')' ], '-', $color['label'] ) );
		$color = array_slice( $color, 1 );
		$count = 1;

		foreach ( $color as $name => $swatch ) {

			printf(
				'<li style="background-color: %s;" class="color-tooltip" data-tooltip-content="#tooltip-%s-%s-%s"><span class="screen-reader-text">%s</span></li>',
				$swatch,
				$palette['slug'],
				$slug,
				$count,
				$swatch
			);
			if ( 'names' == $palette['slug'] ) {
				printf(
					'<div style="display: none"><div id="tooltip-%s-%s-%s">Name: %s <br />Hex: %s</div></div>',
					$palette['slug'],
					$slug,
					$count,
					$name,
					$swatch
				);
			} else {
				printf(
					'<div style="display: none"><div id="tooltip-%s-%s-%s">Hex: %s <br />RGB: %s</div></div>',
					$palette['slug'],
					$slug,
					$count,
					$swatch,
					hex_to_rgb( $swatch )
				);
			}

			$count++;
		}
		echo '</ul></div>';
	}
	echo '</div>';
}
