<?php

namespace App\Service;

use App\Entity\Task;
use App\Enum\Email;
use GuzzleHttp\Client;
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
        ]);

        $dotenv = new Dotenv();
        $dotenv->loadEnv(__DIR__ . '/../../.env');
    }

    public function getTasksByEmail(string $email, $timePeriod = null): array
    {
        $url = 'https://app.ecofleet.com/seeme/Api/Tasks/get';
        $params = [
            'query' => [
                // 'begTimestamp' => date('Y-m-d', strtotime($timePeriod == null ? '-2 weeks' : $timePeriod)),
                'begTimestamp' => '2023-03-01',
                'driver' => $email,
                '__proto__' => '',
                'key' => $_ENV['API_KEY'],
                'json' => ''
            ]
        ];

        $response = $this->client->get($url, $params);
        $data = json_decode($response->getBody(), true);
        $tasksData = $data['response']['tasks']['___xmlNodeValues'];
        echo "Amount of tasks for email $email is: " . count($tasksData) . PHP_EOL;

        $tasks = [];
        foreach ($tasksData as $taskData) {
            $tasks[] = new Task($taskData['task']);
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
