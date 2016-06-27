<?php
namespace emutoday\Http\Controllers\Admin;
use emutoday\User;
use Illuminate\Http\Request;
use emutoday\Http\Requests;

class UsersController extends Controller
{
    protected $users;
    public function __construct(User $users)
    {
        $this->users = $users;
        parent::__construct();
    }

    public function index()
    {
        $users = $this->users->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create(User $user)
    {
				$userRoles = \emutoday\Role::lists('name', 'id');
        return view('admin.users.form', compact('user','userRoles' ));
    }

    public function store(Requests\StoreUserRequest $request)
    {
        $this->users->create($request->only('last_name', 'first_name', 'phone', 'email', 'password'));
        flash()->success('User has been created.');
        return redirect(route('admin.users.index'));//->with('status', 'User has been created.');
    }


    public function edit($id)
    {
        $user = $this->users->findOrFail($id);
				$userRoles = \emutoday\Role::lists('name', 'id');

        return view('admin.users.form', compact('user', 'userRoles'));
    }

    public function update(Requests\UpdateUserRequest $request, $id)
    {
        $user = $this->users->findOrFail($id);
        $user->fill($request->only('last_name', 'first_name', 'phone', 'email', 'password'))->save();
				$rolesList = $request->input('role_list') == null ? [] : $request->input('role_list');
        $user->roles()->sync($rolesList);
        flash()->success('User has been updated.');
        return redirect(route('admin.users.edit', $user->id));//->with('status', 'User has been updated.');
    }
    public function confirm(Requests\DeleteUserRequest $request, $id)
    {
        $user = $this->users->findOrFail($id);
        return view('admin.users.confirm', compact('user'));
    }

    public function destroy(Requests\DeleteUserRequest $request, $id)
    {
        $user = $this->users->findOrFail($id);
        $user->delete();
        flash()->warning('User has been deleted.');
        return redirect(route('admin.users.index'));//->with('status', 'User has been deleted.');
    }

		/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
			$user = $this->users->findOrFail($id);
			$userRoles = $user->roles;
			return view('admin.users.show', compact('user', 'userRoles'));
    }
}
