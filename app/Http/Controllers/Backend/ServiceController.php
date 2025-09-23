<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ServiceDataTable;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index(ServiceDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.service.index');
    }

    public function create()
    {
        $categories = ServiceCategory::with('translations')->get();
        return view('backend.pages.service.create', [
            'categories' => $categories,
            'service' => null
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'nullable|exists:service_categories,id',
            'status' => 'nullable|in:active,inactive',
            'title' => 'nullable|array',
            'title.*' => 'nullable|string|max:255',
            'description' => 'nullable|array',
            'description.*' => 'nullable|string',
        ]);

        $service = DB::transaction(function () use ($request) {
            $service = Service::create([
                'category_id' => $request->category_id,
                'status' => $request->status ?? 'active',
            ]);

            if ($request->title) {
                foreach ($request->title as $locale => $title) {
                    $service->translations()->create([
                        'locale' => $locale,
                        'title' => $title,
                        'description' => $request->description[$locale] ?? null,
                    ]);
                }
            }

            return $service;
        });

        return response()->json([
            'success' => true,
            'message' => 'Service successfully created.',
            'data' => $service
        ]);
    }

    public function edit($id)
    {
        $service = Service::with('translations')->findOrFail($id);
        $categories = ServiceCategory::with('translations')->get();

        return view('backend.pages.service.form', compact('service', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'nullable|exists:service_categories,id',
            'status' => 'nullable|in:active,inactive',
            'title' => 'nullable|array',
            'title.*' => 'nullable|string|max:255',
            'description' => 'nullable|array',
            'description.*' => 'nullable|string',
        ]);

        $service = Service::findOrFail($id);

        DB::transaction(function () use ($service, $request) {
            $service->update([
                'category_id' => $request->category_id,
                'status' => $request->status ?? $service->status,
            ]);

            if ($request->title) {
                foreach ($request->title as $locale => $title) {
                    $service->translations()->updateOrCreate(
                        ['locale' => $locale],
                        [
                            'title' => $title,
                            'description' => $request->description[$locale] ?? null,
                        ]
                    );
                }
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Service successfully updated.',
            'data' => $service
        ]);
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Service successfully deleted.'
        ]);
    }
}
