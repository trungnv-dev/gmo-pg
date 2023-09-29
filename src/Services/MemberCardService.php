<?php

namespace Ecs\GmoPG\Services;

use Ecs\GmoPG\Traits\GmoPaymentMethod;

class MemberCardService
{
    use GmoPaymentMethod;

    const SAVE_MEMBER              = '/payment/SaveMember.idPass';
    const UPDATE_MEMBER            = '/payment/UpdateMember.idPass';
    const SEARCH_MEMBER            = '/payment/SearchMember.idPass';
    const DELETE_MEMBER            = '/payment/DeleteMember.idPass';
    const SAVE_CARD                = '/payment/SaveCard.idPass';
    const TRADED_CARD              = '/payment/TradedCard.idPass';
    const SEARCH_CARD              = '/payment/SearchCard.idPass';
    const SEARCH_CARD_DETAIL       = '/payment/SearchCardDetail.idPass';
    const DELETE_CARD              = '/payment/DeleteCard.idPass';

    /**
     * API register the member on the specified site.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/payment/credit/apimember#savemember
     * 
     * @param array $attributes
     * 
     * @return array
     */
    public function saveMember(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::SAVE_MEMBER);

        $body = array_merge(self::retrieveBodySite(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * API updates the member information of the specified site.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/payment/credit/apimember#updatemember
     * 
     * @param array $attributes
     * 
     * @return array
     */
    public function updateMember(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::UPDATE_MEMBER);

        $body = array_merge(self::retrieveBodySite(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * API refers to the member information of the specified site.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/payment/credit/apimember#searchmember
     * 
     * @param array $attributes
     * 
     * @return array
     */
    public function searchMember(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::SEARCH_MEMBER);

        $body = array_merge(self::retrieveBodySite(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * API deletes the member information of the specified site.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/payment/credit/apimember#deletemember
     * 
     * @param array $attributes
     * 
     * @return array
     */
    public function deleteMember(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::DELETE_MEMBER);

        $body = array_merge(self::retrieveBodySite(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * API register the card information with the specified member.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/payment/credit/apimember#savecard
     * 
     * @param array $attributes
     * 
     * @return array
     */
    public function saveCard(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::SAVE_CARD);

        $body = array_merge(self::retrieveBodySite(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * API register the card used for the transaction with the specified order ID.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/payment/credit/apimember#tradedcard
     * 
     * @param array $attributes
     * 
     * @return array
     */
    public function tradedCard(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::TRADED_CARD);

        $body = array_merge(self::retrieveBodySite(), self::retrieveBodyShop(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * API refers to the card information of the specified member.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/payment/credit/apimember#searchcard
     * 
     * @param array $attributes
     * 
     * @return array
     */
    public function searchCard(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::SEARCH_CARD);

        $body = array_merge(self::retrieveBodySite(), $attributes);

        return self::execute($url, $body);
    }

    /**
     * API acquires the attribute information of the specified credit card.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/payment/credit/apimember#searchcarddetail
     * 
     * @param array $attributes
     * 
     * @return array
     */
    public function searchCardDetail(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::SEARCH_CARD_DETAIL);

        $body = array_merge(self::retrieveBodyShop(), $attributes);

        if (isset($attributes['MemberID'])) {
            $body = array_merge($body, self::retrieveBodySite());
        }

        return self::execute($url, $body);
    }

    /**
     * API deletes the card information of the specified member.
     * 
     * @see https://gmopg_docs:PF%cwa$GmCC@docs.mul-pay.jp/payment/credit/apimember#deletecard
     * 
     * @param array $attributes
     * 
     * @return array
     */
    public function deleteCard(array $attributes): array
    {
        $url = self::retrieveGmoPaymentUrl(self::DELETE_CARD);

        $body = array_merge(self::retrieveBodySite(), $attributes);

        return self::execute($url, $body);
    }
}
