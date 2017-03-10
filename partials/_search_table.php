<form class="form-search pull-left">
  <div class="input-append">
    <input type="text" class="span2 search-query">
    <button type="submit" class="btn filter"><i class="icon-search"></i></button>
  </div>
</form>
<script>
$('.filter').on('click', function(e) {
  e.preventDefault();
  var reg = new RegExp($(this).prev().val(), 'i');
  $('.searchable tr').hide();
      $('.searchable tr').filter(function() {
          return reg.test($(this).text());
      }).show();
  });
</script> 