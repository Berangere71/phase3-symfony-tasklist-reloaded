<?php

namespace App\Controller;

use App\Repository\FolderRepository;
use App\Repository\PriorityRepository;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(
        Request $request,
        TaskRepository $taskRepo,
        FolderRepository $folderRepo,
        PriorityRepository $priorityRepo
    ): Response {
        $filters = [
            'status' => $request->query->get('status'),
            'priority' => $request->query->get('priority'),
            'folder' => $request->query->get('folder'),
        ];

        return $this->render('dashboard/index.html.twig', [
            'tasks'          => $taskRepo->findFiltered($filters),
            'folders'        => $folderRepo->findAll(),
            'priorities'     => $priorityRepo->findAll(),
            'folderId'       => $request->query->get('folder'),
            'filterStatus'   => $request->query->get('status'),
            'filterPriority' => $request->query->get('priority'),
        ]);
    }
}


