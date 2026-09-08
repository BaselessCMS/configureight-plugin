<?php
/**
 * Guide page info tab
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @category   Guide page
 * @since      1.0.0
 *
 * @todo Monitor accuracy of translation message.
 */

use function CFE_Plugin\{
	plugin,
	lang
};

// Guide page URLs.
$colors_page   = DOMAIN_ADMIN . 'plugin/' . plugin()->className() . '?page=colors';
$fonts_page    = DOMAIN_ADMIN . 'plugin/' . plugin()->className() . '?page=fonts';
$database_page = DOMAIN_ADMIN . 'plugin/' . plugin()->className() . '?page=database';

?>
<h2 class="form-heading"><?php lang()->p( 'Reference Pages' ); ?></h2>

<p><?php lang()->p( 'This options guide includes several separate reference pages:' ); ?></p>
<ul style="list-style: none; padding:0;">
	<li><a href="<?php echo $colors_page; ?>"><strong><?php lang()->p( 'Color Schemes' ); ?></strong></a></li>
	<li><a href="<?php echo $fonts_page; ?>"><strong><?php lang()->p( 'Font Schemes' ); ?></strong></a></li>
	<li><a href="<?php echo $database_page; ?>"><strong><?php lang()->p( 'Options Database' ); ?></strong></a></li>
</ul>

<h2 class="form-heading"><?php lang()->p( 'Compatibility' ); ?></h2>

<p><?php lang()->p( 'The Configure 8 theme was designed with great extensibility by plugins. All of the core plugin hooks are included and placed in appropriate positions in the various template parts. That said, we cannot maintain compatibility for all plugins nor take responsibility for poorly developed plugins.' ); ?></p>

<p><?php lang()->p( 'Custom plugin hooks have been created and are included included in various template locations, where features and supplemental content may be displayed.' ); ?></p>

<p><?php lang()->p( 'See the Plugins tab for plugins specifically developed to enhance Configure 8.' ); ?></p>

<h2 class="form-heading"><?php lang()->p( 'Languages' ); ?></h2>

<p><?php lang()->p( 'The public theme and the admin theme are both ready for RTL languages. Layout direction is automatically reversed where appropriate. Some are not flipped automatically due to layout options. For example, the main navigation position option includes left and right. Since this refers to the left and right sides of the screen, not the flow of the language, it is up to administrators to adjust the option for the target language.' ); ?></p>

<p><?php lang()->p( 'Translation of hard-coded text is not complete. We welcome the submission of translations.' ); ?></p>

<h2 class="form-heading"><?php lang()->p( 'Product Support' ); ?></h2>

<p><?php lang()->p( 'Please register errors, conflicts, or other problems with the Configure 8 suite of products under the Issues tab in the relevant GitHub repository.' ); ?></p>

<p><?php lang()->p( 'Find Configure 8 product development at' ); ?> <a href="https://github.com/BaselessCMS" target="_blank" rel="noopener noreferrer">https://github.com/BaselessCMS</a></p>
