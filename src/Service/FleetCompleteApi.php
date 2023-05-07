<?php

namespace App\Service;

use App\Entity\Task;
use App\Enum\Email;
use GuzzleHttp\Client;
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

    public function getTasksByEmail(string $email, $timePeriod = null): array
    {
        $request = new Request('GET', '/seeme/Api/Tasks/get');
        $promise = $this->client->sendAsync($request, [
            'query' => [
                // 'begTimestamp' => date('Y-m-d', strtotime($timePeriod == null ? '-2 weeks' : $timePeriod)),
                'begTimestamp' => '2023-04-01',
                // 'endTimestamp' => '2023-04-01',
                'driver' => $email,
                '__proto__' => '',
                'key' => $_ENV['API_KEY'],
                'json'  => ''
            ]
        ])->then(function ($response) {
            return json_decode($response->getBody(), true)['response']['tasks'];
        });;

        $results = Utils::unwrap($promise);
        $results = Utils::settle(
            $promise
        )->wait();

        $data = $results[0]['value'];
        $tasks = [];

        if (!empty($data)) {
            $data = $data['___xmlNodeValues'];

            echo "Amount of tasks for email $email is: " . count($data) . PHP_EOL;

            foreach ($data as $taskData) {
                $tasks[] = new Task($taskData['task']);
            }
        }

        return $tasks;
    }

    public function getAllTasks(): array
    {
        $allTasks = [];
        foreach (Email::cases() as $email) {
            $allTasks = array_merge($allTasks, $this->getTasksByEmail($email->value));
            sleep(5);
        }

        return $allTasks;
    }
}
