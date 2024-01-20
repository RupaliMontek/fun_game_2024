<div class="col-auto col-md-9">
<div class="container mt-5">
<?php if($player_count < $admin_users_details->limit_user){ ?>    
<a href="<?= base_url('admin/add_player'); ?>" class="btn btn-primary">Add Players</a>  
<?php } ?>
     <h1>Welcome To Admin Dashboard</h1>

           <table  class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Sr</th>
                    <th scope="col">Name</th>                    
                    <th scope="col">Amount Given</th>
                    <th scope="col">Current Wallet</th>
                    <th scope="col">Player Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php  $sr_no= 1; foreach ($players_list as $admin): ?>
                <tr>
                    <th scope="row"><?= $sr_no ?></th>
                    <td><?php echo $admin->first_name." ".$admin->last_name ; ?></td>                    
                    <td><?php if(!empty($admin->amout_given)){echo $admin->amout_given;} else{ echo "0"; } ?></td>
                    <td><?php if(!empty($admin->current_wallet)){echo $admin->current_wallet;} else{ echo $admin->amout_given; } ?></td>
                    <td>
                        <?php 

                        if($admin->status==1)
                            {?>
                             <button type="button" onclick="users_status_change('0','<?php echo $admin->id; ?>')" class="btn btn-danger">In-Active</button>

                            <?php }

                            elseif ($admin->status==0 || empty($admin->status)) 
                            { ?>
                                <button type="button" onclick="users_status_change('1','<?php echo $admin->id; ?>')" class="btn btn-success">Active</button>
                            <?php } ?></td>
                    <td>
                    <td>
                    <li class="list-inline-item">
                    
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        
                        <span class="d-none d-sm-inline mx-1"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="<?= base_url('admin/edit_player_details/'.$admin->id); ?>">Edit</a></li>
                        <!-- <li>
                            <hr class="dropdown-divider">
                        </li> -->
                        
                    </ul>
                
                </li>
                    </td>
                </tr>    
                 <?php $sr_no++; endforeach; ?>            
            </tbody>
        </table>

 </div>
</div>               