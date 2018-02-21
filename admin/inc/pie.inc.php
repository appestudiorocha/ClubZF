<!-- Core Scripts - Include with every page -->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

<!-- Page-Level Plugin Scripts - Dashboard -->
<script src="js/plugins/morris/raphael-2.1.0.min.js"></script>
<script src="js/plugins/morris/morris.js"></script>

<!-- SB Admin Scripts - Include with every page -->
<script src="js/sb-admin.js"></script>

<!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
<script src="js/demo/dashboard-demo.js"></script>

<link href="js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
<script src="js/dataTables/dataTables.js"></script>

<script>
  $(function() {
   $('[data-toggle="tooltip"]').tooltip()
 })

  $('table').dataTable({
    "order": [],
    "deferRender": true,
    "lengthMenu": [[50, 100, -1], [50, 100, "All"]]
  });

</script>

<script language="javascript">
  $(document).ready(function() {
   $("#provincia").change(function() {
    $("#provincia option:selected").each(function() {
     elegido = $(this).val();
     $.post("../source.php", {
      elegido : elegido
    }, function(data) {
      $("#localidades").html(data);
    });
   });
  })
 }); 
</script>


<script>
  (function(w,d,s,g,js,fjs){
   g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(cb){this.q.push(cb)}};
   js=d.createElement(s);fjs=d.getElementsByTagName(s)[0];
   js.src='https://apis.google.com/js/platform.js';
   fjs.parentNode.insertBefore(js,fjs);js.onload=function(){g.load('analytics')};
 }(window,document,'script'));
</script>

<script>
  gapi.analytics.ready(function() {


    var CLIENT_ID = '74232024643-lj81s6d41gp1odcj43m4qtvv0ntjbmol.apps.googleusercontent.com';

    gapi.analytics.auth.authorize({
     container: 'auth-button',
     clientid: CLIENT_ID,
   });

  // Step 4: Create the view selector.

  var viewSelector = new gapi.analytics.ViewSelector({
  	container: 'view-selector'
  });

  // Step 5: Create the timeline chart.

  var timeline = new gapi.analytics.googleCharts.DataChart({
  	reportType: 'ga',
  	query: {
  		'dimensions': 'ga:date',
  		'metrics': 'ga:sessions',
  		'start-date': '30daysAgo',
  		'end-date': 'yesterday',
  	},
  	chart: {
  		type: 'LINE',
  		container: 'timeline'
  	}
  });

  // Step 6: Hook up the components to work together.

  gapi.analytics.auth.on('success', function(response) {
  	viewSelector.execute();
  });

  viewSelector.on('change', function(ids) {
  	var newIds = {
  		query: {
  			ids: ids
  		}
  	}
  	timeline.set(newIds).execute();
  });
});
</script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>

<script>
  $(document).ready(function() {
    $('textarea').summernote({
      minHeight: 200
    });
  });
</script>

</body>

</html>

