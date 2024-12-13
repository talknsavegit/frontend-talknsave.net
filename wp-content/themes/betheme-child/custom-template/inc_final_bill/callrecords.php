<?php if(count($insidepackage) > 0): 
$counter = 0;
 foreach($insidepackage as $key => $call){
								if($call['Charge'] > 0){
									$counter++ ; 
								}
 							}
?>
    <div class="col-md-12 package">
		<?php if($counter > 0){?>
        <a class="btn btn1" data-bs-toggle="collapse" href="collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1">
            Calls included in your package (Click to view details)
        </a>
		<?php } ?>
        <?php if(empty($_GET['pdfs'])): ?>
        <div class="collapse" id="collapseExample1">
            <div class="card card-body">
                <?php endif; ?>
                <div class="call-details">
                    <table class="table table-striped" cellspacing="1">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Duration</th>
                                <th scope="col">Cost</th>
                                <th scope="col">Number</th>
                                <th scope="col">Service</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($insidepackage as $key => $call){
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $call['CallDate'];?></th>
                                        <td><?php echo $call['CallTime']; ?></td>
                                        <td><?php echo $call['ActualTime']; ?></td>
                                        <td><?php 
                                            echo number_format(
                                                    $call['Charge'],
                                                    4,
                                                    ".",
                                                    ''
                                                );
                                                ?></td>
                                        
                                        <td><?php echo $call['NumberDialed']; ?></td>
                                        <td><?php echo $call['service']; ?></td>
                                    </tr>
                                <?php
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
                <?php if(empty($_GET['pdfs'])): ?>
            </div>
        </div>
        <?php endif; ?>
        
    </div>
<?php endif; ?>

<?php if(count($outsidepackage) > 0): ?>
    <div class="col-md-12 package">
        <a class="btn btn2" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
        Calls outside of your package (Click to view details)
        </a>
        <?php if(empty($_GET['pdfs'])): ?>
        <div class="collapse" id="collapseExample2">
            <div class="card card-body">
                <?php endif; ?>
                    <div class="call-details-2">
                        <table class="table table-striped" cellspacing="1">
                            <thead>
                                <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Duration</th>
                                <th scope="col">Cost</th>
                                <th scope="col">Number</th>
                                <th scope="col">Service</th>
                                </tr>
                            </thead>
                            <tbody>
                    <?php 
                        foreach($outsidepackage as $key => $call){
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $call['CallDate'];?></th>
                                    <td><?php echo $call['CallTime']; ?></td>
                                    <td><?php echo $call['ActualTime']; ?></td>
                                    <td><?php 
                                        echo number_format(
                                                $call['Charge'],
                                                4,
                                                ".",
                                                ''
                                            );
                                            ?></td>
                                    
                                    <td><?php echo $call['NumberDialed']; ?></td>
                                    <td><?php echo $call['service']=='Inbound (FREE)'?'Inbound':$call['service']; ?></td>
                                </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                    </table>
                </div>
            <?php if(empty($_GET['pdfs'])): ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
