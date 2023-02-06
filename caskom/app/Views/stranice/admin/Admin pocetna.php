<!-- Marija Dobric 0417/18 -->
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>index</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('css/admin/style_Admin.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('css/admin/meni.css');?>">
 
</head>
<body>
    <div class=linija_menija>
        <div class=meni_info>
          <ul>
            <li><a href='Admin pocetna.html' class="pocetna_link"> <?= anchor("Admin/index", "Početna") ?> </a></li>
            <li><a href='statistika_moderatora.html' class="o_nama"><?= anchor("Admin/stat", "Statistika moderatora") ?> </a></li>
            <li><a href='pregled_moderatora.html' class="ponuda"><?= anchor("Admin/pregledmod", "Pregled moderatora") ?> </a></li>
            <li><a href='dodaj_moderatora.html' class="ponuda"> <?= anchor("Admin/registermod", "Dodaj moderatora") ?> </a></li>
            <li>
                <!--<a href='#' class="kontakt">Odjavi se</a>-->
                <?= anchor("Admin/logout", "Odjavi se") ?> 
            </li>
          </ul>
        </div>
        <div class=logo_naziv>
          <a href="index.html">
            <div class='logo_wrapper'>
              <h2 class="naziv">ČASKOM</h2>
            </div>
          </a>
        </div>
      </div>
      <div id=ad1>
        <img src="<?php echo base_url('images/watch1_1.png'); ?>" alt="" class='poz1'>
      </div>
</body>
</html>