<x-app>
    <x-slot:title>Yeni Masraf Ekle - MertNakliyat</x-slot:title>

    <div class="max-w-xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Yeni Masraf Kaydı</h1>
            <a href="{{ route('komisyon.index') }}" class="text-sm font-medium text-slate-500 hover:text-slate-800">
                &larr; Geri Dön
            </a>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <form action="{{ route('komisyon.store') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Tarih -->
                <div>
                    <label for="date" class="block text-sm font-medium text-slate-700 mb-1">Tarih</label>
                    <input type="date" name="date" id="date"
                           value="{{ old('date', date('Y-m-d')) }}"
                           class="w-full px-3.5 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 text-sm" required>
                    @error('date') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                </div>

                <!-- Plaka -->
                <div>
                    <label for="plate_number" class="block text-sm font-medium text-slate-700 mb-1">Plaka</label>
                    <input type="text" name="plate_number" id="plate_number" placeholder="33NCR80"
                           value="{{ old('plate_number') }}"
                           class="w-full px-3.5 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 text-sm uppercase" required>
                    @error('plate_number') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                </div>

                <!-- Komisyon Tutarı -->
                <div>
                    <label for="commission_amount" class="block text-sm font-medium text-slate-700 mb-1">Masraf Tutarı (₺)</label>
                    <input type="number" name="commission_amount" id="commission_amount" placeholder="5500"
                           value="{{ old('commission_amount') }}"
                           class="w-full px-3.5 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 text-sm" required>
                    @error('commission_amount') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                </div>

                <!-- Kaydet Butonu -->
                <div class="pt-4 border-t border-slate-100 flex justify-end">
                    <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-slate-950 font-semibold px-6 py-2.5 rounded-lg transition-colors shadow-sm">
                        Kaydet
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app>
