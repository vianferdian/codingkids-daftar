<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRegistrationRequest;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the participants.
     */
    public function index(Request $request): View
    {
        $query = Registration::query();

        // Search by keyword (name, school, parent name, phone, address)
        if ($search = trim((string) $request->input('search'))) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('school', 'like', "%{$search}%")
                    ->orWhere('parent_name', 'like', "%{$search}%")
                    ->orWhere('parent_phone', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($category = $request->input('category')) {
            if (in_array(strtolower($category), ['sd', 'smp'])) {
                $query->where('category', strtolower($category));
            }
        }

        // Filter by school
        if ($school = trim((string) $request->input('school'))) {
            $query->where('school', $school);
        }

        // Filter by date
        if ($date = $request->input('date')) {
            $query->whereDate('registered_at', $date);
        }

        // Sorting
        $allowedSorts = ['registered_at', 'full_name', 'category', 'school', 'birth_date'];
        $sort = in_array($request->input('sort'), $allowedSorts) ? $request->input('sort') : 'registered_at';
        $direction = strtolower((string) $request->input('direction')) === 'asc' ? 'asc' : 'desc';

        $query->orderBy($sort, $direction)->orderBy('id', $direction);

        $registrations = $query->paginate(10)->withQueryString();

        // List schools for filter dropdown
        $schools = Registration::select('school')
            ->distinct()
            ->orderBy('school')
            ->pluck('school');

        return view('admin.registrations.index', compact(
            'registrations',
            'schools',
            'sort',
            'direction'
        ));
    }

    /**
     * Display the specified participant detail.
     */
    public function show(int $id): View
    {
        $registration = Registration::findOrFail($id);

        return view('admin.registrations.show', compact('registration'));
    }

    /**
     * Show the form for editing the participant.
     */
    public function edit(int $id): View
    {
        $registration = Registration::findOrFail($id);

        return view('admin.registrations.edit', compact('registration'));
    }

    /**
     * Update the participant in storage.
     */
    public function update(UpdateRegistrationRequest $request, int $id): RedirectResponse
    {
        $registration = Registration::findOrFail($id);
        $validated = $request->validated();

        $registration->update([
            'full_name' => trim($validated['full_name']),
            'birth_date' => $validated['birth_date'],
            'category' => $validated['category'],
            'school' => trim($validated['school']),
            'parent_name' => trim($validated['parent_name']),
            'parent_phone' => trim($validated['parent_phone']),
            'address' => trim($validated['address']),
        ]);

        return redirect()
            ->route('admin.peserta.show', $registration->id)
            ->with('success', 'Data peserta ' . $registration->full_name . ' berhasil diperbarui.');
    }

    /**
     * Remove the specified participant from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $registration = Registration::findOrFail($id);
        $name = $registration->full_name;

        $registration->delete();

        return redirect()
            ->route('admin.peserta.index')
            ->with('success', "Data peserta {$name} berhasil dihapus.");
    }
}
