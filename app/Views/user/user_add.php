<div class="col-auto col-md-9">
<div class="container mt-5">

          <h2>Create a New Player Account</h2>
    <?php if(isset($errors)) echo implode('<br>', $errors); ?>
    <?php  echo form_open('admin/create_players_account', array('id' => 'player_account_add_form')); ?>
        <div class="mb-3">
        <label  class="form-label" for="new_username">First Name:</label>
        <input autocomplete="off" class="form-control" type="text" name="first_name"id="first_name" required >
        <input autocomplete="off" class="form-control" type="hidden" value="<?= $limit_user_add?>" name="limit_user_add"id="limit_user_add" required >
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