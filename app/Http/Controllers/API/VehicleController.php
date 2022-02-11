<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Vehicle as VehicleResource;
use App\Models\Vehicle;
use Validator;
use Illuminate\Contracts\Support\Jsonable;

class VehicleController extends BaseController
{

    /**
     * Gets multiple paginated/searchable vehicles
     * 
     * Optional params are:
     * 
     * - cursor
     * - per_page
     * - search_for
     * - search_in
     * - order_by
     * - order_direction
     *
     * @return     <JSON>  ( response )
     */
    public function index()
    {
        $per_page = request('per_page', 10);
        $cursor = request('cursor', NULL);
        $search_for = request('search_for', NULL);
        $search_in = request('search_in', NULL);
        $order_by = request('order_by', 'id');
        $order_direction = request('order_direction', 'ASC');
        
        $paginator = Vehicle::orderBy($order_by, $order_direction);

        if (!is_null($search_for) && !is_null($search_in))
            $paginator->where($search_in, 'LIKE', '%'.$search_for.'%');
        
        return $paginator->cursorPaginate($per_page, ['*'], 'cursor', $cursor);
    }

    
    /**
     * Creates a Vehicle
     *
     * @param      \Illuminate\Http\Request  $request  The request
     *
     * @return     <JSON>                    ( response )
     */
    public function store(Request $request)
    {
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'type' => 'required',
            'msrp' => 'required',
            'make' => 'required',
            'year' => 'required',
            'model' => 'required',
            'miles' => 'required',
            'vin' => 'required',
        ]);
        
        if($validator->fails()){
            return $this->handleError($validator->errors());       
        }
        
        $vehicle = Vehicle::create($input);
        
        return $this->handleResponse(new VehicleResource($vehicle), 'Vehicle created!');
    }

   
    /**
     * Gets a Vehicle
     *
     * @param      <int>  $id     The identifier
     *
     * @return     <JSON>  ( response )
     */
    public function show($id)
    {
        $vehicle = Vehicle::find($id);
        
        if (is_null($vehicle)) {
            return $this->handleError('Vehicle not found!');
        }
        
        return $this->handleResponse(new VehicleResource($vehicle), 'Vehicle retrieved.');
    }
    

    /**
     * Updates/Patches a Vehicle
     *
     * @param      \Illuminate\Http\Request  $request  The request
     * @param      \App\Models\Vehicle       $vehicle  The vehicle
     *
     * @return     <JSON>                    ( response )
     */
    public function patch(Request $request, Vehicle $vehicle)
    {
        $input = $request->all();
        
        $fillables = $vehicle->getFillablesArr();
        
        $vehicle->fill($request->only($fillables));
        
        $vehicle->save();
        
        return $this->handleResponse(new VehicleResource($vehicle), 'Vehicle successfully updated!');
    }
    

    /**
     * Updates/Puts a Vehicle
     *
     * @param      \Illuminate\Http\Request  $request  The request
     * @param      \App\Models\Vehicle       $vehicle  The vehicle
     *
     * @return     <JSON>                    ( response )
     */
    public function put(Request $request, Vehicle $vehicle)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'type' => 'required',
            'msrp' => 'required',
            'make' => 'required',
            'year' => 'required',
            'model' => 'required',
            'miles' => 'required',
            'vin' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->handleError($validator->errors());       
        }
        
        $fillables = $vehicle->getFillablesArr();
        
        $vehicle->fill($request->only($fillables));
        $vehicle->save();
        
        return $this->handleResponse(new VehicleResource($vehicle), 'Vehicle successfully updated!');
    }
   
    /**
     * Destroys the given vehicle.
     * 
     * NOTE: Soft deletes.
     *
     * @param      \App\Models\Vehicle  $vehicle  The vehicle
     *
     * @return     <JSON>               ( response )
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        
        return $this->handleResponse([], 'Vehicle deleted!');
    }
}