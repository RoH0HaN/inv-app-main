@props(['outlet'])
<section class="relative px-3 pt-3 pb-7 border border-gray-200 shadow-md rounded-lg">
    <button 
        class="absolute top-2.5 right-2.5 cursor-pointer" 
        aria-haspopup="dialog" aria-expanded="false" aria-controls="edit-outlet-dialog" data-hs-overlay="#edit-outlet-dialog"
        data-outlet='@json($outlet)'
    >
        <img src="/assets/settings/message-edit.svg" alt="" class="w-9 h-9" />
    </button>

    <div class="flex gap-5 items-center">
        <img src="{{ url($outlet->organization_logo) }}" alt="" class="border border-gray-400 rounded w-28 h-28 aspect-square object-cover object-center" />

        <div>
            <p>
                <span class="text-base font-bold">Name :</span>
                <span>{{ $outlet->organization_name }}</span>
            </p>
            <p>
                <span class="text-base font-bold">Mobile :</span>
                <span>{{ $outlet->mobile }}</span>
            </p>
            <p>
                <span class="text-base font-bold">Email :</span>
                <span>{{ $outlet->email }}</span>
            </p>
            <p>
                <span class="text-base font-bold">TAX No. :</span>
                <span>{{ $outlet->tax_number }}</span>
            </p>
        </div>
    </div>

    <p class="mt-5">{{ $outlet->address }}</p>
</section>

<script>
        document.addEventListener('DOMContentLoaded', function () {
            const editButtons = document.querySelectorAll('[data-hs-overlay="#edit-outlet-dialog"]');

            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const outlet = JSON.parse(this.getAttribute('data-outlet'));


                    const modal = document.getElementById('edit-outlet-dialog');

                    // Fill fields
                    modal.querySelector('[name="id"]').value = outlet.id || '';
                    modal.querySelector('[name="organization_name"]').value = outlet.organization_name || '';
                    modal.querySelector('[name="mobile"]').value = outlet.mobile || '';
                    modal.querySelector('[name="alternative_mobile"]').value = outlet.alternative_mobile || '';
                    modal.querySelector('[name="email"]').value = outlet.email || '';
                    modal.querySelector('[name="tax_number"]').value = outlet.tax_number || '';
                    modal.querySelector('[name="address"]').value = outlet.address || '';
                    modal.querySelector('[name="invoice_prefix_gst"]').value = outlet.invoice_prefix_gst || '';
                    modal.querySelector('[name="invoice_number_gst"]').value = outlet.invoice_number_gst || '';
                    modal.querySelector('[name="invoice_prefix_ngst"]').value = outlet.invoice_prefix_ngst || '';
                    modal.querySelector('[name="invoice_number_ngst"]').value = outlet.invoice_number_ngst || '';
                    modal.querySelector('[name="warehouse_id"]').value = outlet.warehouse_id;

                    // Set image preview if exists
                    const imagePreview = document.getElementById('outlet-image-preview');
                    const imagePlaceholder = document.getElementById('outlet-image-placeholder');
                    if (outlet.organization_logo) {
                        imagePreview.src = "{{ url('/') }}/"+ outlet.organization_logo;
                        imagePreview.classList.remove('hidden');
                        imagePlaceholder.classList.add('hidden');
                    } else {
                        imagePreview.classList.add('hidden');
                        imagePlaceholder.classList.remove('hidden');
                    }
                });
            });
        });
    </script>