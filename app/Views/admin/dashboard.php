<div class="col-auto col-md-9">
<div class="container mt-5">
<a href="<?= base_url('admin/add_player'); ?>" class="btn btn-primary">Add Players</a>  
     <h1>Welcome To Admin Dashboard</h1>

           <table  class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Sr</th>
                    <th scope="col">Name</th>                    
                    <th scope="col">Amount Given</th>
                    <th scope="col">Current Wallet</th>
                    <th>Action</th>
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