<?php

namespace App\Billing;

use Devinweb\LaravelPaytabs\Contracts\BillingInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class PaytabsBilling implements BillingInterface
{
    protected $ip;
    protected $cordinates;

    public function __construct()
    {
        $this->ip = \Request::ip();
        $this->cordinates = $this->getCordinates();
    }
    /**
     * Get the billing data.
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->GetAddressFromCordinates();
    }

    protected function GetAddressFromCordinates()
    {
        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $this->cordinates . '&key=AIzaSyAFHz-7hKCyzYx2kWfY-S_kSi6Hm8pZ8jk');

        $array = $this->getBillingFromGeocode($response->json());

        return $array;
    }

    protected function getCordinates()
    {
        $response = Http::withHeaders(['Accept' => 'application/json'])->get('https://ipinfo.io/' . $this->ip);
        $response = $response->json();
        if (Arr::has($response, 'loc')) {
            return Arr::get($response, 'loc');
        }
        return '21.4901,39.1862';
    }

    protected function getBillingFromGeocode(array $response): array
    {
        $billing = [
            'street1' => '',
            'city' => '',
            'state' => '',
            'country' => '',
            'zip' => '',
            'ip' => $this->ip,
        ];

        if (Arr::has($response, 'results')) {
            $result = $response['results'];
            $address_components = Arr::has($result[1], 'address_components') ? $result[1]['address_components'] : [];

            $billing['street1'] = Arr::has($result[0], 'formatted_address') ? $result[0]['formatted_address'] : '';

            for ($i = 0; $i < count($address_components); $i++) {
                $child_address_components = $address_components[$i];
                switch (Arr::get($child_address_components, 'types')[0]) {
                    case 'locality':
                        $billing['city'] = Arr::get($child_address_components, 'long_name');
                        break;
                    case 'administrative_area_level_1':
                        $billing['state'] = Arr::get($child_address_components, 'long_name');
                        break;
                    case 'country':
                        $billing['country'] = Arr::get($child_address_components, 'short_name');
                        break;
                    case 'postal_code':
                        $billing['zip'] = Arr::get($child_address_components, 'long_name');
                        break;
                }
            }
        }

        return collect($billing)->filter()->all();
    }
}
