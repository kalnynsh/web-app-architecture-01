<?php

declare(strict_types = 1);

namespace Model\Repository;

use Model\Entity;

class Product
{
    /**
     * Поиск конкретного продукта
     *
     * @param int $id
     * @return Entity\Product
     */
    public function find(int $id): Entity\Product
    {
        return $this->fetchAll()[$id];
    }

    /**
     * Получаем все продукты
     *
     * @return Entity\Product[]
     */
    public function fetchAll(): array
    {
        return [
            1 => new Entity\Product(1, 'PHP', 15300),
            2 => new Entity\Product(2, 'Python', 20400),
            3 => new Entity\Product(3, 'C#', 30100),
            4 => new Entity\Product(4, 'Java', 30600),
            5 => new Entity\Product(5, 'Ruby', 18600),
            8 => new Entity\Product(8, 'Delphi', 8400),
            9 => new Entity\Product(9, 'C++', 19300),
            10 => new Entity\Product(10, 'C', 12800),
            11 => new Entity\Product(11, 'Lua', 5000),
        ];
    }
}
