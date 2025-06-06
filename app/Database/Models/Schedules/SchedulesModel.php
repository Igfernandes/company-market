<?php

namespace App\Database\Models\Schedules;

use CodeIgniter\Model;

class SchedulesModel extends Model
{
    protected $table            = 'schedules';
    protected $primaryKey       = 'id';
    protected $DBGroup          = 'default';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Schedules\ScheduleEntity';
    protected $protectFields    = true;

    protected $allowedFields = [
        'title',
        'describe',
        'color',
        'date',
        'end_date',
    ];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
