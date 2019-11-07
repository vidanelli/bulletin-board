<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Core\Http\Exception;

use Phalcon\Http\Response\HeadersInterface;

abstract class HttpException extends \RuntimeException implements HttpExceptionInterface
{
    /**
     * @var string
     */
    protected $message = 'HTTP Exception';

    /**
     * @var int
     */
    protected $statusCode;

    /**
     * @var \Phalcon\Http\Response\HeadersInterface
     */
    protected $headers;

    public function __construct(string $message = null, \Throwable $previous = null, HeadersInterface $headers = null, int $code = 0)
    {
        $this->headers = $headers;

        $message = $message ?? $this->message;

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return void
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return \Phalcon\Http\Response\HeadersInterface
     */
    public function getHeaders(): HeadersInterface
    {
        return $this->headers;
    }

    /**
     * @param \Phalcon\Http\Response\HeadersInterface $headers
     * @return void
     */
    public function setHeaders(HeadersInterface $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * @return bool
     */
    public function hasHeaders(): bool
    {
        return (bool)$this->headers;
    }

}
