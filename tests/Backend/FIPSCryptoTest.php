<?php
namespace ParagonIE\CipherSweet\Tests\Backend;

use ParagonIE\CipherSweet\Backend\FIPSCrypto;
use ParagonIE\CipherSweet\KeyProvider\ArrayProvider;
use PHPUnit\Framework\TestCase;

/**
 * Class FIPSCryptoTest
 * @package ParagonIE\CipherSweet\Tests
 */
class FIPSCryptoTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testEncrypt()
    {
        $fips = new FIPSCrypto();
        $keyProvider = new ArrayProvider([
            ArrayProvider::INDEX_SYMMETRIC_KEY => random_bytes(32)
        ]);

        $message = 'This is just a test message';
        $cipher = $fips->encrypt($message, $keyProvider->getSymmetricKey());
        $decrypted = $fips->decrypt($cipher, $keyProvider->getSymmetricKey());

        $this->assertSame($message, $decrypted);
    }
}
