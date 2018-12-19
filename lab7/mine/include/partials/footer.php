<? require_once __DIR__ ."/../config.php";  ?>

<!-- TODO: ene 2 iig offline bolgowol -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="<? echo $site_url; ?>/public/bootstrap/js/bootstrap.min.js" ></script>

<!-- For datepicker start-->
<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js" type="text/javascript"></script>
<script>
   $('#datepicker').datepicker({
       uiLibrary: 'bootstrap4',
       format: 'yyyy-dd-mm'
   });
   jQuery(document).ready(function($){
   // Allow Page URL to activate a tab's ID
   var taburl = document.location.toString();
   if( taburl.match('#') ) {
   $('.nav-tabs a[href="#'+taburl.split('#')[1]+'"]').tab('show');
   }
   // Allow internal links to activate a tab.
   $('a[data-toggle="tab"]').click(function (e) {
   e.preventDefault();
   $('a[href="' + $(this).attr('href') + '"]').tab('show');
   });
   }); // End
</script>
<!-- For datepicker end-->

</body>
</html>

