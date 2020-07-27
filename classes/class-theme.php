<?php
/**
 * Theme Setup
 *
 * @package Fundamento
 * @since 1.0.0
 * @phpcs:disable WordPress.NamingConventions.ValidHookName.UseUnderscores
 * @phpcs:disable WordPress.NamingConventions.ValidHookName.NotLowercase
 */

namespace Fundamento;

/**
 * Enable a faster WordPress theme setup.
 */
class Theme {

	/**
	 * Constructs the object with the the necessary calls.
	 */
	public function __construct() {
		$this->load_theme_textdomain( 'fundamento', get_template_directory() . '/languages' )
			->add_support( 'title-tag' )
			->add_support( 'custom-logo',
				array(
					'header-text' => array(
						'site-title',
						'site-description',
					),
				)
			)
			->add_support( 'post-thumbnails' )
			->add_support( 'customize-selective-refresh-widgets' )
			->add_support( 'html5',
				array(
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
					'script',
					'style',
				)
			)
			->add_support( 'featured-content',
				array(
					'filter'     => 'fundamento_get_featured_posts',
					'max_posts'  => 5,
					'post_types' => array(
						'post',
						'page',
					),
				)
			)
			->add_style( 'styles', get_stylesheet_uri(), array(), 'v1.0.0' . rand(0, 1000) )
			->add_comment_script()
			->pingback();
	}

	/**
	 * Add action
	 * 
	 * @param string   $tag             The name of the action to which the $function_to_add is hooked.
	 * @param callable $function_to_add The name of the function you wish to be called.
	 * @param int      $priority        Used to specify the order in which the functions associated with a particular action are executed. Lower numbers correspond with earlier execution, and functions with the same priority are executed in the order in which they were added to the action.
	 * @param int      $accepted_args   The number of arguments the function accepts.
	 */
	private function add_action( $tag, $function_to_add, $priority = 10, $accepted_args = 1 ) {
		add_action(
			$tag,
			function() use ( $function_to_add ) {
				$function_to_add();
			},
			$priority,
			$accepted_args
		);
	}

	/**
	 * Add pingback link on the header
	 */
	private function pingback() {
		$this->add_action( 'wp_head',
			function() {
				if ( is_singular() && pings_open() ) {
					printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
				}
			}
		);
	}

	/**
	 * Add theme support
	 * 
	 * @param string $feature The feature being added.
	 * @param mixed  $args    Extra arguments to pass along with certain features.
	 */
	public function add_support( $feature, $args = null ) {
		$this->add_action( 'after_setup_theme',
			function() use ( $feature, $args ) {
				if ( null !== $args ) {
					add_theme_support( $feature, $args );
				} else {
					add_theme_support( $feature );
				}
			}
		);

		return $this;
	}

	/**
	 * Remove theme support
	 * 
	 * @param string $feature The feature being removed.
	 */
	public function remove_support( $feature ) {
		$this->add_action( 'after_setup_theme',
			function() use ( $feature ) {
				remove_theme_support( $feature );
			}
		);

		return $this;
	}

	/**
	 * Load text domain
	 * 
	 * @param string $domain Text domain. Unique identifier for retrieving translated strings.
	 * @param string $path   Path to the directory containing the .mo file.
	 */
	public function load_theme_textdomain( $domain, $path = false ) {
		$this->add_action( 'after_setup_theme',
			function() use ( $domain, $path ) {
				load_theme_textdomain( $domain, $path );
			}
		);

		return $this;
	}

	/**
	 * Add image size
	 * 
	 * @param string $name   Image size identifier.
	 * @param int    $width  Image width in pixels. Default 0.
	 * @param int    $height Image height in pixels. Default 0.
	 * @param bool   $crop   Whether to crop images to specified width and height or resize. An array can specify positioning of the crop area.
	 */
	public function add_image_size( $name, $width = 0, $height = 0, $crop = false ) {
		$this->add_action( 'after_setup_theme',
			function() use ( $name, $width, $height, $crop ) {
				add_image_size( $name, $width, $height, $crop );
			}
		);

		return $this;
	}

	/**
	 * Remove image size
	 * 
	 * @param string $name The image size to remove.
	 */
	public function remove_image_size( $name ) {
		$this->add_action( 'after_setup_theme',
			function() use ( $name ) {
				remove_image_size( $name );
			}
		);

		return $this;
	}

	/**
	 * Add style
	 * 
	 * @param string $handle Name of the stylesheet. Should be unique.
	 * @param string $src    Full URL of the stylesheet, or path of the stylesheet relative to the WordPress root directory.
	 * @param array  $deps   An array of registered stylesheet handles this stylesheet depends on.
	 * @param string $ver    String specifying stylesheet version number, if it has one, which is added to the URL as a query string for cache busting purposes. If version is set to false, a version number is automatically added equal to current installed WordPress version. If set to null, no version is added.
	 * @param string $media  The media for which this stylesheet has been defined. Accepts media types like 'all', 'print' and 'screen', or media queries like '(orientation: portrait)' and '(max-width: 640px)'.
	 */
	public function add_style( $handle, $src = '', $deps = array(), $ver = false, $media = 'all' ) {
		$this->add_action( 'wp_enqueue_scripts',
			function() use ( $handle, $src, $deps, $ver, $media ) {
				wp_enqueue_style( $handle, $src, $deps, $ver, $media );
			}
		);

		return $this;
	}

	/**
	 * Add javascript
	 * 
	 * @param string  $handle    Name of the script. Should be unique.
	 * @param string  $src       Full URL of the script, or path of the script relative to the WordPress root directory.
	 * @param array   $deps      An array of registered script handles this script depends on.
	 * @param string  $ver       String specifying script version number, if it has one, which is added to the URL as a query string for cache busting purposes. If version is set to false, a version number is automatically added equal to current installed WordPress version. If set to null, no version is added.
	 * @param boolean $in_footer Whether to enqueue the script before </body> instead of in the <head>.
	 */
	public function add_script( $handle, $src = '', $deps = array(), $ver = false, $in_footer = true ) {
		$this->add_action( 'wp_enqueue_scripts',
			function() use ( $handle, $src, $deps, $ver, $in_footer ) {
				wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
			}
		);

		return $this;
	}

	/**
	 * Add comment script
	 */
	public function add_comment_script() {
		$this->add_action( 'wp_enqueue_scripts',
			function() {
				if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
					wp_enqueue_script( 'comment-reply' );
				}
			}
		);

		return $this;
	}

	/**
	 * Remove style
	 * 
	 * @param string $handle Name of the stylesheet to be removed.
	 */
	public function remove_style( $handle ) {
		$this->add_action( 'wp_enqueue_scripts',
			function() use ( $handle ) {
				wp_dequeue_style( $handle );
				wp_deregister_style( $handle ); 
			}
		);

		return $this;
	}

	/**
	 * Remove script
	 * 
	 * @param string $handle Name of the script to be removed.
	 */
	public function remove_script( $handle ) {
		$this->add_action( 'wp_enqueue_scripts',
			function() use ( $handle ) {
				wp_dequeue_script( $handle );
				wp_deregister_script( $handle ); // phpcs:ignore
			}
		);

		return $this;
	}

	/**
	 * Add multiple navigation menus
	 * 
	 * @param array $locations Associative array of menu location identifiers (like a slug) and descriptive text.
	 */
	public function register_nav_menus( $locations = array() ) {
		$this->add_action( 'after_setup_theme',
			function() use ( $locations ) {
				register_nav_menus( $locations );
			}
		);

		return $this;
	}

	/**
	 * Add a navigation menu
	 * 
	 * @param string $location    Menu location identifier, like a slug.
	 * @param string $description Menu location descriptive text.
	 */
	public function register_nav_menu( $location, $description ) {
		$this->add_action( 'after_setup_theme',
			function() use ( $location, $description ) {
				register_nav_menu( $location, $description );
			}
		);

		return $this;
	}

	/**
	 * Remove a navigation menu
	 * 
	 * @param string $location The menu location identifier.
	 */
	public function unregister_nav_menu( $location ) {
		$this->add_action(
			'after_setup_theme',
			function() use ( $location ) {
				unregister_nav_menu( $location );
			}
		);

		return $this;
	}
	
	/**
	 * Defines the global $content_width
	 * 
	 * @param int $width Maximum width of the content area excluding margin and padding.
	 */
	public function content_width( $width = 640 ) {
		$this->add_action( 'after_setup_theme',
			function() use ( $width ) {
				$GLOBALS['content_width'] = apply_filters( 'Fundamento_content_width', $width );
			},
			0
		);
	}

	/**
	 * Register a new widget
	 * 
	 * @param string|array $args Array or string of arguments for the sidebar being registered.
	 */
	public function widget( $args ) {
		$default_args = array(
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		);

		$args = array_merge( $default_args, $args );

		$this->add_action( 'widgets_init',
			function() use ( $args ) {
				register_sidebar( $args );
			}
		);
	}
}
