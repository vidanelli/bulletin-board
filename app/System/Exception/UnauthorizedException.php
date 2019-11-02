<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\System\Exception;

class UnauthorizedException extends HttpException
{
    /**
     * @var string
     */
    protected $message = '401 Unauthorized';

    /**
     * @var int
     */
    protected $statusCode = 401;
}
