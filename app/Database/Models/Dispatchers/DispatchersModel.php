<?php

namespace App\Database\Models\Dispatchers;

use CodeIgniter\Model;

class DispatchersModel extends Model
{
    protected $table            = 'dispatchers';
    protected $primaryKey       = 'id';
    protected $DBGroup          = 'default';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Dispatchers\DispatcherEntity';
    protected $protectFields    = true;

    protected $allowedFields = [
        'title',
        'content',
        'period',
        'platforms',
        'status',
        'scheduled_day',
        'weekday',
        'started_at',
        'content_id',
        'reference',
        'author_id',
    ];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    public function getScheduledToRunNow(): array
    {
        $now = date('Y-m-d H:i:00');

        return $this->model
            ->onlyActive()
            ->where('started_at <=', $now)
            ->findAll();
    }
}
