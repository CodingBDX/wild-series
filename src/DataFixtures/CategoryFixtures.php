<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORIES = [
        'action',
        'romance',
        'horreur',
        'enigme',
        'reflexion',
        'aventure',
        'animation',
    ];

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 15; ++$i) {
            // code...

            $category = new Category();

            $category->setName($i);

            $manager->persist($category);
            $this->addReference('category_'.$i, $category);
        }
        $manager->flush();
    }
}
