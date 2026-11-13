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
            $query->where(function($q) use ($search) {
                $q->where('nama_klien', 'like', "%{$search}%")
                  ->orWhere('no_ktp', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status_pencarian')) {
            $query->where('status_pencarian', $request->status_pencarian);
        }
        
        $requests = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.riwayat', compact('requests'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_pencarian' => 'required|in:pending,ditemukan,belum_ditemukan'
        ]);

        $cctvRequest = CctvRequest::findOrFail($id);
        $cctvRequest->update([
            'status_pencarian' => $request->status_pencarian
        ]);

        return back()->with('success', 'Status pencarian berhasil diperbarui.');
    }

    public function uploadDokumentasi(Request $request, $id)
    {
        $request->validate([
            'foto_dokumentasi' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $cctvRequest = CctvRequest::findOrFail($id);

        if ($cctvRequest->foto_dokumentasi) {
            Storage::disk('public')->delete($cctvRequest->foto_dokumentasi);
        }

        $path = $request->file('foto_dokumentasi')->store('dokumentasi', 'public');
        $cctvRequest->update(['foto_dokumentasi' => $path]);

        return back()->with('success', 'Dokumentasi hasil berhasil disimpan.');
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
