<?php

namespace App\Filters;

/* Sava Gavrić 0359/18 */

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

/**
 * KorisnikFilter - Filter za stranice korisnika.
 * 
 * @version 1.0
 */
class KorisnikFilter implements FilterInterface
{
    /**
     * before
     * Poziva se pre ispunjenja zahteva i redirect-uje klijenta na 
     * odgovarajuću adresu ukoliko nije ulogovan kao korisnik.
     * @param  mixed $request - zahtev za odgovarajuću adresom
     * @param  mixed[] $arguments - argumenti zahteva
     * @return void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
       $session=session();
       if ($session != null) {
            if (!$session->has('korisnik')) {
                if ($session->has('moderator'))
                    return redirect()->to(site_url('Moderator')); 
                else if ($session->has('admin'))
                    return redirect()->to(site_url('Admin')); 
                // onda niko nije ulogovan
                return redirect()->to(site_url('Gost')); 
            }
            else {
                $korisnik = $session->get('korisnik');
                if ($korisnik->banovan == true) { unset($_SESSION['korisnik']); return redirect()->to(site_url('Gost')); }
                if (isset($korisnik->apr)) {
                    if (!isset($korisnik->odobren) || $korisnik->odobren == false) {
                        unset($_SESSION['korisnik']); return redirect()->to(site_url('Gost'));
                    }
                }
            }
       }
            
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}