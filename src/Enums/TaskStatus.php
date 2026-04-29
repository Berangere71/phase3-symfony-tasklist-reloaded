<?php
namespace App\Enums;

enum TaskStatus: string
{
    case Pending = 'à faire';
    case InProgress = 'en cours';
    case Completed = 'terminé';
}