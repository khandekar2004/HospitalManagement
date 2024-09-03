<?php

//submit_rating.php

$connect = new PDO("mysql:host=localhost;dbname=hmsphp", "root", "");

if(isset($_POST["rating_data"]))
{

	$data = array(
		':user_name'		=>	$_POST["user_name"],
		':user_rating'		=>	$_POST["rating_data"],
		':user_review'		=>	$_POST["user_review"],
		':datetime'			=>	time()
	);

	/*$query = "
	INSERT INTO review_table 
	(user_name, user_rating, user_review, datetime) 
	VALUES (:user_name, :user_rating, :user_review, :datetime)
	";

	$statement = $connect->prepare($query);

	$statement->execute($data);

	if ($statement){*/
	echo "<script>alert('Your Review & Rating Successfully Submitted!');
    window.location.href='../index.php';</script>"; 
	/*}*/
}
