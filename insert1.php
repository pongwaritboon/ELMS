
  <?php  
 $connect = mysqli_connect("localhost", "root", "", "elms");  
 if(!empty($_POST))  
 {  
//      $output = '';  
//      $message = '';  
//      $name = mysqli_real_escape_string($connect, $_POST["name"]);  
//      $pickup_date = mysqli_real_escape_string($connect, $_POST["pickup_date"]);  
//      $gender = mysqli_real_escape_string($connect, $_POST["gender"]);  
//      $designation = mysqli_real_escape_string($connect, $_POST["designation"]);  
//      $age = mysqli_real_escape_string($connect, $_POST["age"]);
// $pickup_date = mysqli_real_escape_string($connect, $_POST["pickup_date"]);
     $comment = $_POST["reason"];
     
      if($_POST["transactionID1"] != '')  
      {  
           $query = "  
           UPDATE transaction   
           SET status='0',
           admin_comment='$comment'
           WHERE transactionID='".$_POST["transactionID1"]."'";  
           $message = 'Data Updated';
//          $query = "  
//           UPDATE tbl_employee   
//           SET name='$name',   
//           address='$address',   
//           gender='$gender',   
//           designation = '$designation',   
//           age = '$age'   
//           WHERE id='".$_POST["employee_id"]."'"; 
      }  
//      else  
//      {  
//           $query = "  
//           INSERT INTO tbl_employee(name, address, gender, designation, age)  
//           VALUES('$name', '$address', '$gender', '$designation', '$age');  
//           ";  
//           $message = 'Data Inserted';  
//      }  
//      if(mysqli_query($connect, $query))  
//      {  
//           $output .= '<label class="text-success">' . $message . '</label>';  
//           $select_query = "SELECT * FROM tbl_employee ORDER BY id DESC";  
//           $result = mysqli_query($connect, $select_query);  
//           $output .= '  
//                <table class="table table-bordered">  
//                     <tr>  
//                          <th width="70%">Employee Name</th>  
//                          <th width="15%">Edit</th>  
//                          <th width="15%">View</th>  
//                     </tr>  
//           ';  
//           while($row = mysqli_fetch_array($result))  
//           {  
//                $output .= '  
//                     <tr>  
//                          <td>' . $row["name"] . '</td>  
//                          <td><input type="button" name="edit" value="Edit" id="'.$row["id"] .'" class="btn btn-info btn-xs edit_data" /></td>  
//                          <td><input type="button" name="view" value="view" id="' . $row["id"] . '" class="btn btn-info btn-xs view_data" /></td>  
//                     </tr>  
//                ';  
//           }  
//           $output .= '</table>';  
//      }  
//      echo $output;
     if(mysqli_query($connect, $query))  
      {  
    // header('location:approveTest.php');
     }
 }  
 ?>