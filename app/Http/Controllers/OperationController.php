<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OperationController extends Controller
{
    public function index(Request $request)
    {
        // Temel sorgumuzu oluşturalım
        $query = Operation::query();

        // 1. Plaka Filtresi (Boşluksuz ve büyük harfe çevirerek ara)
        if ($request->filled('plate_number')) {
            $plate = Str::upper(str_replace(' ', '', $request->plate_number));
            $query->where('plate_number', 'like', "%{$plate}%");
        }

        // 2. Tedarikçi Firma Filtresi
        if ($request->filled('supplier_name')) {
            $supplier = Str::lower($request->supplier_name);
            $query->where('supplier_name', 'like', "%{$supplier}%");
        }

        // 3. Dükkan Kodu Filtresi
        if ($request->filled('store_code')) {
            $query->where('store_code', 'like', "%{$request->store_code}%");
        }

        // 4. KDV Durumu Filtresi
        if ($request->has('has_vat') && $request->has_vat !== null && $request->has_vat !== '') {
            $query->where('has_vat', $request->has_vat);
        }

        // 5. Tarih Aralığı Filtresi (Başlangıç ve Bitiş)
        if ($request->filled('start_date')) {
            $query->whereDate('date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('date', '<=', $request->end_date);
        }

        // Sayfalamadan ÖNCE filtrelenmiş tüm kayıtların navlun toplamını alıyoruz
        $totalFreight = (clone $query)->sum('freight_price');

        // Sayfalama (Her sayfada 25 veri) & URL parametrelerini koruma (appends)
        $operations = $query->latest('date')
            ->paginate(25)
            ->withQueryString();

        return view('nakliye.index', compact('operations', 'totalFreight'));
    }

    public function create()
    {
        return view('nakliye.create');
    }

    public function store(Request $request)
    {
        if ($request->filled('plate_number')) {
            $cleanedPlate = Str::upper(str_replace(' ', '', $request->plate_number));
            $request->merge(['plate_number' => $cleanedPlate]);
        }

        if ($request->filled('supplier_name')) {
            $request->merge(['supplier_name' => Str::lower($request->supplier_name)]);
        }

        $validated = $request->validate([
            'date' => 'required|date',
            'plate_number' => 'required|string|max:20',
            'supplier_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'freight_price' => 'required|integer|min:0',
            'store_code' => 'required|string|max:50',
            'has_vat' => 'required|boolean',
        ]);

        Operation::create($validated);

        return redirect()->route('nakliye.index')->with('success', 'Nakliye kaydı başarıyla eklendi.');
    }
    public function edit(Operation $operation)
    {
        return view('nakliye.edit', compact('operation'));
    }

    public function update(Request $request, Operation $operation)
    {
        if ($request->filled('plate_number')) {
            $cleanedPlate = Str::upper(str_replace(' ', '', $request->plate_number));
            $request->merge(['plate_number' => $cleanedPlate]);
        }

        if ($request->filled('supplier_name')) {
            $cleanedSupplier = Str::lower(trim($request->supplier_name));
            $request->merge(['supplier_name' => $cleanedSupplier]);
        }

        $validated = $request->validate([
            'date' => 'required|date',
            'plate_number' => 'required|string|max:20',
            'supplier_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'freight_price' => 'required|integer|min:0',
            'store_code' => 'required|string|max:50',
            'has_vat' => 'required|boolean',
        ]);

        $operation->update($validated);

        return redirect()->route('nakliye.index')->with('success', 'Nakliye kaydı başarıyla güncellendi.');
    }

    public function destroy(Operation $operation)
    {
        $operation->delete();
        return redirect()->route('nakliye.index')->with('success', 'Nakliye kaydı silindi.');
    }
}
