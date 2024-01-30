<?php
// ? silence is golden
// ? code is poetry

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}



class RegisterBlockStyles
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
		if (!isset(self::$instance) && !(self::$instance instanceof RegisterBlockStyles)) {

			self::$instance = new RegisterBlockStyles();
			self::$instance->includes();
		}

		// return new instance
		return self::$instance;
	}



	private function includes()
	{

		add_action('init', function () {

			// ... require_once template files here
			$block_styles = array(
				'core/columns' => array(
					'columns-reverse' => __('Reverse', 'frostcove'),
				),
				'core/group' => array(
					'shadow-light' => __('Shadow', 'frostcove'),
					'shadow-solid' => __('Solid', 'frostcove'),
				),
				'core/image' => array(
					'shadow-light' => __('Shadow', 'frostcove'),
					'shadow-solid' => __('Solid', 'frostcove'),
				),
				'core/list' => array(
					'no-disc' => __('No Disc', 'frostcove'),
				),
				'core/quote' => array(
					'shadow-light' => __('Shadow', 'frostcove'),
					'shadow-solid' => __('Solid', 'frostcove'),
				),
				'core/social-links' => array(
					'outline' => __('Outline', 'frostcove'),
				),
			);

			foreach ($block_styles as $block => $styles) {
				foreach ($styles as $style_name => $style_label) {
					register_block_style(
						$block,
						array(
							'name'  => $style_name,
							'label' => $style_label,
						)
					);
				}
			}
		});
	}
}

RegisterBlockStyles::instance();
