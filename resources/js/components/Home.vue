<template>
    <div id="app">
        <header-section></header-section>

        <div class="container-fluid">
            <div class="row">
                <navbar></navbar>

                <router-view></router-view>
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
