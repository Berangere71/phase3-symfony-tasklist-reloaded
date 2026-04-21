<?php
namespace App\Controller;

use App\Entity\Task;
use App\Entity\Folder;
use App\Enums\TaskStatus;
use App\Enums\PriorityType;
use App\Repository\TaskRepository;
use App\Repository\FolderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TaskController extends AbstractController
{
    #[Route('/task', name: 'app_tasks')]
    public function index(TaskRepository $taskRepository, FolderRepository $folderRepository, Request $request): Response
    {
        $statusFilter = $request->query->get('status');
        $priorityFilter = $request->query->get('priority');

        $tasks = $taskRepository->findByFilters($statusFilter, $priorityFilter);
        $folders = $folderRepository->findAll();

        return $this->render('task/index.html.twig', [
            'tasks' => $tasks,
            'folders' => $folders,
            'statuses' => TaskStatus::cases(),
            'priorities' => PriorityType::cases(),
            'currentStatus' => $statusFilter,
            'currentPriority' => $priorityFilter,
        ]);
    }

    #[Route('/task/new', name: 'app_task_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        if ($request->isMethod('POST')) {
            $task = new Task();
            $task->setTitle($request->request->get('title'));
            $task->setIsPinned(false);
            $task->setStatus(TaskStatus::Pending);

            $priority = $request->request->get('priority');
            if ($priority) {
                $task->setPriority(PriorityType::from($priority));
            }

            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('app_tasks');
        }

        return $this->render('task/new.html.twig', [
            'priorities' => PriorityType::cases(),
        ]);
    }

    #[Route('/task/{id}/pin', name: 'app_task_pin', methods: ['POST'])]
    public function pin(Task $task, EntityManagerInterface $em): Response
    {
        $task->setIsPinned(!$task->isPinned());
        $em->flush();

        return $this->redirectToRoute('app_tasks');
    }

    #[Route('/task/{id}/delete', name: 'app_task_delete', methods: ['POST'])]
    public function delete(Task $task, EntityManagerInterface $em): Response
    {
        $em->remove($task);
        $em->flush();

        return $this->redirectToRoute('app_tasks');
    }
}