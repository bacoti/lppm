<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImageContent;
use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::with('imageContents')->latest()->get();
        return view('admin.contents.index', compact('contents'));
    }

    public function create()
    {
        return view('admin.contents.create');
    }

    public function store(Request $request)
    {
        // Debug: Log incoming request
        \Log::info('Content store request received', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'data' => $request->all(),
            'files' => $request->hasFile('images') ? 'yes' : 'no'
        ]);

        try {
            $validated = $request->validate([
                'title' => 'required|max:255',
                'slug' => 'required|unique:contents,slug|max:255',
                'body' => 'required',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
            ]);

            \Log::info('Validation passed', $validated);

            // Create slug automatically if not provided
            if (empty($validated['slug'])) {
                $validated['slug'] = Str::slug($validated['title']);
            }

            $content = Content::create($validated);
            \Log::info('Content created', ['id' => $content->id]);

            // Handle multiple image uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('uploads/content-images', 'public');
                    ImageContent::create([
                        'content_id' => $content->id,
                        'image_url' => Storage::url($path),
                    ]);
                }
                \Log::info('Images processed');
            }

            \Log::info('Content store successful');
            return redirect()->route('admin.contents.index')
                ->with('success', 'Konten berhasil dibuat.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed', ['errors' => $e->errors()]);
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            \Log::error('Content store failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withError('Terjadi kesalahan saat menyimpan konten.')->withInput();
        }
    }

    public function show($id)
    {
        $content = Content::with('imageContents')->findOrFail($id);
        return view('admin.contents.show', compact('content'));
    }

    public function edit($id)
    {
        $content = Content::with('imageContents')->findOrFail($id);
        return view('admin.contents.edit', compact('content'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:contents,slug,' . $id,
            'body' => 'required',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $content = Content::findOrFail($id);
        $content->update($validated);

        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('uploads/content-images', 'public');
                ImageContent::create([
                    'content_id' => $content->id,
                    'image_url' => Storage::url($path),
                ]);
            }
        }

        return redirect()->route('admin.contents.index')
            ->with('success', 'Konten berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $content = Content::findOrFail($id);
        
        // Delete associated images
        foreach ($content->imageContents as $imageContent) {
            // Delete file from storage
            $imagePath = str_replace('/storage/', '', $imageContent->image_url);
            Storage::disk('public')->delete($imagePath);
            
            // Delete database record
            $imageContent->delete();
        }
        
        // Delete content
        $content->delete();

        return redirect()->route('admin.contents.index')
            ->with('success', 'Konten berhasil dihapus.');
    }

    public function deleteImage($id)
    {
        $imageContent = ImageContent::findOrFail($id);
        
        // Delete file from storage
        $imagePath = str_replace('/storage/', '', $imageContent->image_url);
        Storage::disk('public')->delete($imagePath);
        
        // Delete database record
        $imageContent->delete();

        return response()->json(['success' => true, 'message' => 'Gambar berhasil dihapus.']);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads/tinymce', 'public');
            return response()->json(['location' => Storage::url($path)]);
        }
        
        return response()->json(['error' => 'No file uploaded.'], 400);
    }
}
