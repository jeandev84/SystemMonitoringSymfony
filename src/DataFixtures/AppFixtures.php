<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Website;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * AppFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
   */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @param ObjectManager $manager
   */
    public function load(ObjectManager $manager)
    {
        # Create a new Admin
        $admin = new Admin();
        $admin->setEmail('admin@site.ru')
              ->setPassword('admin123!');
        $encoded = $this->encoder->encodePassword($admin, $admin->getPassword());
        /* dd($encoded); */
        $admin->setPassword($encoded);
        $manager->persist($admin);

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
