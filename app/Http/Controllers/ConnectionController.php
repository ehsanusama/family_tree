<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Connection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConnectionController extends Controller
{
    public function index()
    {
        $connections = Connection::all();
        return response()->json($connections, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'person_id' => 'required|exists:people,id',
            'related_person_id' => 'required|exists:people,id',
            'relationship_type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $connection = Connection::create($request->all());
        return response()->json($connection, Response::HTTP_CREATED);
    }

    public function show(Connection $connection)
    {
        return response()->json($connection, Response::HTTP_OK);
    }

    public function update(Request $request, Connection $connection)
    {
        $request->validate([
            'person_id' => 'required|exists:people,id',
            'related_person_id' => 'required|exists:people,id',
            'relationship_type' => 'required',
        ]);

        $connection->update($request->all());
        $connection->refresh();

        return response()->json($connection, Response::HTTP_OK);
    }

    public function destroy(Connection $connection)
    {
        $connection->delete();

        return response()->json(["msg" => "Data Deleted"], Response::HTTP_NO_CONTENT);
    }
}
