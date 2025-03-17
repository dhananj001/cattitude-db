<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;



class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $records = Record::all(); // Fetch all records
        $records = Record::with('user')->get(); // Fetch all records with user

        $query = Record::query()->with('user'); // Include user relationship

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'LIKE', "%{$search}%")
                    ->orWhere('last_name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('city', 'LIKE', "%{$search}%")
                    ->orWhere('state', 'LIKE', "%{$search}%")
                    ->orWhere('zip', 'LIKE', "%{$search}%")
                    ->orWhere('reason', 'LIKE', "%{$search}%")
                    ->orWhere('comment', 'LIKE', "%{$search}%");
            });
        }

        $records = $query->latest()->paginate(10); // Use pagination


        return view('records.index', compact('records')); // Pass records to view
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('records.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address1' => 'required',
            'email' => 'required|email|unique:records',
            'reason' => 'required',
            'phone' => 'required',
            'charged' => 'required|boolean',
            'reason' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
        ]);

        Record::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'phone' => $request->phone,
            'email' => $request->email,
            'reason' => $request->reason,
            'charged' => $request->charged,
            'comment' => $request->comment,
            'added_by' => Auth::id(),
        ]);

        return redirect()->route('records.index')->with('success', 'Record added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Record $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Record $record)
    {
        return view('records.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Record $record)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:records,email,' . $record->id,
            'phone' => 'required',
            'charged' => 'required|boolean',
            'reason' => 'required',
        ]);

        $record->update($request->all());

        return redirect()->route('records.index')->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!Gate::allows('delete-record')) {
            throw ValidationException::withMessages([
                'error' => "🚫 Oops! You don't have permission to delete this record."
            ]);
        }

        $record = Record::findOrFail($id);
        $record->delete();

        return redirect()->route('records.index')->with('success', 'Record deleted successfully.');
    }
}
