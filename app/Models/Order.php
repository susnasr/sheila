<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function getTrackingUrl()
    {
        if (!$this->carrier || !$this->tracking_number) {
            return '#';
        }

        $carriers = [
            'fedex' => 'https://www.fedex.com/fedextrack/?tracknumbers=',
            'ups' => 'https://www.ups.com/track?tracknum=',
            'usps' => 'https://tools.usps.com/go/TrackConfirmAction?tLabels=',
            'dhl' => 'https://www.dhl.com/en/express/tracking.html?AWB=',
        ];

        $carrier = strtolower($this->carrier);
        $baseUrl = $carriers[$carrier] ?? 'https://www.google.com/search?q=';

        return $baseUrl . $this->tracking_number;
    }
}
