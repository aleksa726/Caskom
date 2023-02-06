<!-- Sava Gavrić 0359/18 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('css/moderator/moderator_style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/moderator/meni.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/moderator/autorizacija.css'); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Autorizacija</title>
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
        <div class="auth_form">
            <?php 
                if (isset($kompanija)) {
                    echo
                    "<div class='reg_info'>
                        <h2>Ime firme:</h3>
                        <input id='ime' type='text' value='" . $kompanija->ime . "' disabled>
                        <h2>e-mail adresa firme:</h3>
                        <input id='e_mail' type='text' value='" . $kompanija->e_mail . "' disabled>
                        <h2>APR matični broj:</h3>
                        <input id='apr' type='text' value='" . $kompanija->apr . "' disabled>
                    </div>
                    <div class='form_btn'>
                        <button id='decision_allow'>Odobri</button>
                        <button id='decision_deny'>Odbij</button>
                    </div>";
                }
                else {
                    echo "<h1>Trenutno nema kompanija za autorizaciju.</h1>";
                }
            ?>
        </div>
    </div>
<script>
    var idK = 
    <?php 
        if (isset($kompanija)) echo $kompanija->idK; 
        else echo "null";
    ?>;

    $(function () {
        if (idK != null) {
            addEventListeners();
        }
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
        idK = response.idK;
        $("#ime")[0].value  = response.ime;
        $("#e_mail")[0].value  = response.e_mail;
        $("#apr")[0].value  = response.apr;
    }

    function noMoreWork() {
      $(".auth_form")[0].innerHTML = '';
      $(".auth_form").append('<h1>Trenutno nema kompanija za autorizaciju.</h1>');
    }

    function sendDecision(decision) {
        $.ajax({
            url:'<?php echo base_url("Moderator/autorizacija_odluka"); ?>',
            method: 'post',
            data: {'idK': idK, 'odluka': decision},
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