// Footer File Code
<script>
jQuery(document).ready(function() {
    jQuery(".woocommerce-page input[type=email]").change(function(){
    var name = jQuery( "input#billing_first_name" ).val();
    var email = jQuery( "input#billing_email" ).val();
    var phone = jQuery( "input#billing_phone" ).val()
  alert(name + email + phone);	
  
  jQuery.ajax({
           url: '<?php echo admin_url('admin-ajax.php'); ?>',
           type: "POST",
           cache: false,
           data:{ 
              action: 'send_email', 
              name: name,
              email: email,
              phone: phone,
                },
           success:function(res){
			   alert("Email Sent.");
			   }
                      }); 
	
});
});
</script>



// Function File Code
function callback_send_email(){

	  $name = $_REQUEST['name'];
	  $email = $_REQUEST['email'];
          $phone= $_REQUEST['phone'];
          $subject = "Contact Form";
          
          $to = "mamoon.mmc@gmail.com";
         $subject = "This is subject";
         
         $message = "<b>Name: </b> ". $name . "<br>";
         $message .= "<b>Email: </b>". $email . "<br>";
         $message .= "<b>Phone: </b>". $phone . "<br>";
         
         $header = "From:woocommerce-checkout-page@techxdigital.com \r\n";
         $header .= "Cc:info@techxdigital.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }
	
}


add_action( 'wp_ajax_send_email', 'callback_send_email' );
add_action( 'wp_ajax_nopriv_send_email', 'callback_send_email' );
