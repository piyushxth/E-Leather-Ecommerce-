<div class="side-nav">
   <ul>
      <li class="{{ (request()->routeis('customer.dashboard')) ? 'active' : '' }}" ><a href="{{ route('customer.dashboard') }}">Dashboard</a></li>
      <li class="{{ (request()->routeis('customer.account_detail')) ? 'active' : '' }}" ><a href="{{ route('customer.account_detail') }}">Account Information</a></li>
      <li class="{{ (request()->routeis('customer.cart.index')) ? 'active' : '' }}" ><a href="{{ route('customer.cart.index') }}">Cart</a></li>
      <li class="{{ request()->routeis('customer.wishlist.index') ? 'active' : '' }}" ><a href="{{ route('customer.wishlist.index') }}">Wishlist</a></li>
      <li class="{{ request()->routeis('customer.order.index') ? 'active' : '' }}" ><a href="{{ route('customer.order.index') }}">Order</a></li>
      <li class="{{ request()->routeis('customer.review.index') ? 'active' : '' }}" ><a href="{{ route('customer.review.index') }}">Reviews</a></li>
      <li class="{{ request()->routeis('customer.show_password_reset_form') ? 'active' : '' }}" ><a href="{{ route('customer.show_password_reset_form') }}">Change Password</a></li>
      <li>
         <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Logout</a>
         <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                  <div class="modal-body">
                     <p>Are you sure you want to Logout?</p>
                  </div>
                  <div class="modal-footer mt-3">
                     <button class="cancel-button" data-bs-dismiss="modal">Cancel</button>
                     <a href="{{ route('customer.logout') }}">
                     <button class="logout-button">
                     Logout
                     </button>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </li>
   </ul>
</div>
<div class="my-bio mt-4">
   <div class="title company-profile">
      <span class="text-center">Welcome {{ auth()->user()->name }}</span>
   </div>
   <table>
      <tr>
         <th>Name</th>
         <td>{{ auth()->user()->name }}</td>
      </tr>
      <tr>
         <th>E-mail</th>
         <td>{{ auth()->user()->email }}</td>
      </tr>
      <tr>
         <th>Contact Number</th>
         <td> {{ auth()->user()->phone }}</td>
      </tr>
      <tr>
         <th>Address</th>
         <td>{{ auth()->user()->address }}</td>
      </tr>
   </table>
</div>
