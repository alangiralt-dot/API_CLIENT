@extends('layouts.app')

@section('confirm_order')
    @if($isCurrent && !empty($currentOrder))
        <div class="px-2 border-[#bed1dc]">
            <button type="button" 
                    onclick="confirmOrder()" 
                    class="bg-[#fffacd] hover:bg-[#fff27e] border border-[#bed1dc] px-4 py-2 rounded-xl text-xs text-black font-medium tracking-wider uppercase shadow-sm transition cursor-pointer">
                Confirmar Comanda
            </button>
        </div>
    @endif
@endsection

@section('tab_name', $isCurrent ? 'Comanda en curs' : 'Detall de la comanda')

@section('content')
<div class="space-y-6">

    <div id="systemAlert" class="hidden bg-red-50 border border-red-200 rounded-2xl p-4 flex items-start gap-3">
        <div class="text-red-500 mt-0.5">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
        <div>
            <h4 class="text-sm font-medium text-red-800">Avís del sistema</h4>
            <p id="systemAlertMessage" class="text-xs text-red-700 mt-1 font-normal"></p>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden p-6 space-y-4">
        
        <div class="grid grid-cols-12 gap-4 px-2 pb-2 text-[15px] font-semibold text-gray-500 uppercase tracking-wider border-b border-[#bed1dc]">
            <div class="col-span-6">Descripció</div>
            <div class="col-span-2 text-center">Quantitat</div>
            <div class="col-span-2">Preu</div>
            <div class="col-span-2 text-right">Subtotal</div>
        </div>

        <div id="orderLinesContainer" class="divide-y divide-[#bed1dc] !mt-0">
            @if(empty($currentOrder))
                <div class="py-12 text-center text-gray-400 font-normal">
                    No hi ha cap producte carregat en aquesta comanda.
                </div>
            @endif
        </div>

    </div>
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden py-6 px-8 space-y-4">

        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-4 space-y-2 text-[13px] font-normal">
                {{-- Tres files de traçabilitat inferiors alineades amb el bloc comptable --}}
                <div class="flex justify-between text-black">
                    <span class="font-semibold text-gray-500 uppercase tracking-wider">Codi</span>
                    <span id="orderCode" class="font-normal text-black tracking-wide">-</span>
                </div>
                <div class="flex justify-between text-black">
                    <span class="font-semibold text-gray-500 uppercase tracking-wider">Estat</span>
                    <span id="orderStatus" class="font-normal text-black">{{ empty($currentOrder) ? "En curs" : "-" }}</span>

                </div>
                <div class="flex justify-between text-black">
                    <span class="font-semibold text-gray-500 uppercase tracking-wider">Data</span>
                    <span id="orderDate" class="font-normal text-black tracking-wide">{{ empty($currentOrder) ? now()->format('d/m/Y H:i') : "-" }}</span>
                </div>
            </div>
            <div class="col-span-4 space-y-2 text-[13px] font-normal"></div>
            <div class="col-span-4 space-y-2 text-[13px] font-normal">
                <div class="flex justify-between text-black">
                    <span class="uppercase">Base Imposable</span>
                    <span class="font-bold text-black tracking-wide"><span id="orderTaxableBasis">{{ empty($currentOrder) ? number_format(0, 2, ',', '.') : "-" }}</span> €</span>
                </div>
                <div class="flex justify-between text-black">
                    <span>IVA (21%)</span>
                    <span class="font-bold text-black tracking-wide"><span id="orderTax">{{ empty($currentOrder) ? number_format(0, 2, ',', '.') : "-" }}</span> €</span>
                </div>
                <div class="flex justify-between text-black">
                    <span>TOTAL</span>
                    <span class="font-bold text-black tracking-wide"><span id="orderTotal">{{ empty($currentOrder) ? number_format(0, 2, ',', '.') : "-" }}</span> €</span>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    const currentOrder = @json($current_order);
</script>
@endsection
