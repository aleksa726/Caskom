<!-- Sava Gavrić 0359/18 -->
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Moj profil</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('css/moderator/meni.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/body.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/moderator/profil_korisnika.css'); ?>">
</head>
<body>
    <div class="cela_strana_moj_profil">
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
        <div class="wrapper_moj_profil">
            <div class="desno_moj_profil">
                <h1 class='naslov_sekcije'>Osnovne informacije</h1>
                <hr>
                <div class="informacije_profila">
                    <div class="profilna_slika">
                        <img src="<?php echo base_url('images/account_picture.png'); ?>" alt="">
                    </div>
                    <div class="podaci_profila">
                        <span><?php echo $korisnik->korisnicko_ime; ?></span></br></br>
                        <span><?php echo $korisnik->ime; ?></span></br></br>
                        <span><?php echo $korisnik->e_mail; ?></span></br></br>
                        <span><?php if($korisnik->vidljiv_telefon == true) echo $korisnik->telefon; ?></span>
                    </div>
                </div>
                <h1 class='naslov_sekcije'>Ocene</h1>
                <hr>
                <div class="recenzije_profila">
                    <span>Prosečna ocena: 
                        <span class="ocena_broj" style="color: #c2983d; font-size: 1.6vw; font-weight: bold;">
                            <?php {
                                if(count($recenzije) > 0) echo "$prosek/5.0";
                                else echo "Nema ocena";
                            } ?>
                        </span>
                    </span>
                    </br>
                        <span>Ukupno ocena: 
                            <span class="ocena_broj"
                                style="color: #c2983d; font-size: 1.6vw; font-weight: bold;"><?php echo $brojRecenzija; ?>
                            </span> 
                        </span>
                    <div class="odeljak_recenzija">
                        <?php
                            if (!empty($recenzije)) {
                                foreach ($recenzije as $recenzija) {
                                    echo 
                                    "<div class='div_recenzije'>
                                        <span class='username_korisnika_recenzije'>
                                            $recenzija->korisnicko_ime
                                        </span>
                                        <span class='ocena_recenizje'>
                                            $recenzija->ocena/5.0
                                        </span>
                                        <span class='tekst_recenzije'>
                                            $recenzija->tekst;
                                        </span>
                                    </div>";
                                }
                            }
                            else echo "<h1 style='color:rgb(210,210,210);'>Trenutno nema recenzija za prikaz.</h1>";
                        ?>
                    </div>
                </div>
                <div class="page_buttons"> <!-- TODO dodati uslove za disable -->
                        <a href="<?php 
                            $nextPage = $pageNum;
                            if ($nextPage > 0) $nextPage--;
                            echo site_url("Moderator/pregled_profila/$korisnik->idK/$nextPage");
                        ?>">
                            <button><h3>Prethodna strana</h3></button>
                        </a>
                        <a href="<?php
                            $nextPage = $pageNum + 1;
                            echo site_url("Moderator/pregled_profila/$korisnik->idK/$nextPage");
                        ?>">
                            <button><h3>Sledeća strana</h3></button>
                        </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>