<?php namespace App\Controllers;
//<!-- Milica Milanovic 0601/18 -->
// Aleksa Vukovic 18/0354
use App\Models\KorisnikModel;
use App\Models\OglasModel;
use App\Models\FotografijaModel;
use App\Models\RecenzijaModel;
use App\Models\ModeratorModel;
use App\Models\AdminModel;
use CodeIgniter\I18n\Time;

class Gost extends BaseController {
        
    /**
     * index-vraca pocetnu stranu gosta
     *
     * @return void
     */
    public function index() {
        //$this->session->set("korisnik", null);
        //$this->session->set("moderator", null);
        //$this->session->set("admin", null);
        $this->resetujSessionOglase();
        $this->resetujSessionKorisnici();
        return view('stranice/gost/index');
    }
        
    /**
     * register - prikaz stranice za registraciju
     *
     * @return void
     */
    public function register() {
        $this->resetujSessionOglase();
        $this->resetujSessionKorisnici();
         return view('stranice/gost/registracija');
    }     
     /**
      * usl- prikaz stranice sa uslovima koriscenja
      *
      * @return void
      */
     public function usl() {
        return view('stranice/gost/uslovi');
    }    
    /**
     * register_person- prikaz stranice sa formom za registraciju fizickog lica
     *
     * @return void
     */
    public function register_person() {
        return view('stranice/gost/registracija_fizicko_lice');
    }
        
    /**
     * register_person_submit - funkcija koja se poziva klikom na dugme za registraciju prilikom registracije za fizicko lice
     *
     * @return void
     */
    public function register_person_submit() {
        /* validacija */
        $validation =  \Config\Services::validation();
        $validation->setRules([   // pravila - TODO treba ih dodati jos
                'ime' => 'required|min_length[7]|max_length[28]',
                'korisnicko_ime' => 'required|min_length[3]|max_length[15]',
                'telefon' => 'required|min_length[9]|max_length[15]',
                'e_mail' => 'required|valid_email',
                'lozinka' => 'required|min_length[8]|max_length[15]',
                'uslovi' => 'required' /* ? */
            ],
            [   // greske
                'ime' => [
                    'required' => 'Puno ime je obavezno polje!',
                'min_length'=>'Ime mora sadržati više od 7 karaktera',
                'max_length'=>'Ime mora sadržati manje od 28 karaktera'
                ],
                'korisnicko_ime' => [
                    'required' => 'Korisnicko ime je obavezno polje!',
                    'min_length'=>'Korisničko ime mora sadržati više od 3 karaktera',
                    'max_length'=>'Korisničko ime mora sadržati manje od 15 karaktera'
                ],
                'telefon' => [
                    'required' => 'Telefon  je obavezno polje!',
                    'min_length'=>'Telefon mora sadržati više od 8 cifara',
                    'max_length'=>'Telefon ne može imati više od 15 cifara '
                ],
                'e_mail' => [
                    'required' => 'E-mail je obavezno polje!',
                    'valid_email' =>'Nije uneta ispravna e-mail adresa!'
                ],
                'lozinka' => [
                    'required' => 'Lozinka je obavezno polje!',
                    'min_length'=>'Lozinka mora sadržati više od 7 karaktera',
                    'max_length'=>'Lozinka mora sadržati manje od 15 karaktera'
                ],
                'uslovi' => [
                    'required' => 'Morate se sloziti sa uslovima!' /* ? */
                ]
            ]        
        );
        if (!$validation->withRequest($this->request)->run()) {
            return view('stranice/gost/registracija_fizicko_lice', ['errors'=>$validation->getErrors()]);
        }
        /* dodavanje u bazu TODO */
        /* dodati i poruku i ovde i u view-u... */
        $korModel=new KorisnikModel();


        $mod=$korModel->where('korisnicko_ime', $this->request->getVar('korisnicko_ime'))->first();
        if($mod!=null){ return view('stranice/gost/registracija_fizicko_lice',['poruka'=>'Korisničko ime je zauzeto!']);  }
    
        $mode=$korModel->where('e_mail', $this->request->getVar('e_mail'))->first();
        if($mode!=null){return view('stranice/gost/registracija_fizicko_lice',['poruka1'=>'E-mail adresa je zauzeta!']);}

        $korModel=new KorisnikModel();
       
        $vt=$this->request->getVar('vidljiv');
        if(isset($vt))
        {
        $korModel->save([
            'ime'=>$this->request->getvar('ime'),
            'korisnicko_ime'=>$this->request->getvar('korisnicko_ime'),
            'telefon'=>$this->request->getvar('telefon'),
            'e_mail'=>$this->request->getvar('e_mail'),
            'lozinka'=>$this->request->getvar('lozinka'),
            'vidljiv_telefon'=>true,
       //  'autor'=>$this->session->get('autor')->korisnicko_ime
        ]);
        $korModel->set(['vidljiv_telefon'=>true]);
      //  $this->session->set('korisnik',$this->request->getvar('e_mail'));

        return view('stranice/gost/prijava');}
        else{

            $korModel->save([
                'ime'=>$this->request->getvar('ime'),
                'korisnicko_ime'=>$this->request->getvar('korisnicko_ime'),
                'telefon'=>$this->request->getvar('telefon'),
                'e_mail'=>$this->request->getvar('e_mail'),
                'lozinka'=>$this->request->getvar('lozinka'),
                'vidljiv_telefon'=>false,
           //  'autor'=>$this->session->get('autor')->korisnicko_ime
            ]);
        //    $this->session->set('korisnik',$this->request->getvar('e_mail'));
            return view('stranice/gost/prijava');

        }



    }
        
    /**
     * register_company - prikaz stranice za registraciju pravnog lica
     *
     * @return void
     */
    public function register_company() {
        
        return view('stranice/gost/registracija_pravnog_lica');
    }
        
    /**
     * register_company_submit - funkcija koja se poziva klikom na dugme za registraciju pravnog lica
     *
     * @return void
     */
    public function register_company_submit() {
        /* validacija */
        $validation =  \Config\Services::validation();
        $validation->setRules([   // pravila - TODO treba ih dodati jos
            'ime' => 'required|min_length[5]|max_length[28]',
                'apr' => 'required|min_length[4]|max_length[14]',
                'e_mail' => 'required|valid_email',
                'lozinka' => 'required|min_length[8]|max_length[15]',
                'uslovi' => 'required' /* ? */
            ],
            [   // greske
                'ime' => [
                    'required' => 'Puno ime je obavezno polje!',
                    'min_length'=>'Ime mora sadržati više od 5 karaktera',
                    'max_length'=>'Ime mora sadržati manje od 28 karaktera'
                ],
                'apr' => [
                    'required' => 'APR je obavezno polje!',
                    'min_length'=>'APR mora sadržati više od 4 cifre',
                    'max_length'=>'APR mora sadržati manje od 14 cifara'
                ],
                'e_mail' => [
                    'required' => 'E-mail je obavezno polje!',
                    'valid_email' =>'Nije uneta ispravna e-mail adresa!'
                ],
                'lozinka' => [
                    'required' => 'Lozinka je obavezno polje!',
                    'min_length'=>'Lozinka mora sadržati više od 7 karaktera',
                    'max_length'=>'Lozinka mora sadržati manje od 15 karaktera'
                ],
                'uslovi' => [
                    'required' => 'Morate se sloziti sa uslovima!' /* ? */
                ]
            ]        
        );
        if (!$validation->withRequest($this->request)->run()) {
            return view('stranice/gost/registracija_pravnog_lica', ['errors'=>$validation->getErrors()]);
        }
        /* dodavanje u bazu TODO */
        /* dodati i poruku i ovde i u view-u... */
        $korModel=new KorisnikModel();

        $mod=$korModel->where('apr', $this->request->getVar('apr'))->first();
        if($mod!=null){ return view('stranice/gost/registracija_pravnog_lica',['poruka'=>'APR je zauzet!']);  }
    
        $mode=$korModel->where('e_mail', $this->request->getVar('e_mail'))->first();
        if($mode!=null){return view('stranice/gost/registracija_pravnog_lica',['poruka1'=>'E-mail adresa je zauzeta!']);}


        $korModel=new KorisnikModel();

        $korModel->save([
            'ime'=>$this->request->getvar('ime'),
            'apr'=>$this->request->getvar('apr'),
            'e_mail'=>$this->request->getvar('e_mail'),
            'lozinka'=>$this->request->getvar('lozinka'),
        'korisnicko_ime'=>$this->request->getvar('ime'),
        ]);
      //  $this->session->set('korisnik',$this->request->getvar('e_mail'));
        
        return view('stranice/gost/prijava');

    }
        
    /**
     * login - prikaz stranice za prijavljivanje
     *
     * @return void
     */
    public function login() {
        $this->resetujSessionOglase();
        $this->resetujSessionKorisnici();
        return view('stranice/gost/prijava');
    }
        
    /**
     * pocetna - prikaz pocetne stranice gosta
     *
     * @return void
     */
    public function pocetna() {
        $this->resetujSessionOglase();
        $this->resetujSessionKorisnici();
        return view('stranice/gost/pocetna_gost');
    }
        
    /**
     * loginSubmit - funkcija koja se poziva klikom na dugme na stranici za prijavljivanje
     *
     * @return void
     */
    public function loginSubmit() {
        /* validacija */
        $validation =  \Config\Services::validation();
        $validation->setRules([   // pravila - TODO treba ih dodati jos
                'e_mail' => 'required',
                'lozinka' => 'required'
            ],
            [   // greske
                'e_mail' => [
                    'required' => 'E-mail je obavezno polje!'
                ],
                'lozinka' => [
                    'required' => 'Lozinka je obavezno polje!'
                ]
            ]        
        );
        if (!$validation->withRequest($this->request)->run()) {
            return view('stranice/gost/prijava', ['errors'=>$validation->getErrors()]);
        }
        /* trenutno se radi provera po korisnickom imenu jer za e-mail iskace error
         *  $korisnik = $korisnikModel->where('e-mail', $this->request->getVar('e-mail'))->first();
        */
        
        /* provera tabele korisnika */
        $korisnikModel = new KorisnikModel();
        $korisnik = $korisnikModel->where('e_mail', $this->request->getVar('e_mail'))->first();
        if ($korisnik != null) {
            if ($korisnik->lozinka != $this->request->getVar('lozinka')) {
                return view('stranice/gost/prijava', ['poruka'=>'Pogresna lozinka!']);
            }
            $this->session->set('korisnik', $korisnik);
            return redirect()->to(site_url('Korisnik'));
        }
          
        
        /* provera tabele moderatora */
        $moderatorModel = new ModeratorModel();
        $moderator = $moderatorModel->where('e_mail', $this->request->getVar('e_mail'))->first();
        if ($moderator != null) {
            if($moderator->lozinka != $this->request->getVar('lozinka')) {
                return view('stranice/gost/prijava', ['poruka'=>'Pogresna lozinka!']);
            }
            $this->session->set('moderator', $moderator);
            return redirect()->to(site_url('Moderator'));
        }
        
        /* provera tabele admina */
        $adminModel = new AdminModel();
        $admin = $adminModel->where('e_mail', $this->request->getVar('e_mail'))->first();
        if ($admin != null) {
            if ($admin->lozinka != $this->request->getVar('lozinka')) {
                return view('stranice/gost/prijava', ['poruka'=>'Pogresna lozinka!']);
            }
            $this->session->set('admin', $admin);
            return redirect()->to(site_url('Admin'));
        }
        /* nije pronadjen ni u jednoj tabeli */
        return view('stranice/gost/prijava', ['poruka'=>'Korisnik ne postoji!']);      
    }
    
    /**
     * ponuda - prikaz svih oglasa i korisnika u zavisnosti od primenjenih filtera ili pretrage
     *
     * @param  mixed $page - trenutna stranica
     * @return void
     */    
    public function ponuda($page = 0){
        if($page==-1) $page=0;
        $page = $page + 1;
        $oglasi = $this->session->get('oglasi');
        $korisnici = $this->session->get('korisnici');
        $korisniciCount = 0;
        if($korisnici != null){
            $korisniciCount = count($korisnici);
            $korisnici = $this->odrediKorisnikeZaPonudu($page, $korisnici);
        }
        if($oglasi == null){
            $oglasModel = new OglasModel();
            $oglasi = $oglasModel->dohvatiOglasePoStranici($page);   
        }
        else{
            $oglasi = $this->odrediOglaseZaPonudu($korisniciCount, $page, $oglasi);
        }
        if($oglasi == null){
            $page-=2;
        }
        $fotografije = $this->dohvatiFotografijeOglasa($oglasi);
        return view('stranice/gost/ponuda', ['oglasi'=>$oglasi, 'page'=>$page, 'korisnici'=>$korisnici, 'fotografije'=>$fotografije]);
    }
        
    /**
     * oglas - prikaz stranice pregleda oglasa
     *
     * @param  mixed $id - id oglasa u bazi
     * @return void
     */
    public function oglas($id){
        $oglasModel = new OglasModel();
        $oglas = $oglasModel->find($id);
        $korisnikModel = new KorisnikModel();
        $korisnik = $korisnikModel->find($oglas->idK);
        $fotografijaModel = new FotografijaModel();
        $slike = $fotografijaModel->where('idO', $id)->findAll();
        
        $prodavac = $korisnikModel->find($oglas->idK);
        $recenzijaModel = new RecenzijaModel();
        $recenzije = $recenzijaModel->dohvatiRecenzije($prodavac->idK);
        
        return view('stranice/gost/pregled_oglasa', ['oglas'=>$oglas, 'korisnik'=>$korisnik, 'slike'=>$slike, 'recenzije'=>$recenzije]);    
    }
        
    /**
     * pretraga - vrsi pretragu oglasa i korisnika po zadatom imenu,
     *            koje dalje prosledjuje ponudi
     *
     * @return void
     */
    public function pretraga(){
        $oglasModel = new OglasModel();
        if ($this->request->getVar('pretraga') == "") return $this->ponuda(0);
        $oglasi=$oglasModel->pretraga($this->request->getVar('pretraga'));     
        $oglasi = $this->dohvatiOglaseValidnihKorisnika($oglasi);
        $korisnikModel = new KorisnikModel();
        $korisnici = $korisnikModel->pretraga($this->request->getVar('pretraga'));
        $fotografije = $this->dohvatiFotografijeOglasa($oglasi);
        $this->session->set("oglasi", $oglasi);
        $this->session->set("korisnici", $korisnici);
        return $this->ponuda(0);
    }
        
    /**
     * filtriranje - vrsi filtriranje oglasa po zadtatim kriterijumima,
     *               koje prosledjuje ponudi
     *
     * @return void
     */
    public function filtriranje(){
        $this->resetujSessionKorisnici();
        $oglasModel = new OglasModel();
        $oglasiBrend = array();
        $oglasiModel = array();
        $oglasiStanje = array();
        $oglasiMaterijalNarukvice = array();
        $oglasiMaterijalKucista = array();
        $oglasiMehanizam = array();
        
        $mysqli = mysqli_connect("localhost","root","","časkom_baza");
        
        $oglasi = array();
        $upit = "SELECT * FROM oglas o WHERE ";
        
        $flag = false;
      
        $cnt = 0;
        if(isset($_GET['brend'])){
            $filterNizBrend= $_GET['brend'];
            foreach($filterNizBrend as $filter){
                if($cnt == 0){
                    $upit = $upit . " ";
                }
                else{
                    $upit = $upit . " OR ";
                }
                $upit = $upit . "o.brend='" . $filter . "'";
                $cnt++;
            }
            $upit = $upit . " ";
            $flag = true;
        }
        $cnt = 0;
        if(isset($_GET['model'])){
            $filterNizModel= $_GET['model'];
            foreach($filterNizModel as $filter){
                if($cnt == 0){
                    if($flag){
                        $upit = $upit . " AND ";
                    }
                    else  $upit = $upit . " ";
                }
                else{
                    $upit = $upit . " OR ";
                }
                $upit = $upit . "o.model='" . $filter . "'";
                $cnt++;
            }
            $upit = $upit . " ";
            $flag = true;
        }
        $cnt = 0;
        if(isset($_GET['stanje'])){
            $filterNizStanje= $_GET['stanje'];
            foreach($filterNizStanje as $filter){
                if($cnt == 0){
                    if($flag){
                        $upit = $upit . " AND ";
                    }
                    else  $upit = $upit . " ";
                }
                else{
                    $upit = $upit . " OR ";
                }
                $upit = $upit . "o.stanje='" . $filter . "'";
                $cnt++;
            }
            $upit = $upit . " ";
            $flag = true;
        }
        $cnt = 0;
        if(isset($_GET['materijal_kucista'])){
            $filterNizMaterijalKucista= $_GET['materijal_kucista'];
            foreach($filterNizMaterijalKucista as $filter){
                if($cnt == 0){
                    if($flag){
                        $upit = $upit . " AND ";
                    }
                    else  $upit = $upit . " ";
                }
                else{
                    $upit = $upit . " OR ";
                }
                $upit = $upit . "o.materijal_kucista='" . $filter . "'";
                $cnt++;
            }
            $upit = $upit . " ";
            $flag = true;
        }
        $cnt = 0;
        if(isset($_GET['materijal_narukvice'])){
            $filterNizMaterijalNarukvice= $_GET['materijal_narukvice'];
            
            foreach($filterNizMaterijalNarukvice as $filter){
                if($cnt == 0){
                    if($flag){
                        $upit = $upit . " AND ";
                    }
                    else  $upit = $upit . " ";
                }
                else{
                    $upit = $upit . " OR ";
                }
                $upit = $upit . "o.materijal_narukvice='" . $filter . "'";
                $cnt++;
            }
            $upit = $upit . " ";
            $flag = true;
        }
        $cnt = 0;
        if(isset($_GET['mehanizam'])){
            $filterNizMehanizam = $_GET['mehanizam'];
            foreach($filterNizMehanizam as $filter){
                
                if($cnt == 0){
                    if($flag){
                        $upit = $upit . " AND ";
                    }
                    else  $upit = $upit . " ";
                }
                else{
                    $upit = $upit . " OR ";
                }
                $upit = $upit . "o.mehanizam='" . $filter . "'";
                $cnt++;
            }
            $upit = $upit . " ";
            $flag = true;
        }
        
        $cnt = 0;
        if(isset($_GET['velicina_kucista'])){
            
            $filterVelicina = $_GET['velicina_kucista']; 
            if($filterVelicina != ""){
                if($cnt == 0){
                    if($flag){
                        $upit = $upit . " AND ";
                    }
                    else  $upit = $upit . " ";
                }
                else{
                    $upit = $upit . " OR ";
                }
                $upit = $upit . "o.velicina_kucista=" . (float)$filterVelicina . " ";
                $cnt++;
            
                $upit = $upit . " ";
                $flag = true;
            }
        }
        
        $cnt = 0;
        if(isset($_GET['cena'])){
            
            $filterCena = $_GET['cena'];
                if($cnt == 0){
                    if($flag){
                        $upit = $upit . " AND ";
                    }
                    else  $upit = $upit . " ";
                }
                else{
                    $upit = $upit . " OR ";
                }
                $filterCena = (float)$filterCena;
                $filterCena = $filterCena*1000.0;
                
                $upit = $upit . "o.cena < " . $filterCena . " ";
                $cnt++;
            
            $upit = $upit . " ";
            $flag = true;
        }

        $result = $mysqli->query($upit);
        
        if($result != false){
            $niz = mysqli_fetch_row($result);

            while($niz != null){
                $oglas = $oglasModel->dohvatiOglaseID($niz[0]);
                array_push($oglasi, $oglas[0]);
                $niz = mysqli_fetch_row($result);
            }
        }
        
        mysqli_close($mysqli);
        
        $oglasi = $this->dohvatiOglaseValidnihKorisnika($oglasi);
        
        $this->session->set("oglasi", $oglasi);
        return $this->ponuda(0);
    }
    
     /**
     * dohvatiKorisnikeZadatihRecenzija - vraca korisnike zadatih recenizija
     *
     * @param  mixed[] $recenzije - niz sopstvenih recenzija 
     * @return mixed[]
     */
    public function dohvatiKorisnikeZadatihRecenzija($recenzije){
        $korisnici = array();
        $korisnikModel = new KorisnikModel();
        foreach($recenzije as $recenzija){
            $korisnik = $korisnikModel->find($recenzija->idK_ko);
            array_push($korisnici, $korisnik);
        }
        return $korisnici;
    }
    
    /**
     * dohvatiFotografijeOglasa - vraca prvu fotografiju zadatih oglasa u obliku niza
     *
     * @param  mixed[] $oglasi - niz oglasa za koje treba odrediti fotografije
     * @return mixed[]
     */
    public function dohvatiFotografijeOglasa($oglasi){
        $fotografijaModel = new FotografijaModel();
        $fotografije = array();
        foreach($oglasi as $oglas){
            $fotografija = $fotografijaModel->dohvatiPoIdO($oglas->idO);
            if($fotografija != null){
                $foto = $fotografija[0];
            }
            else{
                $foto = null;
            }
            array_push($fotografije, $foto); 
        }
        return $fotografije;
    }
    
    /**
     * korisnikove_ocene - pregled ocena trenutno pregledanog korisnika
     *
     * @param  int $idK - id korisnika koje se trenutno pregleda
     * @return void
     */
    public function korisnikove_ocene($idK) {
        $recenzijaModel = new RecenzijaModel();
        $recenzije = $recenzijaModel->dohvatiRecenzije($idK);
        $korisnici = $this->dohvatiKorisnikeZadatihRecenzija($recenzije);
        return view('stranice/gost/korisnik_ocene', ['recenzije'=>$recenzije, 'korisnici'=>$korisnici]);
    }
    
    /**
     * korisnikovi_oglasi - pregled oglasa trenutno pregledanog korisnika
     *
     * @param  mixed $idK - id korisnika koje se trenutno pregleda
     * @return void
     */
    public function korisnikovi_oglasi($idK) {
        $oglasi = array();
        if($idK != null){
            $oglasModel = new OglasModel();
            $oglasi = $oglasModel->dohvatiOglase($idK);
        }
        $fotografije = $this->dohvatiFotografijeOglasa($oglasi);
        $korisnikModel = new KorisnikModel();
        $korisnik = $korisnikModel->dohvatiKorisnika($idK);
        return view('stranice/gost/korisnik_oglasi', ['oglasi'=>$oglasi,'fotografije'=>$fotografije, 'korisnik'=>$korisnik]);
    }
    
    /**
     * korisnik - vraca pregled datog korisnika
     *
     * @param  mixed $id - id korisnika koji se pregleda
     * @return void
    */
    public function korisnik($id){
        $oglasModel = new OglasModel();
        $korisnikModel = new KorisnikModel();
        $oglasi = array();
        $recenzije = array();
        if($id != null){
            $recenzijaModel = new RecenzijaModel();
            $recenzije = $recenzijaModel->dohvatiRecenzije($id);
            $oglasi = $oglasModel->dohvatiOglase($id);
        }
        $korisnici = $this->dohvatiKorisnikeZadatihRecenzija($recenzije);
        $prodavac = $korisnikModel->find($id);
        $fotografije = $this->dohvatiFotografijeOglasa($oglasi);
        return view('stranice/gost/pregled_korisnika', ['recenzije'=>$recenzije, 'oglasi'=>$oglasi, 'korisnici'=>$korisnici, 'prodavac'=>$prodavac,'fotografije'=>$fotografije]); 
    }
    
    /**
     * resetujSessionOglase - resetuje oglase koji su postavljeni 
     *                        prilikom filtriranja ili pretrage u tekucoj sesiji
     *
     * @return void
     */
    public function resetujSessionOglase(){
        $this->session->set('oglasi', null);
    }
        
    /**
     * resetujSessionKorisnici - resetuje korisnike koji su postavljeni
     *                           prilikom pretrage u tekucoj sesiji
     *
     * @return void
     */
    public function resetujSessionKorisnici(){
        $this->session->set('korisnici', null);
    }
    
    /**
     * klikNaPonudu - poziv ponude kada smo vec u ponudi,
     *                tj. resetovanje trenutnih oglasa i korisnika u sesiji
     *
     * @return void
     */
    public function klikNaPonudu(){
        $this->resetujSessionOglase();
        $this->resetujSessionKorisnici();
        return $this->ponuda();
    }
    
    /**
     * dohvatiOglaseValidnihKorisnika - vraca niz oglasa koji pripadaju validnim korisnicima
     *
     * @param  mixed[] $oglasi - niz oglasa
     * @return mixed[]
     */
    public function dohvatiOglaseValidnihKorisnika($oglasi){
        $korisnikModel = new KorisnikModel();
        $oglasiKonacno = array();
        foreach($oglasi as $oglas){
            $korisnik = $korisnikModel->find($oglas->idK);
            if($korisnik->pretplacen && !$korisnik->banovan){
                array_push($oglasiKonacno, $oglas);
            }
        }
        return $oglasiKonacno;
    }
    
    /**
     * odrediOglaseZaPonudu - vraca oglase koji treba da se prikazu na datoj stranici
     *
     * @param  int $korisniciCount - broj korisnika dobijenih pretragom
     * @param  int $page - trenutna stranica
     * @param  mixed[] $oglasi - niz oglasa
     * @return mixed[]
     */
    public function odrediOglaseZaPonudu($korisniciCount, $page, $oglasi){
        $oglasiKonacno = array();
        $cnt = $korisniciCount;
        $bottomBorder = ($page-1)*16;
        foreach ($oglasi as $oglas) {
            if($cnt < 16*$page && $cnt >= $bottomBorder){
                array_push($oglasiKonacno, $oglas);
            }
            $cnt++;
        }
        return $oglasiKonacno;
    }
    /**
     * odrediKorisnikeZaPonudu - vraca niz korisnika koji treba
     *                           da se prikazu na datoj stranici
     *
     * @param  int $page - trenutna stranica
     * @param  mixed[] $korisnici - niz korisnika koji su dobijeni pretragom
     * @return mixed[]
     */
    public function odrediKorisnikeZaPonudu($page, $korisnici){
        $korisniciKonacno = array();
        $cnt = 0;
        $bottomBorder = ($page-1)*16;
        foreach ($korisnici as $korisnik) {
            if($cnt < 16*$page && $cnt >= $bottomBorder){
                array_push($korisniciKonacno, $korisnik);
            }
            $cnt++;
        }
        return $korisniciKonacno;
    }
    
}
