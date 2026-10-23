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
	get_color_scheme,
	default_color_scheme,
	current_color_scheme,
	color_scheme_category,
	hex_to_rgb
};

$schemes = color_schemes();
$current = current_color_scheme();

?>
<div id="current-scheme">

<?php
printf(
	'<p>%s</p>',
	lang()->get( 'Click or tap any color swatch to its hex and rgb codes.' )
);

printf(
	'<h2 class="color-heading">%s %s</h2>',
	lang()->get( 'Current Scheme:' ),
	$current['name']
);

// Scheme category if not one of the custom schemes.
if (
	isset( $current['category'] ) &&
	! empty( $current['category'] ) &&
	! array_key_exists( $current['slug'], option_schemes_data() )
) :
$scheme_cat = color_scheme_category( $current['category'] );
printf(
	'<p class="current-scheme-cat">%s <a href="#cat-id-%s" class="prev-tab">%s</a></p>',
	lang()->get( 'Category:' ),
	$current['category'],
	$scheme_cat['name']
);
endif;

// Scheme description.
if ( isset( $current['about'] ) && ! empty( $current['about'] ) ) {
	printf(
		'<p>%s</p>',
		$current['about']
	);
}

// Previously set scheme if Custom is the current scheme.
if ( 'custom' == $current['slug'] ) {
	$previous = plugin()->custom_scheme_from();
	$previous = get_color_scheme( $previous );
	if ( is_array( $previous ) ) {
		printf(
			lang()->get( '<p>Previous scheme: <a href="#%s">%s</a>.</p>' ),
			$previous['slug'],
			$previous['name']
		);
	}
}

// Current light color options.
printf(
	'<h3 class="form-heading">%s</h3>',
	lang()->get( 'Light Mode Colors' )
);

echo '<div class="form-color-thumbs-list"><ul>';
foreach ( $current['light'] as $name => $color ) {

	if ( $color ) :
		printf(
			'<li style="background-color: %s;" class="color-tooltip" data-tooltip-content="#tooltip-%s-light-%s"><span class="screen-reader-text">%s</span></li>',
			$color,
			$current['slug'],
			$name,
			$color
		);
		printf(
			'<div style="display: none"><div id="tooltip-%s-light-%s">%s %s <br />Hex: %s <br />RGB: %s</div></div>',
			$current['slug'],
			$name,
			lang()->get( 'Color:' ),
			$name,
			$color,
			hex_to_rgb( $color )
		);
	endif;
}
echo '</ul></div>';

// Current dark color options.
printf(
	'<h3 class="form-heading">%s</h3>',
	lang()->get( 'Dark Mode Colors' )
);

echo '<div class="form-color-thumbs-list"><ul>';
foreach ( $current['dark'] as $name => $color ) {

	if ( $color ) :
		printf(
			'<li style="background-color: %s;" class="color-tooltip" data-tooltip-content="#tooltip-%s-dark-%s"><span class="screen-reader-text">%s</span></li>',
			$color,
			$current['slug'],
			$name,
			$color
		);
		printf(
			'<div style="display: none"><div id="tooltip-%s-dark-%s">%s %s <br />Hex: %s <br />RGB: %s</div></div>',
			$current['slug'],
			$name,
			lang()->get( 'Color:' ),
			$name,
			$color,
			hex_to_rgb( $color )
		);
	endif;
}
echo '</ul></div>';
?>

<?php

// Copy custom colors as text.
if ( 'custom' == plugin()->color_scheme() ) :
echo '<hr />';
printf(
	'<h3 class="form-heading" style="text-transform: none;">%s</h3>',
	lang()->get( 'Copy custom colors for your records' )
);
printf(
	'<p>%s</p>',
	lang()->get( 'Formatted as SCSS/SASS maps.' )
);

echo '<pre lang="css" class="language-css" data-language="css">' . "\r";
echo '$light: (' . "\r";
foreach ( $current['light'] as $name => $color ) {
	echo "	&#39;{$name}&#39;: &#39;{$color}&#39;,". "\r";
}
echo ')' . "\r";

echo '$dark: (' . "\r";
foreach ( $current['dark'] as $name => $color ) {
	echo "	&#39;{$name}&#39;: &#39;{$color}&#39;,". "\r";
}
echo ')' . "\r";
echo '</pre>';
endif;

/**
 * List color schemes
 *
 * @since 1.0.0
 *
 * Display color information and swatches for every
 * color scheme except for the custom schemes.
 */
foreach ( $schemes as $scheme => $option ) {

	// Skip current theme.
	if ( plugin()->color_scheme() == $option['slug'] ) {
		continue;
	}

	// Skip custom schemes.
	if ( array_key_exists( $option['slug'], option_schemes_data() ) ) {
		continue;
	}

	// Get scheme category data.
	$scheme_cat = color_scheme_category( $option['category'] );

	echo '<hr />';
	printf(
		'<h2 id="%s" class="color-heading">%s %s</h2>',
		$option['slug'],
		lang()->get( 'Scheme:' ),
		$option['name']
	);
	printf(
		'<p class="color-scheme-list-cat">%s <a href="#cat-id-%s" class="prev-tab">%s</a></p>',
		lang()->get( 'Category:' ),
		$option['category'],
		$scheme_cat['name']
	);
	if ( isset( $option['about'] ) && ! empty( $option['about'] ) ) {
		printf(
			'<p>%s</p>',
			$option['about']
		);
	}

	// Scheme light mode colors.
	printf(
		'<h3 class="form-heading">%s</h3>',
		lang()->get( 'Light Mode Colors' )
	);

	echo '<div class="form-color-thumbs-list"><ul>';
	foreach ( $option['light'] as $name => $color ) {

		if ( $color ) :
			printf(
				'<li style="background-color: %s;" class="color-tooltip" data-tooltip-content="#tooltip-%s-light-%s"><span class="screen-reader-text">%s</span></li>',
				$color,
				$option['slug'],
				$name,
				$color
			);
			printf(
				'<div style="display: none"><div id="tooltip-%s-light-%s">%s %s <br />Hex: %s <br />RGB: %s</div></div>',
				$option['slug'],
				$name,
				lang()->get( 'Color:' ),
				$name,
				$color,
				hex_to_rgb( $color )
			);
		endif;
	}
	echo '</ul></div>';

	// Scheme dark mode colors.
	printf(
		'<h3 class="form-heading">%s</h3>',
		lang()->get( 'Dark Mode Colors' )
	);

	echo '<div class="form-color-thumbs-list"><ul>';
	foreach ( $option['dark'] as $name => $color ) {

		if ( $color ) :
			printf(
				'<li style="background-color: %s;" class="color-tooltip" data-tooltip-content="#tooltip-%s-dark-%s"><span class="screen-reader-text">%s</span></li>',
				$color,
				$option['slug'],
				$name,
				$color
			);
			printf(
				'<div style="display: none"><div id="tooltip-%s-dark-%s">%s %s <br />Hex: %s <br />RGB: %s</div></div>',
				$option['slug'],
				$name,
				lang()->get( 'Color:' ),
				$name,
				$color,
				hex_to_rgb( $color )
			);
		endif;
	}
	echo '</ul></div>';
} ?>

</div>
