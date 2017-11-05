<?php
/**
 * Created by PhpStorm.
 * User: amacabr2
 * Date: 05/11/17
 * Time: 11:33
 */

namespace UserBundle\Helper;


use Symfony\Component\HttpFoundation\Response;

trait ControllerHelper {

    /**
     * Set base HTTP headers.
     *
     * @param Response $response
     *
     * @return Response
     */
    private function setBaseHeaders(Response $response): Response{
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}