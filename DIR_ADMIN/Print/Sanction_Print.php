<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
    include('Print_Header.php');
    include('../../config/connection.php');
?>

<?php $title = 'Sanction Details' ?>

<body>

    <section id="container" class="print">

        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <!-- page start-->

                <div class="row">
                    <div class="col-md-12">
                        <section class="panel">
                            <?php include('Title.php') ?>
                            <table class="table table-invoice">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Time Value</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $item = '';    
                                        foreach (explode(',', $_GET['items']) as $data) {
                                            $item = $item . ",'".$data."'";
                                        }
                                        //echo $item;
                                        $view_query = mysqli_query($con,"SELECT SancDetails_CODE as CODE,SancDetails_NAME AS NAME ,SancDetails_DESC AS DESCR,SancDetails_TIMEVAL AS VAL FROM r_sanction_details WHERE SancDetails_CODE IN ('1'".$item.")");
                                        $i = 1;
                                        while($row = mysqli_fetch_assoc($view_query))
                                        {
                                            $code = $row["CODE"];										
                                            $name = $row["NAME"];										
                                            $desc = $row["DESCR"];										
                                            $val = $row["VAL"];										

                                        echo "
                                        <tr class=''>
                                            <td>$i</td>
                                            <td >$code</td>
                                            <td >$name</td>
                                            <td >$desc</td>
                                            <td >$val</td>
                                        </tr>
                                        ";
                                            $i = $i + 1;
                                        }	
                                                                
                                    ?>
                                </tbody>
                            </table>
                            <center>
                                <div class="row footer" style="padding-top:25px;padding-bottom:25px">
                                    <p style="font-size:13px;color:black;font-weight:bold;">
                                        Rothlener Bldg., PUP Quezon City Branch, Don Fabian St., Commonwealth Quezon City
                                        <br/>Phone: (Direct Lines) 9527817; 4289144; 9577817
                                        <br/> Email: commonwealth@pup.edu.ph/ Website: www.pup.edu.ph
                                        <br/>
                                        <class style="font-style:italic;font-weight:normal;">“The Country’s 1st Polytechnic U”</class>
                                    </p>

                                </div>
                            </center>
                        </section>
                    </div>
                </div>
                <!-- page end-->
            </section>
        </section>
        <!--main content end-->

    </section>

    <!-- Placed js at the end of the document so the pages load faster -->

    <!--Core js-->
    <script src="../../ASSETS/js/jquery.js"></script>
    <script src="../../ASSETS/bs3/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../../ASSETS/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../../../../ASSETS/js/jquery.scrollTo.min.js"></script>
    <script src="../../ASSETS/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
    <script src="../../ASSETS/js/jquery.nicescroll.js"></script>
    <!--Easy Pie Chart-->
    <script src="../../ASSETS/js/easypiechart/jquery.easypiechart.js"></script>
    <!--Sparkline Chart-->
    <script src="../../ASSETS/js/sparkline/jquery.sparkline.js"></script>
    <!--jQuery Flot Chart-->
    <script src="../../ASSETS/js/flot-chart/jquery.flot.js"></script>
    <script src="../../ASSETS/js/flot-chart/jquery.flot.tooltip.min.js"></script>
    <script src="../../ASSETS/js/flot-chart/jquery.flot.resize.js"></script>
    <script src="../../ASSETS/js/flot-chart/jquery.flot.pie.resize.js"></script>


    <!--common script init for all pages-->
    <script src="../../ASSETS/js/scripts.js"></script>

    <script type="text/javascript">
        window.print();

    </script>

</body>

</html>
