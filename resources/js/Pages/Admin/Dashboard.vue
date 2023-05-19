<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head } from '@inertiajs/vue3'
import {onMounted} from "vue";
import ApexCharts from 'apexcharts'
import { reloadPageWithParamRefresh } from '@/composables/helpers'

const props = defineProps({
    quote: String,
    months: Array,
    average_total_view: Array,
    average_total_comment: Array,
    average_total_react: Array,
    total_post: Number,
    total_user: Number,
})

const options = {
    chart: {
        height: 350,
        type: 'bar',
        toolbar: {
            show: false,
        }
    },
    colors: ['#5c1ac3', '#d6b007', '#48e054'],
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
        },
    },
    dataLabels: {
        enabled: false
    },
    legend: {
        position: 'bottom',
        horizontalAlign: 'center',
        fontSize: '14px',
        markers: {
            width: 10,
            height: 10,
        },
        itemMargin: {
            horizontal: 8,
            vertical: 8
        }
    },
    stroke: {
        show: true,
        width: 3,
        colors: ['transparent']
    },
    series: [
        {
            name: 'Comment',
            data: props.average_total_comment
        },
        {
            name: 'React',
            data: props.average_total_react
        },
        {
            name: 'View',
            data: props.average_total_view
        }
    ],
    xaxis: {
        categories: props.months,
    },
    fill: {
        type: 'gradient',
        gradient: {
            shade: 'light',
            type: 'vertical',
            shadeIntensity: 0.3,
            inverseColors: false,
            opacityFrom: 1,
            opacityTo: 0.8,
            stops: [0, 100]
        }
    },
    tooltip: {
        y: {
            formatter: function (val) {
                return val
            }
        }
    }
}

onMounted(() => {
    reloadPageWithParamRefresh()

    const fbDashboard = new ApexCharts(
        document.querySelector('#uniqueVisits'),
        options
    );
    fbDashboard.render();
})
</script>

<template>
    <Head title="Dashboard" />
    <AdminLayout>
        <div class="col-12">
            <h1>
                Dashbroad
            </h1>
        </div>

        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-one">
                <div class="widget-heading">
                    <h6 class="">Statistics</h6>
                </div>
                <div class="w-chart">

                    <div class="w-chart-section total-visits-content">
                        <div class="w-detail">
                            <p class="w-title">Users</p>
                            <p class="w-stats">{{ props.total_user }}</p>
                        </div>
                    </div>

                    <div class="w-chart-section paid-visits-content">
                        <div class="w-detail">
                            <p class="w-title">Posts</p>
                            <p class="w-stats">{{ props.total_post }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-chart-three">
                <div class="widget-heading">
                    <div class="">
                        <h5 class="">Facebook</h5>
                    </div>

                    <div class="dropdown ">
                        <a class="dropdown-toggle" href="#" role="button" id="uniqueVisitors" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="uniqueVisitors">
                            <a class="dropdown-item" href="javascript:void(0);">View</a>
                            <a class="dropdown-item" href="javascript:void(0);">Update</a>
                            <a class="dropdown-item" href="javascript:void(0);">Download</a>
                        </div>
                    </div>
                </div>

                <div class="widget-content">
                    <div id="uniqueVisits"></div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
