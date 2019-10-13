<template>
    <div class="uk-margin-top">
        <ul class="uk-pagination uk-flex-center" uk-margin>
            <template v-for="i in totalPages">
                <template v-if="i == currentPage">
                    <li class="uk-active"><span>{{ i }}</span></li>
                </template>
                <template v-else>
                    <li><a :href="'/?page='+i">{{ i }}</a></li>
                </template>
            </template>
        </ul>
    </div>
</template>
<script>
    export default {
        name: "Pagination",
        props: {
            currentPage: {
                type: Number,
                required: true,
                default() {
                    return 1;
                }
            },
            totalPages: {
                type: Number,
                required: true,
                default() {
                    return 0;
                }
            }
        }
    }
</script>
