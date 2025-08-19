<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Users extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchedUser;

    private $foundUsers;

    public $selectedUsersType = 'public';

    public function updatedSearchedUser() {
        $this->resetPage();
    }

    #[On('block-user')] 
    public function blockUser($userId) {
        $user = User::findOrFail($userId)->delete();
    }

    public function showUsersByType($usersType) {
        $this->resetPage();
        $this->selectedUsersType = $usersType;
    }

    #[On('restore-user')] 
    public function restoreUser($userId) {
        $user = User::onlyTrashed()->where('id', $userId)->first();
        if (isset($user)) {
            $user->restore();
        }
    }

    #[On('permanent-delete-user')] 
    public function permanentDeleteUser($userId) {
        $user = User::onlyTrashed()->where('id', $userId)->first();
        if (isset($user)) {
            $user->forceDelete();
        }
    }

    public function validateEmail($userId) {
        $user = User::findOrFail($userId);
        $user->markEmailAsVerified();
    }

    public function invalidateEmail($userId) {
        $user = User::findOrFail($userId);
        $user->email_verified_at = null;
        $user->save();
    }

    public function render()
    {
        if ($this->searchedUser != null) {
            if ($this->selectedUsersType == 'public') {
                $this->foundUsers = User::where('name', 'Like', "%$this->searchedUser%")
                ->orWhere('email', 'Like', "%$this->searchedUser%")
                ->orderBy('name')
                ->paginate(3);
            }

            if ($this->selectedUsersType == 'blocked') {
                $this->foundUsers = User::onlyTrashed()
                ->where(function ($query) {
                    $query->where('name', 'Like', "%$this->searchedUser%");
                    $query->orWhere('email', 'Like', "%$this->searchedUser%");
                })
                ->orderBy('name')
                ->paginate(3);
            }
        }  
            
        return view('livewire.admin.users')->with('foundUsers', $this->foundUsers);
    }
}
