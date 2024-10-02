<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Sylius Sp. z o.o.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Entity;

use App\Form\ConferenceType;
use App\Grid\ConferenceGrid;
use App\Repository\ConferenceRepository;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Resource\Metadata\AsResource;
use Sylius\Resource\Metadata\BulkDelete;
use Sylius\Resource\Metadata\Create;
use Sylius\Resource\Metadata\Delete;
use Sylius\Resource\Metadata\Index;
use Sylius\Resource\Metadata\Update;
use Sylius\Resource\Model\ResourceInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: ConferenceRepository::class)]
#[AsResource(
    section: 'admin',
    formType: ConferenceType::class,
    templatesDir: '@SyliusAdminUi/crud',
    routePrefix: '/admin',
    operations: [
        new Create(),
        new Update(),
        new Index(grid: ConferenceGrid::class),
        new Delete(),
        new BulkDelete(),
    ],
)]
class Conference implements ResourceInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[NotBlank]
    private ?string $name = null;

    #[ORM\Column]
    #[NotBlank]
    private ?\DateTimeImmutable $startsAt = null;

    #[ORM\Column]
    #[NotBlank]
    private ?\DateTimeImmutable $endsAt = null;

    #[ORM\Column]
    private bool $pastEvent = false;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $archivedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getStartsAt(): ?\DateTimeImmutable
    {
        return $this->startsAt;
    }

    public function setStartsAt(?\DateTimeImmutable $startsAt): void
    {
        $this->startsAt = $startsAt;
    }

    public function getEndsAt(): ?\DateTimeImmutable
    {
        return $this->endsAt;
    }

    public function setEndsAt(?\DateTimeImmutable $endsAt): void
    {
        $this->endsAt = $endsAt;
    }

    public function isPastEvent(): bool
    {
        return $this->pastEvent;
    }

    public function setPastEvent(bool $pastEvent): void
    {
        $this->pastEvent = $pastEvent;
    }

    public function getArchivedAt(): ?\DateTimeImmutable
    {
        return $this->archivedAt;
    }

    public function setArchivedAt(?\DateTimeImmutable $archivedAt): void
    {
        $this->archivedAt = $archivedAt;
    }
}
