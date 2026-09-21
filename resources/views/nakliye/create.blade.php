<x-app>
    <x-slot:title>Yeni Nakliye Ekle - MertNakliyat</x-slot:title>

    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Yeni Nakliye Kaydı</h1>
            <a href="{{ route('nakliye.index') }}" class="text-sm font-medium text-slate-500 hover:text-slate-800">
                &larr; Geri Dön
            </a>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <form action="{{ route('nakliye.store') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Tarih -->
                <div>
                    <label for="date" class="block text-sm font-medium text-slate-700 mb-1">Tarih</label>
                    <input type="date" name="date" id="date"
                           value="{{ old('date', date('Y-m-d')) }}"
                           class="w-full px-3.5 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 text-sm" required>
                    @error('date') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Plaka -->
                    <div>
                        <label for="plate_number" class="block text-sm font-medium text-slate-700 mb-1">Plaka</label>
                        <input type="text" name="plate_number" id="plate_number" placeholder="33NCR80"
                               value="{{ old('plate_number') }}"
                               class="w-full px-3.5 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 text-sm uppercase" required>
                        @error('plate_number') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Tedarikçi -->
                    <div>
                        <label for="supplier_name" class="block text-sm font-medium text-slate-700 mb-1">Tedarikçi Firma</label>
                        <input type="text" name="supplier_name" id="supplier_name" placeholder="firma adı"
                               value="{{ old('supplier_name') }}"
                               class="w-full px-3.5 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 text-sm" required>
                        @error('supplier_name') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <!-- Adet -->
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-slate-700 mb-1">Adet</label>
                        <input type="number" name="quantity" id="quantity" placeholder="10"
                               value="{{ old('quantity') }}"
                               class="w-full px-3.5 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 text-sm" required>
                        @error('quantity') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Navlun -->
                    <div>
                        <label for="freight_price" class="block text-sm font-medium text-slate-700 mb-1">Navlun Ücreti (₺)</label>
                        <input type="number" name="freight_price" id="freight_price" placeholder="5000"
                               value="{{ old('freight_price') }}"
                               class="w-full px-3.5 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 text-sm" required>
                        @error('freight_price') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
        <label for="location" class="block text-sm font-medium text-slate-700 mb-1">Konum</label>
        <select name="location" id="location"
                class="w-full px-3.5 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 text-sm" required>
            <option value="" disabled {{ old('location') ? '' : 'selected' }}>Seçiniz</option>
            <option value="BAYRAMPAŞA" {{ old('location') == 'BAYRAMPAŞA' ? 'selected' : '' }}>BAYRAMPAŞA</option>
            <option value="KADIKÖY" {{ old('location') == 'KADIKÖY' ? 'selected' : '' }}>KADIKÖY</option>
            <option value="GEBZE" {{ old('location') == 'GEBZE' ? 'selected' : '' }}>GEBZE</option>
            <option value="İZMİT" {{ old('location') == 'İZMİT' ? 'selected' : '' }}>İZMİT</option>
            <option value="ADAPAZARI" {{ old('location') == 'ADAPAZARI' ? 'selected' : '' }}>ADAPAZARI</option>
            <option value="ANKARA" {{ old('location') == 'ANKARA' ? 'selected' : '' }}>ANKARA</option>
        </select>
        @error('location') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
    </div>

                    <!-- Dükkan Kodu -->
                    <div>
                        <label for="store_code" class="block text-sm font-medium text-slate-700 mb-1">Dükkan Kodu / No</label>
                        <input type="text" name="store_code" id="store_code" placeholder="12"
                               value="{{ old('store_code') }}"
                               class="w-full px-3.5 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 text-sm" required>
                        @error('store_code') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                    </div>
                </div>


                <!-- KDV Seçimi (Radio / Tab Stilinde) -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">KDV Durumu</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="flex items-center justify-center gap-2 p-3 border border-slate-200 rounded-lg cursor-pointer hover:bg-slate-50 has-[:checked]:bg-amber-50 has-[:checked]:border-amber-500 has-[:checked]:text-amber-900 transition-all">
                            <input type="radio" name="has_vat" value="0" class="text-amber-600 focus:ring-amber-500" {{ old('has_vat', '0') == '0' ? 'checked' : '' }}>
                            <span class="text-sm font-medium">KDV Hariç (KDV'siz)</span>
                        </label>

                        <label class="flex items-center justify-center gap-2 p-3 border border-slate-200 rounded-lg cursor-pointer hover:bg-slate-50 has-[:checked]:bg-amber-50 has-[:checked]:border-amber-500 has-[:checked]:text-amber-900 transition-all">
                            <input type="radio" name="has_vat" value="1" class="text-amber-600 focus:ring-amber-500" {{ old('has_vat') == '1' ? 'checked' : '' }}>
                            <span class="text-sm font-medium">KDV Dahil (KDV'li)</span>
                        </label>
                    </div>
                    @error('has_vat') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
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
