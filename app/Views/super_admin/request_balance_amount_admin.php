<div class="col-auto col-md-9">
<div class="container mt-5">

<a href="<?= base_url('admin/send_balance_request_super_admin'); ?>" class="btn btn-primary">Send Money Request Superadmin</a>  

     <h1>AdminBalance Request</h1>

           <table  class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Sr</th>
                    <th scope="col">Admin Name</th>                    
                    <th scope="col">Balance Request Amount</th>                  
                    <th scope="col">Approve Status</th>
                    <th scope="col">After Approve/Disapprove Amount Given</th>
                </tr>
            </thead>
            <tbody>
                <?php  $sr_no= 1; foreach ($request_list_admin as $admin): ?>
                <tr>
                    <th scope="row"><?= $sr_no ?></th>
                    <td><?php echo $admin->first_name." ".$admin->last_name ; ?></td>    
                    <td><?php if(!empty($admin->balance_request_amt)){echo $admin->balance_request_amt;} else{ echo $admin->balance_request_amt; } ?>
                        
                    </td> 
                    <td>
                        <?php if(empty($admin->superadmin_accept_status)){ ?> <label style="color:orange;">Pending</label> <?php }  elseif($admin->superadmin_accept_status==1){ ?> <label style="color:green;">Approve</label>  <?php } elseif($admin->superadmin_accept_status==2){?> <label style="color:red;">Disapprove</label>  <?php } ?>
                    </td>
                    <td><?= $admin->amout_given_balace_amt; ?></td>
                   
                </tr>    
                 <?php $sr_no++; endforeach; ?>            
            </tbody>
        </table>

 </div>
</div>               