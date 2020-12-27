<template>
    <div id="app">
        <header-section></header-section>

        <div class="container-fluid">
            <div class="row">
                <navbar></navbar>
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <router-view></router-view>
                </main>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from "./Navbar";
import Header from "./Header";


    export default {
        components: {
            Navbar,
            headerSection: Header
        }
    }
</script>
