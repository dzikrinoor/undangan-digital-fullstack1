<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rsvp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RsvpController extends Controller
{
    /**
     * Mengambil semua data ucapan untuk ditampilkan di Guest Book
     */
    public function index()
    {
        try {
            // Mengambil data terbaru (paling baru mengisi ada di atas)
            $data = Rsvp::orderBy('created_at', 'desc')->get();
            return response()->json($data, 200);
        } catch (\Exception $e) {
            Log::error('RSVP Fetch Error: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal mengambil data ucapan'], 500);
        }
    }

    /**
     * Menyimpan data kiriman dari form RSVP
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'kehadiran' => 'required|in:hadir,tidak_hadir',
                'ucapan' => 'nullable|string',
            ]);

            $rsvp = Rsvp::create($validated);

            return response()->json([
                'message' => 'Data berhasil disimpan!', 
                'data' => $rsvp
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
            
        } catch (\Exception $e) {
            Log::error('RSVP Store Error: ' . $e->getMessage());

            return response()->json([
                'message' => 'Terjadi kesalahan pada server.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}