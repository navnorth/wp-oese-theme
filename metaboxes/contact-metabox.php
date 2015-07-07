<?php
class Contact_Metabox {
    public static $template = array("page-templates/program-template.php");
    
    public static $meta_key = "_contact_box";
    
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
            add_filter("postbox_classes_page_" . $this->id, array($this, "hidden"));
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
            
        }
    }
}