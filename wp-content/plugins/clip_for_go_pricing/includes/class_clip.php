<?php
/**
 * Core class
 */


// Prevent direct call
if ( !defined( 'WPINC' ) ) die;

// Class
class GW_GoPricing_Clip {
	
	protected static $instance = null;
	protected $globals;	
	protected static $plugin_version = '2.0.0';
	protected static $db_version = '1.0.0';
	protected static $min_core_version = '3.1.1';	
	protected static $plugin_prefix = 'go_pricing_clip';
	protected static $plugin_slug = 'go-pricing-clip';	
	protected $plugin_file;
	protected static $plugin_base;
	protected $plugin_dir;
	protected $plugin_path;
	protected $plugin_url;

	
	/**
	 * Constructor of the class
	 *
	 * @return void
	 */		  
	 
	public function __construct( ) {
				
		// Load plugin text domain
		$this->load_plugin_textdomain();

	}

	
	/**
	 * Return an instance of this class
	 *
	 * @return array
	 */
	 
	
	public static function instance( $plugin_file = __FILE__ ) {
					
		static $globals;
		if ( self::$instance == null ) {
			self::$instance = new self;
			$globals = self::$instance->set_globals( $plugin_file );
			self::$instance->load_includes();
			self::$instance->register_addon();
			
		}
		
		return $globals;
		
	}
	
	 
	/**
	 * Fired when the plugin is activated 
	 *
	 * @return void
	 */			 
	 
	public static function activate( $network_wide ) {
	
		if ( class_exists( 'GW_GoPricing' ) ) $core_plugin = GW_GoPricing::instance();
		
		if ( !class_exists( 'GW_GoPricing' ) || version_compare( $core_plugin['plugin_version'], self::$min_core_version, '<' ) ) {
			
			update_option ( self::$plugin_prefix . '_activate_error', sprintf( __( 'Clip - Add-on for Go Pricing</strong> requires at least <strong>Go Pricing - WordPress Responsive Pricing Tables</strong> plugin version %s to run!', 'go_pricing_clip_textdomain' ), self::$min_core_version ) ); 
			
		}

	}


	/**
	 * Fired when the plugin is deactivated 
	 *
	 * @return void
	 */		 
	 
	public static function deactivate() {

	}	


	/**
	 * Fired when the plugin is uninstalled
	 *
	 * @return void
	 */			 
	 
	public static function uninstall( $network_wide ) {
		
		?>
		<script>if (typeof(Storage) !== 'undefined') localStorage.removeItem('go_pricing_clipboard');</script>
		<?php

	}
	
	
	/**
	 * Print activation error admin notices
	 */
	 	
	public static function activate_error() {

		$error_notice = get_option( self::$plugin_prefix . '_activate_error' );
		if ( $error_notice ) {
			printf( '<div id="message" class="error"><p><strong>%s</strong></p></div>', $error_notice );
			deactivate_plugins( self::$plugin_base );
			delete_option( self::$plugin_prefix . '_activate_error' );			
		}

	}		


	/**
	 * Set global variables
	 *
	 * @return array
	 */			 

	public function set_globals( $plugin_file ) {

		$this->plugin_file = $plugin_file;
		self::$plugin_base = plugin_basename( $this->plugin_file );
		$this->plugin_dir = dirname( plugin_basename( $this->plugin_file ) );
		$this->plugin_path = plugin_dir_path( $this->plugin_file );
		$this->plugin_url =	plugin_dir_url( $this->plugin_file );	

		$globals = array (
			'plugin_version' => self::$plugin_version,
			'db_version' => self::$db_version,
			'min_core_version' => self::$min_core_version,
			'plugin_prefix' => self::$plugin_prefix,
			'plugin_slug' => self::$plugin_slug,
			'plugin_file' => $this->plugin_file,
			'plugin_base' => self::$plugin_base,
			'plugin_dir' => $this->plugin_dir,
			'plugin_path' => $this->plugin_path,
			'plugin_url' => $this->plugin_url,
		);	
		
		if  ( $core_instance = $this->can_run() ) {
			$globals['core'] = $core_instance;
		} else {
			update_option ( self::$plugin_prefix . '_activate_error', sprintf( __( 'Clip - Add-on for Go Pricing</strong> requires at least <strong>Go Pricing - WordPress Responsive Pricing Tables</strong> plugin version %s to run!', 'go_pricing_clip_textdomain' ), self::$min_core_version ) ); 
		}
		
		$this->globals = $globals;		
		return $globals;
	
	}
	
	
	/**
	 * Load required includes
	 *
	 * @return void
	 */		
	
	public function load_includes() {
		
		if ( !isset( $this->globals['core'] ) ) return;

		// Include & init admin classes
		if ( is_admin() ) {
			
			//Include & init admin main class
			include_once ( $this->plugin_path . 'includes/admin/class_admin.php' );
			GW_GoPricing_Clip_Admin::instance( $this->globals );
			
		}
	
	}
	
	
	/**
	 * Detect if the plugin can run
	 *
	 * @return bool | array
	 */			 
	 
	public function can_run() {
		
		if ( class_exists( 'GW_GoPricing' ) ) {
			$core_instance = GW_GoPricing::instance();
			if ( version_compare( $core_instance['plugin_version'], self::$min_core_version, '>=' ) ) return $core_instance;			
		}

		return false;
		
	}	

	 
	/**
	 * Load the plugin text domain for translation
	 *
	 * @return void
	 */			 
	 
	public function load_plugin_textdomain() {

		load_plugin_textdomain( 'go_pricing_clip_textdomain', FALSE, $this->plugin_dir . '/lang/' );
	
	}
	
	/**
	 * Register addon
	 *
	 * @return void
	 */		
	
	public function register_addon() {

		if ( !class_exists( 'GW_GoPricing_Addon' ) ) return;

		GW_GoPricing_Addon::register(
			array(
				'id' => 'clip_addon',
				'name' => 'Clip - Add-on for Go Pricing',
				'slug' => 'gw-' . self::$plugin_slug,
				'base' => self::$plugin_base,
				'version' => self::$plugin_version,
			)
		);	
		
	}
		
}
