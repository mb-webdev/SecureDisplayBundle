<?php

namespace MB\SecureDisplayBundle\Tests\Services;

use MB\SecureDisplayBundle\Services\Encrypter;

class EncrypterTest extends \PHPUnit_Framework_TestCase
{
	/**
	 *
	 * @var string
	 */
	private $secretKey = "i am a secret key";

	/**
	 *
	 * @var Symfony\Component\HttpFoundation\Session\Session
	 */
	private $session;

	/**
	 *
	 * @var string
	 */
	private $message = "i am a message, encrypt me";

	/**
	 * (non-PHPdoc)
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	public function setUp()
	{
		// Don't use the real session to store the IV
		$this->session = \Phake::mock('Symfony\Component\HttpFoundation\Session\Session');

		// Return a fake IV when asked
		\Phake::when($this->session)->get(Encrypter::SESSION_IV_KEY)->thenReturn('abcdefghijklmnop');
	}

	/**
	 * (non-PHPdoc)
	 * @see PHPUnit_Framework_TestCase::tearDown()
	 */
	public function tearDown()
	{
		$this->session = null;
	}

	/**
	 * Ensure that the data are encrypted
	 */
	public function testEncryption()
	{
		$encrypter = new Encrypter($this->session, $this->secretKey);
		$hash = $encrypter->encrypt($this->message);
		$this->assertNotEquals($this->message, $hash);
	}

	/**
	 * Ensure that the encryption-decryption process work correctly
	 */
	public function testDecryption()
	{
		$encrypter = new Encrypter($this->session, $this->secretKey);
		$hash = $encrypter->encrypt($this->message);
		$message = $encrypter->decrypt($hash);
		$this->assertEquals($this->message, $message);
	}
}
