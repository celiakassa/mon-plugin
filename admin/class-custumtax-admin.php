<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http:localhost
 * @since      1.0.0
 *
 * @package    Custumtax
 * @subpackage Custumtax/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Custumtax
 * @subpackage Custumtax/admin
 * @author     KASSA Célia <celiakassa9@gmail.com>
 */
class Custumtax_Admin {

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
		 * defined in Custumtax_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custumtax_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/custumtax-admin.css', array(), $this->version, 'all' );

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
		 * defined in Custumtax_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custumtax_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/custumtax-admin.js', array( 'jquery' ), $this->version, false );

	}
	//creation du CPT
	function wpm_custom_post_type() {

	// On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
	$labels = array(
		// Le nom au pluriel
		'name'                => _x( 'Séries TV', 'Post Type General Name'),
		// Le nom au singulier
		'singular_name'       => _x( 'Série TV', 'Post Type Singular Name'),
		// Le libellé affiché dans le menu
		'menu_name'           => __( 'Séries TV'),
		// Les différents libellés de l'administration
		'all_items'           => __( 'Toutes les séries TV'),
		'view_item'           => __( 'Voir les séries TV'),
		'add_new_item'        => __( 'Ajouter une nouvelle série TV'),
		'add_new'             => __( 'Ajouter'),
		'edit_item'           => __( 'Editer la séries TV'),
		'update_item'         => __( 'Modifier la séries TV'),
		'search_items'        => __( 'Rechercher une série TV'),
		'not_found'           => __( 'Non trouvée'),
		'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
	);
	
	// On peut définir ici d'autres options pour notre custom post type
	
	$args = array(
		'label'               => __( 'Séries TV'),
		'description'         => __( 'Tous sur séries TV'),
		'labels'              => $labels,
		// On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
		'supports'            => array( 'title', 'thumbnail','custom-fields', 'Genre de serie'),
		/* 
		* Différentes options supplémentaires
		*/
		'taxonomies'         => array('annees', 'realisateurs', 'categoriesseries'),
		'register_meta_box'    => 'initialisation_metaboxes',
		'show_in_rest'        => true,
		'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => true,
		'rewrite'			  => array( 'slug' => 'series-tv'),

	);
	
	// On enregistre notre custom post type qu'on nomme ici "serietv" et ses arguments
	register_post_type( 'seriestv', $args );
   }

   //On crée 3 taxonomies personnalisées: Année, Réalisateurs et Catégories de série.
   function wpm_add_taxonomies() {
	
	// Taxonomie Année

	// On déclare ici les différentes dénominations de notre taxonomie qui seront affichées et utilisées dans l'administration de WordPress
	$labels_annee = array(
		'name'              			=> _x( 'Années', 'taxonomy general name'),
		'singular_name'     			=> _x( 'Année', 'taxonomy singular name'),
		'search_items'      			=> __( 'Chercher une année'),
		'all_items'        				=> __( 'Toutes les années'),
		'edit_item'         			=> __( 'Editer l année'),
		'update_item'       			=> __( 'Mettre à jour l année'),
		'add_new_item'     				=> __( 'Ajouter une nouvelle année'),
		'new_item_name'     			=> __( 'Valeur de la nouvelle année'),
		'separate_items_with_commas'	=> __( 'Séparer les réalisateurs avec une virgule'),
		'menu_name'         => __( 'Année'),
	);

	$args_annee = array(
	// Si 'hierarchical' est défini à false, notre taxonomie se comportera comme une étiquette standard
		'hierarchical'      => false,
		'labels'            => $labels_annee,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      =>  true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'annees' ),
	);

	register_taxonomy( 'annees', 'seriestv', $args_annee );

	// Taxonomie Réalisateurs
	
	$labels_realisateurs = array(
		'name'                       => _x( 'Réalisateurs', 'taxonomy general name'),
		'singular_name'              => _x( 'Réalisateur', 'taxonomy singular name'),
		'search_items'               => __( 'Rechercher un réalisateur'),
		'popular_items'              => __( 'Réalisateurs populaires'),
		'all_items'                  => __( 'Tous les réalisateurs'),
		'edit_item'                  => __( 'Editer un réalisateur'),
		'update_item'                => __( 'Mettre à jour un réalisateur'),
		'add_new_item'               => __( 'Ajouter un nouveau réalisateur'),
		'new_item_name'              => __( 'Nom du nouveau réalisateur'),
		'separate_items_with_commas' => __( 'Séparer les réalisateurs avec une virgule'),
		'add_or_remove_items'        => __( 'Ajouter ou supprimer un réalisateur'),
		'choose_from_most_used'      => __( 'Choisir parmi les plus utilisés'),
		'not_found'                  => __( 'Pas de réalisateurs trouvés'),
		'menu_name'                  => __( 'Réalisateurs'),
	);

	$args_realisateurs = array(
		'hierarchical'          => false,
		'labels'                => $labels_realisateurs,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'realisateurs' ),
	);

	register_taxonomy( 'realisateurs', 'seriestv', $args_realisateurs );
	
    }

    function initialisation_metaboxes(){
     add_meta_box('id_ma_meta', 'Genre de serie', array($this,'mymeta'), 'seriestv');
    }

    function mymeta($post){
     $val = get_post_meta($post->ID,'_ma_valeur',true);
     echo '<input id="mon_champ" type="text" name="mon_champ" value="'.$val.'" />';
     update_post_meta($post_ID,'_ma_valeur', esc_html($_POST['mon_champ']));
    }
    
    function save_metaboxes($post_ID){
     //si la metabox est définie, on sauvegarde sa valeur
        if(isset($_POST['mon_champ'])){
          update_post_meta($post_ID,'_ma_valeur', esc_html($_POST['mon_champ']));
      }
    }
   
}

  


