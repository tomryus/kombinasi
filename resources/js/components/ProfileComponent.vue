<template>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                        <button @click="showModal()" class="btn btn-info btn-sm float-right" >Tambah data</button>
                        Data</div>

                    <div class="card-body">
                    <table class="table table-bordered table-stripped table-responsive" >
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>email</th>
                                <th>nama</th>
                                <th>pekerjaan</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(profile,index) in profile" :key="index">
                                <td>{{index +1}}</td>
                                <td>{{profile.email}}</td>
                                <td>{{profile.nama}}</td>
                                <td>{{profile.pekerjaan}}</td>
                                <td>
                                    <a href="#"><button @click="updateData(profile)" class="btn btn-info btn-sm" >Edit Data</button></a>
                                    <a href="#"><button @click="deleteprofile(profile)" class="btn btn-danger btn-sm">Hapus Data</button></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                    <!--pagination -->
                    <div class="card-footer text-muted">
                    <ul class="pagination">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" @click="getprofile(pagination.prev_page_url)" class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#">page {{pagination.current_page}} of {{pagination.last_page}}</a> </li>
                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" @click="getprofile(pagination.next_page_url)" class="page-item"><a  class="page-link" href="#">Next</a></li>
                    <li class="page-link"> Total data : {{pagination.total}}</li>
                    </ul>
                    </div>
                    <!-- pagination -->
                </div>
            </div>
        </div>
        <div class="modal fade" id="kelas-modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="alert alert-danger" v-if="errors.length > 0">
                        <ul>
                            <li v-for="(error, index ) in errors" :key="index">{{error}}</li>
                        </ul>
                    </div>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profile Form</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" v-model="profiles.email" name="Email" id="" class="form-control">
                     </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" v-model="profiles.nama" name="Nama" id="" class="form-control">
                     </div>
                    <div class="form-group">
                        <label>Pekerjaan</label>
                        <input type="text" v-model="profiles.pekerjaan" name="pekerajaan" id="" class="form-control">
                     </div>
                </div>
                <div class="modal-footer">
                    <button type="button" @click="resetForm()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" @click="addprofile()" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            profile:[],
            profiles:{
                id: '',
                email : '',
                nama : '',
                pekerjaan : '',
                
            },
            errors : [],
            pagination : {}
        }
    },
    methods:{
        showModal()
        {
            $("#kelas-modal-form").modal("show");
            this.errors=[];
        },
        getprofile(page_url){
            let url = page_url || '/profilevue'; 
            axios.get(url)
            .then(response =>{
                this.profile=response.data.data;
                this.profilePagination(response.data.meta, response.data.links); 
                console.log(this.profile);
                
        
            });
        },
        addprofile(){
            if (this.edit != true)
            {
                axios.post('/profilevue',{
                email : this.profiles.email,
                nama : this.profiles.nama,
                pekerjaan : this.profiles.pekerjaan,
            })
            .then(response =>{
                this.getprofile();
                $("#kelas-modal-form").modal("hide");
                this.resetForm();
                
            })
            .catch(error=>{
                this.errors = [];
                if(error.response.data.errors.email){
                    this.errors.push(error.response.data.errors.email[0])
                }
                if(error.response.data.errors.nama){
                    this.errors.push(error.response.data.errors.nama[0])
                }
                if(error.response.data.errors.pekerjaan){
                    this.errors.push(error.response.data.errors.pekerjaan[0])
                }
            });
            }
            else{
                axios.put('/profilevue/' + 
                this.profiles.id,{
                    email : this.profiles.email,
                    nama : this.profiles.nama,
                    pekerjaan : this.profiles.pekerjaan,
                })
                .then(response =>{
                this.getprofile();
                $("#kelas-modal-form").modal("hide");
                this.resetForm();
                
            })
            .catch(error=>{
                this.errors = [];
                if(error.response.data.errors.email){
                    this.errors.push(error.response.data.errors.email[0])
                }
                if(error.response.data.errors.nama){
                    this.errors.push(error.response.data.errors.nama[0])
                }
                if(error.response.data.errors.pekerjaan){
                    this.errors.push(error.response.data.errors.pekerjaan[0])
                }
            });

            }
            
            
        },
        updateData(profiles){
            this.edit = true;
            this.profiles.id = profiles.id
            this.profiles.email = profiles.email
            this.profiles.nama = profiles.nama
            this.profiles.pekerjaan = profiles.pekerjaan
            this.showModal();
        },
        deleteprofile(profiles){
            let pilihan = confirm("apakah yakin dihapus ?");
            if (pilihan === true){
            axios.delete('/profilevue/'+ profiles.id); //pada delete fungsi this nya harus dihapus
            this.getprofile();
            }
        },
        resetForm(){
            this.profiles.nama = ' ' ,
            this.profiles.email = ' ' ,
            this.profiles.pekerjaan = ' ' 
        },
        profilePagination(meta, links){
            let pagination = {
                current_page : meta.current_page,
                last_page : meta.last_page,
                next_page_url : links.next,
                prev_page_url : links.prev,
                total : meta.total,
            }
            this.pagination = pagination;
        },

    } ,
    mounted(){
        this.getprofile();
    }
}
</script>

