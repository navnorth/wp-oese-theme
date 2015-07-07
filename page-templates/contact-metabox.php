<input type="hidden" id="eci-template" data-template="<?php echo implode("|", Contact_Metabox::$template); ?>" />

<div id="contact-content-wrap">
    <?php
        global $post;
        wp_nonce_field( __FILE__, 'oii_contact_nonce' );

        $field_value = get_post_meta( $post->ID, '_contact_box', false );
        wp_editor( $field_value[0], '_contact_box' );    ?>
</div>