<?php
/**
 * Code Test - Price fetch from external API
 *
 * @category: Magento
 * @package: CodeTest/price
 * @author: Perficient Developer <suraj.jaiswal@perficient.com>
 */

namespace CodeTest\Price\Model;

use CodeTest\Price\Api\Data\PriceInterface;
use CodeTest\Price\Api\PriceRepositoryInterface;
use Magento\Framework\HTTP\ZendClientFactory;
use CodeTest\Price\Logger\PriceLogger;
use CodeTest\Price\Helper\Data as PriceHelperData;

class PriceRepository implements PriceRepositoryInterface
{
    public function __construct(
        private ZendClientFactory $zendClientFactory,
        private PriceLogger $priceLogger,
        private PriceHelperData $priceHelperData,
        private PriceInterface $priceModel
    ) {
    }

    /**
     * @param int $productId
     * @return PriceInterface|null
     */
    public function get(int $productId): ?PriceInterface
    {
        try {
            if (empty($productId) || !is_int($productId)) {
                throw new \Exception(__('Product Id is not provided OR it is not in required type'));
            }

            $priceApiUrlWithProdId = $this->priceHelperData->getPriceApiEndpointUrl() . $productId;
            $response = $this->getPriceApiResponse($priceApiUrlWithProdId);

            if (is_array($response) && isset($response['data']['product_id'])
                && isset($response['data']['unit_price'])) {
                $this->priceModel->setProductId($response['data']['product_id']);
                $this->priceModel->setUnitPrice($response['data']['unit_price']);
                return $this->priceModel;
            }
        } catch (\Exception $e) {
            $this->priceLogger->critical($e);
        }

        return null;
    }

    /**
     * Get price API response
     *
     * @param $priceApiUrlWithProdId string
     * @return array|null
     */
    private function getPriceApiResponse($priceApiUrlWithProdId): ?array
    {
        $decodedResponse = null;
        try {
            $client = $this->zendClientFactory->create();
            $client->setUri($priceApiUrlWithProdId);
            $client->setHeaders(['Content-Type: application/json', 'Accept: application/json']);
            $client->setMethod(\Zend_Http_Client::GET);
            $response = $client->request()->getBody();

            if (!empty($response)) {
                $decodedResponse = json_decode($response, true);
            }
        } catch (\Exception $e) {
            $this->priceLogger->critical($e);
        }

        return $decodedResponse;
    }
}
