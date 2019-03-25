<?php
/**
 * Created by PhpStorm.
 * User: Psyke
 * Date: 3/25/2019
 * Time: 4:47 PM
 */

namespace App\Entity;


interface SeedboxEntityInterface
{
    /**
     * Initializes an entity
     *
     * @param array $data
     * @return SeedboxEntityInterface
     * @throws \InvalidArgumentException
     * @throws \TypeError
     */
    public function init(array $data) : SeedboxEntityInterface;

    /**
     * Validates the data to be used during init
     *
     * @param array $data
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function validateInitData(array $data) : bool;
}