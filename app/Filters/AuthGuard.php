<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Allow Postman API calls (skip session check)
        if ($request->hasHeader('Postman-Token')) {
            return;
        }

        // Check session for web users
        if (! session()->get('isLoggedIn')) {
            return redirect()
                ->to('/login')
                ->with('error', 'Please log in to continue.');
        }

        // If everything is fine, continue as normal
        return;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nothing required here for now
    }
}
