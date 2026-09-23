<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CommissionController extends Controller
{
    public function index(Request $request)
    {
        $query = Commission::query();

        // 1. Plaka Filtresi (Boşluksuz ve büyük harf)
        if ($request->filled('plate_number')) {
            $plate = Str::upper(str_replace(' ', '', $request->plate_number));
            $query->where('plate_number', 'like', "%{$plate}%");
        }

        // 2. Tarih Aralığı Filtresi
        if ($request->filled('start_date')) {
            $query->whereDate('date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('date', '<=', $request->end_date);
        }

        // Tüm filtrelenmiş verilerin komisyon toplamı (Sayfalamadan bağımsız)
        // Gelir, Gider ve Net Toplam Hesaplama
        $totalIncome  = (clone $query)->where('commission_amount', '>', 0)->sum('commission_amount');
        $totalExpense = (clone $query)->where('commission_amount', '<', 0)->sum('commission_amount');
        $netTotal     = (clone $query)->sum('commission_amount');

        // Sayfalama (Her sayfada 25 veri) & URL parametrelerini koruma
        $commissions = $query->latest('date')
            ->paginate(25)
            ->withQueryString();

        return view('komisyon.index', compact('commissions', 'totalIncome', 'totalExpense', 'netTotal'));
    }

    public function create()
    {
        return view('komisyon.create');
    }

    public function store(Request $request)
    {
        // Plaka temizleme
        if ($request->filled('plate_number')) {
            $cleanedPlate = Str::upper(str_replace(' ', '', $request->plate_number));
            $request->merge(['plate_number' => $cleanedPlate]);
        }

        $validated = $request->validate([
            'date' => 'required|date',
            'plate_number' => 'required|string|max:20',
            'commission_amount' => 'required|integer',
        ]);

        Commission::create($validated);

        return redirect()->route('komisyon.index')->with('success', 'Komisyon kaydı başarıyla eklendi.');
    }

    public function destroy(Commission $commission)
    {
        $commission->delete();
        return redirect()->route('komisyon.index')->with('success', 'Komisyon kaydı silindi.');
    }
}
