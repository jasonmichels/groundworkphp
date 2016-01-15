<?php namespace GroundworkPHP\Framework\Contracts\Exceptions;

/**
 * Interface MethodNotAllowed
 *
 * Interface for method not allowed exception
 *
 * @package GroundworkPHP\Framework\Contracts\Exceptions
 * @author Jason Michels <michelsja@gmail.com>
 * @version $Id$
 */
interface MethodNotAllowed
{
    const HTTP_STATUS_CODE = 405;

    /**
     * Get title of exception
     *
     * @return string
     */
    public function getTitle();

    /**
     * Get the http status code for exception
     *
     * @return int
     */
    public function getHttpStatus();
}
