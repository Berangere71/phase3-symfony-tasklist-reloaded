<?php
namespace App\Enums;

enum TaskStatus: string
{
    case Pending = 'en attente';
    case InProgress = 'en cours';
    case Completed = 'terminé';
}