<!DOCTYPE html>
<html lang="en">
<head>
  <title>Update Employee Record</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="forms.js"></script>
</head>
<body>
<h2 style="text-align: center;"><span class="label label-primary">Update Employee Record</span></h2>
<?php
	if(isset($_POST["cnic"]))
        {
          $con=new mysqli("localhost","root","","gil_lab");  
          $name=["cnic", "e_name", "e_f_name", "e_email", "e_address", "e_phone", "e_salary"];
          $names=["CNIC", "Name", "F/Name", "Email", "Address", "Phone # ", "Salary"];
          $query="Select * from `employee_details` where cnic=".$_POST["e_cnic"];  
          $result=mysqli_query($con, $query);
          if($result){
        
?>

<form class="form-inline" action="js_queries.php" method="post" style="margin-top: 2%;">
 <?php
	while($data=mysqli_fetch_assoc($result)){
	   for($a=0; $a<sizeof($name);++$a){
?> 
<div class="form-group col-sm-2" style="padding-top: 2%;">
    <label><?php echo $names[$a]; ?></label>
    <input type="text" class="form-control" name="<?php echo $name[$a]; ?>" value="<?php echo $data[$name[$a]]; ?>" required="" />
  </div>
  <input type="text" value="<?php echo $data["cnic"]; ?>" name="p_cnic" style="display: none;" />
<?php   }	?>

<div class="col-sm-1 form-group" style="margin-top: 2%;">
<label>Designation</label>
<select name="designation" class="form-control">
<?php 
$query="select * from designation";	
$result=mysqli_query($con, $query);
if($result){
    while($row=mysqli_fetch_assoc($result)){
?>
<option value="<?php echo $row["designation"]; ?>"><?php echo $row["designation"]; ?></option>
<?php } }   ?>
</select>
</div>

<div class="form-group col-sm-1" style="padding-top: 2%;">
<label>Update</label>
<button type="submit" class="btn btn-info btn-md" name="update">OK</button>
</div>
<?php   }   ?>
</form>

<?php
} else{ echo "Invalid CNIC"; }}
?>
</body>
</html>