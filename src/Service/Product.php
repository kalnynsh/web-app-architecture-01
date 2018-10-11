<?php

declare(strict_types = 1);

namespace Service;

use Model;

class Product
{
    /**
     * Получаем конкретный продукт
     *
     * @param int $id
     * @return Model\Entity\Product
     */
    public function getOne(int $id): Model\Entity\Product
    {
        return $this->getProductRepository()->find($id);
    }

    /**
     * Получаем все продукты
     *
     * @return Model\Entity\Product[]
     */
    public function getAll(): array
    {
        return $this->getProductRepository()->fetchAll();
    }

    /**
     * Фабричный метод для репозитория Product
     *
     * @return Model\Repository\Product
     */
    public function getProductRepository(): Model\Repository\Product
    {
        return new Model\Repository\Product();
    }
}
