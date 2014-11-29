<?php
/**
 * CMB Theme Options
 * @version 0.1.0
 */
 	
/*
Create Plugin Link in the Toolbar
*************************************/	
add_action( 'admin_bar_menu', 'toolbar_link_to_cmb_options', 999 );
function toolbar_link_to_cmb_options( $wp_admin_bar ) {
	global $default1; 
	$args = array(
		'id'    => $default1['pluginId'],
		'title' => $default1['pluginTitle'],
		'href'  => admin_url('admin.php?page=' .$default1['pluginSlug']),
		'meta'  => array( 'class' => 'my-toolbar-page' )
	);
	$wp_admin_bar->add_node( $args );
}


add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'metabox/init.php';

}

class myprefix_Admin {

    /**
     * Option key, and option page slug
     * @var string
     */
    private $key = 'pawslastpage-options.php';

    /**
     * Array of metaboxes/fields
     * @var array
     */
    protected $option_metabox = array();

    /**
     * Options Page title
     * @var string
     */
    protected $title = 'PawsLastPage Options';

    /**
     * Options Page hook
     * @var string
     */
    protected $options_page = 'pawslastpage-options.php';

    /**
     * Constructor
     * @since 0.1.0
     */
    public function __construct() {
		// Set our title
        $this->title = __( 'PawsLastPage', 'myprefix' );
    }

    /**
     * Initiate our hooks
     * @since 0.1.0
     */
    public function hooks() {
        add_action( 'admin_init', array( $this, 'init' ) );
        add_action( 'admin_menu', array( $this, 'add_options_page' ) );
    }

    /**
     * Register our setting to WP
     * @since  0.1.0
     */
    public function init() {
        register_setting( $this->key, $this->key );
    }

    /**
     * Add menu options page
     * @since 0.1.0
     */
    public function add_options_page() {
        $this->options_page = add_menu_page( $this->title, $this->title, 'manage_options', $this->key, array( $this, 'admin_page_display' ) );
    }

    /**
     * Admin page markup. Mostly handled by CMB
     * @since  0.1.0
     */
    public function admin_page_display() {
        ?>
        <div class="wrap cmb_options_page <?php echo $this->key; ?>">
            <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
            <?php cmb_metabox_form( self::option_fields(), $this->key ); ?>
        </div>
        <?php
    }

    /**
     * Defines the theme option metabox and field configuration
     * @since  0.1.0
     * @return array
     */
    public function option_fields() {

        // Only need to initiate the array once per page-load
        if ( ! empty( $this->option_metabox ) ) {
            return $this->option_metabox;
        }

        $this->fields = array(
            array(
                'name' => __( 'HTML Input', 'myprefix' ),
                'desc' => __( 'Place the HTML here.', 'myprefix' ),
                'id'   => 'html_input',
                'type' => 'textarea',
            ),
        );

        $this->option_metabox = array(
            'id'         => 'option_metabox',
            'show_on'    => array( 'key' => 'pawslastpage', 'value' => array( $this->key, ), ),
            'show_names' => true,
            'fields'     => $this->fields,
        );

        return $this->option_metabox;
    }

    /**
     * Public getter method for retrieving protected/private variables
     * @since  0.1.0
     * @param  string  $field Field to retrieve
     * @return mixed          Field value or exception is thrown
     */
    public function __get( $field ) {

        // Allowed fields to retrieve
        if ( in_array( $field, array( 'key', 'fields', 'title', 'options_page' ), true ) ) {
            return $this->{$field};
        }
        if ( 'option_metabox' === $field ) {
            return $this->option_fields();
        }

        throw new Exception( 'Invalid property: ' . $field );
    }

}

// Get it started
$myprefix_Admin = new myprefix_Admin();
$myprefix_Admin->hooks();

/**
 * Wrapper function around cmb_get_option
 * @since  0.1.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function myprefix_get_option( $key = '' ) {
    global $myprefix_Admin;
    return cmb_get_option( $myprefix_Admin->key, $key );
}