    <hr class="hr-footer">
    <div class="footer">
        <footer class="text-center">&copy; <?=date("Y")?> <?=$config->title?> <i class="fas fa-heart"></i></footer>
    </div>
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <script type="text/javascript">
    	$(document).ready(function() {
            $("#getdataavg").click(function(){
                var kandidat = document.getElementById("ia").value;
                var kriteria = document.getElementById("ik").value;

                $.post("ranking-voting.php", {"ia":kandidat,"ik":kriteria}, function(result){
                    //alert(result);
                    var obj = JSON.parse(result);
                    document.getElementById("nndata").value = obj.jumlahvoting;
                });
            });
            
            $('#tabeldata').DataTable({
                "lengthChange": true,
                "lengthMenu": [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]]
            });
		});
    </script>
  </body>
</html>