<?php
/**
 * Loop options fields
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

 use function CFE_Plugin\{
	plugin,
	lang,
	is_rtl,
	is_static_loop
};

?>

<h3 class="form-heading"><?php lang()->p( 'Posts Loop Options' ); ?></h3>

<fieldset>

<p><?php lang()->p( 'The posts loop is serialized, non-static content; the blog/news feature of the website. This includes the main posts index as well as posts filtered by category or tag. Search pages are also a loop but not all of these options apply to site search.' ); ?></p>

	<legend class="screen-reader-text"><?php lang()->p( 'Posts Loop' ); ?></legend>

	<?php if ( ! is_static_loop() && plugin()->cover_src() ) : ?>
	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loop_cover"><?php lang()->p( 'Cover Image' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="loop_cover" name="loop_cover">

				<option value="standard" <?php echo ( plugin()->getValue( 'loop_cover' ) === 'standard' ? 'selected' : '' ); ?>><?php lang()->p( 'Standard Cover Each Page' ); ?></option>

				<option value="first" <?php echo ( plugin()->getValue( 'loop_cover' ) === 'first' ? 'selected' : '' ); ?>><?php lang()->p( 'Standard Cover First Page' ); ?></option>

				<option value="full_first" <?php echo ( plugin()->getValue( 'loop_cover' ) === 'full_first' ? 'selected' : '' ); ?>><?php lang()->p( 'Full Cover First Page, Standard After' ); ?></option>

				<option value="full_first_none" <?php echo ( plugin()->getValue( 'loop_cover' ) === 'full_first_none' ? 'selected' : '' ); ?>><?php lang()->p( 'Full Cover First Page, None After' ); ?></option>

				<option value="none" <?php echo ( plugin()->getValue( 'loop_cover' ) === 'none' ? 'selected' : '' ); ?>><?php lang()->p( 'No Cover Image' ); ?></option>
			</select>
			<small class="form-text">
				<?php lang()->p( 'Choose how the cover image is displayed in posts loop pages. Does not apply to taxonomy & search pages.' ); ?>
			</small>
		</div>
	</div>
	<?php endif; ?>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loop_type"><?php lang()->p( 'Loop Type' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="loop_type" name="loop_type">

				<option value="blog" <?php echo ( plugin()->getValue( 'loop_type' ) === 'blog' ? 'selected' : '' ); ?>><?php lang()->p( 'Blog' ); ?></option>

				<option value="news" <?php echo ( plugin()->getValue( 'loop_type' ) === 'news' ? 'selected' : '' ); ?>><?php lang()->p( 'News' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Choose the type of posts. Used in Schema tags for SEO.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loop_style"><?php lang()->p( 'Posts Loop Style' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="loop_style" name="loop_style">

				<option value="list" <?php echo ( plugin()->getValue( 'loop_style' ) === 'list' ? 'selected' : '' ); ?>><?php lang()->p( 'List' ); ?></option>

				<option value="grid" <?php echo ( plugin()->getValue( 'loop_style' ) === 'grid' ? 'selected' : '' ); ?>><?php lang()->p( 'Grid' ); ?></option>

				<option value="full" <?php echo ( plugin()->getValue( 'loop_style' ) === 'full' ? 'selected' : '' ); ?>><?php lang()->p( 'Full' ); ?></option>
			</select>
			<small class="form-text">
				<?php lang()->p( 'Choose the style of post content in the main loop.' ); ?>
				<br /><?php lang()->p( 'See Settings > General > Advanced in the admin menu to set the number pf articles per page.' ); ?>
			</small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loop_break"><?php lang()->p( 'Post Content Breaks' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="loop_break" name="loop_break">
				<option value="true" <?php echo ( plugin()->getValue( 'loop_break' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'loop_break' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Allow teaser text with a read more link. Does not apply to list and grid displays. Post needs a read more tag inserted by the content editor.' ); ?></small>
		</div>
	</div>

	<div id="content-break-options">
		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="loop_break_text"><?php lang()->p( 'Content Break Text' ); ?></label>
			<div class="col-sm-10">
				<input type="text" id="loop_break_text" name="loop_break_text" value="<?php echo plugin()->getValue( 'loop_break_text' ); ?>" placeholder="<?php echo plugin()->dbFields['loop_break_text']; ?>" />
				<small class="form-text"><?php lang()->p( 'The read more link text. This can be overridden per post by the <code>read_more</code> custom text field.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="loop_break_icon"><?php lang()->p( 'Content Break Icon' ); ?></label>
			<div class="col-sm-10">
				<div class="field-has-buttons">
					<select class="form-select" id="loop_break_icon" name="loop_break_icon">

						<option value="arrow" <?php echo ( plugin()->getValue( 'loop_break_icon' ) === 'arrow' ? 'selected' : '' ); ?>><?php lang()->p( 'Arrow' ); ?> ( <?php echo ( is_rtl() ? '←' : '→' ); ?> )</option>

						<option value="angle" <?php echo ( plugin()->getValue( 'loop_break_icon' ) === 'angle' ? 'selected' : '' ); ?>><?php lang()->p( 'Angle' ); ?> ( &gt; )</option>

						<option value="angles" <?php echo ( plugin()->getValue( 'loop_break_icon' ) === 'angles' ? 'selected' : '' ); ?>><?php lang()->p( 'Double Angle' ); ?> ( &#8811; )</option>

						<option value="none" <?php echo ( plugin()->getValue( 'loop_break_icon' ) === 'none' ? 'selected' : '' ); ?>><?php lang()->p( 'None' ); ?></option>
					</select>
				</div>
				<small class="form-text"><?php lang()->p( 'Directional characters are adjusted for language direction.' ); ?></small>
			</div>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="cat_style"><?php lang()->p( 'Category Loop Style' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="cat_style" name="cat_style">

				<option value="inherit" <?php echo ( plugin()->getValue( 'cat_style' ) === 'inherit' ? 'selected' : '' ); ?>><?php lang()->p( 'Inherit from Loop' ); ?></option>

				<option value="list" <?php echo ( plugin()->getValue( 'cat_style' ) === 'list' ? 'selected' : '' ); ?>><?php lang()->p( 'List' ); ?></option>

				<option value="grid" <?php echo ( plugin()->getValue( 'cat_style' ) === 'grid' ? 'selected' : '' ); ?>><?php lang()->p( 'Grid' ); ?></option>

				<option value="full" <?php echo ( plugin()->getValue( 'cat_style' ) === 'full' ? 'selected' : '' ); ?>><?php lang()->p( 'Full' ); ?></option>
			</select>
			<small class="form-text">
				<?php lang()->p( 'Choose the style of post content in category loops.' ); ?>
			</small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="tag_style"><?php lang()->p( 'Tag Loop Style' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="tag_style" name="tag_style">

				<option value="inherit" <?php echo ( plugin()->getValue( 'tag_style' ) === 'inherit' ? 'selected' : '' ); ?>><?php lang()->p( 'Inherit from Loop' ); ?></option>

				<option value="list" <?php echo ( plugin()->getValue( 'tag_style' ) === 'list' ? 'selected' : '' ); ?>><?php lang()->p( 'List' ); ?></option>

				<option value="grid" <?php echo ( plugin()->getValue( 'tag_style' ) === 'grid' ? 'selected' : '' ); ?>><?php lang()->p( 'Grid' ); ?></option>

				<option value="full" <?php echo ( plugin()->getValue( 'tag_style' ) === 'full' ? 'selected' : '' ); ?>><?php lang()->p( 'Full' ); ?></option>
			</select>
			<small class="form-text">
				<?php lang()->p( 'Choose the style of post content in tag loops.' ); ?>
			</small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loop_paged"><?php lang()->p( 'Loop Pagination' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="loop_paged" name="loop_paged">

				<option value="numerical" <?php echo ( plugin()->getValue( 'loop_paged' ) === 'numerical' ? 'selected' : '' ); ?>><?php lang()->p( 'Numerical' ); ?></option>

				<option value="prev_next" <?php echo ( plugin()->getValue( 'loop_paged' ) === 'prev_next' ? 'selected' : '' ); ?>><?php lang()->p( 'Previous/Next' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Choose the style of navigation between pages loops.' ); ?></small>
		</div>
	</div>
</fieldset>

<h3 class="form-heading"><?php lang()->p( 'Loop Details Options' ); ?></h3>

<fieldset>

	<legend class="screen-reader-text"><?php lang()->p( 'Loop Details' ); ?></legend>

	<p class="form-text"><?php lang()->p( 'These options only affect posts in the main loop. Display may vary by loop style when viewing a single page.' ); ?></p>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loop_byline"><?php lang()->p( 'Author Byline' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="loop_byline" name="loop_byline">
				<option value="true" <?php echo ( plugin()->getValue( 'loop_byline' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'loop_byline' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( '' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loop_date"><?php lang()->p( 'Post Date' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="loop_date" name="loop_date">
				<option value="true" <?php echo ( plugin()->getValue( 'loop_date' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'loop_date' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( '' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loop_word_count"><?php lang()->p( 'Word Count' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="loop_word_count" name="loop_word_count">
				<option value="true" <?php echo ( plugin()->getValue( 'loop_word_count' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'loop_word_count' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( '' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loop_read_time"><?php lang()->p( 'Read Time' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="loop_read_time" name="loop_read_time">
				<option value="true" <?php echo ( plugin()->getValue( 'loop_read_time' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'loop_read_time' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( '' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="loop_icons"><?php lang()->p( 'Icons' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="loop_icons" name="loop_icons">
				<option value="true" <?php echo ( plugin()->getValue( 'loop_icons' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'loop_icons' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Display category and tags icons.' ); ?></small>
		</div>
	</div>
</fieldset>
