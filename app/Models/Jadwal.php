<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Task;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'description', 'duedate', 'status'];

    public function task(){
        return $this->hasOne(Task::class, 'id', 'task_id');
    }
}