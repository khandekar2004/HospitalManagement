<?php
include('./hms/include/connection.php');
if(!empty($_POST["specializationid"])) 
{
  $spec = $_POST['specializationid'];
 $sql=mysqli_query($connect,"SELECT name FROM doctor WHERE specialization= $spec");?>
 <option selected="selected">Select Doctor </option>
 <?php
 while($row=mysqli_fetch_array($sql))
 	{?>
  <option value="<?php echo htmlentities($row['name']); ?>"><?php echo htmlentities($row['name']); ?></option>
  <?php
}
}
/*

if(!empty($_POST["doctor"])) 
{

 $sql=mysqli_query($con,"select docFees from doctors where id='".$_POST['doctor']."'");
 while($row=mysqli_fetch_array($sql))
 	{?>
 <option value="<?php echo htmlentities($row['docFees']); ?>"><?php echo htmlentities($row['docFees']); ?></option>
  <?php
}
}*/

?>

