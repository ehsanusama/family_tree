<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Connection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FamilyTreeController extends Controller
{
    public function familyTree(Request $request, $personId)
    {
        $person = People::findOrFail($personId);

        // Retrieve family tree connections for the person
        $familyTree = $this->getFamilyTree($person);

        return response()->json(['family_tree' => $familyTree], Response::HTTP_OK);
    }

    private function getFamilyTree(People $person)
    {
        $familyTree = [];
        // Get all connections where the person is related
        $connections = Connection::where('related_person_id', $person->id)->get();
        foreach ($connections as $connection) {
            // Recursively retrieve family tree for each related person
            $relatedPerson = $connection->person;
            $relatedPersonData = [
                'id' => $relatedPerson->id,
                'name' => $relatedPerson->name,
                'last_name' => $relatedPerson->last_name,
                'dob' => $relatedPerson->dob,
                'relationship_type' => $connection->relationship_type,
                'children' => $this->getFamilyTree($relatedPerson),
            ];

            $familyTree[] = $relatedPersonData;
        }
        return $familyTree;
    }
}
