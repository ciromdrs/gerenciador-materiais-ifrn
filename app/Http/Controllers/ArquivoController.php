<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArquivoController extends Controller
{
    public function destroy(Arquivo $arquivo, Request $request)
    {
        if ($arquivo) {
            try {
                Storage::delete($arquivo->path);
                $arquivo->delete();
                return back();
            } catch (\Throwable $th) {
                return back()->withErrors($th->getMessage());
            }
        }
    }
}
