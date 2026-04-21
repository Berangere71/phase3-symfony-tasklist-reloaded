<?php
namespace App\Enums;

enum PriorityType: string
{
    case Normal = 'normal';
    case Important = 'important';
    case Urgent = 'urgent';
}