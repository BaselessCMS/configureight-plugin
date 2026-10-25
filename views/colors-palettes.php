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
	color_scheme_category
};

?>
<hr class="hide-if-js" role="presentation" />

<h2 class="color-heading"><?php lang()->p( 'Color Palettes' ); ?></h2>
