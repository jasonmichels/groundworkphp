<?php namespace GroundworkPHP\Framework\Exceptions;

use GroundworkPHP\Framework\Contracts\Exceptions\NotFound as NotFoundInterface;

/**
 * Class NotFound
 *
 * Not found exception
 *
 * @package GroundworkPHP\Framework\Exceptions
 * @author Jason Michels <michelsja@gmail.com>
 * @version $Id$
 */
class NotFound extends \Exception implements NotFoundInterface
{
    /**
     * NotFound constructor.
     *
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Get title of exception
     *
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
