<?php
    $con=new mysqli("localhost","root","","gil_lab");
	if(isset($_POST["delete"]))
        {   
            $query="Select e_pic from `employee_details` where cnic=".$_POST["delete"];
            $result=mysqli_query($GLOBALS["con"], $query);
            $path=mysqli_fetch_assoc($result);
            $dequery="Delete FROM `employee_details` where cnic=".$_POST["delete"];
            $delete=mysqli_query($GLOBALS["con"], $dequery);
            if($dequery)
                {
                    unlink($path["e_pic"]);
                    echo "Record Deleted";
                }
                else    {"sorry";}
            
        }
        if(isset($_POST["update"]))
            {
                $up_query="UPDATE `employee_details` SET `cnic`=".$_POST["cnic"]." ,`e_name`='".$_POST["e_name"]."',
                `e_f_name`='".$_POST["e_f_name"]."',`e_email`='".$_POST["e_email"]."',`designation`='".$_POST["designation"]."',
                `e_address`='".$_POST["e_address"]."',`e_phone`=".$_POST["e_phone"]." ,`e_salary`=".$_POST["e_salary"]." 
                WHERE cnic=".$_POST["p_cnic"];
                $result=mysqli_query($GLOBALS["con"], $up_query);
                if($result==true)
                    {
                        header("location:http://localhost/GIL/employee_details.php");
                    }
                    else    {  echo "Sorry"; }

            }
            
            if (isset($_POST["desig"]))
        {
            $query="INSERT INTO `designation`(`designation`) VALUES ('".$_POST["desig"]."')";
            $result=mysqli_query($GLOBALS["con"], $query);
            if($result)
                {
                    echo "Successfully Added";
                }
                else {  echo "sorry: already record exists"; }
        }
        
        if(isset($_POST["salary"]))
            {
                echo "Done";
            }
            
?>