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

?>
<style>
ul.database-links-list {
	list-style: none;
}
ul.database-links-list li {
	margin: var( --cfe-element--margin, 0.125rem 0 0 0 );
}
ul.database-links-list li a {
	text-decoration: none;
	font-weight: var( --cfe-display--font-weight, 600 );
}
</style>

<h1 class="page-title"><span class="page-title-icon fa fa-server"></span><span class="page-title-text"><?php lang()->p( 'Options Databases' ); ?></span></h1>

<p><?php lang()->p( 'List of current Configure 8 Suite options and their values. Includes plugins that are bundled in the full suite, if installed and activated.' ); ?></p>

<ul class="database-links-list">
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
