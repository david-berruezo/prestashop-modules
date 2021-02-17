<!-- Start Hero Slider Section-->
<div class="hero-slider-section">
    <!-- Slider main container -->
    <div class="hero-slider-active swiper-container">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            {if isset($items) && $items}
               {foreach from=$items item=item name=item}
                   <!-- Start Hero Single Slider Item -->
                   <div class="hero-single-slider-item swiper-slide">
                       <!-- Hero Slider Image -->
                       {if isset($item.image) && $item.image}
                       <div class="hero-slider-bg">
                           <!--
                           <img src="{$urls.theme_assets}images/hero-slider/home-1/hero-slider-1.jpg" alt="">
                            -->
                           <img src="{$image_baseurl|escape:'htmlall':'UTF-8'}{$item.image|escape:'htmlall':'UTF-8'}" alt="{$item.title|escape:'htmlall':'UTF-8'}">
                       </div>
                       {/if}
                       <!-- Hero Slider Content -->
                       <div class="hero-slider-wrapper">
                           <div class="container">
                               <div class="row">
                                   <div class="col-auto">
                                       <div class="hero-slider-content">
                                           {if isset($item.description) && $item.description}
                                               {$item.description nofilter}
                                           {/if}
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   <!--
                   <a class="link-bonslick" href="{$item.url|escape:'htmlall':'UTF-8'}" title="{$item.title|escape:'htmlall':'UTF-8'}">
                   <img class="img-responsive" src="{$image_baseurl|escape:'htmlall':'UTF-8'}{$item.image|escape:'htmlall':'UTF-8'}" alt="{$item.title|escape:'htmlall':'UTF-8'}" />
                    -->
                   </div> <!-- End Hero Single Slider Item -->
               {/foreach}
            {/if}

            <!-- If we need pagination -->
            <div class="swiper-pagination active-color-golden"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev d-none d-lg-block"></div>
            <div class="swiper-button-next d-none d-lg-block"></div>
    </div>
</div>
<!-- End Hero Slider Section-->