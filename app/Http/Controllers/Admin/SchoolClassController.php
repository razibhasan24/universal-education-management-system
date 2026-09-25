<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRequest;
use App\Models\AcademicSession;
use App\Models\Institution;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $institutionFilter = $request->input('institution_id');
        $sessionFilter = $request->input('academic_session_id');
        $statusFilter = $request->input('status');

        $classes = SchoolClass::query()
            ->with(['institution', 'academicSession'])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('school_classes.name', 'like', "%{$search}%")
                        ->orWhere('school_classes.code', 'like', "%{$search}%")
                        ->orWhereHas('institution', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->when($institutionFilter, function ($query, $institutionFilter) {
                $query->where('school_classes.institution_id', $institutionFilter);
            })
            ->when($sessionFilter, function ($query, $sessionFilter) {
                $query->where('school_classes.academic_session_id', $sessionFilter);
            })
            ->when($statusFilter, function ($query, $statusFilter) {
                $query->where('school_classes.status', $statusFilter);
            })
            ->ordered()
            ->latest('school_classes.id')
            ->paginate(15)
            ->withQueryString();

        $institutions = Institution::active()->orderBy('name')->get();
        $sessions = AcademicSession::active()->orderBy('name')->get();

        return view('admin.school-classes.index', [
            'classes' => $classes,
            'institutions' => $institutions,
            'sessions' => $sessions,
            'search' => $search,
            'institutionFilter' => $institutionFilter,
            'sessionFilter' => $sessionFilter,
            'statusFilter' => $statusFilter,
            'breadcrumbs' => [
                ['label' => 'Classes'],
            ],
        ]);
    }

    public function create()
    {
        $institutions = Institution::active()->orderBy('name')->get();
        $sessions = AcademicSession::active()->orderBy('name')->get();

        return view('admin.school-classes.form', [
            'class' => new SchoolClass,
            'institutions' => $institutions,
            'sessions' => $sessions,
            'breadcrumbs' => [
                ['label' => 'Classes', 'url' => route('admin.school-classes.index')],
                ['label' => 'Add Class'],
            ],
        ]);
    }

    public function store(ClassRequest $request)
    {
        $data = $request->validated();
        SchoolClass::create($data);

        return redirect()->route('admin.school-classes.index')
            ->with('success', 'Class created successfully.');
    }

    public function show(SchoolClass $schoolClass)
    {
        $schoolClass->load(['institution', 'academicSession']);

        return view('admin.school-classes.show', [
            'class' => $schoolClass,
            'breadcrumbs' => [
                ['label' => 'Classes', 'url' => route('admin.school-classes.index')],
                ['label' => $schoolClass->name],
            ],
        ]);
    }

    public function edit(SchoolClass $schoolClass)
    {
        $institutions = Institution::active()->orderBy('name')->get();
        $sessions = AcademicSession::active()->orderBy('name')->get();

        return view('admin.school-classes.form', [
            'class' => $schoolClass,
            'institutions' => $institutions,
            'sessions' => $sessions,
            'breadcrumbs' => [
                ['label' => 'Classes', 'url' => route('admin.school-classes.index')],
                ['label' => $schoolClass->name],
            ],
        ]);
    }

    public function update(ClassRequest $request, SchoolClass $schoolClass)
    {
        $data = $request->validated();
        $schoolClass->update($data);

        return redirect()->route('admin.school-classes.index')
            ->with('success', 'Class updated successfully.');
    }

    public function destroy(SchoolClass $schoolClass)
    {
        $schoolClass->delete();

        return redirect()->route('admin.school-classes.index')
            ->with('success', 'Class deleted successfully.');
    }
}
