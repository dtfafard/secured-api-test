<?php
/**
 * Created by PhpStorm.
 * User: Psyke
 * Date: 3/25/2019
 * Time: 5:25 PM
 */

namespace App\Entity;

/**
 * Trait NameStatusEntityTrait
 *
 * The basic functions of data initialization for entities which only contain name & status properties
 *
 * @package App\Entity
 */
trait NameStatusEntityTrait
{
    /**
     * {@inheritdoc}
     */
    protected function initData(array $data): SeedboxEntityInterface
    {
        $this->setStatus(1)
            ->setName($data['name']);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function validateInitData(array $data): bool
    {
        if (!isset($data['name'])) {
            throw new \InvalidArgumentException('Missing Name');
        }

        return true;
    }
}