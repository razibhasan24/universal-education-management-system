<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcademicSessionRequest;
use App\Models\AcademicSession;
use App\Models\Institution;
use Illuminate\Http\Request;

class AcademicSessionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $institutionFilter = $request->input('institution_id');
        $statusFilter = $request->input('status');

        $sessions = AcademicSession::query()
            ->with('institution')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('academic_sessions.name', 'like', "%{$search}%")
                        ->orWhereHas('institution', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->when($institutionFilter, function ($query, $institutionFilter) {
                $query->where('academic_sessions.institution_id', $institutionFilter);
            })
            ->when($statusFilter, function ($query, $statusFilter) {
                $query->where('academic_sessions.status', $statusFilter);
            })
            ->latest('academic_sessions.id')
            ->paginate(15)
            ->withQueryString();

        $institutions = Institution::active()->orderBy('name')->get();

        return view('admin.academic-sessions.index', [
            'sessions' => $sessions,
            'institutions' => $institutions,
            'search' => $search,
            'institutionFilter' => $institutionFilter,
            'statusFilter' => $statusFilter,
            'breadcrumbs' => [
                ['label' => 'Academic Sessions'],
            ],
        ]);
    }

    public function create()
    {
        $institutions = Institution::active()->orderBy('name')->get();

        return view('admin.academic-sessions.form', [
            'session' => new AcademicSession,
            'institutions' => $institutions,
            'breadcrumbs' => [
                ['label' => 'Academic Sessions', 'url' => route('admin.academic-sessions.index')],
                ['label' => 'Add Session'],
            ],
        ]);
    }

    public function store(AcademicSessionRequest $request)
    {
        $data = $request->validated();

        if ($data['status'] === AcademicSession::STATUS_ACTIVE) {
            AcademicSession::where('institution_id', $data['institution_id'])
                ->update(['status' => AcademicSession::STATUS_INACTIVE]);
        }

        AcademicSession::create($data);

        return redirect()->route('admin.academic-sessions.index')
            ->with('success', 'Academic session created successfully.');
    }

    public function show(AcademicSession $academicSession)
    {
        $academicSession->load('institution');

        return view('admin.academic-sessions.show', [
            'session' => $academicSession,
            'breadcrumbs' => [
                ['label' => 'Academic Sessions', 'url' => route('admin.academic-sessions.index')],
                ['label' => $academicSession->name],
            ],
        ]);
    }

    public function edit(AcademicSession $academicSession)
    {
        $institutions = Institution::active()->orderBy('name')->get();

        return view('admin.academic-sessions.form', [
            'session' => $academicSession,
            'institutions' => $institutions,
            'breadcrumbs' => [
                ['label' => 'Academic Sessions', 'url' => route('admin.academic-sessions.index')],
                ['label' => $academicSession->name],
            ],
        ]);
    }

    public function update(AcademicSessionRequest $request, AcademicSession $academicSession)
    {
        $data = $request->validated();

        if ($data['status'] === AcademicSession::STATUS_ACTIVE) {
            AcademicSession::where('institution_id', $data['institution_id'])
                ->where('id', '!=', $academicSession->id)
                ->update(['status' => AcademicSession::STATUS_INACTIVE]);
        }

        $academicSession->update($data);

        return redirect()->route('admin.academic-sessions.index')
            ->with('success', 'Academic session updated successfully.');
    }

    public function destroy(AcademicSession $academicSession)
    {
        $academicSession->delete();

        return redirect()->route('admin.academic-sessions.index')
            ->with('success', 'Academic session deleted successfully.');
    }

    public function setActive(AcademicSession $academicSession)
    {
        AcademicSession::where('institution_id', $academicSession->institution_id)
            ->where('id', '!=', $academicSession->id)
            ->update(['status' => AcademicSession::STATUS_INACTIVE]);

        $academicSession->update(['status' => AcademicSession::STATUS_ACTIVE]);

        return redirect()->back()
            ->with('success', 'Active session set successfully.');
    }
}
