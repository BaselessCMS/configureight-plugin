<?php
/**
 * Footer options fields
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
	can_search
};

$copy_text_placeholder = sprintf(
	'© %s %s. %s',
	date( 'Y' ),
	site()->title(),
	lang()->get( 'All rights reserved.' )
);

?>

<h3 class="form-heading"><?php lang()->p( 'Footer Options' ); ?></h3>

<fieldset>

	<legend class="screen-reader-text"><?php lang()->p( 'Footer' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="footer_text"><?php lang()->p( 'Footer Text' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="footer_text" name="footer_text">
				<option value="true" <?php echo ( plugin()->getValue( 'footer_text' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'footer_text' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Display the footer text from the CMS settings.' ); ?></small>
		</div>
	</div>

	<?php if ( can_search() ) : ?>
	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="footer_search"><?php lang()->p( 'Search form' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="footer_search" name="footer_search">
				<option value="true" <?php echo ( plugin()->getValue( 'footer_search' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'footer_search' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Display a search form at the page bottom.' ); ?></small>
		</div>
	</div>
	<?php endif; ?>

	<?php if ( Theme :: socialNetworks() ) : ?>
	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="footer_social"><?php lang()->p( 'Social Links' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="footer_social" name="footer_social">
				<option value="true" <?php echo ( plugin()->getValue( 'footer_social' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'footer_social' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Display the navigation menu for links to social media sites. See Settings > General > Social Networks in the admin menu to enter links.' ); ?></small>
		</div>
	</div>

	<div id="ftr_social_heading_wrap" class="form-field form-group row" style="display: <?php echo ( plugin()->getValue( 'footer_social' ) === true ? 'flex' : 'none' ); ?>;">
		<label class="form-label col-sm-2 col-form-label" for="ftr_social_heading"><?php lang()->p( 'Social Heading Text' ); ?></label>
		<div class="col-sm-10">
			<input type="text" id="ftr_social_heading" name="ftr_social_heading" value="<?php echo plugin()->getValue( 'ftr_social_heading' ) ?>" placeholder="<?php lang()->p( 'Social Links' ); ?>" />
			<small class="form-text"><?php lang()->p( 'Leave blank for no heading.' ); ?></small>
		</div>
	</div>
	<?php endif; ?>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="copyright"><?php lang()->p( 'Copyright Line' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="copyright" name="copyright">
				<option value="true" <?php echo ( plugin()->getValue( 'copyright' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'copyright' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Display a copyright line at the bottom of each web page.' ); ?></small>
		</div>
	</div>

	<div id="copyright_options" style="display: <?php echo ( plugin()->getValue( 'copyright' ) === true ? 'block' : 'none' ); ?>;">
		<div id="copyright-date" class="form-field form-group row" style="display: <?php echo ( empty( plugin()->getValue( 'copy_text' ) ) ? 'flex' : 'none' ); ?>;">
			<label class="form-label col-sm-2 col-form-label" for="copy_date"><?php lang()->p( 'Copyright Date' ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="copy_date" name="copy_date">
					<option value="true" <?php echo ( plugin()->getValue( 'copy_date' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Show' ); ?></option>
					<option value="false" <?php echo ( plugin()->getValue( 'copy_date' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Hide' ); ?></option>
				</select>
				<small class="form-text"><?php lang()->p( 'Only displayed if the copyright line is displayed.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="copy_text"><?php lang()->p( 'Copyright Text' ); ?></label>
			<div class="col-sm-10">
				<input type="text" id="copy_text" name="copy_text" value="<?php echo plugin()->getValue( 'copy_text' ) ?>" placeholder="<?php echo $copy_text_placeholder; ?>" />
				<small class="form-text"><?php lang()->p( 'Placeholders:' ); ?>
					<code class="select">{{copy}}</code>
					<code class="select">{{year}}</code>
				</small>
			</div>
		</div>
	</div>
</fieldset>
