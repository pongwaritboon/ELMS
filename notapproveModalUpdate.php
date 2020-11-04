<?php
$connect = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connect,'elms');

    if(isset($_POST['notapproveData'])){
        $id = $_POST['tID2'];

                       
        $deviceID = $_POST['deviceID2'];
        $deviceName = $_POST['deviceName2'];
        $name = $_POST['firstname2'];
        $name = $_POST['tRequest2'];
        $requestDate = $_POST['tRequest2'];
        $comment = $_POST['userReason2'];
        $status = $_POST['status2'];
        
        $query = "UPDATE transaction SET status = '0' WHERE transactionID = '$id'";
        $query_run = mysqli_query($connect,$query);
        
        if($query_run){
            echo '<script> alert("Data Updated"); </script>';
            header("location:approve.php");
        }else{
            echo '<script> alert("Data NOT Updated"); </script>';
        }
    }
?>