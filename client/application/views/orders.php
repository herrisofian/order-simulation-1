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
                    foreach($items as $item):
                    ?>
                        <tr>
                            <td><?php echo $item["id"]?></td>
                            <td><?php echo $item["sku"]?></td>
                            <td><?php echo $item["name"]?></td>
                            <td><?php echo $item["description"]?></td>
                            <td><?php echo $item["price"]?></td>
                            <td><button data-id-item="<?php echo $item["id"]?>" class="btn btn-success">Order</button></td>
                        </tr>
                    <?php
                    endforeach;
                  ?>
                </tbody>
              </table>
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
                    $count = 1;
                    foreach($orders as $order):
                    ?>
                        <tr>
                            <td><?php echo $count?></td>
                            <td><?php echo $order["name"]?></td>
                            <td><?php echo $order["username"]?></td>
                            <td>Order Created at <?php echo $order["statusdatetime"]?></td>
                        </tr>
                    <?php
                    $count++;
                    endforeach;
                  ?>
                </tbody>
              </table>
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
