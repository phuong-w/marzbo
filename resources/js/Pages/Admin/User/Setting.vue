<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head, Link, usePage } from '@inertiajs/vue3'

defineProps({
    users: Object,
})

const trans = usePage().props.trans
const user = usePage().props.auth.user.data
</script>

<template>
    <Head title="Setting" />
    <AdminLayout>
        <div class="account-settings-container layout-top-spacing mr-3 ml-3 mt-0 mb-0">

            <div class="account-content">
                <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                    <div class="row">
<!--                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">-->
<!--                            <form id="general-info" class="section general-info">-->
<!--                                <div class="info">-->
<!--                                    <h6 class="">General Information</h6>-->
<!--                                    <div class="row">-->
<!--                                        <div class="col-lg-11 mx-auto">-->
<!--                                            <div class="row">-->
<!--                                                <div class="col-xl-2 col-lg-12 col-md-4">-->
<!--                                                    <div class="upload mt-4 pr-md-4">-->
<!--                                                        <input type="file" id="input-file-max-fs" class="dropify" :data-default-file="user.avatar" data-max-file-size="2M" />-->
<!--                                                        <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i> Upload Picture</p>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                                <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">-->
<!--                                                    <div class="form">-->
<!--                                                        <div class="row">-->
<!--                                                            <div class="col-sm-6">-->
<!--                                                                <div class="form-group">-->
<!--                                                                    <label for="fullName">Full Name</label>-->
<!--                                                                    <input type="text" class="form-control mb-4" id="fullName" placeholder="Full Name" :value="user.name">-->
<!--                                                                </div>-->
<!--                                                            </div>-->
<!--                                                            <div class="col-sm-6">-->
<!--                                                                <label class="dob-input">Date of Birth</label>-->
<!--                                                                <div class="d-sm-flex d-block">-->
<!--                                                                    <div class="form-group mr-1">-->
<!--                                                                        <select class="form-control" id="exampleFormControlSelect1">-->
<!--                                                                            <option>Day</option>-->
<!--                                                                            <option>1</option>-->
<!--                                                                            <option>2</option>-->
<!--                                                                            <option>3</option>-->
<!--                                                                            <option>4</option>-->
<!--                                                                            <option>5</option>-->
<!--                                                                            <option>6</option>-->
<!--                                                                            <option>7</option>-->
<!--                                                                            <option>8</option>-->
<!--                                                                            <option>9</option>-->
<!--                                                                            <option>10</option>-->
<!--                                                                            <option>11</option>-->
<!--                                                                            <option>12</option>-->
<!--                                                                            <option>13</option>-->
<!--                                                                            <option>14</option>-->
<!--                                                                            <option>15</option>-->
<!--                                                                            <option>16</option>-->
<!--                                                                            <option>17</option>-->
<!--                                                                            <option>18</option>-->
<!--                                                                            <option>19</option>-->
<!--                                                                            <option>20</option>-->
<!--                                                                            <option>21</option>-->
<!--                                                                            <option>22</option>-->
<!--                                                                            <option>23</option>-->
<!--                                                                            <option>24</option>-->
<!--                                                                            <option>25</option>-->
<!--                                                                            <option>26</option>-->
<!--                                                                            <option>27</option>-->
<!--                                                                            <option>28</option>-->
<!--                                                                            <option>29</option>-->
<!--                                                                            <option>30</option>-->
<!--                                                                        </select>-->
<!--                                                                    </div>-->
<!--                                                                    <div class="form-group mr-1">-->
<!--                                                                        <select class="form-control" id="month">-->
<!--                                                                            <option>Month</option>-->
<!--                                                                            <option>Jan</option>-->
<!--                                                                            <option>Feb</option>-->
<!--                                                                            <option>Mar</option>-->
<!--                                                                            <option>Apr</option>-->
<!--                                                                            <option>May</option>-->
<!--                                                                            <option>Jun</option>-->
<!--                                                                            <option>Jul</option>-->
<!--                                                                            <option>Aug</option>-->
<!--                                                                            <option>Sep</option>-->
<!--                                                                            <option>Oct</option>-->
<!--                                                                            <option>Nov</option>-->
<!--                                                                            <option>Dec</option>-->
<!--                                                                        </select>-->
<!--                                                                    </div>-->
<!--                                                                    <div class="form-group mr-1">-->
<!--                                                                        <select class="form-control" id="year">-->
<!--                                                                            <option>Year</option>-->
<!--                                                                            <option>2018</option>-->
<!--                                                                            <option>2017</option>-->
<!--                                                                            <option>2016</option>-->
<!--                                                                            <option>2015</option>-->
<!--                                                                            <option>2014</option>-->
<!--                                                                            <option>2013</option>-->
<!--                                                                            <option>2012</option>-->
<!--                                                                            <option>2011</option>-->
<!--                                                                            <option>2010</option>-->
<!--                                                                            <option>2009</option>-->
<!--                                                                            <option>2008</option>-->
<!--                                                                            <option>2007</option>-->
<!--                                                                            <option>2006</option>-->
<!--                                                                            <option>2005</option>-->
<!--                                                                            <option>2004</option>-->
<!--                                                                            <option>2003</option>-->
<!--                                                                            <option>2002</option>-->
<!--                                                                            <option>2001</option>-->
<!--                                                                            <option>2000</option>-->
<!--                                                                            <option>1999</option>-->
<!--                                                                            <option>1998</option>-->
<!--                                                                            <option>1997</option>-->
<!--                                                                            <option>1996</option>-->
<!--                                                                            <option>1995</option>-->
<!--                                                                            <option>1994</option>-->
<!--                                                                            <option>1993</option>-->
<!--                                                                            <option>1992</option>-->
<!--                                                                            <option>1991</option>-->
<!--                                                                            <option>1990</option>-->
<!--                                                                            <option>1989</option>-->
<!--                                                                            <option>1988</option>-->
<!--                                                                            <option>1987</option>-->
<!--                                                                            <option>1986</option>-->
<!--                                                                            <option>1985</option>-->
<!--                                                                            <option>1984</option>-->
<!--                                                                            <option>1983</option>-->
<!--                                                                            <option>1982</option>-->
<!--                                                                            <option>1981</option>-->
<!--                                                                            <option>1980</option>-->
<!--                                                                        </select>-->
<!--                                                                    </div>-->
<!--                                                                </div>-->
<!--                                                            </div>-->
<!--                                                        </div>-->
<!--                                                        <div class="form-group">-->
<!--                                                            <label for="profession">Profession</label>-->
<!--                                                            <input type="text" class="form-control mb-4" id="profession" placeholder="Designer" value="Content Creator">-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </form>-->
<!--                        </div>-->

                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form id="contact" class="section contact">
                                <div class="info">
                                    <h5 class="">{{ trans.general.common.contact }}</h5>
                                    <div class="row">
                                        <div class="col-md-11 mx-auto">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="country">{{ trans.general.common.country }}</label>
                                                        <select class="form-control" id="country">
                                                            <option>All Countries</option>
                                                            <option selected>Việt Nam</option>
                                                            <option>India</option>
                                                            <option>Japan</option>
                                                            <option>China</option>
                                                            <option>Brazil</option>
                                                            <option>Norway</option>
                                                            <option>Canada</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone">{{ trans.general.common.phone_number }}</label>
                                                        <input type="text" class="form-control mb-4" id="phone" placeholder="Write your phone number here" :value="user.phone">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">{{ trans.general.user.name }}</label>
                                                        <input type="text" class="form-control mb-4" id="name" :placeholder="trans.general.user.name" :value="user.name" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="text" class="form-control mb-4" id="email" placeholder="Write your email here" :value="user.email">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form id="social" class="section social">
                                <div class="info">
                                    <h5 class="">{{ trans.general.common.link_social }}</h5>
                                    <div class="row">

                                        <div class="col-md-11 mx-auto">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group social-fb mb-3">
                                                        <a :href="route('social.connect', 'facebook')" class="input-group-prepend mr-3">
                                                            <span class="input-group-text" id="fb"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></span>
                                                        </a>
                                                        <input type="text" class="form-control" :class="{active: user.facebook_credential}" placeholder="Facebook Username" aria-label="Username" aria-describedby="fb" :value="user.facebook_credential?.name" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group social-instagram mb-3">
                                                        <div class="input-group-prepend mr-3">
                                                            <span class="input-group-text" id="instagram">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-instagram" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z"></path>
                                                                    <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                                                    <path d="M16.5 7.5l0 .01"></path>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Instagram Username" aria-label="Username" aria-describedby="instagram" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-11 mx-auto">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group social-tiktok mb-3">
                                                        <div class="input-group-prepend mr-3">
                                                            <span class="input-group-text" id="tiktok">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-tiktok" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                   <path d="M21 7.917v4.034a9.948 9.948 0 0 1 -5 -1.951v4.5a6.5 6.5 0 1 1 -8 -6.326v4.326a2.5 2.5 0 1 0 4 2v-11.5h4.083a6.005 6.005 0 0 0 4.917 4.917z"></path>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Tiktok Username" aria-label="Username" aria-describedby="tiktok" value="">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group social-tweet mb-3">
                                                        <div class="input-group-prepend mr-3">
                                                            <span class="input-group-text" id="tweet"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg></span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Twitter Username" aria-label="Username" aria-describedby="tweet" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-11 mx-auto">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group social-youtube mb-3">
                                                        <div class="input-group-prepend mr-3">
                                                            <span class="input-group-text" id="tiktok">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-youtube" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                   <path d="M3 5m0 4a4 4 0 0 1 4 -4h10a4 4 0 0 1 4 4v6a4 4 0 0 1 -4 4h-10a4 4 0 0 1 -4 -4z"></path>
                                                                   <path d="M10 9l5 3l-5 3z"></path>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Youtube Username" aria-label="Username" aria-describedby="youtube" value="">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div class="account-settings-footer">

                <div class="as-footer-container">

                    <button id="multiple-reset" class="btn btn-primary">Reset All</button>
                    <div class="blockui-growl-message">
                        <i class="flaticon-double-check"></i>&nbsp; Settings Saved Successfully
                    </div>
                    <button id="multiple-messages" class="btn btn-dark">Save Changes</button>

                </div>

            </div>
        </div>
    </AdminLayout>
</template>

<style src="/resources/sass/plugins/dropify/dropify.min.scss" lang="scss"></style>
<style src="/resources/sass/assets/users/account-setting.scss" lang="scss"></style>

<style scoped>
.form-control.active {
    box-shadow: 0 0 5px 2px rgba(194, 213, 255, 0.6196078431);
    border-color: #4361ee;
    color: #3b3f5c;
}
</style>
