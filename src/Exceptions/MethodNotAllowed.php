<?php namespace GroundworkPHP\Framework\Exceptions;

/**
 * Class MethodNotAllowed
 *
 * Method not allowed exception
 *
 * @package GroundworkPHP\Framework\Exceptions
 * @author Jason Michels <michelsja@gmail.com>
 * @version $Id$
 */
class MethodNotAllowed extends \Exception
{
    const HTTP_STATUS_CODE = 405;

    /**
     * Allowed methods for API
     * @todo Implement this feature
     * @var array
     */
    public $allowedMethods;

    /**
     * MethodNotAllowed constructor.
     *
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     * @param array $allowedMethods
     */
    public function __construct($message, $code = 0, \Exception $previous = null, $allowedMethods = [])
    {
        parent::__construct($message, $code, $previous);
        $this->allowedMethods = $allowedMethods;
    }

    /**
     * Get title of exception
     *
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
