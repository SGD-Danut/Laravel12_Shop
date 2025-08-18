<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchedUser;

    private $foundUsers;

    public function updatedSearchedUser() {
        $this->resetPage();
    }

    public function render()
    {
        if ($this->searchedUser != null) {
            $this->foundUsers = User::where('name', 'Like', "%$this->searchedUser%")
            ->orWhere('email', 'Like', "%$this->searchedUser%")
            ->orderBy('name')
            ->paginate(4);
        }

        return view('livewire.admin.users')->with('foundUsers', $this->foundUsers);
    }
}
