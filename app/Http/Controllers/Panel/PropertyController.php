<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Constants\Status;
use App\Models\Society;
use App\Models\Wing;
use App\Models\Property;

use Validator;

class PropertyController extends Controller
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
		return redirect()->route('admin.panel.property.listing');
	}

	public function listing() {
		$societies = Society::stored()->status(Status::$ACTIVE)->pluck('name','society_id')->all();

		return response()->view('panel.property.listing', ['societies' => $societies]);
	}

	public function add(Request $request) {
		$property = new Property;
		$property->status = Status::$ACTIVE;

		$societies = Society::stored()->status(Status::$ACTIVE)->get();
		$wings = [];

		// return response()->view('panel.property.add', ['property' => $property, 'societies' => $societies, 'wings' => $wings]);

		$society = Society::stored()->status(Status::$ACTIVE)->societyId($request->society_id)->first();

		return response()->view('panel.society.edit2', ['property' => $property, 'society' => $society, 'wings' => $wings, 'page' => 'properties.add']);
	}

	public function edit($property_id) {
		$property = Property::stored()->propertyId($property_id)->first();

		if(!$property) {
			return redirect()->route('admin.panel.property.listing')->with(['status' => false, 'message' => 'Property not found.', 'type' => 'danger', 'result' => null]);
		}

		$societies = Society::stored()->status(Status::$ACTIVE)->get();
		$wings = Wing::stored()->status(Status::$ACTIVE)->get();

		// return response()->view('panel.property.add', ['property' => $property, 'societies' => $societies, 'wings' => $wings]);
		$society = Society::stored()->status(Status::$ACTIVE)->societyId($request->society_id)->first();
		return response()->view('panel.society.edit2', ['property' => $property, 'society' => $society, 'page' => 'property.add']);
	}

	public function search(Request $request) {
		$propertyQuery = Property::with('Society:auto_id,society_id,name')->with('Wing:auto_id,wing_id,name')->stored();

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
			$propertyQuery->orderBy($sortBy, $sortDir);
		}

		if(!empty($search)) {
			$propertyQuery->search($search);
		}

		if(!empty($society_id)) {
			$propertyQuery->where('society_id',$society_id);
		}

		if(!empty($status)) {
			$propertyQuery->status($status);
		}

		$propertysCount = $propertyQuery->count();
		if($startIndex != -1) {
			$propertyQuery->offset($startIndex)->limit($count);
		}

		$propertys = $propertyQuery->get();

		$meta = [
			'page' => $page,
			'pages' => ceil($propertysCount / $count),
			'perpage' => $count,
			'total' => $propertysCount,
			'sort' => $sortDir,
			'field' => $sortBy,
			'startIndex' => $startIndex
		];

		return response()->json(['status' => true , 'message' => 'Property retrieved successfully' , 'result' => $propertys , 'meta' => $meta]);
	}

	public function save(Request $request) {
		$validator = Validator::make($request->all(), [
			'society_id' => 'required|max:50',
			'wing_id' => 'required|max:50',
			'property_number' => 'required|int|max:10000',
			'floor_number' => 'int|max:50',
			'type' => 'required|max:100',
			'property_location' => 'max:50',
			'property_size_sqft' => 'nullable|int|max:10000',
			'status' => 'required|int|max:100',
		]);

		if($validator->fails()) {
			return response()->json(['status' => false , 'message' => 'Please re-check all fields.' , 'result' => $validator->errors()]);
		}

		$society_id = $request->input('society_id');
		$wing_id = $request->input('wing_id');
		$property_id = $request->input('property_id');
		$property_number = $request->input('property_number');

		//check if wing belong to selected society
		$wing = Wing::get($wing_id);
		if($wing->society_id != $society_id){
			return response()->json(['status' => false , 'message' => 'Selected Society and wing mismatched.' , 'result' => null]);
		}

		//check if property is unique or not
		$existingPorperty = Property::stored()
				->societyId($society_id)->wingId($wing_id)->propertyNumber($property_number)
				->where('property_id', '!=', $property_id)->first();
		if($existingPorperty){
			return response()->json(['status' => false , 'message' => 'Property with same number already exists.' , 'result' => null]);
		}

		if($property_id) {
			$property = Property::get($property_id);
		} else {
			$property = new Property;
		}

		$property->society_id = $society_id;
		$property->wing_id = $wing_id;
		$property->property_number = $property_number;
		$property->type = $request->input('type');
		$property->property_location = $request->input('property_location');
		$property->property_size_sqft = $request->input('property_size_sqft') ?? 0;
		$property->primary_owner_id = $request->input('primary_owner_id');
		$property->secondary_owner_id = $request->input('secondary_owner_id');
		$property->status = $request->input('status');
		$property->save();

		return response()->json(['status' => true , 'message' => 'Property saved successfully.' , 'result' => null]);
	}

	public function delete(Request $request) {
		$property_id = $request->input('property_id');

		if(is_array($property_id)){

			if( Property::destroy($property_id))
				return response()->json(['status' => true , 'message' => 'Property deleted successfully.' , 'result' => null]);

		} else {
			$property = Property::stored()->propertyId($property_id)->first();

			if($property) {
				$property->delete();
				return response()->json(['status' => true , 'message' => 'Property deleted successfully.' , 'result' => null]);
			}
		}
		return response()->json(['status' => false , 'message' => 'Please try again later.' , 'result' => null]);
	}
}