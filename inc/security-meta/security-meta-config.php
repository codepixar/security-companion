<?php 
if( !defined( 'WPINC' ) ){
    die;
}
/**
 * @Packge     : Security Companion
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */
    

    // Security meta scripts enqueue
    add_action( 'admin_enqueue_scripts', 'security_meta_scripts' );
    function security_meta_scripts() {
        wp_enqueue_style( 'security-meta-style', plugins_url( 'assets/css/security-meta.css', __FILE__ ) );
        wp_enqueue_script( 'security-meta-script', plugins_url( 'assets/js/security-meta.js', __FILE__ ), array('jquery'), '1.0', true );
    }

    // Page Header select option meta
    add_action("add_meta_boxes", "security_add_custom_meta_box");
    function security_add_custom_meta_box() {
        // page header background meta box
        add_meta_box("pageheader-meta-box", esc_html__( "Builder Page Header Settings", 'security-companion' ), "security_bpheader_meta_box_markup", "page", "side", "high", null);
    }

    // Page Header settings meta field markup
    function security_bpheader_meta_box_markup( $object ) {

    wp_nonce_field( basename( __FILE__ ), "security-bpheader-meta-nonce" );

    ?>
        <div class="header-opt header-show-opt">
            <p class="post-attributes-label-wrapper">
                <label for="pageheader-dropdown" class="post-attributes-label"><?php esc_html_e( 'Select Page Header', 'security-companion' ); ?></label>
            </p>
            <?php 
            $val = get_post_meta( $object->ID ,'_security_builderpage_header_show', true );
            ?>
            <select name="bpheadershow" class="security-admin-selectbox" id="page_header_selectbox">
                <option value="show" <?php echo esc_attr( $val == 'show' ? 'selected' : '' ); ?>><?php esc_html_e( 'Show', 'security-companion' ); ?></option>
                <option value="hide" <?php echo esc_attr( $val == 'hide' ? 'selected' : '' ); ?> ><?php esc_html_e( 'Hide', 'security-companion' ); ?></option>
            </select>

        </div>
        <div class="header-opt header-img">
            <p class="post-attributes-label-wrapper">
                <label for="pageheader-dropdown" class="post-attributes-label"><?php esc_html_e( 'Set Page Header Background', 'security-companion' ); ?></label>
            </p>
            <?php 
            $val = get_post_meta( $object->ID ,'_security_builderpage_headerimg', true );
            ?>
            <select name="bpheaderimg" class="security-admin-selectbox" id="page_header_bg_selectbox">
                <option value="customize" <?php echo esc_attr( $val == 'customize' ? 'selected' : '' ); ?>><?php esc_html_e( 'From Customize', 'security-companion' ); ?></option>
                <option value="featured" <?php echo esc_attr( $val == 'featured' ? 'selected' : '' ); ?> ><?php esc_html_e( 'Featured Image', 'security-companion' ); ?></option>
            </select>

        </div>
    <?php  
    }

    // Page header background settings save
    function security_save_builder_page_header_settings_meta( $post_id, $post, $update ) {
        if ( ! isset( $_POST["security-bpheader-meta-nonce"] ) || ! wp_verify_nonce( $_POST["security-bpheader-meta-nonce"], basename( __FILE__ ) ) )
            return $post_id;

        if( ! current_user_can( "edit_post", $post_id ) )
            return $post_id;

        if( defined( "DOING_AUTOSAVE" ) && DOING_AUTOSAVE )
            return $post_id;

        $slug = "page";
        if( $slug != $post->post_type )
            return $post_id;

        $meta_headershow = "show";

        if( isset( $_POST["bpheadershow"] ) ) {
            $meta_headershow = $_POST["bpheadershow"];
        }
        update_post_meta( absint( $post_id ), "_security_builderpage_header_show", sanitize_text_field( $meta_headershow ) );

        $meta_headerimg = "";

        if( isset( $_POST["bpheaderimg"] ) ) {
            $meta_headerimg = $_POST["bpheaderimg"];
        }
        update_post_meta( absint( $post_id ), "_security_builderpage_headerimg", sanitize_text_field( $meta_headerimg ) );

    }

    add_action( "save_post", "security_save_builder_page_header_settings_meta", 10, 3 );
?>