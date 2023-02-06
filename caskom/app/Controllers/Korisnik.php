<?php namespace App\Controllers;

/*Aleksa Vukovic 18/0354*/
//Milica Milanovic 0601/18
/*Marija Dobric 0417/18*/
use App\Models\KorisnikModel;
use App\Models\OglasModel;
use App\Models\RecenzijaModel;
use App\Models\ListaZeljaModel;
use App\Models\UplatnicaModel;
use App\Models\FotografijaModel;
use App\Models\RazgovorModel;
use App\Models\PorukaModel;

use CodeIgniter\I18n\Time;

/**
 * Korisnik - klasa za obradu i prikaz korisnikovih podataka.
 * 
 * @version 1.0
 */

class Korisnik extends BaseController {
        
    /**
     * index - prikaz pocetne stranice korisnika
     *
     * @return void
     */
    public function index() {
        $this->resetujSessionOglase();
        $this->resetujSessionKorisnici();
        $razgovorModel = new RazgovorModel;
        $idRa = $razgovorModel->dohvatiIdRazgovoraKorisnika($this->session->get('korisnik')->idK);
        $poruke = null;
        if ($idRa != null) {
            $porukaModel = new PorukaModel();
            $poruke = $porukaModel->dohvatiPorukeRazgovora($idRa);
        }
        return view('stranice/korisnik/pocetna_prijavljen', ['poruke' => $poruke]);
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
     * dohvatiOglase - vraca sve oglase validnih korisnika
     *
     * @return mixed[]
     */
    public function dohvatiOglase(){
        $oglasModel = new OglasModel();
        $oglasiBoostovani = $oglasModel->dohvatiBoostovane();
        $obicniOglasi = $oglasModel->dohvatiObicne();
        $oglasi = array_merge($oglasiBoostovani, $obicniOglasi);

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
     * odrediDatumIstekaPretplate - prolazi kroz sve uplatnice korisnika i 
     *                              vraca trajanje pretplate u slucaju da je korisnik pretplacen
     *
     * @return mixed
     */
    public function odrediDatumIstekaPretplate(){
        $uplatnicaModel = new UplatnicaModel();
        $uplatniceKorisnika = $uplatnicaModel->pretraziUplatnice($this->session->get('korisnik')->idK);
        $format = 'Y-m-d H:i:s';
        $poslednjiDatum = date_create_from_format($format, '1900-01-01 00:00:00');
        $poslednjiDatum2 = date_create_from_format($format, '1900-01-01 00:00:00');
        $trazenaUplatnica = null;
        $datum = null;
        foreach($uplatniceKorisnika as $uplatnica){
            if(!isset($uplatnica->idO)){
                if($uplatnica->odluka){
                    if(isset($uplatnica->vreme_odluke)){
                        $tmpDate = date_create($uplatnica->vreme_odluke);
                        if($poslednjiDatum < $tmpDate){
                            $poslednjiDatum = $tmpDate;
                            $trazenaUplatnica = $uplatnica;
                        }
                    }   
                }
            }
        }
        $vremenskiPeriod;
        if($poslednjiDatum != $poslednjiDatum2){
            if($trazenaUplatnica != null){
                if($trazenaUplatnica->trajanje == 1){
                    $vremenskiPeriod = "1 month";
                }
                else if($trazenaUplatnica->trajanje == 6){
                    $vremenskiPeriod = "6 month";
                }
                if($trazenaUplatnica->trajanje == 12){
                    $vremenskiPeriod = "1 year";
                }
                $poslednjiDatum = date_add(date_create($trazenaUplatnica->vreme_odluke), date_interval_create_from_date_string($vremenskiPeriod));
                $dateTimeIsteka = $poslednjiDatum;
                $cnt = 0;
                $datum;
                foreach($dateTimeIsteka as $date){
                    if($cnt == 0){
                        $datum = $date;
                    }
                    $cnt++;
                }
            }
        }
        return $datum;
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
        return view('stranice/korisnik/ponuda', ['oglasi'=>$oglasi, 'page'=>$page, 'korisnici'=>$korisnici, 'fotografije'=>$fotografije]);
    }
        
    /**
     * moj_profil - prikaz pregleda moj_profil , 
     *              kome prosledjuje recenzije, oglase, podatke i datum isteka pretplate
     *
     * @return void
     */
    public function moj_profil() {
        $this->resetujSessionOglase();
        $this->resetujSessionKorisnici();
        $oglasi = array();
        $recenzije = array();
        if($this->session->get('korisnik')->idK != null){
            $recenzijaModel = new RecenzijaModel();
            $recenzije = $recenzijaModel->dohvatiRecenzije($this->session->get('korisnik')->idK);
            $oglasModel = new OglasModel();
            $oglasi = $oglasModel->dohvatiOglase($this->session->get('korisnik')->idK);
        }
        $korisnici = $this->dohvatiKorisnikeZadatihRecenzija($recenzije);
        
        $datum = $this->odrediDatumIstekaPretplate();
        
        $fotografije = $this->dohvatiFotografijeOglasa($oglasi);
        
        return view('stranice/korisnik/moj_profil', ['recenzije'=>$recenzije, 'oglasi'=>$oglasi, 'korisnici'=>$korisnici, 'datum'=>$datum,'fotografije'=>$fotografije]);
    }
        
    /**
     * pretplata - prikaz pregleda pretplata, 
     *             kome prosledjuje datum isteka pretplate datog korisnika
     *
     * @return void
     */
    public function pretplata() {
        $this->resetujSessionOglase();
        $this->resetujSessionKorisnici();
        $datum = $this->odrediDatumIstekaPretplate();
        return view('stranice/korisnik/pretplata', ['datum'=>$datum]);
    }
        
    /**
     * moje_ocene - prikaz pregleda moje_ocene, 
     *              kome prosledjuje sve recenzije datog korisnika
     *
     * @return void
     */
    public function moje_ocene() {
        $this->resetujSessionOglase();
        $this->resetujSessionKorisnici();
        $recenzijaModel = new RecenzijaModel();
        $recenzije = $recenzijaModel->dohvatiRecenzije($this->session->get('korisnik')->idK);
        $korisnici = $this->dohvatiKorisnikeZadatihRecenzija($recenzije);      
        return view('stranice/korisnik/moje_ocene', ['recenzije'=>$recenzije, 'korisnici'=>$korisnici]);
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
        return view('stranice/korisnik/korisnik_ocene', ['recenzije'=>$recenzije, 'korisnici'=>$korisnici]);
    }
        
    /**
     * moji_oglasi - prikaz pregleda moji_oglasi, 
     *               kome prosledjuje sve oglase datog korisnika
     *
     * @return void
     */
    public function moji_oglasi() {
        $this->resetujSessionOglase();
        $this->resetujSessionKorisnici();
        $oglasi = array();
        if($this->session->get('korisnik')->idK != null){
            $oglasModel = new OglasModel();
            $oglasi = $oglasModel->dohvatiOglase($this->session->get('korisnik')->idK);
        }
        $fotografije = $this->dohvatiFotografijeOglasa($oglasi);
        return view('stranice/korisnik/moji_oglasi', ['oglasi'=>$oglasi,'fotografije'=>$fotografije]);
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
        return view('stranice/korisnik/korisnik_oglasi', ['oglasi'=>$oglasi,'fotografije'=>$fotografije, 'korisnik'=>$korisnik]);
    }
        
    /**
     * moja_lista_zelja - prikaz pregleda moja_lista_zelja, 
     *                    kome prosledjuje sve oglase koji 
     *                    se nalaze u listi zelja datog korisnika
     *
     * @return void
     */
    public function moja_lista_zelja() {
        $this->resetujSessionOglase();
        $this->resetujSessionKorisnici();
        $oglasi = array();
        if($this->session->get('korisnik')->idK != null){
            $listaZeljaModel = new ListaZeljaModel();
            $oglasiIzListe = $listaZeljaModel->dohvatiOglaseIzListe($this->session->get('korisnik')->idK);
        }
        $oglasiModel = new OglasModel();
        foreach($oglasiIzListe as $oglasIzListe){
            $oglas = $oglasiModel->find($oglasIzListe->idO);
            array_push($oglasi, $oglas);
        }
        $fotografije = $this->dohvatiFotografijeOglasa($oglasi);
        return view('stranice/korisnik/moja_lista_zelja', ['oglasi'=>$oglasi,'fotografije'=>$fotografije]);
    }
        
    /**
     * postavi_oglas - prikaz pregleda postavi_oglas
     *
     * @return void
     */
    public function postavi_oglas() {
        $this->resetujSessionOglase();
        $this->resetujSessionKorisnici();
        return view('stranice/korisnik/postavi_oglas');
    }
        
    /**
     * postavi_oglas2 - prikaz pregleda postavi_oglas_fotografije
     *
     * @return void
     */
    public function postavi_oglas2() {
        $this->resetujSessionOglase();
        $this->resetujSessionKorisnici();
        return view('stranice/korisnik/postavi_oglas_fotografije');
    }
        
    /**
     * pregled_oglasa - prikaz pregleda pregled_oglasa
     *
     * @return void
     */
    public function pregled_oglasa() {
        return view('stranice/korisnik/pregled_oglasa');
    }
        
    /**
     * pretplata_uplatnica - prikaz pregleda pretplata_uplatnica,
     *                       kom se prosledjuje izabran broj meseci nove pretplate
     *
     * @return void
     */
    public function pretplata_uplatnica() {
        $this->resetujSessionOglase();
        $this->resetujSessionKorisnici();
        $meseci = 0;
        $cena = 0;
        if(isset($_POST['ch1'])){
            $meseci = 1;
            $cena = 100;
        }
        else if(isset($_POST['ch2'])){
            $meseci = 6;
            $cena = 500;
        }
        else if(isset($_POST['ch3'])){
            $meseci = 12;
            $cena = 900;
        }
        return view('stranice/korisnik/pretplata_uplatnica', ['meseci'=>$meseci, 'cena'=>$cena]);
    }
    
        
    /**
     * PostavljanjeOglasaSubmitPodaci - upisuje podatke novog oglasa u bazu,
     *                                  i vraca pregled postavi_oglas_fotografije
     *
     * @return void
     */
    public function PostavljanjeOglasaSubmitPodaci() {
        $this->resetujSessionOglase();
        $this->resetujSessionKorisnici();
        $validation =  \Config\Services::validation();
        $validation->setRules([
                'naslov' => 'required',
                'cena' => 'required|greater_than[0]',
                'opis' => 'required',
                'velicina_kucista' => 'required|greater_than[0]'
            ],
            [
                'naslov' => [
                    'required' => 'Naslov je obavezno polje!'
                ],
                'cena' => [
                    'required' => 'Cena je obavezno polje!',
                    'greater_than' => 'Cena ne može biti negativna!'
                ],
                'opis' => [
                    'required' => 'Opis je obavezno polje!'
                ],
                'velicina_kucista' => [
                    'required' => 'Veličina kućišta je obavezno polje!',
                    'greater_than' => 'Veličina kućišta ne može biti negativna!'
                ]
                
            ]        
        );
        $validation->withRequest($this->request)->run();
        
        $poruke = array();
        
        $brend = $this->request->getvar('brend');
        $porukaBrend = '';
        if($brend == 'Izaberite brend sata'){
            $porukaBrend = 'Brend je obavezno polje!';
            $poruke['porukaBrend'] = $porukaBrend; 
        }
        
        $model = $this->request->getvar('model');
        $porukaModel = '';
        if($model == 'Izaberite model sata'){
            $porukaModel = 'Model je obavezno polje!';
            $poruke['porukaModel'] = $porukaModel;
        }
        
        $stanje = $this->request->getvar('stanje');
        $porukaStanje = '';
        if($stanje == 'Izaberite stanje sata'){
            $porukaStanje = 'Stanje je obavezno polje!';
            $poruke['porukaStanje'] = $porukaStanje;
        }
        
        $materijalKucista = $this->request->getvar('materijalKucista');
        $porukaMaterijalKucista = '';
        if($materijalKucista == 'Izaberite materijal kucista'){
            $porukaMaterijalKucista = 'Materijal kucista je obavezno polje!';
            $poruke['porukaMaterijalKucista'] = $porukaMaterijalKucista;
        }
        
        $materijalNarukvice = $this->request->getvar('materijalNarukvice');
        $porukaMaterijalNarukvice = '';
        if($materijalNarukvice == 'Izaberite materijal narukvice'){
            $porukaMaterijalNarukvice = 'Materijal narukvice je obavezno polje!';
            $poruke['porukaMaterijalNarukvice'] = $porukaMaterijalNarukvice;
        }
        
        $mehanizam = $this->request->getvar('mehanizam');
        $porukaMehanizam = '';
        if($mehanizam == 'Izaberite mehanizam sata'){
            $porukaMehanizam = 'Mehanizam sata je obavezno polje!';
            $poruke['porukaMehanizam'] = $porukaMehanizam;
        }
        
        if($porukaBrend != '' || $porukaModel != ''|| $porukaStanje != ''|| $porukaMaterijalKucista != ''|| $porukaMaterijalNarukvice != '' || $porukaMehanizam != '')
            return view('stranice/korisnik/postavi_oglas',  ['errors'=>$validation->getErrors(), 'porukaBrend'=>$porukaBrend, 'porukaModel'=>$porukaModel,
                'porukaStanje'=>$porukaStanje, 'porukaMaterijalKucista'=>$porukaMaterijalKucista, 'porukaMaterijalNarukvice'=>$porukaMaterijalNarukvice,
                'porukaMehanizam'=>$porukaMehanizam ]);
        if(!$validation->withRequest($this->request)->run()){
             return view('stranice/korisnik/postavi_oglas',  ['errors'=>$validation->getErrors()]);
        }
        
        $oglasModel=new OglasModel();
        $sviOglasi = $oglasModel->findAll();
        $maxId = 0;
        foreach($sviOglasi as $oglas){
            if($maxId < $oglas->idO){
                $maxId = $oglas->idO;
            }
        }
        $maxId++;
        $oglasModel->save([
            'idK' => $this->session->get('korisnik')->idK,
            'naslov'=>$this->request->getvar('naslov'),
            'cena'=>$this->request->getvar('cena'),
            'opis'=>$this->request->getvar('opis'),
            'brend'=>$brend,
            'model'=>$model,
            'stanje'=>$stanje,
            'velicina_kucista'=>$this->request->getvar('velicina_kucista'),
            'materijal_kucista'=>$materijalKucista,
            'materijal_narukvice'=>$materijalNarukvice,
            'mehanizam'=>$mehanizam,
            'dostupan'=>true,
            'boostovan'=>false,
        ]);
        
        return view('stranice/korisnik/postavi_oglas_fotografije', ['maxId'=>$maxId]);
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
     * oglas - vraca pregled datog oglasa
     *
     * @param  mixed $id - id oglasa koji se pregleda
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
        return view('stranice/korisnik/pregled_oglasa', ['oglas'=>$oglas, 'korisnik'=>$korisnik, 'slike'=>$slike, 'recenzije'=>$recenzije]);    
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
        return view('stranice/korisnik/pregled_korisnika', ['recenzije'=>$recenzije, 'oglasi'=>$oglasi, 'korisnici'=>$korisnici, 'prodavac'=>$prodavac,'fotografije'=>$fotografije]); 
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
     * dodajFotografije - cuva dodate fotografije oglasa u bazi 
     *
     * @param  mixed $idO - id oglasa na koji se date fotografije odnose
     * @return void
     */
    public function dodajFotografije($idO){
        $this->resetujSessionOglase();
        $this->resetujSessionKorisnici();
        if(isset($_POST['dugme_dalje'])){
            $file = $_FILES['inpFile'];
            $fileName = $_FILES['inpFile']['name'];
            $fileTmpName = $_FILES['inpFile']['tmp_name'];
            $fileSize = $_FILES['inpFile']['size'];
            $fileError = $_FILES['inpFile']['error'];
            $fileType = $_FILES['inpFile']['type'];
            $fotografijaModel =new FotografijaModel();
            $cnt = 0;
            foreach($fileName as $f){
                if($cnt<8){
                    $fileExt = explode('.', $fileName[$cnt]);
                    $fileActualExt = strtolower(end($fileExt));
                    $allowed = array('jpg', 'jpeg', 'png');
                    if(in_array($fileActualExt, $allowed)){
                        if($fileError[$cnt] === 0){
                            $fileNameNew = uniqid('', true).'.'.$fileActualExt;
                            $fileDestination = 'slike_oglasa/'.$fileNameNew;
                            move_uploaded_file($fileTmpName[$cnt], $fileDestination);
                            $fotografijaModel->save([
                                'idO' => $idO,
                                'putanja'=>$fileDestination,
                            ]);
                        }
                        else{
                            //error
                        }
                    }
                    else{
                        //error
                    }
                }
                $cnt++;
            }
        }
        return $this->moj_profil();
    }
        
    /**
     * dodajFotografijeUplatnica - cuva postavljenu uplatnicu(fotografijy) u bazi podataka
     *
     * @param  mixed $trajanje - vremenski period pretplate
     * @return void
     */
    public function dodajFotografijeUplatnica($trajanje, $cena){
        $this->resetujSessionOglase();
        $this->resetujSessionKorisnici();
        if(isset($_POST['dugme_dalje'])){
            $file = $_FILES['inpFile'];
            $fileName = $_FILES['inpFile']['name'];
            $fileTmpName = $_FILES['inpFile']['tmp_name'];
            $fileSize = $_FILES['inpFile']['size'];
            $fileError = $_FILES['inpFile']['error'];
            $fileType = $_FILES['inpFile']['type'];
            $uplatnicaModel = new UplatnicaModel();
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('jpg', 'jpeg', 'png', 'pdf');
            if(in_array($fileActualExt, $allowed)){
                if($fileError === 0){
                    $fileNameNew = uniqid('', true).'.'.$fileActualExt;
                    $fileDestination = 'uplatnice/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $uplatnicaModel->save([
                        'vreme_slanja'=>date("Y-m-d h:m:s"),
                        'idK'=>$this->session->get('korisnik')->idK,
                        'trajanje'=>$trajanje,
                        'cena'=>$cena,
                        'slika'=>$fileDestination,
                    ]);
                }
                else{
                    //error
                }
            }
            else{
                //error
            }
        }
        return $this->moj_profil();
    }
        
    /**
     * izmenaOglasa - vraca pregled izmena_oglasa,
     *                kome se prosledjuje oglas koji treba da se izmeni
     *
     * @param  mixed $id - id oglasa za izmenu
     * @return void
     */
    public function izmenaOglasa($id){
        $this->resetujSessionOglase();
        $this->resetujSessionKorisnici();
        $oglasModel = new OglasModel();
        $oglas = $oglasModel->find($id);
        return view('stranice/korisnik/izmena_oglasa', ['oglas'=>$oglas]);
    }
        
    /**
     * izmenaOglasaSubmit - prikuplja podatke koji su napravljeni prilikom izmene,
     *                      i apdejtuje dati oglas u tabeli "oglasi"
     *
     * @param  mixed $idO - id oglasa za izmenu
     * @return void
     */
    public function izmenaOglasaSubmit($idO){
        $this->resetujSessionOglase();
        $this->resetujSessionKorisnici();
        $validation =  \Config\Services::validation();
        $validation->setRules([
                'naslov' => 'required',
                'cena' => 'required|greater_than[0]',
                'opis' => 'required',
                'velicina_kucista' => 'required|greater_than[0]'
            ],
            [   // greske
                'naslov' => [
                    'required' => 'Naslov je obavezno polje!'
                ],
                'cena' => [
                    'required' => 'Cena je obavezno polje!',
                    'greater_than' => 'Cena ne može biti negativna!'
                ],
                'opis' => [
                    'required' => 'Opis je obavezno polje!'
                ],
                'velicina_kucista' => [
                    'required' => 'Veličina kućišta je obavezno polje!',
                    'greater_than' => 'Veličina kućišta ne može biti negativna!'
                ]
                
            ]        
        );
        $validation->withRequest($this->request)->run();
        
        $poruke = array();
        
        $brend = $this->request->getvar('brend');
        $porukaBrend = '';
        if($brend == 'Izaberite brend sata'){
            $porukaBrend = 'Brend je obavezno polje!';
            $poruke['porukaBrend'] = $porukaBrend; /*['porukaBrend' => 'Brend je obavezno polje!' ];*/
        }
        
        $model = $this->request->getvar('model');
        $porukaModel = '';
        if($model == 'Izaberite model sata'){
            $porukaModel = 'Model je obavezno polje!';
            $poruke['porukaModel'] = $porukaModel;
        }
        
        $stanje = $this->request->getvar('stanje');
        $porukaStanje = '';
        if($stanje == 'Izaberite stanje sata'){
            $porukaStanje = 'Stanje je obavezno polje!';
            $poruke['porukaStanje'] = $porukaStanje;
        }
        
        $materijalKucista = $this->request->getvar('materijalKucista');
        $porukaMaterijalKucista = '';
        if($materijalKucista == 'Izaberite materijal kucista'){
            $porukaMaterijalKucista = 'Materijal kucista je obavezno polje!';
            $poruke['porukaMaterijalKucista'] = $porukaMaterijalKucista;
        }
        
        $materijalNarukvice = $this->request->getvar('materijalNarukvice');
        $porukaMaterijalNarukvice = '';
        if($materijalNarukvice == 'Izaberite materijal narukvice'){
            $porukaMaterijalNarukvice = 'Materijal narukvice je obavezno polje!';
            $poruke['porukaMaterijalNarukvice'] = $porukaMaterijalNarukvice;
        }
        
        $mehanizam = $this->request->getvar('mehanizam');
        $porukaMehanizam = '';
        if($mehanizam == 'Izaberite mehanizam sata'){
            $porukaMehanizam = 'Mehanizam sata je obavezno polje!';
            $poruke['porukaMehanizam'] = $porukaMehanizam;
        }
        
        if($porukaBrend != '' || $porukaModel != ''|| $porukaStanje != ''|| $porukaMaterijalKucista != ''|| $porukaMaterijalNarukvice != '' || $porukaMehanizam != '')
            return view('stranice/korisnik/postavi_oglas',  ['errors'=>$validation->getErrors(), 'porukaBrend'=>$porukaBrend, 'porukaModel'=>$porukaModel,
                'porukaStanje'=>$porukaStanje, 'porukaMaterijalKucista'=>$porukaMaterijalKucista, 'porukaMaterijalNarukvice'=>$porukaMaterijalNarukvice,
                'porukaMehanizam'=>$porukaMehanizam ]);
        if(!$validation->withRequest($this->request)->run()){
             return view('stranice/korisnik/postavi_oglas',  ['errors'=>$validation->getErrors()]);
        }
        
        $oglasModel=new OglasModel();
        $data = [
            'naslov'=>$this->request->getvar('naslov'),
            'cena'=>$this->request->getvar('cena'),
            'opis'=>$this->request->getvar('opis'),
            'brend'=>$brend,
            'model'=>$model,
            'stanje'=>$stanje,
            'velicina_kucista'=>$this->request->getvar('velicina_kucista'),
            'materijal_kucista'=>$materijalKucista,
            'materijal_narukvice'=>$materijalNarukvice,
            'mehanizam'=>$mehanizam,
        ];

        $oglasModel->update($idO, $data);
        
        return view('stranice/korisnik/izmeni_oglas_fotografije', ['maxId'=>$idO]);
    }
    
    
        
    /**
     * izmenaOglasaFotografijeSubmit - brise postojece fotografije datog oglasa,
     *                                 i postavlja nove
     *
     * @param  mixed $idO - id oglasa cije se fotografije menjaju
     * @return void
     */
    public function izmenaOglasaFotografijeSubmit($idO){
        $this->resetujSessionOglase();
        $this->resetujSessionKorisnici();
        $fotografijaModel = new FotografijaModel();
        $fotografijaModel->where('idO', $idO)->delete();
        if(isset($_POST['dugme_dalje'])){
            $file = $_FILES['inpFile'];
            $fileName = $_FILES['inpFile']['name'];
            $fileTmpName = $_FILES['inpFile']['tmp_name'];
            $fileSize = $_FILES['inpFile']['size'];
            $fileError = $_FILES['inpFile']['error'];
            $fileType = $_FILES['inpFile']['type'];
            $fotografijaModel =new FotografijaModel();
            $cnt = 0;
            foreach($fileName as $f){
                $fileExt = explode('.', $fileName[$cnt]);
                $fileActualExt = strtolower(end($fileExt));
                $allowed = array('jpg', 'jpeg', 'png');
                if(in_array($fileActualExt, $allowed)){
                    if($fileError[$cnt] === 0){
                        $fileNameNew = uniqid('', true).'.'.$fileActualExt;
                        $fileDestination = 'slike_oglasa/'.$fileNameNew;
                        move_uploaded_file($fileTmpName[$cnt], $fileDestination);
                        $fotografijaModel->save([
                            'idO' => $idO,
                            'putanja'=>$fileDestination,
                        ]);
                    }
                    else{
                        //error
                    }
                }
                else{
                    //error
                }
                $cnt++;
            }
        }
        return $this->moj_profil();
    }
    
    
    /**
     * boostOglasa - vraca pregled boost_oglasa za dati oglas
     *
     * @param  mixed $id - id oglasa koji se boost-uje
     * @return void
     */
    public function boostOglasa($id) {
        $this->resetujSessionOglase();
        $this->resetujSessionKorisnici();
        $oglasModel = new OglasModel();
        $oglas = $oglasModel->find($id);
        return view('stranice/korisnik/boost_oglasa', ['oglas'=>$oglas]);
    }
        
    /**
     * dodajUListuZelja - dodaje zadati oglas u listu zelja korisnika
     *
     * @param  mixed $idO - id oglasas koji se dodaje u listu zelja
     * @param  mixed $page - trenutna stranica
     * @return void
     */
    public function dodajUListuZelja($idO, $page=0) {
        $oglasModel = new OglasModel();
        $oglas = $oglasModel->find($idO);
        $listaZeljaModel = new ListaZeljaModel();
        $arr = array('idK'=>$this->session->get('korisnik')->idK, 'idO'=>$idO);
        $zelja = $listaZeljaModel->where($arr)->find();
        if($zelja == null){
            // nije u listi zelja
            $listaZeljaModel->save([
                'idK'=>$this->session->get('korisnik')->idK,
                'idO'=>$idO,
            ]);
        }
        else{
        }
        return $this->ponuda($page-1);
    }
        
    /**
     * izbaciIzListeZelja - izbacuje zadati oglas iz liste zelja
     *
     * @param  mixed $idO - id oglasa koji se izbacuje iz liste zelja
     * @return void
     */
    public function izbaciIzListeZelja($idO) {
        $oglasModel = new OglasModel();
        $oglas = $oglasModel->find($idO);
        $listaZeljaModel = new ListaZeljaModel();
        $arr = array('idK'=>$this->session->get('korisnik')->idK, 'idO'=>$idO);
        $zelja = $listaZeljaModel->where($arr)->find();
        if($zelja == null){
        }
        else{
            //jeste u listi zelja i izbaci ga
            $mysqli = mysqli_connect("localhost","root","","časkom_baza");
            $idK = $this->session->get('korisnik')->idK;
            $upit = "DELETE FROM lista_zelja WHERE idK=$idK AND idO=$idO";
            $result = $mysqli->query($upit);
        }
        return $this->moja_lista_zelja();
    }
        
    /**
     * dodajFotografijeUplatnicaBoost - dodaje uplatnicu(fotografiju) u bazu
     *                                  prilikom boost-a oglasa
     *
     * @param  mixed $idO - id oglasa za koji se odnosi uplatnica
     * @return void
     */
    public function dodajFotografijeUplatnicaBoost($idO){
        $this->resetujSessionOglase();
        $this->resetujSessionKorisnici();
        if(isset($_POST['dugme_dalje'])){
            $file = $_FILES['inpFile'];
            $fileName = $_FILES['inpFile']['name'];
            $fileTmpName = $_FILES['inpFile']['tmp_name'];
            $fileSize = $_FILES['inpFile']['size'];
            $fileError = $_FILES['inpFile']['error'];
            $fileType = $_FILES['inpFile']['type'];
            $uplatnicaModel = new UplatnicaModel();
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('jpg', 'jpeg', 'png', 'pdf');
            if(in_array($fileActualExt, $allowed)){
                if($fileError === 0){
                    $fileNameNew = uniqid('', true).'.'.$fileActualExt;
                    $fileDestination = 'uplatnice/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $uplatnicaModel->save([
                        'vreme_slanja'=>date("Y-m-d h:m:s"),
                        'idK'=>$this->session->get('korisnik')->idK,
                        'idO'=>$idO,
                        'trajanje'=>1,
                        'cena'=>100,
                        'slika'=>$fileDestination,
                    ]);
                }
                else{
                    //error
                }
            }
            else{
                //error
            }
        }
        return $this->moj_profil();
    }

        
    /**
     * kontaktiranje - prikaz stranice za Kontaktiranje
     *
     * @return void
     */
    public function kontaktiranje() {
        return view('stranice/korisnik/kontaktiranje');
    }
    
       
    /**
     * rec - prikaz stranice za recenziranje prodavca
     *
     * @return void
     */
    public function rec() {
        return view('stranice/korisnik/Rec_forma');
    }    
    /**
     * unesi_recenziju - fukcija koja se poziva klikom na dugme za slanje recenzije, dodaje ocenu i komentar u bazu
     *
     * @return void
     */
    public function unesi_recenziju(){
        $validation =  \Config\Services::validation();
        $validation->setRules([
                'ocena' => 'required',
                'tekst' => 'required',
            ],
            [   // greske
                'ocena' => [
                    'required' => 'Obavezno je oceniti korisnika!'
                ],
                'tekst' => [
                    'required' => 'Obavezan je komentar!'
                ],
           
            ]        
        );
        if (!$validation->withRequest($this->request)->run()) {
            return view('stranice/korisnik/Rec_forma', ['errors'=>$validation->getErrors()]);
        }
        $rModel=new RecenzijaModel();
        $current_time = new Time('now', 'Europe/Belgrade', 'en_US');
        $ispitaj=$this->request->getVar('ocena');
        if($ispitaj>5)
        { return view('stranice/korisnik/Rec_forma',['poruka'=>'Ocena mora biti izmedju 1 i 5']);  }
        if($ispitaj<1)
        { return view('stranice/korisnik/Rec_forma',['poruka'=>'Ocena mora biti izmedju 1 i 5']);  }
        $a=$this->request->getvar('idK_kome');
        $b=$this->session->get('korisnik')->idK;
        if($a!=$b)
        { 
            $rModel->save([
                'ocena'=>$this->request->getvar('ocena'),
                'tekst'=>$this->request->getvar('tekst'),
                'idK_kome'=>$this->request->getvar('idK_kome'),
                'idK_ko'=>$this->session->get('korisnik')->idK,
                'vreme_postavljanja'=>$current_time
            ]);

            $korisnikModel = new KorisnikModel();
            if ($ispitaj < 3.0 && $korisnikModel->proveriImunitet($a)) {
                $korisnikModel->postaviImunitet($a, false);
            }
        
        }
        return $this->ponuda();

    }
    
    /**
     * obrisiOglas - brise dati oglas iz baze podataka
     *
     * @param  mixed $idO - id oglasa koji se brise
     * @return void
     */
    public function obrisiOglas($idO){
        $this->resetujSessionOglase();
        $this->resetujSessionKorisnici();
        $listaZeljaModel = new ListaZeljaModel();
        $listaZeljaModel->where('idO', $idO)->delete();
        $fotografijaModel = new FotografijaModel();
        $fotografijaModel->where('idO', $idO)->delete();
        $uplatnicaModel = new FotografijaModel();
        $uplatnicaModel->where('idO', $idO)->delete();
        $oglasModel = new OglasModel();
        $oglasModel->where('idO', $idO)->delete();
        return $this->moj_profil();
    }
}


