<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Constants\Status;
use App\Models\Society;
use Validator;

class SocietyController extends Controller
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
		return redirect()->route('admin.panel.society.listing');
	}

	public function listing() {
		return response()->view('panel.society.listing');
	}

	public function add() {
		$society = new Society;
		$society->status = Status::$ACTIVE;

		return response()->view('panel.society.add', ['society' => $society]);
	}

	public function edit(Request $request, $society_id) {
		$society = Society::with('Wings:auto_id,name')->stored()->societyId($society_id)->first();

		if(!$society) {
			return redirect()->route('panel.admin.listing')->with(['status' => false, 'message' => 'Society not found.', 'type' => 'danger', 'result' => null]);
		}

		$page = $request->page??'basic';

		return response()->view('panel.society.edit', ['society' => $society, 'page' => $page]);
	}

	public function search(Request $request) {
		$societyQuery = Society::stored();

		$query = $request->input('query');
		$pagination = $request->input('pagination');

		$search = isset($query['generalSearch']) ? $query['generalSearch'] : '';
		$status = isset($query['status']) ? $query['status'] : '';

		$page = (int) $pagination['page'];
		$count = (int) $pagination['perpage'];
		$startIndex = ($page - 1) * $count;

		$sort = $request->input('sort');
		$sortBy = isset($sort['field']) ? $sort['field'] : 'id';
		$sortDir = isset($sort['sort']) ? $sort['sort'] : 'desc';

		if(isset($sort)) {
			$societyQuery->orderBy($sortBy, $sortDir);
		}

		if(!empty($search)) {
			$societyQuery->search($search);
		}

		if(!empty($status)) {
			$societyQuery->status($status);
		}

		$societysCount = $societyQuery->count();
		if($startIndex != -1) {
			$societyQuery->offset($startIndex)->limit($count);
		}

		$societys = $societyQuery->get();

		$meta = [
			'page' => $page,
			'pages' => ceil($societysCount / $count),
			'perpage' => $count,
			'total' => $societysCount,
			'sort' => $sortDir,
			'field' => $sortBy,
			'startIndex' => $startIndex
		];

		return response()->json(['status' => true , 'message' => 'Society retrieved successfully' , 'result' => $societys , 'meta' => $meta]);
	}

	public function save(Request $request) {

		$society_id = $request->input('society_id');

		if($society_id) {
			$society = Society::get($society_id);
		} else {
			$society = new Society;
		}

		$validator = Validator::make($request->all(), [
			'society_name' => 'required|max:100',
			'society_full_name' => 'required|max:100',
			'address1' => 'max:255',
			'address2' => 'max:255',
			'area' => 'max:50',
			'city' => 'required|max:50',
			'state' => 'required|max:50',
			'country' => 'required|max:50',
			'pincode' => 'required|max:50',
			'phone' => 'max:50',
			'registration_number' => 'max:50',
			'society_email' => 'required|max:50',
			'status' => 'required|int',
		]);

		if($validator->fails()) {
			return response()->json(['status' => false , 'message' => 'Please re-check all fields.' , 'result' => $validator->errors()]);
		}

		//check if society name already exists
		$society_name = $request->input('society_name');
		$existingSocietyName = Society::stored()->status(Status::$ACTIVE)->name($society_name)->where('society_id', '!=', $society_id)->first();
		if($existingSocietyName){
			return response()->json(['status' => false , 'message' => 'Please re-check all fields.' , 'result' => ['society_name' => ['The society name has already been taken.']]]);
		}

		//check if society email already exists
		$society_email = $request->input('society_email');
		$existingSocietyEmail = Society::stored()->status(Status::$ACTIVE)->email($society_email)->where('society_id', '!=', $society_id)->first();
		if($existingSocietyEmail){
			return response()->json(['status' => false , 'message' => 'Please re-check all fields.' , 'result' => ['society_email' => ['The society email has already been taken.']]]);
		}

		$society->name = $request->input('society_name');
		$society->full_name = $request->input('society_full_name');
		$society->phone = $request->input('phone');
		$society->email = $request->input('society_email');
		$society->website = $request->input('website');
		$society->registration_number = $request->input('registration_number');

		$society->address_line_1 = $request->input('address1');
		$society->address_line_2 = $request->input('address2');
		$society->area = $request->input('area');
		$society->city = $request->input('city');
		$society->state = $request->input('state');
		$society->country = $request->input('country');
		$society->pincode = $request->input('pincode');

		$society->status = $request->input('status');
		$society->save();

		return response()->json(['status' => true , 'message' => 'Society saved successfully.' , 'result' => null]);
	}

	public function saveBasic(Request $request) {

		$society_id = $request->input('society_id');

		if($society_id) {
			$society = Society::get($society_id);
		} else {
			$society = new Society;
		}

		$validator = Validator::make($request->all(), [
			'society_name' => 'required|max:100',
			'society_full_name' => 'required|max:100',
			'phone' => 'max:50',
			'registration_number' => 'max:50',
			'society_email' => 'required|max:50',
			'status' => 'required|int',
		]);

		if($validator->fails()) {
			return response()->json(['status' => false , 'message' => 'Please re-check all fields.' , 'result' => $validator->errors()]);
		}

		//check if society name already exists
		$society_name = $request->input('society_name');
		$existingSocietyName = Society::stored()->status(Status::$ACTIVE)->name($society_name)->where('society_id', '!=', $society_id)->first();
		if($existingSocietyName){
			return response()->json(['status' => false , 'message' => 'Please re-check all fields.' , 'result' => ['society_name' => ['The society name has already been taken.']]]);
		}

		//check if society email already exists
		$society_email = $request->input('society_email');
		$existingSocietyEmail = Society::stored()->status(Status::$ACTIVE)->email($society_email)->where('society_id', '!=', $society_id)->first();
		if($existingSocietyEmail){
			return response()->json(['status' => false , 'message' => 'Please re-check all fields.' , 'result' => ['society_email' => ['The society email has already been taken.']]]);
		}

		$society->name = $request->input('society_name');
		$society->full_name = $request->input('society_full_name');
		$society->phone = $request->input('phone');
		$society->email = $request->input('society_email');
		$society->website = $request->input('website');
		$society->registration_number = $request->input('registration_number');

		$society->status = $request->input('status');
		$society->save();

		return response()->json(['status' => true , 'message' => 'Society basic info saved successfully.' , 'result' => null]);
	}

	public function saveLocation(Request $request) {

		$society_id = $request->input('society_id');

		if($society_id) {
			$society = Society::get($society_id);
		} else {
			$society = new Society;
		}

		$validator = Validator::make($request->all(), [
			'address1' => 'max:255',
			'address2' => 'max:255',
			'area' => 'max:50',
			'city' => 'required|max:50',
			'state' => 'required|max:50',
			'country' => 'required|max:50',
			'pincode' => 'required|max:50',
		]);

		if($validator->fails()) {
			return response()->json(['status' => false , 'message' => 'Please re-check all fields.' , 'result' => $validator->errors()]);
		}

		$society->address_line_1 = $request->input('address1');
		$society->address_line_2 = $request->input('address2');
		$society->area = $request->input('area');
		$society->city = $request->input('city');
		$society->state = $request->input('state');
		$society->country = $request->input('country');
		$society->pincode = $request->input('pincode');
		$society->save();

		return response()->json(['status' => true , 'message' => 'Society location info saved successfully.' , 'result' => null]);
	}

	public function delete(Request $request) {
		$society_id = $request->input('society_id');
		$society = Society::stored()->societyId($society_id)->first();

		//check if any wings exists
		if($society->wings->count()){
			return response()->json(['status' => false , 'message' => 'Please delete all the related wings before deleting society.' , 'result' => null]);
		}

		if($society) {
			$society->delete();
			return response()->json(['status' => true , 'message' => 'Society deleted successfully.' , 'result' => null]);
		}

		return response()->json(['status' => false , 'message' => 'Please try again later.' , 'result' => null]);
	}

	public function wings(Request $request)
	{
		$society_id = $request->input('society_id');
		$society = Society::stored()->status(Status::$ACTIVE)->with('Wings:auto_id,wing_id,society_id,name')->societyId($society_id)->first();

		return response()->json(['status' => true , 'message' => 'Wings received successfully.' , 'result' => $society->Wings]);
	}
}