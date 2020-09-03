<?php
  $con = mysqli_connect('localhost', 'root', '123456', 'Product_Site');
  if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
  }

  $clientIP = $_SERVER['REMOTE_ADDR'];
  $date = date('Y-m-d', time());

  $sql = "INSERT INTO Purchase_Hits(IP, Visit_Date) VALUES ('$clientIP', '$date')";
  $result = mysqli_query($con, $sql);

  echo $clientIP;
  mysqli_close($con);
?>
