
<footer role="contentinfo">
        <div class="clearfix">
            <ul class="list-unstyled list-inline pull-left">
                <li>Sohag &copy; <?php echo date("Y")?></li>
            </ul>
            <button class="pull-right btn btn-inverse-alt btn-xs hidden-print" id="back-to-top"><i class="fa fa-arrow-up"></i></button>
        </div>
    </footer>

</div> <!-- page-container -->

<!--
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo base_url('assets')?>/js/jquery-1.10.2.min.js"%3E%3C/script%3E'))</script>
<script type="text/javascript">!window.jQuery.ui && document.write(unescape('%3Cscript src="<?php echo base_url('assets')?>/js/jqueryui-1.10.3.min.js'))</script>
-->


<script type='text/javascript' src='<?php echo base_url('assets')?>/js/bootstrap.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/enquire.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jquery.cookie.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jquery.nicescroll.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/codeprettifier/prettify.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/sparklines/jquery.sparklines.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-toggle/toggle.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/fullcalendar/fullcalendar.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-daterangepicker/daterangepicker.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-daterangepicker/moment.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/pulsate/jQuery.pulsate.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-ckeditor/ckeditor.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/placeholdr.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/application.js'></script> 

<!--<script type='text/javascript' src='<?php echo base_url('assets')?>/demo/demo.js'></script>--> 
<script>
$(document).ready(
  );


$("#demo-color-variations a").click(function(){
    $("head link#styleswitcher").attr("href", 'assets/demo/variations/' + $(this).data("theme"));
    $.cookie('theme',$(this).data("theme"));
    return false;
});

$("#demo-header-variations a").click(function(){
    $("head link#headerswitcher").attr("href", 'assets/demo/variations/' + $(this).data("headertheme"));
    $.cookie('headertheme',$(this).data("headertheme"));
    return false;
});

</script>


</body>
</html>