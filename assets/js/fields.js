/**
 * Plugin form fields
 *
 * @package    Configure 8 Options
 * @subpackage Assets
 * @category   Scripts
 * @since      1.0.0
 */

jQuery(document).ready( function($) {

	// Mobile toolbar.
	$( '#user_toolbar' ).on( 'change', function() {
    	var show = $(this).val();
		if ( show != 'disabled' ) {
			$( "#toolbar_mobile_wrap" ).fadeIn( 250 );
		} else if ( show == 'disabled' ) {
			$( "#toolbar_mobile_wrap" ).fadeOut( 250 );
		}
    });

	// Page loader options.
	$( '#page_loader' ).on( 'change', function() {
    	var show = $(this).val();
		if ( show == 'true' ) {
			$( "#loader_options" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#loader_options' ).offset().top
			}, 1000 );
		} else if ( show == 'false' ) {
			$( "#loader_options" ).fadeOut( 250 );
		}
    });

	// Loader background.
	$( '#loader_bg_color_default' ).click( function() {
		$( '#loader_bg_color' ).spectrum( 'set', $( '#loader_bg_default' ).val() );
	});
	$( '#loader_bg_color_default_dark' ).click( function() {
		$( '#loader_bg_color_dark' ).spectrum( 'set', $( '#loader_bg_default_dark' ).val() );
	});

	// Loader text.
	$( '#loader_text_color_default' ).click( function() {
		$( '#loader_text_color' ).spectrum( 'set', $( '#loader_text_default' ).val() );
	});
	$( '#loader_text_color_default_dark' ).click( function() {
		$( '#loader_text_color_dark' ).spectrum( 'set', $( '#loader_text_default_dark' ).val() );
	});

	// Posts navigation options.
	$( '#loop_break' ).on( 'change', function() {
    	var show = $(this).val();
		if ( show == 'true' ) {
			$( "#content-break-options" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#content-break-options' ).offset().top + -120
			}, 1000 );
		} else if ( show == 'false' ) {
			$( "#content-break-options" ).fadeOut( 250 );
		}
    });

	// Loop nav label option.
	$( '#main_nav_loop' ).on( 'change', function() {
    	var show = $(this).val();
		if ( show != 'none' ) {
			$( "#main_nav_loop_label_wrap" ).fadeIn( 250 );
		} else if ( show == 'none' ) {
			$( "#main_nav_loop_label_wrap" ).fadeOut( 250 );
		}
    });

	// Modal window background.
	$( '#modal_bg_color' ).spectrum({
		type            : "component",
		showPalette     : true,
		palette         : [],
		preferredFormat : "rgb",
		showInitial     : true,
		allowEmpty      : false,
		showSelectionPalette : false
	});
	$( '#modal_bg_color' ).show();

	$( '#modal_bg_color_default' ).click( function() {
		$( '#modal_bg_color' ).spectrum( 'set', $( '#modal_bg_default' ).val() );
	});

	// Loop options.
	$( '#loop_type' ).on( 'change', function() {
    	var type = $(this).val();
		if ( type == 'blog' ) {
			$( "#loop_word_count" ).val( 'true' );
			$( "#loop_read_time" ).val( 'true' );
		} else if ( type == 'news' ) {
			$( "#loop_word_count" ).val( 'false' );
			$( "#loop_read_time" ).val( 'false' );
		}
    });

	// Cover album.
	$( '.image-in-album[data-fancybox]' ).fancybox({
		buttons: [
			'zoom',
			'thumbs',
			'download',
			'close'
		  ],

	});

	// Cover image style.
	$( '#cover_style' ).on( 'change', function() {
    	var show = $(this).val();
		if ( show == 'overlay' ) {
			$( "#cover_blend_wrap" ).css( 'display', 'none' );
			$( "#cover_overlay_wrap" ).css( 'display', 'block' );
		} else if ( show == 'blend' ) {
			$( "#cover_overlay_wrap" ).css( 'display', 'none' );
			$( "#cover_blend_wrap" ).fadeIn( 250 );
		}
    });

	// Cover image overlay.
	$( '#cover_overlay' ).spectrum({
		type            : "component",
		showPalette     : true,
		palette         : [],
		preferredFormat : "rgb",
		showInitial     : true,
		allowEmpty      : false,
		showSelectionPalette : false
	});
	$( '#cover_overlay' ).show();

	$( '#cover_overlay_default_button' ).click( function() {
		$( '#cover_overlay' ).spectrum( 'set', $( '#cover_overlay_default' ).val() );
	});

	$( '#cover_desaturate' ).on( 'change', function() {
		var show = $(this).val();
		if ( show > 0 ) {
			$( '#cover-desaturate-use-wrap' ).css( 'display', 'flex' );
		} else if ( show == 0 ) {
			$( '#cover-desaturate-use-wrap' ).css( 'display', 'none' );
		}
	});
	$( '#cover_desaturate_reset' ).click( function() {
		$( '#cover-desaturate-use-wrap' ).css( 'display', 'none' );
	});

	// Cover image blend.
	$( '#cover_blend_default_button' ).click( function() {
		$( '#cover_blend' ).spectrum( 'set', $( '#cover_blend_default' ).val() );
	});

	// Cover image text.
	$( '#cover_text_color' ).spectrum({
		type            : "component",
		showPalette     : true,
		palette         : [],
		preferredFormat : "hex",
		showInitial     : true,
		allowEmpty      : false,
		showSelectionPalette : false
	});
	$( '#cover_text_color' ).show();

	$( '#cover_text_color_default' ).click( function() {
		$( '#cover_text_color' ).spectrum( 'set', $( '#cover_text_default' ).val() );
	});

	// Posts navigation options.
	$( '#posts_nav' ).on( 'change', function() {
    	var show = $(this).val();
		if ( show == 'true' ) {
			$( "#posts_nav_wrap" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#posts_nav_wrap' ).offset().top + -120
			}, 1000 );
		} else if ( show == 'false' ) {
			$( "#posts_nav_wrap" ).fadeOut( 250 );
		}
    });

	// Front page slider options.
	$( '#posts_slider' ).on( 'change', function() {
    	var show = $(this).val();
		if ( show == 'true' ) {
			$( "#slider_options" ).fadeIn( 250 );
			$( "#blend_slider_label" ).show();
		} else if ( show == 'false' ) {
			$( "#slider_options" ).fadeOut( 250 );
			$( "#blend_slider_label" ).hide();
		}
    });

	// Slider pages.
	$( '#slider_content' ).on( 'change', function() {
		var show = $(this).val();
		if ( show == 'recent' ) {
			$( "#slider_number_wrap" ).fadeIn( 250 );
		} else if ( show != 'recent' ) {
			$( "#slider_number_wrap" ).fadeOut( 250 );
		}
	});

	// Slider pages.
	$( '#slider_content' ).on( 'change', function() {
		var show = $(this).val();
		if ( show == 'static' ) {
			$( "#slider_pages_wrap" ).fadeIn( 250 );
		} else if ( show != 'static' ) {
			$( "#slider_pages_wrap" ).fadeOut( 250 );
		}
	});

	// Related posts options.
	$( '#related_posts' ).on( 'change', function() {
    	var show = $(this).val();
		if ( show == 'true' ) {
			$( "#related_options" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#related_options' ).offset().top
			}, 1000 );
		} else if ( show == 'false' ) {
			$( "#related_options" ).fadeOut( 250 );
		}
    });

	// Error template.
	$( '#error_widgets' ).on( 'change', function() {
    	var show = $(this).val();
		if ( show != 'content' ) {
			$( "#error_widget_options" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#error_widget_options' ).offset().top
			}, 1000 );
		} else if ( show == 'content' ) {
			$( "#error_widget_options" ).fadeOut( 250 );
		}
    });

	$( '#error_search' ).on( 'change', function() {
    	var show = $(this).val();
		if ( show == 'true' ) {
			$( "#error_search_options" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#error_search_options' ).offset().top
			}, 1000 );
		} else if ( show == 'false' ) {
			$( "#error_search_options" ).fadeOut( 250 );
		}
    });

	$( '#error_search_btn' ).on( 'change', function() {
    	var show = $(this).val();
		if ( show == 'true' ) {
			$( "#error_search_btn_text_wrap" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#error_search_btn_text_wrap' ).offset().top
			}, 1000 );
		} else if ( show == 'false' ) {
			$( "#error_search_btn_text_wrap" ).fadeOut( 250 );
		}
    });

	$( '#error_static' ).on( 'change', function() {
    	var show = $(this).val();
		if ( show == 'true' ) {
			$( "#error_static_options" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#error_static_options' ).offset().top
			}, 1000 );
		} else if ( show == 'false' ) {
			$( "#error_static_options" ).fadeOut( 250 );
		}
    });

	$( '#error_cats' ).on( 'change', function() {
    	var show = $(this).val();
		if ( show == 'true' ) {
			$( "#error_cats_options" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#error_cats_options' ).offset().top
			}, 1000 );
		} else if ( show == 'false' ) {
			$( "#error_cats_options" ).fadeOut( 250 );
		}
    });

	$( '#error_tags' ).on( 'change', function() {
    	var show = $(this).val();
		if ( show == 'true' ) {
			$( "#error_tags_options" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#error_tags_options' ).offset().top
			}, 1000 );
		} else if ( show == 'false' ) {
			$( "#error_tags_options" ).fadeOut( 250 );
		}
    });

	// Sidebar options.
	$( '#sidebar_social' ).on( 'change', function() {
		var show = $(this).val();
		if ( show == 'true' ) {
			$( "#sb_social_heading_wrap" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#sb_social_heading_wrap' ).offset().top
			}, 1000 );
		} else if ( show == 'false' ) {
			$( "#sb_social_heading_wrap" ).fadeOut( 250 );
		}
	});

	// Footer options.
	$( '#footer_social' ).on( 'change', function() {
		var show = $(this).val();
		if ( show == 'true' ) {
			$( "#ftr_social_heading_wrap" ).fadeIn( 250 );
			$( 'html, body' ).animate( {
				scrollTop: $( '#ftr_social_heading_wrap' ).offset().top
			}, 1000 );
		} else if ( show == 'false' ) {
			$( "#ftr_social_heading_wrap" ).fadeOut( 250 );
		}
	});

	$( '#copy_text' ).on( 'change', function() {
		var show = $(this).val();
		if ( show ) {
			$( '#copyright-date' ).css( 'display', 'none' );
		} else {
			$( '#copyright-date' ).css( 'display', 'flex' );
		}
	});

	// Copyright options.
	$( '#copyright' ).on( 'change', function() {
		var show = $(this).val();
		if ( show == 'true' ) {
			$( "#copyright_options" ).fadeIn( 250 );
		} else if ( show == 'false' ) {
			$( "#copyright_options" ).fadeOut( 250 );
		}
	});

	// Custom colors.
	$( '#color_scheme' ).on( 'change', function() {
		var show = $(this).val();
		if ( show == 'custom' ) {
			$( "#custom_color_scheme_fields" ).fadeIn( 250 );
		} else if ( show != 'custom' ) {
			$( "#custom_color_scheme_fields" ).fadeOut( 250 );
		}
	});

	/**
	 * Custom scheme thumbnails
	 *
	 * Thumbnail ID numbers do not match color field numbers
	 * because the count starts with body & text colors, so
	 * the numbers are skewed by two.
	 */
	$( '#color_body' ).on( 'change', function() {
		$( '#custom_thumb_1' ).css( 'background-color', $(this).val() );
	});
	$( '#color_text' ).on( 'change', function() {
		$( '#custom_thumb_2' ).css( 'background-color', $(this).val() );
	});
	$( '#color_one' ).on( 'change', function() {
		$( '#custom_thumb_3' ).css( 'background-color', $(this).val() );
	});
	$( '#color_two' ).on( 'change', function() {
		$( '#custom_thumb_4' ).css( 'background-color', $(this).val() );
	});
	$( '#color_three' ).on( 'change', function() {
		$( '#custom_thumb_5' ).css( 'background-color', $(this).val() );
	});
	$( '#color_four' ).on( 'change', function() {
		$( '#custom_thumb_6' ).css( 'background-color', $(this).val() );
	});
	$( '#color_five' ).on( 'change', function() {
		$( '#custom_thumb_7' ).css( 'background-color', $(this).val() );
	});
	$( '#color_six' ).on( 'change', function() {
		$( '#custom_thumb_8' ).css( 'background-color', $(this).val() );
	});

	$( '#color_body_dark' ).on( 'change', function() {
		$( '#custom_thumb_1_dark' ).css( 'background-color', $(this).val() );
	});
	$( '#color_text_dark' ).on( 'change', function() {
		$( '#custom_thumb_2_dark' ).css( 'background-color', $(this).val() );
	});
	$( '#color_one_dark' ).on( 'change', function() {
		$( '#custom_thumb_3_dark' ).css( 'background-color', $(this).val() );
	});
	$( '#color_two_dark' ).on( 'change', function() {
		$( '#custom_thumb_4_dark' ).css( 'background-color', $(this).val() );
	});
	$( '#color_three_dark' ).on( 'change', function() {
		$( '#custom_thumb_5_dark' ).css( 'background-color', $(this).val() );
	});
	$( '#color_four_dark' ).on( 'change', function() {
		$( '#custom_thumb_6_dark' ).css( 'background-color', $(this).val() );
	});
	$( '#color_five_dark' ).on( 'change', function() {
		$( '#custom_thumb_7_dark' ).css( 'background-color', $(this).val() );
	});
	$( '#color_six_dark' ).on( 'change', function() {
		$( '#custom_thumb_8_dark' ).css( 'background-color', $(this).val() );
	});

	$( '#color_body_default_button' ).click( function() {
		$( '#color_body' ).spectrum( 'set', $( '#color_body_default' ).val() );
		$( '#custom_thumb_1' ).css( 'background-color', $( '#color_body_default' ).val() );
	});
	$( '#color_body_dark_default_button' ).click( function() {
		$( '#color_body_dark' ).spectrum( 'set', $( '#color_body_dark_default' ).val() );
		$( '#custom_thumb_2_dark' ).css( 'background-color', $( '#color_body_dark_default' ).val() );
	});
	$( '#color_text_default_button' ).click( function() {
		$( '#color_text' ).spectrum( 'set', $( '#color_text_default' ).val() );
		$( '#custom_thumb_1' ).css( 'background-color', $( '#color_text_default' ).val() );
	});
	$( '#color_text_dark_default_button' ).click( function() {
		$( '#color_text_dark' ).spectrum( 'set', $( '#color_text_dark_default' ).val() );
		$( '#custom_thumb_2_dark' ).css( 'background-color', $( '#color_text_dark_default' ).val() );
	});

	$( '#color_one_default_button' ).click( function() {
		$( '#color_one' ).spectrum( 'set', $( '#color_one_default' ).val() );
		$( '#custom_thumb_3' ).css( 'background-color', $( '#color_one_default' ).val() );
	});
	$( '#color_two_default_button' ).click( function() {
		$( '#color_two' ).spectrum( 'set', $( '#color_two_default' ).val() );
		$( '#custom_thumb_4' ).css( 'background-color', $( '#color_two_default' ).val() );
	});
	$( '#color_three_default_button' ).click( function() {
		$( '#color_three' ).spectrum( 'set', $( '#color_three_default' ).val() );
		$( '#custom_thumb_5' ).css( 'background-color', $( '#color_three_default' ).val() );
	});
	$( '#color_four_default_button' ).click( function() {
		$( '#color_four' ).spectrum( 'set', $( '#color_four_default' ).val() );
		$( '#custom_thumb_6' ).css( 'background-color', $( '#color_four_default' ).val() );
	});
	$( '#color_five_default_button' ).click( function() {
		$( '#color_five' ).spectrum( 'set', $( '#color_five_default' ).val() );
		$( '#custom_thumb_7' ).css( 'background-color', $( '#color_five_default' ).val() );
	});
	$( '#color_six_default_button' ).click( function() {
		$( '#color_six' ).spectrum( 'set', $( '#color_six_default' ).val() );
		$( '#custom_thumb_8' ).css( 'background-color', $( '#color_six_default' ).val() );
	});

	$( '#color_one_dark_default_button' ).click( function() {
		$( '#color_one_dark' ).spectrum( 'set', $( '#color_one_dark_default' ).val() );
		$( '#custom_thumb_3_dark' ).css( 'background-color', $( '#color_one_dark_default' ).val() );
	});
	$( '#color_two_dark_default_button' ).click( function() {
		$( '#color_two_dark' ).spectrum( 'set', $( '#color_two_dark_default' ).val() );
		$( '#custom_thumb_4_dark' ).css( 'background-color', $( '#color_two_dark_default' ).val() );
	});
	$( '#color_three_dark_default_button' ).click( function() {
		$( '#color_three_dark' ).spectrum( 'set', $( '#color_three_dark_default' ).val() );
		$( '#custom_thumb_5_dark' ).css( 'background-color', $( '#color_three_dark_default' ).val() );
	});
	$( '#color_four_dark_default_button' ).click( function() {
		$( '#color_four_dark' ).spectrum( 'set', $( '#color_four_dark_default' ).val() );
		$( '#custom_thumb_6_dark' ).css( 'background-color', $( '#color_four_dark_default' ).val() );
	});
	$( '#color_five_dark_default_button' ).click( function() {
		$( '#color_five_dark' ).spectrum( 'set', $( '#color_five_dark_default' ).val() );
		$( '#custom_thumb_7_dark' ).css( 'background-color', $( '#color_five_dark_default' ).val() );
	});
	$( '#color_six_dark_default_button' ).click( function() {
		$( '#color_six_dark' ).spectrum( 'set', $( '#color_six_dark_default' ).val() );
		$( '#custom_thumb_8_dark' ).css( 'background-color', $( '#color_six_dark_default' ).val() );
	});

	// Admin options.
	$( '#admin_theme' ).on( 'change', function() {
		var theme = $(this).val();
		if ( theme == 'theme' ) {
			$( "#admin-desc-theme" ).css( 'display', 'block' );
		} else if ( theme != 'theme' ) {
			$( "#admin-desc-theme" ).css( 'display', 'none' );
		}
		if ( theme == 'css' ) {
			$( "#admin-desc-css" ).css( 'display', 'block' );
		} else if ( theme != 'css' ) {
			$( "#admin-desc-css" ).css( 'display', 'none' );
		}
		if ( theme == 'default' ) {
			$( "#admin-desc-default" ).css( 'display', 'block' );
		} else if ( theme != 'default' ) {
			$( "#admin-desc-default" ).css( 'display', 'none' );
		}
	});
	$( '#admin_menu' ).on( 'change', function() {
		var show = $(this).val();
		if ( show == 'true' ) {
			$( "#admin-menu" ).fadeIn( 250 );
		} else if ( show != 'admin-menu' ) {
			$( "#admin-menu" ).fadeOut( 250 );
		}
	});
});
