<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Constants\Status;
use App\Models\Wing;
use App\Models\Society;
use Validator;

class WingController extends Controller
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
		return redirect()->route('admin.panel.wing.listing');
	}

	public function listing() {
		$societies = Society::stored()->status(Status::$ACTIVE)->pluck('name','society_id')->all();

		return response()->view('panel.wing.listing', ['societies' => $societies]);
	}

	public function add(Request $request) {
		$wing = new Wing;
		$wing->status = Status::$ACTIVE;

		$societies = Society::stored()->status(Status::$ACTIVE)->get();

		$society = Society::stored()->status(Status::$ACTIVE)->societyId($request->society_id)->first();

		// return response()->view('panel.wing.add', ['wing' => $wing, 'societies' => $societies, 'society' => $society]);
		return response()->view('panel.society.edit2', ['wing' => $wing, 'society' => $society, 'page' => 'wings.add']);
	}

	public function edit($wing_id) {
		$wing = Wing::with('Society:auto_id,society_id,name')->stored()->wingId($wing_id)->first();

		$societies = Society::stored()->status(Status::$ACTIVE)->get();

		if(!$wing) {
			return redirect()->route('panel.admin.listing')->with(['status' => false, 'message' => 'Wing not found.', 'type' => 'danger', 'result' => null]);
		}

		$society = Society::stored()->status(Status::$ACTIVE)->societyId($wing->society->society_id)->first();

		// return response()->view('panel.wing.add', ['wing' => $wing, 'societies' => $societies, 'society' => $society]);
		return response()->view('panel.society.edit2', ['wing' => $wing, 'society' => $society, 'page' => 'wings.add']);

		// return response()->view('panel.wing.add', ['wing' => $wing, 'societies' => $societies]);
	}

	public function search(Request $request) {
		$wingQuery = Wing::with('Society:auto_id,society_id,name')->stored();

		$query = $request->input('query');
		$pagination = $request->input('pagination');

		$search = isset($query['generalSearch']) ? $query['generalSearch'] : '';
		$society_id = isset($query['society_id']) ? $query['society_id'] : '';
		$status = isset($query['status']) ? $query['status'] : '';

		$page = (int) $pagination['page'];
		$count = (int) $pagination['perpage'];
		$startIndex = ($page - 1) * $count;

		$sort = $request->input('sort');
		$sortBy = isset($sort['field']) ? $sort['field'] : 'id';
		$sortDir = isset($sort['sort']) ? $sort['sort'] : 'desc';

		if(isset($sort)) {
			$wingQuery->orderBy($sortBy, $sortDir);
		}

		if(!empty($search)) {
			$wingQuery->search($search);
		}

		if(!empty($society_id)) {
			$wingQuery->where('society_id',$society_id);
		}

		if(!empty($status)) {
			$wingQuery->status($status);
		}

		$wingsCount = $wingQuery->count();
		if($startIndex != -1) {
			$wingQuery->offset($startIndex)->limit($count);
		}

		$wings = $wingQuery->get();

		$meta = [
			'page' => $page,
			'pages' => ceil($wingsCount / $count),
			'perpage' => $count,
			'total' => $wingsCount,
			'sort' => $sortDir,
			'field' => $sortBy,
			'startIndex' => $startIndex
		];

		return response()->json(['status' => true , 'message' => 'Wing retrieved successfully' , 'result' => $wings , 'meta' => $meta]);
	}

	public function save(Request $request) {

		$wing_id = $request->input('wing_id');

		if($wing_id) {
			$wing = Wing::get($wing_id);
		} else {
			$wing = new Wing;
		}

		$validator = Validator::make($request->all(), [
			'society_id' => 'required|max:100',
			'wing_name' => 'required|max:100',
			'number_of_floors' => 'required|int|max:20',
			'flats_per_floor' => 'required|int|max:10',
			'wing_type' => 'required|max:20',
		]);

		if($validator->fails()) {
			return response()->json(['status' => false , 'message' => 'Please re-check all fields.' , 'result' => $validator->errors()]);
		}

		$society_id = $request->input('society_id');
		$society = Society::stored()->societyId($society_id)->first();
		if(!$society) {
			return response()->json(['status' => false , 'message' => 'Matching Society not found.' , 'result' => null]);
		}

		$wing_name = $request->input('wing_name');
		//check wing name is unique.
		$wing_obj = Wing::stored()->name($wing_name)->where('wing_id', '!=', $wing_id)->societyId($society_id)->first();
		if($wing_obj){
			return response()->json(['status' => false , 'message' => 'Wing with same name already exists in this society.' , 'result' => null]);
		}

		$wing->society_id = $society->society_id;
		$wing->name = $request->input('wing_name');
		$wing->type = $request->input('wing_type');
		$wing->number_of_floors = $request->input('number_of_floors');
		$wing->number_of_flats = $request->input('flats_per_floor');
		$wing->status = $request->input('status');
		$wing->save();

		return response()->json(['status' => true , 'message' => 'Wing saved successfully.' , 'result' => null]);
	}

	public function delete(Request $request) {
		$wing_id = $request->input('wing_id');
		$wing = Wing::stored()->wingId($wing_id)->first();

		//check if any properties exists
		if($wing->properties->count()){
			return response()->json(['status' => false , 'message' => 'Please delete all the related properties before deleting society wing.' , 'result' => null]);
		}

		if($wing) {
			$wing->delete();
			return response()->json(['status' => true , 'message' => 'Wing deleted successfully.' , 'result' => null]);
		}

		return response()->json(['status' => false , 'message' => 'Please try again later.' , 'result' => null]);
	}
}