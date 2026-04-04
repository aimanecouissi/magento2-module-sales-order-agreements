<?php
/**
 * Aimane Couissi - https://aimanecouissi.com
 * Copyright © Aimane Couissi 2026–present. All rights reserved.
 * Licensed under the MIT License. See LICENSE for details.
 */

declare(strict_types=1);

namespace AimaneCouissi\SalesOrderAgreements\Observer;

use Exception;
use Magento\CheckoutAgreements\Api\CheckoutAgreementsListInterface;
use Magento\CheckoutAgreements\Model\Api\SearchCriteria\ActiveStoreAgreementsFilter;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Sales\Model\Order;
use Magento\Sales\Model\OrderRepository;
use Psr\Log\LoggerInterface;

class AddAgreementsToOrderObserver implements ObserverInterface
{
    /**
     * @param CheckoutAgreementsListInterface $agreementsList
     * @param ActiveStoreAgreementsFilter $activeStoreAgreementsFilter
     * @param SerializerInterface $serializer
     * @param OrderRepository $orderRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        private readonly CheckoutAgreementsListInterface $agreementsList,
        private readonly ActiveStoreAgreementsFilter     $activeStoreAgreementsFilter,
        private readonly SerializerInterface             $serializer,
        private readonly OrderRepository                 $orderRepository,
        private readonly LoggerInterface                 $logger,
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(Observer $observer): void
    {
        /** @var Order $order */
        $order = $observer->getEvent()->getData('order');
        $agreements = $this->getActiveAgreementsForStore();
        if (!empty($agreements)) {
            $order->setData('agreements', $this->serializer->serialize($agreements));
            try {
                $this->orderRepository->save($order);
            } catch (Exception $e) {
                $this->logger->error(__('An error occurred while saving the order agreements: %1', $e->getMessage()));
            }
        }
    }

    /**
     * Retrieves the active checkout agreements for the current store.
     *
     * @return array
     */
    private function getActiveAgreementsForStore(): array
    {
        try {
            $searchCriteria = $this->activeStoreAgreementsFilter->buildSearchCriteria();
            $searchResults = $this->agreementsList->getList($searchCriteria);
            $agreements = [];
            foreach ($searchResults as $agreement) {
                $agreements[] = [
                    'id' => (int)$agreement->getAgreementId(),
                    'name' => $agreement->getName(),
                    'content' => $agreement->getContent(),
                    'is_html' => (bool)$agreement->getIsHtml(),
                ];
            }
            return $agreements;
        } catch (Exception) {
            return [];
        }
    }
}
