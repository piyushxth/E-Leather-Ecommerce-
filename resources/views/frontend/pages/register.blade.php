<form action="{{ route('user.register.submit') }}" method="post" id="registerform" autocomplete="off">
   @csrf
   <div class="pt-3">
      <label for="name">Enter your Name</label>
      <input type="text" name="name" id="name" autocomplete="off" />
   </div>
   <div class="email pt-3">
      <label for="register_email">Enter your E-mail address</label>
      <input type="email" name="email" id="register_email" autocomplete="off" />
   </div>
   <div class="password pt-3">
      <label for="register_password">Enter your Password</label>
      <input type="password" name="password" id="register_password" autocomplete="off" />
   </div>
   <div class="confirmpassword pt-3">
      <label for="confirmpassword">Confirm your Password</label>
      <input type="password" name="confirmpassword" id="confirmpassword"
         autocomplete="off" />
   </div>
   <div class="terms-condition pt-3">
      <input type="checkbox" id="terms-condition" name="terms_condition"
         value="1">
      <label class="ms-2" for="terms-condition"> I agree with all the <a href="" target="_blank">Terms &
      Conditions</a></label>
      <span class="error-message pt-3 text-danger" id="terms_condition_error"></span>
   </div>
   <button type="submit" id="customer_register">Register</button>
</form>