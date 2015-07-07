<?php
class Contact_Metabox {
    public static $template = array("page-templates/program-template.php");
    
    public static $meta_key = "_contact_box";
    public static $meta_header = "_contact_box_heading";
    
    public $id = "contact-metabox";
    /**
     * Class Constructor
     * Description
     */
    public function __construct()
    {
        add_action("load-post.php", array($this, "setup"));
        add_action("load-post-new.php", array($this, "setup"));
    }
    /**
     * Setup Metabox
     * Description
     */
    public function setup()
    {
        add_action("add_meta_boxes", array($this, "create"));
        add_action("save_post", array($this, "save"), 10, 2);
    }
    /**
     * Create Metabox
     * Description
     */
    public function create()
    {
        /**
         * Add Metabox
         * @code begin
         */
        add_meta_box(
            $this->id, // id
            __("Contact Box", "OII"), // title
            array($this, "display"), // callback
            "page", // screen
            "normal", // context
            "high" // priority
        );
         /**
         * Add Metabox
         * @code end
         */
        
        /**
         * Show or Hide Metabox
         * @code begin
         */
        global $post;
        
        $page_template = get_post_meta($post->ID, "_wp_page_template", TRUE);
        
        if(in_array($page_template, self::$template) == FALSE)
            add_filter($this->id, array($this, "hidden"));
        /**
         * Show or Hide Metabox
         * @code end
         */
        
        
    }
    /**
     * Metabox Hidden
     * Description
     *
     * @return array
     */
    public function hidden($classes)
    {
        $classes[] = "hidden";
        return $classes;
    }
    /**
     * Display Metabox
     * 
     */
    public function display($post)
    {
        // Register and Enqueue Script
        wp_register_script("contact-metabox-script", get_stylesheet_directory_uri() . "/js/contact-metabox.js", array("jquery"));
        wp_enqueue_script("contact-metabox-script");
        
        include_once(get_stylesheet_directory() . "/page-templates/contact-metabox.php");
    }
    /**
     * Save Post Meta
     * Description
     *
     * @param integer $post_id The post ID.
     * @param object $post The post object.
     */
    public function save($post_id, $post)
    {
        if("page" == $post->post_type)
        {
             wp_nonce_field( 'oii_contact_box', 'oii_contact_nonce' );

            if (!isset($_POST['oii_contact_nonce']) || !wp_verify_nonce($_POST['oii_contact_nonce'],'oii_contact_box')){
                print 'Sorry, unable to verify nonce!';
                exit;
            } else {
              $contact_box_content = (isset($_POST['_contact_box'])?$_POST['_contact_box']:"");
              $contact_box_header = (isset($_POST['contact_box_header'])?$_POST['contact_box_header']:"");
              update_post_meta($post_id, self::$meta_key, $contact_box_content);
              update_post_meta($post_id, self::$meta_header, $contact_box_header);
            }
        }
    }
}