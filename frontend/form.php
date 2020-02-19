<?php
/**
 * Settings for plugin Subscribe for mailchimp ajax
 */


function sfma_frontend_form()
{
    ?>
    <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" id="mailchimp">
        <div class="sfma-subscribe-input-box">
            <input type="text" name="fname" class="input " required placeholder="<?php esc_html_e( 'First name', 'sfma' );   ?>" />
            <input type="text" name="lname" class="input " required placeholder="<?php esc_html_e( 'Last name', 'sfma' );   ?>" />
            <input type="email" name="email" class="input " required placeholder="<?php esc_html_e( 'Email', 'sfma' );   ?>" />

            <input type="hidden" name="action" value="mailchimpsubscribe" />


            <button type="submit" class="send-email" >
                <span class="btn-text"><?php esc_html_e( 'Subscribe', 'sfma' );   ?></span>
            </button>

            <span class="info "></span>

        </div>
    </form>


    <script>
        jQuery(function($){
            $('#mailchimp').submit(function(){
                var mailchimpform = $(this);
                $.ajax({
                    url:mailchimpform.attr('action'),
                    type:'POST',
                    data:mailchimpform.serialize(),
                    success:function(data){

                        console.log(data);
                        $('.info').addClass('alert');
                        $('.info').text((data));
                        setTimeout(function() {
                            $('.alert').addClass('visible');
                        }, 50);
                        setTimeout(function() {

                            $('.alert').removeClass('visible');
                        }, 2500);

                    }
                });
                return false;
            });
        });

    </script>


    <?php
}

add_shortcode('sfma_form', 'sfma_frontend_form');
