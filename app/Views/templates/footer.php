<script src="<?= base_url('javascript/validation.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
 </div>
</div> 
<div class="container-fluid g-0 forfooter">
        <div class="container footerInn">
            <footer class="footer">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Licensed by <a
                        href="javascript:void(0)">LEO TECH EXIM SOLUTIONS LLP</a>.</span>
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
$(document).ready(function () {
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
          emailtest:true,
          remote: {
                url: base_url+"admin/check_player_user_add_limit",
                type: "post",
                data: {
                    email: function() {
                        return $("#limit_user_add").val();
                    },
                }
            }
        },
        last_name: 
            {
                required:true,
            },
            amout_given: 
            {
                required:true,
                digits:true,
                mininum:10,
                maximum:10,
            },
            new_username: 
            {
                required:true,                
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
          remote:"Player User Add Account Add Limit Reaced Please Contact Superadmin.!",
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
                required:"Required Username"
            },            
           
      },
    });
});


</script>
