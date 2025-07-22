<?php

namespace App\Services;

class RsaEncryptionService
{
    protected $publicKey;
    protected $privateKey;
    protected $passphrase;

    public function __construct()
    {
        $this->passphrase = env('RSA_PASSPHRASE', '');
        $publicKeyPath = env('RSA_PUBLIC_KEY_PATH');
        $privateKeyPath = env('RSA_PRIVATE_KEY_PATH');
    
        if (!file_exists($publicKeyPath) || !file_exists($privateKeyPath)) {
            throw new \Exception("Ключи не найдены! Проверьте пути: {$publicKeyPath} и {$privateKeyPath}");
        }
    
        $this->publicKey = file_get_contents($publicKeyPath);
        $this->privateKey = file_get_contents($privateKeyPath);
    }

    /**
     * Шифрует данные
     */
    public function encrypt(string $data): string
    {
        try {
            $publicKeyResource = openssl_pkey_get_public($this->publicKey);
            
            if (!$publicKeyResource) {
                throw new \Exception('Не удалось загрузить публичный ключ');
            }

            $encrypted = '';
            $result = openssl_public_encrypt($data, $encrypted, $publicKeyResource, OPENSSL_PKCS1_PADDING);
            
            if (!$result) {
                throw new \Exception('Ошибка шифрования');
            }

            return base64_encode($encrypted);
        } catch (\Exception $e) {
            \Log::error('Ошибка шифрования: ' . $e->getMessage());
            throw new \RuntimeException('Ошибка шифрования: ' . $e->getMessage());
        }
    }

    /**
     * Дешифрует данные
     */
    public function decrypt(string $encryptedData): string
    {
        try {
            $privateKeyResource = openssl_pkey_get_private($this->privateKey, $this->passphrase);
            
            if (!$privateKeyResource) {
                throw new \Exception('Не удалось загрузить приватный ключ');
            }

            $decrypted = '';
            $result = openssl_private_decrypt(base64_decode($encryptedData), $decrypted, $privateKeyResource, OPENSSL_PKCS1_PADDING);
            
            if (!$result) {
                throw new \Exception('Ошибка дешифровки');
            }

            return $decrypted;
        } catch (\Exception $e) {
            \Log::error('Ошибка дешифровки: ' . $e->getMessage());
            throw new \Exception("Ошибка дешифровки: " . $e->getMessage());
        }
    }
}