<?php
/**
 * Options Database page
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @category   Guide page
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Plugin\{
	plugin,
	lang,
	suite_plugins_active,
	options_list
};

// Settings page URL.
$settings_page = DOMAIN_ADMIN . 'configure-plugin/' . plugin()->className();

?>

<h1 class="page-title"><span class="page-title-icon fa fa-server"></span><span class="page-title-text"><?php lang()->p( 'Options Databases' ); ?></span></h1>

<p class="page-description"><?php lang()->p( "Go to the <a href='{$settings_page}'>website options</a> page." ); ?></p>

<?php lang()->p( 'List of current Configure 8 Suite options and their values. Includes plugins that are bundled in the full suite, if installed and activated.' ); ?></p>

<ul>
	<li><a href="#<?php echo plugin()->className(); ?>"><?php echo plugin()->name(); ?></a></li>
	<?php
	foreach ( suite_plugins_active() as $plugin ) {

		$get = getPlugin( $plugin );
		printf(
			'<li><a href="#%s">%s</a></li>',
			$get->className(),
			$get->name()
		);
	} ?>
</ul>

<?php
/**
 * List options for Configure 8 suite plugins.
 * The theme plugin options are printed outside
 * of the foreach loop because it is excluded
 * by the `suite_plugins_active()` function.
 */
echo options_list( plugin()->className() );
foreach ( suite_plugins_active() as $plugin ) :
	if ( options_list( $plugin ) ) {
		echo options_list( $plugin );
	}
endforeach;
