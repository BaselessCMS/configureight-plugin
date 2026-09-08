<?php
/**
 * Navigation options fields
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

use function CFE_Plugin\{
	plugin,
	site,
	lang
};

// Get static pages, not posts.
$static = buildStaticPages();

?>

<h2 class="form-heading"><?php lang()->p( 'Navigation Options' ); ?></h2>

<fieldset>

	<legend class="screen-reader-text"><?php lang()->p( 'Navigation' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="main_nav_pages"><?php lang()->p( 'Main Menu Links' ); ?></label>

		<?php if ( isset( $static[0] ) ) : ?>
		<div class="col-sm-10">
			<small class="form-text"><?php lang()->p( 'Which static pages shall display in the main navigation menu. Use the page position feature on page edit screens to set the menu order.' ); ?></small>

			<div id="main-nav-pages-wrap" class="multi-check-wrap">
 				<?php
				$count_p = 0;
				$count_c = 0;
				if ( $static ) :

					// Sort by position.
					usort( $static, function( $a, $b ) {
						return $a->position() <=> $b->position();
					} );

					foreach ( $static as $page ) :

					$relation = '';
					$title    = lang()->get( 'Standalone page' );

					if ( $page->hasChildren() ) {

						$count_p++;
						$children    = $page->children();
						$child_names = [];
						foreach ( $children as $child ) {
							$child_names[] = $child->title();
						}
						asort( $child_names );
						$children = implode( ', ', $child_names );
						$relation = ' ' . lang()->get( '(p)' );
						$title    = lang()->get( 'Parent to ' ) . $children;

					} elseif ( $page->isChild() ) {

						$count_c++;
						$parent   = new \Page( $page->parentKey() );
						$relation = ' ' . lang()->get( '(c)' );
						$title    = lang()->get( 'Child of ' . $parent->title() );
					}

					if ( $page->key() === site()->homepage() ) {
						echo '';
					} elseif ( $page->slug() === str_replace( '/', '', site()->getField( 'uriBlog' ) ) ) {
						echo '';
					} elseif ( $page->slug() === site()->pageNotFound() ) {
						echo '';
					} else {
						printf(
							'<label class="check-label-wrap form-tooltip" for="page-%s" title="%s"><input type="checkbox" name="main_nav_pages[]" id="page-%s" value="%s" %s /> %s%s</label>',
							$page->key(),
							$title,
							$page->key(),
							$page->key(),
							( is_array( plugin()->main_nav_pages() ) && in_array( $page->key(), plugin()->main_nav_pages() ) ? 'checked' : '' ),
							$page->title(),
							$relation
						);
					}
				endforeach; endif;

				if ( site()->homepage() ) {
					printf(
						'<label class="check-label-wrap form-tooltip" for="page-home" title="%s"><input type="checkbox" name="main_nav_pages[]" id="page-home" value="home" %s> %s</label>',
						lang()->get( 'Static front page' ),
						( is_array( plugin()->main_nav_pages() ) && in_array( 'home', plugin()->main_nav_pages() ) ? 'checked' : '' ),
						lang()->get( 'Home' )
					);
				}
				printf(
					'<label class="check-label-wrap" for="foobar" style="display: none !important;"><input type="checkbox" name="main_nav_pages[]" id="foobar" value="foobar" checked /> %s</label>',
					lang()->get( 'Ignore This' )
				);
				?>
			</div>
			<?php if ( $count_p > 0 || $count_c > 0 ) : ?>
			<small class="form-text"><?php lang()->p( 'Hover parent pages (p) and child pages (c) to view the page relationship.' ); ?></small>
			<?php endif; ?>
		</div>
		<?php else : ?>
		<div class="col-sm-10">
			<p><?php lang()->p( 'Create at least one static page to display the page selection option.' ); ?></p>
		</div>
		<?php endif; ?>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="main_nav_loop"><?php lang()->p( 'Posts Loop Link' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="main_nav_loop" name="main_nav_loop">

				<option value="before" <?php echo ( plugin()->getValue( 'main_nav_loop' ) === 'before' ? 'selected' : '' ); ?>><?php lang()->p( 'Before Pages' ); ?></option>

				<option value="after" <?php echo ( plugin()->getValue( 'main_nav_loop' ) === 'after' ? 'selected' : '' ); ?>><?php lang()->p( 'After Pages' ); ?></option>

				<option value="none" <?php echo ( plugin()->getValue( 'main_nav_loop' ) === 'none' ? 'selected' : '' ); ?>><?php lang()->p( 'No Link' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Display a link to the posts loop, blog or news.' ); ?></small>
		</div>
	</div>

	<div id="main_nav_loop_label_wrap" class="form-field form-group row" style="display: <?php echo ( plugin()->getValue( 'main_nav_loop' ) != 'none' ? 'flex' : 'none' ); ?>;">
		<label class="form-label col-sm-2 col-form-label" for="main_nav_loop_label"><?php lang()->p( 'Loop Link Label' ); ?></label>
		<div class="col-sm-10">
			<input type="text" id="main_nav_loop_label" name="main_nav_loop_label" value="<?php echo plugin()->getValue( 'main_nav_loop_label' ); ?>" placeholder="<?php echo plugin()->dbFields['main_nav_loop_label']; ?>" />
			<small class="form-text"><?php lang()->p( 'The label for the posts loop link in the main navigation.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="main_nav_labels"><?php lang()->p( 'Menu Labels' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="main_nav_labels" name="main_nav_labels">

				<option value="slug" <?php echo ( plugin()->getValue( 'main_nav_labels' ) === 'slug' ? 'selected' : '' ); ?>><?php lang()->p( 'Friendly URL' ); ?></option>

				<option value="title" <?php echo ( plugin()->getValue( 'main_nav_labels' ) === 'title' ? 'selected' : '' ); ?>><?php lang()->p( 'Page Title' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'The text to be displayed in the page links. May be overridden by custom field in the page options.<br />The Friendly URL, also referred to as the page slug, will display capitalized with dashes and underscores removed.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="main_nav_children"><?php lang()->p( 'Child Pages' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="main_nav_children" name="main_nav_children">

				<option value="secondary" <?php echo ( plugin()->getValue( 'main_nav_children' ) === 'secondary' ? 'selected' : '' ); ?>><?php lang()->p( 'Sub Menu of Parents' ); ?></option>

				<option value="primary" <?php echo ( plugin()->getValue( 'main_nav_children' ) === 'primary' ? 'selected' : '' ); ?>><?php lang()->p( 'Top Level with Parents' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'How to treat child pages in the menu.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="main_nav_pos"><?php lang()->p( 'Navigation Position' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="main_nav_pos" name="main_nav_pos">

				<option value="right" <?php echo ( plugin()->getValue( 'main_nav_pos' ) === 'right' ? 'selected' : '' ); ?>><?php lang()->p( 'Right of Site Branding' ); ?></option>

				<option value="left" <?php echo ( plugin()->getValue( 'main_nav_pos' ) === 'left' ? 'selected' : '' ); ?>><?php lang()->p( 'Left of Site Branding' ); ?></option>

				<option value="above" <?php echo ( plugin()->getValue( 'main_nav_pos' ) === 'above' ? 'selected' : '' ); ?>><?php lang()->p( 'Above Site Branding' ); ?></option>

				<option value="below" <?php echo ( plugin()->getValue( 'main_nav_pos' ) === 'below' ? 'selected' : '' ); ?>><?php lang()->p( 'Below Site Branding' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Right and left options will be reversed for right-to-left languages.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="main_nav_icon"><?php lang()->p( 'Menu Icon' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="main_nav_icon" name="main_nav_icon">

				<option value="bars" <?php echo ( plugin()->getValue( 'main_nav_icon' ) === 'bars' ? 'selected' : '' ); ?>><?php lang()->p( 'Horizontal Bars' ); ?></option>

				<option value="dots-h" <?php echo ( plugin()->getValue( 'main_nav_icon' ) === 'dots-h' ? 'selected' : '' ); ?>><?php lang()->p( 'Horizontal Dots' ); ?></option>

				<option value="dots-v" <?php echo ( plugin()->getValue( 'main_nav_icon' ) === 'dots-v' ? 'selected' : '' ); ?>><?php lang()->p( 'Vertical Dots' ); ?></option>

				<option value="none" <?php echo ( plugin()->getValue( 'main_nav_icon' ) === 'none' ? 'selected' : '' ); ?>><?php lang()->p( 'None (Text)' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'The icon to toggle the mobile menu.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="header_search"><?php lang()->p( 'Search Form' ); ?></label>
		<div class="col-sm-10">
			<?php

			// If the Search plugin is installed and activated.
			if ( getPlugin( 'Search_Forms' ) ) : ?>
			<select class="form-select" id="header_search" name="header_search">
				<option value="true" <?php echo ( plugin()->getValue( 'header_search' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Enabled' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'header_search' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Display a search icon in the navigation to toggle the header search bar. Also enables the search form in mobile navigation.' ); ?></small>
			<?php

			// If the Search plugin is installed and not activated.
			elseif ( class_exists( 'Search_Forms' ) ) : ?>
				<?php printf(
					'<p class="form-text">%s<br /><a href="%s">%s</a></p>',
					lang()->get( 'Please activate the Search Forms plugin:' ),
					DOMAIN_ADMIN . 'install-plugin/Search_Forms',
					DOMAIN_ADMIN . 'install-plugin/Search_Forms'
				); ?>
			<?php

			// If the Search plugin is not installed in bl-plugins.
			else : ?>
				<?php printf(
					'<p class="form-text">%s<br /><a href="%s">%s</a></p>',
					lang()->get( 'Please download, install, and activate the Search Forms plugin:' ),
					'https://github.com/BaselessCMS/search-forms',
					lang()->get( 'GitHub Repository' )
				); ?>
			<?php endif; ?>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="header_social"><?php lang()->p( 'Social Links' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="header_social" name="header_social">
				<option value="true" <?php echo ( plugin()->getValue( 'header_social' ) === true ? 'selected' : '' ); ?>><?php lang()->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( plugin()->getValue( 'header_social' ) === false ? 'selected' : '' ); ?>><?php lang()->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text"><?php lang()->p( 'Display links to social media sites. See Settings > Social Networks in the admin menu to enter links.' ); ?></small>
		</div>
	</div>
</fieldset>
