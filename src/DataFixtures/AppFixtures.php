<?php

namespace App\DataFixtures;

use App\Entity\Folder;
use App\Entity\Priority;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create priorities
        $priorities = [
            ['name' => 'Basse', 'importance' => 1],
            ['name' => 'Moyenne', 'importance' => 2],
            ['name' => 'Haute', 'importance' => 3],
        ];

        foreach ($priorities as $data) {
            $priority = new Priority();
            $priority->setName($data['name']);
            $priority->setImportance($data['importance']);
            $manager->persist($priority);
        }

        // Create folders
        $folders = [
            'Personnel',
            'Travail',
            'Loisirs',
        ];

        foreach ($folders as $name) {
            $folder = new Folder();
            $folder->setName($name);
            $manager->persist($folder);
        }

        $manager->flush();
    }
}
