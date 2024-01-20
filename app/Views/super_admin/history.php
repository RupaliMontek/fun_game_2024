
    <style>
    body {
        font-family: Arial, sans-serif;
    }

    h1 {
        color: #333;
    }

    .input-group {
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .no-data-message {
        color: red;
        font-style: italic;
    }
    .back-button {
            margin-bottom: 20px;
            background-color: #0d6efd;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
</style>

    <script>
        function searchUser() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search-focus");
            filter = input.value.toUpperCase();
            table = document.querySelector("table");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those that don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0]; // Assuming the username is in the first column
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
            
            // Show "No data available" message if no matching rows found
            var noDataMessage = document.getElementById("no-data-message");
            var displayStyle = (table.querySelectorAll("tbody tr[style='display: none;']").length === tr.length) ? "block" : "none";
            noDataMessage.style.display = displayStyle;
        }
    </script>
    <style>
        .no-data-message {
            color: red;
        }
    </style>

 
<div class="col-auto col-md-9">
        <div class="container mt-5">
    <h1>User History</h1>
    <div class="input-group">
        <div class="form-outline" data-mdb-input-init>
            <input id="search-focus" type="search" class="form-control" onkeyup="searchUser()" />
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Role</th>
                    
                <th>amount given</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($history)): ?>
                <tr id="no-data-message" style="display: none;">
                    <td colspan="2" class="no-data-message">No data available</td>
                </tr>
                <?php else: ?>
                <?php foreach ($history as $user): ?>
                    <?php if ($user['role'] === 'user'): ?>
            
                    <tr>
                        <td><?= $user['username']; ?></td>
                        <td><?= $user['role']; ?></td>
                        
                        <td><?= $user['amout_given']; ?></td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <button class="back-button" onclick="goBack()">Back</button>
    <div class="input-group">

<script>
    function goBack() {
            window.history.back();
        }
    </script>

    </div>
    </div>