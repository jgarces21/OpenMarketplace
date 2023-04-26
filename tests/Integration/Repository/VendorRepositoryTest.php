<?php

declare(strict_types=1);

namespace Tests\BitBag\OpenMarketplace\Integration\Repository;

use ApiTestCase\JsonApiTestCase;
use BitBag\OpenMarketplace\Entity\Vendor;
use BitBag\OpenMarketplace\Entity\VendorInterface;

class VendorRepositoryTest extends JsonApiTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $this->repository = $this->entityManager->getRepository(Vendor::class);
    }

    public function test_it_finds_correct_vendor(): void
    {
        $this->loadFixturesFromFile('VendorRepositoryTest/test_it_finds_correct_vendor.yml');
        /** @var VendorInterface $vendorOliver */
        $vendorOliver = $this->entityManager->getRepository(Vendor::class)->findOneBySlug('oliver-queen-company');
        $vendorBruce = $this->entityManager->getRepository(Vendor::class)->findOneBySlug('bruce-wayne-company');

        $this->assertEquals('Queen company', $vendorOliver->getCompanyName());
        $this->assertEquals('Wayne enterprise', $vendorBruce->getCompanyName());
    }
}
