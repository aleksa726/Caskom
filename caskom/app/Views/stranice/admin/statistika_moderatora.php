<!-- Milica Milanovic 0601/18 -->
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>index</title>

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('css/admin/statistika_moderatora.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('css/admin/meni.css'); ?>">
 <script src="<?php echo base_url('css/admin/stat.js'); ?>"></script>
 

</head>
<body>
    <div id=ad12>
        <div id=levideo>
        <div id=lpoz>
            <label class="labela">
                Odaberi mesec:
            </label>
            <div id=ad20>
               <form name="loginform", action="<?= site_url("Admin/dugmestat") ?>" method="post">
                <div id = 'mainLista'>
                    <label class="custom-select" for="styledSelect1"><select id="styledSelect1" name="styledSelect1">
                        <option value="">
                            Izaberi mesec
                        </option>
                        <option >Januar</option>
                        <option >Februar</option>
                        <option >Mart</option>
                        <option >April</option>
                        <option >Maj</option>
                        <option >Jun</option>
                        <option >Jul</option>
                        <option >Avgust</option>
                        <option >Septembar</option>
                        <option >Oktobar</option>
                        <option >Novembar</option>
                        <option >Decembar</option>
                        </select>
                    </label>
                    <span style="color: red " ><?php if(!empty($errors['styledSelect1'])) echo $errors['styledSelect1']; ?></span>
                </div></div>
            
  
        

            <button class="btn btn-success" id=but1 type=submit> Potvrdi</button>

       
   

        </div>
        </div>
        <div id=desnideo>
<div id=dpoz>
    <label class="labela">
        Odaberi tip interakcije:
    </label>
<div id=ad13>
    <div id = 'mainLista2'>
        <label class="custom-select" for="styledSelect1"><select id="styledSelect2" name="styledSelect2">
                <option value="">
                    Odaberi tip
                </option>
                <option >Proverio članarine</option>
                <option >Proverio naloge</option>
                <option >Izašao na glasanje</option>
                <option >Proverio zahteve za isticanje</option>
                <option >Razmena poruka</option>
            </select>
        </label>
        <span style="color: red"><?php if(!empty($errors['styledSelect2'])) echo $errors['styledSelect2']; ?></span>
    </div>
<div id=ad14>
  

    <table class='upl'>
        
    <tr><th>Moderator:</th><th>Broj ostvarenih interakcija:</th><th>Procenat:</th> </tr>



    <?php $i=0;
foreach ($sviM as $moderatori) 
{
 echo "<tr><td font-color=white>{$moderatori->ime}</td><td font-color:white>{$broj[$i]}</td><td font-color=white>{$proc[$i]}</td>";
$i++;
}
?>

</table>
</div></form>
<div id=ad15></div>
<div id=ad16></div>
</div>
</div>
        </div>
    </div>

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


</body>
</html>