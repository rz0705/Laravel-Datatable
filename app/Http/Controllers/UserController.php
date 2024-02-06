<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Enums\UserStatus;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userStatuses;

    public function __construct() {
        parent::__construct();
        // Your constructor logic
    }

    public function index(UsersDataTable $dataTable) {
        $this->pageTitle = 'Users';
        return $dataTable->render('users.index', $this->data);
    }

    public function create() {
        $this->user = new User();
        $this->pageTitle = 'Create User';
        return view('users.create-update-show', $this->data);
    }

    public function store(UserRequest $request) {
        $validated = $request->validated();
        $user = User::create($validated);
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user) {
        $this->pageTitle = 'Edit User';
        $this->user = $user;
        return view('users.create-update-show', $this->data);
    }

    public function update(UserRequest $request, User $user) {
        $validated = $request->validated();
        $user->update($validated);
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function show(User $user) {
        $this->pageTitle = 'User Details';
        $this->user = $user;
        return view('users.create-update-show', $this->data);
    }
}
