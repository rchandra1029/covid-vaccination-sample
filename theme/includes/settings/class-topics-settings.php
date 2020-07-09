<?php
/**
 * Configure the Topics settings page.
 *
 * @package CTCL\Elections
 * @since 1.0.0
 */

namespace CTCL\Elections;

/**
 * Topic Settings class.
 *
 * Implements the Topic settings page.
 */
class Topics_Settings extends Settings {

	const PAGE_TITLE  = 'Contact Form Topics';
	const FIELD_GROUP = 'topics_fields';

	/**
	 * Add Topics submenu page.
	 */
	public static function register_menu() {
		add_submenu_page( Settings::MENU_SLUG, 'Topics', 'Topics', 'edit_pages', 'topics', [ get_called_class(), 'page' ] );
	}

	/**
	 * Configure Topics settings.
	 */
	public static function register_settings() {
		add_settings_section(
			'topics_section',
			false,
			false,
			static::FIELD_GROUP
		);

		$fields = [
			[
				'uid'         => 'topic_list',
				'label'       => 'Topics',
				'section'     => 'topics_section',
				'type'        => 'multitext',
				'placeholder' => 'Lorem Ipsum',
				'label_for'   => 'topic_list',
				'args'        => [ 'sanitize_callback' => [ __CLASS__, 'sanitize_topic_list' ] ],
			],
		];

		self::configure_fields( $fields, static::FIELD_GROUP );
	}

	/**
	 * Format topic list: sanitize text and remove empty items.
	 *
	 * @param array $topics Topic list.
	 *
	 * @return array
	 */
	public static function sanitize_topic_list( $topics ) {
		return array_filter( array_map( 'sanitize_text_field', $topics ) );
	}
}

add_action( 'after_setup_theme', [ '\CTCL\Elections\Topics_Settings', 'hooks' ] );