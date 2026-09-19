<x-app>
    <x-slot:title>Komisyon İşlemleri - MertNakliyat</x-slot:title>

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Komisyon İşlemleri</h1>
        <a href="{{ route('komisyon.create') }}"
           class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-slate-950 font-semibold px-4 py-2.5 rounded-lg transition-colors shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>Yeni Komisyon Ekle</span>
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filtreleme Kartı -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200 mb-6">
        <form action="{{ route('komisyon.index') }}" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <!-- Plaka -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Plaka</label>
                    <input type="text" name="plate_number" value="{{ request('plate_number') }}" placeholder="33NCR80"
                           class="w-full px-3 py-1.5 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50">
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
                @if(request()->anyFilled(['plate_number', 'start_date', 'end_date']))
                    <a href="{{ route('komisyon.index') }}" class="px-4 py-2 text-xs font-semibold text-slate-600 hover:text-slate-800 transition-colors">
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
                    <th class="py-3.5 px-4">Komisyon Tutar</th>
                    <th class="py-3.5 px-4 text-right">İşlem</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                @forelse($commissions as $commission)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-3 px-4 font-medium">{{ $commission->date->format('d/m/Y') }}</td>
                        <td class="py-3 px-4 font-semibold text-slate-900">{{ $commission->plate_number }}</td>
                        <td class="py-3 px-4 font-medium text-emerald-600">₺{{ number_format($commission->commission_amount) }}</td>
                        <td class="py-3 px-4 text-right">
                            <form action="{{ route('komisyon.destroy', $commission) }}" method="POST" onsubmit="return confirm('Bu komisyon kaydını silmek istediğinize emin misiniz?');" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-800 font-medium text-xs">Sil</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-8 text-center text-slate-400">Aranan kriterlere uygun komisyon kaydı bulunamadı.</td>
                    </tr>
                @endforelse
            </tbody>
            <!-- Tablo Altı Toplam Alanı -->
            @if($commissions->count() > 0)
                <tfoot class="bg-slate-900 text-white font-semibold">
                    <tr>
                        <td colspan="2" class="py-3.5 px-4 text-right">
                            Filtrelenmiş Toplam Komisyon (Tüm Sayfalar Dahil):
                        </td>
                        <td colspan="2" class="py-3.5 px-4 text-amber-400 text-base">
                            ₺{{ number_format($totalCommission) }}
                        </td>
                    </tr>
                </tfoot>
            @endif
        </table>

        <!-- Sayfalama (Pagination) Linkleri -->
        @if($commissions->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $commissions->links() }}
            </div>
        @endif
    </div>
</x-app>
