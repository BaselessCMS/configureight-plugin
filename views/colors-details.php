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
	custom_schemes,
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
	'<h2 class="color-heading">%s %s</h2>',
	lang()->get( 'Current Scheme:' ),
	$current['name']
);

// Scheme category if not one of the custom schemes.
if (
	isset( $current['category'] ) &&
	! empty( $current['category'] ) &&
	! in_array( $current['slug'], custom_schemes() )
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
printf(
	'<p>%s</p>',
	lang()->get( 'The following color information comes from the database, as set in the individual custom color pickers.' )
);

// Current light color options.
printf(
	'<h3 class="color-list-heading">%s</h3>',
	lang()->get( 'Light Mode Colors' )
);

echo '<ul class="color-list color-list-light">';
foreach ( $current['light'] as $name => $color ) {

	if ( $color ) :
		echo '<li><ul class="color-list color-list-light">';
		printf(
			'<li><span class="color-list-label">%s hex:</span> <code class="select">%s</code></li>',
			ucwords( $name ),
			$color
		);
		printf(
			'<li><span class="color-list-label">%s rgb:</span> <code class="select">%s</code></li>',
			ucwords( $name ),
			hex_to_rgb( $color )
		);
		printf(
			'<li><span class="color-list-label">%s</span> <span class="color-list-preview" style="background-color: %s;"><span class="screen-reader-text">%s</span></span></li>',
			lang()->get( 'Preview:' ),
			$color,
			$color
		);
		echo '</ul></li>';
	endif;
}
echo '</ul>';

// Current dark color options.
printf(
	'<h3 class="color-list-heading">%s</h3>',
	lang()->get( 'Dark Mode Colors' )
);

echo '<ul class="color-list color-list-dark">';
foreach ( $current['dark'] as $name => $color ) {

	if ( $color ) :
		echo '<li><ul class="color-list color-list-dark">';
		printf(
			'<li><span class="color-list-label">%s hex:</span> <code class="select">%s</code></li>',
			ucwords( $name ),
			$color
		);
		printf(
			'<li><span class="color-list-label">%s rgb:</span> <code class="select">%s</code></li>',
			ucwords( $name ),
			hex_to_rgb( $color )
		);
		printf(
			'<li><span class="color-list-label">%s</span> <span class="color-list-preview" style="background-color: %s;"><span class="screen-reader-text">%s</span></span></li>',
			lang()->get( 'Preview:' ),
			$color,
			$color
		);
		echo '</ul></li>';
	endif;
}
echo '</ul>';
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
	if ( in_array( $option['slug'], custom_schemes() ) ) {
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
		'<h3 class="color-list-heading">%s</h3>',
		lang()->get( 'Light Mode Colors' )
	);

	echo '<ul class="color-list color-list-light">';
	foreach ( $option['light'] as $color => $value ) {

		if ( $value ) :
			echo '<li><ul class="color-list color-list-light">';
			printf(
				'<li><span class="color-list-label">%s hex:</span> <code class="select">%s</code></li>',
				ucwords( $color ),
				$value
			);
			printf(
				'<li><span class="color-list-label">%s rgb:</span> <code class="select">%s</code></li>',
				ucwords( $color ),
				hex_to_rgb( $value )
			);
			printf(
				'<li><span class="color-list-label">%s</span> <span class="color-list-preview" style="background-color: %s;"><span class="screen-reader-text">%s</span></span></li>',
				lang()->get( 'Preview:' ),
				$value,
				$value
			);
			echo '</ul></li>';
		endif;
	}
	echo '</ul>';

	// Scheme dark mode colors.
	printf(
		'<h3 class="color-list-heading">%s</h3>',
		lang()->get( 'Dark Mode Colors' )
	);

	echo '<ul class="color-list color-list-dark">';
	foreach ( $option['dark'] as $color => $value ) {

		if ( $value ) :
			echo '<li><ul class="color-list color-list-dark">';
			printf(
				'<li><span class="color-list-label">%s hex:</span> <code class="select">%s</code></li>',
				ucwords( $color ),
				$value
			);
			printf(
				'<li><span class="color-list-label">%s rgb:</span> <code class="select">%s</code></li>',
				ucwords( $color ),
				hex_to_rgb( $value )
			);
			printf(
				'<li><span class="color-list-label">%s</span> <span class="color-list-preview" style="background-color: %s;"><span class="screen-reader-text">%s</span></span></li>',
				lang()->get( 'Preview:' ),
				$value,
				$value
			);
			echo '</ul></li>';
		endif;
	}
	echo '</ul>';
} ?>

</div>
