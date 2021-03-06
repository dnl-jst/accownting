<?php declare(strict_types=1);

namespace App\Manager;

use App\DTO\OfferItemDTO;
use App\Entity\Offer;
use App\Entity\OfferItem;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class OfferItemManager
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(OfferItemDTO $offerItemDTO, Offer $offer, User $user): OfferItem
    {
        $offerItem = new OfferItem();
        $offerItem->setOffer($offer);
        $offerItem->setTitle($offerItemDTO->title);
        $offerItem->setDescription($offerItemDTO->description);
        $offerItem->setAmount($offerItemDTO->amount);
        $offerItem->setUnit($offerItemDTO->unit);
        $offerItem->setPriceSingle($offerItemDTO->priceSingle);
        $offerItem->setVatRate($offerItemDTO->vatRate);
        $offerItem->setPosition($offerItemDTO->position);
        $offerItem->setCreated(new \DateTime());
        $offerItem->setCreatedBy($user);

        $this->entityManager->persist($offerItem);
        $this->entityManager->flush();

        return $offerItem;
    }

    public function getEdit(OfferItem $offerItem): OfferItemDTO
    {
        $offerItemDTO = new OfferItemDTO();
        $offerItemDTO->id = $offerItem->getId();
        $offerItemDTO->title = $offerItem->getTitle();
        $offerItemDTO->description = $offerItem->getDescription();
        $offerItemDTO->amount = $offerItem->getAmount();
        $offerItemDTO->unit = $offerItem->getUnit();
        $offerItemDTO->priceSingle = $offerItem->getPriceSingle();
        $offerItemDTO->vatRate = $offerItem->getVatRate();
        $offerItemDTO->position = $offerItem->getPosition();

        return $offerItemDTO;
    }

    public function edit(
        OfferItem $offerItem,
        OfferItemDTO $offerItemDTO,
        User $user
    ): OfferItem {
        $offerItem->setTitle($offerItemDTO->title);
        $offerItem->setDescription($offerItemDTO->description);
        $offerItem->setAmount($offerItemDTO->amount);
        $offerItem->setUnit($offerItemDTO->unit);
        $offerItem->setPriceSingle($offerItemDTO->priceSingle);
        $offerItem->setVatRate($offerItemDTO->vatRate);
        $offerItem->setPosition($offerItemDTO->position);
        $offerItem->setUpdated(new \DateTime());
        $offerItem->setUpdatedBy($user);

        $this->entityManager->flush();

        return $offerItem;
    }

    public function delete(OfferItem $offerItem): void
    {
        $this->entityManager->remove($offerItem);
        $this->entityManager->flush();
    }

    public function duplicate(OfferItem $offerItem, Offer $newOffer, User $user): void
    {
        $newOfferItem = clone $offerItem;
        $newOfferItem->setCreated(new \DateTime());
        $newOfferItem->setCreatedBy($user);
        $newOfferItem->setOffer($newOffer);

        $this->entityManager->persist($newOfferItem);
        $this->entityManager->flush();
    }
}
