<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\SlackService;

class PeopleController extends Controller
{
    public function index()
    {
        $people = People::all();
        return response()->json($people, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'dob' => 'required|date',
        ]);

        $people = People::create($validatedData);
        if ($people) {
            // User registration successful
            $message = "User {$people->name} {$people->last_name} has been registered!";
            // Send message to Slack
            $slackService = new SlackService(env('SLACK_WEBHOOK_URL'));
            $slackService->sendMessage($message);
        }
        return response()->json($people, Response::HTTP_CREATED);
    }

    public function show(People $People)
    {
        return response()->json($People, Response::HTTP_OK);
    }

    public function update(Request $request, string $id)
    {
        $People = People::find($id);

        if (!$People) {
            // Handle the case where the record is not found
            return response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $updatedData = $request->only(['name', 'last_name', 'dob']);

        if ($People->update($updatedData)) {
            // Updated successfully
            $data = [
                "message" => "User Updated",
                "data" => $People
            ];
            return response()->json($data, Response::HTTP_OK);
        } else {
            // No changes were made
            return response()->json(['message' => 'No changes were made'], Response::HTTP_OK);
        }
    }


    public function destroy(People $People)
    {
        $People->delete();

        return response()->json(['message' => 'User Deleted'], 200);
    }
}
