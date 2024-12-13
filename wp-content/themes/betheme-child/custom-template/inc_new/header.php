<header>
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-12 logo-container">
                <p style = "font-size:13px;">CALL US FOR HELP<br>1-866-825-5672  <br>02-655-0333</p>
                <div class="logo">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" width="145" height="69" alt="">
                </div>
            </div>
            <div class="col-md-5 col-12 info">
                <div class="info-container">
                    <table style=" border-spacing: 0; border-collapse: collapse; border-color:  #f2f2f2 !important; border-style: 1px solid #f2f2f2 !important">
                        <tr>
                            <td>Name</td>
                            <td align="right" style="font-family:'DejaVu Sans';"><?php echo $general['UserName']; ?></td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td align="right"><?php echo $general['PhoneNumber']; ?></td>
                        </tr>
                        <tr>
                            <td>Equipment</td>
                            <td align="right"><?php echo $general['EquipmentName']; ?></td>
                        </tr>
                        <tr>
                            <td>Plan Name</td>
                            <td align="right"><?php echo $general['PlanDisplayName']; ?></td>
                        </tr>
                    </table>
                </div>
                
            </div>
            <div class="col-md-5 col-12 info border-0">
                <div class="info-container">
                    <table  style=" border-spacing: 0; border-collapse: collapse; border-color:  #f2f2f2 !important; border-style: 1px solid #f2f2f2 !important">
                        <tr>
                            <td>Invoice Date</td>
                            <td align="right"><?php echo date('M d, Y',strtotime(explode('T',$general['UpdatedOn'])[0])); ?></td>
                        </tr>
                        <tr>
                            <td>Rental Code</td>
                            <td align="right"><?php echo $general['RentalCode']; ?></td>
                        </tr>
                        <tr>
                            <td>Contact number </td>
                            <td align="right"><?php echo $general['PhoneNumber']; ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td align="right" style="font-family:'DejaVu Sans';"><?php echo $general['ClientStreet'].' '.$general['ClientCity'].' '.$general['ClientState'].' '.$general['ClientCountry'].', '.$general['ClientZip']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</header>