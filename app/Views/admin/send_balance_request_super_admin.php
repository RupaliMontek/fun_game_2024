<div class="col-auto col-md-9">
<div class="container mt-5">

          <h2>Send Balance Request Super Admin</h2>
    <?php if(isset($errors)) echo implode('<br>', $errors); ?>
    <?php echo form_open('admin/view_notification_admin'); ?>
        <div class="mb-3">
        <label  class="form-label" for="new_username">Current Wallet Balance</label>
        <input autocomplete="off" class="form-control" type="text" name="first_name"id="first_name" value="<?=  $admin_users_details->current_wallet; ?>" readonly >
        </div>  
        <div class="mb-3">
        <label class="form-label"  for="new_username">Balance Request Amount</label>
        <input autocomplete="off"  class="form-control" type="text" name="balance_request_amt" id="balance_request_amt" placeholder="Enter Balance Request Amount"  required >
        </div> 
          
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>       


 </div>
</div>               