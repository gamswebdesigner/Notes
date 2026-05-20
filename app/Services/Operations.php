<?php

namespace App\Services;

use Illuminate\Contracts\Encryption\DecryptException;

class Operations
{
    private static int $salt = 123456789;

    public static function encrypt($value): string
    {
        $hashId = $value * self::$salt;
        return rtrim(strtr(base64_encode($hashId), '+/', '-_'), '=');
    }

    public static function decrypt(string $value): int
    {
        $remainder = strlen($value) % 4;
        if ($remainder) {
            $padlen = 4 - $remainder;
            $value .= str_repeat('=', $padlen);
        }

        $padded = strtr($value, '-_', '+/');
        $decoded = base64_decode($padded);

        if ($decoded === false || !is_numeric($decoded) || (int)self::$salt === 0) {
            throw new DecryptException("Decrypt Error!");
        }

        return (int) ($decoded / self::$salt);
    }
}
