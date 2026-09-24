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
	default_color_scheme
};

$default = default_color_scheme();

printf(
	'<h2 class="color-heading">%s <a class="reference-link form-tooltip" href="http://developer.mozilla.org/en-US/docs/Web/CSS/Using_CSS_custom_properties" target="_blank" rel="noopener noreferrer" title="%s"><span class="fa fa-external-link-square"></span><span class="screen-reader-text">%s</span></a></h2>',
	lang()->get( 'Custom Properties' ),
	lang()->get( 'Reference on the Mozilla website' ),
	lang()->get( 'Reference on the Mozilla website' )
); ?>

<p><?php lang()->p( 'The CSS color properties, also known as CSS variables, are used universally in the public theme and the admin theme. The <code>--cfe-</code> prefix refers to the Configure 8 theme.' ); ?></p>

<p><?php lang()->p( 'To redefine these properties, simply copy the property and paste it into the relevant Custom CSS field on the options page, under the <code>:root</code> selector, with its new color.' ); ?></p>

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

<h2 class="color-headings"><?php lang()->p( 'General Properties' ); ?></h2>

<p><?php lang()->p( 'The general properties are defined by the active color scheme. They are loaded in a scheme-specific stylesheet and in a <code>&lt;style&gt;</code> block in the <code>&lt;head&gt;</code>.' ); ?></p>

<h3 class="color-list-heading"><?php lang()->p( 'Light Mode Properties' ); ?></h3>

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

<h3 class="color-list-heading"><?php lang()->p( 'Dark Mode Properties' ); ?></h3>

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
