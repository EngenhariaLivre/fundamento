<?php

namespace EngenhariaLivre;

class Theme {
	public function __construct() {
		$this->addSupport('title-tag')
			 ->addSupport('custom-logo')
			 ->addSupport('post-thumbnails')
			 ->addSupport('customize-selective-refresh-widgets')
			 ->addSupport('html5', [
				 'search-form',
				 'comment-form',
				 'comment-list',
				 'gallery',
				 'caption'
			 ])
			 ->addStyle('styles',  get_stylesheet_uri())
			 ->addCommentScript()
			 ->pingbackHeader();
	}

	private function addAction( $tag, $function_to_add, $priority = 10, $accepted_args = 1 ) {
		add_action(
			$tag,
			function() use ( $function_to_add ) {
				$function_to_add();
			},
			$priority,
			$accepted_args
		);
	}

	private function pingbackHeader() {
		$this->addAction( 'wp_head', function() {
			if ( is_singular() && pings_open() ) {
				printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
			}
		} );
	}

	public function addSupport( $feature, $options = null ) {
		$this->addAction( 'after_setup_theme', function() use ( $feature, $options ) {
			if ($options){
				add_theme_support( $feature, $options );
			} else {
				add_theme_support( $feature );
			}
		} );

		return $this;
	}

	public function removeSupport( $feature ) {
		$this->addAction( 'after_setup_theme', function() use ($feature){
			remove_theme_support( $feature );
		} );

		return $this;
	}

	public function loadTextDomain( $domain, $path = false ) {
		$this->addAction( 'after_setup_theme', function() use ( $domain, $path ){
			load_theme_textdomain( $domain, $path );
		} );
		return $this;
	}

	public function addImageSize( $name, $width = 0, $height = 0, $crop = false ) {
		$this->addAction( 'after_setup_theme', function() use ( $name, $width, $height, $crop ){
			add_image_size( $name, $width, $height, $crop );
		} );

		return $this;
	}

	public function removeImageSize( $name ) {
		$this->addAction( 'after_setup_theme', function() use ($name){
			remove_image_size( $name );
		} );

		return $this;
	}

	public function addStyle( $handle,  $src = '',  $deps = array(), $ver = false, $media = 'all' ) {
		$this->addAction( 'wp_enqueue_scripts', function() use ( $handle, $src, $deps, $ver, $media ){
			wp_enqueue_style( $handle,  $src,  $deps, $ver, $media );
		} );

		return $this;
	}

	public function addScript( $handle,  $src = '',  $deps = array(), $ver = false, $in_footer = false ) {
		$this->addAction( 'wp_enqueue_scripts', function() use ($handle, $src, $deps, $ver, $in_footer ){
			wp_enqueue_script( $handle,  $src,  $deps, $ver, $in_footer );
		} );

		return $this;
	}

	public function addCommentScript() {
		$this->addAction( 'wp_enqueue_scripts', function(){
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		} );

		return $this;
	}

	public function removeStyle( $handle ) {
		$this->addAction( 'wp_enqueue_scripts', function() use ( $handle ){
			wp_dequeue_style( $handle );
			wp_deregister_style( $handle ); 
		} );

		return $this;
	}

	public function removeScript( $handle ) {
		$this->addAction( 'wp_enqueue_scripts', function() use ($handle){
			wp_dequeue_script( $handle );
			wp_deregister_script( $handle );   
		} );

		return $this;
	}

	public function addNavMenus( $locations = array() ) {
		$this->addAction( 'after_setup_theme', function() use ($locations){
			register_nav_menus( $locations );
		} );

		return $this;
	}

	public function addNavMenu( $location, $description ) {
		$this->addAction( 'after_setup_theme', function() use ($location, $description){
			register_nav_menu( $location, $description );
		} );

		return $this;
	}

	public function removeNavMenu( $location ) {
		$this->addAction( 'after_setup_theme', function() use ($location){
			unregister_nav_menu( $location );
		} );

		return $this;
	}
	
	public function contentWidth( $width = 640 ) {
		$this->addAction( 'after_setup_theme', function() use ($width) {
			$GLOBALS['content_width'] = apply_filters( 'engenharia_livre_content_width', $width );
		}, 0 );
	}

	public function widget( $args ) {
		$default_args = [
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>'
		];

		$args = array_merge( $default_args, $args );

		$this->addAction( 'widgets_init', function() use ($args) {
			register_sidebar( $args );
		} );
	}
}