<head>
	<title>
		Add Employee
	</title>
	<?php
	include "dashboard.php";
?>
<script src="forms.js"></script>
</head>
<h2 style="text-align:center;">
<span class="label label-primary">Employee Registration Form</span>
</h2>
<div class="container">
	<table class="table table-striped table-hover">
		<form class="form-inline" id="fupForm" enctype="multipart/form-data">
			<div class="row" style="padding: 5px;margin-top: 10px;">
				<div class="col-sm-2">
					<label>
						Select Designation
					</label>
					<select name="designations" class="form-control" id="e1">
						<?php 
                        $con=new mysqli( "localhost", "root", "", "gil_lab"); 
                        $query="Select * from `designation`"; 
                        $result=mysqli_query($con, $query); 
                        if($result)
                        { 
                            while($data=mysqli_fetch_assoc($result)){ ?>
							<option value="<?php echo $data["designation"];?>">
								<?php echo $data["designation"];?>
							</option>
							<?php } } ?>
					</select>
				</div>
                
                <div class="col-sm-2">
                <label>Email:</label>
                <input type="email" class="form-control" name="e_email"required="" />
                </div>
				
                <div class="col-sm-2">
					<label>
						CNIC:
					</label>
					<input type="text" name="cnic" minlength="13" maxlength="13" onkeypress="return onlyNumberKey(event)" class="form-control" id="e2"  required=""/>
				</div>
				<div class="col-sm-3">
					<label>
						Name:
					</label>
					<input type="text" name="e_name" placeholder="name" class="form-control" id="e3" required=""/>
				</div>
				<div class="col-sm-3">
					<label>
						F:Name
					</label>
					<input type="text" name="e_fname" placeholder="f:name" class="form-control" id="e4" required=""/>
				</div>
			</div>
			<div class="row" style="padding: 5px;margin-top: 10px;">
				<div class="col-sm-3">
					<label>
						Address:
					</label>
					<textarea name="address" placeholder="address" class="form-control" id="e5" required="">
					</textarea>
				</div>
				<div class="col-sm-2">
					<label>
						Phone#
					</label>
					<input type="text" name="e_phone" class="form-control" maxlength="11" id="e6" onkeypress="return onlyNumberKey(event)" required=""/>
				</div>
				<div class="col-sm-2">
					<label>
						Salary:
					</label>
					<input type="text" name="e_salary" class="form-control" id="e7" onkeypress="return onlyNumberKey(event)" required="" />
				</div>

				<div class="col-sm-3">
					<label>
						Picture:
					</label>
					<input type="file" name="e_photo" class="form-control" id="e8" required=""/>
				</div>
				<div class="col-sm-2">
					<label>
						Add Employee
					</label>
                    <button type="submit" class="btn btn-success submitBtn" name="e_sb" id="e_sb" >Submit</button>
				</div>
			</div>
		</form>
	</table>
</div>

<div class="statusMsg" style="margin-left: 20%;"></div>
