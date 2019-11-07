<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Middlewares;

use function App\Helpers\container;
use App\Core\Http\Exception\TokenMismatchException;
use Phalcon\Http\RequestInterface;
use App\Middlewares\Traits\IsExclude;

class VerifyCsrf
{
    use IsExclude;

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
        if (
            $this->isReading($request) ||
            $this->isExclude($request->getURI()) ||
            $this->isVerified($request)
        ) {
            return true;
        }

        throw new TokenMismatchException();
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
    protected function isVerified(RequestInterface $request): bool
    {
        $tokenKey = $request->getHeader('X-CSRF-TOKEN-KEY');
        $tokenValue = $request->getHeader('X-CSRF-TOKEN');

        return container('security')->checkToken($tokenKey, $tokenValue, false);
    }
}
