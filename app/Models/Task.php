<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Scopes\PriorityScope;

class Task extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($task) 
        {
            $task->assignPriority();
        });
        static::updating(function ($task) 
        {
            $task->updatePriority();
        });
        static::deleting(function ($task) 
        {
            $task->deleteTask();
        });
    }

    protected $fillable = [
        'name', 'priority', 'project_id'
    ];
    protected static function booted()
    {
        static::addGlobalScope(new PriorityScope);
    }
    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function assignPriority()
    {
        if (is_null($this->priority)) {
            $this->priority = $this->getNextPriority();
        } else {
            $this->insertAtPriority($this->priority);
        }
    }
    
    public function updatePriority()
    {
        $currentPriority = $this->getOriginal('priority');
        
        if ($currentPriority != $this->priority) 
        {
            $maxPriority = $this->getNextPriority() - 1;
            if ($this->priority >= $maxPriority) 
            {
                $this->priority = $maxPriority;
                static::where('priority', '>=', $currentPriority)->decrement('priority');
            }
            else
            {
                $this->adjustPriorities($currentPriority, $this->priority);
            }
        }
    }

    public function deleteTask(){
        $currentPriority = $this->getOriginal('priority');
        static::where('priority', '>=', $currentPriority)->decrement('priority');
    }

    protected function getNextPriority()
    {
        return static::max('priority') + 1;
    }

    protected function insertAtPriority($newPriority)
    {
        $maxPriority = $this->getNextPriority() - 1;

        if ($newPriority > $maxPriority) 
        {
            $this->priority = $maxPriority + 1;
        } 
        else 
        {
            static::where('priority', '>=', $newPriority)->increment('priority');
        }
    }

    protected function adjustPriorities($currentPriority, $newPriority)
    {
        $maxPriority = $this->getNextPriority() - 1;
        if ($newPriority < $currentPriority) 
        {
            static::whereBetween('priority', [$newPriority, $currentPriority - 1])
                ->increment('priority');
        } 
        else 
        {
            static::whereBetween('priority', [$currentPriority + 1, $newPriority])
                ->decrement('priority');
        }
    }
}