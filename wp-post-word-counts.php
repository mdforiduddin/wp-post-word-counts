<?php
/**
 * Plugin Name: WordPress Post Word Counts
 * Plugin URI: https://bdteamwork.com
 * Description: Counts the number of words in your WordPress post content
 * Version: 1.0.0
 * Author: Md Forid Uddin
 * Author URI: https://bdteamwork.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: 
 * Domain Path: /languages
 * 
 * @author mdforiduddin
 */

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Main plugin class
 *
 * @author   Md Forid Uddin
 */
final class WP_Post_Word_Counts {

    /**
     * Plugin version
     *
     * @var string
     */
    const version = '1.0.0';

    /**
     * Class Constructor
     */
    private function __construct() {

        $this->define_constants();

        register_activation_hook( __FILE__, [$this, 'activate'] );

        add_action( 'plugin_loaded', [$this, 'init_plugin'] );
    }

    /**
     * Initiatizes a singleton instance
     *
     * @return /WP_Post_Word_Counts
     */
    public static function init() {

        static $instance = false;

        if ( !$instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define the required plugin constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'WP_Post_Word_Counts_Version', self::version );
        define( 'WP_Post_Word_Counts_File', __FILE__ );
        define( 'WP_Post_Word_Counts_Path', __DIR__ );
        define( 'WP_Post_Word_Counts_Url', plugins_url( '', WP_Post_Word_Counts_File ) );
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin() {

        if ( is_admin() ) {
        } else {

            require WP_Post_Word_Counts_Path . '/includes/word-count.php';

            if ( class_exists( 'Word_Count' ) ) {
                new Word_Count();
            }
        }
    }

    /**
     * Plugin Activation Function
     *
     * @return void
     */
    public function activate() {
    }
}

/**
 * Initializes the main plugin
 *
 * @return /WP_Post_Word_Counts
 */
function WP_Post_Word_Counts() {

    return WP_Post_Word_Counts::init();
}

// kick-off the plugin
WP_Post_Word_Counts();
