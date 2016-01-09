<?php namespace GroundworkPHP\Framework\Exceptions;

/**
 * Class NotFound
 *
 * Not found exception
 *
 * @package GroundworkPHP\Framework\Exceptions
 * @author Jason Michels <michelsja@gmail.com>
 * @version $Id$
 */
class NotFound extends \Exception
{
    const HTTP_STATUS_CODE = 404;

    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return 'Requested URL is not found';
    }

    /**
     * Get the http status code for exception
     *
     * @return int
     */
    public function getHttpStatus()
    {
        return self::HTTP_STATUS_CODE;
    }
}
