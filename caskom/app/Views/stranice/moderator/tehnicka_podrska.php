<!-- Sava Gavrić 0359/18 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('css/moderator/moderator_style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/moderator/meni.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/moderator/tehnicka_podrska.css'); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <title>Tehnicka podrska</title>
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
        <div class="tickets_div">
            <div class="ticket_count_div">
                <h2>Nepreuzeti ticket-i:</h2>
                <input id="convo_count" type="text" value="<?php echo $brojNepreuzetih; ?>" disabled>
                <button id="takeConvo">Preuzmi razgovor</button>
            </div>
            <div class="ticket_list">
                <?php 
                  if (!empty($poslednjePoruke)) {
                      foreach ($poslednjePoruke as $poruka) {
                          echo 
                          "<div class='ticket {$poruka->idRa}'>
                              <p>{$poruka->tekst}</p>
                          </div>";
                      }
                  }
                ?>
            </div>
        </div>
        <div class="chat_div">
            <div id="messages_div">
                <?php 
                  if (isset($porukePoslednjeg) && count($porukePoslednjeg)) {
                      foreach ($porukePoslednjeg as $poruka) {
                          $ownerClass = '';
                          if ($poruka->tip_autora == true) $ownerClass = 'their_msg';
                          else $ownerClass = 'my_msg';
                          echo 
                          "<div class='msg $ownerClass'>
                              $poruka->tekst
                          </div>";
                      }
                  }
                ?>
            </div>
            <div class="input_div">
              <button id="end_button">Završi razgovor</button>
              <textarea id="input_msg" name="input_msg"></textarea>
              <button value="Button" id="input_button">&#x27A3;</button>
            </div>
        </div>
    </div>
<script>
    var activeChatCount = null;
    var freeChatCount = null;
    var conn = null;
    var currentChat = null;
    $(function () {
        openConnection();
        scrollMsgBottom();
        activeChatCount = <?php 
            if (!empty($poslednjePoruke)) echo count($poslednjePoruke);
            else echo 0;
         ?>;
        freeChatCount = <?php echo $brojNepreuzetih; ?>;
        currentChat = <?php 
            if (!empty($poslednjePoruke)) echo $poslednjePoruke[count($poslednjePoruke) - 1]->idRa . ";";
            else echo "null;";
        ?>
        addEventListeners();
    })
    
    function openConnection() {
        conn = new WebSocket('ws://localhost:8081?access_token=<?= session()->get('moderator')->idM ?>&client_type=0');
        conn.onopen = function(e) {
            console.log("Connection established!");
        };
        conn.onmessage = function(e) {
            let data = JSON.parse(e.data);
            if (!('method' in data)) return;
            if (data.method.localeCompare("MSG") == 0) {
                updateTickets(data.idRa, data.message, true);
                if (data.idRa == currentChat) {
                    newMessage(data.message);
                }
            }
            else if (data.method.localeCompare("GET") == 0){
                clearChat();
                currentChat = data.idRa;
                for (let i = 0; i < data.messages.length; i++) {
                    if (data.messages[i].tip_autora == true)
                        newMessage(data.messages[i].message);
                    else {
                        myMessage(data.messages[i].message);
                    }
                }
                if (isNewChat(data.idRa)) addChatToList(data.idRa, data.messages[data.messages.length - 1].message);
            }
        };
    }

    function addEventListeners() {
        $('#takeConvo').on('click', function () {
            let pckg = [<?= session()->get('moderator')->idM ?>, 0, "GET", null];
            conn.send(JSON.stringify(pckg));
            if (freeChatCount > 0) {
                $('#convo_count')[0].value = (freeChatCount - 1);
                freeChatCount--;
            }
        });

        $('#input_button').on('click', function () {
            if (conn != null && currentChat != null) {
                let msg = $('#input_msg').val();
                if (msg.trim() == '') return false;
                if (msg.length > 255) msg = msg.substring(0, 255);
                let pckg = [<?= session()->get('moderator')->idM ?>, 0, msg, currentChat];
                conn.send(JSON.stringify(pckg));
                updateTickets(currentChat, msg, false);
                myMessage(msg);
                $('#input_msg').val('');
            }
        });

        $('#end_button').on('click', function () {
            if (conn != null && currentChat != null) {
                let pckg = [<?= session()->get('moderator')->idM ?>, 0, "END", currentChat];
                conn.send(JSON.stringify(pckg));
                deleteTicket(currentChat);
                currentChat = null;
                $('#input_msg').val('');
                clearChat();
            }
        });

        let tickets = document.getElementsByClassName("ticket");
        for (let i = 0; i < tickets.length; i++) {
            tickets[i].addEventListener('click', ticketClicked, false);
        }
    }

    function newMessage(msg) {
      html = '<div class="msg their_msg">' + msg + '</div>';
      $('#messages_div').append(html);
      scrollMsgBottom();
    }

    function myMessage(msg) {
      html = '<div class="msg my_msg">' + msg + '</div>';
      $('#messages_div').append(html);
      scrollMsgBottom();
    }
 
    function updateTickets(idRa, msg, isTheirMsg) {
        let tickets = document.getElementsByClassName("ticket");
        for (let i = 0; i < tickets.length; i++) {
            if (tickets[i].classList.contains(idRa)) {
                tickets[i].innerHTML = msg;
                if (isTheirMsg && !tickets[i].classList.contains(currentChat)) tickets[i].classList.add('new_msg');
                break;
            }
        }
    }

    function scrollMsgBottom() {
        var d = $('#messages_div');
        d.scrollTop(d.prop("scrollHeight"));
    }

    function clearChat() {
        $("#messages_div")[0].innerHTML = '';
    }

    function isNewChat(idRa) {
        let flag = true;
        let tickets = document.getElementsByClassName("ticket");
        for (let i = 0; i < tickets.length; i++) {
            if (tickets[i].classList.contains(idRa)) {
                flag = false;
                break;
            }
        }
        return flag;
    }

    function addChatToList(idRa, msg) {
        html = '<div class="ticket ' + idRa +'">' + msg + '</div>';
        $('.ticket_list').append(html);
        let tickets = document.getElementsByClassName("ticket");
        tickets[tickets.length - 1].addEventListener('click', ticketClicked, false);
        tickets[tickets.length - 1].classList.toggle("new_msg");
    }

    function ticketClicked() {
        let classNames = this.className.split(" ");
        let pckg = [<?= session()->get('moderator')->idM ?>, 0, "GET", classNames[1]];
        conn.send(JSON.stringify(pckg));
        currentChat = classNames[1];
        if (this.classList.contains("new_msg")) this.classList.toggle("new_msg");
    }

    function deleteTicket(idRa) {
        let ticket_list = document.getElementsByClassName("ticket_list")[0];
        let tickets = document.getElementsByClassName("ticket");
        for (let i = 0; i < tickets.length; i++) {
            if (tickets[i].classList.contains(idRa)) {
                ticket_list.removeChild(tickets[i]);
                break;
            }
        }
    }
</script>
</body>
</html>