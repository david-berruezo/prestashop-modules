<!-- Start Service Section -->
<div class="service-promo-section section-top-gap-100">
    <div class="service-wrapper">
        <div class="container">
            <div class="row">
                <!-- Start Service Promo Single Item -->
                {if isset($items) && $items}
                    {foreach from=$items item=item name=item}
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="service-promo-single-item" data-aos="fade-up"  data-aos-delay="0">
                                {if isset($item.image) && $item.image}
                                    <div class="image">
                                        <img src="{$image_baseurl|escape:'htmlall':'UTF-8'}{$item.image|escape:'htmlall':'UTF-8'}" alt="{$item.title|escape:'htmlall':'UTF-8'}">
                                    </div>
                                {/if}
                                <div class="content">
                                    {if isset($item.description) && $item.description}
                                        {$item.description nofilter}
                                        <!--
                                        <h6 class="title">FREE SHIPPING</h6>
                                        <p>Get 10% cash back, free shipping, free returns, and more at 1000+ top retailers!</p>
                                        -->
                                    {/if}
                                </div>
                            </div>
                        </div>
                    {/foreach}
                {/if}
            </div>
        </div>
    </div>
</div>
<!-- End Service Section -->