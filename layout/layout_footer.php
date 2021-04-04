</div>
<!-- /container -->
  
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   
<!-- bootbox library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
  
</body>
<div style="position:absolute; bottom:0; width:100%; height:100px;">
    <table class='table' style="text-align:center;">
        <tr>
            <td>
                Git Hub link
            </td>
        </tr>
        <tr>
            <td>
                Copyright @ 2021 Washburn, Christopher
            </td>
        </tr>
    </table>
</div>
<script>
// JavaScript for deleting product
$(document).on('click', '.delete-object', function(){
  
    var id = $(this).attr('delete-id');
    var fname = $(this).attr('fname-id');
    var lname = $(this).attr('lname-id');
    var email = $(this).attr('email');
  
    bootbox.confirm({
        message: "<h4>Are you sure you want to delete " + fname + " " + lname + "?</h4>",
        buttons: {
            confirm: {
                label: '<span class="glyphicon glyphicon-ok"></span> Yes',
                className: 'btn-danger'
            },
            cancel: {
                label: '<span class="glyphicon glyphicon-remove"></span> No',
                className: 'btn-primary'
            }
        },
        callback: function (result) {
  
            if(result==true){
                $.post('delete_person.php', {
                    object_id: id
                    email : email
                }, function(data){
                    location.reload();
                }).fail(function() {
                    alert('Unable to delete.');
                });
            }
        }
    });
  
    return false;
});
</script>
</html>