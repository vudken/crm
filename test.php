<?php

use App\Enum\Email;
use App\Service\FleetCompleteApi;

$emails = Email::cases();
$fc = new FleetCompleteApi();

$tasks = $fc->getTasksByEmail(Email::Auto->value);

foreach ($tasks as $task) {
    $taskRepository->save($task);
}
