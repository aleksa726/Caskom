<?php

namespace App\Filters;

/* Sava Gavrić 0359/18 */

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

/**
 * ModeratorFilter - Filter za stranice moderatora.
 * 
 * @version 1.0
 */
class ModeratorFilter implements FilterInterface
{
    /**
     * before
     * Poziva se pre ispunjenja zahteva i redirect-uje klijenta na 
     * odgovarajuću adresu ukoliko nije ulogovan kao moderator.
     * @param  mixed $request - zahtev za odgovarajuću adresom
     * @param  mixed[] $arguments - argumenti zahteva
     * @return void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
       $session=session();
       if ($session != null) {
            if (!$session->has('moderator')) {
                if ($session->has('korisnik'))
                    return redirect()->to(site_url('Korisnik')); 
                else if ($session->has('admin'))
                    return redirect()->to(site_url('Admin')); 
                // onda niko nije ulogovan
                return redirect()->to(site_url('Gost')); 
            }
            else {
                    $moderator = $session->get('moderator');
                    if ($moderator->obrisan == true) { unset($_SESSION['moderator']); return redirect()->to(site_url('Gost')); }
            }
       }
            
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}