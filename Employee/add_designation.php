<head>
<title>Add Designation</title>
<?php
	include "dashboard.php";
?>
<script src="data_form.js"></script>
</head>
<div class="container" style="margin-top: 3%;">
<table class="table table-striped table-hover">
<form>
<div class="col-sm-3">
<label>Designation: </label>
<input type="text" name="add_desig" id="1" placeholder="Enter Designation"/>
<button class="btn btn-success btn-sm" onclick="add_designation()">Add</button>
</div>
<div class="col-sm-2"> 
<p id="test"></p>
</div>
</form>
</table>
</div>