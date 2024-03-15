<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use App\Models\HrisEmployee;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Spatie\Permission\Models\Role;

class UserList extends Component
{
    use LivewireAlert;
    public $search_employee;
    protected $getEmployees;
    public $employeelist;
    public $selectedPatient;

    public $emp_id, $password, $role, $roles, $password_confirmation, $getRole;

    public $selectedEmployeeId;
    public $selectedEmployees;

    public $getUser;
    public $getUserRoles;
    public $getUserId;
    public $showDiv;



    public function render()
    {


        $users = User::all();
        $this->roles = Role::all();
        return view('livewire.user.user-list', [
            'users' => $users,
        ]);
    }

    public function saveUser()
    {

        $this->validate([
            'password' => 'required|confirmed|min:6',
            'emp_id' => 'required',
            'getRole' => 'required'
        ], [
            'emp_id.required' => 'This field is required',
            'getRole.required' => 'Select a role',
        ]);

        $detail = HrisEmployee::where('emp_id', $this->emp_id)->first();
        if ($detail) {
            $user = User::create([
                'emp_id' => $this->emp_id,
                'email' => $detail->email,
                'password' => Hash::make($this->password),
            ]);
            $user->assignRole($this->getRole);
            $this->reset('emp_id', 'password', 'password_confirmation', 'getRole');
            $this->alert('success', 'User created');
        } else {
            $this->alert('info', 'Employee ID does not exist');
        }
    }


    public function viewRole($getId)
    {
        $this->getUserId = $getId;
        $this->getUser = User::where('id', $getId)->first();
        $this->getUserRoles = $this->getUser->roles;
    }

    public function createRole()
    {
        $this->validate([
            'role' => 'required'
        ]);
        if ($this->getUser->hasRole($this->role)) {
            $this->alert('warning', 'Role already exist');
        } else {
            $this->getUser->assignRole($this->role);
            $this->alert('success', 'Role created');
        }
        //$this->getUserRoles = $this->getUser->fresh();
        $this->getUser = User::where('id',  $this->getUserId)->first();
        $this->getUserRoles = $this->getUser->roles;
    }
    public function revokeRole($roleName)
    {
        $this->getUser->removeRole($roleName);
        $this->alert('success', 'Role revoked');
        $this->getUserRoles = $this->getUser->roles->fresh();
    }
    public function reset_values()
    {
        $this->resetPage(pageName: 'employee-list');
        $this->resetExcept('showDiv');
        //return redirect()->to('/admin_index');
    }
}
