<!DOCTYPE html>
<!-- Milica Milanovic 0601/18 -->
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>index</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/gost/index.css'); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/gost/meni.css'); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/gost/body.css'); ?>"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/gost/uspesnareg.css'); ?>"/>
</head>
<body>
<div class=novinovi>

     
  <h2 id=l1>Uspesna registracija</h2>
<button class="btn btn-success" id="b1"  > <?= anchor("Gost/index", "Vrati se na pocetnu") ?> </button>
<button class="btn btn-success" id=b2    ><?= anchor("Gost/login", "Vrati se na pocetnu") ?> </button>

</div>
    
</body>
</html>