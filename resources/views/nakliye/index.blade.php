<x-app>
    <x-slot:title>Nakliye İşlemleri - MertNakliyat</x-slot:title>

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Nakliye İşlemleri</h1>
        <a href="{{ route('nakliye.create') }}"
           class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-slate-950 font-semibold px-4 py-2.5 rounded-lg transition-colors shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>Yeni Nakliye Ekle</span>
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filtreleme Kartı -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200 mb-6">
        <form action="{{ route('nakliye.index') }}" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-3">
                <!-- Plaka -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Plaka</label>
                    <input type="text" name="plate_number" value="{{ request('plate_number') }}" placeholder="33NCR80"
                           class="w-full px-3 py-1.5 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50">
                </div>

                <!-- Tedarikçi -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Tedarikçi</label>
                    <input type="text" name="supplier_name" value="{{ request('supplier_name') }}" placeholder="Firma adı"
                           class="w-full px-3 py-1.5 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50">
                </div>

                <!-- Dükkan Kodu -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Dükkan Kodu</label>
                    <input type="text" name="store_code" value="{{ request('store_code') }}" placeholder="Dükkan no"
                           class="w-full px-3 py-1.5 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50">
                </div>

                <!-- KDV Durumu -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">KDV Durumu</label>
                    <select name="has_vat" class="w-full px-3 py-1.5 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 bg-white">
                        <option value="">Tümü</option>
                        <option value="1" {{ request('has_vat') === '1' ? 'selected' : '' }}>KDV'li</option>
                        <option value="0" {{ request('has_vat') === '0' ? 'selected' : '' }}>KDV'siz</option>
                    </select>
                </div>

                <!-- Başlangıç Tarihi -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Başlangıç Tarihi</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                           class="w-full px-3 py-1.5 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50">
                </div>

                <!-- Bitiş Tarihi -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Bitiş Tarihi</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                           class="w-full px-3 py-1.5 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50">
                </div>
            </div>

            <!-- Filtre Butonları -->
            <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-100">
                @if(request()->anyFilled(['plate_number', 'supplier_name', 'store_code', 'has_vat', 'start_date', 'end_date']))
                    <a href="{{ route('nakliye.index') }}" class="px-4 py-2 text-xs font-semibold text-slate-600 hover:text-slate-800 transition-colors">
                        Filtreleri Temizle
                    </a>
                @endif
                <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white font-semibold px-5 py-2 rounded-lg text-xs transition-colors shadow-sm">
                    Filtrele
                </button>
            </div>
        </form>
    </div>

    <!-- Tablo Kapsayıcısı -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                    <th class="py-3.5 px-4">Tarih</th>
                    <th class="py-3.5 px-4">Plaka</th>
                    <th class="py-3.5 px-4">Tedarikçi</th>
                    <th class="py-3.5 px-4">Adet</th>
                    <th class="py-3.5 px-4">Navlun</th>
                    <th class="py-3.5 px-4">Dükkan Kodu</th>
                    <th class="py-3.5 px-4">KDV Durumu</th>
                    <th class="py-3.5 px-4 text-right">İşlem</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                @forelse($operations as $operation)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-3 px-4 font-medium">{{ $operation->date->format('d/m/Y') }}</td>
                        <td class="py-3 px-4 font-semibold text-slate-900">{{ $operation->plate_number }}</td>
                        <td class="py-3 px-4">{{ $operation->supplier_name }}</td>
                        <td class="py-3 px-4">{{ number_format($operation->quantity) }}</td>
                        <td class="py-3 px-4 font-medium text-slate-900">₺{{ number_format($operation->freight_price) }}</td>
                        <td class="py-3 px-4">{{ $operation->store_code }}</td>
                        <td class="py-3 px-4">
                            @if($operation->has_vat)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                    KDV'li
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600">
                                    KDV'siz
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-right">
    <div class="flex items-center justify-end gap-2">
        <!-- Düzenle İkonu -->
        <a href="{{ route('nakliye.edit', $operation) }}"
           class="p-1.5 text-slate-500 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors"
           title="Düzenle">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
        </a>

        <!-- Sil İkonu -->
        <form action="{{ route('nakliye.destroy', $operation) }}" method="POST" onsubmit="return confirm('Bu nakliye kaydını silmek istediğinize emin misiniz?');" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="p-1.5 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors"
                    title="Sil">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
            </button>
        </form>
    </div>
</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="py-8 text-center text-slate-400">Aranan kriterlere uygun nakliye kaydı bulunamadı.</td>
                    </tr>
                @endforelse
            </tbody>
            <!-- Tablo Altı Toplam Alanı -->
            @if($operations->count() > 0)
                <tfoot class="bg-slate-900 text-white font-semibold">
                    <tr>
                        <td colspan="4" class="py-3.5 px-4 text-right">
                            Filtrelenmiş Toplam Navlun (Tüm Sayfalar Dahil):
                        </td>
                        <td colspan="4" class="py-3.5 px-4 text-amber-400 text-base">
                            ₺{{ number_format($totalFreight) }}
                        </td>
                    </tr>
                </tfoot>
            @endif
        </table>

        <!-- Sayfalama (Pagination) Linkleri -->
        @if($operations->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $operations->links() }}
            </div>
        @endif
    </div>
</x-app>
