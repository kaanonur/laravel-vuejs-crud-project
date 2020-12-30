<template>
    <div class="mt-3">
        <div class="row">
            <div class="col-md-8">
                <h1>User List</h1>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>E-Mail</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="{id, name, email} in userList" v-if="userList.length > 0 || userList != null">
                            <td>{{ id }}</td>
                            <td>{{ name }}</td>
                            <td>{{ email }}</td>
                        </tr>
                        <tr v-else>
                            <td colspan="3" class="text-center">Not Found Any Data</td>
                        </tr>
                        <tr v-if="errorMessage">
                            <td colspan="3" class="text-center">
                                <div class="alert alert-danger">
                                    {{ errorMessage }}
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <pagination :current_page="current_page" :last_page="last_page" :next_page_url="next_page_url" :links="links" @pageChange="fetchData"></pagination>
                </div>
            </div>
            <div class="col-md-4">
                <Form :item="item" v-on:onSaved="refreshData"></Form>
            </div>
        </div>
    </div>
</template>

<script>
import Pagination from "../../components/Pagination";
import Form from "../../components/Form";

export default {
    components: {Pagination, Form},
    data() {
        return {
            userList: null,
            errorMessage: null,
            current_page: {},
            last_page: {},
            next_page_url: {},
            prev_page_url: {},
            links: {},
            item: {}
        }
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData(page = 1) {
            this.errorMessage = null;
            axios.get("/users?page="+page).then(response => {
                this.userList = response.data.data;
                this.current_page = response.data.current_page;
                this.last_page = response.data.last_page;
                this.next_page_url = response.data.next_page_url;
                this.prev_page_url = response.data.prev_page_url;
                this.links = response.data.links;
            }).catch(error => {
                this.errorMessage = error.response.data.message;
            })
        },
        refreshData(item) {
            this.fetchData();
        }
    }
}
</script>
