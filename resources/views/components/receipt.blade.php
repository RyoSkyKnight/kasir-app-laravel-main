@props(['sellingId', 'cartItems', 'totalPrice', 'paidAmount', 'changeAmount'])

<div id="print-form" class="">
    <div id="receipt" class="w-64 mx-auto font-mono text-sm leading-tight">
        <!-- Header -->
        <div class="text-center mb-2">
            <div class="font-bold">RECEIPT</div>
            <div class="text-xs">{{ now()->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }}</div>
            <div class="text-xs">#{{ $sellingId }}</div>
        </div>

        <!-- Separator -->
        <div class="border-t border-dotted my-2"></div>

        <!-- Items -->
        <div class="space-y-1">
            @foreach ($cartItems as $item)
                <div class="flex justify-between text-xs">
                    <div>{{ $item['name'] }}</div>
                    <div class="flex-shrink-0 ml-2">
                        <span>{{ $item['quantity'] }}x</span>
                        <span class="ml-2">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Separator -->
        <div class="border-t border-dotted my-2"></div>

        <!-- Totals -->
        <div class="space-y-1">
            <div class="flex justify-between">
                <div>TOTAL</div>
                <div>Rp {{ number_format($totalPrice, 0, ',', '.') }}</div>
            </div>
            <div class="flex justify-between">
                <div>PAID</div>
                <div>Rp {{ number_format($paidAmount, 0, ',', '.') }}</div>
            </div>
            <div class="flex justify-between">
                <div>CHANGE</div>
                <div>Rp {{ number_format($changeAmount, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- Footer -->
        <div class="border-t border-dotted mt-2 pt-2 text-center text-xs">
            Thank you for your purchase!
        </div>
    </div>
</div>

<!-- CSS for Print Optimization -->
<style>
    @media screen {
        #print-form {
            display: none;
        }
    }

    @media print {
        /* Reset all other elements */
        body * {
            visibility: hidden;
            margin: 0;
            padding: 0;
        }
        
        /* Show only receipt */
        #print-form,
        #print-form * {
            visibility: visible;
        }
        
        /* Position receipt */
        #print-form {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            top: 0;
        }

        /* Remove background colors and shadows */
        #receipt {
            background: none !important;
            box-shadow: none !important;
        }

        /* Ensure black text for better printing */
        * {
            color: black !important;
        }
    }
</style>

<script>
    function printReceipt() {
        window.print();
    }
</script>
