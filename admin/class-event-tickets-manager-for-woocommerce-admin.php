<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wpswings.com/
 * @since      1.0.0
 *
 * @package    Event_Tickets_Manager_For_Woocommerce
 * @subpackage Event_Tickets_Manager_For_Woocommerce/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Event_Tickets_Manager_For_Woocommerce
 * @subpackage Event_Tickets_Manager_For_Woocommerce/admin
 * @author     WPSwings <webmaster@wpswings.com>
 */
class Event_Tickets_Manager_For_Woocommerce_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 * @param    string $hook      The plugin page slug.
	 */
	public function etmfw_admin_enqueue_styles( $hook ) {
		$screen = get_current_screen();
		if ( isset( $screen->id ) && 'wp-swings_page_event_tickets_manager_for_woocommerce_menu' == $screen->id ) {
			wp_enqueue_style( 'thickbox' );
			wp_enqueue_style( 'wps-etmfw-select2-css', EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_URL . 'package/lib/select-2/event-tickets-manager-for-woocommerce-select2.css', array(), time(), 'all' );
			wp_enqueue_style( 'wps-etmfw-meterial-css', EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_URL . 'package/lib/material-design/material-components-web.min.css', array(), time(), 'all' );
			wp_enqueue_style( 'wps-etmfw-meterial-css2', EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_URL . 'package/lib/material-design/material-components-v5.0-web.min.css', array(), time(), 'all' );
			wp_enqueue_style( 'wps-etmfw-meterial-lite', EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_URL . 'package/lib/material-design/material-lite.min.css', array(), time(), 'all' );

			wp_enqueue_style( 'wps-etmfw-meterial-icons-css', EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_URL . 'package/lib/material-design/icon.css', array(), time(), 'all' );

			wp_enqueue_style( $this->plugin_name . '-admin-global', EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_URL . 'admin/src/scss/event-tickets-manager-for-woocommerce-admin-global.css', array( 'wps-etmfw-meterial-icons-css' ), time(), 'all' );

			wp_enqueue_style( $this->plugin_name, EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_URL . 'admin/src/scss/event-tickets-manager-for-woocommerce-admin.scss', array(), $this->version, 'all' );
		}
		if ( isset( $screen->id ) && ( 'product' == $screen->id || 'woocommerce_page_wps-etmfw-events-info' == $screen->id ) ) {
			// Date Time Picker Library.
			wp_enqueue_style( 'wps-etmfw-date-time-css', EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_URL . 'package/lib/datetimepicker-master/jquery.datetimepicker.css', array(), time(), 'all' );
			wp_enqueue_style( $this->plugin_name . '-admin-edit-product', EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_URL . 'admin/src/scss/event-tickets-manager-for-woocommerce-admin-edit-product.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 * @param    string $hook      The plugin page slug.
	 */
	public function etmfw_admin_enqueue_scripts( $hook ) {

		$screen = get_current_screen();
		if ( isset( $screen->id ) && 'wp-swings_page_event_tickets_manager_for_woocommerce_menu' == $screen->id ) {
			wp_enqueue_script( 'thickbox' );
			wp_enqueue_script( 'wps-etmfw-select2', EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_URL . 'package/lib/select-2/event-tickets-manager-for-woocommerce-select2.js', array( 'jquery' ), time(), false );

			wp_enqueue_script( 'wps-etmfw-metarial-js', EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_URL . 'package/lib/material-design/material-components-web.min.js', array(), time(), false );
			wp_enqueue_script( 'wps-etmfw-metarial-js2', EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_URL . 'package/lib/material-design/material-components-v5.0-web.min.js', array(), time(), false );
			wp_enqueue_script( 'wps-etmfw-metarial-lite', EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_URL . 'package/lib/material-design/material-lite.min.js', array(), time(), false );

			wp_register_script( $this->plugin_name . 'admin-js', EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_URL . 'admin/src/js/event-tickets-manager-for-woocommerce-admin.js', array( 'jquery', 'wps-etmfw-select2', 'wps-etmfw-metarial-js', 'wps-etmfw-metarial-js2', 'wps-etmfw-metarial-lite' ), $this->version, false );

			wp_localize_script(
				$this->plugin_name . 'admin-js',
				'etmfw_admin_param',
				array(
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
					'reloadurl' => admin_url( 'admin.php?page=event_tickets_manager_for_woocommerce_menu' ),
					'etmfw_gen_tab_enable' => get_option( 'wps_etmfw_radio_switch_demo' ),
				)
			);

			wp_enqueue_script( $this->plugin_name . 'admin-js' );
		}
		if ( isset( $screen->id ) && 'product' == $screen->id ) {
			// Date Time Picker Library.
			wp_enqueue_script( 'wps-etmfw-date-time', EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_URL . 'package/lib/datetimepicker-master/jquery.datetimepicker.full.js', array( 'jquery' ), time(), false );
			wp_register_script( $this->plugin_name . 'admin-edit-product-js', EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_URL . 'admin/src/js/event-tickets-manager-for-woocommerce-edit-product.js', array( 'jquery', 'wps-etmfw-date-time', 'jquery-ui-sortable' ), $this->version, false );

			wp_localize_script(
				$this->plugin_name . 'admin-edit-product-js',
				'etmfw_edit_prod_param',
				array(
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
					'wps_etmfw_edit_prod_nonce' => wp_create_nonce( 'wps-etmfw-verify-edit-prod-nonce' ),
				)
			);

			wp_enqueue_script( $this->plugin_name . 'admin-edit-product-js' );

		}
	}

	/**
	 * Adding settings menu for Event Tickets Manager for WooCommerce.
	 *
	 * @since    1.0.0
	 */
	public function etmfw_options_page() {
		global $submenu;
		if ( empty( $GLOBALS['admin_page_hooks']['wps-plugins'] ) ) {
			add_menu_page( 'WP Swings', 'WP Swings', 'manage_options', 'wps-plugins', array( $this, 'wps_plugins_listing_page' ), EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_URL . 'admin/src/images/wpswings_logo.png', 15 );
			$etmfw_menus = apply_filters( 'wps_add_plugins_menus_array', array() );
			if ( is_array( $etmfw_menus ) && ! empty( $etmfw_menus ) ) {
				foreach ( $etmfw_menus as $etmfw_key => $etmfw_value ) {
					add_submenu_page( 'wps-plugins', $etmfw_value['name'], $etmfw_value['name'], 'manage_options', $etmfw_value['menu_link'], array( $etmfw_value['instance'], $etmfw_value['function'] ) );
				}
			}
		}
	}

	/**
	 * Removing default submenu of parent menu in backend dashboard.
	 *
	 * @since   1.0.0
	 */
	public function wps_etmfw_remove_default_submenu() {
		global $submenu;
		if ( is_array( $submenu ) && array_key_exists( 'wps-plugins', $submenu ) ) {
			if ( isset( $submenu['wps-plugins'][0] ) ) {
				unset( $submenu['wps-plugins'][0] );
			}
		}
	}


	/**
	 * Event Tickets Manager for WooCommerce etmfw_admin_submenu_page.
	 *
	 * @since 1.0.0
	 * @param array $menus Marketplace menus.
	 */
	public function etmfw_admin_submenu_page( $menus = array() ) {
		$menus[] = array(
			'name'            => __( 'Event Tickets Manager for WooCommerce', 'event-tickets-manager-for-woocommerce' ),
			'slug'            => 'event_tickets_manager_for_woocommerce_menu',
			'menu_link'       => 'event_tickets_manager_for_woocommerce_menu',
			'instance'        => $this,
			'function'        => 'etmfw_options_menu_html',
		);
		return $menus;
	}


	/**
	 * Event Tickets Manager for WooCommerce wps_plugins_listing_page.
	 *
	 * @since 1.0.0
	 */
	public function wps_plugins_listing_page() {
		$active_marketplaces = apply_filters( 'wps_add_plugins_menus_array', array() );
		if ( is_array( $active_marketplaces ) && ! empty( $active_marketplaces ) ) {
			require EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_PATH . 'admin/partials/welcome.php';
		}
	}

	/**
	 * Event Tickets Manager for WooCommerce admin menu page.
	 *
	 * @since    1.0.0
	 */
	public function etmfw_options_menu_html() {

		include_once EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_PATH . 'admin/partials/event-tickets-manager-for-woocommerce-admin-dashboard.php';
	}


	/**
	 * Event Tickets Manager for WooCommerce general setting tab.
	 *
	 * @since    1.0.0
	 * @param array $etmfw_settings_general Settings fields.
	 */
	public function wps_etmfw_admin_general_settings_page( $etmfw_settings_general ) {

		$etmfw_settings_general = array(
			array(
				'title' => __( 'Enable / Disable', 'event-tickets-manager-for-woocommerce' ),
				'type'  => 'radio-switch',
				'description'  => __( 'Enable plugin to start the functionality.', 'event-tickets-manager-for-woocommerce' ),
				'id'    => 'wps_etmfw_enable_plugin',
				'value' => get_option( 'wps_etmfw_enable_plugin' ),
				'class' => 'etmfw-radio-switch-class',
				'options' => array(
					'yes' => __( 'YES', 'event-tickets-manager-for-woocommerce' ),
					'no' => __( 'NO', 'event-tickets-manager-for-woocommerce' ),
				),
			),

			array(
				'title' => __( 'Enable Event Location Site', 'event-tickets-manager-for-woocommerce' ),
				'type'  => 'radio-switch',
				'description'  => __( 'Enable this option to display event location on Google Map.', 'event-tickets-manager-for-woocommerce' ),
				'id'    => 'wps_etmfw_enabe_location_site',
				'value' => get_option( 'wps_etmfw_enabe_location_site' ),
				'class' => 'etmfw-radio-switch-class',
				'options' => array(
					'yes' => __( 'YES', 'event-tickets-manager-for-woocommerce' ),
					'no' => __( 'NO', 'event-tickets-manager-for-woocommerce' ),
				),
			),
		);
		$etmfw_settings_general = apply_filters( 'wps_etmfw_extent_general_settings_array', $etmfw_settings_general );
		$etmfw_settings_general[] = array(
			'type'  => 'button',
			'id'    => 'wps_etmfw_save_general_settings',
			'button_text' => __( 'Save', 'event-tickets-manager-for-woocommerce' ),
			'class' => 'etmfw-button-class',
		);

		return $etmfw_settings_general;
	}

	/**
	 * Event Tickets Manager for WooCommerce  Integration Setting Tab.
	 *
	 * @since    1.0.0
	 * @param array $etmfw_settings_integrations Settings fields.
	 */
	public function wps_etmfw_admin_integration_settings_page( $etmfw_settings_integrations ) {
		$etmfw_settings_integrations = array(
			array(
				'title' => __( 'Google API Key', 'event-tickets-manager-for-woocommerce' ),
				'type'  => 'text',
				'description'  => __( 'To get your API key, visit <a target="_blank" href="http://www.gmapswidget.com/documentation/generate-google-maps-api-key/">here</a>, Make sure to enable <a target="_blank" href="https://console.cloud.google.com/apis/library">Maps JavaScript API</a> and <a target="_blank" href="https://console.cloud.google.com/apis/library">Geocoding API</a> in order to get Google Maps functionality.', 'event-tickets-manager-for-woocommerce' ),
				'id'    => 'wps_etmfw_google_maps_api_key',
				'value' => get_option( 'wps_etmfw_google_maps_api_key', '' ),
				'class' => 'etmfw-text-class',
				'placeholder' => __( 'Google API Key', 'event-tickets-manager-for-woocommerce' ),
			),
		);
		$etmfw_settings_integrations = apply_filters( 'wps_etmfw_extent_integration_settings_array', $etmfw_settings_integrations );
		$etmfw_settings_integrations[] = array(
			'type'  => 'button',
			'id'    => 'wps_etmfw_save_integrations_settings',
			'button_text' => __( 'Save', 'event-tickets-manager-for-woocommerce' ),
			'class' => 'etmfw-button-class',
		);

		return $etmfw_settings_integrations;
	}

	/**
	 * Event Tickets Manager for WooCommerce Email Template Setting Tab.
	 *
	 * @since    1.0.0
	 * @param array $etmfw_email_template_settings Settings fields.
	 */
	public function wps_etmfw_admin_email_template_settings_page( $etmfw_email_template_settings ) {
		$wps_etmfw_default_site_logo = get_option( 'wps_etmfw_mail_setting_upload_logo', '' );
		if ( isset( $wps_etmfw_default_site_logo ) && '' === $wps_etmfw_default_site_logo ) :
			if ( function_exists( 'the_custom_logo' ) ) {
				if ( has_custom_logo() ) {
					$site_logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
					$wps_etmfw_default_site_logo = $site_logo[0];
				}
			}
		endif;
		$etmfw_email_template_settings = array(
			array(
				'title' => __( 'Event Ticket Email Subject', 'event-tickets-manager-for-woocommerce' ),
				'type'  => 'text',
				'description'  => __( 'Email Subject to notify receiver about the event ticket received. Use [SITENAME] shortcode as the name of the site.', 'event-tickets-manager-for-woocommerce' ),
				'id'    => 'wps_etmfw_email_subject',
				'value' => get_option( 'wps_etmfw_email_subject', '' ),
				'class' => 'etmfw-text-class',
				'placeholder' => __( 'Email Subject', 'event-tickets-manager-for-woocommerce' ),
			),
			array(
				'title' => __( 'Email Body Content', 'event-tickets-manager-for-woocommerce' ),
				'type' => 'wp_editor',
				'description'  => __( 'Use [SITENAME] shortcode as the name of the site.', 'event-tickets-manager-for-woocommerce' ),
				'id' => 'wps_etmfw_email_body_content',
				'value' => get_option( 'wps_etmfw_email_body_content', '' ),
			),

			array(
				'title' => __( 'Upload Default Logo', 'event-tickets-manager-for-woocommerce' ),
				'type' => 'textWithButton',
				'id' => 'wps_etmfw_mail_setting_upload_logo',
				'custom_attribute' => array(
					array(
						'type' => 'text',
						'custom_attributes' => array( 'readonly' => 'readonly' ),
						'class' => 'etmfw-text-class',
						'id' => 'wps_etmfw_mail_setting_upload_logo',
						'value' => $wps_etmfw_default_site_logo,
					),
					array(
						'type'  => 'button',
						'id'    => 'wps_etmfw_mail_setting_upload_logo_button',
						'button_text' => __( 'Upload Logo', 'event-tickets-manager-for-woocommerce' ),
						'class' => 'etmfw-button-class',
					),
					array(
						'type' => 'paragraph',
						'id' => 'wps_etmfw_mail_setting_remove_logo',
						'imgId' => 'wps_etmfw_mail_setting_upload_image',
						'spanX' => 'wps_etmfw_mail_setting_remove_logo_span',
					),
				),
				'class' => 'wps_etmfw_mail_setting_upload_logo_box',
				'description' => __( 'Upload the image which is used as a logo on your Email Template.', 'event-tickets-manager-for-woocommerce' ),
			),
		);
		$etmfw_email_template_settings = apply_filters( 'wps_etmfw_extent_email_template_settings_array', $etmfw_email_template_settings );
		$etmfw_email_template_settings[] = array(
			'type'  => 'button',
			'id'    => 'wps_etmfw_save_email_template_settings',
			'button_text' => __( 'Save', 'event-tickets-manager-for-woocommerce' ),
			'class' => 'etmfw-button-class',
		);

		return $etmfw_email_template_settings;
	}


	/**
	 * Registering custom product type.
	 *
	 * @return void
	 */
	public function wps_wgc_register_event_ticket_manager_product_type() {
		require_once EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_PATH . 'includes/class-wc-product-event-ticket-manager.php';
	}

	/**
	 * Event Tickets Manager for WooCommerce save tab settings.
	 *
	 * @since 1.0.0
	 */
	public function wps_etmfw_admin_save_tab_settings() {

		global $etmfw_wps_etmfw_obj, $error_notice;
		$etmfw_post_check = false;

		if ( wp_doing_ajax() ) {
			return;
		}
		if ( ! isset( $_POST['wps_event_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wps_event_nonce'] ) ), 'wps_event_nonce' ) ) {
			return;
		}

		if ( isset( $_POST['wps_etmfw_save_general_settings'] ) ) {
			$etmfw_genaral_settings = apply_filters( 'wps_etmfw_general_settings_array', array() );
			$etmfw_post_check       = true;
		} elseif ( isset( $_POST['wps_etmfw_save_email_template_settings'] ) ) {
			$etmfw_genaral_settings = apply_filters( 'wps_etmfw_email_template_settings_array', array() );
			$etmfw_post_check       = true;
		} elseif ( isset( $_POST['wps_etmfw_save_integrations_settings'] ) ) {
			$etmfw_genaral_settings = apply_filters( 'wps_etmfw_integration_settings_array', array() );
			$etmfw_post_check       = true;
		}

		if ( $etmfw_post_check ) {

			$wps_etmfw_gen_flag = false;
			$etmfw_button_index = array_search( 'submit', array_column( $etmfw_genaral_settings, 'type' ) );
			if ( isset( $etmfw_button_index ) && ( null == $etmfw_button_index || '' == $etmfw_button_index ) ) {
				$etmfw_button_index = array_search( 'button', array_column( $etmfw_genaral_settings, 'type' ) );
			}
			if ( isset( $etmfw_button_index ) && '' !== $etmfw_button_index ) {
				unset( $etmfw_genaral_settings[ $etmfw_button_index ] );
				if ( is_array( $etmfw_genaral_settings ) && ! empty( $etmfw_genaral_settings ) ) {
					foreach ( $etmfw_genaral_settings as $etmfw_genaral_setting ) {
						if ( isset( $etmfw_genaral_setting['id'] ) && '' !== $etmfw_genaral_setting['id'] ) {
							if ( 'multi' === $etmfw_genaral_setting['type'] ) {
								$etmfw_general_settings_sub_arr = $etmfw_genaral_setting['value'];
								$settings_general_arr = array();
								foreach ( $etmfw_general_settings_sub_arr as $etmfw_genaral_sub_setting ) {
									if ( isset( $_POST[ $etmfw_genaral_sub_setting['id'] ] ) ) {
										$value                  = sanitize_text_field( wp_unslash( $_POST[ $etmfw_genaral_sub_setting['id'] ] ) );
										$settings_general_arr[] = $value;
									}
								}
								update_option( $etmfw_genaral_setting['id'], $settings_general_arr );
							} else {
								if ( isset( $_POST[ $etmfw_genaral_setting['id'] ] ) ) {
									update_option( $etmfw_genaral_setting['id'], is_array( $_POST[ $etmfw_genaral_setting['id'] ] ) ? map_deep( wp_unslash( $_POST[ $etmfw_genaral_setting['id'] ] ), 'sanitize_text_field' ) : wp_kses_post( wp_unslash( $_POST[ $etmfw_genaral_setting['id'] ] ) ) );
								} else {
									update_option( $etmfw_genaral_setting['id'], '' );
								}
							}
						} else {
							$wps_etmfw_gen_flag = true;
						}
					}
				}
				if ( $wps_etmfw_gen_flag ) {
					$wps_etmfw_error_text = esc_html__( 'Id of some field is missing', 'event-tickets-manager-for-woocommerce' );
						$etmfw_wps_etmfw_obj->wps_etmfw_plug_admin_notice( $wps_etmfw_error_text, 'error' );
				} else {
					$error_notice = false;
					do_action( 'wps_etmfw_save_admin_global_settings', $_POST );
				}
			}

			do_action( 'wps_etmfw_generate_access_token_unlimited_time' );

		}
	}

	/**
	 * Create a custom Product Type for Event Ticket Manager
	 *
	 * @since 1.0.0
	 * @name wps_etmfw_event_ticket_product()
	 * @param array $types product types.
	 * @return $types.
	 * @author WPSwings<ticket@wpswings.com>
	 * @link https://wpswings.com/
	 */
	public function wps_etmfw_event_ticket_product( $types ) {
		$wps_etmfw_enable = get_option( 'wps_etmfw_enable_plugin', false );
		if ( $wps_etmfw_enable ) {
			$types['event_ticket_manager'] = __( 'Events', 'event-tickets-manager-for-woocommerce' );
		}
		return $types;
	}

	/**
	 * Create a tab for Event Ticket Manager
	 *
	 * @since 1.0.0
	 * @name wps_etmfw_event_ticket_tab()
	 * @param array $tabs event tab.
	 * @return $tabs.
	 * @author WPSwings<ticket@wpswings.com>
	 * @link https://wpswings.com/
	 */
	public function wps_etmfw_event_ticket_tab( $tabs ) {
		if ( isset( $tabs ) && ! empty( $tabs ) ) {
			foreach ( $tabs as $key => $tab ) {
				if ( 'general' != $key && 'inventory' != $key ) {
					$tabs[ $key ]['class'][] = 'hide_if_event_ticket_manager';
				}
			}
		}

		$tabs['event_ticket'] = array(
			'label'   => __( 'Events', 'event-tickets-manager-for-woocommerce' ),
			'target'  => 'wps_etmfw_event_data',
			'priority' => 60,
			'class'   => array( 'show_if_event_ticket_manager' ),
		);
		return apply_filters( 'wps_etmfw_product_data_tabs', $tabs );
	}

	/**
	 * Create an event tab on product edit page.
	 *
	 * @since    1.0.0
	 */
	public function wps_etmfw_event_tab_content() {
		global $post;
		$product_id = $post->ID;
		if ( isset( $product_id ) ) {
			if ( ! current_user_can( 'edit_post', $product_id ) ) {
				return;
			}
		}

		$wps_etmfw_product_array = get_post_meta( $product_id, 'wps_etmfw_product_array', true );
		$wps_etmfw_field_data = isset( $wps_etmfw_product_array['wps_etmfw_field_data'] ) && ! empty( $wps_etmfw_product_array['wps_etmfw_field_data'] ) ? $wps_etmfw_product_array['wps_etmfw_field_data'] : array();

		?>
		<div id="wps_etmfw_event_data" class="panel woocommerce_options_panel">
			<?php
			woocommerce_wp_text_input(
				array(
					'id'            => 'etmfw_start_date_time',
					'wrapper_class' => 'show_if_event_ticket_manager',
					'label'         => __( 'Start Date/ Time', 'event-tickets-manager-for-woocommerce' ),
					'value'         => isset( $wps_etmfw_product_array['event_start_date_time'] ) ? $wps_etmfw_product_array['event_start_date_time'] : '',
					'custom_attributes' => array( 'required' => 'required' ),
					'desc_tip'    => true,
					'description' => __( 'Enter the date and time when the event will start.', 'event-tickets-manager-for-woocommerce' ),
				)
			);

			woocommerce_wp_text_input(
				array(
					'id'            => 'etmfw_end_date_time',
					'wrapper_class' => 'show_if_event_ticket_manager',
					'label'         => __( 'End Date/ Time', 'event-tickets-manager-for-woocommerce' ),
					'value'         => isset( $wps_etmfw_product_array['event_end_date_time'] ) ? $wps_etmfw_product_array['event_end_date_time'] : '',
					'custom_attributes' => array( 'required' => 'required' ),
					'desc_tip'    => true,
					'description' => __( 'Enter the date and time when the event will end.', 'event-tickets-manager-for-woocommerce' ),
				)
			);

			woocommerce_wp_text_input(
				array(
					'id'            => 'etmfw_event_venue',
					'wrapper_class' => 'show_if_event_ticket_manager',
					'label'         => __( 'Venue', 'event-tickets-manager-for-woocommerce' ),
					'value'         => isset( $wps_etmfw_product_array['etmfw_event_venue'] ) ? $wps_etmfw_product_array['etmfw_event_venue'] : '',
					'custom_attributes' => array( 'required' => 'required' ),
					'desc_tip'    => true,
					'description' => __( 'Enter the accurate full address of event where it will be held to get best google result. Ex: Dharmapuri, Forest Colony, Tajganj, Agra, Uttar Pradesh 282001, India', 'event-tickets-manager-for-woocommerce' ),
				)
			);

			require_once EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_PATH . 'templates/backend/event-tickets-manager-for-woocommerce-api-loader.php';

			woocommerce_wp_text_input(
				array(
					'id'            => 'etmfw_event_venue_lat',
					'wrapper_class' => 'show_if_event_ticket_manager',
					'label'         => __( 'Location Latitude', 'event-tickets-manager-for-woocommerce' ),
					'value'         => isset( $wps_etmfw_product_array['etmfw_event_venue_lat'] ) ? $wps_etmfw_product_array['etmfw_event_venue_lat'] : '',
					'custom_attributes' => array( 'readonly' => 'readonly' ),
					'desc_tip'    => true,
					'description' => __( 'Latitude of the event geographic location.', 'event-tickets-manager-for-woocommerce' ),
				)
			);

			woocommerce_wp_text_input(
				array(
					'id'            => 'etmfw_event_venue_lng',
					'wrapper_class' => 'show_if_event_ticket_manager',
					'label'         => __( 'Location Longitude', 'event-tickets-manager-for-woocommerce' ),
					'value'         => isset( $wps_etmfw_product_array['etmfw_event_venue_lng'] ) ? $wps_etmfw_product_array['etmfw_event_venue_lng'] : '',
					'custom_attributes' => array( 'readonly' => 'readonly' ),
					'desc_tip'    => true,
					'description' => __( 'Longitude of the event geographic location ', 'event-tickets-manager-for-woocommerce' ),
				)
			);

			if ( 'on' === get_option( 'wps_etmfw_enabe_location_site', 'off' ) ) {
				woocommerce_wp_checkbox(
					array(
						'id' => 'etmfw_display_map',
						'wrapper_class' => 'show_if_event_ticket_manager',
						'label' => __( 'Display event on google map', 'event-tickets-manager-for-woocommerce' ),
						'value' => isset( $wps_etmfw_product_array['etmfw_display_map'] ) ? $wps_etmfw_product_array['etmfw_display_map'] : true,
					)
				);

			}
			do_action( 'wps_etmfw_edit_product_settings', $product_id );
			require_once EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_PATH . 'templates/backend/event-tickets-manager-for-woocommerce-add-ticket-dynamic-fields.php';

			wp_nonce_field( 'wps_etmfw_lite_nonce', 'wps_etmfw_product_nonce_field' );
			do_action( 'wps_etmfw_event_type_field', $product_id );
	}

	/**
	 * Save all the setting on product edit page for a particular product.
	 *
	 * @since    1.0.0
	 */
	public function wps_etmfw_save_product_data() {
		global $post;
		if ( isset( $post->ID ) ) {
			if ( ! current_user_can( 'edit_post', $post->ID ) ) {
				return;
			}
			$product_id = $post->ID;
			$product = wc_get_product( $product_id );
			if ( isset( $product ) && is_object( $product ) ) {
				if ( $product->get_type() == 'event_ticket_manager' ) {
					if ( ! isset( $_POST['wps_etmfw_product_nonce_field'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wps_etmfw_product_nonce_field'] ) ), 'wps_etmfw_lite_nonce' ) ) {
						return;
					}
					$wps_etmfw_product_array = array();
					$wps_etmfw_product_array['event_start_date_time'] = isset( $_POST['etmfw_start_date_time'] ) ? sanitize_text_field( wp_unslash( $_POST['etmfw_start_date_time'] ) ) : '';
					$wps_etmfw_product_array['event_end_date_time'] = isset( $_POST['etmfw_end_date_time'] ) ? sanitize_text_field( wp_unslash( $_POST['etmfw_end_date_time'] ) ) : '';
					$event_venue = isset( $_POST['etmfw_event_venue'] ) ? sanitize_text_field( wp_unslash( $_POST['etmfw_event_venue'] ) ) : '';
					$event_lat = isset( $_POST['etmfw_event_venue_lat'] ) ? sanitize_text_field( wp_unslash( $_POST['etmfw_event_venue_lat'] ) ) : '';
					$event_lng = isset( $_POST['etmfw_event_venue_lng'] ) ? sanitize_text_field( wp_unslash( $_POST['etmfw_event_venue_lng'] ) ) : '';
					$wps_etmfw_product_array['etmfw_event_venue'] = $event_venue;
					$wps_etmfw_product_array['etmfw_event_venue_lat'] = $event_lat;
					$wps_etmfw_product_array['etmfw_event_venue_lng'] = $event_lng;
					$wps_etmfw_field_data = ! empty( $_POST['etmfw_fields'] ) ? map_deep( wp_unslash( $_POST['etmfw_fields'] ), 'sanitize_text_field' ) : array();
					$wps_etmfw_field_data_array = array();
					if ( is_array( $wps_etmfw_field_data ) && ! empty( $wps_etmfw_field_data ) ) {
						if ( '' !== $wps_etmfw_field_data[0]['_label'] ) {
							foreach ( $wps_etmfw_field_data as $key => $value ) {
								$wps_etmfw_field_data_array[] = array(
									'label' => $value['_label'],
									'type' => $value['_type'],
									'required' => isset( $value['_required'] ) ? $value['_required'] : 'off',
								);
							}
						}
					}
					$wps_etmfw_product_array['wps_etmfw_field_data'] = $wps_etmfw_field_data_array;
					$etmfw_display_map = isset( $_POST['etmfw_display_map'] ) ? sanitize_text_field( wp_unslash( $_POST['etmfw_display_map'] ) ) : 'no';
					$wps_etmfw_product_array['etmfw_display_map'] = $etmfw_display_map;
					$wps_etmfw_product_array = apply_filters( 'wps_etmfw_product_pricing', $wps_etmfw_product_array, $_POST );
					update_post_meta( $product_id, 'wps_etmfw_product_array', $wps_etmfw_product_array );
					do_action( 'wps_etmfw_event_product_type_save_fields', $product_id );

					do_action( 'wps_etmfw_share_event_on_fb', $product_id );
				}
			}
		}
	}

	/**
	 *  Return array of all the possible fields to get user additional information.
	 *
	 * @since    1.0.0
	 * @return array $field_array.
	 */
	public function wps_etmfw_event_fields() {
		$field_array = array(
			'text'      => __( 'Text', 'event-tickets-manager-for-woocommerce' ),
			'textarea'  => __( 'Textarea', 'event-tickets-manager-for-woocommerce' ),
			'email'     => __( 'Email', 'event-tickets-manager-for-woocommerce' ),
			'number'    => __( 'Number', 'event-tickets-manager-for-woocommerce' ),
			'date'      => __( 'Date', 'event-tickets-manager-for-woocommerce' ),
			'yes-no'    => __( 'Yes/No', 'event-tickets-manager-for-woocommerce' ),
		);
		return apply_filters( 'wps_etmfw_extend_event_fields', $field_array );
	}


	/**
	 * Add a events submenu inside the Woocommerce Menu Page
	 *
	 * @since 1.0.0
	 * @name wps_etmfw_event_menu()
	 * @author WPSwings<webmaster@wpswings.com>
	 * @link https://wpswings.com/
	 */
	public function wps_etmfw_event_menu() {
		add_submenu_page( 'woocommerce', __( 'Events', 'event-tickets-manager-for-woocommerce' ), __( 'Events', 'event-tickets-manager-for-woocommerce' ), 'manage_options', 'wps-etmfw-events-info', array( $this, 'wps_etmfw_display_event_info' ) );
		do_action( 'wps_etmfw_admin_sub_menu' );
	}

	/**
	 * Display events information on events panel.
	 *
	 * @since    1.0.0
	 */
	public function wps_etmfw_display_event_info() {
		require_once EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_PATH . 'admin/partials/class-event-tickets-manager-for-woocommerce-events-info.php';
		?>
		<div class="wps_etmfw_event_display_wrapper">
			<h1><?php echo esc_html( 'Events', 'event-tickets-manager-for-woocommerce' ); ?></h1>
			<form method="post">
				<?php
				do_action( 'wps_etmfw_support_csv' );
				$current_page = isset( $_REQUEST['page'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['page'] ) ) : '';
				?>
				<input type="hidden" name="page" value="<?php echo esc_attr( $current_page ); ?>">
				<?php
				wp_nonce_field( 'wps-etmfw-events', 'wps-etmfw-events' );
				$mylisttable = new Event_Tickets_Manager_For_Woocommerce_Events_Info();
				$mylisttable->prepare_items();
				$mylisttable->search_box( __( 'Search ', 'event-tickets-manager-for-woocommerce' ), 'wps-etmfw-events' );
				$mylisttable->display();
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Display tickets on order item meta.
	 *
	 * @param string $item_id Event Item Id.
	 * @param object $item Event Order Item.
	 * @param object $_product Product Object.
	 * @since    1.0.0
	 */
	public function wps_etmfw_after_order_itemmeta( $item_id, $item, $_product ) {
		if ( ! current_user_can( 'edit_shop_orders' ) ) {
			return;
		}
		$wps_etmfw_enable = get_option( 'wps_etmfw_enable_plugin', false );
		if ( $wps_etmfw_enable ) {
			if ( isset( $_GET['post'] ) ) {
				$order_id = sanitize_text_field( wp_unslash( $_GET['post'] ) );
				$order = new WC_Order( $order_id );
				$order_status = $order->get_status();
				if ( 'completed' == $order_status ) {
					if ( null != $_product ) {
						$product_id = $_product->get_id();
						if ( isset( $product_id ) && ! empty( $product_id ) ) {
							$product_types = wp_get_object_terms( $product_id, 'product_type' );

							if ( isset( $product_types[0] ) ) {
								$product_type = $product_types[0]->slug;
								if ( 'event_ticket_manager' == $product_type ) {
									$ticket = get_post_meta( $order_id, "event_ticket#$order_id#$item_id", true );
									if ( is_array( $ticket ) && ! empty( $ticket ) ) {
										$length = count( $ticket );
										for ( $i = 0;$i < $length;$i++ ) {
											// Inline Style used for ticket infrormation.
											?>

										<p style="margin:0;"><b>
											<?php
											esc_html_e( 'Ticket ', 'event-tickets-manager-for-woocommerce' );
											echo esc_html( $i + 1 );
											?>
										 :</b>
											<span style="background: rgb(0, 115, 170) none repeat scroll 0% 0%; color: white; padding: 1px 5px 1px 6px; font-weight: bolder; margin-left: 10px;"><?php echo esc_attr( $ticket[ $i ] ); ?></span>
										</p>
											<?php
										}
									} else {

										if ( isset( $ticket ) && ! empty( $ticket ) ) {
											// Inline Style used for ticket infrormation.
											?>
											<p style="margin:0;"><b><?php esc_html_e( 'Ticket', 'event-tickets-manager-for-woocommerce' ); ?> :</b>
												<span style="background: rgb(0, 115, 170) none repeat scroll 0% 0%; color: white; padding: 1px 5px 1px 6px; font-weight: bolder; margin-left: 10px;"><?php echo esc_attr( $ticket ); ?></span>
											</p>
											<?php
										}
									}
									do_action( 'wps_etmfw_after_order_itemmeta', $item_id, $item, $_product );
								}
							}
						}
					}
				}
			}
		}
	}

	/**
	 * This is used to add row meta on plugin activation.
	 *
	 * @since 1.0.0
	 * @name wps_etmfw_plugin_row_meta
	 * @author WPSwings<ticket@wpswings.com>
	 * @param mixed $links Contains links.
	 * @param mixed $file Contains main file.
	 * @link https://wpswings.com/
	 */
	public function wps_etmfw_plugin_row_meta( $links, $file ) {
		if ( strpos( $file, 'event-tickets-manager-for-woocommerce/event-tickets-manager-for-woocommerce.php' ) !== false ) {
			$new_links = array(
				'demo' => '<a href="https://demo.wpswings.com/event-tickets-manager-for-woocommerce/?utm_source=wpswings-events-demo&utm_medium=events-org-backend&utm_campaign=demo" target="_blank"><img src="' . EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_URL . 'admin/src/images/demo_img.svg" style="width: 20px;padding-right: 5px;">Demo</a>',
				'documentation' => '<a href="https://docs.wpswings.com/event-tickets-manager-for-woocommerce/?utm_source=wpswings-events-doc&utm_medium=events-org-backend&utm_campaign=documentation" target="_blank"><img src="' . EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_URL . 'admin/src/images/Documentation.svg" style="width: 20px;padding-right: 5px;">Documentation</a>',
				'support' => '<a href="https://wpswings.com/submit-query/?utm_source=wpswings-events-support&utm_medium=events-org-backend&utm_campaign=support" target="_blank"><img src="' . EVENT_TICKETS_MANAGER_FOR_WOOCOMMERCE_DIR_URL . 'admin/src/images/Support.svg" style="width: 20px;padding-right: 5px;">Support</a>',
			);

			$links = array_merge( $links, $new_links );
		}
		return $links;
	}

	/**
	 * Get latitude and longitude of the event location.
	 *
	 * @since 1.0.0
	 * @name wps_etmfw_get_event_geocode_value
	 * @author WPSwings<ticket@wpswings.com>
	 * @link https://wpswings.com/
	 */
	public function wps_etmfw_get_event_geocode_value() {
		$response['result'] = false;
		$response['message'] = '';
		if ( ! isset( $_POST['wps_edit_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wps_edit_nonce'] ) ), 'wps-etmfw-verify-edit-prod-nonce' ) ) {
			return;
		}

		$api_key = get_option( 'wps_etmfw_google_maps_api_key', '' );
		$event_venue = isset( $_POST['venue'] ) ? sanitize_text_field( wp_unslash( $_POST['venue'] ) ) : '';
		if ( '' !== $api_key && '' !== $event_venue ) {
			$url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $event_venue . '&key=' . $api_key;
			$args = array(
				'timeout' => 10,
				'headers' => array(
					'Content-Type' => 'application/json; charset=utf-8',
				),
			);
			$get_response = wp_remote_get( $url, $args );
			if ( is_wp_error( $get_response ) ) {
				$response['message'] = $get_response->get_error_message();
			} else {
				$get_response = json_decode( wp_remote_retrieve_body( $get_response ) );
				if ( 'OK' == $get_response->status ) {
					$response['result'] = true;
					$response['message'] = array(
						'lat' => $get_response->results[0]->geometry->location->lat,
						'lng' => $get_response->results[0]->geometry->location->lng,
					);
				} else {
					$response['message'] = $get_response->error_message;
				}
			}
		} else {
			$response['message'] = sprintf(
				/* translators: %s: Google API key setting link */
				esc_html__( 'Please add Google API key %s to display event location on google map.', 'event-tickets-manager-for-woocommerce' ),
				'<a href="' . admin_url( 'admin.php?page=event_tickets_manager_for_woocommerce_menu&etmfw_tab=event-tickets-manager-for-woocommerce-integrations' ) . '" target="_blank">here</a>'
			);
		}
		echo json_encode( $response );
		wp_die();
	}
}
