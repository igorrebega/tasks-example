<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiException
 */
class ApiException extends Exception
{
    /** @var int Status */
    private int $httpStatusCode;

    /** @var string Type */
    private string $errorType;

    /** @var string|null Hint how to solve exception */
    private ?string $hint;

    /** @var array If there are additional rows to add */
    private array $additionalRows = [];

    /**
     * Throw a new exception.
     *
     * @param string      $message        Error message
     * @param int         $code           Error code
     * @param string      $errorType      Error type
     * @param int         $httpStatusCode HTTP status code to send (default = 400)
     * @param null|string $hint           A helper hint
     * @param array       $additionalRows Rows
     */
    public function __construct($message, $code, $errorType, $httpStatusCode = 400, $hint = null, $additionalRows = [])
    {
        parent::__construct($message, $code);

        $this->httpStatusCode = $httpStatusCode;
        $this->errorType = $errorType;
        $this->hint = $hint;
        $this->additionalRows = $additionalRows;
    }

    /**
     * @return string
     */
    public function getErrorType()
    {
        return $this->errorType;
    }

    /**
     * Get all headers that have to be send with the error response.
     *
     * @return array Array with header values
     */
    public function getHttpHeaders()
    {
        return [
            'Content-type' => 'application/json',
        ];
    }

    /**
     * Returns the HTTP status code to send when the exceptions is output.
     *
     * @return int
     */
    public function getHttpStatusCode()
    {
        return $this->httpStatusCode;
    }

    /**
     * @return null|string
     */
    public function getHint()
    {
        return $this->hint;
    }

    /**
     * Response
     *
     * @return Response
     */
    public function generateHttpResponse()
    {
        $headers = $this->getHttpHeaders();

        $payload = [
            'error' => $this->getErrorType(),
            'message' => $this->getMessage(),
        ];

        if ($this->hint !== null) {
            $payload['hint'] = $this->hint;
        }
        $payload = array_merge($payload, $this->additionalRows);

        return response(json_encode($payload), $this->getHttpStatusCode(), $headers);
    }
}
