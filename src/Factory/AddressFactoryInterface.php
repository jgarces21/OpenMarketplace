<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\OpenMarketplace\Factory;

use BitBag\OpenMarketplace\Component\Vendor\Entity\AddressInterface;
use Sylius\Component\Addressing\Model\Country;

interface AddressFactoryInterface
{
    public function createAddress(
        string $street,
        string $city,
        string $postalCode,
        Country $country
    ): AddressInterface;
}
