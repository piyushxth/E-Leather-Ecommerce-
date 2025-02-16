<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>{{ env('APP_NAME') }} Order Email</title>
</head>
<body>
<div
   style="margin:0; padding:0; color:#333; font-style:normal; line-height:1.42857143; font-size:14px; font-family:'Open Sans','Helvetica Neue', Helvetica, Arial, sans-serif; font-weight:400; text-align:left; background-color:#f5f5f5">
   <table width="100%" style="border-collapse:collapse; margin:0px auto; width:70% ">
      <tbody>
         <tr>
            <td align="center" style=" vertical-align:top; padding-bottom:30px; width:100%">
               <table align="center" style="border-collapse:collapse; margin:0 auto; text-align:left; width:70%;">
                  <tbody>
                     <tr>
                        <td style=" vertical-align:top; background-color:#fff; padding:25px">
                           <table style="border-collapse:collapse">
                              <tbody>
                                 <!-- greatting  -->
                                 <tr>
                                    <td
                                       style="font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;vertical-align:top;padding-bottom:20px">
                                       <p style="margin-top:0; margin-bottom:10px">Namaste <span
                                          style="font-weight:600;">{{auth()->user()->name}}</span>
                                       </p>
                                       <p style="margin-top:0; margin-bottom:10px">
                                          Awesome! Your order <span
                                             style="font-weight:600;">{{ $data_array['order_number'] }}</span>, has been
                                          successfully delivered
                                          to you.
                                       </p>
                                       <p style="margin-top:0; margin-bottom:10px">
                                          We hope you like our service. Please call {{ $settings->phone_number }} or {{ $settings->mobile_number }} for
                                          complaints, exchanges or any assistance.
                                       </p>
                                       <p style="margin-top:0; margin-bottom:10px">
                                          Thank You.E-leather Nepal
                                       </p>
                                    </td>
                                 </tr>
                                 <!-- order id and placed date  -->
                                 <tr>
                                    <td style="vertical-align:top">
                                       <h1
                                          style="font-weight:500; font-size:25px; margin-top: 0px; margin-bottom: 10px; border-bottom: 1px solid gray; padding-bottom: 10PX;">
                                          Your Order: <span
                                             style="color:#991B1C; font-weight:bold">{{ $data_array['order_number'] }}</span>
                                       </h1>
                                       <!-- place time and date -->
                                       <p style="margin-top:0; margin-bottom:10px; font-style: italic;">
                                          Placed on <span> {{ \Carbon\Carbon::parse($data_array['date'])->format('F d, Y') }}</span>
                                       </p>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td style="vertical-align:top">
                                       <!-- billinga nd shipping table  -->
                                       <table style="border-collapse:collapse; width:100%">
                                          <tbody>
                                             <tr>
                                                <td
                                                   style="vertical-align:top; padding:10px 10px 10px 0; width:50%">
                                                   <h3
                                                      style="line-height:1.1; margin-bottom:10px; margin-top:0; font-size:14px; font-weight:bold">
                                                      Billing Info
                                                   </h3>
                                                   <div
                                                      style="margin-top:0; margin-bottom:10px;  line-height:23px;">
                                                      <p
                                                         style="margin-top:0; margin-bottom:2px; font-size:14px; line-height:23px;">
                                                         {{ auth()->user()->name }}
                                                      </p>
                                                      <p
                                                         style="margin-top:0; margin-bottom:2px; font-size:14px; line-height:23px;">
                                                         {{ auth()->user()->address }}
                                                      </p>
                                                      <p
                                                         style="margin-top:0; margin-bottom:2px; font-size:14px; line-height:23px;">
                                                         Tel: <a href="tel:{{auth()->user()->phone}}"
                                                            style="color:#006bb4;text-decoration:none"
                                                            target="_blank">{{auth()->user()->phone}}</a>
                                                      </p>
                                                      <p
                                                         style="margin-top:0; margin-bottom:2px; font-size:14px; line-height:23px;">
                                                         Area:{{ $data_array['provienceBilling'] }},{{ $data_array['districtBilling'] }},{{auth()->user()->address}}
                                                      </p>
                                                   </div>
                                                </td>
                                                <td
                                                   style="vertical-align:top; padding:10px 10px 10px 0; width:50%">
                                                   <h3
                                                      style="line-height:1.1; margin-bottom:10px; margin-top:0; font-size:14px; font-weight:bold">
                                                      Shipping Info
                                                   </h3>
                                                   <div
                                                      style="margin-top:0; margin-bottom:10px;  line-height:23px;">
                                                      <p
                                                         style="margin-top:0; margin-bottom:2px; font-size:14px; line-height:23px;">
                                                         {{ $data_array['first_name'] }}
                                                      </p>
                                                      <p
                                                         style="margin-top:0; margin-bottom:2px; font-size:14px; line-height:23px;">
                                                         {{ $data_array['location'] }}
                                                      </p>
                                                      <p
                                                         style="margin-top:0; margin-bottom:2px; font-size:14px; line-height:23px;">
                                                         Tel: <a href="tel: {{ $data_array['number'] }}"
                                                            style="color:#006bb4;text-decoration:none"
                                                            target="_blank"> {{ $data_array['number'] }}</a>
                                                      </p>
                                                      <p
                                                         style="margin-top:0; margin-bottom:2px; font-size:14px; line-height:23px;">
                                                         Area:{{ $data_array['provienceShipping'] }},{{ $data_array['districtShipping'] }},{{ $data_array['location'] }}
                                                      </p>
                                                   </div>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                       <!-- Payment and shipping method table  -->
                                       <table style="border-collapse:collapse; width:100%">
                                          <tbody>
                                             <tr>
                                                <td
                                                   style="vertical-align:top; padding:10px 10px 10px 0; width:50%">
                                                   <h3
                                                      style="line-height:1.1; margin-bottom:10px; margin-top:0; font-size:14px; font-weight:bold">
                                                      Payment Method
                                                   </h3>
                                                   <div
                                                      style="margin-top:0; margin-bottom:10px;  line-height:23px;">
                                                      <p
                                                         style="margin-top:0; font-size:14px; line-height:23px;">
                                                         Cash on Delivery
                                                      </p>
                                                   </div>
                                                </td>
                                                <td
                                                   style="vertical-align:top; padding:10px 10px 10px 0; width:50%; display: none;">
                                                   <h3
                                                      style="line-height:1.1; margin-bottom:10px; margin-top:0; font-size:14px; font-weight:bold">
                                                      Shipping Method
                                                   </h3>
                                                   <div
                                                      style="margin-top:0; margin-bottom:10px;  line-height:23px;">
                                                      <p
                                                         style="margin-top:0;  font-size:14px; line-height:23px;">
                                                         Delivery - Charges
                                                      </p>
                                                   </div>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                       <!-- product images  -->
                                       <table style="border-collapse:collapse;  width:50%">
                                          <tbody>
                                             @foreach ($cartItems as $cartItem )
                                             <tr>
                                                <td
                                                   style="vertical-align:top;  padding:25px; padding-left:0px; padding-bottom:0px">
                                                   <a href="#"
                                                      style="color:#006bb4; text-decoration:none"
                                                      target="_blank">
                                                   <img width="160"
                                                      src="{{ (($cartItem->options[1] != '') && file_exists(public_path().'/images/'.$cartItem->options[1])) ? asset('images/'.$cartItem->options[1]) : asset('images/default.png') }}"
                                                      alt="{{ $cartItem->name }}" border="0"
                                                      style="border:0;margin-bottom: 20px; height:auto; line-height:100%; outline:none;">
                                                   </a>
                                                </td>
                                                <td>
                                                   <div
                                                      style="margin-top:0; margin-bottom:10px;  line-height:23px;">
                                                      <p
                                                         style="margin-top:0; margin-bottom:2px; font-size:14px; line-height:23px;">
                                                         <span
                                                            style="white-space:nowrap; font-weight:bold;">
                                                         {{ $cartItem->name }}
                                                         </span>
                                                      </p>
                                                      <p
                                                         style="margin-top:0; margin-bottom:2px; font-size:14px; line-height:23px;">
                                                         <span
                                                            style="white-space:nowrap; font-weight:bold; ">
                                                         Quantity:{{ $cartItem->qty }}
                                                         </span>
                                                      </p>
                                                      <p
                                                         style="margin-top:0; margin-bottom:2px; font-size:14px; line-height:23px;">
                                                         <span
                                                            style="white-space:nowrap; font-weight:bold; color: #991B1C;">
                                                         Nrs.{{ $cartItem->price }}
                                                         </span>
                                                      </p>
                                                   </div>
                                                </td>
                                             </tr>
                                             @endforeach
                                          </tbody>
                                       </table>
                                       <!-- sumary-table  -->
                                       <table
                                          style="width:100%; border-collapse:collapse; border-spacing:0; margin-top: 20px; max-width:100%">
                                          <!-- table heading  -->
                                          <thead>
                                             <tr>
                                                <th
                                                   style="text-align:left; vertical-align:bottom; padding:10px">
                                                   Items
                                                </th>
                                                <th
                                                   style="text-align:left; vertical-align:bottom; padding:10px">
                                                   Qty
                                                </th>
                                                <th
                                                   style="text-align:right; vertical-align:bottom; padding:10px">
                                                   Price
                                                </th>
                                             </tr>
                                          </thead>
                                          <!-- table body  -->
                                          <tbody>
                                             @foreach ($cartItems as $cartItem)
                                             <tr>
                                                <td
                                                   style="vertical-align:top; padding:10px; border-top:1px solid #ccc">
                                                   <p
                                                      style="margin-top:0; font-weight:700; margin-bottom:10px">
                                                      {{ $cartItem->name }}
                                                </td>
                                                <td
                                                   style="vertical-align:top; padding:10px; border-top:1px solid #ccc; text-align:center">
                                                   {{ $cartItem->qty }}
                                                </td>
                                                <td
                                                   style="vertical-align:top; padding:10px; border-top:1px solid #ccc; text-align:right">
                                                   <span>Nrs.{{ $cartItem->price }}</span>
                                                </td>
                                             </tr>
                                             @endforeach
                                          </tbody>
                                          <!-- table Footer  -->
                                          <tfoot>
                                             <tr>
                                                <th colspan="2" scope="row"
                                                   style="vertical-align:top; background-color:#f5f5f5; font-weight:400; padding:10px; text-align:right">
                                                   Sub-total
                                                </th>
                                                <td
                                                   style="vertical-align:top; background-color:#f5f5f5; font-weight:400; padding:10px; text-align:right">
                                                   <span style="white-space:nowrap">Nrs.
                                                   {{ Cart::subtotalFloat() }}</span>
                                                </td>
                                             </tr>
                                             <tr>
                                                <th colspan="2" scope="row"
                                                   style="vertical-align:top; background-color:#f5f5f5; font-weight:400; padding:10px; text-align:right">
                                                   Shipping & Handling
                                                </th>
                                                <td
                                                   style="vertical-align:top; background-color:#f5f5f5; font-weight:400; padding:10px; text-align:right">
                                                   <span style="white-space:nowrap"> {{ $data_array['shipping_charge'] }}</span>
                                                </td>
                                             </tr>
                                             <tr>
                                                <th colspan="2" scope="row"
                                                   style="vertical-align:top; background-color:#f5f5f5; font-weight:400; padding:10px; text-align:right">
                                                   <span style="font-weight:bold;"> Grand Total </span>
                                                </th>
                                                <td
                                                   style="vertical-align:top; background-color:#f5f5f5; font-weight:400; padding:10px; text-align:right">
                                                   <span
                                                      style="white-space:nowrap; font-weight:bold;">Nrs.
                                                   {{ $data_array['total_amount'] }}
                                                   </span>
                                                </td>
                                             </tr>
                                          </tfoot>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                     <!-- footer content  -->
                     <tr>
                        <td
                           style="font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;vertical-align:top">
                           <table bgcolor="#F9F9F9" align="center" border="0" cellpadding="20" cellspacing="0"
                              width="100%" style="border-collapse:collapse; text-align:center; width:100%">
                              <tbody>
                                 <tr>
                                    <td style="vertical-align:top; padding-top:0px; padding-bottom:0px">
                                       <p
                                          style="margin-top:0; border-bottom:1px solid #e4e4e4; padding-bottom:25px;font-size:14px; padding-top:25px; margin-bottom:25px">
                                          For Support, Call us at <b
                                             style="font-weight:700; color:#991B1C">{{ $settings->phone_number }} or {{ $settings->mobile_number }}</b> or
                                          Email us at <b style="font-weight:700; "><a
                                             style="color:#991B1C" href="mailto:{{$settings->email}}"
                                             target="_blank">{{ $settings->email }}</a></b>
                                       </p>
                                    </td>
                                 </tr>
                                 <!-- social media links  -->
                                 <tr>
                                    <td style="vertical-align:top; padding-top:0px">
                                       <a href="{{ $settings->facebook_link }}"
                                          style="color:#006bb4; text-decoration:none; margin-right:15px"
                                          target="_blank"><img
                                          src="https://cdn-icons-png.flaticon.com/512/124/124010.png"
                                          width="25"
                                          style="border:0;height:auto; line-height:100%; outline:none; text-decoration:none"></a>
                                       <a href="{{ $settings->instagram_link }}"
                                          style="color:#006bb4; text-decoration:none; margin-right:15px"
                                          target="_blank"><img
                                          src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e7/Instagram_logo_2016.svg/2048px-Instagram_logo_2016.svg.png"
                                          width="25"
                                          style="border:0;height:auto; line-height:100%; outline:none; text-decoration:none"></a>
                                       <a href="{{ $settings->youtube_link }}"
                                          style="color:#006bb4; text-decoration:none; margin-right:15px"
                                          target="_blank"><img
                                          src="https://cdn-icons-png.flaticon.com/512/1384/1384060.png"
                                          width="25" 
                                          style="border:0;height:auto; line-height:100%; outline:none; text-decoration:none"></a>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </td>
         </tr>
      </tbody>
   </table>
</div>
</body>
</html>
