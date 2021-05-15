<!DOCTYPE html>
<html lang="en">
<head>
  <title>Employee Details</title>
  <?php
	include "dashboard.php";
?>
<script src="data_form.js"></script>
</head>
<body>
<?php 
$con=new mysqli("localhost","root","","gil_lab"); 
$name=["cnic", "e_name", "e_f_name", "e_email", "designation", "e_address", "e_phone", "e_salary", "e_pic"];
$names=["CNIC", "Name", "F/Name", "Email", "Designation", "Address", "Phone # ", "Salary", "Photo", "Remove", "Update"];
?>
<div class="container">
  <h2 style="text-align: center;"><span class="label label-primary">Employee Details</span></h2>            
  <table class="table" style="margin-top: 3%;">
    <thead>
      <tr>
      <?php for ($a=0;$a<sizeof($names);$a++){  ?>
<th><?php echo $names[$a]; ?></th>
<?php   }  ?>
      </tr>
    </thead>
    <tbody>
      <tr>
      <?php
	$query="Select * from `employee_details` ORDER BY DESC";
    $select=mysqli_query($GLOBALS["con"], $query);
    if($select){
              while($data=mysqli_fetch_assoc($select)){
                for($a=0;$a<sizeof($name);++$a){
                    if($a!=8){
    ?>
    <td><?php echo $data[$name[$a]];?></td>
    <?php
	} else {
    ?>
<td><img src="<?php echo $data[$name[$a]];?>" style="width: 100px; height: 100px;" /></td>
<td><button class="btn btn-danger btn-sm" onclick="remove_employee(<?php echo $data[$name[0]];?>)">Remove</button></td>
<td>
<form method="post" action="update_employee.php">
<input type="text" style="display: none;" name="e_cnic" value="<?php echo $data[$name[0]];?>"/>
<button class="btn btn-primary btn-sm" type="submit" name="cnic">Edit</button>
</form>
</td>
<?php
}   }  
?>  
      </tr>
      
      <?php
	}   }
?>
    </tbody>
  </table>
</div>
<p id="rm_test">..</p>
</body>
</html>
