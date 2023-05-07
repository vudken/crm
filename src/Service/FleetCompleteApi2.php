<?php

namespace App\Service;

use App\Enum\Email;
use GuzzleHttp\Client;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\ScopingHttpClient;
use Symfony\Component\HttpClient\TraceableHttpClient;
use Symfony\Component\HttpKernel\HttpCache\Store;
use Symfony\Component\HttpKernel\HttpCache\StoreInterface;
use Symfony\Component\Process\Process;

class FleetCompleteApi2
{
    private $client;
    private StoreInterface $cacheStore;
    // private array $emails = Email::cases();

    public function __construct()
    {
        $this->client = new Client([
            // 'verify' => false,
            // 'debug' => true,
            'http_errors' => true,
            // 'headers' => [
            //     'Authorization' => "Bearer $apiToken",
            // ],
        ]);
        // $this->cacheStore = new Store(sys_get_temp_dir() . '/ecofleet_api_cache');
        // $this->emails = $emails;

        $dotenv = new Dotenv();
        $dotenv->loadEnv(__DIR__ . '/../../.env');
    }

    public function getTasksByEmail(string $email, $timePeriod = null): array
    {
        $url = 'https://app.ecofleet.com/seeme/Api/Tasks/get';
        $params = [
            'query' => [
                'begTimestamp' => date('Y-m-d', strtotime($timePeriod == null ? '-2 weeks' : $timePeriod)),
                'driver' => $email,
                '__proto__' => '',
                'key' => $_ENV['API_KEY'],
                'json' => '',
            ],
        ];

        $response = $this->client->request('GET', $url, $params);
        $data = json_decode($response->getBody(), true)['response']['tasks'];
        $tasks = [];

        if (!empty($data)) {
            echo "Amount of tasks for email $email is: " . count($data) . PHP_EOL;

            foreach ($data['___xmlNodeValues'] as $taskData) {
                $tasks[] = $taskData;
            }
        }

        return $tasks;
    }

    public function getAllTasks(): array
    {
        $allTasks = [];
        // $httpClient = new TraceableHttpClient(new ScopingHttpClient($this->httpClient, [], $this->cacheStore));

        $httpClient = $this->client;
        foreach (Email::cases() as $email) {
            $process = new Process([$this->getTasksByEmail($email->value)]);
            $process->start();
            $processes[] = $process;
        }

        foreach ($processes as $process) {
            $process->wait();
            $allTasks = array_merge($allTasks, $process->getOutput());
        }

        return $allTasks;
    }

}
