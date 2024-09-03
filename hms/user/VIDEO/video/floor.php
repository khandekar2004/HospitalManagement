<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head> 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function generateValue() {
    return Math.floor(Math.random() * 100) + 1;
}
/*function addToDatabase(){
    var inputValue = document.getElementById("myInput").value;
    var xhr = new XMLHttpRequest();
    var url = "add.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
  if (xhr.readyState === XMLHttpRequest.DONE) {
    if (xhr.status === 200) {
      // Request completed successfully
      console.log(xhr.responseText);
    } else {
      // Error occurred
      console.error("Request failed with status:", xhr.status);
    }
  }
};
xhr.send("inputValue=" + encodeURIComponent(inputValue));

}
*/
   function addToDatabase() {
    
        var value = document.getElementById('try').value;
    fetch('add.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'value=' + value
    })
    .then(function(response) {
        // Handle the response from the PHP script
        console.log(response);
    })
    .catch(function(error) {
        console.error(error);
    });
}
/*
$(document).ready(function() {
  $('#submitButton').click(function() {
    var inputValue = $('#try').val(); // Get the value from the input field

    // Send an AJAX request to the PHP script
    $.ajax({
      url: 'add.php',
      type: 'POST',
      data: { value: inputValue },
      success: function(response) {
        console.log('Data successfully transferred to PHP.');
        // You can perform additional actions here after the data is successfully saved
      },
      error: function() {
        console.log('Error transferring data to PHP.');
      }
    });
  });
});
*/
</script>
<?php
$cname = $_GET['nme'];
$name = urldecode($cname);

// Encryption key (should be the same as used for encryption)


// Decrypt the ciphertext using OpenSSL AES-256-CBC decryption
$sname = openssl_decrypt($name, "AES-256-CBC", 'a1b2c3d4e5f6g7h8', 0, "1234567890abcdef");
echo $sname?>

<input type="text" id="try" value="try" ></input>
   <button onclick="addToDatabase()">Click</button>
</body>
</html>