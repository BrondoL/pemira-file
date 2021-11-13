<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function store(Request $request)
    {
        $filename = $request->file("file")->getClientOriginalName();
        $folder = 'files/' . $request->folder;
        $request->file('file')->move($folder, $filename);
        return response()->json([
            'success' => true,
            'message' => "Berhasil menyimpan file!",
            'data' => $filename
        ], 201);
    }

    public function update(Request $request)
    {
        $oldName = $request->oldname;
        $filename = $request->file("file")->getClientOriginalName();
        $folder = 'files/' . $request->folder;
        $path = $folder . '/' . $oldName;
        if (file_exists($path)) {
            unlink($path);
        }
        $request->file('file')->move($folder, $filename);
        return response()->json([
            'success' => true,
            'message' => "Berhasil update file!",
            'data' => $filename
        ], 200);
    }

    public function destroy(Request $request)
    {
        $filename = $request->filename;
        $folder = 'files/' . $request->folder;
        $path = $folder . '/' . $filename;
        if (file_exists($path)) {
            unlink($path);
            return response()->json([
                'success' => true,
                'message' => "Berhasil menghapus file!",
                'data' => $filename
            ], 201);
        }
        return response()->json([
            'success' => true,
            'message' => "Gagal menghapus file!",
        ], 404);
    }
}
