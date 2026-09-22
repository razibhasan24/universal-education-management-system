<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\Institution;
use App\Models\Section;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $institutionFilter = $request->input('institution_id');
        $classFilter = $request->input('class_id');
        $statusFilter = $request->input('status');

        $sections = Section::query()
            ->with(['institution', 'schoolClass'])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('sections.name', 'like', "%{$search}%")
                        ->orWhereHas('schoolClass', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('institution', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->when($institutionFilter, function ($query, $institutionFilter) {
                $query->where('sections.institution_id', $institutionFilter);
            })
            ->when($classFilter, function ($query, $classFilter) {
                $query->where('sections.class_id', $classFilter);
            })
            ->when($statusFilter, function ($query, $statusFilter) {
                $query->where('sections.status', $statusFilter);
            })
            ->latest('sections.id')
            ->paginate(15)
            ->withQueryString();

        $institutions = Institution::active()->orderBy('name')->get();
        $classes = SchoolClass::active()->ordered()->get();

        return view('admin.sections.index', [
            'sections' => $sections,
            'institutions' => $institutions,
            'classes' => $classes,
            'search' => $search,
            'institutionFilter' => $institutionFilter,
            'classFilter' => $classFilter,
            'statusFilter' => $statusFilter,
            'breadcrumbs' => [
                ['label' => 'Sections'],
            ],
        ]);
    }

    public function create()
    {
        $institutions = Institution::active()->orderBy('name')->get();
        $classes = SchoolClass::active()->ordered()->get();

        return view('admin.sections.form', [
            'section' => new Section,
            'institutions' => $institutions,
            'classes' => $classes,
            'breadcrumbs' => [
                ['label' => 'Sections', 'url' => route('admin.sections.index')],
                ['label' => 'Add Section'],
            ],
        ]);
    }

    public function store(SectionRequest $request)
    {
        $data = $request->validated();
        Section::create($data);

        return redirect()->route('admin.sections.index')
            ->with('success', 'Section created successfully.');
    }

    public function show(Section $section)
    {
        $section->load(['institution', 'schoolClass']);

        return view('admin.sections.show', [
            'section' => $section,
            'breadcrumbs' => [
                ['label' => 'Sections', 'url' => route('admin.sections.index')],
                ['label' => $section->name],
            ],
        ]);
    }

    public function edit(Section $section)
    {
        $institutions = Institution::active()->orderBy('name')->get();
        $classes = SchoolClass::active()->ordered()->get();

        return view('admin.sections.form', [
            'section' => $section,
            'institutions' => $institutions,
            'classes' => $classes,
            'breadcrumbs' => [
                ['label' => 'Sections', 'url' => route('admin.sections.index')],
                ['label' => $section->name],
            ],
        ]);
    }

    public function update(SectionRequest $request, Section $section)
    {
        $data = $request->validated();
        $section->update($data);

        return redirect()->route('admin.sections.index')
            ->with('success', 'Section updated successfully.');
    }

    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->route('admin.sections.index')
            ->with('success', 'Section deleted successfully.');
    }
}
