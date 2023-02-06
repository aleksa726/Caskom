<!-- Sava Gavrić 0359/18 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('css/moderator/moderator_style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/moderator/meni.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/moderator/provera.css'); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Provera</title>
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
        <div class="receipt_form">
            <div class="receipt_content">
                <?php 
                    if (isset($uplatnica)) {
                        $tip_html_sablon = null;
                        if ($tip == 2) $tip_html_sablon = "<h2>Isticanje šablon:</h2>";
                        else $tip_html_sablon = "<h2>Pretplata šablon:</h2>";
                        $svrha_html = null;
                        if ($tip == 2) $svrha_html = "<input id='svrha' type='text' value='Isticanje oglasa' disabled>";
                        else $svrha_html = "<input id='svrha' type='text' value='Pretplata' disabled>";
                        $tim_html_popunjeno = null;
                        if ($tip == 2) $tim_html_popunjeno = "<h2>Isticanje popunjeno:</h2>";
                        else $tim_html_popunjeno = "<h2>Pretplata popunjeno:</h2>";
                        echo 
                        "<h2 id='korisnicko_ime'><a href='" . site_url("Moderator/pregled_profila/$korisnik->idK") . "'>" . $korisnik->korisnicko_ime . "</a></h2>
                        " .
                        $tip_html_sablon . "
                        <div class='template'> 
                            <div class='template_item'>
                                <h3>Ime i prezime:</h3>
                                <input id='ime' type='text' value='" . $korisnik->ime . "' disabled>
                            </div> 
                            <div class='template_item'>
                                <h3>Svrha uplate:</h3>
                                " . 
                                $svrha_html . "
                            </div>
                            <div class='template_item'>
                                <h3>Primalac:</h3>
                                <input type='text' value='Časkom' disabled>
                            </div>
                            <div class='template_item'>
                                <h3>Iznos:</h3>
                                <input id='iznos' type='text' value='" . $uplatnica->cena . "' disabled>
                            </div>             
                        </div>
                        <div class='filed'>
                        " .
                            $tim_html_popunjeno . "
                            <img id='slika' src='" . base_url("$uplatnica->slika") . "'>
                        </div>";
                    }
                    else {
                        echo "<h1>Trenutno nema uplatnica za proveru.</h1>";
                    }
                ?>
            </div>
            <?php 
                if (isset($uplatnica)) {
                    echo
                    "<div class='receipt_btn_div'>
                        <button id='decision_allow'>Odobri</button>
                        <button id='decision_deny'>Odbij</button>
                    </div>";
                }
            ?>
        </div>
    </div>
<script>
    var base_url = '<?php echo base_url(); ?>';
    var site_url = '<?php echo site_url("Moderator/pregled_profila"); ?>';
    var idU = 
    <?php 
        if (isset($uplatnica)) echo $uplatnica->idU; 
        else echo "null";
    ?>;
    var tip = <?php echo $tip; ?>;
    
    $(function () {
        addEventListeners();
    });

    function addEventListeners() {
        $('#decision_allow').on('click', function () {
            sendDecision(true);
        });
        $('#decision_deny').on('click', function () {
            sendDecision(false);
        });
    }

    function loadNewData(response) {
        idU = response.idU;
        $("#korisnicko_ime")[0].innerHTML = '<a href="' + site_url + '/' + response.idK + '">' + response.korisnicko_ime + '</a>';
        $("#ime")[0].value  = response.ime;
        if (response.idO == null) $("#svrha")[0].value  = 'Pretplata';
        else $("#svrha")[0].value  = 'Isticanje oglasa';
        $("#iznos")[0].value  = response.cena;
        $("#slika")[0].src = base_url + '/' + response.slika;
    }

    function noMoreWork() {
        $(".receipt_content")[0].innerHTML = '';
        $(".receipt_btn_div").remove();
        $(".receipt_content").append('<h1>Trenutno nema uplatnica za proveru.</h1>');
    }

    function sendDecision(decision) {
        $.ajax({
            url:'<?php echo base_url("Moderator/provera_odluka"); ?>',
            method: 'post',
            data: {'idU': idU, 'tip': tip, 'odluka': decision},
            dataType: 'json',
            success: function(response) {
                if (response != null) loadNewData(response);
                else noMoreWork();
            },
            error : function(data) {
                noMoreWork();
            }
        });
    }

</script>
</body>
</html>