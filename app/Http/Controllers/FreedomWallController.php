<?php

namespace App\Http\Controllers;

use App\Models\FreedomWall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreFreedomWallRequest;


class FreedomWallController extends Controller
{
    /*
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // fetch the query parameters from the request
        $queryParams = request()->query();

        // return error response if there's an invalid query parameter
        if (count(array_diff(array_keys($queryParams), ['page', 'per_page', 'sort_by', 'sort_order'])) > 0) {
            return response()->json([
                'error' => 'Invalid query parameters provided.'
            ], 400);
        }

        //TODO: implement sorting logic
        // get the 'page' and 'per_page' query parameters, defaulting to 1 and 5 respectively
        $page = (int) ($queryParams['page'] ?? 1);
        $perPage = (int) ($queryParams['per_page'] ?? 5);
        //paginate
        $freedomWalls = FreedomWall::query()->paginate(perPage: $perPage, page: $page);
        return response()->json($freedomWalls, 200);
    }

    public function store(Request $request)
    {
        $formRequest = new StoreFreedomWallRequest();
        // internal bootstrapping 
        $formRequest->setContainer(app())->setRedirector(app('redirect'));

        $validator = Validator::make(
            $request->all(),
            $formRequest->rules(),
            $formRequest->messages()
        );

        if ($validator->fails()) {
            // Print or return error messages
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $validatedData = $validator->validated();

        $freedomWall = FreedomWall::create($validatedData);
        // check if response is empty self(), handle error
        if (!$freedomWall || !$freedomWall->exists) {
            // return a JSON response with an error message

            return response()->json([
                'error' => 'Failed to create Freedom Wall. Please try again later.'
            ], 500);
        }
        return response()->json($freedomWall, 201);
    }

    public function show($id){
        $freedomWall = FreedomWall::find($id);

        if (!$freedomWall) {
            return response()->json([
                'error' => 'Freedom Wall not found.'
            ], 404);
        }

        return response()->json($freedomWall, 200);
    }

    //TODO: update and delete methods
}
