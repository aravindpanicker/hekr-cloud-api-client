<?php

namespace Hekr;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\BadResponseException;
use Hekr\Response\DeviceSnapshotResponse;


/**
 * Class Client
 * @package Hekr
 */
class Client
{
    /**
     * @var GuzzleClient
     */
    protected $client;

    /**
     * @var string Endpoint for User Authentication
     */
    protected $authEndpoint = 'https://uaa-openapi.hekr.me/login';

    /**
     * @var string
     */
    protected $authTokenRefreshEndpoint = 'https://uaa-openapi.hekr.me/token/refresh';

    /**
     * @var string Endpoint for accessing device data from hekr cloud
     */
    protected $userEndpoint = 'https://user-openapi.hekr.me';

    /**
     * @var JWT Access Token for the cloud API
     */
    protected $accessToken;


    /**
     * @var Device
     */
    protected $device;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->client = new GuzzleClient();
    }

    /**
     * @return mixed
     */
    protected function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param mixed $accessToken
     * @return Client
     */
    public function setAccessToken($accessToken): Client
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * @param User $user
     * @return array
     */
    public function auth(User $user)
    {
        try {
            $response = $this->client->post($this->authEndpoint, [
                'json' => [
                    'username' => $user->getUsername(),
                    'password' => $user->getPassword(),
                    'clientType' => 'WEB',
                    'pid' => '00000000000'
                ]
            ]);

            return [
                'data' => json_decode($response->getBody(), true),
                'status' => $response->getStatusCode(),
            ];
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
            return [
                'data' => json_decode($response->getBody(), true),
                'status' => $response->getStatusCode(),
            ];
        }
    }

    /**
     * Refresh the access token using refresh token
     *
     * @param $refreshToken
     * @return array
     */
    public function refreshAccessToken($refreshToken)
    {
        if(!empty($refreshToken)) {
            try {
                $response = $this->client->post($this->authEndpoint, [
                    'json' => [
                        'refresh_token' => $refreshToken,
                        'expires_in' => 86400,
                    ]
                ]);
                return [
                    'data' => json_decode($response->getBody(), true),
                    'status' => $response->getStatusCode(),
                ];
            } catch (BadResponseException $e) {
                $response = $e->getResponse();
                return [
                    'data' => json_decode($response->getBody(), true),
                    'status' => $response->getStatusCode(),
                ];
            }
        }
    }

    /**
     * Get all IOT devices associated with the user's account
     *
     * @return array
     */
    public function getAllDevices()
    {
        try {
            $response = $this->client->get($this->userEndpoint . '/devices', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->getAccessToken(),
                ]
            ]);
            return [
                'data' => json_decode($response->getBody(), true),
                'status' => $response->getStatusCode()
            ];
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
            return [
                'data' => json_decode($response->getBody(), true),
                'status' => $response->getStatusCode()
            ];
        }
    }

    /**
     * @param $device
     * @return Client
     */
    public function setDevice(Device $device)
    {
        if($device->validate()) {
            $this->device = $device;
        }
        return $this;
    }

    public function getDeviceSnapshot()
    {
        try {
            $response = $this->client->get($this->userEndpoint . '/devSnapshot', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->getAccessToken(),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'query' => [
                    'page' => 0,
                    'size' => 20,
                    'devTid' => $this->device->getDevTid(),
                    'ctrlKey' => $this->device->getCtrlKey(),
                ]
            ]);
            return new DeviceSnapshotResponse($response);
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
            return [
                'status' => $response->getStatusCode(),
                'data' => $response->getBody()
            ];
        }

    }
}