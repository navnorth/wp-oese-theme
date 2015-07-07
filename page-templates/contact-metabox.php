<input type="hidden" id="oii-template" data-template="<?php echo implode("|", Contact_Metabox::$template); ?>" />
<?php
    global $post;
    $contact_heading = get_post_meta($post->ID,'_contact_box_heading',true);
?>
<div id="contact-content-wrap">
    <div class="col span_1_of_12"><label>Heading</label></div>
    <div class="col span_9_of_12">
        <input type="text" name="contact_box_header" value="<?php echo $contact_heading; ?>" size="100" />
    </div><div class="clear"></div>
    <div>
    <?php
        wp_nonce_field( 'oii_contact_box', 'oii_contact_nonce' );

        $field_value = get_post_meta( $post->ID, '_contact_box', false );
        wp_editor( $field_value[0], '_contact_box' );
    ?>
    </div>
</div>