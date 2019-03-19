<?php
namespace Packt\Table\Plugin;
use Magento\Catalog\Api\ProductRepositoryInterface;

class Image {
    protected $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;

    }

    public function aroundGetItemData($subject, $proceed, $item) {
        $result = $proceed($item);
        $result['product_name'] = $result['product_sku'];
        $product = $this->productRepository->get($result['product_sku']);
        $imgUrl = $product->getData('image');
        $oldUrl = $result['product_image']['src'];
        $result['product_image']['src'] = preg_replace('/product\/(.*)/', 'product' . $imgUrl, $oldUrl);
        return $result;
    }
}