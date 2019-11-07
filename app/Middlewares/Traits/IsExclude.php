<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Middlewares\Traits;

trait IsExclude
{
    /**
     * @param string $uri
     * @return bool
     */
    protected function isExclude($uri): bool
    {
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
}
