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
                                        <li> <i class="icon-check" style="color:#0da122"></i> Introducing our comprehensive platform for efficient social media data management. </li>
                                        <li> <i class="icon-check" style="color:#0da122"></i> With our platform, businesses and individuals can effortlessly gather, organize. </li>
                                        <li> <i class="icon-check" style="color:#0da122"></i> Analyze data from various social media channels in one centralized hub. </li>
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
                                        <li> <i class="icon-check" style="color:#0da122"></i> Seamlessly connect your social media accounts to access real-time metrics </li>
                                        <li> <i class="icon-check" style="color:#0da122"></i> Track engagement, and monitor audience insights. </li>
                                        <li> <i class="icon-check" style="color:#0da122"></i> Our intuitive interface provides customizable dashboards and robust reporting tools, empowering you to make data-driven decisions, optimize your social media strategy, and enhance audience engagement </li>
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
                                        <li> <i class="icon-check" style="color:#0da122"></i> Streamline your social media data management with our platform and unlock the full potential of your social media presence. </li>
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
                                    <div class="button_align align_left"> <a class="button button_size_2 button_theme" :href="route('admin.register.show-form', { refresh: true })"><span class="button_label">Start now</span></a> </div>
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
                            <h6 class="agency7-heading">OUR PRODUCT</h6>
                            <hr class="no_line" style="margin: 0 auto 15px auto" />
                            <h3>This is free platform for everyone</h3> </div>
                    </div>
                    <div class="col-12">
                        <hr class="no_line" style="margin: 0 auto 40px auto" /> </div>
                    <div class="col-12 column_offer">
                        <div class="offer">
                            <ul class="offer_ul">
                                <li class="offer_li">
                                    <div class="image_wrapper">
                                    <Image width="780" height="700" src="frontend-assets/agency7/images/agency7-products-pic3.webp" class="scale-with-grid wp-post-image" loading="lazy" /> </div>
                                    <div class="desc_wrapper align_left no-link">
                                        <div class="desc">
                                            <p>&nbsp;  </p>
                                            <p>&nbsp;  </p>
                                            <hr class="no_line" style="margin: 0 auto 15px auto" />
                                            <h3>Start from $0.</h3>
                                            <hr class="no_line" style="margin: 0 auto 15px auto" />
                                            <p> Join our free platform today and take advantage of a wealth of social media management capabilities, helping you to build a strong online presence, connect with your audience, and unlock new opportunities for growth. </p>
                                            <hr class="no_line" style="margin: 0 auto 15px auto" /> <a class="button button_size_2 button_themecolor" :href="route('admin.register.show-form', { refresh: true })" target="_blank"><span class="button_label">Join now</span></a> </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section mcb-section" style="padding-top:75px;padding-bottom:80px">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="column_attr clearfix mobile_align_center">
                            <h6 class="agency7-heading">SOCIAL MEDIAS ARE AVAILABLE NOW</h6>
                            <hr class="no_line" style="margin: 0 auto 15px auto" />
                            <h3><span class="highlight highlight-underline" style="background-color:#47cd2b;"><span class="highlight-word">Let<span class="highlight-border" style="background-color:#47cd2b;"></span></span> <span class="highlight-word">see<span class="highlight-border" style="background-color:#47cd2b;"></span></span></span> all social medias that we support.</h3> </div>
                    </div>
                    <div class="col-12 column_blog_news">
                        <div class="Latest_news featured">
                            <ul class="ul-first">
                                <li class="post">
                                    <div class="photo">
                                        <a href="frontend-assets/agency7/post.html">
                                        <Image width="960" height="720" src="frontend-assets/agency7/images/Screenshot 2023-05-19 at 00.28.16.png" class="scale-with-grid wp-post-image" loading="lazy" /></a>
                                    </div>
                                    <div class="desc">
                                        <h4><a href="">Facebook now available</a></h4>
                                        <div class="desc_footer">
                                            <div class="button-love"></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <ul class="ul-second">
                                <li class="post">
                                    <div class="photo">
                                        <a href="frontend-assets/agency7/social-media.html">
                                        <Image width="960" height="720" src="frontend-assets/agency7/images/Screenshot 2023-05-19 at 00.28.56.png" class="scale-with-grid wp-post-image" loading="lazy" /></a>
                                    </div>
                                    <div class="desc">
                                        <h5><a href="frontend-assets/agency7/social-media.html">Instagram</a></h5>
                                        <div class="desc_footer"> <span class="date"><i class="icon-clock"></i> Comming soon</span>
                                            <div class="button-love"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="post">
                                    <div class="photo">
                                        <a href="frontend-assets/agency7/post.html">
                                        <Image width="960" height="720" src="frontend-assets/agency7/images/tiktok.png" class="scale-with-grid wp-post-image" loading="lazy" /></a>
                                    </div>
                                    <div class="desc">
                                        <h5><a href="frontend-assets/agency7/post.html">Tiktok</a></h5>
                                        <div class="desc_footer"> <span class="date"><i class="icon-clock"></i> Comming soon</span>
                                            <div class="button-love"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="post">
                                    <div class="photo">
                                        <a href="frontend-assets/agency7/post.html">
                                        <Image width="960" height="720" src="frontend-assets/agency7/images/youtube.png" class="scale-with-grid wp-post-image" loading="lazy" /></a>
                                    </div>
                                    <div class="desc">
                                        <h5><a href="frontend-assets/agency7/post.html">Youtube</a></h5>
                                        <div class="desc_footer"> <span class="date"><i class="icon-clock"></i> Comming soon</span>
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
                            <h2><span style="color:#FFF;">Don’t wait
                                                        <br/>
                                                        start to join with us today</span></h2> </div>
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
                                        <a :href="route('admin.register.show-form', { refresh: true })">
                                            <div class="hover_color_wrapper" style="padding:12px 20px;"> <b>Create a new account now</b> </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr class="no_line" style="margin: 0 auto 40px auto" /> </div>
                            <div class="col-md-2">
                                <div class="placeholder"> &nbsp; </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </HomeLayout>
</template>
