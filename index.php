<!DOCTYPE html>
<html>
<head>
  <title>KindyLog</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Social media buttons rely on css from font-awesome to come afterwards -->
  <link rel="stylesheet" href="styles/socialmedia.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="styles/main.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

  <script>
  xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      console.log(this.responseText);
    }
  };
  xmlhttp.open("GET", "logvisit.php", true);
  xmlhttp.send();
  </script>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
      <a class="navbar-brand" href="index.php">KindyLog</a>

      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="purchase.php">Purchase</a>
        </li>
      </ul>
      <ul class="navbar-nav navbar-right">
        <li class="nav-item">
          <a class="nav-link" href="stats.php">Statistics</a>
        </li>
      </ul>
    </nav>
  </header>

  <div class="container-fluid" style="margin-top:80px">

    <header>
      <div class="float-right social-media">
        <a class="btn" href="http://www.facebook.com/sharer.php?u=https://deco3801-donthatetoinnovate.uqcloud.net/" target="_blank">
          <i class="fa fa-facebook"></i>
        </a>
        <a class="btn" href="https://twitter.com/share?url=https://deco3801-donthatetoinnovate.uqcloud.net&amp;text=KindyLog&amp;hashtags=kindylog" target="_blank">
          <i class="fa fa-twitter"></i>
        </a>
        <a class="btn" href="http://reddit.com/submit?url=https://deco3801-donthatetoinnovate.uqcloud.net&amp;title=KindyLog" target="_blank">
          <i class="fa fa-reddit"></i>
        </a>
      </div>
    </header>
    <h1>Welcome to KindyLog</h1><br>
    <main>
      <section class="intro">
        <p>KindyLog a childcare check-in system for the modern age.</p>
        <p>Using an Android-supported tablet, KindyLog provides facial scanning of the parent to blow pen and paper sign-in out of the water in terms of speed and ease of use.</p>
        <p>Built on Amazon's AWS Rekognition technology, the process is safe, secure and fast</p>
        <p>By using KindyLog, parents/guardians registered with the childcare would be able to check their child/ren in and out of a childcare without any form of data entries. This would reduce the time taken to line up for the sign in kiosk and complete the sign in/out process.</p>
        <p>Our KindyLog system integrates with KindyBook, which is already used by many childcare centres for tracking child progress.</p>
            <p>
            <a class="btn btn-success" href="purchase.php">Purchase Now</a>
            <a class="btn btn-primary" href="https://www.kindybook.com">KindyBook</a>
        </p>
      </section>
      <iframe width="560" height="315" frameborder="0" class="vid embed-responsive-item"
                                                       src="https://www.youtube.com/embed/ZxX6Ev6MpNE" allowfullscreen>
      </iframe>
    </main>
    <br>
  </div>
</body>
</html>
