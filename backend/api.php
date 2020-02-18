<?php
/**
 * api for Subscribe for mailchimp ajax plugin
 */


$email = get_option('email_sfma');
$status = 'subscribed'; // "subscribed" or "unsubscribed" or "cleaned" or "pending"
$list_id = get_option('list_id_sfma');
$api_key = get_option('api_key_sfma');
$merge_fields = array('FNAME' => ' ','LNAME' => ' ');

function sfma_subscriber_status( $email, $status, $list_id, $api_key, $merge_fields = array('FNAME' => '','LNAME' => '') ){

    $data = array(
        'apikey'        => $api_key,
        'email_address' => $email,
        'status'        => $status,
        'merge_fields'  => $merge_fields
    );
    $mch_api = curl_init(); // initialize cURL connection

    curl_setopt($mch_api, CURLOPT_URL, 'https://' . substr($api_key,strpos($api_key,'-')+1) . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5(strtolower($data['email_address'])));
    curl_setopt($mch_api, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '.base64_encode( 'user:'.$api_key )));
    curl_setopt($mch_api, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
    curl_setopt($mch_api, CURLOPT_RETURNTRANSFER, true); // return the API response
    curl_setopt($mch_api, CURLOPT_CUSTOMREQUEST, 'PUT'); // method PUT
    curl_setopt($mch_api, CURLOPT_TIMEOUT, 10);
    curl_setopt($mch_api, CURLOPT_POST, true);
    curl_setopt($mch_api, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($mch_api, CURLOPT_POSTFIELDS, json_encode($data) ); // send data in json

    $result = curl_exec($mch_api);
    return $result;
}


sfma_subscriber_status($email, $status, $list_id, $api_key, $merge_fields );



function sfma_subscribe_action(){

    $list_id = get_option('list_id_sfma');
    $api_key = get_option('api_key_sfma');

    $result = json_decode( sfma_subscriber_status($_POST['email'], 'subscribed', $list_id, $api_key, array('FNAME' => $_POST['fname'],'LNAME' => $_POST['lname']) ) );
    // print_r( $result );
    if( $result->status == 400 ){
        foreach( $result->errors as $error ) {
            echo '<p>Error: ' . $error->message . '</p>';
        }
    } elseif( $result->status == 'subscribed' ){
        echo 'Thank you, ' . $result->merge_fields->FNAME . '. You have subscribed successfully';
    }
    // $result['id'] - Subscription ID
    // $result['ip_opt'] - Subscriber IP address
    die;
}

add_action('wp_ajax_mailchimpsubscribe','sfma_subscribe_action');
add_action('wp_ajax_nopriv_mailchimpsubscribe','sfma_subscribe_action');



