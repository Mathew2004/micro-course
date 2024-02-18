
<style>
    .profile-flex{
        display: flex;
        justify-content: space-around;
        width: min-content;
    }
    .profile-flex img{
        border-radius: 50%;
        height: 70px;
        width: 70px;
        
    }
    .profile-flex h3{
        margin-left: 10px;
    }
</style>

<div class="live-viewers">
    <h2>People Are Watching</h2>
    <div class="profile-flex">
        <img src="../uploaded_files/NaUVVr5SkVNpRX28L4NT.jpg" alt="">
        <h3>Evan</h3>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" 
integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
 crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
/*
    function updateUserStatus(){
        $.ajax({
            url: "../ajax/update_user.php",
            type: "POST",
            success: function(data){
               // alert(data);
               
            }
        })
    }
    function status(){
        $.ajax({
            url: "user_status.php",
            type: "POST",
            success: function(data){
                $('#user_stat').html(data);
               // alert(data);
            }
        })
    }
    status();
    
    setInterval(function(){
        updateUserStatus();
        status();
        
    }, 5000)
*/
</script>