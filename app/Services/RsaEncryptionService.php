<?php

namespace App\Services;

use phpseclib3\Crypt\RSA;

class RsaEncryptionService
{
    protected $publicKey;
    protected $privateKey;
    protected $passphrase;

    public function __construct()
    {
        // Загружаем данные из .env
        $this->passphrase = env('RSA_PASSPHRASE');
        $publicKeyPath = env('RSA_PUBLIC_KEY_PATH');
        $privateKeyPath = env('RSA_PRIVATE_KEY_PATH');

        // Проверяем существование файлов
        if (!file_exists($publicKeyPath) || !file_exists($privateKeyPath)) {
            throw new \Exception("Ключи не найдены!");
        }

        // Загружаем ключи
        $this->publicKey = file_get_contents($publicKeyPath);
        $this->privateKey = file_get_contents($privateKeyPath);
    }

    /**
     * Шифрует данные
     */
    public function encrypt(string $data): string
    {
        $rsa = new RSA();
        $rsa->loadKey($this->publicKey);
        $rsa->setEncryptionMode(RSA::ENCRYPTION_OAEP);
        return base64_encode($rsa->encrypt($data));
    }

    /**
     * Дешифрует данные
     */
    public function decrypt(string $encryptedData): string
    {
        try {
            $rsa = new RSA();
            $rsa->loadKey($this->privateKey, RSA::PRIVATE_FORMAT_PKCS1, $this->passphrase);
            $rsa->setEncryptionMode(RSA::ENCRYPTION_OAEP);
            return $rsa->decrypt(base64_decode($encryptedData));
        } catch (\Exception $e) {
            throw new \Exception("Ошибка дешифровки: " . $e->getMessage());
        }
    }
}