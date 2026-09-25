<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Models\Institution;
use App\Models\SchoolClass;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $institutionFilter = $request->input('institution_id');
        $classFilter = $request->input('class_id');
        $typeFilter = $request->input('subject_type');
        $statusFilter = $request->input('status');

        $subjects = Subject::query()
            ->with(['institution', 'schoolClass'])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('subjects.name', 'like', "%{$search}%")
                        ->orWhere('subjects.code', 'like', "%{$search}%")
                        ->orWhereHas('schoolClass', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->when($institutionFilter, function ($query, $institutionFilter) {
                $query->where('subjects.institution_id', $institutionFilter);
            })
            ->when($classFilter, function ($query, $classFilter) {
                $query->where('subjects.class_id', $classFilter);
            })
            ->when($typeFilter, function ($query, $typeFilter) {
                $query->where('subjects.subject_type', $typeFilter);
            })
            ->when($statusFilter, function ($query, $statusFilter) {
                $query->where('subjects.status', $statusFilter);
            })
            ->latest('subjects.id')
            ->paginate(15)
            ->withQueryString();

        $institutions = Institution::active()->orderBy('name')->get();
        $classes = SchoolClass::active()->ordered()->get();

        return view('admin.subjects.index', [
            'subjects' => $subjects,
            'institutions' => $institutions,
            'classes' => $classes,
            'search' => $search,
            'institutionFilter' => $institutionFilter,
            'classFilter' => $classFilter,
            'typeFilter' => $typeFilter,
            'statusFilter' => $statusFilter,
            'breadcrumbs' => [
                ['label' => 'Subjects'],
            ],
        ]);
    }

    public function create()
    {
        $institutions = Institution::active()->orderBy('name')->get();
        $classes = SchoolClass::active()->ordered()->get();

        return view('admin.subjects.form', [
            'subject' => new Subject,
            'institutions' => $institutions,
            'classes' => $classes,
            'breadcrumbs' => [
                ['label' => 'Subjects', 'url' => route('admin.subjects.index')],
                ['label' => 'Add Subject'],
            ],
        ]);
    }

    public function store(SubjectRequest $request)
    {
        $data = $request->validated();
        Subject::create($data);

        return redirect()->route('admin.subjects.index')
            ->with('success', 'Subject created successfully.');
    }

    public function show(Subject $subject)
    {
        $subject->load(['institution', 'schoolClass']);

        return view('admin.subjects.show', [
            'subject' => $subject,
            'breadcrumbs' => [
                ['label' => 'Subjects', 'url' => route('admin.subjects.index')],
                ['label' => $subject->name],
            ],
        ]);
    }

    public function edit(Subject $subject)
    {
        $institutions = Institution::active()->orderBy('name')->get();
        $classes = SchoolClass::active()->ordered()->get();

        return view('admin.subjects.form', [
            'subject' => $subject,
            'institutions' => $institutions,
            'classes' => $classes,
            'breadcrumbs' => [
                ['label' => 'Subjects', 'url' => route('admin.subjects.index')],
                ['label' => $subject->name],
            ],
        ]);
    }

    public function update(SubjectRequest $request, Subject $subject)
    {
        $data = $request->validated();
        $subject->update($data);

        return redirect()->route('admin.subjects.index')
            ->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('admin.subjects.index')
            ->with('success', 'Subject deleted successfully.');
    }
}
