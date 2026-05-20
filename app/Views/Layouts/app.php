<!DOCTYPE html>
<html lang='de'>
<head>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <title><?php echo $title ?? 'projekt'; ?></title>
  <link rel='stylesheet' href='css/style.css'>
</head>
<body>

<header style="background: red">
  Header Test
</header>

<main>
  <?php echo $content; ?>
</main>

<footer style="background: green">
  Footer Test
</footer>

<script src="js/app.js"></script>
</body>
</html>