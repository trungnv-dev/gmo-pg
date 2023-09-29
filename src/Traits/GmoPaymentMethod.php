<?php

namespace Ecs\GmoPG\Traits;

use GuzzleHttp\Client;

trait GmoPaymentMethod
{
    /**
     * Get url common of GMOPayment
     *
     * @param $path
     *
     * @return string
     */
    protected function retrieveGmoPaymentUrl($path = null): string
    {
        return config('gmopg.gmo_payment_url') . $path;
    }

    /**
     * Get info site of GMOPayment
     *
     * @return array
     */
    protected function retrieveBodySite(): array
    {
        return [
            'SiteID'   => config('gmopg.site_id'),
            'SitePass' => config('gmopg.site_pass'),
        ];
    }

    /**
     * Get info shop of GMOPayment
     *
     * @return array
     */
    protected function retrieveBodyShop(): array
    {
        return [
            'ShopID'   => config('gmopg.shop_id'),
            'ShopPass' => config('gmopg.shop_pass'),
        ];
    }

    /**
     * Call API GMOPayment
     *
     * @param $url
     * @param $body
     *
     * @return array
     */
    protected function execute($url, $body): array
    {
        $client = resolve(Client::class);

        $response = $client->request('POST', $url, [
            'form_params' => $body
        ]);

        return $this->properParseStr($response->getBody()->getContents());
    }

    /**
     * Handle convert data from GMOPayment
     *
     * @param $str
     *
     * @return array
     */
    protected function properParseStr($str): array
    {
        parse_str($str, $result);

        if (isset($result['ErrCode'])) {
            $errors = explode('|', $result['ErrInfo']);
            foreach ($errors as $error) {
                $result['errors'][$error] = trans("gmopg-errors.$error");
            }
        }

        return $result;
    }
}
