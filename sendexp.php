<?php
  $firstName = $_REQUEST["fname"];
  $lastName = $_REQUEST["lname"];
  $email = $_REQUEST["email"];
  $rating = $_REQUEST["rating"];
  $date = date('Y-m-d', time());

  $con = mysqli_connect('localhost', 'root', '123456', 'Product_Site');
  if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
  } else {
    echo 'connected';
  }

  // prepare and bind
  $stmt = $con->prepare("INSERT INTO Interested_Users(Email, First_Name, Last_Name, Interest_Level, Submit_Date)
                          VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $email, $firstName, $lastName, $rating, $date);

  $stmt->execute();
  $stmt->close();
  $con->close();

  mysqli_close($con);
?>
