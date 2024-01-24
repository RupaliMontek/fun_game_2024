<style>
    .btn-align-superadmin-dashboard
{
   align-items: right;
   align-content: right;
}
</style> 
<div class="col-auto col-md-9">
        <div class="container mt-5">  
           <div id="counter"></div>
           <div id="verifiBtn"></div>
        <h2>Dashboard Super Admin</h2>
        <h3>Last Ten Result - 1,5,0,0,8,6,3,2,4</h3>
        <h4>Next Result 8</h4>    
        <div class="btn-align-superadmin-dashboard">
        <button id="high" class="btn btn-primary">High</button>
        <button id="low" class="btn btn-primary">Low</button>.
        <button id="mediam"  class="btn btn-primary">Mediam</button>
        <button id="2x_jackpot" class="btn btn-primary">2x Jackpot</button>

        </div>
        <table  class="table table-striped">
            <thead>
                 <tr>
                    <td></td>
                    <td>590</td>
                    <td>225</td>
                    <td>150</td>
                    <td>645</td>
                    <td>510</td>
                    <td>360</td>
                    <td>190</td>
                    <td>240</td>
                    <td>310</td>
                    <td>170</td>
                </tr>    
                <tr>
                    <th scope="col"></th>
                    <th scope="col">1</th>
                    <th scope="col">2</th>
                    <th scope="col">3</th>
                    <th scope="col">4</th>
                    <th scope="col">5</th>
                    <th scope="col">6</th>
                    <th scope="col">7</th>
                    <th scope="col">8</th>
                    <th scope="col">9</th>
                    <th scope="col">0</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($players_list as $row): ?>
                <tr>
                    <td><?php echo $row->first_name." ".$row->last_name ; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> 
            <?php  endforeach; ?> 
                 
            </tbody>
        </table>
    </div>
    </div>

 <script>
    $(document).ready(function () {

        function countdown() {
            function tick() 
            {
                var counter = document.getElementById("counter");
                console.log(counter); // Check if counter is not null
                var seconds = localStorage.getItem("remainingTime") || 120;
                seconds--;
                counter.innerHTML = "0:" + (seconds < 10 ? "0" : "") + String(seconds);
                if (seconds > 0) 
                {
                    localStorage.setItem("remainingTime", seconds);
                    setTimeout(tick, 1000);
                } 
                else 
                {
                    resetCountdown(); // Reset the countdown
                }
            }

            tick();
        }

        function resetCountdown() 
        {
            // Reset countdown to one minute
            localStorage.removeItem("remainingTime");
            countdown();
        }

        countdown();

        setInterval(spinner_game_function, 1000);   
    
});

function spinner_game_function()
    {
        var counterElement = document.getElementById("counter");
        if (counterElement) 
        {
           var counterValue = counterElement.innerHTML;
           console.log("Counter Value:", counterValue);
           if (counterValue <= "0:10") 
           {
                disableButtons();
           }
           else
           {
                enableButtons();       
           }
        } 
        else 
        {
            console.log("Counter element not found.");
         }
    } 


function disableButtons() {
        // Disable buttons when counter reaches "0:10"
        $("#high, #low, #mediam, #2x_jackpot").prop("disabled", true);
    }

    function enableButtons() {
        // Enable buttons
        $("#high, #low, #mediam, #2x_jackpot").prop("disabled", false);
    }

</script>