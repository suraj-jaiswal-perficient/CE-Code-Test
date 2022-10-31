<?php

namespace CodeTest\Price\Model\Data;

use CodeTest\Price\Api\Data\PriceInterface;
use Magento\Framework\DataObject;

class Price extends DataObject implements PriceInterface
{
    public function getProductId(): int
    {
        return (int)$this->getData(self::PRODUCT_ID);
    }

    public function setProductId(int $productId): void
    {
        $this->setData(self::PRODUCT_ID, $productId);
    }

    public function getUnitPrice(): float
    {
        return (float)$this->getData(self::UNIT_PRICE);
    }

    public function setUnitPrice(float $unitPrice): void
    {
        $this->setData(self::UNIT_PRICE, $unitPrice);
    }

    public function toArray(array $keys = []): array
    {
        return parent::toArray($keys);
    }
}
