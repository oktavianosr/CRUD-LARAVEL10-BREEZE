<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveTypes;
use App\Models\LeaveRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LeaveRequestExport;


class LeaveRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = LeaveRequest::when($request->search, function ($query,$search){
            $query->where('id','like', "%{$search}%");
        })
        ->with('user', 'leaveType');

        if (Auth::user()->role->name === 'Karyawan'){
            $query->where('user_id', Auth::id());
        }

        $leaveRequests = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('leave_requests.index', compact('leaveRequests'));
    }
    public function create()
    {
        $leaveTypes = LeaveTypes::all();
        return view('leave_requests.create', compact('leaveTypes'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'metadata' => 'nullable|array',
            'attachment' => 'nullable|file|mimes:pdf|max:500|min:100'
        ]);

        $path = null;

        if ($request->hasFile('attachment')){

            $path = $request->file('attachment')->store('attachments', 'public');
        };


        // if ($request->has('metadata')){
        //     $request->merge([
        //         'metadata' => json_encode($request->metadata)
        //     ]);
        // }

        LeaveRequest::create([
            'id' => Str::uuid(),
            'user_id' => Auth::id(),
            'leave_types_id' => $request->leave_type_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'metadata' => $request->metadata ? json_encode($request->metadata) : null,
            'attachment' => $path,
        ]);



        return redirect()->route('leave_requests.index')->with('success', 'Leave request submitted successfully.');
    }

    public function approve(LeaveRequest $leaveRequest)
    {
        $leaveRequest->update(['is_approved' => true ]);
        return back();
    }

    public function reject(LeaveRequest $leaveRequest)
    {
        $leaveRequest->update(['is_approved' => false ]);
        return back();
    }

}
