<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       codewithbanji.com
 * @since      1.0.0
 *
 * @package    Select_All_Posts
 * @subpackage Select_All_Posts/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Select_All_Posts
 * @subpackage Select_All_Posts/admin
 * @author     CodeWithBanji <banji@codewithbanji.com>
 */
class Select_All_Posts_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function set_up_post_table_scripts($screen){
		$start_string = "edit-";
		$string = $screen->id;
		$len = strlen($start_string); 
    	if(substr($string, 0, $len) === $start_string){
			$this->enqueue_scripts();
		}
	}

	public function filter_posts_per_page($ppp){
		return -1;
	}

	public function select_all(){
		if(isset($_REQUEST['cwb-apply-on-everything']) && $_REQUEST['cwb-apply-on-everything']=="on"){

			global $wp_query;
			add_filter("edit_posts_per_page", [$this, "filter_posts_per_page"]);
			wp_edit_posts_query();
			$posts = $wp_query->posts;
			$ret = [];
			foreach($posts as $post){
				
				$ret[] = is_int($post) ? $post : $post->ID;
			}
			remove_filter("edit_posts_per_page", [$this, "filter_posts_per_page"]);
			$_REQUEST['post'] = $ret;
		}
	}


	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Select_All_Posts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Select_All_Posts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/select-all-posts-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Select_All_Posts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Select_All_Posts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/select-all-posts-admin.js', array( 'jquery' ), $this->version, false );

	}

}
