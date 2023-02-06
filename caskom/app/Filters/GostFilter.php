<?php

namespace App\Filters;

/* Sava Gavrić 0359/18 */

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

 /**
 * GostFilter - Filter za stranice gosta.
 * 
 * @version 1.0
 */
class GostFilter implements FilterInterface
{
    /**
     * before
     * Poziva se pre ispunjenja zahteva i redirect-uje klijenta na 
     * odgovarajuću adresu ukoliko jeste ulogovan.
     * @param  mixed $request - zahtev za odgovarajuću adresom
     * @param  mixed[] $arguments - argumenti zahteva
     * @return void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
       $session=session();
       if ($session != null) {
           if ($session->has('korisnik')) 
               return redirect()->to(site_url('Korisnik'));
           else if ($session->has('moderator'))
               return redirect()->to(site_url('Moderator'));
           else if ($session->has('admin'))
               return redirect()->to(site_url('Admin'));
       }
            
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}