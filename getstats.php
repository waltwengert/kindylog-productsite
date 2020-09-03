 <?php
  $con = mysqli_connect('localhost', 'root', '123456', 'Product_Site');
  if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
  }

  $date = date('Y-m-d', time());


  /**
   * Generic function to get the data associated with a whole week
   */
  function weeklyData($dataName, $value, $table, $dateColumn) {
    $funCon = mysqli_connect('localhost', 'root', '123456', 'Product_Site');
    if (!$funCon) {
      die('Could not connect: ' . mysqli_error($funCon));
    }

    $date = date('Y-m-d', time());

    //have a 7 iteration loop that starts with the count of expressions from 7 days before
    //present until it reaches present and adds these counts to an array
    $weeklyData = [["Date", $dataName], [], [], [], [], [], [], []];

    for ($i=7; $i >= 1; $i--) {
      //today's date - 8 days + $i
      $d = date('Y-m-d', strtotime($date."-".($i-1)." days"));

      $sql = 'SELECT '.$value.' FROM '.$table.' WHERE '.$dateColumn." = '".$d."'";
      $result = mysqli_query($funCon, $sql);

      $count = mysqli_fetch_array($result)[0];
      $weeklyData[$i] = [$d, (int)$count];
    }

    mysqli_close($funCon);
    return $weeklyData;
  }

  /**
   * Generic function to get the amount data gathered in a week
   */
  function weeklyCountData($dataName, $table, $dateColumn) {
    return weeklyData($dataName, 'COUNT(*)', $table, $dateColumn);
  }

  $interestedExps = weeklyCountData('No. Expressions of Interest', 'Interested_Users', 'Submit_Date');

  //have a 5 iteration loop for each interest level that takes a count of each
  //and adds these counts to an array
  $ratingCounts = [["Rating", "Number"]];

  for ($i=1; $i < 6; $i++) {
    $sql = "SELECT COUNT(*) FROM Interested_Users WHERE Interest_Level='".$i."'";
    $result = mysqli_query($con, $sql);

    $count = mysqli_fetch_array($result)[0];
    $ratingCounts[$i] = [(string)$i, (int)$count];
  }

  $siteVisits = weeklyCountData('Landing Page Visits', 'Site_Visits', 'Visit_Date');
  $purchaseHits = weeklyCountData('Purchase Page Visits', 'Purchase_Hits', 'Visit_Date');

  /*
  *Just a placeholder array to test format and table drawing:
  */
  //$userDetails = [['Email', 'First Name', 'Last Name', 'Interest Level', 'Date'], ['Email', 'First Name', 'Last Name', 'Interest Level', 'Date']];

  $userDetails = [];

  $sqlAllDetails = "SELECT * FROM Interested_Users";
  $resultAllDetails = mysqli_query($con, $sqlAllDetails);
  //$allDetailsCount = mysqli_num_rows($resultAllDetails);

  while ($row = mysqli_fetch_array($resultAllDetails)) {
    $rowArr = [];
    $rowArr[0] = $row['0'];
    $rowArr[1] = $row['1'];
    $rowArr[2] = $row['2'];
    $rowArr[3] = $row['3'];
    $rowArr[4] = $row['4'];

    $userDetails[] = $rowArr;
  }
  //$userDetails = mysqli_fetch_array($resultAllDetails);

  //create an array of the above constructed arrays and convert to JSON
  $payload = [];
  $payload[0] = $interestedExps;
  $payload[1] = $ratingCounts;
  $payload[2] = $siteVisits;
  $payload[3] = $purchaseHits;
  $payload[4] = $userDetails;

  $stats = json_encode($payload);

  echo $stats;

  mysqli_close($con);
?>
