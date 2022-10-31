<?php
/**
 * Code Test - Price fetch from external API
 *
 * @category: Magento
 * @package: CodeTest/price
 * @author: Perficient Developer <suraj.jaiswal@perficient.com>
 */

namespace CodeTest\Price\Helper;

class Data
{
    const EXTERNAL_API_URL = 'https://stagecerewards.carrierenterprise.com/';

    const PRICE_API_ENDPOINT = 'v1/price/';

    /**
     * Get the price API URL
     *
     * @return string
     */
    public function getPriceExternalApiUrl(): string
    {
        return self::EXTERNAL_API_URL;
    }

    /**
     * Get price end point
     *
     * @return string
     */
    public function getPriceEndpoint(): string
    {
        return self::PRICE_API_ENDPOINT;
    }

    /**
     * Get price API end point URL
     *
     * @return string
     */
    public function getPriceApiEndpointUrl(): string
    {
        return $priceApiEndpointUrl = $this->getPriceExternalApiUrl()
            . $this->getPriceEndpoint();
    }

}
