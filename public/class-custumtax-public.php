<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http:localhost
 * @since      1.0.0
 *
 * @package    Custumtax
 * @subpackage Custumtax/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Custumtax
 * @subpackage Custumtax/public
 * @author     KASSA Célia <celiakassa9@gmail.com>
 */
class Custumtax_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Custumtax_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custumtax_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/custumtax-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Custumtax_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custumtax_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugins_url('/', __FILE__ ) . '/js/custumtax-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( "ajax", plugins_url('/', __FILE__ ) . '/js/Ajax.js', array( 'jquery' ), $this->version, false );
		wp_localize_script($this->plugin_name, 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	}

	function frontend()  {
		?>
 	    <div id="primary" class="content-area" ><h1>Enregistrement de séries </h1> </div>
 	    <div id="reponse" class="content-area"><h4></h4></div>

        <form name="creat_applicant" method="post" id="creat_applicant" enctype="multipart/form-data">   
	        <div class="form-group"><label for="title" >Title</label>
	        <input type="text" class="form-control" id="title" required  name="title"></div>
	        <div class="form-group"><label for="Annee"   >Années de Parrution</label>
	        <input type="text" class="form-control" id="Annee" required  name="Annee"></div>
	        <div class="form-group"><label for="realisateur"   >Réalisateurs</label>
	        <input type="text" class="form-control" required  name="realisateur"></div>
	        <div class="form-group"><label for="pwd">Description:</label><textarea class="form-control" name="description"></textarea> </div>
	        <div class="form-group">
	        <input type="file" class="form-control" id="thumbnail" name="image">
	        </div>
	        <Br> <input type="submit" class="btn btn-default" value="Send"/></Br>
        </form>
        
<?php
        //return $html;
    }

    function register_shortcodes(){

        add_shortcode( 'FrontEnd', array($this, 'frontend'));

    }
    
    function monpost( )
    {
    	 
    	$data = array(); 
    	$celia=$_POST['data'];
    	foreach ($_POST['data'] as $key => $value) {
    	 	$data[$value['name']] = $value['value'];
    	} 

    	if(isset($data['title'])){ 
             $my_post = array(
             'post_type' => 'seriestv',
             'post_title' =>$data['title'],
             'post_content' =>$data['description'],
             'tax_input'=>array(
         	 "annees" =>$data['Annee'],
         	'realisateurs' =>$data['realisateur'],
             ),
             'post_status' =>'publish',  
          );
            $post_id = wp_insert_post($my_post);
             var_dump($post_id);
             die();
            /*if (!function_exists('wp_generate_attachment_metadata')) {
              require_once (ABSPATH. "wp-admin" ."/includes / image.php" );
              require_once(ABSPATH . "wp-admin" . '/includes/file.php');
              require_once(ABSPATH . "wp-admin" . '/includes/media.php');
            }
             if ( $_FILES) {
         	     foreach($_FILES as $file => $array){
  		             if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
  			             return "upload error :" . $_FILES[$file]['error'];
  		             }
  		             $attach_id= media_handle_upload( $file, $post_id );
  		             echo wp_get_attachment_url($attach_id);
  	            }
  	        }
         	if ($attach_id > 0) {
  		       update_post_meta($post_id, 'thumbnail',  $attach_id); 
  	        }*/

        }
          /* require_once(ABSPATH . "wp-admin" . '/includes/image.php');
           require_once(ABSPATH . "wp-admin" . '/includes/file.php');
           require_once(ABSPATH . "wp-admin" . '/includes/media.php');

           $attachment_id = media_handle_upload($files, $post_id);

           $attachment_url = wp_get_attachment_url($attachment_id);
           add_post_meta($post_id, '_file_paths', $attachment_url);

           $attachment_data = array(
           'ID' => $attachment_id,
           'post_excerpt' => $caption
           );

           wp_update_post($attachment_data);
        }
      // return $attachment_id;*/
     
    }
   /* function agp_process_woofile($files, $post_id, $caption){


      require_once(ABSPATH . "wp-admin" . '/includes/image.php');
      require_once(ABSPATH . "wp-admin" . '/includes/file.php');
      require_once(ABSPATH . "wp-admin" . '/includes/media.php');

       $attachment_id = media_handle_upload($files, $post_id);

       $attachment_url = wp_get_attachment_url($attachment_id);
        add_post_meta($post_id, '_file_paths', $attachment_url);

        $attachment_data = array(
        'ID' => $attachment_id,
        'post_excerpt' => $caption
     );

      wp_update_post($attachment_data);

       return $attachment_id;

     } /*/
}
 