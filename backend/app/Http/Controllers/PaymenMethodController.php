<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentMethodController extends Controller
{
    /**
     * Dapatkan semua metode pembayaran untuk undangan tertentu
     */
    public function getByInvitation($invitationId)
    {
        $paymentMethods = PaymentMethod::where('invitation_id', $invitationId)
            ->active()
            ->get()
            ->map(function ($method) {
                return $method->getDisplayInfo();
            });

        return response()->json([
            'success' => true,
            'data' => $paymentMethods,
        ]);
    }

    /**
     * Simpan metode pembayaran baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invitation_id' => 'required|exists:invitations,id',
            'type' => 'required|in:bank,wallet,qris,crypto',
            'name' => 'nullable|string',
            'bank_code' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'account_number' => 'nullable|string',
            'account_holder' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'wallet_address' => 'nullable|string',
            'qris_url' => 'nullable|url',
            'display_text' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
            'metadata' => 'nullable|json',
        ]);

        $paymentMethod = PaymentMethod::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Metode pembayaran berhasil ditambahkan',
            'data' => $paymentMethod->getDisplayInfo(),
        ], Response::HTTP_CREATED);
    }

    /**
     * Update metode pembayaran
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $validated = $request->validate([
            'type' => 'sometimes|in:bank,wallet,qris,crypto',
            'name' => 'nullable|string',
            'bank_code' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'account_number' => 'nullable|string',
            'account_holder' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'wallet_address' => 'nullable|string',
            'qris_url' => 'nullable|url',
            'display_text' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
            'metadata' => 'nullable|json',
        ]);

        $paymentMethod->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Metode pembayaran berhasil diperbarui',
            'data' => $paymentMethod->getDisplayInfo(),
        ]);
    }

    /**
     * Hapus metode pembayaran
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();

        return response()->json([
            'success' => true,
            'message' => 'Metode pembayaran berhasil dihapus',
        ]);
    }

    /**
     * Toggle status active/inactive
     */
    public function toggleActive(PaymentMethod $paymentMethod)
    {
        $paymentMethod->update([
            'is_active' => !$paymentMethod->is_active,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status metode pembayaran berhasil diubah',
            'data' => $paymentMethod->getDisplayInfo(),
        ]);
    }

    /**
     * Update urutan tampilan metode pembayaran
     */
    public function updateOrder(Request $request)
    {
        $validated = $request->validate([
            'methods' => 'required|array',
            'methods.*.id' => 'required|exists:payment_methods,id',
            'methods.*.order' => 'required|integer',
        ]);

        foreach ($validated['methods'] as $method) {
            PaymentMethod::findOrFail($method['id'])->update([
                'order' => $method['order'],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Urutan metode pembayaran berhasil diperbarui',
        ]);
    }
}
