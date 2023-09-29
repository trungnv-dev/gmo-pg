<?php

namespace Ecs\GmoPG\Services;

use Ecs\GmoPG\Traits\GmoPaymentMethod;

class PayPayService
{
    use GmoPaymentMethod;

    const ENTRY_TRAN_PAYPAY           = '/payment/EntryTranPaypay.idPass';
    const EXEC_TRAN_PAYPAY            = '/payment/ExecTranPaypay.idPass';
    const PAYPAY_START                = '/payment/PaypayStart.idPass';
    const PAYPAY_SALES                = '/payment/PaypaySales.idPass';
    const PAYPAY_CANCEL_RETURN        = '/payment/PaypayCancelReturn.idPass';
    const PAYPAY_ACCEPT_PUSH          = '/payment/PaypayAcceptPush.idPass';
    const PAYPAY_ACCEPT_PUSH_CANCEL   = '/payment/PaypayAcceptPush.idPass';
    const SEARCH_TRADE_MULTI          = '/payment/SearchTradeMulti.idPass';
    const ENTRY_TRAN_PAYPAY_ACCEPT    = '/payment/EntryTranPaypayAccept.idPass';
    const EXEC_TRAN_PAYPAY_ACCEPT     = '/payment/ExecTranPaypayAccept.idPass';
    const PAYPAY_ACCEPT_START         = '/payment/PaypayAcceptStart.idPass';
    const PAYPAY_ACCEPT_END           = '/payment/PaypayAcceptEnd.idPass';

    /**
     * API issue the transaction ID and transaction password required
     * for the settlement transaction and start the transaction.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/paypay/payg-api#entrytranpaypay
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/paypay/accept2-api#accept2-entrytranpaypay
     *
     * @param array $attributes
     *
     * @return array
     */
    public function entryTranPayPay(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::ENTRY_TRAN_PAYPAY);

        $body = array_merge(self::retrieveBodyShop(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * API execute transaction (make payment)
     *
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/paypay/payg-api#exectranpaypay
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/paypay/accept2-api#accept2-exectranpaypay
     * 
     * @param array $attributes
     *
     * @return array
     */
    public function execTranPayPay(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::EXEC_TRAN_PAYPAY);

        $body = array_merge(self::retrieveBodyShop(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * PaypayStart settlement start.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/paypay/payg-api#paypaystart
     *
     * @param array $attributes
     *
     * @return array
     */
    public function paypayStart(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::PAYPAY_START);

        $body = $attributes;

        return self::execute($url, $body);
    }

    /**
     * API sales capture are made for settlement of Authorization.
     *
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/paypay/payg-api#paypaysales
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/paypay/accept2-api#paypaysales
     * 
     * @param array $attributes
     *
     * @return array
     */
    public function paypaySales(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::PAYPAY_SALES);

        $body = array_merge(self::retrieveBodyShop(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * By specifying the transaction ID and transaction password of the transaction, it is possible to cancel the previously executed payment.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/paypay/payg-api#paypaycancelreturn
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/paypay/accept2-api#paypaycancelreturn
     *
     * @param array $attributes
     *
     * @return array
     */
    public function paypayCancelReturn(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::PAYPAY_CANCEL_RETURN);

        $body = array_merge(self::retrieveBodyShop(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * PaypayAcceptPush Push Billing Purchase Request.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/paypay/accept2-api#paypayacceptpush
     *
     * @param array $attributes
     *
     * @return array
     */
    public function paypayAcceptPush(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::PAYPAY_ACCEPT_PUSH);

        $body = array_merge(self::retrieveBodyShop(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * Cancellation is possible if the End User does not agree within the payment deadline..
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/paypay/accept2-api#paypayacceptpushcancel
     *
     * @param array $attributes
     *
     * @return array
     */
    public function paypayAcceptPushCancel(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::PAYPAY_ACCEPT_PUSH_CANCEL);

        $body = array_merge(self::retrieveBodyShop(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * API get the transaction status of the target transaction.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/paypay/payg-api#searchtrademulti
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/paypay/accept1-api#accept1-searchtrademulti
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/paypay/accept2-api#accept2-searchtrademulti
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
     * API issue the transaction ID and transaction password required
     * for the settlement transaction and start the transaction (acceptance of use).
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/paypay/accept1-api#entrytranpaypayaccept
     *
     * @param array $attributes
     *
     * @return array
     */
    public function entryTranPayPayAccept(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::ENTRY_TRAN_PAYPAY_ACCEPT);

        $body = array_merge(self::retrieveBodyShop(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * API execute transaction (use consent)
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/paypay/accept1-api#exectranpaypayaccept
     *
     * @param array $attributes
     *
     * @return array
     */
    public function execTranPayPayAccept(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::EXEC_TRAN_PAYPAY_ACCEPT);

        $body = array_merge(self::retrieveBodyShop(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * PaypayAcceptStart settlement start (use consent).
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/paypay/accept1-api#paypayacceptstart
     *
     * @param array $attributes
     *
     * @return array
     */
    public function paypayAcceptStart(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::PAYPAY_ACCEPT_START);

        $body = $attributes;

        return self::execute($url, $body);
    }

    /**
     * It is possible to terminate the use of the specified PayPay consent number..
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/paypay/accept1-api#paypayacceptend
     *
     * @param array $attributes
     *
     * @return array
     */
    public function paypayAcceptEnd(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::PAYPAY_ACCEPT_END);

        $body = array_merge(self::retrieveBodyShop(), $attributes);

        return self::execute($url, $body);
    }
}
