<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CctvRequest;
use App\Http\Requests\StoreCctvRequestRequest;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CctvRequestController extends Controller
{
    public function create(Request $request)
    {
        // Jika admin masih login lalu membuka form pemohon, akhiri sesi admin
        // agar kembali ke panel admin harus login ulang.
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return view('cctv-request.create');
    }

    public function store(StoreCctvRequestRequest $request)
    {
        $validated = $request->validated();
        
        // Handle file upload
        if ($request->hasFile('foto_ktp')) {
            $path = $request->file('foto_ktp')->store('ktp', 'public');
            $validated['foto_ktp'] = $path;
        }
        
        $validated['tanggal_formulir'] = Carbon::now()->toDateString();
        
        $cctvRequest = CctvRequest::create($validated);
        
        // Generate PDF
        $pdfFileName = 'Form_Pengajuan_CCTV_' . str_replace(' ', '_', $cctvRequest->nama_klien) . '_' . $cctvRequest->id . '.pdf';
        
        $pdf = Pdf::loadView('cctv-request.pdf', ['data' => $cctvRequest]);
        
        // Save PDF to storage
        $pdfPath = 'pdf/' . $pdfFileName;
        Storage::disk('public')->put($pdfPath, $pdf->output());
        
        // Update record with pdf path
        $cctvRequest->update(['file_pdf' => $pdfPath]);
        
        return redirect()->route('cctv.create')->with([
            'success' => 'Pengajuan rekaman CCTV berhasil dikirim!',
            'download_url' => route('cctv.pdf', $cctvRequest->id),
            'client_name' => $cctvRequest->nama_klien,
        ]);
    }
    
    public function downloadPdf($id)
    {
        $cctvRequest = CctvRequest::findOrFail($id);
        
        if ($cctvRequest->file_pdf && Storage::disk('public')->exists($cctvRequest->file_pdf)) {
            return Storage::disk('public')->download($cctvRequest->file_pdf);
        }
        
        // Fallback if file doesn't exist
        $pdf = Pdf::loadView('cctv-request.pdf', ['data' => $cctvRequest]);
        return $pdf->download('Form_Pengajuan_CCTV_' . str_replace(' ', '_', $cctvRequest->nama_klien) . '.pdf');
    }
}
