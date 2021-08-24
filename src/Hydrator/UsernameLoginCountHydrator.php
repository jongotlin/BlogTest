<?php

namespace App\Hydrator;

use App\Model\UsernameAndLoginCount;
use Doctrine\ORM\Internal\Hydration\AbstractHydrator;

class UsernameLoginCountHydrator extends AbstractHydrator
{
    protected function hydrateAllData()
    {
        $result = [];
        foreach ($this->_stmt->fetchAll() as $data) {
            $result[] = new UsernameAndLoginCount($data['email'], (int) $data['c']);
        }

        return $result;
    }
}
