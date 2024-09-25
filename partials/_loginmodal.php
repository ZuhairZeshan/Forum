
<style>
    #colour{
        color: red;
        font-weight: bold;
    }
</style>

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login to zDiscuss</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/zuhair/forum/partials/_handlelogin.php" method="post">
                <div class="modal-body">
                    <!-- Error message -->
                    <?php 
                        if (isset($_GET['loginerror']) && $_GET['loginerror'] == "true"){
                            echo '
                            <div class="mb-3">
                                <div class="container">
                                    <label for="invalid" class="form-label" id="colour">INVALID CREDENTIALS</label>
                                </div>
                            </div>';
                        }
                    ?>
                    
                    <div class="mb-3">
                        <label for="loginemail" class="form-label">Username</label>
                        <input type="text" class="form-control" id="loginemail" name="loginemail" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="loginpassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginpassword" name="loginpassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
