#Hekr Client for PHP

A simple PHP API Client for [HEKR IoT Cloud](https://docs.hekr.me/v4/%E4%BA%91%E7%AB%AFAPI/%E7%99%BB%E5%BD%95%E6%B3%A8%E5%86%8C/).

```
use Hekr\User;
use Hekr\Device;
use Hekr\Client;

//Initialize the client
$client = new Client();

//Setup user value object
$user = new User('user@test.com', 'password');

//Generate Access Token for the user
$auth = $client->auth($user);

//Fetch all IoT devices associated with the user account
$response = $client->setAccessToken($auth['access_token'])->getAllDevices();

$devices = $response['data'];

//Set up the device value object
$device = new Device(
    $devices[0]['ctrlKey'], 
    $devices[0]['devTid'], 
    $devices[0]['productPublicKey']
);

//Fetch latest device snapshot
$snapshot = $client->setAccessToken($this->accessToken)
                ->setDevice($device)
                ->getDeviceSnapshot();

```

###Installation

####With Composer

```
composer require aravindpanicker/hekr-cloud-api-client
```

```
{
    "require": {
        "aravindpanicker/hekr-cloud-api-client": "^1.0.0"
    }
}
```

####Testing
In order to use the test suite, make sure you update your hekr username and password in `tests/ClientTest.php`

```
$ phpunit
PHPUnit 8.5.5 by Sebastian Bergmann and contributors.

....                                                                4 / 4 (100%)

Time: 14.95 seconds, Memory: 6.00 MB

OK (4 tests, 8 assertions)
```
