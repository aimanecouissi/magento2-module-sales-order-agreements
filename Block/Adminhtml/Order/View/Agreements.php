<?php
/**
 * Aimane Couissi - https://aimanecouissi.com
 * Copyright © Aimane Couissi 2026–present. All rights reserved.
 * Licensed under the MIT License. See LICENSE for details.
 */

declare(strict_types=1);

namespace AimaneCouissi\SalesOrderAgreements\Block\Adminhtml\Order\View;

use InvalidArgumentException;
use Magento\CheckoutAgreements\Api\CheckoutAgreementsRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Sales\Model\Order;

class Agreements extends Template
{
    /**
     * @param Context $context
     * @param Registry $registry
     * @param SerializerInterface $serializer
     * @param CheckoutAgreementsRepositoryInterface $agreementsRepository
     * @param array $data
     */
    public function __construct(
        Context                                                $context,
        private readonly Registry                              $registry,
        private readonly SerializerInterface                   $serializer,
        private readonly CheckoutAgreementsRepositoryInterface $agreementsRepository,
        array                                                  $data = [],
    )
    {
        parent::__construct($context, $data);
    }

    /**
     * Returns the URL for viewing a specific agreement.
     *
     * @param int $agreementId
     * @return string
     */
    public function getAgreementViewUrl(int $agreementId): string
    {
        return $this->_urlBuilder->getUrl('checkout/agreement/edit', ['id' => $agreementId]);
    }

    /**
     * Checks if an agreement still exists in the system.
     *
     * @param int $agreementId
     * @return bool
     */
    public function agreementExists(int $agreementId): bool
    {
        try {
            $this->agreementsRepository->get($agreementId);
            return true;
        } catch (NoSuchEntityException) {
            return false;
        }
    }

    /**
     * Indicates whether the current order contains any stored agreements.
     *
     * @return bool
     */
    public function hasAgreements(): bool
    {
        return !empty($this->getAgreements());
    }

    /**
     * Returns the decoded agreements payload stored in the current order.
     *
     * @return array
     */
    public function getAgreements(): array
    {
        /** @var Order|null $order */
        $order = $this->registry->registry('current_order');
        $agreementsJson = $order?->getData('agreements');
        if (empty($agreementsJson)) {
            return [];
        }
        try {
            $agreements = $this->serializer->unserialize($agreementsJson);
            return is_array($agreements) ? $agreements : [];
        } catch (InvalidArgumentException) {
            return [];
        }
    }
}
