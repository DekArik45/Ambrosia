
@extends('frontend.layouts.app')

@section('content')
    
    <!-- SUB BANNER -->
    <section class="sub-banner text-center section">
            <div class="awe-parallax bg-4"></div>
            <div class="awe-title awe-title-3">
                <h3 class="lg text-uppercase">Cart</h3>
            </div>
        </section>
        <!-- END / SUB BANNER -->
    
        <!-- SHOP PAGE -->
        <section id="shop-page" class="shop-page section">
            <div class="container">
                <table class="shop-table shop-cart">
                    <thead>
                        <tr>
                            <th class="product-remove"></th>
                            <th class="product-name">Product</th>
                            <th class="product-quantity">Quantity</th>
                            <th class="product-subtotal">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- CART ITEM -->
                        <tr class="cart-item">
                            <td class="product-remove">
                                <a href="#" title="remove"><i class="icon awe_close"></i></a>
                            </td>
                            <td class="product-name">
                                <div class="product-thumbnail">
                                    <a href="#"><img src="images/shop/img-3.jpg" alt=""></a>
                                </div>
                                <div class="product-info">
                                    <a href="#">Cereal Strawbery & Milk (L)</a>
                                    <span>$12 per serve</span>
                                </div>
                            </td>
                            <td class="product-quantity">
                                <div class="quantity">
                                    <input type="button" value="-" class="minus">
                                    <input type="number" value="1" class="qty">
                                    <input type="button" value="+" class="plus">
                                </div>
                            </td>
                            <td class="product-subtotal">
                                <span class="amount">$48</span>
                            </td>
                        </tr>
                        <!-- END / CART ITEM -->
    
                        <!-- CART ITEM -->
                        <tr class="cart-item">
                            <td class="product-remove">
                                <a href="#" title="remove"><i class="icon awe_close"></i></a>
                            </td>
                            <td class="product-name">
                                <div class="product-thumbnail">
                                    <a href="#"><img src="images/shop/img-4.jpg" alt=""></a>
                                </div>
                                <div class="product-info">
                                    <a href="#">Cereal Strawbery & Milk (L)</a>
                                    <span>$12 per serve</span>
                                </div>
                            </td>
                            <td class="product-quantity">
                                <div class="quantity">
                                    <input type="button" value="-" class="minus">
                                    <input type="number" value="1" class="qty">
                                    <input type="button" value="+" class="plus">
                                </div>
                            </td>
                            <td class="product-subtotal">
                                <span class="amount">$48</span>
                            </td>
                        </tr>
                        <!-- END / CART ITEM -->
    
                        <!-- CART ITEM -->
                        <tr class="cart-item">
                            <td class="product-remove">
                                <a href="#" title="remove"><i class="icon awe_close"></i></a>
                            </td>
                            <td class="product-name">
                                <div class="product-thumbnail">
                                    <a href="#"><img src="images/shop/img-5.jpg" alt=""></a>
                                </div>
                                <div class="product-info">
                                    <a href="#">Cereal Strawbery & Milk (L)</a>
                                    <span>$12 per serve</span>
                                </div>
                            </td>
                            <td class="product-quantity">
                                <div class="quantity">
                                    <input type="button" value="-" class="minus">
                                    <input type="number" value="1" class="qty">
                                    <input type="button" value="+" class="plus">
                                </div>
                            </td>
                            <td class="product-subtotal">
                                <span class="amount">$48</span>
                            </td>
                        </tr>
                        <!-- END / CART ITEM -->
                    </tbody>
                </table>
                <div class="cart-footer">
                    <div class="coupon-code">
                        <label for="coupon">Coupon Code</label>
                        <input type="text" id="coupon">
                    </div>
                    <div class="total">
                        <span>Total Order:</span>
                        <span class="amount">$120</span>
                    </div>
                </div>
                <div class="cart-submit text-center">
                    <div class="form-actions">
                        <input type="submit" value="START CHECKOUT" class="awe-btn awe-btn-3 awe-btn-default text-uppercase">
                    </div>
                </div>
            </div>
        </section>
        <!-- END / SHOP PAGE -->
@endsection