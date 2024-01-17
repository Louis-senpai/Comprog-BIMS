<?php 
require 'models/Components.php';

?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="js/tailwind.config.js"></script>
</head>
<body>
<?php 

$Components = new Tailwind();

 echo $Components->AlertDiv('Hellow World', 'success');

?>
</body>
</html>