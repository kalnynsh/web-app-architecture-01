<?php

declare(strict_types = 1);

namespace Test\Service;

use Model\Entity\Product as ProductEntity;
use Model\Repository\Product as ProductRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Service\Product as ProductService;

class ProductTest extends TestCase
{
    /**
     * @dataProvider dataProviderProduct
     *
     * @param int $productId
     * @param string $productName
     * @param float $productPrice
     */
    public function testGetOneProduct(int $productId, string $productName, float $productPrice)
    {
        $productRepository = $this->getMockBuilder(ProductRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $productRepository->method('find')
            ->willReturn(new ProductEntity($productId, $productName, $productPrice));

        /** @var ProductService|MockObject $productService */
        $productService = $this->getMockBuilder(ProductService::class)
            ->disableOriginalConstructor()
            ->setMethods(['getProductRepository'])
            ->getMock();

        $productService->method('getProductRepository')
            ->willReturn($productRepository);

        $product = $productService->getOne($productId);

        $this->assertEquals($productId, $product->getId());
        $this->assertEquals($productName, $product->getName());
        $this->assertEquals($productPrice, $product->getPrice());
    }

    /**
     * @return \Generator
     */
    public function dataProviderProduct(): \Generator
    {
        yield 'empty product' => [
            'productId' => 0,
            'productName' => '',
            'productPrice' => 0,
        ];

        yield 'product' => [
            'productId' => 10,
            'productName' => 'Test',
            'productPrice' => 199.99,
        ];

        yield 'product max values' => [
            'productId' => PHP_INT_MAX,
            'productName' => 'Test',
            'productPrice' => 1.7976931348623e+308,
        ];
    }

    /**
     * @dataProvider dataProviderAllProduct
     *
     * @param ProductEntity[] $productEntities
     */
    public function testGetAllProducts(array $productEntities)
    {
        $productRepository = $this->getMockBuilder(ProductRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $productRepository->method('fetchAll')
            ->willReturn($productEntities);

        /** @var ProductService|MockObject $productService */
        $productService = $this->getMockBuilder(ProductService::class)
            ->disableOriginalConstructor()
            ->setMethods(['getProductRepository'])
            ->getMock();

        $productService->method('getProductRepository')
            ->willReturn($productRepository);

        $productList = $productService->getAll();

        $this->assertEquals($productEntities, $productList);
    }

    /**
     * @return \Generator
     */
    public function dataProviderAllProduct(): \Generator
    {
        yield 'empty product list' => [
            [
            ]
        ];

        yield 'product list' => [
            [
                new ProductEntity(3, 'Another', 50.11),
                new ProductEntity(10, 'Test', 199.99),
            ]
        ];

        yield 'product list with extreme values' => [
            [
                new ProductEntity(0, '', 0),
                new ProductEntity(PHP_INT_MAX, 'Test', 1.7976931348623e+308),
            ]
        ];
    }
}
