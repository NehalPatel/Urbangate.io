<?php

namespace App\Http\Controllers\Panel;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Role;
use App\Models\Permission;

use Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('auth');

         // $this->middleware('permission:role_view');
         // $this->middleware('permission:role_create', ['only' => ['add','save']]);
         // $this->middleware('permission:role_update', ['only' => ['edit','save']]);
         // $this->middleware('permission:role_delete', ['only' => ['delete']]);
    }

    /**
     * function will redirect to the available role listing.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        return redirect()->route('admin.panel.role.listing');
    }

    /**
     * function will show all the role in listing view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listing()
    {
        return view('panel.role.listing');
    }

    /**
     * Add new role to the system.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        $role = new Role();
        $role_permissions = [];

        return view('panel.role.add', ['role' => $role, 'role_permissions' => $role_permissions]);
    }

    /**
     * Update any existing role.
     *
     * @param $role_id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($role_id)
    {
        $role = Role::get($role_id);

        $role_permissions = [];
        foreach($role->permissions as $permission)
        {
            $role_permissions[] = $permission->name;
        }

        // dd($role->guard_name);

        return view('panel.role.add', ['role' => $role, 'role_permissions' => $role_permissions]);
    }

    /**
     * ajax function, which will handle the search request for role roles.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $roleQuery = Role::stored();

        $query = $request->input('query');
        $pagination = $request->input('pagination');

        $search = isset($query['search']) ? $query['search'] : '';
        $status = isset($query['status']) ? $query['status'] : '';

        $page = (int) $pagination['page'];
        $count = (int) $pagination['perpage'];
        $startIndex = ($page - 1) * $count;

        $sort = $request->input('sort');
        $sortBy = isset($sort['field']) ? $sort['field'] : 'autoId';
        $sortDir = isset($sort['sort']) ? $sort['sort'] : 'desc';

        if(isset($sort)) {
            $roleQuery->orderBy($sortBy, $sortDir);
        }

        if(!empty($search)) {
            $roleQuery->search($search);
        }

        if(!empty($status)) {
            $roleQuery->status($status);
        }

        $rolesCount = $roleQuery->count();
        if($startIndex != -1) {
            $roleQuery->offset($startIndex)->limit($count);
        }

        $roles = $roleQuery->get();

        $meta = [
            'page' => $page,
            'pages' => ceil($rolesCount / $count),
            'perpage' => $count,
            'total' => $rolesCount,
            'sort' => $sortDir,
            'field' => $sortBy,
            'startIndex' => $startIndex
        ];

        return response()->json(['status' => true , 'message' => 'Role retrieved successfully' , 'result' => $roles , 'meta' => $meta]);
    }

    /**
     * Save new/update existing role.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Please re-check all fields.', 'result' => $validator->errors()]);
        }

        $role_id = $request->input('role_id');
        $name = $request->input('name');
        $guard_name = $request->input('guard_name');

        //check if same named role exists with guard name.
        //No duplicate role name allowed in same guard name.
        $role = Role::where('id', '!=', $role_id)->where('guard_name', $guard_name)->name($name)->first();

        if($role){
            return response()->json(['status' => false, 'message' => 'Role name already used with selected guard.', 'result' => null]);
        }

        try {
            if ($role_id) {
                $role = Role::get($role_id);
                $role->name = $request->name;
                $role->guard_name = $request->guard_name;
                $role->save();
            } else {
                //create new role
                $role = Role::create([
                    'name' => $request->input('name'),
                    'guard_name' => $request->input('guard_name')
                ]);
            }

            //create each permission one by one
            $permissions = $request->input('permissions');


            //assign all the permissions to new created role
            $role->syncPermissions($permissions);

            return response()->json(['status' => true, 'message' => 'Role saved successfully.', 'result' => $role->role_id]);

        } catch (\Exception $e) {

            return response()->json(['status' => false, 'message' => 'Server error, please retry', 'result' => $e->getMessage()]);

        }
    }

    /**
     * Delete the role.
     *
     * @param $role_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $role_id = $request->input('role_id');
        $role = Role::roleId($role_id)->first();

        if(!$role){
            return response()->json(['status' => false, 'message' => 'Selected role not found', 'result' => null]);
        }

        $role->delete();

        return response()->json(['status' => true, 'message' => 'role has been deleted.', 'result' => $role->role_id]);
    }
}
