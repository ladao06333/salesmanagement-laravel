<?php       
    $cart = session()->get('cart');
 ?>
<section id="cart_items">
    <div class="container">
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="description">ID</td>
                        <td class="image">Item</td>
                        <td class="description">Title</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $key => $value) { ?>
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <tr>
                            <td class="id" id="<?php echo $value['id']; ?>">
                                <?php echo $value['id']; ?>
                            </td>
                            <td class="cart_product">
                                <a><img style="width: 100px ; height: 100px"
                                        src="/upload/product/<?php echo $value['image'] ?>" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a>{{$value['name']}}</a></h4>
                                <p>Web ID: {{$value['id']}}</p>
                            </td>
                            <td class="cart_price">
                                <?php echo $value['price'] ?>
                            </td>
                            <td>
                                <input class="cart_quantity_input" type="text" name="quantity"
                                    value="<?php echo $value['qty'] ?>" autocomplete="off" size="2">
                            </td>


                            <td class="cart_total">
                                <p class="cart_total_price">
                                    <?php echo $value['price']*$value['qty'] ?>
                                </p>
                            </td>

                        </tr>
                    </form>
                    <?php }?>

                </tbody>
            </table>
        </div>
    </div>
</section>
<!--/#cart_items-->

<div class="col-sm-6">
    <div class="total_area">
        <ul>
            <li>Cart Sub Total <span>$59</span></li>
            <li>Eco Tax <span>$2</span></li>
            <li>Shipping Cost <span>Free</span></li>
            <li>Total <span class="total">
                    @if(isset($cart))
                    <?php 
                    $tong = 0;
                    foreach ($cart as $key => $value) { 
                    $price = $value['price']*$value['qty'];
                    $tong += $price;
                    }
                    echo '<h2>'.$tong .'</h2>';
                ?>
                    @else
                    @endif


                </span></li>

        </ul>
    </div>
</div>