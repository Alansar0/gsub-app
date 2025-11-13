<?php
namespace App\Services\RouterApi;

use RouterOS\Client;
use RouterOS\Query;
use Exception;

class LiveMikroTikService implements RouterApiInterface {
    protected $client;

    public function connect(array $connection): bool {
        try {
            $this->client = new Client([
                'host' => $connection['host'],
                'user' => $connection['username'],
                'pass' => $connection['password'],
                'port' => $connection['port'] ?? 8728,
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function createVoucher(array $data): array {
        try {
            $query = (new Query('/ip/hotspot/user/add'))
                ->equal('name', $data['username'])
                ->equal('password', $data['password'])
                ->equal('profile', $data['profile']);
            $this->client->query($query)->read();
            return [
                'username' => $data['username'],
                'password' => $data['password'],
                'raw' => 'live',
            ];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getProfiles(): array {
        try {
            $response = $this->client->query(new Query('/ip/hotspot/user/profile/print'))->read();
            return collect($response)->map(function ($profile) {
                return [
                    'name' => $profile['name'] ?? 'N/A',
                    'mikrotik' => $profile['name'] ?? '',
                    'time' => $profile['on-login'] ?? '',
                ];
            })->toArray();
        } catch (Exception $e) {
            return [['error' => $e->getMessage()]];
        }
    }
}
