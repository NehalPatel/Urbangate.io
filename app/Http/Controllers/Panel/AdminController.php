<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Constants\Status;
use Validator;
use Auth;

use App\Models\Admin;

class AdminController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

		// $this->middleware('permission:admin_view');
		// $this->middleware('permission:admin_create', ['only' => ['add','save']]);
		// $this->middleware('permission:admin_update', ['only' => ['edit','save']]);
		// $this->middleware('permission:admin_delete', ['only' => ['delete']]);
    }

    public function index() {
		return redirect()->route('admin.panel.admin.listing');
	}

	public function listing() {
		return response()->view('panel.admin.listing');
	}

	public function add() {
		$admin = new Admin;
		$admin->status = Status::$ACTIVE;

		return response()->view('panel.admin.add', ['admin' => $admin]);
	}

	public function edit($admin_id) {
		$admin = Admin::stored()->adminId($admin_id)->first();

		if(!$admin) {
			return redirect()->route('panel.admin.listing')->with(['status' => false, 'message' => 'Admin not found.', 'type' => 'danger', 'result' => null]);
		}

		return response()->view('panel.admin.add', ['admin' => $admin]);
	}

	public function search(Request $request) {
		$adminQuery = Admin::stored();

		$query = $request->input('query');
		$pagination = $request->input('pagination');

		$search = isset($query['search']) ? $query['search'] : '';
		$status = isset($query['status']) ? $query['status'] : '';

		$page = (int) $pagination['page'];
		$count = (int) $pagination['perpage'];
		$startIndex = ($page - 1) * $count;

		$sort = $request->input('sort');
		$sortBy = isset($sort['field']) ? $sort['field'] : 'id';
		$sortDir = isset($sort['sort']) ? $sort['sort'] : 'desc';

		if(isset($sort)) {
			$adminQuery->orderBy($sortBy, $sortDir);
		}

		if(!empty($search)) {
			$adminQuery->search($search);
		}

		if(!empty($status)) {
			$adminQuery->status($status);
		}

		$adminsCount = $adminQuery->count();
		if($startIndex != -1) {
			$adminQuery->offset($startIndex)->limit($count);
		}

		$admins = $adminQuery->get();

		$meta = [
			'page' => $page,
			'pages' => ceil($adminsCount / $count),
			'perpage' => $count,
			'total' => $adminsCount,
			'sort' => $sortDir,
			'field' => $sortBy,
			'startIndex' => $startIndex
		];

		return response()->json(['status' => true , 'message' => 'Admin retrieved successfully' , 'result' => $admins , 'meta' => $meta]);
	}

	public function save(Request $request) {
		$validator = Validator::make($request->all(), [
			'first_name' => 'required|max:100',
			'last_name' => 'max:100',
			'email' => 'required|email|max:100',
			'status' => 'required|int',
		]);

		if($validator->fails()) {
			return response()->json(['status' => false , 'message' => 'Please re-check all fields.' , 'result' => $validator->errors()]);
		}

		$admin_id = $request->input('admin_id');
		$email = trim($request->input('email'));
		$password = $request->input('password');

		$existingAdmin = Admin::stored()->where('admin_id', '!=', $admin_id)->email($email)->first();
		if($existingAdmin) {
			return response()->json(['status' => false , 'message' => 'Admin with same email already exists.' , 'result' => null]);
		}

		if($admin_id) {
			$admin = Admin::get($admin_id);
		} else {
			$admin = new Admin;
		}

		if($password) {
			$admin->password = bcrypt($password);
		}

		$admin->first_name = $request->input('first_name');
		$admin->last_name = $request->input('last_name');
		$admin->email = $email;
		$admin->status = $request->input('status');
		$admin->save();

		return response()->json(['status' => true , 'message' => 'Admin saved successfully.' , 'result' => null]);
	}

	public function delete(Request $request) {
		$admin_id = $request->input('admin_id');
		$admin = Admin::stored()->adminId($admin_id)->first();

		if($admin && (Auth::user()->admin_id != $admin->admin_id)) {
			$admin->delete();
			return response()->json(['status' => true , 'message' => 'Admin deleted successfully.' , 'result' => null]);
		}

		return response()->json(['status' => false , 'message' => 'Please try again later.' , 'result' => null]);
	}
}