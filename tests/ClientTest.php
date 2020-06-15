<?php

namespace Hekr\Tests;

use Hekr\User;
use Hekr\Client;
use Hekr\Device;
use PHPUnit\Framework\TestCase;
use Hekr\Response\DeviceSnapshotResponse;

class ClientTest extends TestCase
{
    protected $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = new Client();
    }

    /**
     * @test
     */
    public function it_can_authenticate_users()
    {
        //Update your valid username and password if you run the test suite.
        $user = new User('test@test.com', 'password');

        $response = $this->client->auth($user);

        $this->assertEquals('200', $response['status']);
        $this->assertArrayHasKey('access_token', $response['data']);

        return $response['data'];
    }

    /**
     * @test
     */
    public function it_can_detect_invalid_user_credentials()
    {
        $user = new User('test@test.com', 'password');

        $response = $this->client->auth($user);

        $this->assertEquals('401', $response['status']);
    }

    /**
     * @test
     * @depends it_can_authenticate_users
     * @param $auth
     */
    public function it_can_fetch_devices_associated_with_authenticated_user($auth)
    {
        $response = $this->client->setAccessToken($auth['access_token'])->getAllDevices();

        $this->assertEquals('200', $response['status']);

        $this->assertArrayHasKey('devTid', $response['data'][0]);
        $this->assertArrayHasKey('ctrlKey', $response['data'][0]);
        $this->assertArrayHasKey('productPublicKey', $response['data'][0]);
        $response['data'][0]['access_token'] = $auth['access_token'];
        return $response['data'][0];
    }

    /**
     * @test
     * @depends it_can_fetch_devices_associated_with_authenticated_user
     * @param $device
     */
    public function it_can_fetch_device_snapshot($deviceData)
    {
        $device = new Device($deviceData['ctrlKey'], $deviceData['devTid'], $deviceData['productPublicKey']);

        $snapshot = $this->client->setAccessToken($deviceData['access_token'])
            ->setDevice($device)
            ->getDeviceSnapshot();

        $this->assertInstanceOf(DeviceSnapshotResponse::class, $snapshot);
    }
}
