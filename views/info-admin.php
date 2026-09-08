<?php
/**
 * Guide page admin tab
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @category   Guide page
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Plugin\{
	plugin,
	plugin_options_url,
	lang
};

$options_url = plugin_options_url( plugin()->className() );

?>
<h2 class="form-heading"><?php lang()->p( 'Admin Theme' ); ?></h2>

<p><?php lang()->p( 'The Configure 8 suite includes a frontend theme, companion plugins, and an admin theme which gives your administration pages the same look and feel as the public-facing pages.' ); ?></p>

<p><?php lang()->p( 'If you downloaded the entire Configure 8 suite then you have a copy of its admin theme. If not then find it at' ); ?> <a href="https://github.com/BaselessCMS/configureight-admin" target="_blank" rel="noopener noreferrer">https://github.com/BaselessCMS/configureight-admin</a></p>

<h3 class="form-heading"><?php lang()->p( 'Theme Styles' ); ?></h3>

<p><?php lang()->p( 'Many of the Configure 8 styles can be used for administration pages without installing the admin theme. This option uses CSS to overwrite styles of the default Bludit admin theme, adopting the colors, fonts, and general spacing of the frontend styles. And the user toolbar is also available without the Configure 8 admin theme.' ); ?></p>

<p><?php lang()->p( 'The full admin theme installation uses unique HTML markup in addition to theme styles. Primarily this modifies the admin menu, including inline SVG icons, but favorable changes are made to layout and general HTML elements, as well as the user login page.' ); ?></p>

<h3 class="form-heading"><?php lang()->p( 'Theme Installation' ); ?></h3>

<p><?php lang()->p( 'The admin theme needs to be unzipped/uncompressed before installation. Add the folder to where your Bludit installation lives in <code>bl-kernel/admin/themes</code> If the folder came named as <code>configureight-admin</code> then rename it to <code>configureight</code>.' ); ?></p>

<p><?php lang()->p( 'The Bludit site settings file needs to be modified to change from the active admin theme name to <code>configureight</code>. Configure 8 allows you to do this easily in the options style tab. However, you can do this manually by editing the PHP file at <code>bl-content/databases/site.php</code> where <code>"adminTheme"</code> is <code>"configureight"</code>' ); ?></p>

<p><?php lang()->p( 'Go to' ); ?> <strong><a href="<?php echo $options_url ?>#style"><?php lang()->p( 'style options' ); ?></a></strong></p>
