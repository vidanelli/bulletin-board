<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\System\Exception;

use Phalcon\Http\Response\HeadersInterface;

interface HttpExceptionInterface
{
    /**
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * @param int $statusCode
     * @return void
     */
    public function setStatusCode(int $statusCode): void;

    /**
     * @return \Phalcon\Http\Response\HeadersInterface
     */
    public function getHeaders(): HeadersInterface;

    /**
     * @param \Phalcon\Http\Response\HeadersInterface $headers
     * @return void
     */
    public function setHeaders(HeadersInterface $headers): void;

    /**
     * @return bool
     */
    public function hasHeaders(): bool;
}
