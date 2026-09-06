<?php
/**
 * Configure 8 Guide page
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @category   Guide page
 * @since      1.0.0
 */

use function CFE_Plugin\{
	plugin,
	lang
};

// Settings page URL.
$settings_page = DOMAIN_ADMIN . 'configure-plugin/' . plugin()->className();

?>

<style>
pre {
	white-space: pre-wrap;
	white-space: break-spaces;
	user-select: all;
	cursor: pointer;
}
</style>

<h1 class="page-title"><span class="page-title-icon fa fa-book"></span><span class="page-title-text"><?php lang()->p( 'Options Guide' ); ?></span></h1>

<p class="page-description"><?php lang()->p( "Edit appearance on the <a href='{$settings_page}'>website options</a> page." ); ?></p>

<div class="tab-content" data-toggle="tabslet" data-deeplinking="true" data-animation="true">

	<ul class="nav nav-tabs" id="nav-tabs" role="tablist">
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="intro" aria-selected="false" href="#intro"><?php lang()->p( 'Intro' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="templates" aria-selected="false" href="#templates"><?php lang()->p( 'Templates' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="nav" aria-selected="false" href="#nav"><?php lang()->p( 'Menu' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="content" aria-selected="false" href="#content"><?php lang()->p( 'Content' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="admin" aria-selected="false" href="#admin"><?php lang()->p( 'Admin' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="plugins" aria-selected="false" href="#plugins"><?php lang()->p( 'Plugins' ); ?></a>
		</li>
	</ul>

	<div id="intro" class="tab-pane" role="tabpanel" aria-labelledby="intro">
		<?php include( plugin()->phpPath() . '/views/info-intro.php' ); ?>
	</div>

	<div id="templates" class="tab-pane" role="tabpanel" aria-labelledby="templates">
		<?php include( plugin()->phpPath() . '/views/info-templates.php' ); ?>
	</div>

	<div id="nav" class="tab-pane" role="tabpanel" aria-labelledby="nav">
		<?php include( plugin()->phpPath() . '/views/info-nav-menu.php' ); ?>
	</div>

	<div id="content" class="tab-pane" role="tabpanel" aria-labelledby="content">
		<?php include( plugin()->phpPath() . '/views/info-content.php' ); ?>
	</div>

	<div id="admin" class="tab-pane" role="tabpanel" aria-labelledby="admin">
		<?php include( plugin()->phpPath() . '/views/info-admin.php' ); ?>
	</div>

	<div id="plugins" class="tab-pane" role="tabpanel" aria-labelledby="plugins">
		<?php include( plugin()->phpPath() . '/views/info-plugins.php' ); ?>
	</div>
</div>
