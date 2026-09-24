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
	color_schemes
};

?>
<h2 class="color-heading"><?php lang()->p( 'Scheme Classes' ); ?></h2>

<p><?php lang()->p( 'Scheme-specific CSS classes are optionally loaded in a scheme-specific stylesheet. The classes are not used in the Configure 8 theme or admin theme but can be used in your custom plugin, or in modified versions of the Configure 8 themes.' ); ?></p>

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
