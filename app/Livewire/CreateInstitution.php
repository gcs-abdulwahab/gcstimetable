<?php

namespace App\Livewire;

use App\Models\Institution;
use Livewire\Component;

class CreateInstitution extends Component
{
    public $name;
    public $address;
    public $phone;
    public $email;

 
    public function save() 
    {
        $institution = Institution::create([
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email            
        ]);
 
        return redirect()->to('/institutions')
             ->with('status', 'Institution created!');
    }
 
    public function render()
    {
        return view('livewire.institution.create-institution');
    }

}
