<?php

declare(strict_types = 1);

namespace Controller;

use Framework\Render;
use Symfony\Component\HttpFoundation\Response;

class OrderController
{
    use Render;

    /**
     * Корзина
     *
     * @return Response
     */
    public function checkInAction(): Response
    {
        return $this->render('order/check_in.html.php');
    }
}
