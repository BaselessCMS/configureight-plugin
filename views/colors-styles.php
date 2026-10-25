<?php
/**
 * Colors page properties tab
 *
 * CSS custom properties for color schemes.
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
	default_color_scheme
};

$default = default_color_scheme();

?>
<hr class="hide-if-js" role="presentation" />

<h2 class="color-heading"><?php lang()->p( 'Custom Properties' ); ?></h2>

<p><?php lang()->p( 'The CSS <a href="http://developer.mozilla.org/en-US/docs/Web/CSS/Using_CSS_custom_properties" target="_blank" rel="noopener noreferrer">custom properties</a> for colors are used universally in the public theme and the admin theme. To redefine these properties, simply copy the property and paste it into the relevant Custom CSS field on the options page, under the <code>:root</code> selector, with its new color.' ); ?></p>

<?php printf(
	'<p><span class="color-list-label">%s</span> <code>:root{ --cfe-scheme-color--one: #ffcc00; }</code></p>',
	lang()->get( 'Example:' )
); ?>

<p><?php lang()->p( 'To use these properties as a value for an element, ID, or class, simply copy the property and paste it into the relevant custom CSS field following a selector.' ); ?></p>

<?php
printf(
	'<p><span class="color-list-label">%s</span> <code>.div-class a { color: var( --cfe-scheme-color--three ); }</code></p>',
	lang()->get( 'Example:' )
); ?>

<hr />

<h2 class="color-heading"><?php lang()->p( 'General Properties' ); ?></h2>

<p><?php lang()->p( 'The general properties are defined by the active color scheme. They are loaded in a scheme-specific stylesheet and in a <code>&lt;style&gt;</code> block in the <code>&lt;head&gt;</code>.' ); ?></p>

<h3 class="form-heading"><?php lang()->p( 'Light Mode Properties' ); ?></h3>

<ul class="color-list color-list-light">
<?php
foreach ( $default['light'] as $name => $color ) {
	printf(
		'<li><span class="color-list-label">%s %s</span> <code class="select">%s</code></li>',
		ucwords( $name ),
		lang()->get( 'variable:' ),
		"--cfe-scheme-color--{$name}"
	);
} ?>
</ul>

<h3 class="form-heading"><?php lang()->p( 'Dark Mode Properties' ); ?></h3>

<ul class="color-list color-list-dark">
<?php
foreach ( $default['dark'] as $name => $color ) {
	printf(
		'<li><span class="color-list-label">%s %s</span> <code class="select">%s</code></li>',
		ucwords( $name ),
		lang()->get( 'variable:' ),
		"--cfe-scheme-color--{$name}--dark"
	);
} ?>
</ul>

<hr />

<h2 class="color-heading"><?php lang()->p( 'Scheme Properties' ); ?></h2>

<p><?php lang()->p( 'The scheme properties are optionally loaded in a scheme-specific stylesheet. The properties are not used in the Configure 8 theme or admin theme but can be used to change colors where desired.' ); ?></p>

<p><?php lang()->p( 'This does not apply to the Build Your Own color palette schemes or the Custom Colors option.' ); ?></p>

<hr />

<h2 class="color-heading"><?php lang()->p( 'Scheme Classes' ); ?></h2>

<p><?php lang()->p( 'Scheme-specific CSS classes are optionally loaded in a scheme-specific stylesheet. The classes are not used in the Configure 8 theme or admin theme but can be used in your custom plugin, or in modified versions of the Configure 8 themes.' ); ?></p>

<p><?php lang()->p( 'This does not apply to the Build Your Own color palette schemes or the Custom Colors option.' ); ?></p>

<p><?php lang()->p( 'Each color in a scheme, light & dark modes, has its own set of classes for that color. The scheme is specified by a class using the scheme slug prefixed with <code>cfe-</code>.' ); ?></p>

<?php printf(
	'<p><span class="color-list-label">%s</span> %s</p>',
	lang()->get( 'Example:' ),
	lang()->get( 'the <code>cfe-forest</code> class will take a color from the Forest color scheme. Then specify the color name in the operative class. If you have <code>&lt;span class="cfe-forest forest-one"&gt;</code> will apply Forest color one to the text.' )
); ?>

<p><?php lang()->p( 'Following is the complete set of classes for color one the Forest scheme.' ); ?></p>

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
