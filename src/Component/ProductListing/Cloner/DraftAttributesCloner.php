<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\OpenMarketplace\Component\ProductListing\Cloner;

use BitBag\OpenMarketplace\Component\ProductListing\Entity\DraftInterface;
use BitBag\OpenMarketplace\Component\ProductListing\Factory\DraftAttributeValueFactoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final class DraftAttributesCloner implements DraftAttributesClonerInterface
{
    private DraftAttributeValueFactoryInterface $draftAttributeValueFactory;

    private EntityManagerInterface $entityManager;

    public function __construct(
        DraftAttributeValueFactoryInterface $draftAttributeValueFactory,
        EntityManagerInterface $entityManager
    ) {

        $this->draftAttributeValueFactory = $draftAttributeValueFactory;
        $this->entityManager = $entityManager;
    }

    public function clone(
        DraftInterface $from,
        DraftInterface $to
    ): void {
        foreach ($from->getAttributes() as $baseAttribute) {
            $attributeValue = $this->draftAttributeValueFactory->createForAttribute($baseAttribute->getAttribute(), $to);
            $attributeValue->setValue($baseAttribute->getValue());
            $to->addAttribute($attributeValue);

            $this->entityManager->persist($attributeValue);
        }
    }
}
