<?php
/**
 * Admin core class
 */


// Prevent direct call
if ( !defined( 'WPINC' ) ) die;
if ( !class_exists( 'GW_GoPricing_Clip' ) ) die;	


// Class
class GW_GoPricing_Clip_Admin {	

	protected static $instance = null;
	protected static $screen_hooks = null;
	
	protected static $plugin_version;
	protected static $db_version;
	protected static $plugin_prefix;
	protected static $plugin_slug;
	protected $plugin_file;
	protected $plugin_base;
	protected $plugin_dir;
	protected $plugin_path;
	protected $plugin_url;
	protected $admin_path;
	protected $admin_url;
	protected $includes_path;
	protected $includes_url;
	protected $views_path;
	protected $globals;


	/**
	 * Initialize the class
	 *
	 * @return object
	 */		  
	
	public function __construct( $globals ) {
		
		self::$plugin_version = $globals['plugin_version'];
		self::$db_version = $globals['db_version'];		
		self::$plugin_prefix = $globals['plugin_prefix'];
		self::$plugin_slug = $globals['plugin_slug'];
		$this->plugin_file = $globals['plugin_file'];		
		$this->plugin_base = $globals['plugin_base'];
		$this->plugin_dir = $globals['plugin_dir'];
		$this->plugin_path = $globals['plugin_path'];
		$this->plugin_url =	$globals['plugin_url'];
		$this->globals = $globals;

		// Enqueue admin styles
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		
		// Enqueue admin scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		
		// Localization
		add_action( 'admin_enqueue_scripts', array( $this, 'localization' ) );		
		
		// Get core plugin screens
		add_filter( 'go_pricing_add_screen' , array( $this, 'screen_hooks' ) );
		
		// HTML content of clipboard and controls 
		add_action( 'go_pricing_editor_popup_content_before_html', array( $this, 'editor_popup_clipboard_html' ) );
		add_action( 'go_pricing_colum_editor_content_before_html', array( $this, 'clipboard_html' ) );
		add_action( 'go_pricing_colum_editor_nav_html', array( $this, 'clipboard_nav_html' ) );	// New in 2.0
		add_action( 'go_pricing_colum_assets_html', array( $this, 'column_clipboard_assets_html' ) );	
		add_action( 'go_pricing_colum_new_assets_html', array( $this, 'column_new_clipboard_assets_html' ) );			
		
	}
		
	
	/**
	 * Return an instance of this class
	 *
	 * @return object | bool
	 */
	 
	public static function instance( $globals ) {
		
		if ( empty( $globals ) ) return false;
		
		if ( self::$instance == null ) {
			self::$instance = new self ( $globals );
		}
		
		return self::$instance;
		
	}
	
	
	/**
	 * Enqueue admin styles
	 *
	 * @return void
	 */

	public function enqueue_admin_styles() {
		
		if ( empty( self::$screen_hooks ) ) return;
		
		$screen = get_current_screen();
		
		if ( array_key_exists( $screen->id, self::$screen_hooks ) ) {
			
			wp_enqueue_style( self::$plugin_slug . '-admin-styles', $this->plugin_url . 'assets/admin/css/clip_admin_styles.css', array(), self::$plugin_version );	
			
			// Backward compatibility
			if ( isset( $this->globals['core']['plugin_version'] ) && version_compare( $this->globals['core']['plugin_version'], '3.3.0', '<' ) ) wp_add_inline_style( self::$plugin_slug . '-admin-styles', '.go-pricing-col-new { margin-top:48px !important; }' );
				
		}

	}


	/**
	 * Enqueue admin scripts
	 *
	 * @return void
	 */

	public function enqueue_admin_scripts() {
		
		if ( empty( self::$screen_hooks ) ) return;
		
		global $wp_version;

		$screen = get_current_screen();
		
		if ( array_key_exists( $screen->id, self::$screen_hooks ) ) {

			wp_enqueue_script( 'jquery-ui-droppable' );
			wp_enqueue_script( self::$plugin_slug . '-admin-scripts', $this->plugin_url . 'assets/admin/js/clip_admin_scripts.js', 'jquery', self::$plugin_version );			
				
		}

	}

	
	/**
	 * Set translatable content
	 *
	 * @return void
	 */

	public function localization() {
		
		$translate = array(
			'confirm_item_delete' => __( 'Are you sure you want to delete the item?', 'go_pricing_clip_textdomain' ),
			'warning_maxitem' => __( 'You have reached the maximum number of items!', 'go_pricing_clip_textdomain' ),
			'title_close' => esc_attr( 'Close', 'go_pricing_clip_textdomain' ),
			'warning_nostorage' => __( 'Your browser doesn not support HTML Local Storage!', 'go_pricing_clip_textdomain' ),
		);			
		
		wp_localize_script( self::$plugin_slug . '-admin-scripts', 'GoPricingClipL10n', $translate );	
		
	}
	
	
	/**
	 * Get plugin screen hooks
	 *
	 * @return void
	 */	
	
	public function screen_hooks( $screens ) {
		
		self::$screen_hooks = $screens;
		return $screens;
		
	}	
	
	
	/**
	 * HTML content of column clipboard
	 *
	 * @return void
	 */
	 	
	public function clipboard_html( $data ) {
		
		ob_start();
		?>
		<div class="gwa-clipboard-wrap" data-clip-id="column">
			<div class="gwa-clipboard">
				<div class="gwa-clipboard-message"><i class="fa fa-info-circle"></i> <?php _e( 'Clipboard is empty!', 'go_pricing_clip_textdomain'); ?></div>
				<div class="gwa-clipboard-assets">
					<a href="#" title="<?php esc_attr_e( 'Delete All', 'go_pricing_clip_textdomain' ); ?>" data-confirm="<?php esc_attr_e( 'Are you sure you want to delete all items?', 'go_pricing_clip_textdomain' ); ?>" data-action="clipboard-delete" class="gwa-clipboard-delete"><span></span></a>
				</div>
				<a href="#" title="<?php esc_attr_e( 'Close', 'go_pricing_clip_textdomain' ); ?>" class="gwa-clipboard-close"></a>				
			</div>
		</div>
		<?php
		echo ob_get_clean();
		
	}


	/**
	 * HTML content of clipboard icon in column editor header
	 *
	 * @return void
	 */
	 	
	public function clipboard_nav_html( $data ) {
		
		ob_start();
		?>
		<a href="#" data-action="clipboard" title="<?php _e( 'Open / Close Clipboard', 'go_pricing_clip_textdomain' ); ?>" class="gwa-abox-header-nav-clip"><?php _e( 'Clip', 'go_pricing_clip_textdomain' ); ?></a>
		<?php
		echo ob_get_clean();
		
	}

	/**
	 * HTML content of popup clipboard
	 *
	 * @return void
	 */

	public function editor_popup_clipboard_html( $data ) {
		
		ob_start();
		?>
		<div class="gwa-clipboard-wrap"<?php echo isset( $data['_action_type'] ) ? sprintf( ' data-clip-id="%s"', esc_attr( $data['_action_type'] ) ) : ''; ?>>
			<div class="gwa-clipboard">
				<div class="gwa-clipboard-message"><i class="fa fa-info-circle"></i> <?php _e( 'Clipboard is empty!', 'go_pricing_clip_textdomain'); ?></div>
				<div class="gwa-clipboard-assets">
					<a href="#" title="<?php esc_attr_e( 'Delete All', 'go_pricing_clip_textdomain' ); ?>" data-confirm="<?php esc_attr_e( 'Are you sure you want to delete all items?', 'go_pricing_clip_textdomain' ); ?>"  data-action="clipboard-delete" class="gwa-clipboard-delete"><span></span></a>
				</div>
				<div class="gwa-clip-assets-nav"><a href="#" class="gwa-asset-icon-clipboard" data-action="clipboard" title="<?php esc_attr_e( 'Open / Close Clipboard', 'go_pricing_clip_textdomain' ); ?>"><span></span></a><a href="#" class="gwa-asset-icon-clipboard-add" data-action="clipboard-add" title="<?php esc_attr_e( 'Add to Clipboard', 'go_pricing_clip_textdomain' ); ?>"><span></span></a></div>
				<a href="#" title="<?php esc_attr_e( 'Close', 'go_pricing_clip_textdomain' ); ?>" class="gwa-clipboard-close"></a>
			</div>
		</div>
		<?php
		echo ob_get_clean();
		
	}
	

	/**
	 * HTML content of column clipboard controls
	 *
	 * @return void
	 */

	public function column_clipboard_assets_html( $data ) {
		
		ob_start();
		
		// New version
		if ( isset( $this->globals['core']['plugin_version'] ) && version_compare( $this->globals['core']['plugin_version'], '3.3.0', '>=' ) ) :
		?>
		<div class="gwa-col-assets-nav">
			<a href="#" class="gwa-asset-icon-clipboard-add" data-action="clipboard-add" title="<?php esc_attr_e( 'Add to Clipboard', 'go_pricing_clip_textdomain' ); ?>"><span></span></a>
		</div>
		<?php
		else :
		// Old version
		?>
		<div class="gwa-col-assets-nav">
			<a href="#" class="gwa-asset-icon-clipboard" data-action="clipboard" title="<?php esc_attr_e( 'Open / Close Clipboard', 'go_pricing_clip_textdomain' ); ?>"><span></span></a><a href="#" class="gwa-asset-icon-clipboard-add" data-action="clipboard-add" title="<?php esc_attr_e( 'Add to Clipboard', 'go_pricing_clip_textdomain' ); ?>"><span></span></a>
		</div>
		<?php
		endif;
		echo ob_get_clean();
		
	}
	

	/**
	 * HTML content of new column clipboard control
	 *
	 * @return void
	 */

	public function column_new_clipboard_assets_html( $data ) {
		
		// New version - hide it */
		if ( isset( $this->globals['core']['plugin_version'] ) && version_compare( $this->globals['core']['plugin_version'], '3.3.0', '>=' ) ) return;
					
		ob_start();
		?>
		<div class="gwa-col-assets-nav">
			<a href="#" class="gwa-asset-icon-clipboard" data-action="clipboard" title="<?php esc_attr_e( 'Open / Close Clipboard', 'go_pricing_clip_textdomain' ); ?>"><span></span></a>
		</div>
		<?php
		echo ob_get_clean();
		
	}		
	
}

?>