<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Report;

class ReportFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getReportnData() as [$name, $date, $username, $place])
        {
            $report = new Report();
            $report->setName($name);
            $report->setDate($date);
            $report->setUsername($username);
            $report->setPlace($place);

            $manager->persist($report);
        }

        $manager->flush();
    }

    private function getReportnData(): array
    {
        return [

            ['test', (new \Datetime())->modify('+100 year'), 'Karol', 'lokal1'],
            ['test1', (new \Datetime())->modify('+1 month'), 'Natalia', 'lokal1'],
            ['test2', (new \Datetime())->modify('+1 minute'), 'Przemek', 'lokal2'],
            ['test3', (new \Datetime())->modify('+50 year'), 'Łukasz', 'lokal2'],
            ['test4', (new \Datetime())->modify('+2 month'), 'Michał', 'lokal3'],
            ['test5', (new \Datetime())->modify('+12 minute'), 'Dawid', 'lokal2'],
            ['test6', (new \Datetime())->modify('+22 year'), 'Karolina', 'lokal4'],
            ['test7', (new \Datetime())->modify('+7 month'), 'Paulina', 'lokal5'],
            ['test8', (new \Datetime())->modify('+45 minute'), 'Justyna', 'lokal6'],
            ['test9', (new \Datetime())->modify('+33 year'), 'Maciej', 'lokal1'],
            ['test10', (new \Datetime())->modify('+9 month'), 'Natalia', 'lokal2'],
            ['test11', (new \Datetime())->modify('+13 minute'), 'Przemek', 'lokal2'],
            ['test12', (new \Datetime())->modify('-10 year'), 'Karol', 'lokal3'],
            ['test13', (new \Datetime())->modify('+12 month'), 'Natalia', 'lokal1'],
            ['test14', (new \Datetime())->modify('+54 minute'), 'Przemek', 'lokal2'],

        ];
    }
}
