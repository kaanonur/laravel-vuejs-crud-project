<template>
    <form @submit.prevent="true">
        <div class="row">
            <div class="col-md-12">
                <div v-if="errorMessage" class="col-md-12 alert alert-danger" v-html="errorMessage">
                </div>
            </div>
            <div class="col-md-12">
                <label>Name</label>
                <input id="name" v-model="item.name" type="text" name="name" class="form-control">
            </div>
            <div class="col-md-12 mt-3">
                <label>E-Mail</label>
                <input id="email" v-model="item.email" type="email" name="email" class="form-control">
            </div>
            <div class="col-md-12 mt-3">
                <label>Password</label>
                <input id="password" v-model="item.password" type="password" name="password" class="form-control">
            </div>
            <div class="col-md-12 mt-3 text-right">
                <button class="btn btn-success" @click="saveUser">Add</button>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            name: null,
            email: null,
            password: null,
            errorMessage: ''
        }
    },
    props: ['item'],
    methods: {
        saveUser() {
            axios.post("/users", this.item)
                .then(response => {
                    if(response.data.success){
                        alert(response.data.message);
                        this.$emit('onSaved', this.item);
                    }
            }).catch(error => {
                this.errorMessage = error.response.data.message;
                if(error.response.data.errors){
                    this.errorMessage += "<ul>";
                    Object.keys(error.response.data.errors).forEach((key) => {
                        this.errorMessage += "<li>" + error.response.data.errors[key][0] + "</li>";
                    });
                    this.errorMessage += "</ul>";
                }
            })
        }
    }
}
</script>
