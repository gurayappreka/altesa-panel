<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index($folderId = null)
    {
        $folders = Folder::where('parent_id', $folderId)->get();
        $files = File::where('folder_id', $folderId)->get();
        return view('files.index', compact('folders', 'files', 'folderId'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240',
            'folder_id' => 'nullable|exists:folders,id',
        ]);

        $uploadedFile = $request->file('file');
        $path = $uploadedFile->store('uploads', 'public');

        File::create([
            'name' => pathinfo($path, PATHINFO_FILENAME),
            'original_name' => $uploadedFile->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $uploadedFile->getMimeType(),
            'size' => $uploadedFile->getSize(),
            'folder_id' => $request->folder_id,
            'uploaded_by' => auth()->id(),
        ]);

        return back()->with('success', 'Dosya yüklendi.');
    }

    public function download(File $file)
    {
        return Storage::disk('public')->download($file->path, $file->original_name);
    }

    public function destroy(File $file)
    {
        Storage::disk('public')->delete($file->path);
        $file->delete();
        return back()->with('success', 'Dosya silindi.');
    }
}
