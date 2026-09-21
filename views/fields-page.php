<?php
/**
 * Page options fields
 *
 * For singular posts & pages, not in loop.
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
	has_error_widgets
};

// Get the search plugin object.
$placeholder = plugin()->error_search_holder();
if ( getPlugin( 'Search_Forms' ) ) {
	$search      = new Search_Forms;
	$min_chars   = $search->min_chars();
	$placeholder = lang()->get( "Enter at least {$min_chars} characters." );
}

?>

<h3 class="form-heading"><?php lang()->p( 'Post/Page Options' ); ?></h3>

<fieldset>

	<legend class="screen-reader-text"><?php lang()->p( 'Post/Page Options' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="posts_nav"><?php lang()->p( 'Posts Navigation' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="posts_nav" name="posts_nav">
				<option value="true" <?php echo ( plugin()->getValue( 'posts_nav' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'posts_nav' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Show the previous/next post navigation. Not available on static pages.' ); ?></small>
		</div>
	</div>

	<div id="posts_nav_wrap" style="display: <?php echo ( plugin()->getValue( 'posts_nav' ) === true ? 'block' : 'none' ); ?>;">
		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="posts_nav_type"><?php lang()->p( 'Posts Nav Type' ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="posts_nav_type" name="posts_nav_type">
					<option value="buttons" <?php echo ( plugin()->getValue( 'posts_nav_type' ) === 'buttons' ? 'selected' : '' ); ?>><?php lang()->p( 'Buttons' ); ?></option>
					<option value="titles" <?php echo ( plugin()->getValue( 'posts_nav_type' ) === 'titles' ? 'selected' : '' ); ?>><?php lang()->p( 'Titles' ); ?></option>
				</select>
				<small class="form-text"><?php lang()->p( 'The style of posts navigation.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="posts_nav_icon"><?php lang()->p( 'Navigation Icon' ); ?></label>
			<div class="col-sm-10">
				<div class="field-has-buttons">
					<select class="form-select" id="posts_nav_icon" name="posts_nav_icon">

						<option value="none" <?php echo ( plugin()->getValue( 'posts_nav_icon' ) === 'none' ? 'selected' : '' ); ?>><?php lang()->p( 'None' ); ?></option>

						<option value="arrow" <?php echo ( plugin()->getValue( 'posts_nav_icon' ) === 'arrow' ? 'selected' : '' ); ?>><?php lang()->p( 'Arrow' ); ?></option>

						<option value="angle" <?php echo ( plugin()->getValue( 'posts_nav_icon' ) === 'angle' ? 'selected' : '' ); ?>><?php lang()->p( 'Angle' ); ?></option>

						<option value="angles" <?php echo ( plugin()->getValue( 'posts_nav_icon' ) === 'angles' ? 'selected' : '' ); ?>><?php lang()->p( 'Double Angle' ); ?></option>
					</select>
					<span class="btn btn-secondary btn-md hide-if-no-js" onClick="$('#posts_nav_icon').val('<?php echo plugin()->dbFields['posts_nav_icon']; ?>');"><?php lang()->p( 'Default' ); ?></span>
				</div>
				<small class="form-text"><?php lang()->p( 'Directional characters are adjusted for language direction.' ); ?></small>
			</div>
		</div>
	</div>
</fieldset>

<?php if ( site()->homepage() ) : ?>

<h3 class="form-heading"><?php lang()->p( 'Front Page Slider' ); ?></h3>

<p><?php lang()->p( 'Display a slider/carousel of select posts at the top of the static front page.' ); ?></p>

<fieldset>

	<legend class="screen-reader-text"><?php lang()->p( 'Front Page Slider' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="posts_slider"><?php lang()->p( 'Display Slider' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="posts_slider" name="posts_slider">
				<option value="true" <?php echo ( plugin()->getValue( 'posts_slider' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'posts_slider' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Disabled' ); ?></option>
			</select>
		</div>
	</div>

	<div id="slider_options" style="display: <?php echo ( plugin()->getValue( 'posts_slider' ) === true ? 'block' : 'none' ); ?>;">

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="slider_content"><?php lang()->p( 'Slider Content' ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="slider_content" name="slider_content">

					<option value="recent" <?php echo ( plugin()->getValue( 'slider_content' ) === 'recent' ? 'selected' : '' ); ?>><?php lang()->p( 'Recent Posts' ); ?></option>

					<option value="static" <?php echo ( plugin()->getValue( 'slider_content' ) === 'static' ? 'selected' : '' ); ?>><?php lang()->p( 'Static Pages' ); ?></option>
				</select>
				<small class="form-text"><?php lang()->p( 'Content without a cover image will be skipped.' ); ?></small>
			</div>
		</div>

		<div id="slider_number_wrap" class="form-field form-group row" style="display: <?php echo ( plugin()->getValue( 'slider_content' ) === 'recent' ? 'flex' : 'none' ); ?>;">
			<label class="form-label col-sm-2 col-form-label" for="slider_number"><?php lang()->p( 'Number of Posts' ); ?></label>
			<div class="col-sm-10 row">
				<div class="form-range-controls">
					<span class="form-range-value"><span id="slider_number_value"><?php echo ( plugin()->getValue( 'slider_number' ) ? plugin()->getValue( 'slider_number' ) : plugin()->dbFields['slider_number'] ); ?></span></span>
					<input type="range" class="form-control-range custom-range custom-range" onInput="$('#slider_number_value').html($(this).val())" id="slider_number" name="slider_number" value="<?php echo plugin()->getValue( 'slider_number' ); ?>" min="1" max="12" step="1" />
					<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#slider_number_value').text('<?php echo plugin()->dbFields['slider_number']; ?>');$('#slider_number').val('<?php echo plugin()->dbFields['slider_number']; ?>');"><?php lang()->p( 'Default' ); ?></span>
				</div>
				<small class="form-text"><?php lang()->p( 'The maximum number of posts to display, starting with the most recent.' ); ?></small>
			</div>
		</div>

		<div id="slider_pages_wrap" class="form-field form-group row" style="display: <?php echo ( plugin()->getValue( 'slider_content' ) === 'static' ? 'flex' : 'none' ); ?>;">
			<label class="form-label col-sm-2 col-form-label" for="slider_pages"><?php lang()->p( 'Pages in Slider' ); ?></label>
			<div class="col-sm-10">
				<small class="form-text"><?php lang()->p( 'Which static pages shall display in the front page slider. Only pages with a cover image set are eligible for the slider. At least one page is required.' ); ?></small>

				<div id="slider-pages" class="multi-check-wrap">

					<?php

					$static  = buildStaticPages();
					if ( isset( $static[0] ) ) : foreach ( $static as $page ) :

						// Skip pages with no cover image.
						if ( ! $page->coverImage() ) {
							continue;
						}

						if ( $page->slug() === site()->pageNotFound() ) {
							echo '';
						} else {
							printf(
								'<label class="check-label-wrap" for="page-%s"><input type="checkbox" name="slider_pages[]" id="page-%s" value="%s" %s> %s</label>',
								$page->key(),
								$page->key(),
								$page->key(),
								( is_array( plugin()->slider_pages() ) && in_array( $page->key(), plugin()->slider_pages() ) ? 'checked' : '' ),
								$page->title()
							);
						}
					endforeach; endif; ?>
				</div>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="slider_animate"><?php lang()->p( 'Animation' ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="slider_animate" name="slider_animate">
					<option value="fade" <?php echo ( plugin()->getValue( 'slider_animate' ) === 'fade' ? 'selected' : '' ); ?>><?php lang()->p( 'Fade' ); ?></option>
					<option value="slide" <?php echo ( plugin()->getValue( 'slider_animate' ) === 'slide' ? 'selected' : '' ); ?>><?php lang()->p( 'Slide' ); ?></option>
				</select>
				<small class="form-text"><?php lang()->p( 'The transition between slides.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="slider_duration"><?php lang()->p( 'Duration' ); ?></label>
			<div class="col-sm-10 row">
				<div class="form-range-controls">
					<span class="form-range-value"><span id="slider_duration_value"><?php echo ( plugin()->getValue( 'slider_duration' ) ? plugin()->getValue( 'slider_duration' ) : plugin()->dbFields['slider_duration'] ); ?></span><span id="slider_duration_units">s</span></span>
					<input type="range" class="form-control-range custom-range" onInput="$('#slider_duration_value').html($(this).val())" id="slider_duration" name="slider_duration" value="<?php echo plugin()->getValue( 'slider_duration' ); ?>" min="1" max="6" step="0.5" />
					<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#slider_duration_value').text('<?php echo plugin()->dbFields['slider_duration']; ?>');$('#slider_duration').val('<?php echo plugin()->dbFields['slider_duration']; ?>');"><?php lang()->p( 'Default' ); ?></span>
				</div>
				<small class="form-text"><?php lang()->p( 'The duration in seconds for which each slide displays.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="slider_icon"><?php lang()->p( 'Loading Icon' ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="slider_icon" name="slider_icon">

					<option value="spinner-dots" <?php echo ( plugin()->getValue( 'slider_icon' ) === 'spinner-dots' ? 'selected' : '' ); ?>><?php lang()->p( 'Dots Circle' ); ?></option>

					<option value="spinner-dashes" <?php echo ( plugin()->getValue( 'slider_icon' ) === 'spinner-dashes' ? 'selected' : '' ); ?>><?php lang()->p( 'Dashes Circle' ); ?></option>

					<option value="spinner-third" <?php echo ( plugin()->getValue( 'slider_icon' ) === 'spinner-third' ? 'selected' : '' ); ?>><?php lang()->p( 'Third Circle' ); ?></option>

					<option value="none" <?php echo ( plugin()->getValue( 'slider_icon' ) === 'none' ? 'selected' : '' ); ?>><?php lang()->p( 'No Icon' ); ?></option>
				</select>
				<small class="form-text">
					<?php lang()->p( 'Choose the style of icon to display before slides are loaded.' ); ?>
				</small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="slider_arrows"><?php lang()->p( 'Previous/Next Icons' ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="slider_arrows" name="slider_arrows">

					<option value="arrow" <?php echo ( plugin()->getValue( 'slider_arrows' ) === 'arrow' ? 'selected' : '' ); ?>><?php lang()->p( 'Arrow' ); ?></option>

					<option value="angle" <?php echo ( plugin()->getValue( 'slider_arrows' ) === 'angle' ? 'selected' : '' ); ?>><?php lang()->p( 'Angle' ); ?></option>

					<option value="angles" <?php echo ( plugin()->getValue( 'slider_arrows' ) === 'angles' ? 'selected' : '' ); ?>><?php lang()->p( 'Double Angle' ); ?></option>

					<option value="none" <?php echo ( plugin()->getValue( 'slider_arrows' ) === 'none' ? 'selected' : '' ); ?>><?php lang()->p( 'None' ); ?></option>
				</select>
				<small class="form-text"><?php lang()->p( 'Display directional icons to navigate slides.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="slider_dots"><?php lang()->p( 'Slide Dots' ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="slider_dots" name="slider_dots">
					<option value="true" <?php echo ( plugin()->getValue( 'slider_dots' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Enabled' ); ?></option>
					<option value="false" <?php echo ( plugin()->getValue( 'slider_dots' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Disabled' ); ?></option>
				</select>
				<small class="form-text"><?php lang()->p( 'Display a row of dots to navigate slides.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="slider_link_text"><?php lang()->p( 'Link Text' ); ?></label>
			<div class="col-sm-10">
				<input type="text" id="slider_link_text" name="slider_link_text" value="<?php echo plugin()->getValue( 'slider_link_text' ); ?>" placeholder="<?php lang()->p( 'Read More' ); ?>" />
				<small class="form-text"><?php lang()->p( 'The slide text to display for the link to the content if not set in the content\'s custom field.' ); ?></small>
			</div>
		</div>
	</div>
</fieldset>
<?php endif; ?>

<h3 class="form-heading"><?php lang()->p( 'Related Posts' ); ?></h3>

<p><?php lang()->p( 'The related posts section is not displayed on static pages.' ); ?></p>

<fieldset>

	<legend class="screen-reader-text"><?php lang()->p( 'Show Related' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="related_posts"><?php lang()->p( 'Related Posts' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="related_posts" name="related_posts">
				<option value="true" <?php echo ( plugin()->getValue( 'related_posts' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'related_posts' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Show related posts on singular post pages.' ); ?></small>
		</div>
	</div>

	<div id="related_options" style="display: <?php echo ( plugin()->getValue( 'related_posts' ) === true ? 'block' : 'none' ); ?>;">

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="max_related"><?php lang()->p( 'Maximum Posts' ); ?></label>
			<div class="col-sm-10 row">
				<div class="form-range-controls">
					<span class="form-range-value"><span id="max_related_value"><?php echo ( plugin()->getValue( 'max_related' ) ? plugin()->getValue( 'max_related' ) : plugin()->dbFields['max_related'] ); ?></span></span>
					<input type="range" class="form-control-range custom-range" onInput="$('#max_related_value').html($(this).val())" id="max_related" name="max_related" value="<?php echo plugin()->getValue( 'max_related' ); ?>" min="1" max="9" step="1" />
					<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#max_related_value').text('<?php echo plugin()->dbFields['max_related']; ?>');$('#max_related').val('<?php echo plugin()->dbFields['max_related']; ?>');"><?php lang()->p( 'Default' ); ?></span>
				</div>
				<small class="form-text"><?php lang()->p( 'The number of related posts to display.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="related_heading"><?php lang()->p( 'Related Heading' ); ?></label>
			<div class="col-sm-10">
				<input type="text" id="related_heading" name="related_heading" value="<?php echo plugin()->getValue( 'related_heading' ); ?>" placeholder="<?php lang()->p( 'Related Posts' ); ?>" />
				<small class="form-text"><?php lang()->p( 'The text of the related posts heading. Save as empty for no heading.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="related_heading_el"><?php lang()->p( 'Heading Level' ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="related_heading_el" name="related_heading_el">

					<option value="h2" <?php echo ( plugin()->getValue( 'related_heading_el' ) === 'h2' ? 'selected' : '' ); ?>><?php lang()->p( 'H2' ); ?></option>

					<option value="h3" <?php echo ( plugin()->getValue( 'related_heading_el' ) === 'h3' ? 'selected' : '' ); ?>><?php lang()->p( 'H3' ); ?></option>

					<option value="h4" <?php echo ( plugin()->getValue( 'related_heading_el' ) === 'h4' ? 'selected' : '' ); ?>><?php lang()->p( 'H4' ); ?></option>
				</select>
				<small class="form-text"><?php lang()->p( 'The heading element to use for related posts.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="related_style"><?php lang()->p( 'Related Style' ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="related_style" name="related_style">

					<option value="list" <?php echo ( plugin()->getValue( 'related_style' ) === 'list' ? 'selected' : '' ); ?>><?php lang()->p( 'List' ); ?></option>

					<option value="grid" <?php echo ( plugin()->getValue( 'related_style' ) === 'grid' ? 'selected' : '' ); ?>><?php lang()->p( 'Grid' ); ?></option>
				</select>
				<small class="form-text"><?php lang()->p( 'Presentation style for related posts.' ); ?></small>
			</div>
		</div>
	</div>
</fieldset>

<h3 class="form-heading"><?php lang()->p( 'Custom Fields' ); ?></h3>

<p><?php lang()->p( 'Select the custom fields to add to page/post edit screens. See the options guide page, content tab, for the code the add fields manually.' ); ?></p>

<fieldset>
	<legend class="screen-reader-text"><?php lang()->p( 'Custom Fields Options' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cf_menu_label"><?php lang()->p( 'Menu Label' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="cf_menu_label" name="cf_menu_label">
				<option value="true" <?php echo ( plugin()->getValue( 'cf_menu_label' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'cf_menu_label' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Text for the page link in the navigation menus.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cf_random_cover"><?php lang()->p( 'Random Cover' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="cf_random_cover" name="cf_random_cover">
				<option value="true" <?php echo ( plugin()->getValue( 'cf_random_cover' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'cf_random_cover' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Displays a random cover image from images uploaded to the post/page.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cf_page_gallery"><?php lang()->p( 'Gallery' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="cf_page_gallery" name="cf_page_gallery">
				<option value="true" <?php echo ( plugin()->getValue( 'cf_page_gallery' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'cf_page_gallery' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Adds a gallery of images uploaded to the post/page.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cf_gallery_heading"><?php lang()->p( 'Gallery Heading' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="cf_gallery_heading" name="cf_gallery_heading">
				<option value="true" <?php echo ( plugin()->getValue( 'cf_gallery_heading' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'cf_gallery_heading' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Text used above the post/page\'s image gallery.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cf_read_more"><?php lang()->p( 'Read Link' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="cf_read_more" name="cf_read_more">
				<option value="true" <?php echo ( plugin()->getValue( 'cf_read_more' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'cf_read_more' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Text used if the content is linked in the front page slider or when abbreviated in some contexts.' ); ?></small>
		</div>
	</div>
</fieldset>

<?php

// If a 404 page has been set in Settings > Advanced.
if ( site()->pageNotFound() && has_error_widgets() ) :

?>
<h3 class="form-heading"><?php lang()->p( '404 Error Template' ); ?></h3>

<fieldset>

	<legend class="screen-reader-text"><?php lang()->p( '404 Error' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="error_widgets"><?php lang()->p( '404 Widgets' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="error_widgets" name="error_widgets">
				<option value="below" <?php echo ( plugin()->getValue( 'error_widgets' ) === 'below' ? 'selected' : '' ); ?>><?php lang()->p( 'Below Content' ); ?></option>
				<option value="above" <?php echo ( plugin()->getValue( 'error_widgets' ) === 'above' ? 'selected' : '' ); ?>><?php lang()->p( 'Above Content' ); ?></option>
				<option value="no_content" <?php echo ( plugin()->getValue( 'error_widgets' ) === 'no_content' ? 'selected' : '' ); ?>><?php lang()->p( 'No Content' ); ?></option>
				<option value="content" <?php echo ( plugin()->getValue( 'error_widgets' ) === 'content' ? 'selected' : '' ); ?>><?php lang()->p( 'Content Only' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Whether and where to display user suggestion widgets on the custom 404 error page.' ); ?></small>
		</div>
	</div>

	<div id="error_widget_options" style="display: <?php echo ( plugin()->getValue( 'error_widgets' ) != 'content' ? 'block' : 'none' ); ?>;">

		<h3 class="form-heading"><?php lang()->p( 'Error Page Options' ); ?></h3>

		<p><?php lang()->p( 'Choose which widgets to display and how to display them.' ); ?></p>

		<div class="tab-content" data-toggle="tabslet" data-deeplinking="false" data-animation="true">

			<ul class="nav nav-tabs" id="nav-tabs" role="tablist">

				<?php if ( getPLugin( 'Search_Forms' ) ) : ?>
				<li class="nav-item">
					<a class="nav-link" role="tab" aria-controls="search" aria-selected="false" href="#search"><?php lang()->p( 'Search' ); ?></a>
				</li>
				<?php endif; ?>

				<li class="nav-item">
					<a class="nav-link" role="tab" aria-controls="pages" aria-selected="false" href="#pages"><?php lang()->p( 'Pages' ); ?></a>
				</li>

				<?php if ( getPLugin( 'Categories_Lists' ) ) : ?>
				<li class="nav-item">
					<a class="nav-link" role="tab" aria-controls="categories" aria-selected="false" href="#categories"><?php lang()->p( 'Categories' ); ?></a>
				</li>
				<?php endif; ?>

				<?php if ( getPLugin( 'Tags_Lists' ) ) : ?>
				<li class="nav-item">
					<a class="nav-link" role="tab" aria-controls="tags" aria-selected="false" href="#tags"><?php lang()->p( 'Tags' ); ?></a>
				</li>
				<?php endif; ?>
			</ul>

			<?php if ( getPLugin( 'Search_Forms' ) ) : ?>
			<div id="search" class="tab-pane" role="tabpanel" aria-labelledby="search">

				<h3 class="form-heading"><?php lang()->p( 'Search Form' ); ?></h3>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="error_search"><?php lang()->p( 'Display' ); ?></label>
					<div class="col-sm-10">
						<select class="form-select" id="error_search" name="error_search">
							<option value="true" <?php echo ( plugin()->getValue( 'error_search' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Enabled' ); ?></option>
							<option value="false" <?php echo ( plugin()->getValue( 'error_search' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Disabled' ); ?></option>
						</select>
						<small class="form-text"><?php lang()->p( 'Display a search form on the error page.' ); ?></small>
					</div>
				</div>

				<div id="error_search_options">
					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_search_label"><?php lang()->p( 'Heading Text' ); ?></label>
						<div class="col-sm-10">
							<input type="text" id="error_search_label" name="error_search_label" value="<?php echo plugin()->getValue( 'error_search_label' ); ?>" placeholder="<?php lang()->p( 'Search' ); ?>" />
							<small class="form-text"><?php lang()->p( 'Save as blank for no heading.' ); ?></small>
						</div>
					</div>

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_search_heading"><?php lang()->p( 'Heading Element' ); ?></label>
						<div class="col-sm-10">
							<select class="form-select" id="error_search_heading" name="error_search_heading">
								<option value="h2" <?php echo ( plugin()->getValue( 'error_search_heading' ) === 'h2' ? 'selected' : '' ); ?>><?php lang()->p( 'H2' ); ?></option>
								<option value="h3" <?php echo ( plugin()->getValue( 'error_search_heading' ) === 'h3' ? 'selected' : '' ); ?>><?php lang()->p( 'H3' ); ?></option>
								<option value="h4" <?php echo ( plugin()->getValue( 'error_search_heading' ) === 'h4' ? 'selected' : '' ); ?>><?php lang()->p( 'H4' ); ?></option>
							</select>
							<small class="form-text"><?php lang()->p( 'Choose the heading level for the widget heading.' ); ?></small>
						</div>
					</div>

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_search_holder"><?php lang()->p( 'Placeholder' ); ?></label>
						<div class="col-sm-10">
							<input type="text" id="error_search_holder" name="error_search_holder" value="<?php echo plugin()->getValue( 'error_search_holder' ); ?>" placeholder="<?php echo $placeholder; ?>" />
							<small class="form-text"><?php lang()->p( 'Save as blank for no placeholder.' ); ?></small>
						</div>
					</div>

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_search_btn"><?php lang()->p( 'Form Button' ); ?></label>
						<div class="col-sm-10">
							<select class="form-select" id="error_search_btn" name="error_search_btn">
								<option value="true" <?php echo ( plugin()->getValue( 'error_search_btn' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Enabled' ); ?></option>
								<option value="false" <?php echo ( plugin()->getValue( 'error_search_btn' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Disabled' ); ?></option>
							</select>
							<small class="form-text"><?php lang()->p( 'Display the search submit button.' ); ?></small>
						</div>
					</div>

					<div id="error_search_btn_text_wrap" class="form-field form-group row" style="display: <?php echo ( plugin()->getValue( 'error_search_btn' ) === true ? 'flex' : 'none' ); ?>;">
						<label class="form-label col-sm-2 col-form-label" for="error_search_btn_text"><?php lang()->p( 'Button Text' ); ?></label>
						<div class="col-sm-10">
							<input type="text" id="error_search_btn_text" name="error_search_btn_text" value="<?php echo plugin()->getValue( 'error_search_btn_text' ); ?>" placeholder="<?php lang()->p( 'Submit' ); ?>" />
							<small class="form-text"><?php lang()->p( 'Text will not display if replaced by a search icon in General options but will remain as screen reader text.' ); ?></small>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<div id="pages" class="tab-pane" role="tabpanel" aria-labelledby="pages">

				<h3 class="form-heading"><?php lang()->p( 'Static Pages List' ); ?></h3>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="error_static"><?php lang()->p( 'Display' ); ?></label>
					<div class="col-sm-10">
						<select class="form-select" id="error_static" name="error_static">
							<option value="true" <?php echo ( plugin()->getValue( 'error_static' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Enabled' ); ?></option>
							<option value="false" <?php echo ( plugin()->getValue( 'error_static' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Disabled' ); ?></option>
						</select>
						<small class="form-text"><?php lang()->p( 'Display a linked list of pages on the error page.' ); ?></small>
					</div>
				</div>

				<div id="error_static_options">

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_static_title"><?php lang()->p( 'Heading Text' ); ?></label>
						<div class="col-sm-10">
							<input type="text" id="error_static_title" name="error_static_title" value="<?php echo plugin()->getValue( 'error_static_title' ); ?>" placeholder="<?php lang()->p( 'Pages' ); ?>" />
							<small class="form-text"><?php lang()->p( 'Save as blank for no heading.' ); ?></small>
						</div>
					</div>

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_static_heading"><?php lang()->p( 'Heading Element' ); ?></label>
						<div class="col-sm-10">
							<select class="form-select" id="error_static_heading" name="error_static_heading">
								<option value="h2" <?php echo ( plugin()->getValue( 'error_static_heading' ) === 'h2' ? 'selected' : '' ); ?>><?php lang()->p( 'H2' ); ?></option>
								<option value="h3" <?php echo ( plugin()->getValue( 'error_static_heading' ) === 'h3' ? 'selected' : '' ); ?>><?php lang()->p( 'H3' ); ?></option>
								<option value="h4" <?php echo ( plugin()->getValue( 'error_static_heading' ) === 'h4' ? 'selected' : '' ); ?>><?php lang()->p( 'H4' ); ?></option>
							</select>
							<small class="form-text"><?php lang()->p( 'Choose the heading level for the widget heading.' ); ?></small>
						</div>
					</div>

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_static_dir"><?php lang()->p( 'Direction' ); ?></label>
						<div class="col-sm-10">
							<select class="form-select" id="error_static_dir" name="error_static_dir">
								<option value="horz" <?php echo ( plugin()->getValue( 'error_static_dir' ) === 'horz' ? 'selected' : '' ); ?>><?php lang()->p( 'Horizontal' ); ?></option>
								<option value="vert" <?php echo ( plugin()->getValue( 'error_static_dir' ) === 'vert' ? 'selected' : '' ); ?>><?php lang()->p( 'Vertical' ); ?></option>
							</select>
							<small class="form-text"><?php lang()->p( 'Direction to display the list.' ); ?></small>
						</div>
					</div>
				</div>
			</div>

			<?php if ( getPLugin( 'Categories_Lists' ) ) : ?>
			<div id="categories" class="tab-pane" role="tabpanel" aria-labelledby="categories">

				<h3 class="form-heading"><?php lang()->p( 'Categories List' ); ?></h3>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="error_cats"><?php lang()->p( 'Display' ); ?></label>
					<div class="col-sm-10">
						<select class="form-select" id="error_cats" name="error_cats">
							<option value="true" <?php echo ( plugin()->getValue( 'error_cats' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Enabled' ); ?></option>
							<option value="false" <?php echo ( plugin()->getValue( 'error_cats' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Disabled' ); ?></option>
						</select>
						<small class="form-text"><?php lang()->p( 'Display a linked list of categories on the error page.' ); ?></small>
					</div>
				</div>

				<div id="error_cats_options">

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_cats_title"><?php lang()->p( 'Heading Text' ); ?></label>
						<div class="col-sm-10">
							<input type="text" id="error_cats_title" name="error_cats_title" value="<?php echo plugin()->getValue( 'error_cats_title' ); ?>" placeholder="<?php lang()->p( 'Categories' ); ?>" />
							<small class="form-text"><?php lang()->p( 'Save as blank for no heading.' ); ?></small>
						</div>
					</div>

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_cats_heading"><?php lang()->p( 'Heading Element' ); ?></label>
						<div class="col-sm-10">
							<select class="form-select" id="error_cats_heading" name="error_cats_heading">
								<option value="h2" <?php echo ( plugin()->getValue( 'error_cats_heading' ) === 'h2' ? 'selected' : '' ); ?>><?php lang()->p( 'H2' ); ?></option>
								<option value="h3" <?php echo ( plugin()->getValue( 'error_cats_heading' ) === 'h3' ? 'selected' : '' ); ?>><?php lang()->p( 'H3' ); ?></option>
								<option value="h4" <?php echo ( plugin()->getValue( 'error_cats_heading' ) === 'h4' ? 'selected' : '' ); ?>><?php lang()->p( 'H4' ); ?></option>
							</select>
							<small class="form-text"><?php lang()->p( 'Choose the heading level for the widget heading.' ); ?></small>
						</div>
					</div>

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_cats_dir"><?php lang()->p( 'Direction' ); ?></label>
						<div class="col-sm-10">
							<select class="form-select" id="error_cats_dir" name="error_cats_dir">
								<option value="horz" <?php echo ( plugin()->getValue( 'error_cats_dir' ) === 'horz' ? 'selected' : '' ); ?>><?php lang()->p( 'Horizontal' ); ?></option>
								<option value="vert" <?php echo ( plugin()->getValue( 'error_cats_dir' ) === 'vert' ? 'selected' : '' ); ?>><?php lang()->p( 'Vertical' ); ?></option>
							</select>
							<small class="form-text"><?php lang()->p( 'Direction to display the list.' ); ?></small>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<?php if ( getPLugin( 'Tags_Lists' ) ) : ?>
			<div id="tags" class="tab-pane" role="tabpanel" aria-labelledby="tags">

				<h3 class="form-heading"><?php lang()->p( 'Tags List' ); ?></h3>

				<div class="form-field form-group row">
					<label class="form-label col-sm-2 col-form-label" for="error_tags"><?php lang()->p( 'Display' ); ?></label>
					<div class="col-sm-10">
						<select class="form-select" id="error_tags" name="error_tags">
							<option value="true" <?php echo ( plugin()->getValue( 'error_tags' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Enabled' ); ?></option>
							<option value="false" <?php echo ( plugin()->getValue( 'error_tags' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Disabled' ); ?></option>
						</select>
						<small class="form-text"><?php lang()->p( 'Display a linked list of tags on the error page.' ); ?></small>
					</div>
				</div>

				<div id="error_tags_options">

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_tags_title"><?php lang()->p( 'Heading Text' ); ?></label>
						<div class="col-sm-10">
							<input type="text" id="error_tags_title" name="error_tags_title" value="<?php echo plugin()->getValue( 'error_tags_title' ); ?>" placeholder="<?php lang()->p( 'Post Tags' ); ?>" />
							<small class="form-text"><?php lang()->p( 'Save as blank for no heading.' ); ?></small>
						</div>
					</div>

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_tags_heading"><?php lang()->p( 'Heading Element' ); ?></label>
						<div class="col-sm-10">
							<select class="form-select" id="error_tags_heading" name="error_tags_heading">
								<option value="h2" <?php echo ( plugin()->getValue( 'error_tags_heading' ) === 'h2' ? 'selected' : '' ); ?>><?php lang()->p( 'H2' ); ?></option>
								<option value="h3" <?php echo ( plugin()->getValue( 'error_tags_heading' ) === 'h3' ? 'selected' : '' ); ?>><?php lang()->p( 'H3' ); ?></option>
								<option value="h4" <?php echo ( plugin()->getValue( 'error_tags_heading' ) === 'h4' ? 'selected' : '' ); ?>><?php lang()->p( 'H4' ); ?></option>
							</select>
							<small class="form-text"><?php lang()->p( 'Choose the heading level for the widget heading.' ); ?></small>
						</div>
					</div>

					<div class="form-field form-group row">
						<label class="form-label col-sm-2 col-form-label" for="error_tags_dir"><?php lang()->p( 'Direction' ); ?></label>
						<div class="col-sm-10">
							<select class="form-select" id="error_tags_dir" name="error_tags_dir">
								<option value="horz" <?php echo ( plugin()->getValue( 'error_tags_dir' ) === 'horz' ? 'selected' : '' ); ?>><?php lang()->p( 'Horizontal' ); ?></option>
								<option value="vert" <?php echo ( plugin()->getValue( 'error_tags_dir' ) === 'vert' ? 'selected' : '' ); ?>><?php lang()->p( 'Vertical' ); ?></option>
							</select>
							<small class="form-text"><?php lang()->p( 'Direction to display the list.' ); ?></small>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</fieldset>
<?php endif;
