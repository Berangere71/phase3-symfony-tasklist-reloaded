<?php

namespace App\DataFixtures;

use App\Entity\Folder;
use App\Entity\Priority;
use App\Entity\Task;
use App\Enums\TaskStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create priorities with colors
        $priorities = [
            ['name' => 'Normal', 'importance' => 1, 'bgColor' => 'bg-yellow-100', 'textColor' => 'text-yellow-700'],
            ['name' => 'Important', 'importance' => 2, 'bgColor' => 'bg-orange-100', 'textColor' => 'text-orange-700'],
            ['name' => 'Urgent', 'importance' => 3, 'bgColor' => 'bg-red-100', 'textColor' => 'text-red-700'],
        ];

        $priorityObjects = [];
        foreach ($priorities as $data) {
            $priority = new Priority();
            $priority->setName($data['name']);
            $priority->setImportance($data['importance']);
            $priority->setBgColor($data['bgColor']);
            $priority->setTextColor($data['textColor']);
            $manager->persist($priority);
            $priorityObjects[$data['name']] = $priority;
        }

        // Create folders with colors
        $folders = [
            ['name' => 'Personnel', 'color' => '#3b82f6'],
            ['name' => 'Travail', 'color' => '#ef4444'],
            ['name' => 'Loisirs', 'color' => '#22c55e'],
        ];

        $folderObjects = [];
        foreach ($folders as $data) {
            $folder = new Folder();
            $folder->setName($data['name']);
            $folder->setColor($data['color']);
            $manager->persist($folder);
            $folderObjects[$data['name']] = $folder;
        }

        $manager->flush();

        // Create sample tasks
        $tasks = [
            ['title' => 'Faire les courses', 'status' => TaskStatus::Pending, 'folder' => 'Personnel', 'priority' => 'Normal'],
            ['title' => 'Appeler le plombier', 'status' => TaskStatus::Pending, 'folder' => 'Personnel', 'priority' => 'Important'],
            ['title' => 'Finir rapport Q2', 'status' => TaskStatus::InProgress, 'folder' => 'Travail', 'priority' => 'Urgent'],
            ['title' => 'Réunion avec équipe', 'status' => TaskStatus::InProgress, 'folder' => 'Travail', 'priority' => 'Normal'],
            ['title' => 'Film dimanche', 'status' => TaskStatus::Pending, 'folder' => 'Loisirs', 'priority' => 'Normal'],
            ['title' => 'Randonnée samedi', 'status' => TaskStatus::Completed, 'folder' => 'Loisirs', 'priority' => 'Normal'],
        ];

        foreach ($tasks as $data) {
            $task = new Task();
            $task->setTitle($data['title']);
            $task->setStatus($data['status']);
            $task->setFolder($folderObjects[$data['folder']]);
            $task->setPriority($priorityObjects[$data['priority']]);
            $task->setIsPinned(false);
            $manager->persist($task);
        }

        $manager->flush();
    }
}
