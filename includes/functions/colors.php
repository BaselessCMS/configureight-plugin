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
 * Default color value
 *
 * @since  1.0.0
 * @param  string $color
 * @return string
 */
function default_color( $color ) {
	$value = 'color_' . $color;
	return plugin()->dbFields[$value];
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
		'materials' => [
			'slug'  => 'materials',
			'name'  => lang()->get( 'Materials' ),
			'about' => lang()->get( 'Inspired by various building & art materials.' )
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
			'about' => lang()->get( "Sanzo Wada (1883 - 1967) was a Japanese artist & costume designer who published <em>A Dictionary of Color Combinations</em> in two volumes (1933 - 1934) in order to document Japanese color tastes. <br/><br/>Showa era schemes are select plates in his dictionary. The others are original compositions by <a href='https://colorcombinations.org/' target='_blank' rel='noopener noreferrer'>colorcombinations.org</a>, built with Wada's method from traditional Japanese shikisai color names. Thank you to them for their excellent resource, and be sure to visit the link for inspiration applying the custom scheme option. <br/><br/>Some modifications may have been made to Sanzo Wada schemes for use on the web." )
		],
		'scope' => [
			'slug'  => 'scope',
			'name'  => lang()->get( 'Scope' ),
			'about' => lang()->get( 'Color schemes for the scope of the webite\'s primary content.' )
		]
	];
	asort( $cats );

	$custom = [
		'custom' => [
			'slug'  => 'custom',
			'name'  => lang()->get( 'Build Your Own' ),
			'about' => lang()->get( 'Custom color schemes with a color picker for each light and dark option.' )
		]
	];
	$cats = array_merge( $cats, $custom );
	return $cats;
}

/**
 * Custom Bootstrap color scheme
 *
 * Array to be passed into the primary
 * array of color schemes.
 *
 * @since  1.0.0
 * @return array
 */
function bootstrap_scheme() {

	$scheme = [
		'bootstrap' => [
			'slug'     => 'bootstrap',
			'name'     => lang()->get( 'Bootstrap Colors' ),
			'about'    => lang()->get( 'The colors included with the <a href="https://getbootstrap.com/docs/5.0/utilities/colors/#variables" target="_blank" rel="noopener noreferrer">Bootstrap</a> framework for website UI and frontend theme building, expanded with tints & shades.' ),
			'category' => 'custom',
			'media'    => plugin()->cover_blend(),
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
 * Custom Tailwind color scheme
 *
 * Array to be passed into the primary
 * array of color schemes.
 *
 * @since  1.0.0
 * @return array
 */
function tailwind_scheme() {

	$scheme = [
		'tailwind' => [
			'slug'     => 'tailwind',
			'name'     => lang()->get( 'Tailwind Colors' ),
			'about'    => lang()->get( 'The complete selection of colors included with the <a href="https://tailwindcss.com/docs/colors" target="_blank" rel="noopener noreferrer">Tailwind CSS</a> framework for website UI and frontend theme building.' ),
			'category' => 'custom',
			'media'    => plugin()->cover_blend(),
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
 * Custom color scheme from previous.
 *
 * Array to be passed into the primary
 * array of color schemes.
 *
 * @since  1.0.0
 * @return array
 */
function custom_scheme() {

	$custom = custom_schemes();
	$from   = plugin()->custom_scheme_from();

	// Conditional description.
	if ( in_array( $from, $custom ) ) {
		$about = lang()->get( 'Custom scheme colors begin with the default scheme colors.' );
	} else {
		$about = lang()->get( 'Custom scheme colors begin with the previously set scheme. To change the starting colors, first save a different scheme then select custom. If another Build Your Own scheme was previous then the default scheme is the origin.' );
	}

	$scheme = [
		'custom' => [
			'slug'     => 'custom',
			'name'     => lang()->get( 'Custom' ),
			'about'    => $about,
			'category' => 'custom',
			'media'    => plugin()->cover_blend(),
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
 * Custom build schemes
 *
 * Used mostly for excluding custom schemes
 * from displaying various content.
 *
 * @since  1.0.0
 * @return array
 */
function custom_schemes() {
	return [
		'bootstrap',
		'tailwind',
		'custom'
	];
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

	// Basic color schemes.
	$schemes = [
		'default' => [
			'slug'     => 'default',
			'name'     => lang()->get( 'Default' ),
			'about'    => lang()->get( 'A plain and simple color scheme.' ),
			'category' => 'basic',
			'media'    => '#0044aa',
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
			'media'    => '#355e9a',
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

		// Scope.
		'corporate' => [
			'slug'     => 'corporate',
			'name'     => lang()->get( 'Corporate' ),
			'about'    => lang()->get( 'Clean & blue for a standard business look.' ),
			'category' => 'scope',
			'media'    => '#193cb8',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#2c3e50',
				'one'   => '#193cb8',
				'two'   => '#1447e6',
				'three' => '#1c398e',
				'four'  => '#193cb8',
				'five'  => '#1c398e',
				'six'   => '#193cb8'
			],
			'dark' => [
				'body'  => '#0d264d',
				'text'  => '#eff6ff',
				'one'   => '#5599ff',
				'two'   => '#1447e6',
				'three' => '#1447e6',
				'four'  => '#193cb8',
				'five'  => '#193cb8',
				'six'   => '#155dfc'
			]
		],
		'portfolio' => [
			'slug'     => 'portfolio',
			'name'     => lang()->get( 'Portfolio' ),
			'about'    => lang()->get( 'A clean and unobtrusive look for portfolios & artwork.' ),
			'category' => 'scope',
			'media'    => '#888888',
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
			'media'    => '#dd0000',
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
			'media'    => '#2ea65e',
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
			'media'    => '#1d683b',
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
			'media'    => '#cc0000',
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
			'media'    => '#0d3b85',
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
			'media'    => '#536212',
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
			'media'    => '#58146a',
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
			'media'    => '#0b687f',
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
			'about'    => lang()->get( 'The bright, florescent colors of highlighter pens.' ),
			'category' => 'palettes',
			'media'    => '#1bfc06',
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
			'about'    => lang()->get( 'Soft, muted yet colorful tones.' ),
			'category' => 'palettes',
			'media'    => '#f18ebf',
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
			'name'     => lang()->get( 'Color Wheel' ),
			'about'    => lang()->get( 'A palette of the vibrant primary & secondary colors.' ),
			'category' => 'palettes',
			'media'    => '#0000cc',
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
		'skittles' => [
			'slug'     => 'skittles',
			'name'     => lang()->get( 'Skittles' ),
			'about'    => lang()->get( 'Taste the rainbow.' ),
			'category' => 'palettes',
			'media'    => '#5d2b7d',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#222222',
				'one'   => '#e41e26',
				'two'   => '#8fc33e',
				'three' => '#1474bb',
				'four'  => '#a72d89',
				'five'  => '#5d2b7d',
				'six'   => '#feee22'
			],
			'dark' => [
				'body'  => '#1e1e1e',
				'text'  => '#eeeeee',
				'one'   => '#feee22',
				'two'   => '#e41e26',
				'three' => '#1474bb',
				'four'  => '#8fc33e',
				'five'  => '#5d2b7d',
				'six'   => '#a72d89'
			]
		],

		// Materials.
		'bamboo' => [
			'slug'     => 'bamboo',
			'name'     => lang()->get( 'Bamboo' ),
			'about'    => lang()->get( 'The colors of bamboo stalks, both fresh and dried.' ),
			'category' => 'materials',
			'media'    => '#a0b43c',
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
			'about'    => lang()->get( 'The reds of traditional clay bricks.' ),
			'category' => 'materials',
			'media'    => '#b01f26',
			'light' => [
				'body'  => '#fafaf9',
				'text'  => '#460809',
				'one'   => '#9f0712',
				'two'   => '#ca3500',
				'three' => '#9f0712',
				'four'  => '#c10007',
				'five'  => '#82181a',
				'six'   => '#a6a09b'
			],
			'dark' => [
				'body'  => '#460809',
				'text'  => '#fafaf9',
				'one'   => '#fb2c36',
				'two'   => '#e22831',
				'three' => '#c10007',
				'four'  => '#9f0712',
				'five'  => '#82181a',
				'six'   => '#a6a09b'
			]
		],
		'concrete' => [
			'slug'     => 'concrete',
			'name'     => lang()->get( 'Concrete' ),
			'about'    => lang()->get( 'The bluish gray tones of concrete.' ),
			'category' => 'materials',
			'media'    => '#acbec3',
			'light' => [
				'body'  => '#f9fcfc',
				'text'  => '#262a2b',
				'one'   => '#737f82',
				'two'   => '#869498',
				'three' => '#acbec3',
				'four'  => '#bfd3d9',
				'five'  => '#99a9ae',
				'six'   => '#acbec3'
			],
			'dark' => [
				'body'  => '#262a2b',
				'text'  => '#ecf2f4',
				'one'   => '#e5edf0',
				'two'   => '#f2f6f7',
				'three' => '#acbec3',
				'four'  => '#9299a2',
				'five'  => '#acbec3',
				'six'   => '#869498'
			]
		],
		'wood' => [
			'slug'     => 'wood',
			'name'     => lang()->get( 'Wood' ),
			'about'    => lang()->get( 'The brown and tan colors of various wood types.' ),
			'category' => 'materials',
			'media'    => '#c1a060',
			'light' => [
				'body'  => '#fcfcf6',
				'text'  => '#381c08',
				'one'   => '#743020',
				'two'   => '#90594d',
				'three' => '#c1a060',
				'four'  => '#d6b26b',
				'five'  => '#643c2e',
				'six'   => '#8a5d4e'
			],
			'dark' => [
				'body'  => '#2a1506',
				'text'  => '#fbf7f0',
				'one'   => '#f3e8d3',
				'two'   => '#ebd9b5',
				'three' => '#784421',
				'four'  => '#502d16',
				'five'  => '#824536',
				'six'   => '#743020'
			]
		],

		// Nature.
		'beach' => [
			'slug'     => 'beach',
			'name'     => lang()->get( 'Beach' ),
			'about'    => lang()->get( 'Cool water and warm sand.' ),
			'category' => 'nature',
			'media'    => '#254d88',
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
		'forest' => [
			'slug'     => 'forest',
			'name'     => lang()->get( 'Forest' ),
			'about'    => lang()->get( 'The brown and green of forests with the orange and yellow of autumn leaves.' ),
			'category' => 'nature',
			'media'    => '#3e721a',
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
		'harvest-moon' => [
			'slug'     => 'harvest-moon',
			'name'     => lang()->get( 'Harvest Moon' ),
			'about'    => lang()->get( 'The big, beautiful Autumn moon in the night sky. <br />This is a dark-only scheme.' ),
			'category' => 'nature',
			'media'    => '#eba900',
			'light' => [
				'body'  => '#0d1526',
				'text'  => '#dee8f4',
				'one'   => '#eba900',
				'two'   => '#d68f00',
				'three' => '#eba900',
				'four'  => '#d68f00',
				'five'  => '#142343',
				'six'   => '#eba900'
			],
			'dark' => [
				'body'  => '#0d1526',
				'text'  => '#dee8f4',
				'one'   => '#eba900',
				'two'   => '#d68f00',
				'three' => '#eba900',
				'four'  => '#d68f00',
				'five'  => '#142343',
				'six'   => '#eba900'
			]
		],
		'sunrise' => [
			'slug'     => 'sunrise',
			'name'     => lang()->get( 'Sunrise' ),
			'about'    => lang()->get( 'The happy colors of early morning.' ),
			'category' => 'nature',
			'media'    => '#ff637e',
			'light' => [
				'body'  => '#fffffe',
				'text'  => '#052f4a',
				'one'   => '#0e9add',
				'two'   => '#7ccf00',
				'three' => '#ffd230',
				'four'  => '#ff637e',
				'five'  => '#462da9',
				'six'   => '#fb64b6'
			],
			'dark' => [
				'body'  => '#0d2330',
				'text'  => '#fffffd',
				'one'   => '#00bcff',
				'two'   => '#bbf451',
				'three' => '#ffd230',
				'four'  => '#ff637e',
				'five'  => '#462da9',
				'six'   => '#fb64b6'
			]
		],
		'sunset' => [
			'slug'     => 'sunset',
			'name'     => lang()->get( 'Sunset' ),
			'about'    => lang()->get( 'The fiery colors of late evening.' ),
			'category' => 'nature',
			'media'    => '#fe9a00',
			'light' => [
				'body'  => '#fef3c6',
				'text'  => '#024a70',
				'one'   => '#0069a8',
				'two'   => '#0092b8',
				'three' => '#fe9a00',
				'four'  => '#e17100',
				'five'  => '#e17100',
				'six'   => '#f0b100'
			],
			'dark' => [
				'body'  => '#08273a',
				'text'  => '#fefaec',
				'one'   => '#ffdf20',
				'two'   => '#0084d1',
				'three' => '#fe9a00',
				'four'  => '#ffdf20',
				'five'  => '#e17100',
				'six'   => '#ffd230'
			]
		],

		// Sanzo Wada
		'edo-01' => [
			'slug'     => 'edo-01',
			'name'     => lang()->get( 'Bitter Orange & Navy' ),
			'about'    => lang()->get( 'From the Edo era. Daidai is the bitter orange used in New Year decoration. Kon is the darkest grade of indigo, Hanada is a mid-tone indigo. Gofun, a chalk white made from ground oyster shell, is the traditional gesso of Japanese painting.' ),
			'category' => 'sanzo-wada',
			'media'    => '#f28c28',
			'light' => [
				'body'  => '#f3ebda',
				'text'  => '#1b2a4e',
				'one'   => '#3c6e8f',
				'two'   => '#f28c28',
				'three' => '#f28c28',
				'four'  => '#1b2a4e',
				'five'  => '#1b2a4e',
				'six'   => '#f28c28'
			],
			'dark' => [
				'body'  => '#131d37',
				'text'  => '#f3ebda',
				'one'   => '#f49d48',
				'two'   => '#f28c28',
				'three' => '#ce7722',
				'four'  => '#f28c28',
				'five'  => '#1b2a4e',
				'six'   => '#f28c28'
			]
		],
		'edo-02' => [
			'slug'     => 'edo-02',
			'name'     => lang()->get( 'Kerria Gold & Chestnut' ),
			'about'    => lang()->get( 'From the Edo era. Yamabuki is the saturated gold of the Kerria rose in bloom. Kuri-iro is the rich brown of roasted chestnuts. Kinari is the natural color of undyed hemp and silk.' ),
			'category' => 'sanzo-wada',
			'media'    => '#f5b71c',
			'light' => [
				'body'  => '#f8f4e9',
				'text'  => '#361f13',
				'one'   => '#6b3e26',
				'two'   => '#f5b71c',
				'three' => '#f5b71c',
				'four'  => '#6b3e26',
				'five'  => '#6b3e26',
				'six'   => '#f5b71c'
			],
			'dark' => [
				'body'  => '#20130b',
				'text'  => '#f8f4e9',
				'one'   => '#da7a4b',
				'two'   => '#f5b71c',
				'three' => '#f5b71c',
				'four'  => '#6b3e26',
				'five'  => '#6b3e26',
				'six'   => '#f5b71c'
			]
		],
		'edo-03' => [
			'slug'     => 'edo-03',
			'name'     => lang()->get( 'Pale Cherry & Tea' ),
			'about'    => lang()->get( 'From the Edo era. Usubeni is the pink of lightly faded cherry petals. Cha-iro is the brown of roasted tea leaves. Kinari is the natural color of undyed hemp and silk.' ),
			'category' => 'sanzo-wada',
			'media'    => '#d19494',
			'light' => [
				'body'  => '#f8f4e9',
				'text'  => '#36281e',
				'one'   => '#6c4f3b',
				'two'   => '#e8a4a4',
				'three' => '#e8a4a4',
				'four'  => '#6c4f3b',
				'five'  => '#6c4f3b',
				'six'   => '#e8a4a4'
			],
			'dark' => [
				'body'  => '#2b2018',
				'text'  => '#f8f4e9',
				'one'   => '#e8a4a4',
				'two'   => '#897262',
				'three' => '#e8a4a4',
				'four'  => '#897262',
				'five'  => '#6c4f3b',
				'six'   => '#e8a4a4'
			]
		],
		'heian-01' => [
			'slug'     => 'heian-01',
			'name'     => lang()->get( 'Crimson Safflower & Navy' ),
			'about'    => lang()->get( 'From the Heian era. Kurenai, the crimson drawn from safflower petals, was a luxury dye reserved for the robes of high-ranking courtiers. Set against Kon, the darkest grade of indigo, the pair became a signature of formal attire from the Heian court through to Edo merchant households. Gofun is the matte white of temple painting; it reads as devotional, timeless, and unmistakably sacred.' ),
			'category' => 'sanzo-wada',
			'overall'  => lang()->get( 'Sanzo Wada (1883 - 1967) was a Japanese artist & costume designer who published <em>A Dictionary of Color Combinations</em> in two volumes (1933 - 1934) in order to document Japanese color tastes.' ),
			'media'    => '#9a2a2a',
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
			'name'     => lang()->get( 'Dianthus & Water' ),
			'about'    => lang()->get( 'From the Heian era. Nadeshiko, the fringed pink Dianthus flower, was the standard metaphor for Japanese feminine ideals in classical poetry. Mizu-iro, water color, is the blue of a cold spring seen through ferns. Kinari is the natural color of undyed hemp and silk.' ),
			'category' => 'sanzo-wada',
			'media'    => '#f69bae',
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
		'heian-03' => [
			'slug'     => 'heian-03',
			'name'     => lang()->get( 'Wisteria & Indigo' ),
			'about'    => lang()->get( 'From the Heian era. Fuji-iro, wisteria purple, is a light, cool lavender drawn from the pendulous flowers of the Fuji vine. Ai, true indigo, grounds it with depth. The pair is a signature of early summer gardens. The pair is a signature of early summer gardens. Gofun is the matte white of temple painting; it reads as devotional, timeless, and unmistakably sacred.' ),
			'category' => 'sanzo-wada',
			'media'    => '#b398d7',
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
		],
		'heian-04' => [
			'slug'     => 'heian-04',
			'name'     => lang()->get( 'Teal Green & Ink' ),
			'about'    => lang()->get( 'From the Heian era. Ao ranged from blue to green in classical Japanese, what we call teal. Shiro is pure white. Sumi is the black of stick ink ground on a slate inkstone.' ),
			'category' => 'sanzo-wada',
			'media'    => '#3a7d7b',
			'light' => [
				'body'  => '#ffffff',
				'text'  => '#1c1c1c',
				'one'   => '#3a7d7b',
				'two'   => '#1c1c1c',
				'three' => '#3a7d7b',
				'four'  => '#1c1c1c',
				'five'  => '#1c1c1c',
				'six'   => '#3a7d7b'
			],
			'dark' => [
				'body'  => '#1c1c1c',
				'text'  => '#ffffff',
				'one'   => '#3a7d7b',
				'two'   => '#ffffff',
				'three' => '#3a7d7b',
				'four'  => '#ffffff',
				'five'  => '#1c1c1c',
				'six'   => '#3a7d7b'
			]
		],
		'heian-05' => [
			'slug'     => 'heian-05',
			'name'     => lang()->get( 'Valerian Petals & Sky' ),
			'about'    => lang()->get( 'From the Heian era. Ominaeshi, one of the seven autumn plants, has tiny pale-yellow flowers that cluster in late summer fields. Asagi is the pale green-blue of young leek shoots, used here as the summer sky. Kinari is the natural color of undyed hemp and silk.' ),
			'category' => 'sanzo-wada',
			'media'    => '#88b9c4',
			'light' => [
				'body'  => '#f8f4e9',
				'text'  => '#1c1c1c',
				'one'   => '#88b9c4',
				'two'   => '#dccb6e',
				'three' => '#88b9c4',
				'four'  => '#dccb6e',
				'five'  => '#dccb6e',
				'six'   => '#88b9c4'
			],
			'dark' => [
				'body'  => '#1c1c1c',
				'text'  => '#f8f4e9',
				'one'   => '#88b9c4',
				'two'   => '#dccb6e',
				'three' => '#88b9c4',
				'four'  => '#dccb6e',
				'five'  => '#dccb6e',
				'six'   => '#88b9c4'
			]
		],
		'kamakura-01' => [
			'slug'     => 'kamakura-01',
			'name'     => lang()->get( 'Lapis Lazuli & Gold' ),
			'about'    => lang()->get( 'From the Kamakura era. Gunjō is ground lapis lazuli, the blue of Buddhist statuary hair and illuminated sutras. Kogane is the color of gold leaf. Gofun, a chalk white made from ground oyster shell, is the traditional gesso of Japanese painting.' ),
			'category' => 'sanzo-wada',
			'media'    => '#264a6b',
			'light' => [
				'body'  => '#f8f4e9',
				'text'  => '#264a6b',
				'one'   => '#c5ac6b',
				'two'   => '#264a6b',
				'three' => '#264a6b',
				'four'  => '#c5ac6b',
				'five'  => '#264a6b',
				'six'   => '#c5ac6b'
			],
			'dark' => [
				'body'  => '#264a6b',
				'text'  => '#f8f4e9',
				'one'   => '#c5ac6b',
				'two'   => '#f8f4e9',
				'three' => '#264a6b',
				'four'  => '#c5ac6b',
				'five'  => '#264a6b',
				'six'   => '#c5ac6b'
			]
		],
		'kamakura-02' => [
			'slug'     => 'kamakura-02',
			'name'     => lang()->get( 'Spring Green & Ink' ),
			'about'    => lang()->get( 'From the Kamakura era. Moegi is the yellow-green of new shoots pushing through earth in early spring. Sumi is the black of stick ink ground on a slate inkstone. Kinari is the natural color of undyed hemp and silk.' ),
			'category' => 'sanzo-wada',
			'media'    => '#a7c957',
			'light' => [
				'body'  => '#f8f4e9',
				'text'  => '#1c1c1c',
				'one'   => '#86a146',
				'two'   => '#a7c957',
				'three' => '#a7c957',
				'four'  => '#1c1c1c',
				'five'  => '#1c1c1c',
				'six'   => '#a7c957'
			],
			'dark' => [
				'body'  => '#1c1c1c',
				'text'  => '#f8f4e9',
				'one'   => '#a7c957',
				'two'   => '#f8f4e9',
				'three' => '#a7c957',
				'four'  => '#f8f4e9',
				'five'  => '#1c1c1c',
				'six'   => '#a7c957'
			]
		],
		'kamakura-03' => [
			'slug'     => 'kamakura-03',
			'name'     => lang()->get( 'Cinnabar & Gold' ),
			'about'    => lang()->get( 'From the Kamakura era. This is the imperial and Buddhist ceremonial combination, found on lacquer boxes, shrine architecture, and festival floats. Shu, the bright orange-red of cinnabar, is for protection. Kuro, similar to India ink, is for ground. Kin, the color of gold, is for transcendence.' ),
			'category' => 'sanzo-wada',
			'media'    => '#c8352b',
			'light' => [
				'body'  => '#f8f4e9',
				'text'  => '#141414',
				'one'   => '#d4af37',
				'two'   => '#c8352b',
				'three' => '#c8352b',
				'four'  => '#d4af37',
				'five'  => '#c8352b',
				'six'   => '#d4af37'
			],
			'dark' => [
				'body'  => '#141414',
				'text'  => '#f8f4e9',
				'one'   => '#d4af37',
				'two'   => '#c8352b',
				'three' => '#c8352b',
				'four'  => '#d4af37',
				'five'  => '#c8352b',
				'six'   => '#d4af37'
			]
		],
		'muromachi-01' => [
			'slug'     => 'muromachi-01',
			'name'     => lang()->get( 'Dry Grass & Olive' ),
			'about'    => lang()->get( 'From the Muromachi era. Kariyasu, an earthy yellow, represents wild mountain grass. Rikyū-nezumi, an olive-tinted grey, is named for a 16th-century tea master. Neri-iro is silk white.' ),
			'category' => 'sanzo-wada',
			'media'    => '#dccb7a',
			'light' => [
				'body'  => '#f3ebda',
				'text'  => '#292923',
				'one'   => '#7a7c68',
				'two'   => '#dccb7a',
				'three' => '#dccb7a',
				'four'  => '#878a74',
				'five'  => '#878a74',
				'six'   => '#dccb7a'
			],
			'dark' => [
				'body'  => '#292923',
				'text'  => '#f3ebda',
				'one'   => '#dccb7a',
				'two'   => '#f3ebda',
				'three' => '#dccb7a',
				'four'  => '#878a74',
				'five'  => '#878a74',
				'six'   => '#dccb7a'
			]
		],
		'muromachi-02' => [
			'slug'     => 'muromachi-02',
			'name'     => lang()->get( 'Celadon & Pine' ),
			'about'    => lang()->get( 'From the Muromachi era. Seiji is the blue-green glaze of Longquan and Arita celadons. Matsuba is the dark green of pine needles. Kinari is the natural color of undyed hemp and silk.' ),
			'category' => 'sanzo-wada',
			'media'    => '#8db6a5',
			'light' => [
				'body'  => '#f3ebda',
				'text'  => '#2c312a',
				'one'   => '#6e7b6a',
				'two'   => '#8db6a5',
				'three' => '#8db6a5',
				'four'  => '#6e7b6a',
				'five'  => '#6e7b6a',
				'six'   => '#8db6a5'
			],
			'dark' => [
				'body'  => '#2c312a',
				'text'  => '#f3ebda',
				'one'   => '#8db6a5',
				'two'   => '#f3ebda',
				'three' => '#8db6a5',
				'four'  => '#6e7b6a',
				'five'  => '#6e7b6a',
				'six'   => '#8db6a5'
			]
		],
		'muromachi-03' => [
			'slug'     => 'muromachi-03',
			'name'     => lang()->get( 'Match & Black Tea' ),
			'about'    => lang()->get( 'From the Muromachi era. Matcha-iro is the yellow-green of Matcha powdered tea. Cha is the brown of black tea. Kinari is the natural color of undyed hemp and silk.' ),
			'category' => 'sanzo-wada',
			'media'    => '#a7b86b',
			'light' => [
				'body'  => '#f3ebda',
				'text'  => '#2b2418',
				'one'   => '#6c5a3c',
				'two'   => '#a7b86b',
				'three' => '#a7b86b',
				'four'  => '#6c5a3c',
				'five'  => '#6c5a3c',
				'six'   => '#a7b86b'
			],
			'dark' => [
				'body'  => '#2b2418',
				'text'  => '#f3ebda',
				'one'   => '#a7b86b',
				'two'   => '#f3ebda',
				'three' => '#a7b86b',
				'four'  => '#6c5a3c',
				'five'  => '#6c5a3c',
				'six'   => '#a7b86b'
			]
		],
		'muromachi-04' => [
			'slug'     => 'muromachi-04',
			'name'     => lang()->get( 'Traditional Farmhouse' ),
			'about'    => lang()->get( 'From the Muromachi era. Kogecha is the near-black brown of cedar scorched for weatherproofing (yakisugi). Kakishibu is named Persimmon-tanned. Kinari is the natural color of undyed hemp and silk. Together they compose the traditional Japanese farmhouse: dark timber posts, pale paper walls.' ),
			'category' => 'sanzo-wada',
			'media'    => '#8a6a47',
			'light' => [
				'body'  => '#f3ebda',
				'text'  => '#251912',
				'one'   => '#3e2a1e',
				'two'   => '#8a6a47',
				'three' => '#8a6a47',
				'four'  => '#3e2a1e',
				'five'  => '#3e2a1e',
				'six'   => '#8a6a47'
			],
			'dark' => [
				'body'  => '#251912',
				'text'  => '#f3ebda',
				'one'   => '#a78f75',
				'two'   => '#8a6a47',
				'three' => '#8a6a47',
				'four'  => '#6e5539',
				'five'  => '#3e2a1e',
				'six'   => '#8a6a47'
			]
		]
	];

	// Merge custom schemes.
	$bootstrap = bootstrap_scheme();
	$tailwind  = tailwind_scheme();
	$custom    = custom_scheme();
	$schemes   = array_merge( $schemes, $bootstrap );
	$schemes   = array_merge( $schemes, $tailwind );
	$schemes   = array_merge( $schemes, $custom );
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

	// Exclude custom schemes.
	if ( in_array( plugin()->color_scheme(), custom_schemes() ) ) {
		return $scheme;
	}

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
		$color = $colors[$custom_from]['media'];
	} elseif ( isset( $current['media'] ) ) {
		$color = $current['media'];
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
 * Color picker: light & dark colors
 *
 * @since  1.0.0
 * @return array Returns an array of hex values.
 */
function picker_colors_merged() {

	$modes = array_merge( picker_colors_light(), picker_colors_dark() );
	$merge = [];

	foreach ( $modes as $colors => $color ) {

		// Filter duplicates.
		if ( ! in_array( $color, $merge ) ) {
			$merge[] = $color;
		}
	}
	return $merge;
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
	if ( false == $current ) {
		return;
	}

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
