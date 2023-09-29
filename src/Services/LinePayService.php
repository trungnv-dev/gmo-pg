<?php

namespace Ecs\GmoPG\Services;

use Ecs\GmoPG\Traits\GmoPaymentMethod;

class LinePayService
{
    use GmoPaymentMethod;

    const ENTRY_TRAN_LINE_PAY       = '/payment/EntryTranLinepay.idPass';
    const EXEC_TRAN_LINE_PAY        = '/payment/ExecTranLinepay.idPass';
    const LINEPAY_START             = '/payment/LinepayStart.idPass';
    const LINEPAY_CANCEL_RETURN     = '/payment/LinepayCancelReturn.idPass';
    const LINEPAY_SALES             = '/payment/LinepaySales.idPass';
    const SEARCH_TRADE_MULTI        = '/payment/SearchTradeMulti.idPass';
    const LINEPAY_INQUIRY_REGKEY    = '/payment/LinepayInquiryRegkey.idPass';
    const LINEPAY_END_REGKEY        = '/payment/LinepayEndRegkey.idPass';

    /**
     * API issue the transaction ID and transaction password required
     * for the settlement transaction and start the transaction.
     *
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/linepay/payg-api
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/linepay/accept1-api#entrytranlinepay
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/linepay/accept2-api#entrytranlinepay
     * 
     * @param array $attributes
     * 
     * @return array
     */
    public function entryTranLinePay(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::ENTRY_TRAN_LINE_PAY);

        $body = array_merge(self::retrieveBodyShop(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * API execute transaction (make payment)
     *
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/linepay/payg-api#exectranlinepay
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/linepay/accept1-api#accept1-exectranlinepay
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/linepay/accept2-api#accept2-exectranlinepay
     * 
     * @param array $attributes
     *
     * @return array
     */
    public function execTranLinePay(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::EXEC_TRAN_LINE_PAY);

        $body = array_merge(self::retrieveBodyShop(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * LinepayStart calling payment procedure start if.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/linepay/payg-api#linepaystart
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/linepay/accept1-api#linepaystart
     *
     * @param array $attributes
     *
     * @return array
     */
    public function linepayStart(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::LINEPAY_START);

        $body = $attributes;

        return self::execute($url, $body);
    }

    /**
     * API cancel or return the payment details for the transaction for which payment has been completed.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/linepay/payg-api#linepaycancelreturn
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/linepay/accept1-api#linepaycancelreturn
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/linepay/accept2-api#linepaycancelreturn
     *
     * @param array $attributes
     *
     * @return array
     */
    public function linepayCancelReturn(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::LINEPAY_CANCEL_RETURN);

        $body = array_merge(self::retrieveBodyShop(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * Sales capture will be made for the settlement of Authorization.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/linepay/payg-api#linepaysales
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/linepay/accept1-api#linepaysales
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/linepay/accept2-api#linepaysales
     *
     * @param array $attributes
     *
     * @return array
     */
    public function linepaySales(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::LINEPAY_SALES);

        $body = array_merge(self::retrieveBodyShop(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * API get the transaction status of the target transaction.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/linepay/payg-api#searchtrademulti
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/linepay/accept1-api#accept1-searchtrademulti
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/linepay/accept2-api#accept2-searchtrademulti
     *
     * @param array $attributes
     *
     * @return array
     */
    public function searchTradeMulti(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::SEARCH_TRADE_MULTI);

        $body = array_merge(self::retrieveBodyShop(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * API inquire the status of RegKey to LINE Pay.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/linepay/accept1-api#linepayinquiryregkey
     *
     * @param array $attributes
     *
     * @return array
     */
    public function linepayInquiryRegkey(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::LINEPAY_INQUIRY_REGKEY);

        $body = array_merge(self::retrieveBodyShop(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * API terminate the use of the issued RegKey. A RegKey once terminated cannot be reactivated.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/linepay/accept1-api#linepayendregkey
     *
     * @param array $attributes
     *
     * @return array
     */
    public function linepayEndRegkey(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::LINEPAY_END_REGKEY);

        $body = array_merge(self::retrieveBodyShop(), $attributes);

        return self::execute($url, $body);
    }
}
