<?php  
//select.php  
if(isset($_POST["transactionID"]))
{
 $output = '';
 $connect = mysqli_connect("localhost", "root", "", "elms");
// $query = "SELECT * FROM employee WHERE id = '".$_POST["employee_id"]."'";
 $query =  $sql = "SELECT transaction.transactionID,transaction.itemID,transaction.username,transaction.status,transaction.user_comment,transaction.borrowed_date,transaction.request_date,device.itemID,device.device_name,userinfo.username,userinfo.firstname,userinfo.surname FROM transaction
                                            INNER JOIN device ON transaction.itemID = device.itemID
                                            JOIN userinfo ON transaction.username = userinfo.username
                                            WHERE transaction.status = 1 AND transaction.transactionID = '".$_POST["transactionID"]."'";
 $result = mysqli_query($connect, $query);
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
    while($row = mysqli_fetch_array($result))
    {
     $output .= '
     <tr>  
            <td width="30%"><label>Name</label></td>  
            <td width="70%">'.$row["transactionID"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Address</label></td>  
            <td width="70%">'.$row["transactionID"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Gender</label></td>  
            <td width="70%">'.$row["transactionID"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Designation</label></td>  
            <td width="70%">'.$row["transactionID"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Age</label></td>  
            <td width="70%">'.$row["transactionID"].'</td>  
        </tr>
     ';
    }
    $output .= '</table></div>';
    echo $output;
}
?>
