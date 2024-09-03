<?php 
session_start();
if(!empty($_POST['email'])){
  $email = $_POST['email'];
if (filter_var($email,FILTER_VALIDATE_EMAIL)===false){
    exit("Invalid email format");
}

              // Initialize cURL.
              $ch = curl_init();

              // Set the URL that you want to GET by using the CURLOPT_URL option.
              curl_setopt($ch, CURLOPT_URL, "https://emailvalidation.abstractapi.com/v1/?api_key=a63f55916a33471db5cd7a4bd3436378&email=$email");

              // Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

              // Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
              curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

              // Execute the request.

              $response = curl_exec($ch);

              // Close the cURL handle.
              curl_close($ch);
              $data = json_decode($response, true);
              $emailval="" ;
              if($data['deliverability']==="UNDELIVERABLE"){
                exit("Please enter valid email address");
              }

              else if($data["is_disposable_email"]["value"]===true){
                exit("Please enter valid email address");
                
              }

              $emailval = $email;
              // Print the data out onto the page.
              
            }
            
            if(!empty($_POST['password'])){
              $password = $_POST['password'];

if (preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $password)) {
    echo "";
} else {
    echo "Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters";
}
            }
?>