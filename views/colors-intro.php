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
	default_color_scheme
};

$default = default_color_scheme();

?>
<h2 class="color-heading"><?php lang()->p( 'Configure 8 Colors' ); ?></h2>


