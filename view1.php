<?php
    //Connect to database and create table
    $servername = "localhost";
    $username = "kvt_123";
    $password = "12345678";
    $dbname = "thuchanh";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
        //echo "<a href='install.php'>If first time running click here to install database</a>";
    }
?> 




<?php 
    $sql = "SELECT * FROM thuchanh1 ORDER BY id DESC";
    
  
    //$sql = "SELECT * FROM logs WHERE id=a";
    if ($result=mysqli_query($conn,$sql))
    {
        ////////////////////////////////
        if($row=mysqli_fetch_row($result)){
                      
        //  echo "<TABLE id='c4ytable'>";
        //  echo "<TR><TH>NHIET DO</TH><TH>DO AM</TH><TH>ANH SANG</TH><TH>NGAY</TH><TH>GIO</TH></TR>";
        // echo "<TR>";
        // //echo "<TD>".$row[0]."</TD>";
        // echo "<TD>".$row[1]."</TD>";
        // echo "<TD>".$row[2]."</TD>";
        // echo "<TD>".$row[3]."</TD>";
        // echo "<TD>".$row[4]."</TD>";
        // echo "<TD>".$row[5]."</TD>";
        // echo "</TR>";
        // echo "</TABLE>";
        echo "{\"adc0\":\"$row[1]\",\"adc1\":\"$row[2]\",\"LED1\":\"$row[3]\",\"LED2\":\"$row[4]\",\"ngay\":\"$row[6]\",\"gio\":\"$row[7]\"}";
        
        }
        mysqli_free_result($result);
    }
   
        //////////////////////////
    //   // Fetch one and one row
    //   echo "<TABLE id='c4ytable'>";
    //  // echo "<TR><TH>Sr.No.</TH><TH>Station</TH><TH>ADC Value</TH><TH>Date</TH><TH>Time</TH></TR>";
    //   echo "<TR><TH>NHIET DO</TH><TH>DO AM</TH><TH>ANH SANG</TH><TH>NGAY</TH><TH>GIO</TH></TR>";
    //   while ($row=mysqli_fetch_row($result))
    //   {
    //     echo "<TR>";
    //     //echo "<TD>".$row[0]."</TD>";
    //     echo "<TD>".$row[1]."</TD>";
    //     echo "<TD>".$row[2]."</TD>";
    //     echo "<TD>".$row[3]."</TD>";
    //     echo "<TD>".$row[4]."</TD>";
    //     echo "<TD>".$row[5]."</TD>";
    //     echo "</TR>";
    //   }
    //   echo "</TABLE>";
    //   // Free result set
    //   mysqli_free_result($result);
    // }

    mysqli_close($conn);
    
?>
