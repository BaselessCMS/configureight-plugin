<?php
/**
 * Font functions
 *
 * @package    Configure 8 Options
 * @subpackage Includes
 * @since      1.0.0
 */

namespace CFE_Fonts;

// Access namespaced functions.
use function CFE_Plugin\{
	plugin,
	domain,
	lang
};

/**
 * Load font files
 *
 * @since  1.0.0
 * @return mixed Returns link tags for the `<head>` or null.
 */
function load_font_files() {

	// Get the font scheme setting.
	$fonts = plugin()->font_scheme();

	// Stop if default font, no directory exists.
	if ( 'default' == $fonts || empty( plugin()->font_scheme() ) ) {
		return null;
	}
	$valid = [ 'woff', 'woff2', 'otf', 'ttf' ];
	$files = scandir( PATH_PLUGINS . plugin()->className() . "/assets/fonts/{$fonts}/" );
	$tags  = '';

	foreach ( $files as $font => $file ) {

		$href = domain( "/assets/fonts/{$fonts}/{$file}" );
		$tab = '	';

		// Get the font file extension.
		$info = pathinfo( $file );
		$type = $info['extension'];
		if ( 'ttf' == $info ) {
			$type = 'truetype';
		}

		if ( ! in_array( $type, $valid ) ) {
			$tags  .= '';
		} else {
			$tags .= sprintf(
				'<link rel="preload" href="%s" as="font" type="font/%s" crossorigin="anonymous">',
				$href,
				$type
			) . "\n" . $tab;
		}
	}
	return $tags;
}

/**
 * Basic font schemes
 *
 * Listed first in the option.
 *
 * @since  1.0.0
 * @return array Returns array of font schemes data.
 */
function basic_font_schemes() {

	$schemes = [
		'default' => [
			'slug'  => 'default',
			'name'  => lang()->get( 'Default' ),
			'about' => lang()->get( 'Uses the default system sans-serif font.' ),
			'text'  => [
				'family'  => lang()->get( 'Sans-Serif' ),
				'stack'   => "-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => false,
				'size'    => '1rem',
				'weight'  => '400',
				'min'     => '100',
				'max'     => '1000',
				'step'    => '300',
				'space'   => '0',
				'variant' => 'normal'
			],
			'primary' => [
				'family'  => lang()->get( 'Sans-Serif' ),
				'stack'   => "-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => false,
				'size'    => '2rem',
				'weight'  => '700',
				'min'     => '100',
				'max'     => '1000',
				'step'    => '300',
				'space'   => '-0.015',
				'variant' => 'normal'
			],
			'secondary' => [
				'family'  => lang()->get( 'Sans-Serif' ),
				'stack'   => "-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => false,
				'size'    => '1.375rem',
				'weight'  => '700',
				'min'     => '100',
				'max'     => '1000',
				'step'    => '300',
				'space'   => '0',
				'variant' => 'normal'
			],
			'display' => [
				'family'  => lang()->get( 'Sans-Serif' ),
				'stack'   => "-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => false,
				'size'    => 'inherit',
				'weight'  => '600',
				'min'     => '100',
				'max'     => '1000',
				'step'    => '100',
				'space'   => '0',
				'variant' => 'normal'
			]
		],
		'sans' => [
			'slug'     => 'sans',
			'name'     => lang()->get( 'Sans Serif' ),
			'about'    => lang()->get( 'An easy to read sans-serif scheme.' ),
			'text'     => [
				'family'  => 'Inter',
				'stack'   => "'Inter', 'Helvetica Neue', Helvetica, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => '1rem',
				'weight'  => '385',
				'min'     => '100',
				'max'     => '900',
				'step'    => '1',
				'space'   => '0',
				'variant' => 'normal'
			],
			'primary' => [
				'family'  => 'Inter',
				'stack'   => "'Inter', 'Helvetica Neue', Helvetica, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => '2rem',
				'weight'  => '800',
				'min'     => '100',
				'max'     => '900',
				'step'    => '1',
				'space'   => '-0.025',
				'variant' => 'normal'
			],
			'secondary' => [
				'family'  => 'Inter',
				'stack'   => "'Inter', 'Helvetica Neue', Helvetica, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => '1.375rem',
				'weight'  => '700',
				'min'     => '100',
				'max'     => '900',
				'step'    => '1',
				'space'   => '-0.02',
				'variant' => 'normal'
			],
			'display' => [
				'family'  => 'Inter',
				'stack'   => "'Inter', 'Helvetica Neue', Helvetica, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => 'inherit',
				'weight'  => '600',
				'min'     => '100',
				'max'     => '900',
				'step'    => '1',
				'space'   => '0',
				'variant' => 'normal'
			]
		],
		'serif' => [
			'slug'     => 'serif',
			'name'     => lang()->get( 'Serif' ),
			'about'    => lang()->get( 'An easy to read serif scheme.' ),
			'text'     => [
				'family'  => lang()->get( 'Georgia' ),
				'stack'   => "Georgia, 'Hoefler Text', 'Baskerville Old Face', Garamond, Times, 'Times New Roman', serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => false,
				'size'    => '1.0625rem',
				'weight'  => '400',
				'min'     => '100',
				'max'     => '1000',
				'step'    => '300',
				'space'   => '0',
				'variant' => 'normal'
			],
			'primary' => [
				'family'  => 'Crimson Pro',
				'stack'   => "'Crimson Pro', Georgia, 'Hoefler Text', 'Baskerville Old Face', Garamond, Times, 'Times New Roman', serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => '2.5rem',
				'weight'  => '550',
				'min'     => '200',
				'max'     => '900',
				'step'    => '1',
				'space'   => '-0.025',
				'variant' => 'normal'
			],
			'secondary' => [
				'family'  => 'Crimson Pro',
				'stack'   => "'Crimson Pro', Georgia, 'Hoefler Text', 'Baskerville Old Face', Garamond, Times, 'Times New Roman', serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => '1.75rem',
				'weight'  => '550',
				'min'     => '200',
				'max'     => '900',
				'step'    => '1',
				'space'   => '-0.025',
				'variant' => 'normal'
			],
			'display' => [
				'family'  => 'Crimson Pro',
				'stack'   => "'Crimson Pro', Georgia, 'Hoefler Text', 'Baskerville Old Face', Garamond, Times, 'Times New Roman', serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => 'inherit',
				'weight'  => '570',
				'min'     => '200',
				'max'     => '900',
				'step'    => '1',
				'space'   => '0',
				'variant' => 'normal'
			]
		]
	];
	return $schemes;
}

/**
 * Style font schemes
 *
 * @since  1.0.0
 * @return array Returns array of font schemes data.
 */
function style_font_schemes() {

	$schemes = [
		'code' => [
			'slug'     => 'code',
			'name'     => lang()->get( 'Code' ),
			'about'    => lang()->get( 'A multi-weight monospace scheme.' ),
			'text'     => [
				'family'  => 'Source Code Pro',
				'stack'   => "'Source Code Pro', 'Roboto Mono', 'Fira Code', 'Liberation Mono', Inconsolata, Menlo, Monaco, Consolas, 'Cascadia Mono', 'Segoe UI Mono', 'Oxygen Mono', 'Ubuntu Monospace', 'Fira Mono', 'Droid Sans Mono', 'Courier New', Courier, ui-monospace, monospace, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => '1rem',
				'weight'  => '400',
				'min'     => '200',
				'max'     => '900',
				'step'    => '1',
				'space'   => '0',
				'variant' => 'normal'
			],
			'primary' => [
				'family'  => 'Source Code Pro',
				'stack'   => "'Source Code Pro', 'Roboto Mono', 'Fira Code', 'Liberation Mono', Inconsolata, Menlo, Monaco, Consolas, 'Cascadia Mono', 'Segoe UI Mono', 'Oxygen Mono', 'Ubuntu Monospace', 'Fira Mono', 'Droid Sans Mono', 'Courier New', Courier, ui-monospace, monospace, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => '2rem',
				'weight'  => '700',
				'min'     => '200',
				'max'     => '900',
				'step'    => '1',
				'space'   => '0',
				'variant' => 'normal'
			],
			'secondary' => [
				'family' => 'Source Code Pro',
				'stack'  => "'Source Code Pro', 'Roboto Mono', 'Fira Code', 'Liberation Mono', Inconsolata, Menlo, Monaco, Consolas, 'Cascadia Mono', 'Segoe UI Mono', 'Oxygen Mono', 'Ubuntu Monospace', 'Fira Mono', 'Droid Sans Mono', 'Courier New', Courier, ui-monospace, monospace, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => '1.375rem',
				'weight'  => '700',
				'min'     => '200',
				'max'     => '900',
				'step'    => '1',
				'space'   => '0',
				'variant' => 'normal'
			],
			'display' => [
				'family'  => 'Source Code Pro',
				'stack'   => "'Source Code Pro', 'Roboto Mono', 'Fira Code', 'Liberation Mono', Inconsolata, Menlo, Monaco, Consolas, 'Cascadia Mono', 'Segoe UI Mono', 'Oxygen Mono', 'Ubuntu Monospace', 'Fira Mono', 'Droid Sans Mono', 'Courier New', Courier, ui-monospace, monospace, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => 'inherit',
				'weight'  => '600',
				'min'     => '200',
				'max'     => '900',
				'step'    => '1',
				'space'   => '-0.0325',
				'variant' => 'normal'
			]
		],
		'condensed' => [
			'slug'     => 'condensed',
			'name'     => lang()->get( 'Condensed' ),
			'about'    => lang()->get( '' ),
			'text'     => [
				'family'  => 'Roboto',
				'stack'   => "'Roboto', 'Franklin Gothic Medium', 'Franklin Gothic', 'Open Sans', Tahoma, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => '1rem',
				'weight'  => '400',
				'min'     => '200',
				'max'     => '800',
				'step'    => '1',
				'space'   => '-0.01',
				'variant' => 'normal'
			],
			'primary' => [
				'family'  => 'Roboto Condensed',
				'stack'   => "'Roboto Condensed', 'Oswald', Impact, 'Franklin Gothic', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => '2rem',
				'weight'  => '700',
				'min'     => '300',
				'max'     => '700',
				'step'    => '1',
				'space'   => '-0.03',
				'variant' => 'normal'
			],
			'secondary' => [
				'family' => 'Roboto Condensed',
				'stack'  => "'Roboto Condensed', 'Oswald', Impact, 'Franklin Gothic', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => '1.375rem',
				'weight'  => '700',
				'min'     => '300',
				'max'     => '700',
				'step'    => '1',
				'space'   => '-0.03',
				'variant' => 'normal'
			],
			'display' => [
				'family'  => 'Roboto Condensed',
				'stack'   => "'Roboto Condensed', 'Oswald', Impact, 'Franklin Gothic', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => 'inherit',
				'weight'  => '600',
				'min'     => '300',
				'max'     => '700',
				'step'    => '1',
				'space'   => '-0.03',
				'variant' => 'normal'
			]
		],
		'cosmo' => [
			'slug'     => 'cosmo',
			'name'     => lang()->get( 'Cosmopolitan' ),
			'about'    => lang()->get( '' ),
			'text'     => [
				'family'  => 'Raleway',
				'stack'   => "'Raleway', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => '1.0625rem',
				'weight'  => '450',
				'min'     => '100',
				'max'     => '900',
				'step'    => '1',
				'space'   => '0',
				'variant' => 'normal'
			],
			'primary' => [
				'family'  => 'Playfair',
				'stack'   => "'Playfair', 'Hoefler Text', 'Baskerville Old Face', Garamond, serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => '2.5rem',
				'weight'  => '550',
				'min'     => '400',
				'max'     => '900',
				'step'    => '1',
				'space'   => '0',
				'variant' => 'normal'
			],
			'secondary' => [
				'family'  => 'Playfair',
				'stack'   => "'Playfair', 'Hoefler Text', 'Baskerville Old Face', Garamond, serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => '1.5625rem',
				'weight'  => '600',
				'min'     => '400',
				'max'     => '900',
				'step'    => '1',
				'space'   => '0',
				'variant' => 'normal'
			],
			'display' => [
				'family'  => 'Playfair',
				'stack'   => "'Playfair', 'Hoefler Text', 'Baskerville Old Face', Garamond, serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => 'inherit',
				'weight'  => '500',
				'min'     => '400',
				'max'     => '900',
				'step'    => '1',
				'space'   => '0',
				'variant' => 'normal'
			]
		],
		'modern' => [
			'slug'     => 'modern',
			'name'     => lang()->get( 'Modern' ),
			'about'    => lang()->get( '' ),
			'text'     => [
				'family'  => 'Nunito Sans',
				'stack'   => "'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => '1.125rem',
				'weight'  => '465',
				'min'     => '200',
				'max'     => '1000',
				'step'    => '1',
				'space'   => '0',
				'variant' => 'normal'
			],
			'primary' => [
				'family'  => 'Montserrat',
				'stack'   => "'Montserrat', 'Helvetica Neue', Helvetica, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => '2rem',
				'weight'  => '600',
				'min'     => '100',
				'max'     => '900',
				'step'    => '1',
				'space'   => '0.013',
				'variant' => 'small-caps'
			],
			'secondary' => [
				'family'  => 'Montserrat',
				'stack'   => "'Montserrat', 'Helvetica Neue', Helvetica, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => '1.375rem',
				'weight'  => '600',
				'min'     => '100',
				'max'     => '900',
				'step'    => '1',
				'space'   => '0.025',
				'variant' => 'small-caps'
			],
			'display' => [
				'family'  => 'Montserrat',
				'stack'   => "'Montserrat', 'Helvetica Neue', Helvetica, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => 'inherit',
				'weight'  => '550',
				'min'     => '100',
				'max'     => '900',
				'step'    => '1',
				'space'   => '0',
				'variant' => 'small-caps'
			]
		],
		'notepad' => [
			'slug'     => 'notepad',
			'name'     => lang()->get( 'Notepad' ),
			'about'    => lang()->get( 'A casual, hand-printed scheme.' ),
			'text'     => [
				'family'  => lang()->get( 'Sans-Serif' ),
				'stack'   => "'Shantell Sans', 'Segoe Print', 'Bradley Hand', Chilanka, TSCu_Comic, casual, cursive, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => false,
				'size'    => '1rem',
				'weight'  => '400',
				'min'     => '300',
				'max'     => '800',
				'step'    => '300',
				'space'   => '0',
				'variant' => 'normal'
			],
			'primary' => [
				'family'  => 'Shantell Sans',
				'stack'   => "'Shantell Sans', 'Segoe Print', 'Bradley Hand', Chilanka, TSCu_Comic, casual, cursive, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => '2.5rem',
				'weight'  => '600',
				'min'     => '300',
				'max'     => '800',
				'step'    => '1',
				'space'   => '0',
				'variant' => 'normal'
			],
			'secondary' => [
				'family'  => 'Shantell Sans',
				'stack'   => "'Shantell Sans', 'Segoe Print', 'Bradley Hand', Chilanka, TSCu_Comic, casual, cursive, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => '1.625rem',
				'weight'  => '550',
				'min'     => '300',
				'max'     => '800',
				'step'    => '1',
				'space'   => '0',
				'variant' => 'normal'
			],
			'display' => [
				'family'  => 'Shantell Sans',
				'stack'   => "'Shantell Sans', 'Segoe Print', 'Bradley Hand', Chilanka, TSCu_Comic, casual, cursive, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => 'inherit',
				'weight'  => '500',
				'min'     => '300',
				'max'     => '800',
				'step'    => '1',
				'space'   => '0',
				'variant' => 'normal'
			]
		],
		'signage' => [
			'slug'     => 'signage',
			'name'     => lang()->get( 'Signage' ),
			'about'    => lang()->get( '' ),
			'text'     => [
				'family'  => lang()->get( 'Sans-Serif' ),
				'stack'   => " -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => false,
				'size'    => '1rem',
				'weight'  => '400',
				'min'     => '100',
				'max'     => '1000',
				'step'    => '300',
				'space'   => '0',
				'variant' => 'normal'
			],
			'primary' => [
				'family'  => 'Alkatra',
				'stack'   => "'Alkatra', 'Segoe Print', 'Bradley Hand', Chilanka, TSCu_Comic, casual, cursive, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => '2rem',
				'weight'  => '700',
				'min'     => '400',
				'max'     => '700',
				'step'    => '1',
				'space'   => '-0.025',
				'variant' => 'normal'
			],
			'secondary' => [
				'family'  => 'Alkatra',
				'stack'   => "'Alkatra', 'Segoe Print', 'Bradley Hand', Chilanka, TSCu_Comic, casual, cursive, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => '1.375rem',
				'weight'  => '600',
				'min'     => '400',
				'max'     => '700',
				'step'    => '1',
				'space'   => '0',
				'variant' => 'normal'
			],
			'display' => [
				'family'  => 'Alkatra',
				'stack'   => "'Alkatra', 'Segoe Print', 'Bradley Hand', Chilanka, TSCu_Comic, casual, cursive, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => 'inherit',
				'weight'  => '550',
				'min'     => '400',
				'max'     => '700',
				'step'    => '1',
				'space'   => '-0.025',
				'variant' => 'normal'
			]
		],
		'slab' => [
			'slug'     => 'slab',
			'name'     => lang()->get( 'Slab Serif' ),
			'about'    => lang()->get( '' ),
			'text'     => [
				'family'  => lang()->get( 'Sans-Serif' ),
				'stack'   => "-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => false,
				'size'    => '1rem',
				'weight'  => '400',
				'min'     => '100',
				'max'     => '1000',
				'step'    => '300',
				'space'   => '0',
				'variant' => 'normal'
			],
			'primary' => [
				'family'  => 'Rokkitt',
				'stack'   => "'Rokkitt', 'Hoefler Text', Garamond, serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => '2.5rem',
				'weight'  => '750',
				'min'     => '100',
				'max'     => '900',
				'step'    => '1',
				'space'   => '-0.025',
				'variant' => 'normal'
			],
			'secondary' => [
				'family'  => 'Rokkitt',
				'stack'   => "'Rokkitt', 'Hoefler Text', Garamond, serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => '1.625rem',
				'weight'  => '750',
				'min'     => '100',
				'max'     => '900',
				'step'    => '1',
				'space'   => '0',
				'variant' => 'normal'
			],
			'display' => [
				'family'  => 'Rokkitt',
				'stack'   => "'Rokkitt', 'Hoefler Text', Garamond, serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'",
				'var'     => true,
				'size'    => 'inherit',
				'weight'  => '600',
				'min'     => '100',
				'max'     => '900',
				'step'    => '1',
				'space'   => '-0.015',
				'variant' => 'normal'
			]
		]
	];
	return $schemes;
}

/**
 * All font schemes
 *
 * Merges basic schemes and style schemes.
 *
 * @since  1.0.0
 * @return array
 */
function font_schemes() {
	return array_merge( basic_font_schemes(), style_font_schemes() );
}

/**
 * Current font scheme
 *
 * Gets the data for the selected
 * font scheme option value.
 *
 * Used to define font scheme variables.
 *
 * @since  1.0.0
 * @return array Returns the font scheme data array.
 */
function current_font_scheme() {

	// Option from database.
	$slug = plugin()->font_scheme();

	// Maybe get font scheme template.
	$template = font_scheme_template();
	if ( $template ) {
		$slug = $template;
	}

	// Get font schemes.
	$schemes = font_schemes();
	$name    = false;

	// Get all schemes.
	foreach ( $schemes as $option => $scheme ) {

		// Filter out all but the selected option.
		if ( $slug == $scheme['slug'] ) {
			$name = $scheme;
		}
	}
	return $name;
}

/**
 * Font scheme template
 *
 * Gets the slug of the font scheme
 * in the page template.
 *
 * @since  1.0.0
 * @global object $page Page class.
 * @global object $url Url class.
 * @return mixed Returns the font scheme slug or false.
 */
function font_scheme_template() {

	// Access global variables.
	global $page, $url;

	// Get font schemes.
	$fonts  = font_schemes();
	$scheme = false;

	if ( 'page' == $url->whereAmI() ) {
		foreach ( $fonts as $font => $key ) {
			$template = 'font-scheme-' . $key['slug'];
			if ( str_contains( $page->template(), $template ) ) {
				$scheme = $key['slug'];
			}
		}
	}
	return $scheme;
}

/**
 * Admin font options
 *
 * @since  1.0.0
 * @return string Returns a style block.
 */
function admin_font_options() {

	$style  = "\n" . '<style>:host, :root {';

	// Font weight.
	$style .= sprintf(
		'--cfe-body--font-weight: %s;',
		plugin()->wght_text()
	);
	$style .= sprintf(
		'--cfe-display--font-weight: %s;',
		plugin()->wght_display()
	);
	$style .= sprintf(
		'--cfe-heading-primary--font-weight: %s;',
		plugin()->wght_primary()
	);
	$style .= sprintf(
		'--cfe-heading-secondary--font-weight: %s;',
		plugin()->wght_secondary()
	);

	// Letter spacing.
	$style .= sprintf(
		'--cfe-body--letter-spacing: %sem;',
		plugin()->space_text()
	);
	$style .= sprintf(
		'--cfe-display--letter-spacing: %sem;',
		plugin()->space_display()
	);
	$style .= sprintf(
		'--cfe-heading-primary--letter-spacing: %sem;',
		plugin()->space_primary()
	);
	$style .= sprintf(
		'--cfe-heading-secondary--letter-spacing: %sem;',
		plugin()->space_secondary()
	);
	$style .= '}</style>' . "\n";

	return $style;
}
