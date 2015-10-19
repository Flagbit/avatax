<?php
/**
 * OnePica_AvaTax
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0), a
 * copy of which is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   OnePica
 * @package    OnePica_AvaTax
 * @author     OnePica Codemaster <codemaster@onepica.com>
 * @copyright  Copyright (c) 2009 One Pica, Inc.
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

/**
 * The base AvaTax Helper class
 *
 * @category   OnePica
 * @package    OnePica_AvaTax
 * @author     OnePica Codemaster <codemaster@onepica.com>
 */
class OnePica_AvaTax_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Path to is AvaTax disabled.
     */
    const XML_PATH_TO_TAX_AVATAX_LOG_STATUS = 'tax/avatax/log_status';

    /**
     * Path to the logging type
     */
    const XML_PATH_TO_TAX_AVATAX_LOG_TYPE_LIST = 'tax/avatax/log_type_list';

    /**
     * Check if avatax extension is enabled
     *
     * @param null|bool|int|Mage_Core_Model_Store $store $store
     *
     * @return bool
     */
    public function isAvataxEnabled($store = null)
    {
        return (Mage::getStoreConfig(OnePica_AvaTax_Helper_Config::XML_PATH_TO_TAX_AVATAX_ACTION, $store)
            != OnePica_AvaTax_Model_Config::ACTION_DISABLE);
    }

    /**
     * Gets the documenation url
     *
     * @return string
     */
    public function getDocumentationUrl()
    {
        return 'http://www.onepica.com/magento-extensions/avatax/';
    }

    /**
     * Returns the logging level
     *
     * @param null|bool|int|Mage_Core_Model_Store $store
     *
     * @return int
     */
    public function getLogMode($store = null)
    {
        return Mage::getStoreConfig(self::XML_PATH_TO_TAX_AVATAX_LOG_STATUS, $store);
    }

    /**
     * Returns the logging type
     *
     * @param null|bool|int|Mage_Core_Model_Store $store
     *
     * @return string
     */
    public function getLogType($store = null)
    {
        return explode(",", Mage::getStoreConfig(self::XML_PATH_TO_TAX_AVATAX_LOG_TYPE_LIST, $store));
    }

    /**
     * Does any store have this extension disabled?
     *
     * @return bool
     */
    public function isAnyStoreDisabled()
    {
        $disabled        = false;
        $storeCollection = Mage::app()->getStores();

        foreach ($storeCollection as $store) {
            $disabled |= Mage::getStoreConfig(OnePica_AvaTax_Helper_Config::XML_PATH_TO_TAX_AVATAX_ACTION, $store->getId())
                == OnePica_AvaTax_Model_Config::ACTION_DISABLE;
        }

        return $disabled;
    }

    /**
     * Round up
     *
     * @param float $value
     * @param int $precision
     *
     * @return float
     */
    public function roundUp($value, $precision)
    {
        $fact = pow(10, $precision);

        return ceil($fact * $value) / $fact;
    }
}
