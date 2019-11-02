<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Middlewares;

use function BulletinBoardProject\Helpers\container;
use BulletinBoardProject\System\Exception\UnauthorizedException;
use Phalcon\Http\RequestInterface;

class VerifyCsrf
{
    /**
     * @var array
     */
    protected $exclude = [
        '/api/*',
    ];

    /**
     * @param RequestInterface $request
     * @return bool
     */
    public function execute(RequestInterface $request): bool
    {
        if ($this->isReading($request) || $this->isExclude($request) || $this->isVerified($request)) {
            return true;
        }

        throw new UnauthorizedException();
    }

    /**
     * @param RequestInterface $request
     * @return bool
     */
    protected function isReading(RequestInterface $request): bool
    {
        return in_array($request->getMethod(), ['HEAD', 'GET', 'OPTIONS']);
    }

    /**
     * @param RequestInterface $request
     * @return bool
     */
    protected function isExclude(RequestInterface $request): bool
    {
        $uri = $request->getURI();

        foreach ($this->exclude as $pattern) {
            if ($pattern === $uri) {
                return true;
            }

            $pattern = preg_quote($pattern, '#');
            $pattern = str_replace('\*', '.*', $pattern);

            if (preg_match("#^{$pattern}$#u", $uri) === 1) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param RequestInterface $request
     * @return bool
     */
    protected function isVerified(RequestInterface $request): bool
    {
        $tokenKey = $request->getHeader('X-CSRF-TOKEN-KEY');
        $tokenValue = $request->getHeader('X-CSRF-TOKEN');

        return container('security')->checkToken($tokenKey, $tokenValue, false);
    }
}
