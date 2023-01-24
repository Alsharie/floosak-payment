<?php

namespace Alsharie\FloosakPayment\Responses;


class FloosakVerifyKeyResponse extends FloosakResponse
{


    /**
     * @return string
     */
    public function getKey()
    {
        if (!empty($this->data['key'])) {
            return $this->data['key'];
        }

        return false;
    }


    /**
     * @return string
     */
    public function getAccount()
    {
        if (!empty($this->data['account_detail'])) {
            if ($this->data['account_detail']['account'])
                return $this->data['account_detail']['account'];
        }

        return false;
    }



    /**
     * @return string
     */
    public function getWallets()
    {
        if ($this->getAccount()) {
            return $this->getAccount()['wallets'];
        }

        return false;
    }
    /**
     * @return string
     */
    public function getWalletId()
    {
        if ($this->getWallets()) {
            return $this->getWallets()[0]['id'];
        }

        return false;
    }


}