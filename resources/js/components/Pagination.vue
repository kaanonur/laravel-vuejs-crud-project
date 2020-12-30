<template>
<nav>
    <ul class="pagination">
        <li class="page-item" :class="{ 'disabled': current_page === 1}">
            <a href="#" class="page-link" @click="pageChange(current_page -1)">
                &laquo;
            </a>
        </li>
        <li class="page-item" :class="{ 'active': current_page === page}"
        v-for="page in last_page" :key="page">
            <a href="#" class="page-link" @click="pageChange(page)">
                {{ page }}
            </a>
        </li>
        <li class="page-item" :class="{ 'disabled': current_page === last_page}">
            <a href="#" class="page-link" @click="pageChange(current_page +1)">
                &raquo;
            </a>
        </li>
    </ul>
</nav>
</template>

<script>
export default {
    props: [
        'current_page',
        'last_page',
        'next_page_url',
        'prev_page_url',
        'links'
    ],
    methods: {
        pageChange(page) {
            this.$emit('pageChange', page);
        }
    }
}
</script>
