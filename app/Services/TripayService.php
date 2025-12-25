<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TripayService
{
    protected string $baseUrl;
    protected string $apiKey;
    protected string $privateKey;
    protected string $merchantCode;

    public function __construct()
    {
        $this->baseUrl = config('tripay.base_url');
        $this->apiKey = config('tripay.api_key');
        $this->privateKey = config('tripay.private_key');
        $this->merchantCode = config('tripay.merchant_code');
    }

    public function createTransaction(array $data): array
    {
        $signature = hash_hmac(
            'sha256',
            $this->merchantCode . $data['merchant_ref'] . $data['amount'],
            $this->privateKey
        );

        $response = Http::withToken($this->apiKey)
            ->post($this->baseUrl . '/transaction/create', array_merge($data, [
                'merchant_code' => $this->merchantCode,
                'signature' => $signature,
            ]));

        if (!$response->successful()) {
            throw new \Exception('Tripay API error');
        }

        return $response->json();
    }
}
