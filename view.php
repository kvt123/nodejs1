<!DOCTYPE html>
<html>
<head>
<meta http-equiv="refresh" content="5">
</head>
<body>
<style>
#c4ytable {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#c4ytable td, #c4ytable th {
    border: 1px solid #ddd;
    padding: 8px;
}

#c4ytable tr:nth-child(even){background-color: #f2f2f2;}

#c4ytable tr:hover {background-color: #ddd;}

#c4ytable th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #00A8A9;
    color: white;
}
</style>

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


<div id="cards" class="cards">

<?php 
    $sql = "SELECT * FROM thuchanh1 ORDER BY id DESC";
    
  
    //$sql = "SELECT * FROM logs WHERE id=a";
    if ($result=mysqli_query($conn,$sql))
    {
        ////////////////////////////////
        if($row=mysqli_fetch_row($result)){
                      
          
        //////////////////////////
    //   // Fetch one and one row
       echo "<TABLE id='c4ytable'>";
    //  // echo "<TR><TH>Sr.No.</TH><TH>Station</TH><TH>ADC Value</TH><TH>Date</TH><TH>Time</TH></TR>";
       echo "<TR><TH>ADC0</TH><TH>ADC1</TH><TH>LED1</TH><TH>LED2</TH><TH>NGAY</TH><TH>GIO</TH></TR>";
       while ($row=mysqli_fetch_row($result))
       {
         echo "<TR>";
         //echo "<TD>".$row[0]."</TD>";
         echo "<TD>".$row[1]."</TD>";
         echo "<TD>".$row[2]."</TD>";
         echo "<TD>".$row[3]."</TD>";
         echo "<TD>".$row[4]."</TD>";
         echo "<TD>".$row[5]."</TD>";
         echo "<TD>".$row[6]."</TD>";
         echo "</TR>";
       }
       echo "</TABLE>";
    }
    //   // Free result set
       mysqli_free_result($result);
     
    }
    mysqli_close($conn);
    
?>
</body>
</html>