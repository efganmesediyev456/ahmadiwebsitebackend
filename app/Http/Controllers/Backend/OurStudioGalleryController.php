<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\OurStudioGallery;
use App\DataTables\OurStudioGalleryDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OurStudioGalleryController extends Controller
{
    public function index(OurStudioGalleryDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.our_studio_galleries.index');
    }

    public function create()
    {
        return view('backend.pages.our_studio_galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        try {
            DB::beginTransaction();

            $data = $request->except('_token', '_method');

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('our_studio_galleries', 'public');
            }

            OurStudioGallery::create($data);

            DB::commit();
            return redirect()->route('admin.our_studio_galleries.index')
                ->with('success', 'Şəkil uğurla əlavə edildi');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(OurStudioGallery $ourStudioGallery)
    {
        return view('backend.pages.our_studio_galleries.edit', compact('ourStudioGallery'));
    }

    public function update(Request $request, OurStudioGallery $ourStudioGallery)
    {
        $request->validate([
            'image' => 'nullable|image',
        ]);

        try {
            DB::beginTransaction();

            $data = $request->except('_token', '_method');

            if ($request->hasFile('image')) {
                if ($ourStudioGallery->image && Storage::disk('public')->exists($ourStudioGallery->image)) {
                    Storage::disk('public')->delete($ourStudioGallery->image);
                }
                $data['image'] = $request->file('image')->store('our_studio_galleries', 'public');
            }

            $ourStudioGallery->update($data);

            DB::commit();
            return redirect()->route('admin.our_studio_galleries.index')
                ->with('success', 'Şəkil uğurla yeniləndi');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(OurStudioGallery $ourStudioGallery)
    {
        try {
            DB::beginTransaction();

            if ($ourStudioGallery->image && Storage::disk('public')->exists($ourStudioGallery->image)) {
                Storage::disk('public')->delete($ourStudioGallery->image);
            }

            $ourStudioGallery->delete();

            DB::commit();
            return redirect()->route('admin.our_studio_galleries.index')
                ->with('success', 'Şəkil silindi');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
