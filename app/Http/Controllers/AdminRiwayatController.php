<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CctvRequest;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminRiwayatController extends Controller
{
    public function index(Request $request)
    {
        $query = CctvRequest::query();
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama_klien', 'like', "%{$search}%")
                  ->orWhere('no_ktp', 'like', "%{$search}%");
        }
        
        $requests = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.riwayat', compact('requests'));
    }
    
    public function downloadPdf($id)
    {
        $cctvRequest = CctvRequest::findOrFail($id);
        
        if ($cctvRequest->file_pdf && Storage::disk('public')->exists($cctvRequest->file_pdf)) {
            return Storage::disk('public')->download($cctvRequest->file_pdf);
        }
        
        // Generate on the fly if not found
        $pdfFileName = 'Form_Pengajuan_CCTV_' . str_replace(' ', '_', $cctvRequest->nama_klien) . '_' . $cctvRequest->id . '.pdf';
        $pdf = Pdf::loadView('cctv-request.pdf', ['data' => $cctvRequest]);
        
        $pdfPath = 'pdf/' . $pdfFileName;
        Storage::disk('public')->put($pdfPath, $pdf->output());
        $cctvRequest->update(['file_pdf' => $pdfPath]);
        
        return Storage::disk('public')->download($pdfPath);
    }
}
