<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PublicRegistrationController extends Controller
{
    /**
     * Display Landing Page.
     */
    public function index(): View
    {
        $totalSd = Registration::where('category', 'sd')->count();
        $totalSmp = Registration::where('category', 'smp')->count();
        $totalPeserta = $totalSd + $totalSmp;

        return view('public.landing', compact('totalSd', 'totalSmp', 'totalPeserta'));
    }

    /**
     * Show registration form for selected category.
     */
    public function create(string $category): View
    {
        $category = strtolower($category);
        if (!in_array($category, ['sd', 'smp'])) {
            abort(404, 'Kategori tidak ditemukan.');
        }

        return view('public.register', [
            'category' => $category,
            'categoryLabel' => strtoupper($category),
        ]);
    }

    /**
     * Store a newly created registration.
     */
    public function store(StoreRegistrationRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $registration = DB::transaction(function () use ($validated) {
            return Registration::create([
                'full_name' => trim($validated['full_name']),
                'birth_date' => $validated['birth_date'],
                'category' => $validated['category'],
                'school' => trim($validated['school']),
                'parent_name' => trim($validated['parent_name']),
                'parent_phone' => trim($validated['parent_phone']),
                'address' => trim($validated['address']),
                'registered_at' => now(),
            ]);
        });

        return redirect()
            ->route('public.success', ['id' => $registration->id])
            ->with('success', 'Selamat! Pendaftaran atas nama ' . $registration->full_name . ' telah berhasil disimpan.');
    }

    /**
     * Display success page after registration.
     */
    public function success(int $id): View
    {
        $registration = Registration::findOrFail($id);

        return view('public.success', compact('registration'));
    }

    /**
     * Print registration slip / proof of registration.
     */
    public function printSlip(int $id): View
    {
        $registration = Registration::findOrFail($id);

        return view('public.print-slip', compact('registration'));
    }
}
