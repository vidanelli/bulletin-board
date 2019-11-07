<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Core\Http\Exception;

class TokenMismatchException extends HttpException
{
    /**
     * @var string
     */
    protected $message = 'CSRF token mismatch.';

    /**
     * @var int
     */
    protected $statusCode = 403;
}
