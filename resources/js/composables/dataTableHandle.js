import { router } from '@inertiajs/vue3'
const customDataTable = (dt, $itemResource) => {
    // LengthPage
    dt.page.len($itemResource.meta.per_page)

    // Showing page
    const language = dt.settings()[0].oLanguage
    language.sInfo = `Showing page ${$itemResource.meta.current_page} of ${$itemResource.meta.last_page}`

    // Box select + box input
    const selectPage = dt.table().container().querySelector('.dataTables_length>label>select')
    const inputSearch = dt.table().container().querySelector('input[type="search"]')
    selectPage.classList.add('form-control')
    inputSearch.classList.add('form-control')

    dt.on('draw', function () {
        // Pagination custom
        const pagination = dt.table().container().querySelector('.dataTables_paginate')
        const links = $itemResource.meta.links
        let page = 0
        let newPagination = `<ul class="pagination">`
        for (const [index, value] of links.entries()) {
            if (value.url) {
                let urlParams = new URL(value.url)
                page = urlParams.searchParams.get('page')
            }

            if (index === 0) {
                newPagination += `
                <li class="paginate_button page-item previous ${value.url ? '' : 'disabled'}" id="dt-table_previous">
                    <a href="javascript:" data-page="${page}" aria-controls="dt-table" data-dt-idx="0" tabindex="0" class="page-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                    </a>
                </li>`
            } else if (index === links.length - 1) {
                newPagination += `
                <li class="paginate_button page-item next ${value.url ? '' : 'disabled'}" id="dt-table_next">
                    <a href="javascript:" data-page="${page}" aria-controls="dt-table" data-dt-idx="2" tabindex="0" class="page-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </li>`
            } else {
                newPagination += `
                <li class="paginate_button page-item ${value.active ? 'active' : ''}">
                    <a href="javascript:" data-page="${page}" aria-controls="dt-table" data-dt-idx="1" tabindex="0" class="page-link">${value.label}</a>
                </li>`
            }
        }
        newPagination += `</ul>`

        pagination.innerHTML = newPagination
    })
}

const redirectToThisPage = ($routeNameIndex, params) => {
    router.get(route($routeNameIndex), params)
}

/**
 * Handle dataTable with data resource when OnMounted
 *
 * @param dt
 * @param $itemResource
 * @param params
 * @param $routeNameIndex
 */
const handleDataTableOnMounted = (
    dt,
    $itemResource,
    params,
    $routeNameIndex
) => {
    const url = new URL(window.location)
    const keyword = url.searchParams.get('search')

    if (keyword) {
        dt.search(keyword)
        const input = dt.table().container().querySelector('input[type="search"]')
        input?.focus()
    }

    if ($itemResource.meta.current_page > $itemResource.meta.last_page) {
        delete params.page
        redirectToThisPage($routeNameIndex, params)
    }

    customDataTable(dt, $itemResource)

    dt.on('search', (e, settings) => {
        const searchValue = settings.oPreviousSearch.sSearch

        if (searchValue != keyword && searchValue) {
            params.search = searchValue
            redirectToThisPage($routeNameIndex, params)
        } else if (searchValue != keyword && !searchValue && url.searchParams.has('search')) {
            delete params.search
            redirectToThisPage($routeNameIndex, params)
        }
    })

    dt.on('length', (e, settings, length) => {
        params.limit = length
        redirectToThisPage($routeNameIndex, params)
    })

    //Button pagination
    $(document).on('click', '.page-link', function (e) {
        e.preventDefault()
        let $this = $(this)

        let page = $this.data('page')
        if (page) {
            params.page = page
            redirectToThisPage($routeNameIndex, params)
        }
    })
}

export {
    handleDataTableOnMounted
}
