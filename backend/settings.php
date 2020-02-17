<?php
/**
 * Settings for plugin Subscribe for mailchimp ajax
 */



add_action('admin_menu', 'add_plugin_page_sfma');
function add_plugin_page_huntrewievs(){
    add_options_page( esc_html__( 'Subscribe for mailchimp ajax Settings', 'sfma' ), 'Subscribe for mailchimp ajax', 'manage_options', 'sfma_slug', 'options_page_output_sfma' );
}

function options_page_output_sfma(){
    ?>
    <div class="wrap">
        <h2><?php echo get_admin_page_title() ?></h2>

        <form action="options.php" method="POST">
            <?php
            settings_fields( 'option_group' );
            do_settings_sections( 'sfma_page' );
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

add_action('admin_init', 'plugin_settings_sfma');
function plugin_settings_sfma(){


    register_setting( 'option_group', 'api_key_sfma' );
    register_setting( 'option_group', 'list_id_sfma' );
    register_setting( 'option_group', 'email_sfma' );


    add_settings_section( 'section_id_01',  esc_html__( 'Main settings', 'sfma' ), '', 'sfma_page' );

    add_settings_field('Sfma_field1', esc_html__( 'Fill', 'sfma' ), 'fill_options_sfma_field_1', 'sfma_page', 'section_id_01' );

}



function fill_options_sfma_field_1() {
    ?>
    <label for="api_key_sfma" style="display: block; margin-bottom: 5px;"><?php esc_html_e( 'Api key', 'sfma' );   ?> </label>
    <input id="api_key_sfma" name="api_key_sfma"  type="text" value="<?php  get_option( 'api_key_sfma' );   ?>" class="code1" />

    <label for="list_id_sfma" style="display: block; margin-bottom: 5px;"><?php esc_html_e( 'List id', 'huntrewievs' );   ?> </label>
    <input id="list_id_sfma" name="list_id_sfma"  type="text" value="<?php  get_option( 'list_id_sfma' );   ?>" class="code2" />

    <label for="email_sfma" style="display: block; margin-bottom: 5px;"><?php esc_html_e( 'Email', 'huntrewievs' );   ?> </label>
    <input id="email_sfma" name="email_sfma"  type="text" value="<?php  get_option( 'email_sfma' );   ?>" class="code3" />

    <?php
}




function sanitize_callback_sfma( $options ){

    foreach( $options as $name => & $val ){
        if( $name == 'input' )
            $val = strip_tags( $val );

        if( $name == 'checkbox' )
            $val = intval( $val );

        if( $name == 'radio' )
            $val = intval( $val );
    }

    return $options;
}



