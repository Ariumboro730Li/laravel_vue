<template>
    <div>
        <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation"></button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/">Dashboard <span class="sr-only">(current)</span></router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link"  to="test-api" >Test Api</router-link>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" @submit.prevent="searchData">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item dropdown">
                            <input class="form-control mr-sm-2 col-12"  @change="searchData" v-model="searchInput" type="text" placeholder="Search">
                            <div class="dropdown-menu col-12" ref="dropdownSearch" aria-labelledby="dropdownId">
                                <a class="dropdown-item text-info" href="#" v-for="result in resultsSearch" :key="result" >{{result}}</a>
                            </div>
                        </li>
                    </ul>
                </form>
            </div>
        </nav>
    </div>
</template>
<script>
export default {
    data(){
        return {
            searchInput : null,
            resultsSearch : [],
        }
    },
    methods: {
        searchData(){
            fetch(`http://127.0.0.1:8002/api/search/${this.searchInput}`).then(
                (response) => {
                    if (response.ok) {
                        return response.json();
                    }
                }
            ).then((data) => {
                this.resultsSearch = data;
            })

            if (this.searchInput == "") {
                this.$refs.dropdownSearch.classList.remove("show");
            } else {
                this.$refs.dropdownSearch.classList.add("show");
            }
        }
    },
}
</script>
<style>
    .router-link-active{
        background-color : white;
        color : black !important;
        box-shadow: 10ch;
    }
</style>