<?php namespace Groundwork\Exceptions;

/**
 * Class MethodNotAllowed
 *
 * Method not allowed exception
 *
 * @package Groundwork\Exceptions
 * @author Jason Michels <michelsja@gmail.com>
 * @version $Id$
 */
class MethodNotAllowed extends \Exception
{
    const HTTP_STATUS_CODE = 405;

    public $allowedMethods = [];

    public function __construct($message, $code = 0, \Exception $previous = null, $allowedMethods)
    {
        parent::__construct($message, $code, $previous);
        $this->allowedMethods = $allowedMethods;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return 'Method not allowed on requested URL';
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
