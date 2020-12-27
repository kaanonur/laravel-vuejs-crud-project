<template>
    <div>
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
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            userList: null,
            errorMessage: null
        }
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.errorMessage = null;
            axios.get("http://127.0.0.1:8000/api/users").then(response => {
                this.userList = response.data;
            }).catch(error => {
                this.errorMessage = error.response.data.message;
            })
        }
    }
}
</script>
