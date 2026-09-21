<?php
/**
 * Sidebar options fields
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Plugin\{
	plugin,
	site,
	lang,
	admin_theme
};

?>

<h3 class="form-heading"><?php lang()->p( 'Sidebar Options' ); ?></h3>

<fieldset>

	<legend class="screen-reader-text"><?php lang()->p( 'Sidebar' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="sidebar_in_page"><?php lang()->p( 'Sidebar in Pages' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="sidebar_in_page" name="sidebar_in_page">

				<option value="side" <?php echo ( plugin()->getValue( 'sidebar_in_page' ) === 'side' ? 'selected' : '' ); ?>><?php lang()->p( 'Aside Content' ); ?></option>

				<option value="bottom" <?php echo ( plugin()->getValue( 'sidebar_in_page' ) === 'bottom' ? 'selected' : '' ); ?>><?php lang()->p( 'Below Content' ); ?></option>

				<?php if ( site()->homepage() ) : ?>
				<option value="side_no_front" <?php echo ( plugin()->getValue( 'sidebar_in_page' ) === 'side_no_front' ? 'selected' : '' ); ?>><?php lang()->p( 'Aside, Exclude Front Page' ); ?></option>

				<option value="bottom_no_front" <?php echo ( plugin()->getValue( 'sidebar_in_page' ) === 'bottom_no_front' ? 'selected' : '' ); ?>><?php lang()->p( 'Below, Exclude Front Page' ); ?></option>
				<?php endif; ?>

				<option value="none" <?php echo ( plugin()->getValue( 'sidebar_in_page' ) === 'none' ? 'selected' : '' ); ?>><?php lang()->p( 'No Sidebar' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'The default sidebar layout for posts & pages. Sidebar templates can override this setting on a per-page basis.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="sidebar_in_loop"><?php lang()->p( 'Sidebar in Loop' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="sidebar_in_loop" name="sidebar_in_loop">

				<option value="side" <?php echo ( plugin()->getValue( 'sidebar_in_loop' ) === 'side' ? 'selected' : '' ); ?>><?php lang()->p( 'Aside Posts' ); ?></option>

				<option value="bottom" <?php echo ( plugin()->getValue( 'sidebar_in_loop' ) === 'bottom' ? 'selected' : '' ); ?>><?php lang()->p( 'Below Posts' ); ?></option>

				<option value="side_no_first" <?php echo ( plugin()->getValue( 'sidebar_in_loop' ) === 'side_no_first' ? 'selected' : '' ); ?>><?php lang()->p( 'Aside, Exclude First Page' ); ?></option>

				<option value="bottom_no_first" <?php echo ( plugin()->getValue( 'sidebar_in_loop' ) === 'bottom_no_first' ? 'selected' : '' ); ?>><?php lang()->p( 'Below, Exclude First Page' ); ?></option>

				<option value="none" <?php echo ( plugin()->getValue( 'sidebar_in_loop' ) === 'none' ? 'selected' : '' ); ?>><?php lang()->p( 'No Sidebar' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'When using a static page for the posts loop, a sidebar template, if used, will override this setting. Only applies to the main posts index, not to taxonomy and search loops.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="sidebar_position"><?php lang()->p( 'Sidebar Position' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="sidebar_position" name="sidebar_position">

				<option value="left" <?php echo ( plugin()->getValue( 'sidebar_position' ) === 'left' ? 'selected' : '' ); ?>><?php lang()->p( 'Left Side' ); ?></option>

				<option value="right" <?php echo ( plugin()->getValue( 'sidebar_position' ) === 'right' ? 'selected' : '' ); ?>><?php lang()->p( 'Right Side' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Where a sidebar is displayed aside page or loop content, display it to the right or to the left of the content.' ); ?></small>
		</div>
	</div>

	<?php if ( Theme :: socialNetworks() ) : ?>
	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="sidebar_social"><?php lang()->p( 'Social Links' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="sidebar_social" name="sidebar_social">
				<option value="true" <?php echo ( plugin()->getValue( 'sidebar_social' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'sidebar_social' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Display the navigation menu for links to social media sites. See Settings > General > Social Networks in the admin menu to enter links.' ); ?></small>
		</div>
	</div>
	<?php endif; ?>

	<div id="sb_social_heading_wrap" class="form-field form-group row" style="display: <?php echo ( plugin()->getValue( 'sidebar_social' ) === true ? 'flex' : 'none' ); ?>;">
		<label class="form-label col-sm-2 col-form-label" for="sb_social_heading"><?php lang()->p( 'Social Heading Text' ); ?></label>
		<div class="col-sm-10">
			<input type="text" id="sb_social_heading" name="sb_social_heading" value="<?php echo plugin()->getValue( 'sb_social_heading' ) ?>" placeholder="<?php lang()->p( 'Social Links' ); ?>" />
			<small class="form-text"><?php lang()->p( 'Leave blank for no heading.' ); ?></small>
		</div>
	</div>
</fieldset>
