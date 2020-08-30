<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Constants\Status;
use Validator;
use Auth;

use App\Models\User;

class UserController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

		// $this->middleware('permission:user_view');
		// $this->middleware('permission:user_create', ['only' => ['add','save']]);
		// $this->middleware('permission:user_update', ['only' => ['edit','save']]);
		// $this->middleware('permission:user_delete', ['only' => ['delete']]);
    }

    public function index() {
		return redirect()->route('admin.panel.user.listing');
	}

	public function listing() {
		return response()->view('panel.user.listing');
	}

	public function add() {
		$user = new User;
		$user->status = Status::$ACTIVE;

		return response()->view('panel.user.add', ['user' => $user]);
	}

	public function edit($user_id) {
		$user = User::stored()->userId($user_id)->first();

		if(!$user) {
			return redirect()->route('panel.user.listing')->with(['status' => false, 'message' => 'User not found.', 'type' => 'danger', 'result' => null]);
		}

		return response()->view('panel.user.add', ['user' => $user]);
	}

	public function search(Request $request) {
		$userQuery = User::stored();

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
			$userQuery->orderBy($sortBy, $sortDir);
		}

		if(!empty($search)) {
			$userQuery->search($search);
		}

		if(!empty($status)) {
			$userQuery->status($status);
		}

		$usersCount = $userQuery->count();
		if($startIndex != -1) {
			$userQuery->offset($startIndex)->limit($count);
		}

		$users = $userQuery->get();

		$meta = [
			'page' => $page,
			'pages' => ceil($usersCount / $count),
			'perpage' => $count,
			'total' => $usersCount,
			'sort' => $sortDir,
			'field' => $sortBy,
			'startIndex' => $startIndex
		];

		return response()->json(['status' => true , 'message' => 'User retrieved successfully' , 'result' => $users , 'meta' => $meta]);
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

		$user_id = $request->input('user_id');
		$email = trim($request->input('email'));
		$password = $request->input('password');

		$existingUser = User::stored()->where('user_id', '!=', $user_id)->email($email)->first();
		if($existingUser) {
			return response()->json(['status' => false , 'message' => 'User with same email already exists.' , 'result' => null]);
		}

		if($user_id) {
			$user = User::get($user_id);
		} else {
			$user = new User;
		}

		if($password) {
			$user->password = bcrypt($password);
		}

		$user->first_name = $request->input('first_name');
		$user->last_name = $request->input('last_name');
		$user->email = $email;
		$user->status = $request->input('status');
		$user->save();

		return response()->json(['status' => true , 'message' => 'User saved successfully.' , 'result' => null]);
	}

	public function delete(Request $request) {
		$user_id = $request->input('user_id');
		$user = User::stored()->userId($user_id)->first();

		if($user && (Auth::user()->user_id != $user->user_id)) {
			$user->delete();
			return response()->json(['status' => true , 'message' => 'User deleted successfully.' , 'result' => null]);
		}

		return response()->json(['status' => false , 'message' => 'Please try again later.' , 'result' => null]);
	}
}