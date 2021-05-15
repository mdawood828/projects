<?php

if (isset($_POST["register"]))
{
    $con = new mysqli("localhost", "root", "", "gil_lab");
    $query = "INSERT INTO `citizen`(`cnic`, `password`) VALUES ('" . $_POST["cnic"] .
        "','" . $_POST["pwd"] . "')";
    $result = mysqli_query($con, $query);
    if ($result)
    {
        echo "Registered";
    }
} else
    if (isset($_POST["login"]))
    {
        $con = new mysqli("localhost", "root", "", "gil_lab");
        $cnic = $_POST["cnic"];
        $query = "SELECT * FROM `citizen` WHERE cnic = '$cnic'";
        echo ("<p>$query</p>");
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) == 1)
        {
            echo "Found";
        } else
        {
            echo "Not Found";
        }

    } else
        if (isset($_POST["admin"]))
        {
            $con = new mysqli("localhost", "root", "", "gil_lab");
            $admin_query = "Select * from `login` WHERE name='" . $_POST["name"] .
                "' AND password='" . $_POST["a_password"] . "'";
            $get_user = mysqli_query($con, $admin_query);
            if (mysqli_num_rows($get_user) == 1)
            {
                $query = "SELECT * FROM `citizen`";
                $result = mysqli_query($con, $query);
                if (mysqli_num_rows($result) >= 1)
                {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        echo "<p>" . $row["cnic"] . "</p>";
                    }
                }
            }

        }

?>