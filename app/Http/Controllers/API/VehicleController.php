<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Vehicle as VehicleResource;
use App\Models\Vehicle;
use Validator;
use Illuminate\Contracts\Support\Jsonable;

/**
 * @group Vehicles
 */

class VehicleController extends BaseController
{

    /**
     * List all vehicles
     * 
     * @bodyParam per_page int Example: 10
     * @bodyParam search_for string Search term. Example: Honda
     * @bodyParam search_in string Options: type, msrp, make, year, model, miles, vin, created_at, updated_at Example: make
     * @bodyParam order_direction string Options: ASC and DESC Example: ASC 
     *
     * @return     <JSON>  ( response )
     */
    public function index(Request $request)
    {
        $params['per_page'] = request('per_page', 10);
        $params['cursor'] = request('cursor', NULL);
        $params['search_for'] = request('search_for', NULL);
        $params['search_in'] = request('search_in', NULL);
        $params['order_by'] = 'id'; // needs ID for cursore pagination
        $params['order_direction'] = request('order_direction', 'ASC');
        
        $paginator = Vehicle::orderBy($params['order_by'], $params['order_direction']);
        
        switch (env('VEHICLE_CONDITION')) {
            case 'new':
                $paginator->where('type', 'LIKE', 'new');
                break;
            case 'used':
                $paginator->where('type', 'LIKE', 'used');
                break;
        }

        if (!is_null($params['search_for']) && !is_null($params['search_in']))
            $paginator->where($params['search_in'], 'LIKE', '%'.$params['search_for'].'%');
        
        $cols = [
            'id',
            'type',
            'msrp',
            'year',
            'make',
            'model',
            'miles',
            'vin',
            'created_at',
        ];
        
        return $paginator->cursorPaginate($params['per_page'], $cols, 'cursor', $params['cursor']);
    }

    
    /**
     * Create a vehicle
     * 
     * @bodyParam make string required The make of the vehicle. Example: Honda
     * @bodyParam year int required The year of the vehicle. Example: 2022
     * @bodyParam model string required The model of the vehicle. Example: Accord
     * @bodyParam miles string required The miles of the vehicle. Example: 20000
     * @bodyParam vin string required The VIN of the vehicle. Example: 4Y1SL65848Z411439
     * @bodyParam type string required The condition of the vehicle. Example: new
     * @bodyParam msrp numeric required The MSRP of the vehicle. Example: 189000.99
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
            'msrp' => 'required|numeric',
            'make' => 'required',
            'year' => 'required|int|digits:4',
            'model' => 'required',
            'miles' => 'required|int',
            'vin' => 'required',
        ]);
        
        if($validator->fails()){
            return $this->handleError($validator->errors());       
        }
        
        $vehicle = Vehicle::create($input);
        
        return $this->handleResponse(new VehicleResource($vehicle), 'Vehicle created!');
    }

   
    /**
     * Get a vehicle
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
     * Patch a vehicle
     * 
     * @bodyParam make string The make of the vehicle. Example: Honda
     * @bodyParam year int The year of the vehicle. Example: 2022
     * @bodyParam model string The model of the vehicle. Example: Accord
     * @bodyParam miles string The miles of the vehicle. Example: 20000
     * @bodyParam vin string The VIN of the vehicle. Example: 4Y1SL65848Z411439
     * @bodyParam type string The condition of the vehicle. Example: new
     * @bodyParam msrp int The MSRP of the vehicle. Example: 189000.99
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
     * Put a vehicle
     * 
     * @bodyParam make string required The make of the vehicle. Example: Honda
     * @bodyParam year int required The year of the vehicle. Example: 2022
     * @bodyParam model string required The model of the vehicle. Example: Accord
     * @bodyParam miles string required The miles of the vehicle. Example: 20000
     * @bodyParam vin string required The VIN of the vehicle. Example: 4Y1SL65848Z411439
     * @bodyParam type string required The condition of the vehicle. Example: new
     * @bodyParam msrp int required The MSRP of the vehicle. Example: 189000.99
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
     * Delete a vehicle
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