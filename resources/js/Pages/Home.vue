<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue'
import { Head } from '@inertiajs/vue3'
import Image from '@/components/Image.vue'
import { onMounted } from 'vue'
import { reloadPageWithParamRefresh } from '@/composables/helpers'

onMounted(() => {
    reloadPageWithParamRefresh()
})
</script>

<template>
    <Head title="Home" />

    <HomeLayout>
        <div class="section mcb-section agency7-bordertop" style="padding-top:120px;padding-bottom:80px">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="column_attr clearfix mobile_align_center">
                            <h6 class="agency7-heading">QUICK SUMMARY</h6>
                            <hr class="no_line" style="margin: 0 auto 15px auto" />
                            <h3>From bright ideas to complete project. We are here to help you.</h3> </div>
                    </div>
                    <div class="col-12">
                        <hr class="no_line" style="margin: 0 auto 20px auto" /> </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="image_frame image_item no_link scale-with-grid no_border">
                                    <div class="image_wrapper">
                                        <Image src="frontend-assets/agency7/images/agency7-icon1.webp" alt="agency7-icon1" width="135" height="135"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="column_attr clearfix">
                                    <ul class="list_custom">
                                        <li> <i class="icon-check" style="color:#0da122"></i> Sodales netus enim nam malesuada. </li>
                                        <li> <i class="icon-check" style="color:#0da122"></i> Libero massa rutrum auctor amet eget convallis. </li>
                                        <li> <i class="icon-check" style="color:#0da122"></i> Mauris vivamus et ante aliquam velit praesent. </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="image_frame image_item no_link scale-with-grid no_border">
                                    <div class="image_wrapper">
                                    <Image class="scale-with-grid" src="frontend-assets/agency7/images/agency7-icon2.webp" alt="agency7-icon2" width="135" height="135" /> </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="column_attr clearfix">
                                    <ul class="list_custom">
                                        <li> <i class="icon-check" style="color:#0da122"></i> Quisque morbi quisque ante tempus sapien suspendisse porttitor. </li>
                                        <li> <i class="icon-check" style="color:#0da122"></i> Porttitor lorem vulputate volutpat inceptos dapibus in proin eleifend iaculis ligula. </li>
                                        <li> <i class="icon-check" style="color:#0da122"></i> Facilisis nam aenean proin tempor quisque senectus. </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="image_frame image_item no_link scale-with-grid no_border">
                                    <div class="image_wrapper">
                                    <Image class="scale-with-grid" src="frontend-assets/agency7/images/agency7-icon3.webp" alt="agency7-icon3" width="135" height="135" /> </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="column_attr clearfix">
                                    <ul class="list_custom">
                                        <li> <i class="icon-check" style="color:#0da122"></i> Semper curabitur nibh eleifend. </li>
                                        <li> <i class="icon-check" style="color:#0da122"></i> Quisque lorem venenatis tellus porta. </li>
                                        <li> <i class="icon-check" style="color:#0da122"></i> Ac senectus mattis magna. </li>
                                        <li> <i class="icon-check" style="color:#0da122"></i> Gravida quis aliquam habitant mattis. </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <hr class="no_line" style="margin: 0 auto 80px auto" /> </div>
                        </div>
                    </div>
                    <div class="col-12 column-margin-10px" style="padding:25px 20px 0 ;background-color:#3c8f69;border-radius: 10px;">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="column_attr clearfix mobile_align_center" style="padding:10px 0 0;">
                                    <h4><span style="color:#fff;">Start your own project with us today</span></h4> </div>
                            </div>
                            <div class="col-md-3 column-margin-0px">
                                <div class="column_attr clearfix align_right mobile_align_center">
                                    <div class="button_align align_left"> <a class="button button_size_2 button_theme" href="#"><span class="button_label">Start now</span></a> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section mcb-section no-margin-h no-margin-v full-width">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="image_frame image_item no_link scale-with-grid aligncenter stretch no_border">
                            <div class="image_wrapper">
                            <Image class="scale-with-grid" src="frontend-assets/agency7/images/agency7-sep1.webp" alt="agency7-sep1" width="1920" height="140" /> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section mcb-section" style="padding-top:80px;padding-bottom:80px">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <div class="placeholder"> &nbsp; </div>
                    </div>
                    <div class="col-md-8">
                        <div class="column_attr clearfix align_center">
                            <h6 class="agency7-heading">OUR PRODUCTS</h6>
                            <hr class="no_line" style="margin: 0 auto 15px auto" />
                            <h3>Three packages. Endless possibilities.</h3> </div>
                    </div>
                    <div class="col-12">
                        <hr class="no_line" style="margin: 0 auto 40px auto" /> </div>
                    <div class="col-12 column_offer">
                        <div class="offer">
                            <ul class="offer_ul">
                                <li class="offer_li">
                                    <div class="image_wrapper">
                                    <Image width="780" height="700" src="frontend-assets/agency7/images/agency7-products-pic1.webp" class="scale-with-grid wp-post-image" /> </div>
                                    <div class="desc_wrapper align_left no-link">
                                        <div class="desc">
                                            <p>
                                            <Image loading="lazy" class="size-full wp-image-61 alignleft" src="frontend-assets/agency7/images/agency7-offer-pic1.png" width="141" height="47" /> </p>
                                            <h3></h3>
                                            <hr class="no_line" style="margin: 0 auto 15px auto" />
                                            <h3>Start from $9.90/mo.</h3>
                                            <hr class="no_line" style="margin: 0 auto 15px auto" />
                                            <p> Curabitur elit. In ultricies iaculis lectus. Phasellus vitae justo. Sed faucibus, diam sit amet, volutpat quam congue sodales nibh vel dui ut aliquet mi mauris, interdum at, posuere cubilia Curae, Duis ornare varius, nisl risus. </p>
                                            <hr class="no_line" style="margin: 0 auto 15px auto" /> <a class="button button_size_2 button_themecolor" href="frontend-assets/agency7/pricing.html" target="_blank"><span class="button_label">Learn more</span></a> </div>
                                    </div>
                                </li>
                                <li class="offer_li">
                                    <div class="image_wrapper">
                                    <Image width="780" height="700" src="frontend-assets/agency7/images/agency7-products-pic2.webp" class="scale-with-grid wp-post-image" loading="lazy" /> </div>
                                    <div class="desc_wrapper align_left no-link">
                                        <div class="desc">
                                            <p>
                                            <Image loading="lazy" class="wp-image-62 size-full alignleft" src="frontend-assets/agency7/images/agency7-offer-pic2.png" width="107" height="47" /> </p>
                                            <p>&nbsp;  </p>
                                            <p>&nbsp;  </p>
                                            <hr class="no_line" style="margin: 0 auto 15px auto" />
                                            <h3>Start from $12.90/mo.</h3>
                                            <hr class="no_line" style="margin: 0 auto 15px auto" />
                                            <p> Nullam augue imperdiet quis, convallis auctor. Nam posuere. Quisque vehicula non, sagittis venenatis. Sed sagittis lacus vestibulum in, ornare sollicitudin. Fusce congue. Nam tempor venenatis leo at erat sit amet. </p>
                                            <hr class="no_line" style="margin: 0 auto 15px auto" /> <a class="button button_size_2 button_themecolor" href="frontend-assets/agency7/pricing.html" target="_blank"><span class="button_label">Learn more</span></a> </div>
                                    </div>
                                </li>
                                <li class="offer_li">
                                    <div class="image_wrapper">
                                    <Image width="780" height="700" src="frontend-assets/agency7/images/agency7-products-pic3.webp" class="scale-with-grid wp-post-image" loading="lazy" /> </div>
                                    <div class="desc_wrapper align_left no-link">
                                        <div class="desc">
                                            <p>
                                            <Image loading="lazy" class="wp-image-63 size-full alignleft" src="frontend-assets/agency7/images/agency7-offer-pic3.png" width="107" height="47" /> </p>
                                            <p>&nbsp;  </p>
                                            <p>&nbsp;  </p>
                                            <hr class="no_line" style="margin: 0 auto 15px auto" />
                                            <h3>Start from $13.90/mo.</h3>
                                            <hr class="no_line" style="margin: 0 auto 15px auto" />
                                            <p> Proin in dictum vitae, fringilla aliquet. Donec molestie a, massa. Vivamus lacus magna, scelerisque odio sit amet neque quis libero. Duis pretium felis odio fermentum a, convallis aliquam purus. Quisque eu neque vitae porttitor sem ut erat. </p>
                                            <hr class="no_line" style="margin: 0 auto 15px auto" /> <a class="button button_size_2 button_themecolor" href="frontend-assets/agency7/pricing.html" target="_blank"><span class="button_label">Learn more</span></a> </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="slider_pagination"> <span class="current">1</span> / <span class="count">3</span> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section mcb-section agency7-bordertop" style="padding-top:120px;padding-bottom:35px">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <div class="placeholder"> &nbsp; </div>
                    </div>
                    <div class="col-md-8">
                        <div class="column_attr clearfix align_center">
                            <h6 class="agency7-heading">POWERFUL TEAM</h6>
                            <hr class="no_line" style="margin: 0 auto 15px auto" />
                            <h3>We picked best <span class="highlight highlight-underline" style="background-color:#47cd2b;"><span class="highlight-word">specialists<span class="highlight-border" style="background-color:#47cd2b;"></span></span></span> that are suited just for you.</h3> </div>
                    </div>
                    <div class="col-md-3" style="padding:0 4%">
                        <div class="row">
                            <div class="col-12">
                                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                    <div class="image_wrapper">
                                    <Image class="scale-with-grid" src="frontend-assets/agency7/images/agency7-about-pic2.webp" alt="agency7-about-pic2" width="500" height="500" /> </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="column_attr clearfix align_center">
                                    <h5 style="margin-bottom: 5px;">Allan Carter</h5>
                                    <p> <span style="color:#a9a9a9;">CEO</span> </p>
                                    <hr class="no_line" style="margin: 0 auto 10px auto" />
                                    <p> Ut labore et dolore magna aliqu ad minim </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding:0 4%">
                        <div class="row">
                            <div class="col-12">
                                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                    <div class="image_wrapper">
                                    <Image class="scale-with-grid" src="frontend-assets/agency7/images/agency7-about-pic3.webp" alt="agency7-about-pic3" width="500" height="500" /> </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="column_attr clearfix align_center">
                                    <h5 style="margin-bottom: 5px;">Jean McCarther</h5>
                                    <p> <span style="color:#a9a9a9;">CEO</span> </p>
                                    <hr class="no_line" style="margin: 0 auto 10px auto" />
                                    <p> Sagittis elementum posuere ultricies diam rhoncus non. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding:0 4%">
                        <div class="row">
                            <div class="col-12">
                                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                    <div class="image_wrapper">
                                    <Image class="scale-with-grid" src="frontend-assets/agency7/images/agency7-about-pic4.webp" alt="agency7-about-pic4" width="500" height="500" /> </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="column_attr clearfix align_center">
                                    <h5 style="margin-bottom: 5px;">Becka Garner</h5>
                                    <p> <span style="color:#a9a9a9;">Product manager</span> </p>
                                    <hr class="no_line" style="margin: 0 auto 10px auto" />
                                    <p> Malesuada curae torquent non eu purus diam. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding:0 4%">
                        <div class="row">
                            <div class="col-12">
                                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                    <div class="image_wrapper">
                                    <Image class="scale-with-grid" src="frontend-assets/agency7/images/agency7-about-pic5.webp" alt="agency7-about-pic5" width="500" height="500" /> </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="column_attr clearfix align_center">
                                    <h5 style="margin-bottom: 5px;">Laura Nicky</h5>
                                    <p> <span style="color:#a9a9a9;">Account manager</span> </p>
                                    <hr class="no_line" style="margin: 0 auto 10px auto" />
                                    <p> Etiam in vulputate varius loret eget adipiscing. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr class="no_line" style="margin:0 auto 20px"> </div>
                    <div class="col-12">
                        <div class="button_align align_center"> <a class="button button_size_2" href="frontend-assets/agency7/about.html"><span class="button_label">Read more about us</span></a> </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section mcb-section" style="padding-top:75px;padding-bottom:80px">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="column_attr clearfix mobile_align_center">
                            <h6 class="agency7-heading">OUR BLOG</h6>
                            <hr class="no_line" style="margin: 0 auto 15px auto" />
                            <h3><span class="highlight highlight-underline" style="background-color:#47cd2b;"><span class="highlight-word">Check<span class="highlight-border" style="background-color:#47cd2b;"></span></span> <span class="highlight-word">our<span class="highlight-border" style="background-color:#47cd2b;"></span></span></span> other top quality content posts on the blog.</h3> </div>
                    </div>
                    <div class="col-12 column_blog_news">
                        <div class="Latest_news featured">
                            <ul class="ul-first">
                                <li class="post">
                                    <div class="photo">
                                        <a href="frontend-assets/agency7/post.html">
                                        <Image width="960" height="720" src="frontend-assets/agency7/images/agency7-blog-pic5-960x720.webp" class="scale-with-grid wp-post-image" loading="lazy" /></a>
                                    </div>
                                    <div class="desc">
                                        <h4><a href="frontend-assets/agency7/post.html">Design advices</a></h4>
                                        <div class="desc_footer"> <span class="date"><i class="icon-clock"></i> December 17, 2021</span>
                                            <div class="button-love"></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <ul class="ul-second">
                                <li class="post">
                                    <div class="photo">
                                        <a href="frontend-assets/agency7/social-media.html">
                                        <Image width="960" height="720" src="frontend-assets/agency7/images/agency7-blog-pic4-960x720.webp" class="scale-with-grid wp-post-image" loading="lazy" /></a>
                                    </div>
                                    <div class="desc">
                                        <h5><a href="frontend-assets/agency7/social-media.html">Social media</a></h5>
                                        <div class="desc_footer"> <span class="date"><i class="icon-clock"></i> December 17, 2021</span>
                                            <div class="button-love"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="post">
                                    <div class="photo">
                                        <a href="frontend-assets/agency7/post.html">
                                        <Image width="960" height="720" src="frontend-assets/agency7/images/agency7-blog-pic1-960x720.webp" class="scale-with-grid wp-post-image" loading="lazy" /></a>
                                    </div>
                                    <div class="desc">
                                        <h5><a href="frontend-assets/agency7/post.html">Application designed
                                                <br>
                                                for our client</a></h5>
                                        <div class="desc_footer"> <span class="date"><i class="icon-clock"></i> December 16, 2021</span>
                                            <div class="button-love"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="post">
                                    <div class="photo">
                                        <a href="frontend-assets/agency7/post.html">
                                        <Image width="960" height="720" src="frontend-assets/agency7/images/agency7-blog-pic6-960x720.webp" class="scale-with-grid wp-post-image" loading="lazy" /></a>
                                    </div>
                                    <div class="desc">
                                        <h5><a href="frontend-assets/agency7/post.html">Project pricing calculation</a></h5>
                                        <div class="desc_footer"> <span class="date"><i class="icon-clock"></i> December 17, 2021</span>
                                            <div class="button-love"></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section mcb-section" style="padding-top:120px;padding-bottom:80px;background-color:#333333">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="column_attr clearfix align_center">
                            <h2><span style="color:#FFF;">Don’t wait and start
                                                        <br/>
                                                        your own project with us today</span></h2> </div>
                    </div>
                    <div class="col-md-2">
                        <div class="row">
                            <div class="col-12">
                                <div class="placeholder"> &nbsp; </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 column-margin-10px">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                    <div class="image_wrapper">
                                    <Image class="scale-with-grid" src="frontend-assets/agency7/images/agency7-icon4.webp" alt="agency7-icon4" width="115" height="115" /> </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="column_attr clearfix align_left mobile_align_center" style="padding:0 2%;">
                                    <div class="google_font" style="font-family:'Poppins',Arial,Tahoma,sans-serif;font-size:60px;line-height:60px;font-weight:600;letter-spacing:0px;color:#FFF;"> <span class="counter-inline animate-math"><span class="number" data-to="10">10</span></span>k+ </div>
                                    <h4><span style="color:#FFF;">Happy users</span></h4> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 column-margin-10px">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                    <div class="image_wrapper">
                                    <Image class="scale-with-grid" src="frontend-assets/agency7/images/agency7-icon5.webp" alt="agency7-icon5" width="115" height="115" /> </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="column_attr clearfix mobile_align_center" style="padding:0 2%;">
                                    <div class="google_font" style="font-family:'Poppins',Arial,Tahoma,sans-serif;font-size:60px;line-height:60px;font-weight:600;letter-spacing:0px;color:#FFF;"> <span class="counter-inline animate-math"><span class="number" data-to="50">50</span></span>k+ </div>
                                    <h4><span style="color:#FFF;">Installed apps</span></h4> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <hr class="no_line" style="margin: 0 auto 60px auto" /> </div>
                            <div class="col-md-4">
                                <div class="placeholder"> &nbsp; </div>
                            </div>
                            <div class="col-md-4 column_hover_color">
                                <div class="hover_color" style="background-color:#333333;border-color:#3c8f69;border-radius:9px;" ontouchstart="this.classList.toggle('hover');">
                                    <div class="hover_color_bg" style="background-color:#3c8f69;border-color:#3c8f69;border-width:3px;border-radius:8px;">
                                        <a href="#">
                                            <div class="hover_color_wrapper" style="padding:12px 20px;"> <b>Start free trial</b> </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr class="no_line" style="margin: 0 auto 40px auto" /> </div>
                            <div class="col-md-2">
                                <div class="placeholder"> &nbsp; </div>
                            </div>
                            <div class="col-md-8">
                                <div class="column_attr clearfix align_center">
                                    <p> <span style="color:#FFF;">Magni dolores eos qui Ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia <span class="tooltip tooltip-txt" data-tooltip="Try free trial for a month" data-position="top">dolor sit amet</span> </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </HomeLayout>
</template>
