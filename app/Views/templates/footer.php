<script src="<?= base_url('public/javascript/validation.js') ?>"></script>
<link rel="stylesheet" type="" href="<?= base_url('public/css/style.css') ?>">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<div id="balance_amount_extend_request_admin"></div>
<div id="superadmin_amount_extend_request_status_change"></div>
 </div>
</div> 
<div class="container-fluid g-0 forfooter">
        <div class="container footerInn">
            <footer class="footer">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Licensed by <a
                        href="javascript:void(0)">FUNTARGET</a>.</span>
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                    2023-2024. All rights reserved.</span>
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block txt-rgt">Developed &amp;
                    maintain by <a href="http://www.montekservices.com/" target="_blank">MONTEK TECH SERVICES PVT
                        LTD</a>.</span>
            </footer>
        </div>
    </div>


    <!-- Bootstrap JS (optional) -->
  
</body>

</html>

<script>
var base_url = '<?php echo base_url(); ?>';  

function users_status_change(status,user_id)
{
    $.ajax
    ({
    url: base_url+'login/users_status_change',      
    type: 'POST',
    data: {status:status,user_id:user_id},
    success:function(data)
    {
       location.reload();         
    }
    });
}

function check_list_admin_user_admin_request_superadmin()
{
    $.ajax
    ({
    url: base_url+'superadmin/check_list_admin_user_admin_request_superadmin',      
    type: 'GET',
    data: {},
    success:function(data)
    {
       $('#balance_amount_extend_request_admin').html(data);
       $('#admin_balance_amount_extend_request').modal('show');    
    }
    });
}


function superadmin_amount_change_request_status_change()
{
    $.ajax
    ({
    url: base_url+'admin/superadmin_amount_change_request_status_change',      
    type: 'GET',
    data: {},
    success:function(data)
    {
       $('#superadmin_amount_extend_request_status_change').html(data);
       $('#admin_balance_amount_extend_request').modal('show');    
    }
    });
}



$(document).ready(function () 
{ 
 check_list_admin_user_admin_request_superadmin();   
 setInterval(check_list_admin_user_admin_request_superadmin, 60000);  
 superadmin_amount_change_request_status_change();
 setInterval(superadmin_amount_change_request_status_change, 60000); 
 $("#player_account_add_form").validate(
    {
      errorElement: "span", 

      rules: 
      {
        first_name: 
        {
            required:true,               
        },
        limit_user_add: 
        {
          required:true,               
        },
        last_name: 
        {
            required:true,
        },
        amout_given: 
        {
            required:true,                
        },
        new_username: 
        {
            required:true,  
            remote: {
            url: base_url + "admin/check_player_username_exist",
            type: "POST",
            data: 
                {
                    email: function () 
                    {
                            return $("#new_username").val();
                    }
                }
            }             
        },
             
    },
      

    messages: 
    { 
        first_name: 
        {
                required:"Required First Name",
        },
            
        limit_user_add: 
        {
          required:"Required Email Address",
          
        },
        last_name: 
        {  
            required:"Required Last Name"
        },
        amout_given: 
        {  
            required:"Required Amout Given"
        },
        new_username: 
        {  
            required:"Required Username",
            remote:"This Player Name Is Already Exist Please Use Another.!",
        },            
           
    },
 });
});


</script>
