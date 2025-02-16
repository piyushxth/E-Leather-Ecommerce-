<!-- Modal Example Start-->
<div class="modal fade" id="orderItemsModel" tabindex="-1" role="dialog" aria- labelledby="demoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <div class="modal-title"> <h5>Order Items Details</h5></div>
                <button type="button" class="btn-close orderItemsClose" data-bs-dismiss="modal" aria-label="Close">
                <i class="fas fa-times"></i>
                </button>
            </div>
            @if ($orderDetails->isNotEmpty())
            <div class="modal-body">
                <div class="order-items">
                    <table>
                        <tr>
                            <th>
                                <h6>S.N</h6>
                            </th>
                            <th>
                                <h6>Product Name</h6>
                            </th>
                            <th>
                                <h6>Product Image</h6>
                            </th>
                            <th>
                                <h6>Quantity</h6>
                            </th>
                            <th>
                                <h6>Size</h6>
                            </th>
                            <th>
                                <h6>Price</h6>
                            </th>
                        </tr>
                        @foreach ($orderDetails as $order_item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $order_item->product_name }}</td>
                            <td>
                                <figure>
                                    <img class="d-block w-100"
                                        src="{{ ($order_item->product_image != '') && file_exists(public_path('images/'.$order_item->product_image)) ? asset('images/'.$order_item->product_image) : asset('images/default.png') }}"
                                        alt="{{ $order_item->product_name }}">
                                </figure>
                            </td>
                            <td>{{ $order_item->quantity }}</td>
                            <td>{{ $order_item->size }}</td>
                            <td>{{ env('DEFAULT_CURRENCY_SYMBOL','Rs.') }}{{ (formatcurrency( $order_item->price,'NPR')) }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @else
            <div class="result-not-found">
                    <table>
                        <tr>
                        <th>
                     Result Not Found
                           </th>
                        </tr>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- Modal Example End-->
<script>
$('#orderItemsModel').on('click', function(e) {
    if (e.target.className == "modal fade show") {
        $("#orderItemsModel").hide();
        location.reload();
    }
});
$('.orderItemsClose').on("click", function() {
    $('#orderItemsModel').modal('hide');
    location.reload();
});
$(document).on('keydown', function(event) {
    if (event.key == "Escape") {
        $("#orderItemsModel").hide();
        location.reload();
    }
});
</script>
