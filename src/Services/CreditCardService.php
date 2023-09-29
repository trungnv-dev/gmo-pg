<?php

namespace Ecs\GmoPG\Services;

use Ecs\GmoPG\Traits\GmoPaymentMethod;

class CreditCardService
{
    use GmoPaymentMethod;

    const ENTRY_TRAN               = '/payment/EntryTran.idPass';
    const EXEC_TRAN                = '/payment/ExecTran.idPass';
    const TDS2_AUTH                = '/payment/Tds2Auth.idPass';
    const TDS2_RESULT              = '/payment/Tds2Result.idPass';
    const TDS2_AUTH_APP            = '/payment/Tds2AuthApp.idPass';
    const TDS2_RESULT_APP          = '/payment/Tds2ResultApp.idPass';
    const SECURE_TRAN2             = '/payment/SecureTran2.idPass';
    const ALTER_TRAN               = '/payment/AlterTran.idPass';
    const CHANGE_TRAN              = '/payment/ChangeTran.idPass';
    const SEARCH_TRADE             = '/payment/SearchTrade.idPass';

    /**
     * API issue the transaction ID and transaction password required
     * for the settlement transaction and start the transaction.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/payment/credit/api#entrytran
     *
     * @param array $attributes
     *
     * @return array
     */
    public function entryTran(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::ENTRY_TRAN);

        $body = array_merge(self::retrieveBodyShop(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * API execute transaction (make payment)
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/payment/credit/api#exectran
     *
     * @param array $attributes
     *
     * @return array
     */
    public function execTran(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::EXEC_TRAN);

        $body = $attributes;

        if (isset($attributes['MemberID'])) {
            $body = array_merge(self::retrieveBodySite(), $attributes);
        }

        return self::execute($url, $body);
    }

    /**
     * Performs 3DS 2.0 authentication.
     * Execute this process at the timing when the callback of 3DS2.0 authentication initialization URL (RedirectUrl) is received.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/payment/credit/api3ds2#tds2auth
     *
     * @param array $attributes
     *
     * @return array
     */
    public function tds2Auth(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::TDS2_AUTH);

        $body = $attributes;

        return self::execute($url, $body);
    }

    /**
     * Get the final certification result of 3DS2.0 certification.
     * Please execute this process at the timing when the callback of 3DS2.0 authentication challenge URL (ChallengeUrl) is received.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/payment/credit/api3ds2#tds2result
     *
     * @param array $attributes
     *
     * @return array
     */
    public function tds2Result(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::TDS2_RESULT);

        $body = $attributes;

        return self::execute($url, $body);
    }

    /**
     * Performs 3DS 2.0 authentication.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/payment/credit/api3ds2#tds2authapp
     *
     * @param array $attributes
     *
     * @return array
     */
    public function tds2AuthApp(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::TDS2_AUTH_APP);

        $body = $attributes;

        return self::execute($url, $body);
    }

    /**
     * Get the final certification result of 3DS2.0 certification.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/payment/credit/api3ds2#tds2resultapp
     *
     * @param array $attributes
     *
     * @return array
     */
    public function tds2ResultApp(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::TDS2_RESULT_APP);

        $body = $attributes;

        return self::execute($url, $body);
    }

    /**
     * It analyzes the results of the 3DS2.0 service, uses that information to communicate with the card company, make payments, and return the results.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/payment/credit/api3ds2#securetran2
     *
     * @param array $attributes
     *
     * @return array
     */
    public function secureTran2(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::SECURE_TRAN2);

        $body = $attributes;

        return self::execute($url, $body);
    }

    /**
     * API change the payment details of transactions that have been settled.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/payment/credit/api#altertran
     *
     * @param array $attributes
     *
     * @return array
     */
    public function alterTran(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::ALTER_TRAN);

        $body = array_merge(self::retrieveBodyShop(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * API change the settlement amount for transactions that have been settled.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/payment/credit/api#changetran
     *
     * @param array $attributes
     *
     * @return array
     */
    public function changeTran(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::CHANGE_TRAN);

        $body = array_merge(self::retrieveBodyShop(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * API gets the transaction information for the specified order ID.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/payment/credit/api#searchtrade
     * 
     * @param array $attributes
     *
     * @return array
     */
    public function searchTrade(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::SEARCH_TRADE);

        $body = array_merge(self::retrieveBodyShop(), $attributes);

        return self::execute($url, $body);
    }
}
