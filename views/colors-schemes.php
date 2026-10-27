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
	color_schemes_data,
	option_schemes_data,
	get_color_scheme,
	current_color_scheme,
	color_scheme_category,
	palette_schemes,
	get_palette,
	hex_to_rgb
};

$schemes = color_schemes_data();
$current = current_color_scheme();

?>
<hr class="hide-if-js" role="presentation" />

<h2 class="color-heading"><?php lang()->p( 'Color Schemes' ); ?></h2>

<p><a href="#schemes-list"><?php lang()->p( 'Jump to schemes list &darr;' ); ?></a></p>

<p><?php lang()->p( 'The Configure 8 theme has many color schemes included with the companion plugin, arranged by category. These prescribed schemes may be modified in the custom color pickers.' ); ?></p>

<p><?php lang()->p( 'The color schemes set colors of various theme features in both light and dark modes:' ); ?></p>
<ul>
	<li><?php lang()->p( 'Background color' ); ?></li>
	<li><?php lang()->p( 'General text, including headings' ); ?></li>
	<li><?php lang()->p( 'Text links, including hover & focus states' ); ?></li>
	<li><?php lang()->p( 'Button background, including hover & focus states' ); ?></li>
	<li><?php lang()->p( 'Dropdown menus, background & link hover' ); ?></li>
	<li><?php lang()->p( 'Cover image blend mode color' ); ?></li>
</ul>

<h3 class="form-heading"><?php lang()->p( 'Color Options' ); ?></h3>

<p><?php lang()->p( 'When a scheme option is saved, various color options for both light and dark modes are saved from the corresponding scheme. The scheme colors then become available, plus a standard grayscale, in various color picker inputs in the Website Configuration form.' ); ?></p>

<h4 class="form-heading"><?php lang()->p( 'Light Mode Options' ); ?></h4>

<ul>
	<li><?php lang()->p( '<code>color_body</code>: background color' ); ?></li>
	<li><?php lang()->p( '<code>color_text</code>: text color' ); ?></li>
	<li><?php lang()->p( '<code>color_one</code>: link color' ); ?></li>
	<li><?php lang()->p( '<code>color_two</code>: link hover & focus color' ); ?></li>
	<li><?php lang()->p( '<code>color_three</code>: button color' ); ?></li>
	<li><?php lang()->p( '<code>color_four</code>: button hover & focus color' ); ?></li>
	<li><?php lang()->p( '<code>color_five</code>: dropdown menus background color' ); ?></li>
	<li><?php lang()->p( '<code>color_six</code>: dropdown menus link background hover & focus color' ); ?></li>
	<li><?php lang()->p( '<code>loader_bg_color</code>: loader background color' ); ?></li>
	<li><?php lang()->p( '<code>loader_text_color</code>: loader text color' ); ?></li>
	<li><?php lang()->p( '<code>header_bg_color</code>: header background color' ); ?></li>
	<li><?php lang()->p( '<code>header_text_color</code>: header text color' ); ?></li>
	<li><?php lang()->p( '<code>cover_blend</code>: cover image blend mode color' ); ?></li>
</ul>

<h4 class="form-heading"><?php lang()->p( 'Dark Mode Options' ); ?></h4>

<ul>
	<li><?php lang()->p( '<code>color_body_dark</code>: background color' ); ?></li>
	<li><?php lang()->p( '<code>color_text_dark</code>: text color' ); ?></li>
	<li><?php lang()->p( '<code>color_one_dark</code>: link color' ); ?></li>
	<li><?php lang()->p( '<code>color_two_dark</code>: link hover & focus color' ); ?></li>
	<li><?php lang()->p( '<code>color_three_dark</code>: button color' ); ?></li>
	<li><?php lang()->p( '<code>color_four_dark</code>: button hover & focus color' ); ?></li>
	<li><?php lang()->p( '<code>color_five_dark</code>: dropdown menus background color' ); ?></li>
	<li><?php lang()->p( '<code>color_six_dark</code>: dropdown menus link background hover & focus color' ); ?></li>
	<li><?php lang()->p( '<code>loader_bg_color_dark</code>: loader background color' ); ?></li>
	<li><?php lang()->p( '<code>loader_text_color_dark</code>: loader text color' ); ?></li>
	<li><?php lang()->p( '<code>header_bg_color_dark</code>: header background color' ); ?></li>
	<li><?php lang()->p( '<code>header_text_color_dark</code>: header text color' ); ?></li>
	<li><?php lang()->p( '<code>cover_blend</code>: cover image blend mode color' ); ?></li>
</ul>

<?php
foreach ( get_palette( 'grayscale' ) as $palette ) {

	printf(
		'<h4 class="form-heading">%s</h4>',
		lang()->get( 'Standard Grayscale' )
	);

	echo '<div class="form-color-thumbs-list"><ul>';
	$count = 1;
	foreach ( $palette as $color => $swatch ) {

		if ( 'label' == $color ) {
			continue;
		}
		printf(
			'<li style="background-color: %s;" class="color-tooltip" data-tooltip-content="#tooltip-grayscale-%s"><span class="screen-reader-text">%s</span></li>',
			$swatch,
			$count,
			$swatch
		);
		printf(
			'<div style="display: none"><div id="tooltip-grayscale-%s">Hex: %s <br />RGB: %s</div></div>',
			$count,
			$swatch,
			hex_to_rgb( $swatch )
		);
		$count++;
	}
	echo '</ul></div>';
}
?>

<hr />

<h2 class="color-heading"><?php lang()->p( 'Scheme Slugs' ); ?></h2>

<p><?php lang()->p( 'Color schemes may be used for a single page/post no matter what the scheme is for the rest of the website, as set in the options. To do so the page/post template requires use of the scheme slug. To apply a color scheme template, go to the edit page for the page/post, click "Options" then "Advanced" to find the "Template" field. Enter the name <code>color-scheme-$slug</code> where <code>$slug</code> is one of the color scheme slugs listed below. Then save the page/post.' ); ?></p>

<?php
printf(
	'<p><span class="color-list-label">%s</span> %s</p>',
	lang()->get( 'Example:' ),
	lang()->get( 'the template <code>color-scheme-forest</code> will apply the Forest color scheme to that page or post.' )
); ?>

<p><?php lang()->p( 'Slugs can also be used in the <code>get_color_scheme( $slug )</code> function to get an array of data about the scheme.' ); ?></p>

<hr />

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
	! array_key_exists( $current['slug'], option_schemes_data() )
) :
$scheme_cat = color_scheme_category( $current['category'] );
printf(
	'<p class="current-scheme-cat">%s %s</p>',
	lang()->get( 'Category:' ),
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

// Current light color options.
printf(
	'<h4 class="form-heading">%s</h4>',
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
	'<h4 class="form-heading">%s</h4>',
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

// Copy colors as text.
if ( in_array( $current['slug'], palette_schemes() ) ) :

printf(
	'<h3 class="form-heading" style="text-transform: none;">%s</h3>',
	lang()->get( 'Copy current color options for your records' )
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

echo '</div>'; // #current-scheme

echo '<div id="schemes-list">';

// Sort schemes by category.
usort( $schemes, function( $one_thing, $another ) {
	return strcmp( $one_thing['category'], $another['category'] );
} );

// Loop color schemes and group by category.
$slug_cat = '';
$count    = 0;
foreach ( $schemes as $scheme => $option ) {

	// Skip custom schemes.
	if ( array_key_exists( $option['slug'], option_schemes_data() ) ) {
		continue;
	}

	$slug = $option['slug'];
	if ( $current['slug'] == $slug ) {
		$slug = 'current-scheme';
	}
	$scheme_cat = color_scheme_category( $option['category'] );

	if ( $slug_cat != $option['category'] ) {

		echo '<hr class="form-rule" />';

		if ( 0 == $count ) {
			printf(
				'<p>%s</p>',
				lang()->get( 'Following are all of the theme\'s color schemes by category. Click or tap any color swatch to get its hex and rgb codes.' )
			);
		}
		$count++;

		printf(
			'<h2 class="form-heading color-heading">%s %s</h2>',
			$scheme_cat['name'],
			lang()->get( 'Schemes' )
		);
		if ( isset( $scheme_cat ) && array_key_exists( 'about', $scheme_cat ) && ! empty( $scheme_cat['about'] ) ) {
			printf(
				'<p>%s</p>',
				$scheme_cat['about']
			);
		}
	}
	echo '<div class="scheme-details">';
	printf(
		'<h3>%s</h3>',
		$option['name']
	);
	if ( isset( $option['about'] ) && ! empty( $option['about'] ) ) {
		printf(
			'<p class="scheme-detail">%s</p>',
			$option['about']
		);
	}
	printf(
		'<p class="scheme-detail">%s <code class="select">%s</code></p>',
		lang()->get( 'Slug:' ),
		$option['name'],
		$slug
	);
	// Scheme light mode colors.
	printf(
		'<h4 class="form-heading">%s</h4>',
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
	echo '</div>';

	// Scheme dark mode colors.
	printf(
		'<h4 class="form-heading">%s</h4>',
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

	$slug_cat = $option['category'];
}
echo '</div>'; // #schemes-list
