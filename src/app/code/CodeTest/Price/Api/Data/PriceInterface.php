<?php

namespace CodeTest\Price\Api\Data;

/**
 * @api
 */
interface PriceInterface
{
    /**
     * String constants for property names
     */
    public const PRODUCT_ID = 'product_id';
    public const UNIT_PRICE = 'unit_price';

    /**
     * Getter for ProductId.
     *
     * @return int
     */
    public function getProductId(): int;

    /**
     * Setter for ProductId.
     *
     * @param int $productId
     *
     * @return void
     */
    public function setProductId(int $productId): void;

    /**
     * Getter for UnitPrice.
     *
     * @return float
     */
    public function getUnitPrice(): float;

    /**
     * Setter for UnitPrice.
     *
     * @param float $unitPrice
     *
     * @return void
     */
    public function setUnitPrice(float $unitPrice): void;

    /**
     * Convert array of object data with to array with keys requested in $keys array
     *
     * @param array $keys array of required keys
     * @return array
     */
    public function toArray(array $keys = []): array;
}
