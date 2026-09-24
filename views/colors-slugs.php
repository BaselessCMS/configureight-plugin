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
	color_scheme_category
};

?>
<h2 class="color-heading"><?php lang()->p( 'Scheme Slugs' ); ?></h2>

<p><?php lang()->p( 'Color scheme page/post templates require use of the scheme slug. To apply a color scheme template use the name <code>color-scheme-$slug</code> where <code>$slug</code> is one of the color scheme slugs listed below.' ); ?></p>

<?php
printf(
	'<p><span class="color-list-label">%s</span> %s</p>',
	lang()->get( 'Example:' ),
	lang()->get( 'the template <code>color-scheme-forest</code> will apply the Forest color scheme to that page or post.' )
); ?>

<p><?php lang()->p( 'Slugs can also be used in the <code>get_color_scheme( $slug )</code> function to get an array of data about the scheme.' ); ?></p>

<ul id="schemes-list" class="color-list">
<?php

// Sort schemes by category.
usort( $schemes, function( $one_thing, $another ) {
	return strcmp( $one_thing['category'], $another['category'] );
} );

// Loop color schemes and group by category.
$slug_cat = '';

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

	if ( $slug_cat != $option['category'] ) {
		printf(
			'<li id="cat-id-%s" style="margin: var( --cfe-element--margin, calc( var( --cfe-spacing--vert, 2rem ) / 2 ) 0 );"><hr /><h3>%s</h3></li>',
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
		'<li><span class="color-list-label"><a href="#%s" class="next-tab">%s</a>:</span> <code class="select">%s</code></li>',
		$slug,
		$option['name'],
		$slug
	);
	$slug_cat = $option['category'];
} ?>
</ul>
