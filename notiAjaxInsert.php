
  <?php  
 $connect = mysqli_connect("localhost", "root", "", "elms");  
$connect->set_charset("utf8");
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
//     $pickup_date = $_POST["pickup_date"];
//     $itemID = $_POST["itemID"];
        $username = $_POST["username"];
     $deviceID = $_POST["deviceID"];
     $id= $_POST["itemID2"];
     $message = $_POST["notimessage"];
      if($_POST["transactionID"] != '')  
      {  
           $query = "INSERT INTO notification (notiID,username,deviceID,text,readStatus) VALUES (NULL, '$username', '".$id."', '$message', '0')";

      }  

     if(mysqli_query($connect, $query))  
      {  
//         if(mysqli_query($connect, $query2))  
//      {  
//    // header('location:approveTest.php');
//         }
     }
 }  
 ?>