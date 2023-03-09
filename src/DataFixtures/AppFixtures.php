<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Enum\Email;
use App\Service\FleetCompleteApi;




class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $fc = new FleetCompleteApi();
        // $tasks = $fc->getTasksByEmail(Email::Auto->value);
        $tasks = $fc->getAllTasks();

        foreach ($tasks as $task) {
            $manager->persist($task);
        }

        $manager->flush();
    }
}
