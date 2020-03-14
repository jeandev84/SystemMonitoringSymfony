<?php

namespace App\DataFixtures;

use App\Entity\Website;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        # Youtube
        $website = new Website();
        $website->setName('Youtube')
                ->setUrl('http://youtube.com');

        $manager->persist($website);

        # Facebook
        $website = new Website();
        $website->setName('Facebook')
            ->setUrl('http://facebook.com');

        $manager->persist($website);


        # Google
        $website = new Website();
        $website->setName('Google')
            ->setUrl('http://google.com');

        $manager->persist($website);

        # GitHub
        $website = new Website();
        $website->setName('GitHub')
            ->setUrl('http://github.com');

        $manager->persist($website);


        # GithubTest
        $website = new Website();
        $website->setName('GithubTest')
            ->setUrl('http://github.com/fakeurl');

        $manager->persist($website);



        # Website Fake
        $website = new Website();
        $website->setName('Fake')
            ->setUrl('http://fakewebsite.com');

        $manager->persist($website);


        # save all change in the database
        $manager->flush();
    }
}
