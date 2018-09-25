<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.min.css" integrity="sha256-oSrCnRYXvHG31SBifqP2PM1uje7SJUyX0nTwO2RJV54=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <title>Driver orders</title>
        
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <div class="row" style="margin-top:30px;">
                    <div class="dropdown pull-right">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $username?>
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('index.php/logout')?>">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row" style="margin-top:30px;">
                    <div class="panel panel-default">
                      <div class="panel-heading">New orders</div>
                      <div class="panel-body">
                         <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Item Name</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                if($orders != ''):
                                    foreach($orders as $order):
                                    ?>
                                        <tr>
                                            <td><?php echo $order["id"]?></td>
                                            <td><?php echo $order["name"]?></td>
                                            <td><?php echo $order["address"]?></td>
                                            <td>
                                                <ul>
                                            <?php
                                                $statuses = json_decode($order["orderstatuses"], TRUE);
                                                if($statuses != ''):
                                                    foreach($statuses as $status):
                                                    ?>
                                                        <li><?php echo $status?></li>
                                                    <?php
                                                    endforeach;
                                                else:
                                                    echo 'No Status';
                                                endif;
                                            ?>
                                                </ul>
                                            </td>
                                            <td><button data-id-order="<?php echo $order["id"]?>" class="btn btn-success">Take</button></td>
                                        </tr>
                                    <?php
                                    endforeach;
                                else:
                                   echo 'Tidak ada order';
                                endif;
                              ?>
                            </tbody>
                          </table>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading">Order List</div>
                      <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Item Name</th>
                                <th>Driver</th>
                                <th>Status</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($orders_history != ''):
                                    foreach($orders_history as $order_take):
                                    ?>
                                        <tr>
                                            <td><?php echo $order_take["id"]?></td>
                                            <td><?php echo $order_take["name"]?></td>
                                            <td><?php echo $order_take["address"]?></td>
                                            <td>
                                                <ul>
                                            <?php
                                                $statuses = json_decode($order_take["orderstatuses"], TRUE);
                                                if($statuses != ''):
                                                    foreach($statuses as $status):
                                                    ?>
                                                        <li><?php echo $status?></li>
                                                    <?php
                                                    endforeach;
                                                else:
                                                    echo 'No Status';
                                                endif;
                                            ?>
                                                </ul>
                                            </td>
                                            <td>
                                                <?php
                                                    if($order_take["id_status"] == 2):
                                                    ?>
                                                        <button data-id-order="<?php echo $order_take["id"]?>" class="btn btn-info btn-delivery">Change to Delivery</button>
                                                    <?php
                                                    elseif($order_take["id_status"] == 3):
                                                    ?>
                                                        <button data-id-order="<?php echo $order_take["id"]?>" class="btn btn-info btn-delivered">Change to Delivered</button>
                                                    <?php
                                                    else:
                                                        echo '';
                                                    endif;
                                                ?>
                                           
                                            
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                else:
                                   echo 'Tidak ada order';
                                endif;
                              ?>
                            </tbody>
                          </table>
                      </div>
                    </div>             
                </div>             
            </div>
        </div>  
        <script>
            var url = "<?php echo base_url()?>";
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous" defer></script>
        <script type="text/javascript">
                $('.btn-success').on("click", function(e){
                    var id_order = $(this).attr('data-id-order');
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: url + "index.php/driver/takeorders",
                        dataType: "json",
                        data: {"id":id_order},
                        success:function(response) {
                           if(response.status != 0){
                               top.location.href= url+"index.php/driver/orders";
                           }
                        }
                    });
                });
                $('.btn-delivery').on("click", function(e){
                    var id_order = $(this).attr('data-id-order');
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: url + "index.php/driver/ondelivery",
                        dataType: "json",
                        data: {"id":id_order},
                        success:function(response) {
                           if(response.status != 0){
                               top.location.href= url+"index.php/driver/orders";
                           }
                        }
                    });
                });
                $('.btn-delivered').on("click", function(e){
                    var id_order = $(this).attr('data-id-order');
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: url + "index.php/driver/ordersDelivered",
                        dataType: "json",
                        data: {"id":id_order},
                        success:function(response) {
                           if(response.status != 0){
                               top.location.href= url+"index.php/driver/orders";
                           }
                        }
                    });
                });
                
        
        </script>    
        
    </body>
</html>
