<?php

namespace Omnipay\Csob\Core\Message;

use OndraKoupil\Csob\Client;
use OndraKoupil\Csob\Config;
use OndraKoupil\Csob\GatewayUrl;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    public function setBankPublicKeyFilePath($value)
    {
        return $this->setParameter('bankPublicKeyFilePath', $value);
    }

    public function setPrivateKeyFilePath($value)
    {
        return $this->setParameter('privateKeyFilePath', $value);
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function setMerchantName($value)
    {
        return $this->setParameter('merchantName', $value);
    }

    public function setClosePayment($value)
    {
        return $this->setParameter('closePayment', $value);
    }

    public function getClient(): Client
    {
        $config = new Config(
            $this->getParameter('merchantId'),
            $this->getParameter('privateKeyFilePath'),
            $this->getParameter('bankPublicKeyFilePath'),
            $this->getParameter('merchantName'),
            $this->getReturnUrl(),
            $this->getTestMode() ? GatewayUrl::TEST_LATEST : GatewayUrl::PRODUCTION_LATEST
        );

        $config->closePayment = $this->getParameter('closePayment');

        return new Client($config);
    }
}
