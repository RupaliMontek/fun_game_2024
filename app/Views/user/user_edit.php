<div class="col-auto col-md-9">
<div class="container mt-5">

          
    <?php if(isset($errors)) echo implode('<br>', $errors); ?>
    <?php echo form_open('admin/update_players_account_details/'.$player_details->id); ?>
        <div class="mb-3">
        <label  class="form-label" for="new_username">First Name:</label>
        <input autocomplete="off" class="form-control" type="text" name="first_name"id="first_name" value="<?= $player_details->first_name; ?>" required>
        </div>  
        <div class="mb-3">
        <label class="form-label"  for="new_username">Last Name:</label>
        <input autocomplete="off" class="form-control" type="text" name="last_name" id="last_name" value="<?= $player_details->last_name; ?>" required >
        </div> 
        <div class="mb-3">
         <label class="form-label"  for="new_username">Amout Given:</label>
        <input autocomplete="off" class="form-control" type="number" name="amout_given" id="amout_given" value="<?= $player_details->amout_given; ?>" required>
        </div>        
       <div class="mb-3">
        <label class="form-label"  for="new_username">Username:</label>
        <input autocomplete="off" class="form-control" type="text" name="new_username" id="new_username" required  value="<?= $player_details->username; ?>">
      </div> 
      <div class="mb-3">
        <label class="form-label"  for="new_password">Password:</label>

        <input  class="form-control" type="hidden" name="password" id="password" required value="<?= $player_details->password; ?>" >

         <input autocomplete="off" class="form-control" type="password" name="new_password" id="new_password"  >


        </div> 
        <button class="btn btn-primary" type="submit">Update</button>
    </form>       


 </div>
</div>               