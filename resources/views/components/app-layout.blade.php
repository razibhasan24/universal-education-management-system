@props(['title' => null, 'breadcrumbs' => null])

@include('layouts.app', [
    'title' => $title ?? ($title ?? 'Dashboard'),
    'breadcrumbs' => $breadcrumbs ?? [],
    'slot' => $slot
])
