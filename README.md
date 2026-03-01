# AimaneCouissi_SalesOrderAgreements

[![Latest Stable Version](http://poser.pugx.org/aimanecouissi/module-sales-order-agreements/v)](https://packagist.org/packages/aimanecouissi/module-sales-order-agreements) [![Total Downloads](http://poser.pugx.org/aimanecouissi/module-sales-order-agreements/downloads)](https://packagist.org/packages/aimanecouissi/module-sales-order-agreements) [![Magento Version Require](https://img.shields.io/badge/magento-2.4.x-E68718)](https://packagist.org/packages/aimanecouissi/module-sales-order-agreements) [![License](http://poser.pugx.org/aimanecouissi/module-sales-order-agreements/license)](https://packagist.org/packages/aimanecouissi/module-sales-order-agreements) [![PHP Version Require](http://poser.pugx.org/aimanecouissi/module-sales-order-agreements/require/php)](https://packagist.org/packages/aimanecouissi/module-sales-order-agreements)

Adds a **Terms and Conditions** section to the Admin order view page showing the checkout agreements accepted by the customer.

## Installation
```bash
composer require aimanecouissi/module-sales-order-agreements
bin/magento module:enable AimaneCouissi_SalesOrderAgreements
bin/magento setup:upgrade
bin/magento cache:flush
```

## Usage

Active checkout agreements are saved on the order at the time of placement. Open any order in **Admin → Sales → Orders** to see the **Terms and Conditions** section listing each agreement's name and content as it was accepted. A **View** link is shown for agreements that still exist in the system, opening them in a new tab.

## Uninstall
```bash
bin/magento module:disable AimaneCouissi_SalesOrderAgreements
composer remove aimanecouissi/module-sales-order-agreements
bin/magento setup:upgrade
bin/magento cache:flush
```

## License

[MIT](LICENSE)
