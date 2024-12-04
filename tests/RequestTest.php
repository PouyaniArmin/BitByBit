<?php

use App\Core\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase{
    private $request;
    public function setUp():void{
        $this->request=new Request;
    }
    public function testPath(){
        $_SERVER['REQUEST_URI']='/home?';
        $this->assertSame('/home',$this->request->path());
    }
    public function testPathWithoutQueryString(){
        $_SERVER['REQUEST_URI']='/about';
        $this->assertSame('/about',$this->request->path());
    }
    public function testPathWithSpecialCharacters(){
        $_SERVER['REQUEST_URI']='/home@#$%^&*()';
        $this->assertSame('/home',$this->request->path());
    }
    public function testPathWithTrailingSlash(){
        $_SERVER['REQUEST_URI']='/home/';
        $this->assertSame('/home',$this->request->path());
    }
    public function testPathWithEmptyUri(){
        $_SERVER['REQUEST_URI']='';
        $this->assertSame('',$this->request->path());    
    }
    public function testPathWithLongQueryString(){
        $_SERVER['REQUEST_URI']='/search?q=php+testing&sort=desc';
        $this->assertSame('/search',$this->request->path());        
    }

}