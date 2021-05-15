<?php
$con=new mysqli("localhost","root","","gil_lab");
$uploadDir = 'uploads/'; 
$response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
); 
if(isset($_POST['designations']) || isset($_POST['e_photo'])){ 
    // Get the submitted form data 
    $email = $_POST['e_email']; 
    $designation=$_POST["designations"]; 
    // Check whether submitted data is not empty 
    if(!empty($designation) && !empty($email)){ 
        // Validate email 
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){ 
            $response['message'] = 'Please enter a valid email.'; 
        }else{ 
            $uploadStatus = 1; 
             
            // Upload file 
            $uploadedFile = ''; 
            if(!empty($_FILES["e_photo"]["name"])){ 
                 
                // File path config 
                $fileName = basename($_FILES["e_photo"]["name"]); 
                $targetFilePath = $uploadDir . $fileName; 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                 
                // Allow certain file formats 
                $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
                if(in_array($fileType, $allowTypes)){ 
                    // Upload file to the server 
                    if(move_uploaded_file($_FILES["e_photo"]["tmp_name"], $targetFilePath)){ 
                        $uploadedFile = $fileName; 
                    }else{ 
                        $uploadStatus = 0; 
                        $response['message'] = 'Sorry, there was an error uploading your file.'; 
                    } 
                }else{ 
                    $uploadStatus = 0; 
                    $response['message'] = 'Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.'; 
                } 
            } 
             
            if($uploadStatus == 1){ 
                // Include the database config file 
                //include_once 'dbConfig.php'; 
                 
                 $query="INSERT INTO `employee_details`(`cnic`, `e_name`, `e_f_name`, `e_email`, `designation`, `e_address`, `e_phone`, `e_salary`, `e_pic`) 
                 VALUES('".$_POST["cnic"]."','".$_POST["e_name"]."','".$_POST["e_fname"]."','".$_POST["e_email"]."','".$_POST["designations"]."','"
                 .$_POST["address"]."','".$_POST["e_phone"]."','".$_POST["e_salary"]."','".$targetFilePath."')";
                 
                 $insert=mysqli_query($GLOBALS["con"], $query);
                
                if($insert){ 
                    $response['status'] = 1; 
                    $response['message'] = 'Form data submitted successfully!';
                } 
            } 
        } 
    }else{ 
         $response['message'] = 'Please fill all the mandatory fields'; 
    } 
} 
 
// Return response 
echo json_encode($response);
?>