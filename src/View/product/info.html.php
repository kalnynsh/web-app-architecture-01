<?php

/** @var \Model\Entity\Product $productInfo */
$body = function () use ($productInfo) {
    echo  <<<EOL
Супер {$productInfo->getName()} курс всего за {$productInfo->getPrice()} руб.
<br /><br />
Положить в корзину
EOL;
};

$renderLayout(
    'main_template.html.php',
    [
        'title' => 'Курс ' . $productInfo->getName(),
        'body' => $body,
    ]
);
