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
        foreach (self::CATEGORIES as $key => $categoryName) {
            $category = new Category();

            $category->setName($categoryName);

            $manager->persist($category);
            $this->addReference('category_'.$categoryName, $category);
        }
        $manager->flush();
    }
}
