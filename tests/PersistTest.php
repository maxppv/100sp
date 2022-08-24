<?php

namespace App\Tests;

use App\Entity\Purchase;
use App\Entity\PurchaseType;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PersistTest extends KernelTestCase
{
    /** @var EntityManagerInterface */
    private EntityManagerInterface $em;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->em = self::getContainer()->get('doctrine')->getManager();
        $purger = new ORMPurger($this->em);
        $purger->purge();
    }

    public function testPersist()
    {
        $purchaseType1 = new PurchaseType('type1', 'Название1');
        $purchaseType2 = new PurchaseType('type2', 'Название2');

        $purchase1 = new Purchase(1, 'name', 'url', 'photo');
        $purchase2 = new Purchase(2, 'name', 'url', 'photo');

        $purchaseType1->addPurchase($purchase1);
        $purchaseType1->addPurchase($purchase2);

        $purchaseType2->addPurchase($purchase1);
        $purchaseType2->addPurchase($purchase2);

        $this->em->persist($purchaseType1);
        $this->em->persist($purchaseType2);

        $this->em->flush();
        $this->em->clear();

        /** @var PurchaseType[] $purchaseTypes */
        $purchaseTypes = $this->em->getRepository(PurchaseType::class)->findAll();
        self::assertCount(2, $purchaseTypes);
        foreach ($purchaseTypes as $purchaseType) {
            self::assertCount(2, $purchaseType->getPurchases());
        }
    }

    protected function tearDown(): void
    {
        $this->em->close();
        unset($this->em);
        parent::tearDown();
    }
}
