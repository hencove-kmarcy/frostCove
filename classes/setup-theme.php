<?php
// ? silence is golden
// ? code is poetry

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}



class SetupTheme
{

	/**
	 * Holds the instance.
	 */
	private static $instance;


	/**
	 * Init Main Instance.
	 *
	 * Insures that only one instance exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 */
	public static function instance()
	{

		// manage state to keep only one instace in memory
		if (!isset(self::$instance) && !(self::$instance instanceof SetupTheme)) {

			self::$instance = new SetupTheme();
			self::$instance->includes();
			self::$instance->enqueueStyles();
			self::$instance->enqueueScripts();
			// 
			// self::$instance->registerMenus();
			self::$instance->setThemeSupports();
		}

		// return new instance
		return self::$instance;
	}

	private function enqueueStyles()
	{
		// 
		add_action('wp_enqueue_scripts', function () {
			wp_register_style(
				'main',
				get_template_directory_uri() . '/_build/css/styles.css',
				array(),
				filemtime(get_template_directory() . '/_build/css/styles.css')
			);
			// 
			wp_enqueue_script('main');
		});
	}
	private function enqueueScripts()
	{
		add_action('wp_enqueue_scripts', function () {

			// 
			wp_register_script(
				'main',
				get_template_directory_uri() . '/_build/js/scripts.js',
				array('jquery'),
				filemtime(get_template_directory() . '/_build/js/scripts.js'),
				true
			);

			// 
			wp_enqueue_style('main');
		});
	}

	private function registerMenus()
	{
		add_action('after_setup_theme', function () {

			// This theme uses wp_nav_menu() in one location.
			register_nav_menus(
				array(
					'menu-1' => esc_html__('Primary', 'frostcove'),
				)
			);
		});
	}

	private function setThemeSupports()
	{
		add_action('after_setup_theme', function () {

			/**
			 * Make theme available for translation.
			 * Translations can be filed in the /languages/ directory.
			 */
			load_theme_textdomain('frostcove', get_template_directory() . '/languages');


			// Add default posts and comments RSS feed links to head.
			add_theme_support('automatic-feed-links');

			/**
			 * Let WordPress manage the document title.
			 * By adding theme support, we declare that this theme does not use a
			 * hard-coded <title> tag in the document head, and expect WordPress to
			 * provide it for us.
			 */
			add_theme_support('title-tag');

			/**
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
			 */
			add_theme_support('post-thumbnails');

			/**
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support(
				'html5',
				array(
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
					'style',
					'script',
				)
			);


			// Set up the WordPress core custom background feature.
			// add_theme_support(
			// 	'custom-background',
			// 	apply_filters(
			// 		'tabula-rasa_custom_background_args',
			// 		array(
			// 			'default-color' => 'ffffff',
			// 			'default-image' => '',
			// 		)
			// 	)
			// );


			/**
			 * Add support for core custom logo.
			 *
			 * @link https://codex.wordpress.org/Theme_Logo
			 */
			add_theme_support(
				'custom-logo',
				array(
					'height'      => 250,
					'width'       => 250,
					'flex-width'  => true,
					'flex-height' => true,
				)
			);


			add_filter('show_admin_bar', '__return_true');			// force showing the admin bar when logged in (front end)
			add_theme_support('body-open');								// enable wp_body_open filter
			add_post_type_support('page', 'excerpt');						// let pages have excerpts

			/**
			 * 
			 * 		Block Editor Filter / Supports
			 * 
			 */
			add_filter('should_load_remote_block_patterns', '__return_false');  // remove remote block patterns
			add_filter('should_load_separate_core_block_assets', '__return_true');    // enable / enforce loading separate block stylesheets
			add_theme_support('disable-custom-font-sizes');        // disable wp core custom font sizes
			add_theme_support('disable-custom-colors');            // disable wp core custom colors
			add_theme_support('disable-custom-gradients');        // disable wp core custom gradients
			add_theme_support('align-wide');                      // enable wide alignment for blocks
			add_theme_support('custom-spacing');                  // opt-in to letting blocks set padding
			add_theme_support('editor-gradient-presets', []); // remove the preset gradients in wp core
			add_theme_support('editor-styles');
			remove_theme_support('core-block-patterns');           // remove the "patterns" library
			/**
			 * register our editor stylesheet
			 */
			add_editor_style(get_template_directory_uri() . '/_build/css/editor-styles.css');
		});
	}


	private function includes()
	{

		// ... require_once template files here
		require_once(get_template_directory() . '/functions/utility.php');
		require_once(get_template_directory() . '/functions/apply-filters.php');
		require_once(get_template_directory() . '/functions/acf-blocks.php');
	}
}

SetupTheme::instance();
