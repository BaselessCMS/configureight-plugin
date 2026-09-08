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

<p class="page-description"><?php lang()->p( "Go to the <a href='{$guide_page}'>options guide</a> index page. Edit appearance on the <a href='{$settings_page}#style'>website options</a> page." ); ?></p>

<div class="tab-content" data-toggle="tabslet" data-deeplinking="true" data-animation="true">

	<ul class="nav nav-tabs" id="nav-tabs" role="tablist">
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="properties" aria-selected="false" href="#properties"><?php lang()->p( 'Properties' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="classes" aria-selected="false" href="#classes"><?php lang()->p( 'Classes' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="slugs" aria-selected="false" href="#slugs"><?php lang()->p( 'Slugs' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="details" aria-selected="false" href="#details"><?php lang()->p( 'Details' ); ?></a>
		</li>
	</ul>

	<div id="properties" class="tab-pane" role="tabpanel" aria-labelledby="properties">
		<?php
		/**
		 * CSS custom properties
		 *
		 * @since 1.0.0
		 *
		 * Explanations and examples for beginner users on
		 * how to work with CSS custom properties.
		 */
		printf(
			'<h2 class="color-heading">%s <a class="reference-link form-tooltip" href="http://developer.mozilla.org/en-US/docs/Web/CSS/Using_CSS_custom_properties" target="_blank" rel="noopener noreferrer" title="%s"><span class="fa fa-external-link-square"></span><span class="screen-reader-text">%s</span></a></h2>',
			lang()->get( 'Custom Properties' ),
			lang()->get( 'Reference on the Mozilla website' ),
			lang()->get( 'Reference on the Mozilla website' )
		);
		printf(
			'<p>%s</p>',
			lang()->get( 'The CSS color properties, also known as CSS variables, are used universally in the public theme and the admin theme. The <code>--cfe-</code> prefix refers to the Configure 8 theme.' )
		);
		printf(
			'<p>%s</p>',
			lang()->get( 'To redefine these properties, simply copy the property and paste it into the relevant Custom CSS field on the options page, under the <code>:root</code> selector, with its new color.' )
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

		echo '<hr />';

		printf(
			'<h2 class="color-heading">%s</h2>',
			lang()->get( 'General Properties' )
		);
		printf(
			'<p>%s</p>',
			lang()->get( 'The general properties are defined by the active color scheme. They are loaded in a scheme-specific stylesheet and in a <code>&lt;style&gt;</code> block in the <code>&lt;head&gt;</code>.' )
		);

		// Light mode properties.
		printf(
			'<h3 class="color-list-heading">%s</h3>',
			lang()->get( 'Light Mode Properties' )
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

		// Dark mode properties.
		printf(
			'<h3 class="color-list-heading">%s</h3>',
			lang()->get( 'Dark Mode Properties' )
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

		echo '<hr />';

		printf(
			'<h2 class="color-heading">%s</h2>',
			lang()->get( 'Scheme Properties' )
		);
		printf(
			'<p>%s</p>',
			lang()->get( 'The scheme properties are optionally loaded in a scheme-specific stylesheet. The properties are not used in the Configure 8 theme or admin theme but can be used to change colors where desired.' )
		);

		?>
	</div>
	<div id="classes" class="tab-pane" role="tabpanel" aria-labelledby="classes">
		<?php
		printf(
			'<h2 class="color-heading">%s</h2>',
			lang()->get( 'Scheme Classes' )
		);
		printf(
			'<p>%s</p>',
			lang()->get( 'Scheme-specific CSS classes are optionally loaded in a scheme-specific stylesheet. The classes are not used in the Configure 8 theme or admin theme but can be used in your custom plugin, or in modified versions of the Configure 8 themes.' )
		);
		printf(
			'<p>%s</p>',
			lang()->get( 'Each color in a scheme, light & dark modes, has its own set of classes for that color. The scheme is specified by a class using the scheme slug prefixed with <code>cfe-</code>.' )
		);
		printf(
			'<p><span class="color-list-label">%s</span> %s</p>',
			lang()->get( 'Example:' ),
			lang()->get( 'the <code>cfe-forest</code> class will take a color from the Forest color scheme. Then specify the color name in the operative class. If you have <code>&lt;span class="cfe-forest forest-one"&gt;</code> will apply Forest color one to the text.' )
		);
		printf(
			'<p>%s</p>',
			lang()->get( 'Following is the complete set of classes for color one the Forest scheme. ' )
		);

		?>
		<pre lang="css">
		.cfe-forest.forest-one {
			color: var( --cfe--forest--one );
		}
		.cfe-forest.forest-one-bg {
			background-color: var( --cfe--forest--one );
		}
		.cfe-forest.forest-one-decoration {
			text-decoration-color: var( --cfe--forest--one );
		}
		.cfe-forest.forest-one-emphasis {
			-webkit-text-emphasis-color: var( --cfe--forest--one );
					text-emphasis-color: var( --cfe--forest--one );
		}
		.cfe-forest.forest-one-accent {
			accent-color: var( --cfe--forest--one );
		}
		.cfe-forest.forest-one-caret {
			caret-color: var( --cfe--forest--one );
		}
		.cfe-forest.forest-one-border {
			border-color: var( --cfe--forest--one );
		}
		.cfe-forest.forest-one-outline {
			outline-color: var( --cfe--forest--one );
		}
		.cfe-forest.forest-one-rule {
			rule-color: var( --cfe--forest--one );
		}
		.cfe-forest.forest-one-column-rule {
			-moz-column-rule-color: var( --cfe--forest--one );
				 column-rule-color: var( --cfe--forest--one );
		}
		.cfe-forest.forest-one-row-rule {
			row-rule-color: var( --cfe--forest--one );
		}
		.cfe-forest.forest-one-fill {
			fill: var( --cfe--forest--one );
		}
		.cfe-forest.forest-one-text-fill {
			-webkit-text-fill-color: var( --cfe--forest--one );
					text-fill-color: var( --cfe--forest--one );
		}
		.cfe-forest.forest-one-stroke {
			stroke: var( --cfe--forest--one );
		}
		.cfe-forest.forest-one-text-stroke {
			-webkit-text-stroke-color: var( --cfe--forest--one );
					text-stroke-color: var( --cfe--forest--one );
		}
		.cfe-forest.forest-one-flood {
			flood-color: var( --cfe--forest--one );
		}
		.cfe-forest.forest-one-stop {
			stop-color: var( --cfe--forest--one );
		}
		</pre>
	</div>
	<div id="slugs" class="tab-pane" role="tabpanel" aria-labelledby="slugs">
		<?php
		/**
		 * Color scheme slugs
		 *
		 * @since 1.0.0
		 *
		 * Print a slug for each of the plugin color schemes,
		 * except for the custom schemes. Slugs can be used
		 * in page templates for using a scheme per page.
		 */
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

		// Loop color schemes and group by category.
		$slug_cat = '';

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
		}
		echo '</ul>';
		?>
	</div>
	<div id="details" class="tab-pane" role="tabpanel" aria-labelledby="details">
		<?php
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
</div>

<script>

// jQuery tooltips.
jQuery(document).ready( function($) {
	$( '.form-tooltip' ).tooltipster({
		distance : 5,
		delay : 150,
		animationDuration : 150,
		theme : 'cfe-tooltips'
	});
});
</script>
