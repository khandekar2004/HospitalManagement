<?php
include('../include/connection.php');
if(!empty($_POST["specilizationid"])) 
{

 $sql=mysqli_query($connect,"select name,id from doctor where specialization='".$_POST['specilizationid']."'");?>
 <option value="">Select Doctor </option>
 <?php
 while($row=mysqli_fetch_array($sql))
 	{?>
  <option value="<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['name']); ?></option>
  <?php
}
}


if(!empty($_POST["doctor"])) 
{

 $sql=mysqli_query($connect,"select fees from doctor where id='".$_POST['doctor']."'");
 while($row=mysqli_fetch_array($sql))
 	{?>
 <option value="<?php echo htmlentities($row['fees']); ?>"><?php echo htmlentities($row['fees']); ?></option>
  <?php
}
}

?>

