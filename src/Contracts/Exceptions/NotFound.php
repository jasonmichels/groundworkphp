<?php namespace GroundworkPHP\Framework\Contracts\Exceptions;

/**
 * Interface NotFound
 *
 * Interface for not found exception
 *
 * @package GroundworkPHP\Framework\Contracts\Exceptions
 * @author Jason Michels <michelsja@gmail.com>
 * @version $Id$
 */
interface NotFound
{
    const HTTP_STATUS_CODE = 404;

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
