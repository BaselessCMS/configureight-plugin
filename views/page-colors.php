<?php
/**
 * Color Scheme Reference page
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @category   Guide page
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Colors\{
	color_schemes,
	custom_schemes,
	get_color_scheme,
	default_color_scheme,
	current_color_scheme,
	color_scheme_category,
	hex_to_rgb
};
use function CFE_Plugin\{
	plugin,
	site,
	lang
};

$schemes = color_schemes();
$default = default_color_scheme();
$current = current_color_scheme();

// Guide page URL.
$guide_page = DOMAIN_ADMIN . 'plugin/' . plugin()->className();

// Settings page URL.
$settings_page = DOMAIN_ADMIN . 'configure-plugin/' . plugin()->className();

?>

<style>
.color-heading {
	margin: 1rem 0 0 0 !important;
	font-size: var( --cfe-admin--color-heading--font-size, 1.625rem );
}
.color-list-heading {
	margin: 1rem 0 0 0 !important;
	font-size: var( --cfe-admin--color-list-heading--font-size, 1.25rem );
}
.color-list {
	list-style: var( --cfe-admin--color-list--list-style, none );
	margin: 1rem 0 0 0 !important;
	padding: 0 !important;
}
.color-list li {
	line-height: var( --cfe-admin--color-list--item--line-height, 1.3 );
}
.color-list-label {
	font-weight: var( --cfe-admin--color-list-value--font-weight, 600 );
}
.color-list-preview {
	display: inline-block;
	vertical-align: middle;
	width: 6rem;
	height: 1em;
	border: var( --cfe-form-element--border );
}
pre {
	user-select: all;
	cursor: pointer;
	max-width: 720px;
	margin: 1rem 0;
	white-space: pre-wrap;
}
code.select {
	cursor: pointer;
}
</style>

<h1 class="page-title"><span class="page-title-icon fa fa-eyedropper"></span><span class="page-title-text"><?php lang()->p( 'Color Schemes Reference' ); ?></span></h1>

<p class="page-description"><?php lang()->p( "Go to the <a href='{$guide_page}'>options guide</a> page. Go to the <a href='{$settings_page}#style'>website options</a> page." ); ?></p>

<?php
printf(
	'<h2 class="color-heading">%s <a class="reference-link form-tooltip" href="http://developer.mozilla.org/en-US/docs/Web/CSS/Using_CSS_custom_properties" target="_blank" rel="noopener noreferrer" title="%s"><span class="fa fa-external-link-square"></span><span class="screen-reader-text">%s</span></a></h2>',
	lang()->get( 'Custom Properties (CSS Variables)' ),
	lang()->get( 'Reference on the Mozilla website' ),
	lang()->get( 'Reference on the Mozilla website' )
);

printf(
	'<p>%s</p>',
	lang()->get( 'The CSS color properties are used universally in the public theme and the admin theme for each color scheme. These properties are redefined in the <code>head</code> section by the various options. The <code>--cfe-</code> prefix refers to the Configure 8 theme.' )
);
printf(
	'<p>%s</p>',
	lang()->get( 'To redefine these properties, simply copy the property and paste it into the relevant custom CSS field, under the <code>:root</code> selector, with its new color.' )
);
printf(
	'<p><span class="color-list-label">%s</span> <code>:root{ --cfe-scheme-color--one: #ffcc00; }</code></p>',
	lang()->get( 'Example:' )
);
printf(
	'<p>%s</p>',
	lang()->get( 'To use these properties as a value for an element, ID, or class, simply copy the property and paste it into the relevant custom CSS field following a selector.' )
);
printf(
	'<p><span class="color-list-label">%s</span> <code>.div-class a { color: var( --cfe-scheme-color--three ); }</code></p>',
	lang()->get( 'Example:' )
);

printf(
	'<h3 class="color-list-heading">%s</h3>',
	lang()->get( 'Light Mode Variables' )
);

echo '<ul class="color-list color-list-light">';
foreach ( $default['light'] as $name => $color ) {
	printf(
		'<li><span class="color-list-label">%s %s</span> <code class="select">%s</code></li>',
		ucwords( $name ),
		lang()->get( 'variable:' ),
		"--cfe-scheme-color--{$name}"
	);
}

printf(
	'<h3 class="color-list-heading">%s</h3>',
	lang()->get( 'Dark Mode Variables' )
);

echo '<ul class="color-list color-list-dark">';
foreach ( $default['dark'] as $name => $color ) {
	printf(
		'<li><span class="color-list-label">%s %s</span> <code class="select">%s</code></li>',
		ucwords( $name ),
		lang()->get( 'variable:' ),
		"--cfe-scheme-color--{$name}--dark"
	);
}

/**
 * Color scheme slugs
 *
 * @since 1.0.0
 *
 * Print a slug for each of the plugin color schemes,
 * except for the custom schemes. Slugs can be used
 * in page templates for using a scheme per page.
 */
echo '<hr />';
printf(
	'<h2 class="color-heading">%s</h2>',
	lang()->get( 'Scheme Slugs' )
);
printf(
	'<p>%s</p>',
	lang()->get( 'Color scheme page/post templates require use of the scheme slug. To apply a color scheme template use the name <code>color-scheme-$slug</code> where <code>$slug</code> is one of the color scheme slugs listed below.' )
);
printf(
	'<p><span class="color-list-label">%s</span> %s</p>',
	lang()->get( 'Example:' ),
	lang()->get( 'the template <code>color-scheme-forest</code> will apply the Forest color scheme to that page or post.' )
);
printf(
	'<p>%s</p>',
	lang()->get( 'Slugs can also be used in the <code>get_color_scheme( $slug )</code> function to get an array of data about the scheme.' )
);

// Sort schemes by category.
usort( $schemes, function( $one_thing, $another ) {
	return strcmp( $one_thing['category'], $another['category'] );
} );

// Category used for option groups.
$category = '';

echo '<ul id="schemes-list" class="color-list">';
foreach ( $schemes as $scheme => $option ) {

	// Skip custom schemes.
	if ( in_array( $option['slug'], custom_schemes() ) ) {
		continue;
	}

	$slug = $option['slug'];
	if ( $current['slug'] == $slug ) {
		$slug = 'current-scheme';
	}
	$scheme_cat = color_scheme_category( $option['category'] );

	if ( $category != $option['category'] ) {
		printf(
			'<li id="cat-id-%s" style="margin: var( --cfe-element--margin, calc( var( --cfe-spacing--vert, 2rem ) / 2 ) 0 );"><hr /><h3 style="margin: 0;">%s</h3></li>',
			$option['category'],
			$scheme_cat['name']
		);
		if ( isset( $scheme_cat ) && array_key_exists( 'about', $scheme_cat ) && ! empty( $scheme_cat['about'] ) ) {
			printf(
				'<li class="color-scheme-list-cat-desc" style="margin: var( --cfe-element--margin, calc( var( --cfe-spacing--vert, 2rem ) / 2 ) 0 );"><p>%s</p></li>',
				$scheme_cat['about']
			);
		}
	}
	printf(
		'<li><span class="color-list-label"><a href="#%s">%s</a>:</span> <code class="select">%s</code></li>',
		$slug,
		$option['name'],
		$slug
	);
	$category = $option['category'];
}
echo '</ul>';

/**
 * Current color scheme
 *
 * @since 1.0.0
 *
 * Prints information about the color scheme currently set
 * on the options page. If one of the custom color schemes
 * is set then color info comes from the database, as set
 * in the individual color pickers.
 */
if ( false !== $current ) :

echo '<hr />';
echo '<div id="current-scheme">';
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
	'<p class="current-scheme-cat">%s <a href="#cat-id-%s">%s</a></p>',
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
echo '</ul></div>';

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

// If current exists.
endif;

// List color schemes.
foreach ( $schemes as $scheme => $option ) {

	// Skip current theme.
	if ( plugin()->color_scheme() == $option['slug'] ) {
		continue;
	}

	// Skip custom schemes.
	if ( in_array( $option['slug'], custom_schemes() ) ) {
		continue;
	}

	$scheme_cat = color_scheme_category( $option['category'] );

	echo '<hr />';

	printf(
		'<h2 id="%s" class="color-heading">%s %s</h2>',
		$option['slug'],
		lang()->get( 'Scheme:' ),
		$option['name']
	);

	printf(
		'<p class="color-scheme-list-cat">%s <a href="#cat-id-%s">%s</a></p>',
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

<script>
jQuery(document).ready( function($) {
	$( '.form-tooltip' ).tooltipster({
		distance : 5,
		delay : 150,
		animationDuration : 150,
		theme : 'cfe-tooltips'
	});
});
</script>
