<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SocialLinksDataTable;
use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use App\Models\SocialLinkTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SocialLinkController extends Controller
{
    public function index(SocialLinksDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.social-link.index');
    }

    public function create()
    {
        return view('backend.pages.social-link.create', [
            'socialLink' => null,
            'translations' => []
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'url' => 'nullable|url',
            'status' => 'nullable|in:active,inactive',
            'order' => 'nullable|integer|min:0',
            'translations.*.title' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($validated, $request) {
            $imagePath = null;

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('social-links', 'public');
            }

            $socialLink = SocialLink::create([
                'image' => $imagePath,
                'url' => $validated['url'] ?? null,
                'status' => $validated['status'] ?? 'active',
                'order' => $validated['order'] ?? 0,
            ]);

            if ($request->has('translations')) {
                foreach ($request->translations as $locale => $translation) {
                    if (!empty($translation['title'])) {
                        SocialLinkTranslation::create([
                            'social_link_id' => $socialLink->id,
                            'locale' => $locale,
                            'title' => $translation['title'],
                        ]);
                    }
                }
            }
        });



    }

    public function edit(SocialLink $socialLink)
    {
        // Laravel route model binding istifadə olunur
        $languages = collect(config('app.languages'))->map(function($lang) {
            return (object) $lang; // array-dirsə object-ə çeviririk
        });

        $translations = $socialLink->translations->keyBy('locale');

        return view('backend.pages.social-link.edit', [
            'socialLink' => $socialLink,
            'languages' => $languages,
            'translations' => $translations,
        ]);
    }


    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'url' => 'nullable|url',
            'status' => 'nullable|in:active,inactive',
            'order' => 'nullable|integer|min:0',
            'translations.*.title' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($validated, $request, $id) {
            $socialLink = SocialLink::findOrFail($id);

            if ($request->hasFile('image')) {
                if ($socialLink->image && Storage::disk('public')->exists($socialLink->image)) {
                    Storage::disk('public')->delete($socialLink->image);
                }
                $socialLink->image = $request->file('image')->store('social-links', 'public');
            }

            $socialLink->update([
                'image' => $socialLink->image,
                'url' => $validated['url'] ?? null,
                'status' => $validated['status'] ?? 'active',
                'order' => $validated['order'] ?? 0,
            ]);

            // Köhnə translations silinir və yeniləri əlavə olunur
            $socialLink->translations()->delete();

            if ($request->has('translations')) {
                foreach ($request->translations as $locale => $translation) {
                    if (!empty($translation['title'])) {
                        SocialLinkTranslation::create([
                            'social_link_id' => $socialLink->id,
                            'locale' => $locale,
                            'title' => $translation['title'],
                        ]);
                    }
                }
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Sosial link uğurla yeniləndi.',
            'redirect' => route('admin.social-link.index'),
            'data' => $socialLink ?? null
        ]);

    }

    public function destroy(SocialLink $socialLink)
    {
        try {
            if ($socialLink->image && Storage::disk('public')->exists($socialLink->image)) {
                Storage::disk('public')->delete($socialLink->image);
            }

            $socialLink->delete();

            return response()->json([
                'success' => true,
                'message' => 'Sosial link silindi.',
                'redirect' => route('admin.social-link.index'), // lazım olsa front-end üçün redirect URL
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta baş verdi: ' . $e->getMessage(),
            ], 500);
        }
    }

}
