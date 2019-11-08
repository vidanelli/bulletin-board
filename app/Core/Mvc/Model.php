<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Core\Mvc;

use function App\Helpers\camelize;

abstract class Model extends \Phalcon\Mvc\Model
{
    const DELETED = 1;

    const NOT_DELETED = 0;

    const ACTIVE = 1;

    const NOT_ACTIVE = 0;

    /**
     * @var array
     */
    protected $append = [];

    /**
     * @param array|null $columns
     * @return array
     */
    public function toArray($columns = null): array
    {
        $data = array_merge(parent::toArray($columns), $this->getAppends());

        return $data;
    }

    /**
     * @return array
     */
    protected function getAppends(): array
    {
        $appends = [];

        foreach ($this->append as $append) {
            $appends[$append] = $this->{'get' . camelize($append)}();
        }

        return $appends;
    }

}
