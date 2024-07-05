<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function index()
    {
        session(['title' => 'Annual Reports']);
        $reports = Report::get();

        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        session(['title' => 'Create Report']);

        $report = new Report();

        return view('reports.create', compact('report'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'desc' => 'required',
            'year' => 'required',

        ]);

        try {
            if ($validator->fails()) {
                $message = $validator->errors()->all();

                // Check if the request is an AJAX request
                if ($request->ajax()) {
                    return response()->json($message, 400);
                } else {
                    // Redirect back with an error message
                    return redirect()->route('index.opportunties')->with('error', $message);
                }
            } else {
                // Get the authenticated user
                $user = auth()->user();

                $report = new Report();
                $report->title = $request->title;
                $report->desc = $request->desc;
                $report->year = $request->year;


                if ($request->hasFile('image')) {
                    $imageFile = $request->file('image');
                    $imageExt = $imageFile->getClientOriginalExtension();
                    $imageName = time().'_'.$imageExt;
                    $imagePath = $imageFile->storeAs('reports/image', $imageName, 'public');
                    $report->image = $imagePath;
                }


              if ($request->hasFile('report')) {
                    $documentFile = $request->file('report');
                    $documentExt = $documentFile->getClientOriginalExtension(); // Get the file extension
                    $documentName = time().'_'.$documentExt; // Generate a unique name for the document file
                    $documentPath = $documentFile->storeAs('reports/report', $documentName, 'public'); // Store the document file
                    $report->report = $documentPath; // Save the document file path to the database or model
                }


                $report->save();

                if ($request->ajax()) {
                    // Return JSON response with reports information
                    return response()->json([
                        'message' => 'Report has been created successfully',
                        'report' => $report,
                    ], 200);
                } else {
                    // Redirect back with a success message
                    return redirect()->route('index.reports')->with('success', 'Report has been created successfully');
                }
            }
        } catch (Exception $e) {
            // Handle exceptions as needed...

            // Check if the request is an AJAX request
            if ($request->ajax()) {
                return response()->json(['error' => 'An error occurred.'], 500);
            } else {
                // Redirect back with an error message
                return redirect()->route('index.reports')->with('error', 'An error occurred.');
            }
        }
    }

    public function edit($id)
    {
        session(['title' => 'Edit Report']);

        $report = Report::find($id);

        return view('reports.edit', compact('report'));
    }

    public function getReports()
    {
        $reports = Report::get();

        return response()->json($reports);
    }

    public function search(Request $request)
    {
        $builder = Report::query()->with('report_name');
        $builder->where('report_name', '%'.$request->input('query').'%');

        return response()->json($builder->get());
    }

    public function getReport($id)
    {
        // Get a single category
        $report = Report::find($id);

        return response()->json($report);
    }

    public function show($category_id)
    {
        $report = Report::find($category_id);

        return view('reports.show', compact('report'));

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'year' => 'required',

        ]);

        $report = Report::find($id);
        $report->title = is_null($request->title) ? $report->title : $request->title;
        $report->year = is_null($request->year) ? $report->year : $request->year;
        $report->desc = is_null($request->desc) ? $report->desc : $request->desc;

             if ($request->hasFile('image')) {
                    $imageFile = $request->file('image');
                    $imageExt = $imageFile->getClientOriginalExtension();
                    $imageName = time().'_'.$imageExt;
                    $imagePath = $imageFile->storeAs('reports/image', $imageName, 'public');
                    $report->image = $imagePath;
                }

                if ($request->hasFile('report')) {
                    $documentFile = $request->file('report');
                    $documentExt = $documentFile->getClientOriginalExtension(); // Get the file extension
                    $documentName = time().'_'.$documentExt; // Generate a unique name for the document file
                    $documentPath = $documentFile->storeAs('reports/report', $documentName, 'public'); // Store the document file
                    $report->report = $documentPath; // Save the document file path to the database or model
                }

                        
                $report->save();

        return redirect()->route('index.reports')
            ->with('success', 'Report Has Been updated successfully');
    }

    public function destroy(report $report)
    {
        $report->delete();

        return redirect()->route('reports.index')
            ->with('success', 'Report has been deleted successfully');
    }

    public function confirmDelete($id)
    {
        session(['title' => 'Confirm Delete of Report']);
        $report = Report::find($id);

        return view('reports.confirm_delete', compact('report'));
    }

    public function deleteReport(Request $request)
    {
        $report = Report::find($request->id);

        if ($report) {
            $report->delete();

            return redirect()->route('reports.index')->with('success', 'Report has been deleted successfully');
        } else {
            return redirect()->route('reports.index')->with('error', 'Report not found');
        }

    }
}
