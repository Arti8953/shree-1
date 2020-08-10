<script type="text/javascript">
  $(document).ready(function(){
    var submit = $('#usersubmit');
    $('#create_user').on('submit', function(event){
      event.preventDefault();
      var password = $('#password').val();
      var repassword = $('#re-password').val();
      if (password == repassword) {
        $('#create_user')[0].submit();
      }else{
        $('#password-error').html('password not match');
      }
    });
    $('#username').on('focusout', function(){
      var username = $(this).val();
      $.ajax({
        type: "POST",
        url: '<?php echo base_url('admin/user/check_user') ?>',
        data: {
          'username' : username,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php  echo $this->security->get_csrf_hash(); ?>'
        },
        datatype: 'json',
        success: function(data) {
          var data = JSON.parse(data);
          if (data.error == 1) {
            submit.attr("disabled", true);
            $('#username-error').html(data.msg);
          }else{
            submit.removeAttr("disabled");
            $('#username-error').html('');
          }
        }
      });
    });
  });
</script>
