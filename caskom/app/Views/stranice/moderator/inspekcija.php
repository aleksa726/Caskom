<!-- Sava Gavrić 0359/18 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('css/moderator/moderator_style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/moderator/meni.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/moderator/inspekcija.css'); ?>">
    <title>Inspekcija</title>
</head>
<body>
    <div class="linija_menija">
        <div class="meni_info">
          <ul>
                <li><?= anchor("Moderator/autorizacija", "Autorizacija") ?></li>
                <li><?= anchor("Moderator/inspekcija", "Inspekcija") ?></li>
                <li>
                    <div class="dropdown">
                        <button class="drop_btn">Provera uplatnica</button>
                        <div class="dropdown-content">
                          <?= anchor("Moderator/provera_pretplate", "Pretplata") ?> 
                          <?= anchor("Moderator/provera_podizanja", "Isticanje oglasa") ?>
                        </div>
                      </div>
                </li>
                <li><?= anchor("Moderator/tehnicka_podrska", "Tehnička podrška") ?></li>
                <li>
                    <?= anchor("Moderator/logout", "Odjavi se") ?> 
                </li>
          </ul>
        </div>
        <div class="logo_naziv">
          <a href="<?php echo site_url("Moderator/index")?>">
            <div class="logo_wrapper">  
              <h2 class="naziv">ČASKOM</h2>
            </div>
          </a>
        </div>
    </div>
    <div class="content">
        <div class="inspect_div">
                <?php 
                    if (!empty($naloziInspekcija)) {
                        echo
                        "<div class='inspect_table'>
                            <div class='inspect_table_heading'>
                                <div class='name_header'>
                                    <h2>Korisnik</h2>
                                </div>
                                <div class='vote_header'>
                                    <h2>Ukinuti nalog</h2>
                                </div>
                            </div>
                        ";
                        $odluka_url = base_url("Moderator/inspekcija_odluka");
                        foreach ($naloziInspekcija as $nalog) {
                            echo
                            "<div class='inspect_table_row'>
                                <div class='user'>
                                    <a href='" . site_url("Moderator/pregled_profila/$nalog->idK") . "'><h3>{$nalog->korisnicko_ime}</h3></a>
                                </div>
                                <div class='buttons'>
                                    <a href='{$odluka_url}/{$nalog->idK}/da'>
                                        <button class='btn_yes'>Da</button>
                                    </a>
                                    <a href='{$odluka_url}/{$nalog->idK}/ne'>
                                        <button class='btn_no'>Ne</button>
                                    </a>
                                </div>
                            </div>";
                        }
                        unset($nalog);
                        echo
                        "</div>";
                    }
                    else {
                        echo "<h1 class='notify_empty'>Trenutno nema naloga za inspekciju.</h1>";
                    }
                ?>
        </div>
    </div>
</body>
</html>