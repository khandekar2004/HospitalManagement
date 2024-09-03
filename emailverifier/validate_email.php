<?php 
$email = $_POST['email'];
if (filter_var($email,FILTER_VALIDATE_EMAIL)===false){
    exit("invalid format");
}

              // Initialize cURL.
              $ch = curl_init();

              // Set the URL that you want to GET by using the CURLOPT_URL option.
              curl_setopt($ch, CURLOPT_URL, "https://emailvalidation.abstractapi.com/v1/?api_key=5a483b7f44fb478aa75b4777c08a8a61&email=$email");

              // Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

              // Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
              curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

              // Execute the request.

              $response = curl_exec($ch);

              // Close the cURL handle.
              curl_close($ch);
              $data = json_decode($response, true);

              if($data['deliverability']==="UNDELIVERABLE"){
                exit("Undeliverable");
              }

              if($data["is_disposable_email"]["value"]===true){
                exit("Disposable");
              }

              echo "email is valid";

              // Print the data out onto the page.
              
              
?>