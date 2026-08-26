<?php
/**
 * Plugin functions
 *
 * @package    Configure 8 Options
 * @subpackage Includes
 * @since      1.0.0
 */

namespace CFE_Plugin;

// Stop if accessed directly.
if ( ! defined( 'BLUDIT' ) ) {
	die( 'You are not allowed direct access to this file.' );
}

/**
 * Plugin object
 *
 * Gets this plugin's core class.
 *
 * @since  1.0.0
 * @return mixed Returns the class object or false.
 */
function plugin() {
	return \configureight :: instance();
}

/**
 * Site class object
 *
 * Function to use inside other functions and
 * methods rather than calling the global.
 *
 * @since  1.0.0
 * @global object $site Site class
 * @return object
 */
function site() {
	global $site;
	return $site;
}

/**
 * Login class object
 *
 * Function to use inside other functions and
 * methods rather than calling the global.
 *
 * @since  1.0.0
 * @global object $login Login class
 * @return object
 */
function login() {
	global $login;
	return $login;
}

/**
 * Url class object
 *
 * Function to use inside other functions and
 * methods rather than calling the global.
 *
 * @since  1.0.0
 * @global object $url Url class
 * @return object
 */
function url() {
	global $url;
	return $url;
}

/**
 * Language class object
 *
 * Function to use inside other functions and
 * methods rather than calling the global.
 *
 * @since  1.0.0
 * @global object $L Language class
 * @return object
 */
function lang() {
	global $L;
	return $L;
}

/**
 * Page class object
 *
 * Function to use inside other functions and
 * methods rather than calling the global.
 *
 * @since  1.0.0
 * @global object $page Page class
 * @return object
 */
function page() {
	global $page;
	return $page;
}

/**
 * Plugin sidebars count
 *
 * This counts plugins with the `adminSidebar()`
 * method implemented. Theme options plugin is
 * excluded from the count because this theme
 * adds a link for configuration options if a theme plugin
 * is available. So if the options configuration plugin
 * is the only plugin activated with a sidebar link
 * then the plugin links section is not printed.
 *
 * @since  1.0.0
 * @global array $plugins Array of active plugins.
 * @return integer Returns a number of plugins.
 */
function plugin_sidebars_count() {

	// Access global variables.
	global $plugins;

	if ( empty( $plugins['adminSidebar'] ) ) {
		return 0;
	}

	$count = 0;
	foreach ( $plugins['adminSidebar'] as $link ) {
		if ( 'theme' != $link->type() ) {
			$count++;
		}
	}
	return $count;
}

/**
 * Get SVG files
 *
 * @since  1.0.0
 * @param  string $filename Name of the SVG file.
 * @return mixed Returns the contents of the SVG file or
 *               returns null if the filename is not found.
 */
function get_svg_icon( $filename = '' ) {

	// Access global variables.
	global $site;

	$path = plugin()->phpPath() . 'assets' . DS . 'images' . DS . $filename . '.svg';
	$args = [
		'svg',
		'g',
		'path'
	];

	if ( is_file( $path ) && is_readable( $path ) ) {

		$file = strip_tags( $path, $args );
		return file_get_contents( $file );

	} else {
		return $path;
	}
}

/**
 * SVG icon
 *
 * Prints the contents of a given SVG file.
 *
 * @since  1.0.0
 * @param  string $filename Name of the SVG file.
 * @param  boolean $wrap Wraps the icon in HTML if true.
 * @param  string $class Additional class names for the wrapper.
 * @param  string $title Contents of the title attribute if
 *                       $wrap is true.
 * @return void
 */
function svg_icon( $filename, $wrap = true, $class = '' ) {

	if ( ! empty( $class ) ) {
		$class = ' ' . $class;
	}

	if ( true == $wrap ) {
		printf(
			'<span class="svg-icon%s">%s</span>',
			$class,
			get_svg_icon( $filename )
		);
	} else {
		echo get_svg_icon( $filename );
	}
}

/**
 * Asset file suffix
 *
 * Gets minified file if not in debug mode.
 * Third party (e.g. jQuery) may be exempted.
 *
 * @since  1.0.0
 * @return string Returns an empty string or
 *                `.min` string.
 */
function asset_min() {

	// Get non-minified file if in debug mode.
	if ( defined( 'DEBUG_MODE' ) && DEBUG_MODE ) {
		return '';
	}
	return '.min';
}

/**
 * Plugin domain
 *
 * @since  1.0.0
 * @param  string $dir The URL directory.
 * @return string Returns the URL.
 */
function domain( $dir = '/' ) {

	// Prepared directory variables.
	if ( 'css' === $dir ) {
		$dir = '/assets/css/';
	} elseif ( 'css_colors' === $dir ) {
		$dir = '/assets/css/colors/';
	} elseif ( 'css_fonts' === $dir ) {
		$dir = '/assets/css/fonts/';
	} elseif ( 'js' === $dir ) {
		$dir = '/assets/js/';
	} elseif ( 'images' === $dir ) {
		$dir = '/assets/images/';
	} elseif ( 'fonts' === $dir ) {
		$dir = '/assets/fonts/';
	}
	return DOMAIN_PLUGINS . plugin()->className() . $dir;
}

function css( $files, $base = '' ) {

	if ( ! is_array( $files ) ) {
		$files = [ $files ];
	}
	$base = domain();

	$links = '';
	foreach ( $files as $file ) {
		$links .= '<link rel="stylesheet" type="text/css" href="' . $base . $file . '?version=' . BLUDIT_VERSION . '">' . PHP_EOL;
	}
	return $links;
}

function js( $files, $base = '', $attributes = '' ) {

	if ( ! is_array( $files ) ) {
		$files = [ $files ];
	}
	$base = domain();

	$scripts = '';
	foreach ( $files as $file ) {
		$scripts .= '<script ' . $attributes . ' src="' . $base . $file . '?version=' . BLUDIT_VERSION . '"></script>' . PHP_EOL;
	}

	return $scripts;
}

/**
 * Is RTL language
 *
 * @since  1.0.0
 * @param  mixed $langs Arguments to be passed.
 * @param  array $rtl Default arguments.
 * @global object $L The Language class.
 * @return boolean Returns true if site is in RTL language.
 */
function is_rtl( $langs = null, $rtl = [] ) {

	// Access global variables.
	global $L;

	$rtl = [
		'ar',
		'fa',
		'he',
		'ks',
		'ku',
		'pa',
		'ps',
		'sd',
		'ug',
		'ur'
	];

	// Maybe override defaults.
	if ( is_array( $langs ) && $langs ) {
		$langs = array_merge( $rtl, $langs );
	} else {
		$langs = $rtl;
	}

	$current = $L->currentLanguageShortVersion();

	if ( is_array( $rtl ) && in_array( $current, $rtl ) ) {
		return true;
	}
	return false;
}

/**
 * Is front page
 *
 * If the front page is not the loop.
 *
 * @since  1.0.0
 * @global object $page The Page class.
 * @global object $site The Site class.
 * @global object $url The Url class.
 * @return boolean
 */
function is_front_page() {

	// Access global variables.
	global $page, $site, $url;

	if ( 'page' != $url->whereAmI() ) {
		return false;
	}

	if ( $site->homepage() && $page->key() == $site->homepage() ) {
		return true;
	}
	return false;
}

/**
 * Is static loop
 *
 * If a static page has the same slug as the loop slug.
 *
 * @since  1.0.0
 * @return boolean Return whether that page exists.
 */
function is_static_loop() {

	if ( static_loop_page() ) {
		return true;
	}
	return false;
}

/**
 * Static loop page
 *
 * @since  1.0.0
 * @global object $site The Site class.
 * @return mixed Returns the static loop page object or
 *               returns false if the page doesn't exist.
 */
function static_loop_page() {

	// Access global variables.
	global $site;

	// Get the blog slug setting.
	$loop_field = $site->getField( 'uriBlog' );

	// Remove slashes from field value, if set.
	$loop_key   = str_replace( '/', '', $loop_field );

	// Build a page using blog slug setting.
	$loop_page  = buildPage( $loop_key );

	// Return whether that page exists (could be built).
	if ( $loop_page ) {
		return $loop_page;
	}
	return false;
}

/**
 * System can search
 *
 * Checks if the system has search functionality.
 *
 * @since  1.0.0
 * @return boolean Returns true if a search plugin is activated.
 */
function can_search() {
	if (
		getPlugin( 'Search_Forms' ) ||
		getPlugin( 'pluginSearch' )
	) {
		return true;
	}
	return false;
}

/**
 * Custom fields
 *
 * @since  1.0.0
 * @global object $L The Language class.
 * @return array Returns an array for JSON encoding.
 */
function custom_fields() {

	// Access global variables.
	global $L, $site;

	// Menu label field.
	if ( plugin()->cf_menu_label() ) {
		$menu_field = [
			'menu_label' => [
				'type'  => 'string',
				'label' => $L->get( 'Menu Label' ),
				'tip'   => $L->get( 'Text used in the navigation menus.' )
			]
		];
	} else {
		$menu_field = [];
	}
	$fields = $menu_field;

	// Random cover checkbox field.
	$cover_field = [
		'random_cover' => [
			'type'  => 'bool',
			'label' => $L->get( 'Random Cover' ),
			'tip'   => $L->get( 'Display a random cover image from images uploaded to this page. Requires no cover image set.' )
		]
	];
	if ( plugin()->cf_random_cover() ) {
		$fields = array_merge( $menu_field, $cover_field );
	}

	// Page gallery checkbox field.
	$gallery_field = [
		'page_gallery' => [
			'type'  => 'bool',
			'label' => $L->get( 'Gallery' ),
			'tip'   => $L->get( 'Add a gallery of images uploaded to this page.' )
		]
	];
	if ( plugin()->cf_page_gallery() ) {
		$fields = array_merge( $fields, $gallery_field );
	}

	// Gallery heading field.
	$heading_field = [
		'gallery_heading' => [
			'type'        => 'string',
			'label'       => $L->get( 'Gallery Heading' ),
			'tip'         => $L->get( 'Text used above this page\'s image gallery.' ),
			'placeholder' => $L->get( 'Image Gallery' )
		]
	];
	if ( plugin()->cf_gallery_heading() ) {
		$fields = array_merge( $fields, $heading_field );
	}

	// Read more field.
	$more_field = [
		'read_more' => [
			'type'  => 'string',
			'label' => $L->get( 'Read Link' ),
			'tip'   => $L->get( 'Text used if this content is linked in the front page slider or when abbreviated in some contexts.' )
		]
	];
	if ( plugin()->cf_read_more() ) {
		$fields = array_merge( $fields, $more_field );
	}

	return $fields;
}

/**
 * Options list
 *
 * Displays a list of options and their values from
 * a specific plugin..
 *
 * @since  1.0.0
 * @param  mixed $plugin The class name of the plugin for which
 *                       options are displayed.
 * @global object $L The Language class.
 * @return mixed Returns the list markup or false.
 */
function options_list( $plugin = false ) {

	// Access global variables.
	global $L;

	// Get the plugin database.
	$db = false;
	if ( getPlugin( $plugin ) ) {
		$options = new $plugin;

		if ( is_array( $options->dbFields ) ) {
			$db = new \dbJSON( $options->filenameDb );
		}
	}

	// Get plugin object.
	$get_plugin = getPlugin( $plugin );

	$get = '';
	if ( ! $db ) {
		return false;
	}
	$get = $db->getDB();

	// Options list markup.
	$list  = sprintf(
		'<a name="%s"></a><div class="database-list"><h2>%s</h2>',
		$get_plugin->className(),
		$get_plugin->name()
	);
	$list .= '<ul class="dashboard-options-list">';
	foreach ( $get as $key => $value ) {

		// Convert boolean values to "true" or "false" text.
		if ( is_bool( $value ) ) {
			if ( 0 == $value ) {
				$value = $L->get( 'false' );
			}

			if ( 1 == $value ) {
				$value = $L->get( 'true' );
			}
		}

		// Convert empty string values to "empty" text.
		if ( is_string( $value ) && empty( $value ) ) {
			$value = $L->get( 'empty' );
		}

		// Convert empty array to visual array.
		if ( is_array( $value ) && 0 === count( $value ) ) {
			$value = '[ ]';
		} elseif ( is_array( $value ) ) {
			$array = [];
			foreach( $value as $k ) {
				$array[] = sprintf(
					'"%s"',
					$k
				);
			}
			$array = implode( ', ', $array );
			$value = "[{$array}]";
		}

		// Option list item.
		$list .= sprintf(
			'<li><span class="option-name">%s:</span> <span class="option-value">%s</span></li>',
			$key,
			$value
		);
	}
	$list .= '</ul></div>';

	return $list;
}

/**
 * Change theme
 *
 * Replaces admin theme value in the site database.
 *
 * @since  1.0.0
 * @return void
 */
function change_theme() {

	// Access global variables.
	global $site;

	// Define database file.
	$db_file = DB_SITE;

	// Get current admin theme.
	$current = '"adminTheme":"' . $site->adminTheme() . '"';
	if ( DEBUG_MODE ) {
		$current = '"adminTheme": "' . $site->adminTheme() . '"';
	}

	// Get database content.
	$content = file_get_contents( $db_file );
	$replace = '"adminTheme":"configureight"';
	if ( DEBUG_MODE ) {
		$replace = '"adminTheme": "configureight"';
	}

	// Change admin theme to Configureight.
	$content = str_replace( $current, $replace, $content );

	// Write theme into the database file.
	file_put_contents( $db_file, $content );
}

/**
 * Default theme
 *
 * Restore admin theme to default in the site database.
 *
 * @since  1.0.0
 * @return void
 */
function default_theme() {

	// Access global variables.
	global $site;

	// Define database file.
	$db_file = DB_SITE;

	// Get current admin theme.
	$current = '"adminTheme":"' . $site->adminTheme() . '"';
	if ( DEBUG_MODE ) {
		$current = '"adminTheme": "' . $site->adminTheme() . '"';
	}

	// Get database content.
	$content = file_get_contents( $db_file );
	$replace = '"adminTheme":"booty"';
	if ( DEBUG_MODE ) {
		$replace = '"adminTheme": "booty"';
	}

	// Change admin theme to default.
	$content = str_replace( $current, $replace, $content );

	// Write theme into the database file.
	file_put_contents ( $db_file, $content );
}

/**
 * Is admin theme directory empty
 *
 * @since  1.0.0
 * @param  string $themes_dir
 * @return mixed
 */
function is_dir_empty( $themes_dir ) {

    if ( ! is_readable( $themes_dir ) ) {
		return null;
	}
    return ( count( scandir( $themes_dir ) ) == 2 );
}

/**
 * Admin theme
 *
 * Checks for the Configure 8 admin theme.
 *
 * @since  1.0.0
 * @return boolean Returns true if the admin theme is
 *                 in hte admin themes directory.
 */
function admin_theme() {

	$themes_dir = PATH_ADMIN_THEMES;

	if ( ! is_readable( $themes_dir ) ) {
		return false;
	}

	$themes = [];
	foreach ( glob( $themes_dir . '*', GLOB_ONLYDIR ) as $theme ) {
		if ( ! is_dir_empty( $theme ) ) {

			// Truncate the theme path and keep the theme name only.
			$theme    = str_replace( $themes_dir, '', $theme );
			$themes[] = $theme;
		}
	}

	if ( is_array( $themes ) && in_array( 'configureight', $themes ) ) {
		return true;
	}
	return false;
}

/**
 * Suite plugins
 *
 * Array theme suite plugins classes and name.
 *
 * @since  1.0.0
 * @global object $L The Language class.
 * @return array
 */
function suite_plugins() {

	// Access global variables.
	global $L;

	$suite = [
		plugin()->className() => [
			'name'  => plugin()->name(),
			'url'   => plugin()->website(),
			'guide' => true
		],
		'Breadcrumbs' => [
			'name'  => $L->g( 'Breadcrumbs' ),
			'url'   => 'https://github.com/Bludiot/breadcrumbs',
			'guide' => true
		],
		'Categories_Lists' => [
			'name'  => $L->g( 'Categories Lists' ),
			'url'   => 'https://github.com/Bludiot/categories-lists',
			'guide' => true
		],
		'Meta_Data' => [
			'name'  => $L->g( 'Meta Data' ),
			'url'   => 'https://github.com/Bludiot/meta-data',
			'guide' => true
		],
		'Pages_Lists' => [
			'name'  => $L->g( 'Pages Lists' ),
			'url'   => 'https://github.com/Bludiot/pages-lists',
			'guide' => true
		],
		'Post_Comments' => [
			'name'  => $L->g( 'Post Comments' ),
			'url'   => 'https://github.com/Bludiot/post-comments',
			'guide' => '?page=guide'
		],
		'Posts_Lists' => [
			'name'  => $L->g( 'Posts Lists' ),
			'url'   => 'https://github.com/Bludiot/posts-lists',
			'guide' => true
		],
		'Search_Forms' => [
			'name'  => $L->g( 'Search Forms' ),
			'url'   => 'https://github.com/Bludiot/search-forms',
			'guide' => true
		],
		'Tags_Lists' => [
			'name'  => $L->g( 'Tags Lists' ),
			'url'   => 'https://github.com/Bludiot/tags-lists',
			'guide' => true
		],
		'User_Profiles' => [
			'name'  => $L->g( 'User Profiles' ),
			'url'   => 'https://github.com/Bludiot/user-profiles',
			'guide' => true
		]

	];
	asort( $suite );
	return $suite;
}

/**
 * Suite plugins
 *
 * Array theme suite plugins classes and name.
 *
 * @since  1.0.0
 * @global object $L The Language class.
 * @return array
 */
function suite_plugin_item( $class = false ) {

	$suite = suite_plugins();
	if ( $class && getPlugin( $class ) ) {
		return $suite[$class];
	}
	return false;
}

/**
 * Suite plugins active
 *
 * If any of the theme suite plugins are activated.
 *
 * @since  1.0.0
 * @global object $L The Language class.
 * @global array $pluginsInstalled.
 * @return boolean
 */
function suite_plugins_active() {

	// Access global variables.
	global $L, $pluginsInstalled;

	$suite = [];
	foreach ( $pluginsInstalled as $plugin ) {

		if ( 'configureight' === $plugin->className() ) {
			continue;
		}

		if (
			isset( $plugin->metadata['theme_compat'] ) &&
			is_array( $plugin->metadata['theme_compat'] ) &&
			in_array( 'configureight', $plugin->metadata['theme_compat'] )
		) {
			$suite[] = $plugin->className();
		}
	}
	return $suite;
}

/**
 * Suite plugins installed, not active
 *
 * If any of the theme suite plugins are activated.
 *
 * @since  1.0.0
 * @global array $plugins.
 * @global array $pluginsInstalled.
 * @return boolean
 */
function suite_plugins_inactive() {

	// Access global variables.
	global $plugins, $pluginsInstalled;

	$inactive = array_diff_key( $plugins['all'], $pluginsInstalled );
	$suite    = [];

	foreach ( $inactive as $plugin ) {

		if ( 'configureight' === $plugin->className() ) {
			continue;
		}

		if (
			isset( $plugin->metadata['theme_compat'] ) &&
			is_array( $plugin->metadata['theme_compat'] ) &&
			in_array( 'configureight', $plugin->metadata['theme_compat'] )
		) {
			$suite[] = $plugin->className();
		}
	}
	return $suite;
}

/**
 * Suite plugin is active
 *
 * If a specific theme suite plugins is activated.
 *
 * @since  1.0.0
 * @param  string $class Primary plugin class name.
 * @return boolean
 */
function suite_plugin_active( $class = '' ) {

	if ( getPlugin( $class ) ) {
		return true;
	}
	return false;
}

/**
 * Plugin options URL
 *
 * @since  1.0.0
 * @param  string $class Primary plugin class name.
 * @return mixed Returns the page URL or false.
 */
function plugin_options_url( $class = '' ) {

	if ( empty( $class ) ) {
		return false;
	}

	$url = HTML_PATH_ADMIN_ROOT . 'configure-plugin/' . $class;
	if ( BLUDIT_VERSION >= 4 ) {
		$url = HTML_PATH_ADMIN_ROOT . 'plugin-settings/' . $class;
	}
	return $url;
}

/**
 * Plugin guide URL
 *
 * @since  1.0.0
 * @param  string $class Primary plugin class name.
 * @return mixed Returns the page URL or false.
 */
function plugin_guide_url( $class = '' ) {

	if ( empty( $class ) ) {
		return false;
	}
	return HTML_PATH_ADMIN_ROOT . 'plugin/' . $class;
}

/**
 * Has error widgets
 *
 * Returns true if at lease on of the
 * dependant plugins for the error page
 * hook is installed.
 *
 * @since  1.0.0
 * @return boolean
 */
function has_error_widgets() {

	if (
		getPlugin( 'Search_Forms' ) ||
		getPlugin( 'Pages_Lists' ) ||
		getPlugin( 'Categories_Lists' ) ||
		getPlugin( 'Tags_Lists' )
	) {
		return true;
	}
	return false;
}

/**
 * Search error display
 *
 * @since  1.0.0
 * @return array Returns an array of modified arguments.
 */
function error_search_display() {

	// Get search plugin object,
	$search = getPlugin( 'Search_Forms' );
	if ( ! $search ) {
		return null;
	}

	// Set up arguments array.
	$args = [];

	if ( empty( plugin()->error_search_label() ) ) {
		$args['label'] = false;
	} else {
		$args['label'] = plugin()->error_search_label();
	}
	if ( plugin()->error_search_heading() ) {
		$args['label_el'] = plugin()->error_search_heading();
	}
	if ( empty( plugin()->error_search_holder() ) ) {
		$args['placeholder'] = '';
	} else {
		$args['placeholder'] = plugin()->error_search_holder();
	}
	if ( ! plugin()->error_search_btn() ) {
		$args['button'] = false;
	}
	if ( ! empty( plugin()->error_search_btn_text() ) ) {
		$args['button_text'] = plugin()->error_search_btn_text();
	}
	return $args;
}

/**
 * Static pages error display
 *
 * @since  1.0.0
 * @return array Returns an array of modified arguments.
 */
function error_static_display() {

	// Set up arguments array.
	$args = [];
	$args['wrap'] = true;
	$args['separator'] = ' | ';

	// List heading element.
	if ( plugin()->error_static_heading() ) {
		$args['label_el'] = plugin()->error_static_heading();
	}

	// List heading text.
	if ( plugin()->error_static_title() ) {
		$args['label'] = plugin()->error_static_title();
	}

	// List direction.
	if ( plugin()->error_static_dir() ) {
		$args['direction'] = plugin()->error_static_dir();
	}
	$args['pages_limit'] = 'all';

	return $args;
}

/**
 * Categories error display
 *
 * @since  1.0.0
 * @return array Returns an array of modified arguments.
 */
function error_cats_display() {

	// Set up arguments array.
	$args = [];
	$args['wrap'] = true;

	// List heading element.
	if ( plugin()->error_cats_heading() ) {
		$args['label_el'] = plugin()->error_cats_heading();
	}

	// List heading text.
	if ( plugin()->error_cats_title() ) {
		$args['label'] = plugin()->error_cats_title();
	}

	// List direction.
	if ( plugin()->error_cats_dir() ) {
		$args['direction'] = plugin()->error_cats_dir();
	}
	$args['show_count'] = true;

	return $args;
}

/**
 * Tags error display
 *
 * @since  1.0.0
 * @return array Returns an array of modified arguments.
 */
function error_tags_display() {

	// Set up arguments array.
	$args = [];
	$args['wrap'] = true;

	// List heading element.
	if ( plugin()->error_tags_heading() ) {
		$args['label_el'] = plugin()->error_tags_heading();
	}

	// List heading text.
	if ( plugin()->error_tags_title() ) {
		$args['label'] = plugin()->error_tags_title();
	}

	// List direction.
	if ( plugin()->error_tags_dir() ) {
		$args['direction'] = plugin()->error_tags_dir();
	}
	$args['show_count'] = true;

	return $args;
}

/**
 * File size format
 *
 * Converts a number of bytes to the largest unit the bytes will fit into.
 * Taken from WordPress.
 *
 * It is easier to read 1 KB than 1024 bytes and 1 MB than 1048576 bytes. Converts
 * number of bytes to human readable number by taking the number of that unit
 * that the bytes will go into it. Supports YB value.
 *
 * Please note that integers in PHP are limited to 32 bits, unless they are on
 * 64 bit architecture, then they have 64 bit size. If you need to place the
 * larger size then what PHP integer type will hold, then use a string. It will
 * be converted to a double, which should always have 64 bit length.
 *
 * Technically the correct unit names for powers of 1024 are KiB, MiB etc.
 *
 * @since  1.0.0
 * @param  integer|string $bytes Number of bytes. Note max integer size for integers.
 * @param  integer $decimals Optional. Precision of number of decimal places. Default 0.
 * @return mixed Number string on success, false on failure.
 */
function size_format( $bytes, $decimals = 0 ) {

	// Read bytes in chunks.
	$KB = 1024;
	$MB = 1024 * $KB;
	$GB = 1024 * $MB;
	$TB = 1024 * $GB;

	// Assign relevant units.
	$units = [
		'TB' => $TB,
		'GB' => $GB,
		'MB' => $MB,
		'KB' => $KB,
		'B'  => 1,
	];

	// Return 0 bytes if so.
	if ( 0 === $bytes ) {
		return '0 B';
	}

	// Return the size in relevant units.
	foreach ( $units as $unit => $mag ) {
		if ( (float) $bytes >= $mag ) {
			return number_format( $bytes / $mag, abs( (int) $decimals ) ) . ' ' . $unit;
		}
	}
	return false;
}
