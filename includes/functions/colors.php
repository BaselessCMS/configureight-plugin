<?php
/**
 * Color functions
 *
 * @package    Configure 8 Options
 * @subpackage Includes
 * @since      1.0.0
 */

namespace CFE_Colors;

// Access namespaced functions.
use function CFE_Plugin\{
	plugin,
	lang
};

/**
 * Hex to RGB
 *
 * Convert a 3- or 6-digit hexadecimal color to
 * an associative RGB array.
 *
 * @param  string $color The color in hex format.
 * @param  boolean $opacity Whether to return the RGB color as opaque.
 * @return string Returns the rgb(a) value.
 */
function hex_to_rgb( $color, $opacity = false ) {

	if ( empty( $color ) ) {
		return false;
	}

	if ( '#' === $color[0] ) {
		$color = substr( $color, 1 );
	}

	if ( 6 === strlen( $color ) ) {
		$hex = [ $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] ];
	} elseif ( 3 === strlen( $color ) ) {
		$hex = [ $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] ];
	} else {
		return null;
	}
	$rgb = array_map( 'hexdec', $hex );

	if ( $opacity ) {
		if ( abs( $opacity ) > 1 ) {
			$opacity = 1.0;
		}
		$output = 'rgba(' . implode( ',', $rgb ) . ',' . $opacity . ')';
	} else {
		$output = 'rgb(' . implode( ',', $rgb ) . ')';
	}
	return $output;
}

/**
 * Custom color value
 *
 * @since  1.0.0
 * @param  string $color
 * @return string
 */
function color( $color ) {
	$value = 'color_' . $color;
	return plugin()->getValue( $value );
}

/**
 * Color scheme category
 *
 * Returns an array of color scheme data for
 * a given scheme slug.
 *
 * @since  1.0.0
 * @param  string $slug The slug/directory of the scheme.
 * @return array
 */
function color_scheme_category( $slug ) {
	$cats = color_scheme_categories();
	return $cats[$slug];
}

/**
 * Color scheme categories
 *
 * Returns an array of color scheme data for
 * use in the form UI and the color guide page.
 *
 * @since  1.0.0
 * @return array
 */
function color_scheme_categories() {

	$cats = [
		'basic' => [
			'slug'  => 'basic',
			'name'  => lang()->get( 'Basic' ),
			'about' => lang()->get( 'The simple, default color schemes for light and dark modes. ' )
		],
		'design' => [
			'slug'  => 'design',
			'name'  => lang()->get( 'Design' ),
			'about' => lang()->get( 'Color schemes based on design trends of the 20th century.' )
		],
		'gemstones' => [
			'slug'  => 'gemstones',
			'name'  => lang()->get( 'Gemstones' ),
			'about' => lang()->get( 'The colors of common gemstones and birthstones.' )
		],
		'materials' => [
			'slug'  => 'materials',
			'name'  => lang()->get( 'Materials' ),
			'about' => lang()->get( 'Inspired by various building & art materials.' )
		],
		'metallic' => [
			'slug'  => 'metallic',
			'name'  => lang()->get( 'Metallic' ),
			'about' => lang()->get( 'Mostly monochromatic color schemes based on common metals.' )
		],
		'nature' => [
			'slug'  => 'nature',
			'name'  => lang()->get( 'Nature' ),
			'about' => lang()->get( 'Inspired by scenes and settings in nature, as well as individual, natural elements.' )
		],
		'palettes' => [
			'slug'  => 'palettes',
			'name'  => lang()->get( 'Palettes' ),
			'about' => lang()->get( 'Schemes based on color palette types.' )
		],
		'sanzo-wada' => [
			'slug'  => 'sanzo-wada',
			'name'  => lang()->get( 'Sanzo Wada' ),
			'about' => lang()->get( 'Sanzo Wada (1883 - 1967) was a Japanese artist & costume designer who published <em>A Dictionary of Color Combinations</em> in two volumes (1933 - 1934) in order to document Japanese color tastes. <br/><br/>These schemes come from his color combinations. Some modifications may have been made for use on the web.' )
		],
		'scope' => [
			'slug'  => 'scope',
			'name'  => lang()->get( 'Scope' ),
			'about' => lang()->get( 'Color schemes for the scope of the webite\'s primary content.' )
		]
	];
	asort( $cats );
	return $cats;
}

/**
 * Custom color scheme
 *
 * Array to be passed into the primary
 * array of color schemes.
 *
 * @since  1.0.0
 * @return array
 */
function custom_scheme() {

	$scheme = [
		'custom' => [
			'slug'     => 'custom',
			'name'     => lang()->get( 'Custom' ),
			'about'    => lang()->get( 'Custom scheme colors begin with the previously set scheme. To change the starting colors, first save a different scheme then select custom.' ),
			'category' => 'none',
			'light'    => [
				'body'  => color( 'body' ),
				'text'  => color( 'text' ),
				'one'   => color( 'one' ),
				'two'   => color( 'two' ),
				'three' => color( 'three' ),
				'four'  => color( 'four' ),
				'five'  => color( 'five' ),
				'six'   => color( 'six' )
			],
			'dark' => [
				'body'  => color( 'body_dark' ),
				'text'  => color( 'text_dark' ),
				'one'   => color( 'one_dark' ),
				'two'   => color( 'two_dark' ),
				'three' => color( 'three_dark' ),
				'four'  => color( 'four_dark' ),
				'five'  => color( 'five_dark' ),
				'six'   => color( 'six_dark' )
			]
		]
	];
	return $scheme;
}

/**
 * Color schemes
 *
 * Color scheme SCSS files contain color variables for
 * use in CSS properties. If a color hex value is changed
 * here then it is recommended to change the corresponding
 * variable in the relevant file.
 *
 * @since  1.0.0
 * @return array Returns array of color schemes data.
 */
function color_schemes() {

	// Built-in color schemes.
	$schemes = [
		'default' => [
			'slug'     => 'default',
			'name'     => lang()->get( 'Default' ),
			'about'    => lang()->get( 'A plain and simple color scheme.' ),
			'category' => 'basic',
			'cover'    => '#0044aa',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#333333',
				'one'   => '#0044aa',
				'two'   => '#4073bf',
				'three' => '#555555',
				'four'  => '#888888',
				'five'  => '#333333',
				'six'   => '#555555'
			],
			'dark' => [
				'body'  => '#1e1e1e',
				'text'  => '#eeeeee',
				'one'   => '#ffffff',
				'two'   => '#ffdd00',
				'three' => '#333333',
				'four'  => '#555555',
				'five'  => '#333333',
				'six'   => '#555555'
			]
		],
		'dark' => [
			'slug'     => 'dark',
			'name'     => lang()->get( 'Dark' ),
			'about'    => lang()->get( 'A plain and simple dark color scheme.' ),
			'category' => 'basic',
			'cover'    => '#355e9a',
			'light' => [
				'body'  => '#1e1e1e',
				'text'  => '#eeeeee',
				'one'   => '#ffffff',
				'two'   => '#ffdd00',
				'three' => '#333333',
				'four'  => '#555555',
				'five'  => '#333333',
				'six'   => '#555555'
			],
			'dark' => [
				'body'  => '#1e1e1e',
				'text'  => '#eeeeee',
				'one'   => '#ffffff',
				'two'   => '#ffdd00',
				'three' => '#333333',
				'four'  => '#555555',
				'five'  => '#333333',
				'six'   => '#555555'
			]
		],

		// Business.
		'corporate' => [
			'slug'     => 'corporate',
			'name'     => lang()->get( 'Corporate' ),
			'about'    => lang()->get( 'Clean & blue for a standard business look.' ),
			'category' => 'scope',
			'cover'    => '#185d89',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#2c3e50',
				'one'   => '#2779ae',
				'two'   => '#324c67',
				'three' => '#324c67',
				'four'  => '#547190',
				'five'  => '#324c67',
				'six'   => '#547190'
			],
			'dark' => [
				'body'  => '#192e41',
				'text'  => '#ecf0f1',
				'one'   => '#3498db',
				'two'   => '#2980b9',
				'three' => '#2980b9',
				'four'  => '#3498db',
				'five'  => '#324c67',
				'six'   => '#2980b9'
			]
		],
		'portfolio' => [
			'slug'     => 'portfolio',
			'name'     => lang()->get( 'Portfolio' ),
			'about'    => lang()->get( 'A clean and unobtrusive look for portfolios & artwork.' ),
			'category' => 'scope',
			'cover'    => '#355e9a',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#444444',
				'one'   => '#555555',
				'two'   => '#666666',
				'three' => '#777777',
				'four'  => '#555555',
				'five'  => '#222222',
				'six'   => '#444444'
			],
			'dark' => [
				'body'  => '#222222',
				'text'  => '#f7f7f7',
				'one'   => '#ffffff',
				'two'   => '#cccccc',
				'three' => '#555555',
				'four'  => '#777777',
				'five'  => '#444444',
				'six'   => '#333333'
			]
		],
		'videos' => [
			'slug'     => 'videos',
			'name'     => lang()->get( 'Video' ),
			'about'    => lang()->get( 'A dark theme for showcasing embedded videos.' ),
			'category' => 'scope',
			'cover'    => '#355e9a',
			'light' => [
				'body'  => '#070707',
				'text'  => '#f7f7f7',
				'one'   => '#ffffff',
				'two'   => '#ff0000',
				'three' => '#ff0000',
				'four'  => '#dd0000',
				'five'  => '#1e1e1e',
				'six'   => '#ff0000'
			],
			'dark' => [
				'body'  => '#070707',
				'text'  => '#f7f7f7',
				'one'   => '#ffffff',
				'two'   => '#ff0000',
				'three' => '#ff0000',
				'four'  => '#dd0000',
				'five'  => '#1e1e1e',
				'six'   => '#ff0000'
			]
		],

		// Design.
		'club' => [
			'slug'     => 'club',
			'name'     => lang()->get( '1930s Club' ),
			'about'    => lang()->get( 'Inspired by the early, colorful jazz & big-band nightclubs.' ),
			'category' => 'design',
			'cover'    => '#2ea65e',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#2a180c',
				'one'   => '#f83d5c',
				'two'   => '#f9657d',
				'three' => '#2ea65e',
				'four'  => '#4dce81',
				'five'  => '#631596',
				'six'   => '#8b1fd1'
			],
			'dark' => [
				'body'  => '#180e07',
				'text'  => '#eeeeee',
				'one'   => '#f9657d',
				'two'   => '#f83d5c',
				'three' => '#2ea65e',
				'four'  => '#4dce81',
				'five'  => '#631596',
				'six'   => '#8b1fd1'
			]
		],
		'deco' => [
			'slug'     => 'deco',
			'name'     => lang()->get( '1940s Hotel' ),
			'about'    => lang()->get( 'Those nostalgic Art Deco colors that define the period.' ),
			'category' => 'design',
			'cover'    => '#1d683b',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#3b291d',
				'one'   => '#8a2b26',
				'two'   => '#c32323',
				'three' => '#1d683b',
				'four'  => '#2da45d',
				'five'  => '#937e28',
				'six'   => '#c8ab37'
			],
			'dark' => [
				'body'  => '#1c140f',
				'text'  => '#eeeeee',
				'one'   => '#c8ab37',
				'two'   => '#937e28',
				'three' => '#1d683b',
				'four'  => '#2da45d',
				'five'  => '#8a2b26',
				'six'   => '#c32323'
			]
		],
		'diner' => [
			'slug'     => 'diner',
			'name'     => lang()->get( '1950s Diner' ),
			'about'    => lang()->get( 'Hotrods, black & white checkers, chrome, and neon.' ),
			'category' => 'design',
			'cover'    => '#cc0000',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#000000',
				'one'   => '#008aad',
				'two'   => '#1fb4d8',
				'three' => '#cc0000',
				'four'  => '#ff0000',
				'five'  => '#ff126f',
				'six'   => '#ff4c93'
			],
			'dark' => [
				'body'  => '#000000',
				'text'  => '#ffffff',
				'one'   => '#1fb4d8',
				'two'   => '#008aad',
				'three' => '#ff126f',
				'four'  => '#ff4c93',
				'five'  => '#cc0000',
				'six'   => '#ff0000'
			]
		],
		'dress' => [
			'slug'     => 'dress',
			'name'     => lang()->get( '1960s Dress' ),
			'about'    => lang()->get( 'Those bright colors of mid-century ladies fashion.' ),
			'category' => 'design',
			'cover'    => '#0d3b85',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#1b1b21',
				'one'   => '#093d90',
				'two'   => '#004fc6',
				'three' => '#44aa00',
				'four'  => '#46e400',
				'five'  => '#ff1d76',
				'six'   => '#ff5599'
			],
			'dark' => [
				'body'  => '#1b1b21',
				'text'  => '#eeeeee',
				'one'   => '#46e400',
				'two'   => '#44aa00',
				'three' => '#004fc6',
				'four'  => '#093d90',
				'five'  => '#ff1d76',
				'six'   => '#ff5599'
			]
		],
		'kitchen' => [
			'slug'     => 'kitchen',
			'name'     => lang()->get( '1970s Kitchen' ),
			'about'    => lang()->get( 'Those Earthy tones that defined a moment in time.' ),
			'category' => 'design',
			'cover'    => '#536212',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#381f0f',
				'one'   => '#b02b14',
				'two'   => '#e03214',
				'three' => '#677d08',
				'four'  => '#93ad00',
				'five'  => '#4c330b',
				'six'   => '#df7b0b'
			],
			'dark' => [
				'body'  => '#1e1108',
				'text'  => '#eeeeee',
				'one'   => '#ffb400',
				'two'   => '#df7b0b',
				'three' => '#677d08',
				'four'  => '#93ad00',
				'five'  => '#b02b14',
				'six'   => '#e03214'
			]
		],
		'video' => [
			'slug'     => 'video',
			'name'     => lang()->get( '1980s Video' ),
			'about'    => lang()->get( 'When everything was going vibrant and digital.' ),
			'category' => 'design',
			'cover'    => '#58146a',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#1b2025',
				'one'   => '#d40055',
				'two'   => '#ff297d',
				'three' => '#750093',
				'four'  => '#a900d2',
				'five'  => '#0eab8c',
				'six'   => '#00e0b4'
			],
			'dark' => [
				'body'  => '#1b2025',
				'text'  => '#ffffff',
				'one'   => '#ff297d',
				'two'   => '#d40055',
				'three' => '#a900d2',
				'four'  => '#750093',
				'five'  => '#0eab8c',
				'six'   => '#00e0b4'
			]
		],
		'wedding' => [
			'slug'     => 'wedding',
			'name'     => lang()->get( '1990s Wedding' ),
			'about'    => lang()->get( 'Those soft, muted tones as we moved away from hot colors.' ),
			'category' => 'design',
			'cover'    => '#0b687f',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#28170b',
				'one'   => '#65391c',
				'two'   => '#a05a2c',
				'three' => '#0081a1',
				'four'  => '#21aed3',
				'five'  => '#f93c5a',
				'six'   => '#ff7575'
			],
			'dark' => [
				'body'  => '#28170b',
				'text'  => '#eeeeee',
				'one'   => '#c59f6b',
				'two'   => '#ab602f',
				'three' => '#0081a1',
				'four'  => '#21aed3',
				'five'  => '#f93c5a',
				'six'   => '#ff7575'
			]
		],

		// Color palettes.
		'highlighter' => [
			'slug'     => 'highlighter',
			'name'     => lang()->get( 'Highlighter' ),
			'category' => 'palettes',
			'cover'    => '#ab7bf9',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#333333',
				'one'   => '#1bfc06',
				'two'   => '#ff1ac9',
				'three' => '#3aafdc',
				'four'  => '#ff8c00',
				'five'  => '#b41fff',
				'six'   => '#faff46'
			],
			'dark' => [
				'body'  => '#111111',
				'text'  => '#eeeeee',
				'one'   => '#1bfc06',
				'two'   => '#ff1ac9',
				'three' => '#3aafdc',
				'four'  => '#ff8c00',
				'five'  => '#b41fff',
				'six'   => '#faff46'
			]
		],
		'pastel' => [
			'slug'     => 'pastel',
			'name'     => lang()->get( 'Pastel' ),
			'category' => 'palettes',
			'cover'    => '#ab7bf9',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#333333',
				'one'   => '#ab7bf9',
				'two'   => '#f18ebf',
				'three' => '#44d2a8',
				'four'  => '#63dded',
				'five'  => '#feb486',
				'six'   => '#ffe47a'
			],
			'dark' => [
				'body'  => '#111111',
				'text'  => '#eeeeee',
				'one'   => '#ab7bf9',
				'two'   => '#f18ebf',
				'three' => '#44d2a8',
				'four'  => '#63dded',
				'five'  => '#feb486',
				'six'   => '#ffe47a'
			]
		],
		'primary' => [
			'slug'     => 'primary',
			'name'     => lang()->get( 'Primary' ),
			'category' => 'palettes',
			'cover'    => '#0000cc',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#333333',
				'one'   => '#0000cc',
				'two'   => '#ff9922',
				'three' => '#0cc800',
				'four'  => '#ee0000',
				'five'  => '#8800aa',
				'six'   => '#ffdd00'
			],
			'dark' => [
				'body'  => '#1e1e1e',
				'text'  => '#eeeeee',
				'one'   => '#ff9922',
				'two'   => '#0000cc',
				'three' => '#0cc800',
				'four'  => '#ee0000',
				'five'  => '#ffdd00',
				'six'   => '#8800aa'
			]
		],

		// Materials.
		'bamboo' => [
			'slug'     => 'bamboo',
			'name'     => lang()->get( 'Bamboo' ),
			'category' => 'materials',
			'cover'    => '#a0b43c',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#272129',
				'one'   => '#a0b43c',
				'two'   => '#c5ac6b',
				'three' => '#a0b43c',
				'four'  => '#719a32',
				'five'  => '#719a32',
				'six'   => '#a0b43c'
			],
			'dark' => [
				'body'  => '#272129',
				'text'  => '#eeeeee',
				'one'   => '#a0b43c',
				'two'   => '#c5ac6b',
				'three' => '#a0b43c',
				'four'  => '#719a32',
				'five'  => '#719a32',
				'six'   => '#a0b43c'
			]
		],
		'brick' => [
			'slug'     => 'brick',
			'name'     => lang()->get( 'Brick' ),
			'category' => 'materials',
			'cover'    => '#bc3a24',
			'light' => [
				'body'  => '#fdfcf3',
				'text'  => '#261a19',
				'one'   => '#ba2d15',
				'two'   => '#e33619',
				'three' => '#ab2913',
				'four'  => '#c63d1d',
				'five'  => '#ab2913',
				'six'   => '#bca443'
			],
			'dark' => [
				'body'  => '#261a19',
				'text'  => '#fdfcf3',
				'one'   => '#cbb86d',
				'two'   => '#bca443',
				'three' => '#84200f',
				'four'  => '#ab2913',
				'five'  => '#84200f',
				'six'   => '#ab2913'
			]
		],
		'concrete' => [
			'slug'     => 'concrete',
			'name'     => lang()->get( 'Concrete' ),
			'category' => 'materials',
			'cover'    => '#808fa1',
			'light' => [
				'body'  => '#f3f3f3',
				'text'  => '#333333',
				'one'   => '#666666',
				'two'   => '#888888',
				'three' => '#9299a2',
				'four'  => '#a3a9b1',
				'five'  => '#9299a2',
				'six'   => '#a3a9b1'
			],
			'dark' => [
				'body'  => '#222222',
				'text'  => '#eeeeee',
				'one'   => '#eeeeee',
				'two'   => '#ffffff',
				'three' => '#9299a2',
				'four'  => '#a3a9b1',
				'five'  => '#9299a2',
				'six'   => '#a3a9b1'
			]
		],
		'wood' => [
			'slug'     => 'wood',
			'name'     => lang()->get( 'Wood' ),
			'category' => 'materials',
			'cover'    => '#733c18',
			'light' => [
				'body'  => '#fcfcf6',
				'text'  => '#261e18',
				'one'   => '#743020',
				'two'   => '#894229',
				'three' => '#c8ab37',
				'four'  => '#d3bc5f',
				'five'  => '#502d16',
				'six'   => '#784421'
			],
			'dark' => [
				'body'  => '#261e18',
				'text'  => '#fcfcf6',
				'one'   => '#f1dc88',
				'two'   => '#d3b84f',
				'three' => '#784421',
				'four'  => '#502d16',
				'five'  => '#894229',
				'six'   => '#743020'
			]
		],

		// Nature.
		'beach' => [
			'slug'     => 'beach',
			'name'     => lang()->get( 'Beach' ),
			'category' => 'nature',
			'cover'    => '#254d88',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#101e36',
				'one'   => '#254d88',
				'two'   => '#467ac7',
				'three' => '#254d88',
				'four'  => '#d3b857',
				'five'  => '#204170',
				'six'   => '#d3b857'
			],
			'dark' => [
				'body'  => '#050b14',
				'text'  => '#f8fafd',
				'one'   => '#467ac7',
				'two'   => '#d3b857',
				'three' => '#254d88',
				'four'  => '#d3b857',
				'five'  => '#204170',
				'six'   => '#d3b857'
			]
		],
		'citrus' => [
			'slug'     => 'citrus',
			'name'     => lang()->get( 'Citrus' ),
			'category' => 'nature',
			'cover'    => '#ebad03',
			'light' => [
				'body'  => '#fffffe',
				'text'  => '#111a0b',
				'one'   => '#ff7700',
				'two'   => '#ff5500',
				'three' => '#ffbb00',
				'four'  => '#ffdd11',
				'five'  => '#ff7700',
				'six'   => '#ffcc00'
			],
			'dark' => [
				'body'  => '#111a0b',
				'text'  => '#fffffe',
				'one'   => '#ffdd11',
				'two'   => '#ffbb00',
				'three' => '#ff7700',
				'four'  => '#ff5500',
				'five'  => '#ff7700',
				'six'   => '#ffcc00'
			]
		],
		'forest' => [
			'slug'     => 'forest',
			'name'     => lang()->get( 'Forest' ),
			'category' => 'nature',
			'cover'    => '#3e721a',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#1e110a',
				'one'   => '#87551b',
				'two'   => '#ff6600',
				'three' => '#3e721a',
				'four'  => '#46a109',
				'five'  => '#3e721a',
				'six'   => '#f5a313'
			],
			'dark' => [
				'body'  => '#1e110a',
				'text'  => '#eeeeee',
				'one'   => '#4bda1f',
				'two'   => '#46a109',
				'three' => '#87551b',
				'four'  => '#ff6600',
				'five'  => '#46a109',
				'six'   => '#f5a313'
			]
		],
		'orchid' => [
			'slug'     => 'orchid',
			'name'     => lang()->get( 'Orchid' ),
			'category' => 'nature',
			'cover'    => '#b91881',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#28081c',
				'one'   => '#b800b1',
				'two'   => '#ff00f6',
				'three' => '#e20093',
				'four'  => '#ff2db8',
				'five'  => '#e20093',
				'six'   => '#ff2db8'
			],
			'dark' => [
				'body'  => '#28081c',
				'text'  => '#fbf3f6',
				'one'   => '#ff00f6',
				'two'   => '#b800b1',
				'three' => '#e20093',
				'four'  => '#ff2db8',
				'five'  => '#e20093',
				'six'   => '#ff2db8'
			]
		],
		'rose' => [
			'slug'     => 'rose',
			'name'     => lang()->get( 'Rose' ),
			'category' => 'nature',
			'cover'    => '#dd3e71',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#1b0209',
				'one'   => '#ff1a40',
				'two'   => '#e00020',
				'three' => '#f7417c',
				'four'  => '#ff6797',
				'five'  => '#f7417c',
				'six'   => '#ff6797'
			],
			'dark' => [
				'body'  => '#1b0209',
				'text'  => '#f3f3f3',
				'one'   => '#ff6797',
				'two'   => '#f7417c',
				'three' => '#e00020',
				'four'  => '#ff1a40',
				'five'  => '#f7417c',
				'six'   => '#ff6797'
			]
		],
		'violet' => [
			'slug'     => 'violet',
			'name'     => lang()->get( 'Violet' ),
			'category' => 'nature',
			'cover'    => '#672178',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#220b28',
				'one'   => '#a400aa',
				'two'   => '#dd00e5',
				'three' => '#672178',
				'four'  => '#8f2ea7',
				'five'  => '#005b0c',
				'six'   => '#8f2ea7'
			],
			'dark' => [
				'body'  => '#220b28',
				'text'  => '#eeeeee',
				'one'   => '#dd00e5',
				'two'   => '#a400aa',
				'three' => '#672178',
				'four'  => '#8f2ea7',
				'five'  => '#672178',
				'six'   => '#8f2ea7'
			]
		],

		// Sanzo Wada
		'heian-01' => [
			'slug'     => 'heian-01',
			'name'     => lang()->get( 'Heian Era One' ),
			'about'    => lang()->get( 'Kurenai, the crimson drawn from safflower petals, was a luxury dye reserved for the robes of high-ranking courtiers. Set against Kon, the darkest grade of indigo, the pair became a signature of formal attire from the Heian court through to Edo merchant households. Gofun is the matte white of temple painting; it reads as devotional, timeless, and unmistakably sacred.' ),
			'category' => 'sanzo-wada',
			'overall'  => lang()->get( 'Sanzo Wada (1883 - 1967) was a Japanese artist & costume designer who published <em>A Dictionary of Color Combinations</em> in two volumes (1933 - 1934) in order to document Japanese color tastes.' ),
			'cover'    => '#9a2a2a',
			'light' => [
				'body'  => '#f4eee0',
				'text'  => '#1b2a4e',
				'one'   => '#1b2a4e',
				'two'   => '#9a2a2a',
				'three' => '#9a2a2a',
				'four'  => '#1b2a4e',
				'five'  => '#1b2a4e',
				'six'   => '#f4eee0'
			],
			'dark' => [
				'body'  => '#1b2a4e',
				'text'  => '#f4eee0',
				'one'   => '#88b9c4',
				'two'   => '#f4eee0',
				'three' => '#9a2a2a',
				'four'  => '#f4eee0',
				'five'  => '#9a2a2a',
				'six'   => '#f4eee0'
			]
		],
		'heian-02' => [
			'slug'     => 'heian-02',
			'name'     => lang()->get( 'Heian Era Two' ),
			'about'    => lang()->get( 'Ruri is lapis lazuli, considered one of the seven treasures of Buddhism. It is the blue of sutra frontispieces and deity robes. Gofun is the matte white of temple painting; it reads as devotional, timeless, and unmistakably sacred. Kogane is a golden, muted brown tone.' ),
			'category' => 'sanzo-wada',
			'cover'    => '#1e4b8a',
			'light' => [
				'body'  => '#f4eee0',
				'text'  => '#183c6e',
				'one'   => '#1e4b8a',
				'two'   => '#d4af37',
				'three' => '#d4af37',
				'four'  => '#1e4b8a',
				'five'  => '#1e4b8a',
				'six'   => '#d4af37'
			],
			'dark' => [
				'body'  => '#183c6e',
				'text'  => '#f5f0e3',
				'one'   => '#d4af37',
				'two'   => '#f5f0e3',
				'three' => '#d4af37',
				'four'  => '#1e4b8a',
				'five'  => '#d4af37',
				'six'   => '#1e4b8a'
			]
		],
		'heian-03' => [
			'slug'     => 'heian-03',
			'name'     => lang()->get( 'Heian Era Three' ),
			'about'    => lang()->get( 'Nadeshiko, the fringed pink flower, was the standard metaphor for Japanese feminine ideals in classical poetry. Mizu-iro, water color, is the blue of a cold spring seen through ferns. Kinari, unbleached natural, is a light, muted neutral tone.' ),
			'category' => 'sanzo-wada',
			'cover'    => '#f69bae',
			'light' => [
				'body'  => '#f8f4e9',
				'text'  => '#173868',
				'one'   => '#f69bae',
				'two'   => '#aadaef',
				'three' => '#aadaef',
				'four'  => '#f69bae',
				'five'  => '#aadaef',
				'six'   => '#f69bae'
			],
			'dark' => [
				'body'  => '#173868',
				'text'  => '#f8f4e9',
				'one'   => '#f69bae',
				'two'   => '#aadaef',
				'three' => '#aadaef',
				'four'  => '#f69bae',
				'five'  => '#aadaef',
				'six'   => '#f69bae'
			]
		],
		'heian-04' => [
			'slug'     => 'heian-04',
			'name'     => lang()->get( 'Heian Era Four' ),
			'about'    => lang()->get( 'Fuji-iro, wisteria purple, is a light, cool lavender drawn from the pendulous flowers of the Fuji vine. Ai, true indigo, grounds it with depth. The pair is a signature of early summer gardens. The pair is a signature of early summer gardens. Gofun is the matte white of temple painting; it reads as devotional, timeless, and unmistakably sacred.' ),
			'category' => 'sanzo-wada',
			'cover'    => '#b398d7',
			'light' => [
				'body'  => '#f4eee0',
				'text'  => '#112536',
				'one'   => '#b398d7',
				'two'   => '#1c3d5a',
				'three' => '#b398d7',
				'four'  => '#1c3d5a',
				'five'  => '#1c3d5a',
				'six'   => '#b398d7'
			],
			'dark' => [
				'body'  => '#112536',
				'text'  => '#f4eee0',
				'one'   => '#b398d7',
				'two'   => '#f4eee0',
				'three' => '#b398d7',
				'four'  => '#1c3d5a',
				'five'  => '#b398d7',
				'six'   => '#1c3d5a'
			]
		]
	];

	// Merge custom scheme if selected.
	$custom  = custom_scheme();
	$schemes = array_merge( $schemes, $custom );
	return $schemes;
}

/**
 * Get color scheme
 *
 * @since  1.0.0
 * @param  string $key The key of the scheme.
 * @return mixed Returns a color scheme array or null.
 */
function get_color_scheme( $key = '' ) {

	// Get color schemes array.
	$schemes = color_schemes();
	if ( empty( $key ) || ! array_key_exists( $key, $schemes ) ) {
		return null;
	}
	return $schemes[$key];
}

/**
 * Default color scheme
 *
 * The array of data for the default color scheme.
 *
 * @since  1.0.0
 * @return array Returns the color scheme data array.
 */
function default_color_scheme() {
	$colors = color_schemes();
	return $colors['default'];
}

/**
 * Current color scheme
 *
 * Gets the data for the selected
 * color scheme option value.
 *
 * Used to define color scheme variables.
 *
 * @since  1.0.0
 * @return array Returns the color scheme data array.
 */
function current_color_scheme() {

	// Option from database.
	$slug = plugin()->color_scheme();

	// Maybe get color scheme template.
	$template = color_scheme_template();
	if ( $template ) {
		$slug = $template;
	}

	// Get color schemes.
	$schemes = color_schemes();
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
 * Color scheme template
 *
 * Gets the slug of the color scheme
 * in the page template.
 *
 * @since  1.0.0
 * @global object $page Page class.
 * @global object $url Url class.
 * @return mixed Returns the color scheme slug or false.
 */
function color_scheme_template() {

	// Access global variables.
	global $page, $url;

	// Get color schemes.
	$colors = color_schemes();
	$scheme = false;

	if ( 'page' == $url->whereAmI() ) {
		foreach ( $colors as $color => $key ) {
			$template = 'color-scheme-' . $key['slug'];
			if ( str_contains( $page->template(), $template ) ) {
				$scheme = $key['slug'];
			}
		}
	}
	return $scheme;
}

/**
 * Current scheme cover color
 *
 * @since  1.0.0
 * @return mixed Returns a hex value or false.
 */
function current_cover_color() {

	// Color schemes.
	$color   = false;
	$colors  = color_schemes();
	$current = current_color_scheme();
	$custom_from = plugin()->custom_scheme_from();

	if ( isset( $colors[$custom_from] ) ) {
		$color = $colors[$custom_from]['cover'];
	} elseif ( isset( $current['cover'] ) ) {
		$color = $current['cover'];
	}
	return $color;
}

/**
 * Current color group
 *
 * Returns the color name as array key and
 * color hex as key value.
 *
 * @since  1.0.0
 * @param  string $group `light` or `dark`
 * @return array
 */
function current_color_group( $group = 'light' ) {

	$current = current_color_scheme();
	$colors  = [];

	if ( 'dark' == $group ) {
		$colors[] = $current['dark'];
	} else {
		$colors[] = $current['light'];
	}
	return $colors;
}

/**
 * Current color group colors
 *
 * Returns the color hex values in simple array.
 *
 * @since  1.0.0
 * @param  string $group `light` or `dark`
 * @return array
 */
function current_color_group_hex( $group = 'light' ) {

	$current = current_color_scheme();
	$colors  = [];

	if ( 'dark' == $group ) {
		foreach ( $current['dark'] as $name => $color ) {
			$colors[] = $color;
		}
	} else {
		foreach ( $current['light'] as $name => $color ) {
			$colors[] = $color;
		}
	}
	return $colors;
}

/**
 * All current colors
 *
 * Returns a simple array of all colors,
 * light and dark, in the current scheme.
 *
 * If the `$repeat` parameter is false then
 * duplicate colors will be filtered out.
 *
 * @since  1.0.0
 * @param  boolean $repeat
 * @return array
 */
function all_current_colors( $repeat = true ) {

	$colors  = [];
	foreach ( current_color_group_hex() as $group => $color ) {
		$colors[] = $color;
	}
	foreach ( current_color_group_hex( 'dark' ) as $group => $color ) {
		$colors[] = $color;
	}
	if ( current_cover_color() ) {
		$colors[] = current_cover_color();
	}

	// Filter duplicates.
	if ( ! $repeat ) {
		$colors = array_unique( $colors );
	}
	return $colors;
}

/**
 * Color picker: light colors
 *
 * Also includes the cover image color.
 *
 * @since  1.0.0
 * @return array Returns an array of hex values.
 */
function picker_colors_light() {

	$current = current_color_scheme();
	$light   = [];
	$cover   = current_cover_color();

	if ( $cover ) {
		$cover = [ $cover ];
	}
	foreach ( $current['light'] as $name => $color ) {

		// Filter duplicates.
		if ( ! in_array( $color, $light ) ) {
			$light[] = $color;
		}
	}

	// If cover color is set.
	if ( is_array( $cover ) ) {
		$light = array_merge( $cover, $light );
	}
	return $light;
}

/**
 * Color picker: dark colors
 *
 * @since  1.0.0
 * @return array Returns an array of hex values.
 */
function picker_colors_dark() {

	$current = current_color_scheme();
	$dark    = [];

	foreach ( $current['dark'] as $name => $color ) {

		// Filter duplicates.
		if ( ! in_array( $color, $dark ) ) {
			$dark[] = $color;
		}
	}
	return $dark;
}

/**
 * Define color scheme variables
 *
 * Used in the `<head>` section to assign current
 * color scheme values to color variables.
 *
 * @since  1.0.0
 * @global object $page Page class.
 * @global object $url Url class.
 * @return mixed Returns a style block or null.
 */
function define_color_scheme() {

	// Access global variables.
	global $page, $url;

	$current = current_color_scheme();

	// Begin style root block.
	$style = "\n" . '<style>:host, :root {';

		// Set up array of colors.
	$colors = [];

	// Variables for each light mode color.
	foreach ( $current['light'] as $key => $value ) {
		if ( ! empty( $value ) && ! plugin()->use_dark_scheme() ) {
			$colors[] = sprintf(
				'--cfe-scheme-color--%s: %s',
				$key,
				$value
			);
		}
	}

	// Variables for each dark mode color.
	foreach ( $current['dark'] as $key => $value ) {
		if ( ! empty( $value ) ) {

			if ( 'page' == $url->whereAmI() ) {
				if (
					plugin()->use_dark_scheme() ||
					( str_contains( $page->template(), 'color-scheme-' ) &&
					str_contains( $page->template(), '-dark' ) )
				) {
					$colors[] = sprintf(
						'--cfe-scheme-color--%s: %s',
						$key,
						$value
					);
				}
			} elseif ( plugin()->use_dark_scheme() ) {
				$colors[] = sprintf(
					'--cfe-scheme-color--%s: %s',
					$key,
					$value
				);
			}
			$colors[] = sprintf(
				'--cfe-scheme-color--%s--dark: %s',
				$key,
				$value
			);
		}
	}

	// Convert array to semicolon-separated CSS content.
	$style .= implode( '; ', $colors );

	// Close the root style block.
	$style .= '}</style>' . "\n";

	// Begin dark mode style block.
	$style .= "\n" . '<style>.dark-mode {';

	// Variables for each dark mode color.
	foreach ( $current['dark'] as $key => $value ) {
		if ( ! empty( $value ) ) {

			if ( 'page' == $url->whereAmI() ) {
				if (
					plugin()->use_dark_scheme() ||
					( str_contains( $page->template(), 'color-scheme-' ) &&
					str_contains( $page->template(), '-dark' ) )
				) {
					$colors[] = sprintf(
						'--cfe-scheme-color--%s: %s',
						$key,
						$value
					);
				}
			} elseif ( plugin()->use_dark_scheme() ) {
				$colors[] = sprintf(
					'--cfe-scheme-color--%s: %s',
					$key,
					$value
				);
			}
			$colors[] = sprintf(
				'--cfe-scheme-color--%s--dark: %s',
				$key,
				$value
			);
		}
	}

	// Convert array to semicolon-separated CSS content.
	$style .= implode( '; ', $colors );

	// Close the dark mode style block.
	$style .= '}</style>' . "\n";

	return $style;
}
