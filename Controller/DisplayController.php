<?php

namespace MB\SecureDisplayBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DisplayController extends Controller
{
/**
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function decryptAction(Request $request)
    {
        // Get encryption service
        $encrypter = $this->get('encrypter');

        // Get data to decrypt
        $data = $request->request->get('keys', array());

        // Prepare results
        $results = array();

        // Loop on each key and decrypt it
        foreach ($data as $key => $value) {
            $results[$key] = $encrypter->decrypt($value);
        }

        // Return json formated array of results
        return new Response(json_encode($results));
    }
}
