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
<h3 class="form-heading"><?php lang()->p( 'Admin Theme' ); ?></h3>

<p><?php lang()->p( 'The Configure 8 suite includes a frontend theme, companion plugins, and an admin theme which gives your administration pages the same look and feel as the public-facing pages.' ); ?></p>

<p><?php lang()->p( 'If you downloaded the entire Configure 8 suite then you have a copy of its admin theme. If not then find it at' ); ?> <a href="<?php echo plugin()->getMetadata( 'admin_url' ); ?>" target="_blank" rel="noopener noreferrer"><?php echo plugin()->getMetadata( 'admin_url' ); ?></a></p>

<h3 class="form-heading"><?php lang()->p( 'Theme Styles' ); ?></h3>

<p><?php lang()->p( 'Many of the Configure 8 styles can be used for administration pages without installing the admin theme. This option uses CSS to overwrite styles of the default Bludit admin theme, adopting the colors, fonts, and general spacing of the frontend styles. And the user toolbar is also available without the Configure 8 admin theme.' ); ?></p>

<p><?php lang()->p( 'The full admin theme installation uses unique HTML markup in addition to theme styles. Primarily this modifies the admin menu, including inline SVG icons, but favorable changes are made to layout and general HTML elements, as well as the user login page.' ); ?></p>

<h3 class="form-heading"><?php lang()->p( 'Theme Installation' ); ?></h3>

<p><?php lang()->p( 'The admin theme needs to be unzipped/uncompressed before installation. Add the folder to where your Bludit installation lives in <code>bl-kernel/admin/themes</code> If the folder came named as <code>configureight-admin</code> then rename it to <code>configureight</code>.' ); ?></p>

<p><?php lang()->p( 'The Bludit site settings file needs to be modified to change from the active admin theme name to <code>configureight</code>. Configure 8 allows you to do this easily in the options style tab. However, you can do this manually by editing the PHP file at <code>bl-content/databases/site.php</code> where <code>"adminTheme"</code> is <code>"configureight"</code>' ); ?></p>

<h3 class="form-heading"><?php lang()->p( 'Admin Footer' ); ?></h3>

<p><?php lang()->p( 'When using the Configure 8 admin theme, you may notice a small line at the bottom of each admin page. The text and markup of this may be changed or removed by editing the <code>"admin_footer"</code> value in the frontend theme\'s <code>metadata.json</code> file or leaving it empty. The line can also be safely removed altogether without PHP error.' ); ?></p>

<h3 class="form-heading"><?php lang()->p( 'Custom Dashboard' ); ?></h3>

<p><?php lang()->p( 'The Configure 8 suite has a custom admin dashboard built for use with plugins in the suite. The custom dashboard is simply one PHP file to replace the standard Bludit dashboard file.' ); ?></p>

<p><?php lang()->p( 'The custom dashboard retains features of the standard Bludit dashboard and adds content from plugins in the Configure 8 suite. Content is grouped into tabbed sections. This includes a summary of site content and the activity log.' ); ?></p>

<p><?php lang()->p( 'You can download the custom dashboard with the Configure 8 suite or individually at <a href="https://github.com/BaselessCMS/configureight-dashboard" target="_blank" rel="noopener noreferrer">https://github.com/BaselessCMS/configureight-dashboard</a>' ); ?></p>

<h4><?php lang()->p( 'Dashboard Installation' ); ?></h4>

<ul>
	<li><?php lang()->p( 'Install and activate the Configure 8 theme & plugin.' ); ?></li>
	<li><?php lang()->p( "Edit the Bludit init file (<code>bl-kernel\boot\init.php</code>) to add <code class='select'>define( 'CFE_DASHBOARD', true );</code>" ); ?></li>
	<li><?php lang()->p( 'Replace the standard dashboard file (<code>bl-kernel\admin\views\dashboard.php</code>) with the dashboard file in this repository.' ); ?></li>
	<li><?php lang()->p( 'Go to the Configure 8 options page in your site\'s admin.' ); ?></li>
	<li><?php lang()->p( 'Find the "Custom Dashboard" option under the "General" tab.' ); ?></li>
	<li><?php lang()->p( 'Select "Enabled" then save the form.' ); ?></li>
</ul>

<h4><?php lang()->p( 'Dashboard Backup' ); ?></h4>

<p><?php lang()->p( "Although the Configure 8 plugin uses the contents of the standard Bludit dashboard as the default option, save a copy of the Bludit dashboard file for if or when you disable the Configure 8 theme & plugin. It won't harm anything to leave <code>define( 'CFE_DASHBOARD', true );</code> in the init file." ); ?></p>
