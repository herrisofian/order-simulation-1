<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.min.css" integrity="sha256-oSrCnRYXvHG31SBifqP2PM1uje7SJUyX0nTwO2RJV54=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <title>Home / Index</title>
        
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
                      <div class="panel-heading">List Item</div>
                      <div class="panel-body">
                         <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>SKU</th>
                                <th>Name</th>
                                <th>Desc</th>
                                <th>Price</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                if($items != ''):
                                    foreach($items as $item):
                                    ?>
                                        <tr style="height:30px">
                                            <td valign="middle"><?php echo $item["id"]?></td>
                                            <td valign="middle"><?php echo $item["sku"]?></td>
                                            <td valign="middle"><?php echo $item["name"]?></td>
                                            <td valign="middle"><?php echo $item["description"]?></td>
                                            <td valign="middle"><?php echo $item["price"]?></td>
                                            <td valign="middle"><button data-id-item="<?php echo $item["id"]?>" class="btn btn-success">Order</button></td>
                                        </tr>
                                    <?php
                                    endforeach;
                                else:
                                    echo 'Tidak ada item';
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
                                if($orders != ''):
                                    $count = 1;
                                    foreach($orders as $order):
                                    ?>
                                        <tr>
                                            <td><?php echo $count?></td>
                                            <td><?php echo $order["name"]?></td>
                                            <td><?php echo $order["username"]?></td>
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
                                        </tr>
                                    <?php
                                    $count++;
                                    endforeach;
                                else:
                                    echo 'Tidak ada yang di order';
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
                    var id_item = $(this).attr('data-id-item');
                    var address = window.prompt("Delivery address?");
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: url + "index.php/welcome/ordersPost",
                        dataType: "json",
                        data: {"address":address,"id":id_item},
                        success:function(response) {
                           if(response.status != 0){
                               top.location.href= url+"index.php/orders";
                           }
                        }
                    });
                });
                
        
        </script>    
        
    </body>
</html>
