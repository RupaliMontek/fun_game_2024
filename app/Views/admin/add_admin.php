<div class="col-auto col-md-9">
<div class="container mt-5">

          <h2>Create a New Admin Account</h2>
    <?php if(isset($errors)) echo implode('<br>', $errors); ?>
    <?php echo form_open('superadmin/create_account_from_dashboard'); ?>
        <div class="mb-3">
        <label  class="form-label" for="new_username">First Name:</label>
        <input autocomplete="off" class="form-control" type="text" name="first_name"id="first_name" required >
        </div>  
        <div class="mb-3">
        <label class="form-label"  for="new_username">Last Name:</label>
        <input autocomplete="off" class="form-control" type="text" name="last_name" id="last_name" required >
        </div> 
        <div class="mb-3">
         <label class="form-label"  for="new_username">Amout Given:</label>
        <input autocomplete="off" class="form-control" type="number" name="amout_given" id="amout_given" required >
        </div> 
      <div class="mb-3">
        <label class="form-label"  for="new_username">User Account Create Limit:</label>
        <input autocomplete="off" class="form-control" type="number" name="limit_user_create" id="limit_user_create" required >
       </div>  
       <div class="mb-3">
        <label class="form-label"  for="new_username">Username:</label>
        <input autocomplete="off" class="form-control" type="text" name="new_username" required >
      </div> 
      <div class="mb-3">
        <label class="form-label"  for="new_password">Password:</label>
        <input autocomplete="off" class="form-control" type="password" name="new_password" required >
        </div> 
        <button class="btn btn-primary" type="submit">Create Account</button>
    </form>       


 </div>
</div>               