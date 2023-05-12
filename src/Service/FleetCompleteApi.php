<?php

namespace App\Service;

use App\Entity\Task;
use App\Enum\Email;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Promise\Utils;
use Symfony\Component\Dotenv\Dotenv;

class FleetCompleteApi
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            // 'verify' => false,
            // 'debug' => true,
            'http_errors' => true,
            'base_uri' => 'https://app.ecofleet.com'
        ]);

        $dotenv = new Dotenv();
        $dotenv->loadEnv(__DIR__ . '/../../.env');
    }

    public function getTasksByEmail(string $email, string $begTimestamp, string $endTimestamp = null): Promise
    {
        $request = new Request('GET', '/seeme/Api/Tasks/get');

        $promise = $this->client->sendAsync($request, [
            'query' => [
                'begTimestamp' => Util::formatDateForFC($begTimestamp),
                'endTimestamp' => $endTimestamp ?  Util::formatDateForFC($endTimestamp) : '',
                'driver' => $email,
                '_proto_' => '',
                'key' => $_ENV['API_KEY'],
                'json'  => ''
            ]
        ])->then(function ($response) {
            return json_decode($response->getBody(), true)['response']['tasks'];
        });

        return $promise;
    }

    public function getAllTasks(): array
    {
        $promises = [];
        foreach (Email::cases() as $email) {
            $promises[] = $this->getTasksByEmail($email->value, '01.05.2023');
        }

        $results = Utils::all($promises)->wait();

        $allTasks = [];
        foreach ($results as $data) {
            if (!empty($data)) {
                $data = $data['___xmlNodeValues'];
                foreach ($data as $taskData) {
                    $allTasks[] = new Task($taskData['task']);
                }
            }
        }

        return $allTasks;
    }
}
