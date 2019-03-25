<?php
/**
 * Created by PhpStorm.
 * User: Psyke
 * Date: 3/25/2019
 * Time: 5:01 PM
 */

namespace App\Entity;


abstract class SeedboxEntityAbstract implements SeedboxEntityInterface
{
    /**
     * Enforces the use of validateInitData while calling init
     *
     * {@inheritdoc}
     */
    public final function init(array $data) : SeedboxEntityInterface
    {
        $this->validateInitData($data);

        return $this->initData($data);
    }

    /**
     * Initializes the minimal entity data requirements
     *
     * Function is protected because it does not validate data entries. They are validated through validateInitData
     * inside the init function.
     *
     * @param array $data
     * @return SeedboxEntityInterface
     * @throws \TypeError
     */
    abstract protected function initData(array $data) : SeedboxEntityInterface;
}