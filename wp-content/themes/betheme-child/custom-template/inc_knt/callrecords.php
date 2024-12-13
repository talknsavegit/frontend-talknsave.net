
    <div class="col-md-12 package">
        <a class="btn btn1" data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1">
            Call Detail Records (Click to view details)
        </a>
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
                                <th scope="col">Location</th>
                                <th scope="col">Direct #</th>
                                <th scope="col">Linked</th>
                                <th scope="col">Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($calls as $key => $call){
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $call['Date'];?></th>
                                        <td><?php echo $call['Time']; ?></td>
                                        <td><?php echo $call['Location']; ?></td>
                                        <td><?php echo $call['Direct']; ?></td>
                                        <td><?php echo $call['Linked']; ?></td>
                                        <td><?php echo $call['Duration']; ?></td>
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


