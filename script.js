jQuery(function($){
    $('#mailchimp').submit(function(){
        var mailchimpform = $(this);
        $.ajax({
            url:mailchimpform.attr('action'),
            type:'POST',
            data:mailchimpform.serialize(),
            success:function(data){
                alert(data);
            }
        });
        return false;
    });
});