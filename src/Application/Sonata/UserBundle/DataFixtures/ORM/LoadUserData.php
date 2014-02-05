<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    function getOrder()
    {
        return 1;
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $manager = $this->getUserManager();

        $user = $manager->createUser();
        $user->setUsername('admin');
        $user->setEmail('admin@admin.fr');
        $user->setPlainPassword('admin');
        $user->setEnabled(true);
        $user->setSuperAdmin(true);
        $user->setLocked(false);

        $manager->updateUser($user);

        $user = $manager->createUser();
        $user->setUsername('secure');
        $user->setEmail('secure@sandbox.com');
        $user->setPlainPassword('secure');
        $user->setEnabled(true);
        $user->setSuperAdmin(true);
        $user->setLocked(false);
        // google chart qr code : https://www.google.com/chart?chs=200x200&chld=M|0&cht=qr&chl=otpauth://totp/secure@http://demo.sonata-project.org%3Fsecret%3D4YU4QGYPB63HDN2C
        $user->setTwoStepVerificationCode('4YU4QGYPB63HDN2C');

        $manager->updateUser($user);

        $this->addReference('user-admin', $user);

        foreach (range(1, 20) as $id) {
            $user = $manager->createUser();
            $user->setUsername('user-admin'. $id);
            $user->setEmail('user-admin'. $id.'@sandbox.com');
            $user->setPlainPassword('123456789');
            $user->setEnabled(true);
            $user->setLocked(false);

            $manager->updateUser($user);
        }

        $user = $manager->createUser();
        $user->setUsername('johndoe');
        $user->setEmail('johndoe@sandbox.com');
        $user->setPlainPassword('johndoe');
        $user->setEnabled(true);
        $user->setSuperAdmin(false);
        $user->setLocked(false);

        $manager->updateUser($user);

    }

    /**
     * @return \FOS\UserBundle\Model\UserManagerInterface
     */
    public function getUserManager()
    {
        return $this->container->get('fos_user.user_manager');
    }
}
