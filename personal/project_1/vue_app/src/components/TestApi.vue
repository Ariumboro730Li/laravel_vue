<template>
    <div class="container mt-2">
        <h1 class="text-center">Hello World BROOOOOO</h1>
        <a data-toggle="modal" data-target="#modelId"
         class="btn btn-primary shadow" href="#" role="button">New Data</a>
        <div class="form-group mt-2">
          <input type="text" class="form-control shadow" @change="finderData" ref="finderInput" aria-describedby="helpId" placeholder="Find Someone or Professions">
        </div>
        <div class="row my-2">
            <div class="col-6 mt-2" v-for="dataAll in allData" :key="dataAll.id">
                <div class="card text-left shadow">
                    <div class="card-body">
                        <h4 class="card-title">{{dataAll.name}}</h4>
                        <p class="card-text">{{dataAll.profession}}</p>
                        <a v-on:click="deleteData(dataAll.id)" class="btn btn-sm btn-danger" href="#" role="button">Delete</a>
                        -
                        <a v-on:click="updateData(dataAll.id)" data-toggle="modal" data-target="#modelId" class="btn btn-sm btn-info" href="#" role="button">Update</a>
                    </div>
                </div>
            </div>
        </div>
        <nav aria-label="Page navigation ">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                <a class="page-link shadow" @click="loadUrl(previousPage)">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">{{previousPage}}}</span>
                </a>
                </li>
                <li class="page-item">
                <a class="page-link shadow" @click="loadUrl(nextPage)"  aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
                </li>
            </ul>
        </nav>
        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1">
            <div class="modal-dialog" role="document">
                <form @submit.prevent="saveData">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                    <input type="number" v-model="enteredId">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" v-model="enteredName">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Profession</label>
                                        <input type="text" class="form-control" v-model="enteredProfession">
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            allData : [],
            enteredId: null,
            enteredName : null,
            enteredProfession : null,
            previousPage : null,
            nextPage : null,
            finderResult : [],
        }
    },
    methods: {
        loadUrl(page, data){
            page = (page == undefined) ? 1 : page;
            data = (data == undefined) ? this.finderResult : data;
            let params = {
                page : page,
                ...data
            };
            console.log(params);
            fetch(`http://127.0.0.1:8002/api/test-api`, {
                method: `POST`,
                headers: {
                    'Content-Type' : `application/json`,
                },
                body: JSON.stringify(params),
            }).then(response => {
                if (response.ok) {
                    return response.json();
                }
            }).then((data) => {
                this.previousPage = data.current_page - 1;
                this.nextPage = data.current_page + 1;
                this.allData = data.data;
            })
        },
        saveData(){
            let dataSubmit = {
                "id" : this.enteredId,
                "name" : this.enteredName,
                "profession" : this.enteredProfession
            };
            fetch("http://127.0.0.1:8002/api/test-api/save", {
                method: `POST`,
                headers: {
                    'Content-Type' : `application/json`,
                },
                body: JSON.stringify(dataSubmit),
            }).then(response => {
                if (response.ok) {
                    return response.json();
                }
            }).then((data) => {
                console.log(data);
                this.enteredId = null;
                this.enteredName = null;
                this.enteredProfession = null;
                this.loadUrl();
            })
        }, 
        deleteData(deleteId){
            fetch(`http://127.0.0.1:8002/api/test-api/${deleteId}`, {
                method: `DELETE`,
                headers: {
                    'Content-Type' : `application/json`,
                },
            }).then(response => {
                this.loadUrl();
                console.log(response);
            });
        },
        updateData(updateId){
            console.log(updateId);
            const identifiedData = this.allData.find(
                (dataAll) => dataAll.id === updateId
            );
            this.enteredId = updateId;
            this.enteredName = identifiedData.name;
            this.enteredProfession = identifiedData.profession;
            
        },
        finderData(){
            const finder = this.$refs.finderInput.value;
            this.finderResult = {
                something : finder
            };
            this.loadUrl(1, this.finderResult);
        }
    },
    mounted() {
        this.loadUrl();
    },
}
</script>