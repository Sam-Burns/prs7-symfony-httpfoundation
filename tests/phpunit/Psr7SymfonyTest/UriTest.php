<?php
namespace SamBurns\Psr7Symfony\Test;

use PHPUnit_Framework_TestCase as TestCase;
use SamBurns\Psr7Symfony\Uri;

class UriTest extends TestCase
{
    public function testWithScheme()
    {
        $url = 'http://username:password@hostname:9090/path?arg=value#anchor';
        $uri = new Uri($url);
        
        $uriCopy = $uri->withScheme('https');
        
        $this->assertEquals('https', $uriCopy->getScheme());
        $this->assertEquals('http', $uri->getScheme());
        
        $uriCopy2 = $uriCopy->withScheme('');
        $this->assertEquals(null, $uriCopy2->getScheme());
        
        $uriCopy3 = null;
        try{
            $uriCopy3 = $uriCopy2->withScheme('ftp');
        }  catch (\Exception $e){
            $this->assertNull($uriCopy3);
            $this->assertInstanceOf('\InvalidArgumentException', $e);
            $this->assertEquals('Invalid or unsupported schema', $e->getMessage());
        }
    }
}
