<?php

namespace Lvandi\OmnisendSDK\Tests;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Lvandi\OmnisendSDK\Types\Product;
use Lvandi\OmnisendSDK\Resources\Products;
use Lvandi\OmnisendSDK\Contracts\HttpClient;
use Lvandi\OmnisendSDK\Responses\ProductResponse;

class ProductsTest extends TestCase
{
    public function testCanCreateProduct(): void
    {
        $httpClient = $this->getHttpClientMock(200, 'CreateProductResponse.json');

        $product = new Products($httpClient);

        $response = $product->create(Product::fromRawData([]));

        $this->assertInstanceOf(ProductResponse::class, $response);

        $this->assertInstanceOf(Product::class, $response->getProduct());

        $this->assertNotNull($response->getProduct()->getProductID());
    }

    public function testCanGetProduct(): void
    {
        $httpClient = $this->getHttpClientMock(200, 'GetProductResponse.json');

        $product = new Products($httpClient);

        $response = $product->get('1234');

        $this->assertInstanceOf(ProductResponse::class, $response);

        $this->assertInstanceOf(Product::class, $response->getProduct());

        $this->assertNotNull($response->getProduct()->getProductID());
    }

    public function testCanDeleteProduct(): void
    {
        $httpClient = $this->getHttpClientMock(204, null);

        $product = new Products($httpClient);

        $response = $product->delete('1234');

        $this->assertInstanceOf(ProductResponse::class, $response);

        $this->assertEquals(204, $response->getStatusCode());
    }

    private function getFixture(string $fileName): string
    {
        $filePath = './tests/fixtures/'.$fileName;

        if (! file_exists($filePath)) {
            throw new \Exception('Fixture not found');
        }

        return (string) file_get_contents($filePath);
    }

    private function getHttpClientMock(
        int $status,
        ?string $fixtureFileName,
        ?array $headers = []
    ): HttpClient {
        $response = new Response(
            $status,
            $headers,
            ! is_null($fixtureFileName) ? $this->getFixture($fixtureFileName) : ''
        );

        $httpClient = $this->createMock(HttpClient::class);

        $httpClient->method('sendRequest')
            ->willReturn($response);

        return $httpClient;
    }
}
