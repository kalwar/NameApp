<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NameController extends Controller
{
    // Display the form and list of names
    public function index()
    {
        // Retrieve names from session, default to empty array if none
        $names = session('names', []);
        return view('name', ['names' => $names]);
    }

    // Handle form submission to add a new name
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:255',
        ]);

        // Get input data
        $name = $request->input('name');
        $color = $request->input('color');


        // Retrieve names from session or initialize empty array
        $names = session('names', []);

        // Add new name-color pair to the array
        $names[] = ['name' => $name, 'color' => $color];

        // Store updated names in session
        session(['names' => $names]);

        return redirect()->route('name.index')->with('success', 'Name added successfully.');
    }

    // Show edit form for a specific name
    public function edit($id)
    {
        $names = session('names', []);

        // Check if the ID exists
        if (!isset($names[$id])) {
            return redirect()->route('name.index')->with('error', 'Entry not found.');
        }

        return view('name', [
            'names' => $names,
            'edit_id' => $id,
            'edit_name' => $names[$id]['name'],
            'edit_color' => $names[$id]['color'],
        ]);
    }

    // Handle update submission
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:255',
        ]);

        $names = session('names', []);

        // Check if the ID exists
        if (!isset($names[$id])) {
            return redirect()->route('name.index')->with('error', 'Entry not found.');
        }

        // Update the entry
        $names[$id] = [
            'name' => $request->input('name'),
            'color' => $request->input('color'),
        ];

        // Store updated names in session
        session(['names' => $names]);

        return redirect()->route('name.index')->with('success', 'Entry updated successfully.');
    }

    // Delete a specific name
    public function destroy($id)
    {
        $names = session('names', []);

        // Check if the ID exists
        if (!isset($names[$id])) {
            return redirect()->route('name.index')->with('error', 'Entry not found.');
        }

        // Remove the entry
        unset($names[$id]);

        // Reindex array to avoid gaps
        $names = array_values($names);

        // Store updated names in session
        session(['names' => $names]);

        return redirect()->route('name.index')->with('success', 'Entry deleted successfully.');
    }
}