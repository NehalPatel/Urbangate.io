<?php

namespace App\Http\Controllers\Panel;

use App\Constants\Status;
use App\Constants\RolesPermissions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Role;
use App\Models\Permission;

use Validator;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('auth');

         // $this->middleware('permission:permission_view');
         // $this->middleware('permission:permission_create', ['only' => ['add','save']]);
         // $this->middleware('permission:permission_update', ['only' => ['edit','save']]);
         // $this->middleware('permission:permission_delete', ['only' => ['delete']]);
    }

    /**
     * function will redirect to the available permission listing.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        return redirect()->route('admin.panel.permission.listing');
    }

    /**
     * function will show all the permission in listing view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listing()
    {
        return view('panel.permission.listing');
    }

    /**
     * Add new permission to the system.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        $permissions = Permission::stored()->pluck('name', 'id')->all();
        // dd($permissions);

        return view('panel.permission.add', ['permissions' => $permissions]);
    }

    /**
     * Update any existing permission.
     *
     * @param $permission_id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($permission_id)
    {
        $permission = Permission::get($permission_id);

        $permission_permissions = [];
        foreach($permission->permissions as $permission)
        {
            $permission_permissions[] = $permission->name;
        }

        return view('panel.permission.add', ['permission' => $permission, 'permission_permissions' => $permission_permissions]);
    }

    /**
     * ajax function, which will handle the search request for permission permissions.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $permissionQuery = Permission::stored();

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
            $permissionQuery->orderBy($sortBy, $sortDir);
        }

        if(!empty($search)) {
            $permissionQuery->search($search);
        }

        if(!empty($status)) {
            $permissionQuery->status($status);
        }

        $permissionsCount = $permissionQuery->count();
        if($startIndex != -1) {
            $permissionQuery->offset($startIndex)->limit($count);
        }

        $permissions = $permissionQuery->get();

        $meta = [
            'page' => $page,
            'pages' => ceil($permissionsCount / $count),
            'perpage' => $count,
            'total' => $permissionsCount,
            'sort' => $sortDir,
            'field' => $sortBy,
            'startIndex' => $startIndex
        ];

        return response()->json(['status' => true , 'message' => 'Permission retrieved successfully' , 'result' => $permissions , 'meta' => $meta]);
    }

    /**
     * Save new/update existing permission.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $new_permissions = $request->input('permissions');
        if(empty($new_permissions))
            return response()->json(['status' => false, 'message' => 'Server error, No new permissions provided', 'result' => null]);

        try {

            foreach (RolesPermissions::$GUARDS as $guard_name) {
                foreach ($new_permissions as $key => $name) {
                    $permission = new Permission;
                    $permission->name = $name;
                    $permission->guard_name = $guard_name;
                    $permission->save();
                }
            }

            return response()->json(['status' => true, 'message' => 'Permission saved successfully.', 'result' => '']);

        } catch (\Exception $e) {

            return response()->json(['status' => false, 'message' => 'Server error, please retry', 'result' => $e->getMessage()]);

        }
    }

    /**
     * Delete the permission.
     *
     * @param $permission_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($permission_id)
    {
        $permission = Permission::permissionId($permission_id)->first();
        $permission->delete();

        return response()->json(['status' => true, 'message' => 'permission has been deleted.', 'result' => $permission->permission_id]);
    }
}
