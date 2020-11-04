<?php
$connect = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connect,'elms');

    if(isset($_POST['approveData'])){
        $id = $_POST['tID'];

                       
        $deviceID = $_POST['deviceID'];
        $deviceName = $_POST['deviceName'];
        $name = $_POST['firstname'];
        $name = $_POST['tRequest'];
        $requestDate = $_POST['tRequest'];
        $comment = $_POST['userReason'];
        $status = $_POST['status'];
        
        $query = "UPDATE transaction SET status = '2' WHERE transactionID = '$id'";
        $query_run = mysqli_query($connect,$query);
        
        if($query_run){
            echo '<script> alert("Data Updated"); </script>';
            header("location:approve.php");
        }else{
            echo '<script> alert("Data NOT Updated"); </script>';
        }
    }
?>