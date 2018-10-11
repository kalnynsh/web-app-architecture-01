<?php

declare(strict_types = 1);

namespace Controller;

use Framework\Render;
use Service\Product;
use Symfony\Component\HttpFoundation\Response;

class ProductController
{
    use Render;

    /**
     * Информация о продукте
     *
     * @param string $id
     * @return Response
     */
    public function infoAction($id): Response
    {
        $productInfo = (new Product())->getOne((int)$id);

        return $this->render('product/info.html.php', ['productInfo' => $productInfo]);
    }

    /**
     * Список всех продуктов
     *
     * @return Response
     */
    public function listAction(): Response
    {
        $productList = (new Product())->getAll();

        return $this->render('product/list.html.php', ['productList' => $productList]);
    }
}
