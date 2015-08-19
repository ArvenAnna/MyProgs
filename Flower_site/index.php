<html>
<head>
<title>house rose
</title>
<script src="js/jquery.js"></script>
<script src="js/fakeLoader.js"></script>
<link rel="stylesheet" href="css/fakeLoader.css">
<link href="css/style.css" rel="stylesheet">
<link href="css/framestyle.css" rel="stylesheet">
</head>

<body>
<div class="fakeloader"></div>

<div class="header site">
<?php
include "parts/header.html";
?>
</div>

<div class="menu site">
<?php
include "parts/menu.html";
?>
</div>

<div class="main-content site">
	<div class="text-content">Р±Р»Р°-Р±Р»Р°-Р±Р»Р°</div>
</div>

<div class="footer site">
<?php
include "parts/footer.html";
?>
</div>

<script>
  $(".fakeloader").fakeLoader({
  timeToHide:1200,
  bgColor:"#2ecc71",
  spinner:"spinner2"
  });
</script>
</body>

</html>
