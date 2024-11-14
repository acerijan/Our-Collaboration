<html>
<head>
   <title>Message</title>
   <link rel=stylesheet href="css/chill.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=McLaren">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Manrope">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="icons/swift3.png">
</head>

<body>
   <header>
      <nav class="navbar">
         <div class="nav-logo">
            <img src="icons/swift.jpeg" alt="Swift Logo">
            <span id="top">Swift</span>
         </div>
      </nav>
   </header>
   <?php session_start();?>

   <div class="container">
      <div class="fund-transfer-box">
         <h1 style="text-align:center;color:<?=$_SESSION["result_color"]?>">
            <?php
               echo $_SESSION["result_heading"];
            ?>
         </h1>
         <h3 style="text-align:center;color:<?=$_SESSION["result_color"]?>"><?php echo $_SESSION["result_message"];?></h3>
      </div>
   </div>
   
</body>

</html>