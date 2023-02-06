<?php namespace App\Controllers;
//Milica Milanovic 0601/18 
/*Marija Dobric 0417/18*/
use App\Models\AdminModel;
use App\Models\ModeratorModel;
use App\Models\UplatnicaModel;
use App\Models\OglasModel;
use App\Models\KorisnikModel;
use App\Models\GlasaoModel;
use App\Models\GlasanjeModel;
use App\Models\OpsluzioModel;
class Admin extends BaseController {
        
    /**
     * index - prikaz pocetne stranice
     *
     * @return void
     */
    public function index() {
        return view('stranice/admin/Admin pocetna');
    }
        
    /**
     * logout - metoda za odjavljivanje sa naloga
     *
     * @return void
     */
    public function logout() { /* ovo bi moglo da se izvuce kao zajednicka metoda */
        $this->session->destroy();
        return redirect()->to(site_url('/'));
    }

       
   /**
    * prikaz - metoda za prikazivanje odredjene strane sa prosledjenim podacima
    *
    * @param  mixed $page - putanja do stranica 
    * @param  mixed $data - podaci za prosledjivanje
    * @return void
    */
   protected function prikaz($page, $data) {
    $data['admin']=$this->session->get('admin');
  //  $data['autor']=$this->session->get('autor');
   // echo view('sablon/header_korisnik',$data);
    echo view("stranice/$page", $data);
    //echo view('sablon/footer');
}


    
    /**
     * registermod - prikaz stranice za Dodavanje moderatora
     *
     * @return void
     */
    public function registermod() {
        return view('stranice/admin/dodaj_moderatora');
   }   
   /**
    * stat- prikaz stranice sa Statistikom moderatora
    *
    * @return void
    */
   public function stat()
   {$moderatorModel=new ModeratorModel();
    $sviM=$moderatorModel->where('obrisan',0)->findAll();
    $arr=array();
    $niz=array();
    foreach($sviM as $b)
    {array_push($arr,0);
    array_push($niz,0);
}
    
    $this->prikaz('admin/statistika_moderatora',['sviM'=>$sviM, 'broj'=>$arr, 'proc'=>$niz]);
   }

      
   /**
    * pregledmod - prikaz stranice Pregled moderatora 
    *
    * @return void
    */
   public function pregledmod()
   {
    $moderatorModel=new ModeratorModel();
    $sviM=$moderatorModel->where('obrisan',0)->findAll();
   $this->prikaz('admin/pregled_moderatora',['sviM'=>$sviM]);
  //  return view('stranice/admin/pregled_moderatora');
   }

      
   /**
    * register_moderator - funkcija koja se poziva klikom na dugme za dodavanje moderatora, ubacuje moderatora u sistem i bazu
    *
    * @return void
    */
   public function register_moderator() {

    $validation =  \Config\Services::validation();
    $validation->setRules([   // pravila - TODO treba ih dodati jos
            'ime' => 'required|min_length[3]|max_length[15]',
            'prezime' => 'required|min_length[3]|max_length[15]',
            'e_mail' => 'required|valid_email',
            'korisnicko_ime' => 'required|min_length[3]|max_length[15]',
            'lozinka' => 'required|min_length[8]|max_length[15]',
           
        ],
        [   // greske
            'ime' => [
                'required' => 'Puno ime je obavezno polje!',
                'min_length'=>'Ime mora sadržati više od 3 karaktera',
                'max_length'=>'Ime mora sadržati manje od 15 karaktera'
            ],
            'prezime' => [
                'required' => 'Prezime je obavezno polje!',
                'min_length'=>'Prezime mora sadržati više od 3 karaktera',
                'max_length'=>'Prezime mora sadržati manje od 15 karaktera'
            ],
            'e_mail' => [
                'required' => 'E-mail je obavezno polje!',
                'valid_email' =>'Nije uneta ispravna e-mail adresa!'
            ],
            'korisnicko_ime' => [
                'required' => 'Korisnicko ime je obavezno polje!',
                'min_length'=>'Korisničko ime mora sadržati više od 3 karaktera',
                'max_length'=>'Korisničko ime mora sadržati manje od 15 karaktera'
            ],
            'lozinka' => [
                'required' => 'Lozinka je obavezno polje!',
                'min_length'=>'Lozinka mora sadržati više od 7 karaktera',
                'max_length'=>'Lozinka mora sadržati manje od 15 karaktera'
            ]
          
        ]        
    );
    if (!$validation->withRequest($this->request)->run()) {
        return view('stranice/admin/dodaj_moderatora', ['errors'=>$validation->getErrors()]);
    }
   





    $modModel=new ModeratorModel();


    $mod=$modModel->where('korisnicko_ime', $this->request->getVar('korisnicko_ime'))->first();
    if($mod!=null){ return view('stranice/admin/dodaj_moderatora',['poruka'=>'Korisničko ime je zauzeto!']);  }

    $mode=$modModel->where('e_mail', $this->request->getVar('e_mail'))->first();
    if($mode!=null){return view('stranice/admin/dodaj_moderatora',['poruka1'=>'E-mail adresa je zauzeta!']);}

    $modModel->save([
        'ime'=>$this->request->getVar('ime') ." ". $this->request->getVar('prezime'),
     //   'preime'=>$this->request->getvar('prezime'),
        'e_mail'=>$this->request->getVar('e_mail'),
        'korisnicko_ime'=>$this->request->getVar('korisnicko_ime'),
         'obrisan'=>false,
 
        'lozinka'=>$this->request->getVar('lozinka'),
   //  'autor'=>$this->session->get('autor')->korisnicko_ime
    ]);
  //  $this->session->set('moderator',$this->request->getVar('e_mail'));
    return view('stranice/admin/dodaj_moderatora',['poruka2'=>'Moderator je uspešno dodat!']);
   }   


   /**
    * delete_moderator - funkcija koja se poziva klikom na dugme za uklnajanje moderatora
    *
    * @return void
    */
   public function delete_moderator(){



    $validation =  \Config\Services::validation();
    $validation->setRules([   // pravila - TODO treba ih dodati jos
        'ime' => 'required|min_length[3]|max_length[15]',
        'prezime' => 'required|min_length[3]|max_length[15]',
        'e_mail' => 'required|valid_email',
            'korisnicko_ime' => 'required|min_length[3]|max_length[15]',
          
           
        ],
        [   // greske
            'ime' => [
                'required' => 'Puno ime je obavezno polje!',
                'min_length'=>'Ime mora sadržati više od 3 karaktera',
                'max_length'=>'Ime mora sadržati manje od 15 karaktera'
            ],
            'prezime' => [
                'required' => 'Prezime je obavezno polje!',
                'min_length'=>'Prezime mora sadržati više od 3 karaktera',
                'max_length'=>'Prezime mora sadržati manje od 15 karaktera'
            ],
            'e_mail' => [
                'required' => 'E-mail je obavezno polje!',
                'valid_email' =>'Nije uneta ispravna e-mail adresa!'
            ],
            'korisnicko_ime' => [
                'required' => 'Korisnicko ime je obavezno polje!',
                'min_length'=>'Korisničko ime mora sadržati više od 3 karaktera',
                'max_length'=>'Korisničko ime mora sadržati manje od 15 karaktera'
            ]
          
        ]        
    );


    if (!$validation->withRequest($this->request)->run()) {

        $moderatorModel=new ModeratorModel();
        $sviM=$moderatorModel->where('obrisan',0)->findAll();
        return view('stranice/admin/pregled_moderatora', ['sviM'=>$sviM,'errors'=>$validation->getErrors()]);
    }



       $modModel=new ModeratorModel();
       $mod=$modModel->where('korisnicko_ime', $this->request->getVar('korisnicko_ime'))->first();
       if($mod==null)
       {
        $moderatorModel=new ModeratorModel();
        

        $sviM=$moderatorModel->where('obrisan',0)->findAll();
        $this->prikaz('admin/pregled_moderatora',['sviM'=>$sviM, 'poruka'=>'Korisničko ime ne postoji!']);
       }else{

        $ime=$mod->ime;
        $mejl=$mod->e_mail;
       
        $unet=$this->request->getVar('ime') .' '.$this->request->getVar('prezime');
        if($ime==$unet && $mejl==$this->request->getVar('e_mail'))
       { $modModel->where('korisnicko_ime',$this->request->getvar('korisnicko_ime'))->set(['obrisan'=> 1])->update();
           $moderatorModel=new ModeratorModel();
           $sviM=$moderatorModel->where('obrisan',0)->findAll();
       $this->prikaz('admin/pregled_moderatora',['sviM'=>$sviM,'poruka1'=>'Moderator uspešno uklonjen']);}
else{

    $moderatorModel=new ModeratorModel();
        

    $sviM=$moderatorModel->where('obrisan',0)->findAll();
    $this->prikaz('admin/pregled_moderatora',['sviM'=>$sviM, 'poruka'=>'Niste uneli pravilno Ime i Prezime']);
}


       }


    //   $modModel->where('korisnicko_ime',$this->request->getvar('korisnicko_ime'))->delete();
   //    $moderatorModel=new ModeratorModel();
     //  $sviM=$moderatorModel->findAll();
      // $this->prikaz('admin/pregled_moderatora',['sviM'=>$sviM]);
     //  return view('stranice/admin/pregled_moderatora');
   }
   
   /**
    * sviMod - funkcija koja prikazuje stranicu sa svim moderatorima izlistanim
    *
    * @return void
    */
   public function sviMod(){
       $mMod=new ModeratorModel();
       $modmod=$mMod->dohvMod();
       $this->prikaz('stranice/admin/pregled_moderatora',$modmod);
   }
   
   /**
    * nadjiuMesecu - prebrojava u promenljivojj br koliko ima u odredjenom mesecu pojavljivanja datog moderatora pri generisanju broja proverenih uplatnica
    *
    * @param  mixed $mesec - odabrani mesec iz padajuce liste
    * @param  mixed $mod - prosledjen odredjeni moderator 
    * @param  mixed $br - promenljiva u kojoj se cuva pojavljivanje datog moderatora u tabeli
    * @return void
    */
   public function nadjiuMesecu($mesec, $mod, &$br)
   {
$prom;
    if($mesec=='Januar'){ $prom='01';}
    if($mesec=='Februar'){ $prom='02';}
    if($mesec=='Mart'){ $prom='03';}
    if($mesec=='April'){ $prom='04';}
    if($mesec=='Maj'){ $prom='05';}
    if($mesec=='Jun'){ $prom='06';}
    if($mesec=='Jul'){ $prom='07';}
    if($mesec=='Avgust'){ $prom='08';}
    if($mesec=='Septembar'){ $prom='09';}
    if($mesec=='Oktobar'){ $prom='10';}
    if($mesec=='Novembar'){ $prom='11';}
    if($mesec=='Decembar'){ $prom='12';}
       $upl=new UplatnicaModel();
      $svU=$upl->where('idM',$mod)->findAll();
      foreach($svU as $jedna)
    { $datum=$jedna->vreme_odluke;
      $datum=date("yyyy-mm-dd hh:mm:ss",0);
      $datum=explode(" ",$jedna->vreme_odluke);
      $drdatum=explode("-",$datum[0]);
      if($drdatum[1]==$prom )
     { 
         if($jedna->idO==NULL)
        {
            if($jedna->odluka==1)
            
           { $br++;}
        
        }
    
    
    }
    }
   }
 /**
    * nadjiuMesecu4 - prebrojava u promenljivojj br koliko ima u odredjenom mesecu pojavljivanja datog moderatora pri generisanju broja proverenih zahteva za isticanje
    *
    * @param  mixed $mesec - odabrani mesec iz padajuce liste
    * @param  mixed $mod - prosledjen odredjeni moderator 
    * @param  mixed $br - promenljiva u kojoj se cuva pojavljivanje datog moderatora u tabeli Uplatnica
    * @return void
    */


   public function nadjiuMesecu4($mesec, $mod, &$br)
   {
$prom;
    if($mesec=='Januar'){ $prom='01';}
    if($mesec=='Februar'){ $prom='02';}
    if($mesec=='Mart'){ $prom='03';}
    if($mesec=='April'){ $prom='04';}
    if($mesec=='Maj'){ $prom='05';}
    if($mesec=='Jun'){ $prom='06';}
    if($mesec=='Jul'){ $prom='07';}
    if($mesec=='Avgust'){ $prom='08';}
    if($mesec=='Septembar'){ $prom='09';}
    if($mesec=='Oktobar'){ $prom='10';}
    if($mesec=='Novembar'){ $prom='11';}
    if($mesec=='Decembar'){ $prom='12';}
       $upl=new UplatnicaModel();
      $svU=$upl->where('idM',$mod)->findAll();
      foreach($svU as $jedna)
    { $datum=$jedna->vreme_odluke;
      $datum=date("yyyy-mm-dd hh:mm:ss",0);
      $datum=explode(" ",$jedna->vreme_odluke);
      $drdatum=explode("-",$datum[0]);
      if($drdatum[1]==$prom )
     { 
         if($jedna->idO!=NULL)
        {

            if($jedna->odluka==1)
            {$br++;}
        }
    
    
    }
    }
   }

 /**
    * nadjiuMesecu2 - prebrojava u promenljivojj br koliko ima u odredjenom mesecu pojavljivanja datog moderatora pri generisanju broja proverenih naloga pravnih lica
    *
    * @param  mixed $mesec - odabrani mesec iz padajuce liste
    * @param  mixed $mod - prosledjen odredjeni moderator 
    * @param  mixed $br - promenljiva u kojoj se cuva pojavljivanje datog moderatora u tabeli Korisnik
    * @return void
    */
   public function nadjiuMesecu2($mesec, $mod, &$br)
   {
$prom;
    if($mesec=='Januar'){ $prom='01';}
    if($mesec=='Februar'){ $prom='02';}
    if($mesec=='Mart'){ $prom='03';}
    if($mesec=='April'){ $prom='04';}
    if($mesec=='Maj'){ $prom='05';}
    if($mesec=='Jun'){ $prom='06';}
    if($mesec=='Jul'){ $prom='07';}
    if($mesec=='Avgust'){ $prom='08';}
    if($mesec=='Septembar'){ $prom='09';}
    if($mesec=='Oktobar'){ $prom='10';}
    if($mesec=='Novembar'){ $prom='11';}
    if($mesec=='Decembar'){ $prom='12';}
       $kor=new KorisnikModel();
      $svK=$kor->where('idM',$mod)->findAll();
    //  $sviKor=$svK->where('vreme_odobrenja', !null)->findAll();
      foreach($svK as $jedna)
    { 
        if($jedna->apr != null)
       { $datum=$jedna->vreme_odluke;
      $datum=date("yyyy-mm-dd hh:mm:ss",0);
      $datum=explode(" ",$jedna->vreme_odluke);
      $drdatum=explode("-",$datum[0]);
      if($drdatum[1]==$prom )
     { 
            if($jedna->odobren==1 || $jedna->odobren==0)
            {$br++;}
    }
    }}
   }

    /**
    * nadjiuMesecu3 - prebrojava u promenljivoj br koliko ima u odredjenom mesecu pojavljivanja datog moderatora pri generisanju broja glasanja prilikom inspekcije
    *
    * @param  mixed $mesec - odabrani mesec iz padajuce liste
    * @param  mixed $mod - prosledjen odredjeni moderator 
    * @param  mixed $br - promenljiva u kojoj se cuva pojavljivanje datog moderatora u tabeli Glasao
    * @return void
    */
   public function nadjiuMesecu3($mesec, $mod, &$br)
   {
$prom;
    if($mesec=='Januar'){ $prom='01';}
    if($mesec=='Februar'){ $prom='02';}
    if($mesec=='Mart'){ $prom='03';}
    if($mesec=='April'){ $prom='04';}
    if($mesec=='Maj'){ $prom='05';}
    if($mesec=='Jun'){ $prom='06';}
    if($mesec=='Jul'){ $prom='07';}
    if($mesec=='Avgust'){ $prom='08';}
    if($mesec=='Septembar'){ $prom='09';}
    if($mesec=='Oktobar'){ $prom='10';}
    if($mesec=='Novembar'){ $prom='11';}
    if($mesec=='Decembar'){ $prom='12';}
       $glasao=new GlasaoModel();
       $glasanje=new GlasanjeModel();
      $svG=$glasao->where('idM',$mod)->findAll();
      foreach($svG as $jedna)
    {  // var_dump($svG);
        //var_dump($mod);
//     $pr1=$glasanje->where('idGl',$jedna->idGl)->findAll();
  //      var_dump($pr1);
    //    var_dump($pr1->idGl);
       // $datum=$pr1->vreme_pocetka;
      $datum=date("yyyy-mm-dd hh:mm:ss",0);
      $datum=explode(" ",$jedna->vreme_glasanja);
      $drdatum=explode("-",$datum[0]);
      if($drdatum[1]==$prom )
     {    
        $br++;
    }
    }
   }
    /**
    * nadjiuMesecu5 - prebrojava u promenljivojj br koliko ima u odredjenom mesecu pojavljivanja datog moderatora pri generisanju broja razmenjenih poruka u okviru tehnicke podrske
    *
    * @param  mixed $mesec - odabrani mesec iz padajuce liste
    * @param  mixed $mod - prosledjen odredjeni moderator 
    * @param  mixed $br - promenljiva u kojoj se cuva pojavljivanje datog moderatora u tabeli Opsluzio
    * @return void
    */
   public function nadjiuMesecu5($mesec, $mod, &$br)
   {
$prom;
    if($mesec=='Januar'){ $prom='01';}
    if($mesec=='Februar'){ $prom='02';}
    if($mesec=='Mart'){ $prom='03';}
    if($mesec=='April'){ $prom='04';}
    if($mesec=='Maj'){ $prom='05';}
    if($mesec=='Jun'){ $prom='06';}
    if($mesec=='Jul'){ $prom='07';}
    if($mesec=='Avgust'){ $prom='08';}
    if($mesec=='Septembar'){ $prom='09';}
    if($mesec=='Oktobar'){ $prom='10';}
    if($mesec=='Novembar'){ $prom='11';}
    if($mesec=='Decembar'){ $prom='12';}
      $op=new OpsluzioModel();
      $svG=$op->where('idM',$mod)->findAll();
      foreach($svG as $jedna)
    {  // var_dump($svG);
        //var_dump($mod);
//     $pr1=$glasanje->where('idGl',$jedna->idGl)->findAll();
  //      var_dump($pr1);
    //    var_dump($pr1->idGl);
       // $datum=$pr1->vreme_pocetka;
      $datum=date("yyyy-mm-dd hh:mm:ss",0);
      $datum=explode(" ",$jedna->vreme_kraja);
      $drdatum=explode("-",$datum[0]);
      if($drdatum[1]==$prom )
     {    
        $br++;
    }
    }
   }


   
   /**
    * dugmestat - funkcija koja generise pregled rada moderatora za izabrani mesec i izabranu karakteristiku po broju interakcija i procentu
    *
    * @return void
    */
   public function dugmestat()
{

    $validation =  \Config\Services::validation();
    $validation->setRules([   // pravila - TODO treba ih dodati jos
            'styledSelect1' => 'required',
            'styledSelect2' => 'required',
           
          
           
        ],
        [   // greske
            'styledSelect1' => [
                'required' => 'Nije izabran mesec!'
            ],
            'styledSelect2' => [
                'required' => 'Nije odabran tip!'
            ],
          
        ]        
    );

   
    if (!$validation->withRequest($this->request)->run()) {
        $modModel=new ModeratorModel();
        $sviM=$modModel->where('obrisan',0)->findAll();
        $arr=array();
        $nizP=array();
        foreach($sviM as $b)
        {array_push($arr,0);
        array_push($nizP,0);}


        return view('stranice/admin/statistika_moderatora', ['errors'=>$validation->getErrors(), 'sviM'=>$sviM,'broj'=>$arr, 'proc'=>$nizP]);
    }

    $modModel=new ModeratorModel();
    $sviM=$modModel->where('obrisan',0)->findAll();
    $mesec=$this->request->getVar('styledSelect1');
    $tip=$this->request->getVar('styledSelect2');
if($tip=='Proverio članarine')
{
$this->clanarina($sviM, $mesec);
}
if($tip=='Proverio zahteve za isticanje')
{
$this->istic($sviM, $mesec);
}
if($tip=="Proverio naloge")
{
$this->prNalozi($sviM,$mesec);

}
if($tip=="Izašao na glasanje")
{

    $this->prGlasanje($sviM,$mesec);

}
if($tip=="Razmena poruka")
{

    $this->prPoruke($sviM,$mesec);

}


}
/**
 * prPoruke - funkcija koja vraca pregled moderatora na osnovu odredjenog meseca i odabrane karakteristike "Razmena poruka"
 * izlistava za svakog moderatora koliko je Razmenio poruka u odredjenom mesecu.
 *
 * @param  mixed $sviM - niz svih aktivnih moderatora
 * @param  mixed $mesec - prosledjen odabran mesec
 * @return void
 */
public function prPoruke($sviM, $mesec){

    $arr=array();
    $brojM=0; 
    foreach ($sviM as $moderator)
    {
      
        $brojjednog=0;
        $this->nadjiuMesecu5($mesec,$moderator->idM,$brojjednog);
        $arr[$brojM]=$brojjednog;
        //array_push($arr,$brojjednog);
         $brojM++;
    }
    $nizP=array();
$nizP[0]=5;
$nizP[1]=5;
$this->proc($nizP, $arr,$brojM);   
 $modModel=new ModeratorModel();
$sviM=$modModel->where('obrisan',0)->findAll();
//return view('admin/statistika_moderatora', ['sviM'=>$sviM, 'broj'=>$arr, 'proc'=>$nizP]);
$this->prikaz('admin/statistika_moderatora',['sviM'=>$sviM, 'broj'=>$arr, 'proc'=>$nizP]);

}

/**
 * prGlasanje - funkcija koja vraca pregled moderatora na osnovu odredjenog meseca i odabrane karakteristike "Izasao na glasanje"
 * izlistava za svakog moderatora koliko je Glasao u odredjenom mesecu.
 *
 * @param  mixed $sviM - niz svih aktivnih moderatora
 * @param  mixed $mesec - prosledjen odabran mesec
 * @return void
 */

public function prGlasanje($sviM, $mesec){

    $arr=array();
    $brojM=0; 
    foreach ($sviM as $moderator)
    {
      
        $brojjednog=0;
        $this->nadjiuMesecu3($mesec,$moderator->idM,$brojjednog);
        $arr[$brojM]=$brojjednog;
        //array_push($arr,$brojjednog);
         $brojM++;
    }
    $nizP=array();
$nizP[0]=5;
$nizP[1]=5;
$this->proc($nizP, $arr,$brojM);   
 $modModel=new ModeratorModel();
$sviM=$modModel->where('obrisan',0)->findAll();
//return view('admin/statistika_moderatora', ['sviM'=>$sviM, 'broj'=>$arr, 'proc'=>$nizP]);
$this->prikaz('admin/statistika_moderatora',['sviM'=>$sviM, 'broj'=>$arr, 'proc'=>$nizP]);

}
/**
 * prNalozi - funkcija koja vraca pregled moderatora na osnovu odredjenog meseca i odabrane karakteristike "Proverio naloge"
 * izlistava za svakog moderatora koliko je Proverio naloga u odredjenom mesecu.
 *
 * @param  mixed $sviM - niz svih aktivnih moderatora
 * @param  mixed $mesec - prosledjen odabran mesec
 * @return void
 */
public function prNalozi($sviM,$mesec){

$kor=new KorisnikModel();
$arr=array();
$brojM=0;
foreach ($sviM as $moderator)
{
  
    $brojjednog=0;
    $this->nadjiuMesecu2($mesec,$moderator->idM,$brojjednog);
    $arr[$brojM]=$brojjednog;
    //array_push($arr,$brojjednog);
     $brojM++;
}
$nizP=array();
$nizP[0]=5;
$nizP[1]=5;
$this->proc($nizP, $arr,$brojM);   
 $modModel=new ModeratorModel();
$sviM=$modModel->where('obrisan',0)->findAll();
//return view('admin/statistika_moderatora', ['sviM'=>$sviM, 'broj'=>$arr, 'proc'=>$nizP]);
$this->prikaz('admin/statistika_moderatora',['sviM'=>$sviM, 'broj'=>$arr, 'proc'=>$nizP]);
}



/**
 * clanarina - funkcija koja vraca pregled moderatora na osnovu odredjenog meseca i odabrane karakteristike "Proverio clanarine"
 * izlistava za svakog moderatora koliko je Proverio clanarina i odobrio/odbio u odredjenom mesecu.
 *
 * @param  mixed $sviM - niz svih aktivnih moderatora
 * @param  mixed $mesec - prosledjen odabran mesec
 * @return void
 */
public function clanarina($sviM,$mesec){


    $upl=new UplatnicaModel();
    $arr=array();
    $brojM=0;
    foreach ($sviM as $moderator)
    {
      
        $brojjednog=0;
        $this->nadjiuMesecu($mesec,$moderator->idM,$brojjednog);
        $arr[$brojM]=$brojjednog;
        //array_push($arr,$brojjednog);
         $brojM++;
    }
    $nizP=array();
    $nizP[0]=5;
    $nizP[1]=5;
    $this->proc($nizP, $arr,$brojM);   
     $modModel=new ModeratorModel();
    $sviM=$modModel->where('obrisan',0)->findAll();
    //return view('admin/statistika_moderatora', ['sviM'=>$sviM, 'broj'=>$arr, 'proc'=>$nizP]);
    $this->prikaz('admin/statistika_moderatora',['sviM'=>$sviM, 'broj'=>$arr, 'proc'=>$nizP]);
    

}
/**
 * istic - funkcija koja vraca pregled moderatora na osnovu odredjenog meseca i odabrane karakteristike "Proverio zahteve za isticanja"
 * izlistava za svakog moderatora koliko je odbio/odobrio zahteva za isticanja u odredjenom mesecu.
 *
 * @param  mixed $sviM - niz svih aktivnih moderatora
 * @param  mixed $mesec - prosledjen odabran mesec
 * @return void
 */
public function istic($sviM,$mesec){


    $upl=new UplatnicaModel();
    $arr=array();
    $brojM=0;
    foreach ($sviM as $moderator)
    {
      
        $brojjednog=0;
        $this->nadjiuMesecu4($mesec,$moderator->idM,$brojjednog);
        $arr[$brojM]=$brojjednog;
        //array_push($arr,$brojjednog);
         $brojM++;
    }
    $nizP=array();
    $nizP[0]=5;
    $nizP[1]=5;
    $this->proc($nizP, $arr,$brojM);   
     $modModel=new ModeratorModel();
    $sviM=$modModel->where('obrisan',0)->findAll();
    //return view('admin/statistika_moderatora', ['sviM'=>$sviM, 'broj'=>$arr, 'proc'=>$nizP]);
    $this->prikaz('admin/statistika_moderatora',['sviM'=>$sviM, 'broj'=>$arr, 'proc'=>$nizP]);
    

}



/**
 * proc - funkcija koja vraca za svakog moderatora niz sa ukupnim brojem interakcija i niz koji vraca procenatualnu vrednost u odnosu na rad ostalih moderatora
 *
 * @param  mixed $nizP - niz koji po ID-u moderatora ima rasporedjen procenat aktivnosti 
 * @param  mixed $nizB - niz koji po ID-u moderatora ima ukupan broj interakcija zabelezen
 * @param  mixed $brojM - ukupan broj aktivnih moderatora
 * @return void
 */
public function proc(&$nizP, &$nizB, $brojM){
    $ukupno=0;
  
    for( $i=0;$i<$brojM;$i++)
    {
        $ukupno=$ukupno+$nizB[$i];
   
    }
  
    for( $i=0;$i<$brojM;$i++)
    {
        if($ukupno!=0)
      { $nova=$nizB[$i]*100/$ukupno;
      // array_push($nizP,$nova);
    $nizP[$i]=$nova;
    }
       else {
           
      //  array_push($nizP,0);
    $nizP[$i]=0;
    }
    }
   return ['nizP'=>$nizP,'nizB'=>$nizB];
   }

}
