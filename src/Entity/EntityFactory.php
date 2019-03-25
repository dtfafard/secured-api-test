<?php
/**
 * Created by PhpStorm.
 * User: Psyke
 * Date: 3/25/2019
 * Time: 4:57 PM
 */

namespace App\Entity;


class EntityFactory
{
    /**
     * @param array $data
     * @param string $className
     * @return SeedboxEntityInterface
     */
    public static function initEntity(array $data, string $className) : SeedboxEntityInterface
    {
        $entity = new $className();
        return $entity->init($data);
    }
}