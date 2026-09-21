<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstitutionRequest;
use App\Models\Institution;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $institutions = Institution::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%")
                        ->orWhere('eiin', 'like', "%{$search}%");
                });
            })
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view('admin.institutions.index', [
            'institutions' => $institutions,
            'search' => $search,
            'breadcrumbs' => [
                ['label' => 'Institutions'],
            ],
        ]);
    }

    public function create()
    {
        return view('admin.institutions.form', [
            'institution' => new Institution,
            'breadcrumbs' => [
                ['label' => 'Institutions', 'url' => route('admin.institutions.index')],
                ['label' => 'Add Institution'],
            ],
        ]);
    }

    public function store(InstitutionRequest $request): RedirectResponse
    {
        $data = $this->prepareData($request->validated(), $request);

        Institution::create($data);

        return redirect()->route('admin.institutions.index')
            ->with('success', 'Institution created successfully.');
    }

    public function show(Institution $institution)
    {
        return view('admin.institutions.show', [
            'institution' => $institution,
            'breadcrumbs' => [
                ['label' => 'Institutions', 'url' => route('admin.institutions.index')],
                ['label' => $institution->name],
            ],
        ]);
    }

    public function edit(Institution $institution)
    {
        return view('admin.institutions.form', [
            'institution' => $institution,
            'breadcrumbs' => [
                ['label' => 'Institutions', 'url' => route('admin.institutions.index')],
                ['label' => $institution->name],
            ],
        ]);
    }

    public function update(InstitutionRequest $request, Institution $institution): RedirectResponse
    {
        $data = $this->prepareData($request->validated(), $request);

        $institution->update($data);

        return redirect()->route('admin.institutions.index')
            ->with('success', 'Institution updated successfully.');
    }

    public function destroy(Institution $institution): RedirectResponse
    {
        $institution->delete();

        return redirect()->route('admin.institutions.index')
            ->with('success', 'Institution deleted successfully.');
    }

    protected function prepareData(array $data, Request $request): array
    {
        unset($data['logo']);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('institutions', 'public');
        }

        return $data;
    }
}
