<?php

namespace App\Entity;

use App\Enums\TaskStatus;
use App\Enums\PriorityType;
use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;
    
    #[ORM\Column]
    private ?bool $isPinned = null;

    #[ORM\Column(enumType: TaskStatus::class)]
    private ?TaskStatus $status = null;

    #[ORM\Column(enumType: PriorityType::class, nullable: true)]
    private ?PriorityType $priority = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function isPinned(): ?bool
    {
        return $this->isPinned;
    }

    public function setIsPinned(bool $isPinned): static
    {
        $this->isPinned = $isPinned;

        return $this;
    }

    public function getStatus(): ?TaskStatus
    {
        return $this->status;
    }

    public function setStatus(TaskStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    
public function getPriority(): ?PriorityType
{
    return $this->priority;
}

public function setPriority(?PriorityType $priority): static
{
    $this->priority = $priority;
    return $this;
}
}
