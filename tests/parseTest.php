<?php
namespace levidurfee;
define("DS", DIRECTORY_SEPARATOR);
define("ROOT", dirname(dirname(__FILE__)));

class fcgiCacheAnalyzeTest extends \PHPUnit_Framework_TestCase
{
	/**
	* @var object
	*/
	private $fcgi;

	/**
	* Setup the object
	*/
	protected function setUp()
	{
		require_once(ROOT . DS . "autoload.php");
		$this->fcgi = new fcgiCacheAnalyze(ROOT . DS . 'sample' . DS . 'website.cache.txt');
	}

	/**
	* Destroy the object
	*/
	protected function tearDown()
	{
		$this->fcgi = null;
	}

	public function testAnalyze()
	{
		$result = $this->fcgi->analyze();
		$this->assertTrue($result);
	}
}