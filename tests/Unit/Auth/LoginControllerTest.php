<?php

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use PHPUnit\Framework\TestCase;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;

class LoginControllerTest extends TestCase
{
    /**
     *@dataProvider credentialProvider
     *
     * @param $request
     * @param $expected
     * @throws ReflectionException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function testVuelogin($request, $expected): void
    {
        $reflectorRequest = new \ReflectionClass(Request::class);
        $instanceRequest  = $reflectorRequest->newInstanceWithoutConstructor();

        $mockAuthTrait = $this->getMockForTrait(AuthenticatesUsers::class,[],'AuthenticatesUsers', false, true, true, ['attemptLogin']);

        $reflector = new \ReflectionClass($mockAuthTrait);
        $instance  = $reflector->newInstanceWithoutConstructor();
        $method    = $reflector->getMethod('attemptLogin');
        $method->setAccessible(true);
        $method->invoke($instance, $instanceRequest, $request);


        $mockedClass = $this->createMock(LoginController::class);
        $mockedClass->method('vuelogin')
            ->willReturn($expected);

        $this->assertEquals($expected, $mockedClass->vuelogin($instanceRequest, $request));
    }

    /**
     * @dataProvider credentialProvider
     *
     * @param $request
     * @param $expected
     * @throws Exception
     */
    public function testGetCredentials($request, $expected): void
    {
        $mockedClass = $this->createMock(LoginController::class);
        $mockedClass->method('getCredentials')
            ->willReturn($expected);

        $this->assertEquals($expected, $mockedClass->getCredentials($request));
    }

    /**
     * @throws Exception
     */
    public function testGetCredentialsWithException(): void
    {
        $mockedClass = $this->createMock(LoginController::class);
        $mockedClass->method('getCredentials')
            ->willReturn('Empty Request');

        $reflector = new \ReflectionClass(LoginController::class);
        $instance  = $reflector->newInstanceWithoutConstructor();
        $method    = $reflector->getMethod('getCredentials');
        $method->setAccessible(true);

        $this->expectExceptionMessage('Empty Request');
        $method->invoke($instance, array());
    }

    public function credentialProvider()
    {
        return [
            [json_encode(array('email' => "test@muzmatch.com", 'password' => "test123")), '{"status":"success","user":"Muzmatch"}'],
            [json_encode(array('email' => "test@muzmatchtest.com", 'password' => "test123")), '{"status":"error","reason":"Invalid Credentials"}']
        ];
    }
}