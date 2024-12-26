<?php

namespace App\Livewire;

use App\Models\Task as ModelsTask;
use Livewire\Component;

class Task extends Component
{
    public $title,$description;

    public function render()
    {

        $taskdetails = ModelsTask::all();
        return view('livewire.task',['taskdets' => $taskdetails]);
    }

    public function resetInputs(){
        $this->title='';
        $this->description = '';

    }

    public $newtask = 0;
    public function addTask(){
        ModelsTask::create([
            'title' => $this->title,
            'description' => $this->description
        ]);

        $this->resetInputs();
        $this->newtask = 1;
    }

    public function closNotify(){
        $this->newtask = 0;
    }

    public function inProgress($id){

        $slected_task = ModelsTask::find($id);
        $slected_task->status = 'inprogress';
        $slected_task->save();
    }
    public function taskCompleted($id)
    {

        $slected_task = ModelsTask::find($id);
        $slected_task->status = 'completed';
        $slected_task->save();
    }

    public function deleteTask($id)
    {
        $task = ModelsTask::findOrFail($id);
        $task->delete();
    }
}
