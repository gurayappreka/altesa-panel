<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index(Request $request)
    {
        $folderId = $request->get('folder');
        
        $folders = Folder::where('parent_id', $folderId)->get();
        $files = File::where('folder_id', $folderId)->get();
        
        $currentFolder = $folderId ? Folder::find($folderId) : null;

        return view('files.index', compact('folders', 'files', 'currentFolder'));
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
            'name' => $uploadedFile->hashName(),
            'original_name' => $uploadedFile->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $uploadedFile->getMimeType(),
            'size' => $uploadedFile->getSize(),
            'folder_id' => $request->folder_id,
            'uploaded_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Dosya başarıyla yüklendi.');
    }
}
