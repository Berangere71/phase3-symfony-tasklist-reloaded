<?php

namespace App\Entity;

use App\Enums\TaskStatus;
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

    #[ORM\Column(enumType: TaskStatus::class)]
    private TaskStatus $status = TaskStatus:: Pending ;

    #[ORM\Column]
    private ?bool $isPinned = false;

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

    public function getStatus(): TaskStatus
    {
        return $this->status;
    }

    public function setStatus(TaskStatus $status): static
    {
        $this->status = $status;

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

    #[ORM\ManyToOne(targetEntity: Priority::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Priority $priority = null;

    #[ORM\ManyToOne(targetEntity: Folder::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Folder $folder = null;

    // Ajoutez le Getter et le Setter pour Priority
    public function getPriority(): ?Priority
    {
        return $this->priority;
    }

    public function setPriority(?Priority $priority): static
    {
        $this->priority = $priority;
        return $this;
    }

    // Ajoutez le Getter et le Setter pour Folder
    public function getFolder(): ?Folder
    {
        return $this->folder;
    }

    public function setFolder(?Folder $folder): static
    {
        $this->folder = $folder;
        return $this;
    }


}
