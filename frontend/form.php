<?php
/**
 * Settings for plugin Subscribe for mailchimp ajax
 */


function sfma_frontend_form()
{
    ?>
    <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" id="mailchimp">
        <div class="bz-subscribe__input-box">
            <input type="text" name="fname" class="input " required placeholder="First name" />
            <input type="text" name="lname" class="input " required placeholder="Last name" />
            <input type="email" name="email" class="input " required placeholder="Email" />

            <input type="hidden" name="action" value="mailchimpsubscribe" />


            <button type="submit" class="send-email" >
                <span class="btn-text"><?php esc_html_e( 'Subscribe', 'sfma' );   ?></span>
            </button>

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
                    }
                });
                return false;
            });
        });

    </script>


    <?php
}

add_shortcode('sfma_form', 'sfma_frontend_form');
